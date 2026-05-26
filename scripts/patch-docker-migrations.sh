#!/usr/bin/env bash
# Patch ILDIS production container so "php yii migrate" works with namespaced migrations.
# Usage (from any directory):
#   INSTALL_DIR=/opt/ildis /path/to/ildis/scripts/patch-docker-migrations.sh

set -euo pipefail

INSTALL_DIR="${INSTALL_DIR:-/opt/ildis}"
COMPOSE_FILE="${COMPOSE_FILE:-docker-compose.yml}"
ENV_FILE="${ENV_FILE:-.env}"

if [ ! -f "${INSTALL_DIR}/${COMPOSE_FILE}" ]; then
    echo "Compose file not found: ${INSTALL_DIR}/${COMPOSE_FILE}" >&2
    exit 1
fi

cd "${INSTALL_DIR}"

compose() {
    docker compose -f "${COMPOSE_FILE}" --env-file "${ENV_FILE}" "$@"
}

echo "[0/4] Menonaktifkan autoInstallTables UserCounter (hindari race dengan migrate)..."
compose exec -T app sed -i "s/'autoInstallTables' => true/'autoInstallTables' => false/" \
    /var/www/frontend/config/main.php 2>/dev/null || true

echo "[1/4] Mengatur migrationNamespaces di console/config/main.php..."
if ! compose exec -T app grep -q "migrationNamespaces" /var/www/console/config/main.php 2>/dev/null; then
    compose exec -T app sed -i \
        "s|'migrationPath' => '@console/migrations',|'migrationNamespaces' => ['console\\\\migrations'],\n            'migrationPath' => null,|" \
        /var/www/console/config/main.php
fi

echo "[2/4] Memperbaiki migrasi report (row size MySQL)..."
compose exec -T app sed -i \
    's/$this->string(100)->notNull()/$this->text()->notNull()/g; s/$this->string()->notNull()/$this->text()->notNull()/g' \
    /var/www/console/migrations/m250514_121356_create_table_report.php 2>/dev/null || true

echo "[3/4] Menambahkan namespace pada migrasi visitor..."
for f in m260507_000001_create_table_visitor_log.php \
         m260507_000002_create_table_visitor_stats.php \
         m260507_000003_insert_visitor_report_menu.php; do
    compose exec -T app sh -c "
        file=/var/www/console/migrations/${f}
        if [ -f \"\$file\" ] && ! grep -q 'namespace console' \"\$file\"; then
            sed -i '1a\\
\\
namespace console\\\\migrations;\\
' \"\$file\"
        fi
    " 2>/dev/null || true
done

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
REPO_MIG="${SCRIPT_DIR}/../console/migrations"
if [ -d "${REPO_MIG}" ]; then
    CID="$(compose ps -q app | head -1)"
    if [ -n "${CID}" ]; then
        echo "Menyalin file migrasi yang sudah diperbaiki dari repo..."
        for f in m250514_121345_create_table_pcounter_save.php \
                 m250514_121346_create_table_pcounter_users.php \
                 m250514_121356_create_table_report.php \
                 m260507_000001_create_table_visitor_log.php \
                 m260507_000002_create_table_visitor_stats.php \
                 m260507_000003_insert_visitor_report_menu.php; do
            if [ -f "${REPO_MIG}/${f}" ]; then
                docker cp "${REPO_MIG}/${f}" "${CID}:/var/www/console/migrations/${f}"
            fi
        done
    fi
fi

echo "Selesai. Jalankan migrasi:"
echo "  cd ${INSTALL_DIR} && sudo docker compose --env-file .env exec -T app php /var/www/yii migrate/up --interactive=0"
