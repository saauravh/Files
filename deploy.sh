#!/bin/bash

# =============================================
# MatrimonyLab - VPS Deployment Script
# =============================================
# Usage: chmod +x deploy.sh && ./deploy.sh
# =============================================

set -e

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

echo -e "${BLUE}=============================================${NC}"
echo -e "${BLUE}  MatrimonyLab - VPS Deployment Script${NC}"
echo -e "${BLUE}=============================================${NC}"
echo ""

# -------------------------------------------
# 1. CHECK PREREQUISITES
# -------------------------------------------
echo -e "${YELLOW}[1/10] Checking prerequisites...${NC}"

check_command() {
    if ! command -v $1 &> /dev/null; then
        echo -e "${RED}ERROR: $1 is not installed.${NC}"
        exit 1
    fi
}

check_command php
check_command composer
check_command mysql

PHP_VERSION=$(php -r 'echo PHP_MAJOR_VERSION.".".PHP_MINOR_VERSION;')
echo -e "${GREEN}  PHP Version: $PHP_VERSION${NC}"

if (( $(echo "$PHP_VERSION < 8.1" | bc -l) )); then
    echo -e "${RED}  ERROR: PHP 8.1+ is required.${NC}"
    exit 1
fi

echo -e "${GREEN}  ✓ All prerequisites met${NC}"
echo ""

# -------------------------------------------
# 2. DATABASE CONFIGURATION
# -------------------------------------------
echo -e "${YELLOW}[2/10] Database configuration...${NC}"

read -p "  Enter MySQL root username [root]: " DB_ROOT_USER
DB_ROOT_USER=${DB_ROOT_USER:-root}

read -s -p "  Enter MySQL root password: " DB_ROOT_PASS
echo ""

read -p "  Enter database name [matrimonylab]: " DB_NAME
DB_NAME=${DB_NAME:-matrimonylab}

read -p "  Enter database username [matrimonylab_user]: " DB_USER
DB_USER=${DB_USER:-matrimonylab_user}

read -s -p "  Enter database password: " DB_PASS
echo ""

if [ -z "$DB_PASS" ]; then
    DB_PASS=$(openssl rand -base64 16)
    echo -e "${GREEN}  Generated password: $DB_PASS${NC}"
fi

echo ""

# -------------------------------------------
# 3. CREATE DATABASE AND USER
# -------------------------------------------
echo -e "${YELLOW}[3/10] Creating database and user...${NC}"

