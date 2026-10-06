#!/bin/sh

set -eu

if [ -n "${RENDER_EXTERNAL_URL:-}" ]; then
    sed -i "s#^app.baseURL.*#app.baseURL = '${RENDER_EXTERNAL_URL}/'#" /app/.env
fi

service mariadb start

attempt=0
until mariadb-admin ping --silent; do
    attempt=$((attempt + 1))
    if [ "$attempt" -ge 30 ]; then
        echo "MariaDB did not become ready in time." >&2
        exit 1
    fi
    sleep 1
done

mariadb --user=root < /app/database/saripos.sql

APP_DB_PASSWORD="$(od -An -N16 -tx1 /dev/urandom | tr -d ' \n')"

mariadb --user=root <<SQL
CREATE OR REPLACE USER 'saripos_app'@'%' IDENTIFIED BY '${APP_DB_PASSWORD}';
GRANT SELECT, INSERT, UPDATE ON saripos.* TO 'saripos_app'@'%';
FLUSH PRIVILEGES;
SQL

sed -i "s#^database.default.username.*#database.default.username = saripos_app#" /app/.env
sed -i "s#^database.default.password.*#database.default.password = ${APP_DB_PASSWORD}#" /app/.env

exec php spark serve --host 0.0.0.0 --port "${PORT}"
