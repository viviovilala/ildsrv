#!/bin/sh
# ILDIS database initialization script
# Runs as a oneshot s6-overlay service before php-fpm starts.
# Applies any pending Yii2 database migrations.

s6-echo "[ildis-init] Applying database migrations..."
php /var/www/yii migrate/up --interactive=0 --migrationPath=@console/migrations
s6-echo "[ildis-init] Database migrations applied."