mysql -u"$DB_ROOT_USER" -p"$DB_ROOT_PASS" -e "
    CREATE DATABASE IF NOT EXISTS \`$DB_NAME\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASS';
    GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO '$DB_USER'@'localhost';
    FLUSH PRIVILEGES;
" 2>/dev/null

echo -e "${GREEN}  ✓ Database '$DB_NAME' created${NC}"
echo -e "${GREEN}  ✓ User '$DB_USER' created${NC}"
echo ""

# -------------------------------------------
# 4. UPDATE .ENV FILE
# -------------------------------------------
echo -e "${YELLOW}[4/10] Updating .env file...${NC}"

APP_KEY=$(php -r "echo 'base64:'.base64_encode(random_bytes(32));")
APP_URL=$(hostname -f 2>/dev/null || echo "http://localhost")

ENV_FILE="core/.env"

if [ -f "$ENV_FILE" ]; then
    sed -i "s/^DB_CONNECTION=.*/DB_CONNECTION=mysql/" "$ENV_FILE"
    sed -i "s/^DB_HOST=.*/DB_HOST=127.0.0.1/" "$ENV_FILE"
    sed -i "s/^DB_PORT=.*/DB_PORT=3306/" "$ENV_FILE"
    sed -i "s/^DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" "$ENV_FILE"
    sed -i "s/^DB_USERNAME=.*/DB_USERNAME=$DB_USER/" "$ENV_FILE"
    sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=$DB_PASS/" "$ENV_FILE"
    sed -i "s/^APP_KEY=.*/APP_KEY=$APP_KEY/" "$ENV_FILE"
    sed -i "s|^APP_URL=.*|APP_URL=$APP_URL|" "$ENV_FILE"
else
    cp .env.example .env
    sed -i "s/^DB_CONNECTION=.*/DB_CONNECTION=mysql/" "$ENV_FILE"
    sed -i "s/^# DB_HOST=.*/DB_HOST=127.0.0.1/" "$ENV_FILE"
    sed -i "s/^# DB_PORT=.*/DB_PORT=3306/" "$ENV_FILE"
    sed -i "s/^# DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" "$ENV_FILE"
    sed -i "s/^# DB_USERNAME=.*/DB_USERNAME=$DB_USER/" "$ENV_FILE"
    sed -i "s/^# DB_PASSWORD=.*/DB_PASSWORD=$DB_PASS/" "$ENV_FILE"
    sed -i "s|^APP_URL=.*|APP_URL=$APP_URL|" "$ENV_FILE"
fi

echo -e "${GREEN}  ✓ .env file updated${NC}"
echo ""

# -------------------------------------------
# 5. INSTALL COMPOSER DEPENDENCIES
# -------------------------------------------
echo -e "${YELLOW}[5/10] Installing Composer dependencies...${NC}"

cd core
composer install --no-interaction --prefer-dist --optimize-autoloader
cd ..

echo -e "${GREEN}  ✓ Dependencies installed${NC}"
echo ""

# -------------------------------------------
# 6. RUN MIGRATIONS
# -------------------------------------------
echo -e "${YELLOW}[6/10] Running database migrations...${NC}"

cd core
php artisan migrate --force
cd ..

echo -e "${GREEN}  ✓ All migrations completed${NC}"
echo ""

# -------------------------------------------
# 7. RUN SEEDERS
# -------------------------------------------
echo -e "${YELLOW}[7/10] Running database seeders...${NC}"

cd core
php artisan db:seed --force
cd ..

echo -e "${GREEN}  ✓ All seeders completed${NC}"
echo ""

# -------------------------------------------
# 8. SET PERMISSIONS
# -------------------------------------------
echo -e "${YELLOW}[8/10] Setting file permissions...${NC}"

chmod -R 755 core/storage
chmod -R 755 core/bootstrap/cache
chmod -R 775 core/storage/framework
chmod -R 775 core/storage/logs
chmod -R 775 core/storage/app
chmod -R 775 core/bootstrap/cache

# Try to set proper ownership if www-data user exists
if id "www-data" &>/dev/null; then
    chown -R www-data:www-data core/storage core/bootstrap/cache
    echo -e "${GREEN}  ✓ Ownership set to www-data${NC}"
fi

echo -e "${GREEN}  ✓ Permissions configured${NC}"
echo ""

# -------------------------------------------
# 9. GENERATE APPLICATION KEY & CACHE
# -------------------------------------------
echo -e "${YELLOW}[9/10] Optimizing application...${NC}"

cd core
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache 2>/dev/null || true
cd ..

echo -e "${GREEN}  ✓ Application optimized${NC}"
echo ""

# -------------------------------------------
# 10. CREATE APACHE/NGINX CONFIG (OPTIONAL)
# -------------------------------------------
echo -e "${YELLOW}[10/10] Web server configuration...${NC}"

read -p "  Do you want to create an Apache VirtualHost? (y/n) [y]: " CREATE_VHOST
CREATE_VHOST=${CREATE_VHOST:-y}

if [ "$CREATE_VHOST" = "y" ] || [ "$CREATE_VHOST" = "Y" ]; then
    read -p "  Enter your domain name [localhost]: " DOMAIN
    DOMAIN=${DOMAIN:-localhost}

    PROJECT_DIR=$(pwd)

    cat > /etc/apache2/sites-available/matrimonylab.conf << EOF
<VirtualHost *:80>
    ServerName $DOMAIN
    DocumentRoot $PROJECT_DIR

    <Directory $PROJECT_DIR>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/matrimonylab-error.log
    CustomLog \${APACHE_LOG_DIR}/matrimonylab-access.log combined
</VirtualHost>
EOF

    a2ensite matrimonylab.conf 2>/dev/null || true
    a2enmod rewrite 2>/dev/null || true
    systemctl reload apache2 2>/dev/null || service apache2 reload 2>/dev/null || true

    echo -e "${GREEN}  ✓ Apache VirtualHost created for $DOMAIN${NC}"
fi

echo ""

# -------------------------------------------
# SUMMARY
# -------------------------------------------
echo -e "${BLUE}=============================================${NC}"
echo -e "${GREEN}  DEPLOYMENT COMPLETED SUCCESSFULLY!${NC}"
echo -e "${BLUE}=============================================${NC}"
echo ""
echo -e "  ${YELLOW}Admin Panel:${NC} ${APP_URL}/admin"
echo -e "  ${YELLOW}Admin User:${NC}  admin"
echo -e "  ${YELLOW}Admin Pass:${NC}  123456"
echo ""
echo -e "  ${YELLOW}Database:${NC}     $DB_NAME"
echo -e "  ${YELLOW}DB User:${NC}      $DB_USER"
echo -e "  ${YELLOW}DB Password:${NC}  $DB_PASS"
echo ""
echo -e "  ${YELLOW}Project Path:${NC} $(pwd)"
echo ""
echo -e "${RED}  IMPORTANT: Change the admin password immediately after first login!${NC}"
echo -e "${RED}  IMPORTANT: Save your database credentials somewhere safe!${NC}"
echo ""
