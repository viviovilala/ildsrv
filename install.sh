#!/usr/bin/env bash
#
# ILDIS One-Click Install
# Deploy ILDIS with a single command:
#   curl -fsSL https://raw.githubusercontent.com/bphndigitalservice/ildis/main/install.sh | bash
#
# Usage:
#   ./install.sh                  Interactive install
#   ./install.sh --non-interactive  Use env vars, no prompts
#   ./install.sh --update          Update existing installation
#   ./install.sh --help            Show help text

set -euo pipefail

# ── Configuration ──────────────────────────────────────────────────────────
GITHUB_REPO="bphndigitalservice/ildis"
GHCR_IMAGE="ghcr.io/${GITHUB_REPO}"
COMPOSE_FILE="docker-compose.yml"
ENV_FILE=".env"
VERSION_FILE="VERSION"
BACKUP_DIR="backups"
DEFAULT_PORT=8080
DEFAULT_INSTALL_DIR="/opt/ildis"
MIN_DISK_MB=1024
HEALTH_RETRIES=12
HEALTH_INTERVAL=5
MYSQL_HEALTH_RETRIES=30
MYSQL_HEALTH_INTERVAL=2

# ── Colors ──────────────────────────────────────────────────────────────────
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
BOLD='\033[1m'
NC='\033[0m'

# ── Helper functions ────────────────────────────────────────────────────────
info()    { echo -e "${BLUE}[INFO]${NC} $*"; }
success() { echo -e "${GREEN}[OK]${NC} $*"; }
warn()    { echo -e "${YELLOW}[WARN]${NC} $*"; }
fail()    { echo -e "${RED}[FAIL]${NC} $*"; exit 1; }

generate_random_key() {
    if command -v openssl &>/dev/null; then
        openssl rand -base64 32 | tr -d '=\n'
    elif [ -r /dev/urandom ]; then
        head -c 32 /dev/urandom | base64 | tr -d '=\n'
    else
        echo "RANDOM_KEY_$(date +%s)_$$"
    fi
}

confirm() {
    local prompt="$1"
    local default="${2:-n}"
    if [ "${NON_INTERACTIVE}" = true ]; then
        echo "$default"
        return
    fi
    local choices=""
    if [ "$default" = "y" ]; then
        choices="[Y/n]"
    else
        choices="[y/N]"
    fi
    read -rp "${prompt} ${choices} " REPLY
    REPLY="${REPLY:-$default}"
    [[ "$REPLY" =~ ^[Yy]$ ]]
}

prompt_value() {
    local prompt="$1"
    local default="$2"
    local is_secret="${3:-false}"
    if [ "${NON_INTERACTIVE}" = true ]; then
        echo "$default"
        return
    fi
    if [ "$is_secret" = true ]; then
        read -rsp "${prompt} [generated]: " REPLY
        echo ""
        REPLY="${REPLY:-$default}"
    else
        read -rp "${prompt} [${default}]: " REPLY
        REPLY="${REPLY:-$default}"
    fi
    echo "$REPLY"
}

# ── Parse arguments ─────────────────────────────────────────────────────────
INSTALL_DIR="${INSTALL_DIR:-}"
ACTION="install"
NON_INTERACTIVE=false
DB_TYPE_OVERRIDE=""

while [[ $# -gt 0 ]]; do
    case "$1" in
        --non-interactive|-n)
            NON_INTERACTIVE=true
            shift
            ;;
        --update|-u)
            ACTION="update"
            shift
            ;;
        --dir|-d)
            INSTALL_DIR="$2"
            shift 2
            ;;
        --db-type|-t)
            DB_TYPE_OVERRIDE="$2"
            shift 2
            ;;
        --help|-h)
            ACTION="help"
            shift
            ;;
        *)
            echo "Unknown option: $1"
            echo "Run './install.sh --help' for usage."
            exit 1
            ;;
    esac
done

show_help() {
    cat <<'EOF'
ILDIS One-Click Install — Deploy ILDIS with Docker

Usage:
  ./install.sh                      Interactive install
  ./install.sh --non-interactive    Use env vars, no prompts
  ./install.sh --update             Update existing installation
  ./install.sh --dir /opt/ildis    Specify install directory
  ./install.sh --db-type mariadb   Set DB type (mariadb|mysql|external)
  ./install.sh --help               Show this help text

Environment variables (for --non-interactive):
  INSTALL_DIR        Install directory (default: /opt/ildis)
  PORT               App port (default: 8080)
  PUBLIC_DOMAIN      Public URL (default: http://localhost:8080)
  DB_TYPE            Database type: mariadb, mysql, external
  DB_HOST            Database host (for external)
  DB_USER            Database user
  DB_PASSWORD        Database password
  DB_DATABASE        Database name (default: ildis_v4)
  DB_DATABASE_PORT   Database port (default: 3306)
  RECAPTCHA_SITE_KEY    reCAPTCHA site key
  RECAPTCHA_SECRET_KEY  reCAPTCHA secret key

Examples:
  curl -fsSL https://raw.githubusercontent.com/bphndigitalservice/ildis/main/install.sh | bash
  ./install.sh --non-interactive --db-type external
  ./install.sh --update
EOF
    exit 0
}

if [ "$ACTION" = "help" ]; then
    show_help
fi

# ── Prerequisite checks ─────────────────────────────────────────────────────
check_prerequisites() {
    info "Checking prerequisites..."

    if ! command -v docker &>/dev/null; then
        echo ""
        echo -e "${RED}Docker is not installed.${NC}"
        echo ""
        echo "Install Docker: https://docs.docker.com/engine/install/"
        fail "Docker is required."
    fi

    if ! docker compose version &>/dev/null 2>&1; then
        echo ""
        echo -e "${RED}Docker Compose v2 is not available.${NC}"
        echo ""
        echo "Install Docker Compose: https://docs.docker.com/compose/install/"
        fail "Docker Compose v2 is required."
    fi

    local available_kb available_mb
    available_kb=$(df -k . | awk 'NR==2 {print $4}')
    available_mb=$((available_kb / 1024))
    if [ "${available_mb}" -lt "${MIN_DISK_MB}" ]; then
        fail "Insufficient disk space: ${available_mb}MB available, ${MIN_DISK_MB}MB required."
    fi
    success "Disk space: ${available_mb}MB available"

    local port="${PORT:-${DEFAULT_PORT}}"
    if command -v ss &>/dev/null; then
        if ss -tlnp 2>/dev/null | grep -q ":${port} "; then
            warn "Port ${port} appears to be in use."
            warn "You can change it with PORT= when running the script."
        fi
    elif command -v lsof &>/dev/null; then
        if lsof -i ":${port}" &>/dev/null 2>&1; then
            warn "Port ${port} appears to be in use."
        fi
    fi

    success "Prerequisites OK"
}