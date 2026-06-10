#!/usr/bin/env bash
#
# Развёртывание сайта «Космос Детейлинг» на Evolution CMS 3 с нуля.
# Запускать на чистом Ubuntu/Debian-сервере от root:
#
#   git clone https://github.com/zif91/cosmo-_det.git /opt/cosmo-src
#   bash /opt/cosmo-src/deploy/install.sh
#
# Все параметры можно переопределить переменными окружения, например:
#   SITE_URL=https://kosmos-detail.ru ADMIN_PASSWORD=secret bash deploy/install.sh
#
set -euo pipefail

# head обрывает pipe (SIGPIPE у tr) — без обёртки pipefail валит скрипт
genpass() { (tr -dc 'A-Za-z0-9' </dev/urandom | head -c "${1:-20}") 2>/dev/null || true; }

# ---------------- параметры ----------------
REPO_DIR="${REPO_DIR:-$(cd "$(dirname "$0")/.." && pwd)}"
SITE_DIR="${SITE_DIR:-/var/www/kosmos}"
SITE_URL="${SITE_URL:-}"                    # пусто = http://<ip сервера>
DB_NAME="${DB_NAME:-kosmos}"
DB_USER="${DB_USER:-kosmos}"
DB_PASS="${DB_PASS:-$(genpass 20)}"
DB_PREFIX="${DB_PREFIX:-evo_}"
ADMIN_USER="${ADMIN_USER:-admin}"
ADMIN_EMAIL="${ADMIN_EMAIL:-info@kosmos-detail.ru}"
ADMIN_PASSWORD="${ADMIN_PASSWORD:-$(genpass 14)}"
EVO_REPO="${EVO_REPO:-https://github.com/evocms-community/evolution.git}"
PB_REPO="${PB_REPO:-https://github.com/evocms-community/pagebuilder.git}"
CS_REPO="${CS_REPO:-https://github.com/evocms-community/clientsettings.git}"

echo "==> Установка пакетов"
export DEBIAN_FRONTEND=noninteractive
apt-get update -qq
apt-get install -y -qq nginx mariadb-server git unzip curl composer \
    php-fpm php-mysql php-mbstring php-xml php-gd php-curl php-zip php-intl php-bcmath >/dev/null

PHP_VER="$(php -r 'echo PHP_MAJOR_VERSION.".".PHP_MINOR_VERSION;')"
PHP_SOCK="/run/php/php${PHP_VER}-fpm.sock"
systemctl enable --now mariadb nginx "php${PHP_VER}-fpm"

if [ -z "$SITE_URL" ]; then
    SITE_URL="http://$(curl -fsS4 ifconfig.me 2>/dev/null || hostname -I | awk '{print $1}')"
fi
SERVER_NAME="$(echo "$SITE_URL" | sed -E 's~https?://~~; s~/.*$~~')"

echo "==> База данных ${DB_NAME}"
mysql -e "CREATE DATABASE IF NOT EXISTS \`${DB_NAME}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci;"
mysql -e "CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';"
mysql -e "GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '${DB_USER}'@'localhost'; FLUSH PRIVILEGES;"

echo "==> Evolution CMS -> ${SITE_DIR}"
if [ ! -d "${SITE_DIR}/core" ]; then
    git clone --depth 1 "$EVO_REPO" "$SITE_DIR"
fi

if [ -d "${SITE_DIR}/install" ]; then
    echo "==> Установка Evolution CMS (cli)"
    cd "${SITE_DIR}/install"
    php cli-install.php \
        --typeInstall=1 \
        --databaseType=mysql \
        --databaseServer=localhost \
        --database="$DB_NAME" \
        --databaseUser="$DB_USER" \
        --databasePassword="$DB_PASS" \
        --tablePrefix="$DB_PREFIX" \
        --cmsAdmin="$ADMIN_USER" \
        --cmsAdminEmail="$ADMIN_EMAIL" \
        --cmsPassword="$ADMIN_PASSWORD" \
        --language=ru \
        --removeInstall=y
fi

cd "${SITE_DIR}"   # cli-install с --removeInstall=y удаляет текущий каталог .../install
echo "==> PageBuilder + ClientSettings (файлы)"
TMP="$(mktemp -d)"
git clone -q --depth 1 "$PB_REPO" "$TMP/pb"
git clone -q --depth 1 "$CS_REPO" "$TMP/cs"
mkdir -p "${SITE_DIR}/assets/plugins" "${SITE_DIR}/assets/modules"
cp -r "$TMP/pb/assets/plugins/pagebuilder" "${SITE_DIR}/assets/plugins/"
rm -f "${SITE_DIR}/assets/plugins/pagebuilder/config/"*.php
cp -r "$TMP/cs/assets/modules/clientsettings" "${SITE_DIR}/assets/modules/"
rm -f "${SITE_DIR}/assets/modules/clientsettings/config/"*.sample
rm -rf "$TMP"

echo "==> Файлы сайта (overlay из репозитория)"
cp -r "${REPO_DIR}/cms/views" "${SITE_DIR}/"
cp -r "${REPO_DIR}/cms/assets/." "${SITE_DIR}/assets/"
cp -r "${REPO_DIR}/cms/core/." "${SITE_DIR}/core/"
mkdir -p "${SITE_DIR}/assets/css" "${SITE_DIR}/assets/js" "${SITE_DIR}/assets/img"
cp -r "${REPO_DIR}/assets/css/." "${SITE_DIR}/assets/css/"
cp -r "${REPO_DIR}/assets/js/."  "${SITE_DIR}/assets/js/"
cp -r "${REPO_DIR}/assets/img/." "${SITE_DIR}/assets/img/"
cat > "${SITE_DIR}/robots.txt" <<ROBOTS
User-agent: *
Allow: /
Disallow: /manager/
Disallow: /assets/photos/

Sitemap: ${SITE_URL}/sitemap.xml
ROBOTS

echo "==> Composer-автозагрузка custom-пакета"
cd "${SITE_DIR}/core"
php -r '$f="composer.json";$j=json_decode(file_get_contents($f),true);$j["autoload"]["psr-4"]["EvolutionCMS\\Main\\"]="custom/packages/main/src/";file_put_contents($f,json_encode($j,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));'
composer dump-autoload --no-interaction --quiet || composer dump-autoload --no-interaction

echo "==> Миграции (структура, контент, плагины)"
php artisan migrate --force

php artisan view:clear >/dev/null 2>&1 || true
php artisan cache:clear >/dev/null 2>&1 || true
rm -rf "${SITE_DIR}/assets/cache/"* 2>/dev/null || true

echo "==> Настройка site_url"
mysql "$DB_NAME" -e "REPLACE INTO ${DB_PREFIX}system_settings (setting_name, setting_value) VALUES ('site_url', '${SITE_URL}/');"

echo "==> Права"
chown -R www-data:www-data "$SITE_DIR"
find "$SITE_DIR" -type d -exec chmod 755 {} +
find "$SITE_DIR" -type f -exec chmod 644 {} +

echo "==> Nginx"
cat > /etc/nginx/sites-available/kosmos <<NGINX
server {
    listen 80;
    server_name ${SERVER_NAME} _;
    root ${SITE_DIR};
    index index.php;

    client_max_body_size 32m;
    charset utf-8;

    location ~* \.(jpg|jpeg|png|gif|webp|svg|css|js|woff2?|ttf|ico)\$ {
        expires 30d;
        access_log off;
        try_files \$uri =404;
    }

    location /manager/ {
        try_files \$uri \$uri/ /manager/index.php?\$args;
    }

    location / {
        try_files \$uri \$uri/ @evo;
    }

    location @evo {
        rewrite ^/(.*)\$ /index.php?q=\$1&\$args last;
    }

    location ~ \.php\$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:${PHP_SOCK};
        fastcgi_read_timeout 120;
    }

    location ~ /\.(ht|env|git) { deny all; }
    location ^~ /core/ { deny all; }
}
NGINX
ln -sf /etc/nginx/sites-available/kosmos /etc/nginx/sites-enabled/kosmos
rm -f /etc/nginx/sites-enabled/default
nginx -t && systemctl reload nginx

echo
echo "=================================================================="
echo "Готово!"
echo "Сайт:    ${SITE_URL}/"
echo "Админка: ${SITE_URL}/manager/  (логин: ${ADMIN_USER}, пароль: ${ADMIN_PASSWORD})"
echo "БД:      ${DB_NAME} / ${DB_USER} / ${DB_PASS} (prefix ${DB_PREFIX})"
echo "=================================================================="
