#!/bin/bash

# Auto Deploy Script untuk Hostinger
# Script ini akan dijalankan setiap kali ada push ke GitHub

# Warna untuk output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Log file
LOG_FILE="/home/$(whoami)/deploy.log"
echo "$(date '+%Y-%m-%d %H:%M:%S') - Deploy started" >> "$LOG_FILE"

# Path ke project (sesuaikan dengan path di Hostinger)
PROJECT_PATH="/home/$(whoami)/public_html"
# Atau jika menggunakan subdomain:
# PROJECT_PATH="/home/$(whoami)/subdomain.domain.com"

# Path ke repository (jika menggunakan git clone)
REPO_PATH="$PROJECT_PATH"

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}Starting Auto Deploy${NC}"
echo -e "${GREEN}========================================${NC}"

# Masuk ke direktori project
cd "$REPO_PATH" || exit

# Backup database (optional)
# mysqldump -u username -p database_name > backup_$(date +%Y%m%d_%H%M%S).sql

# Pull latest changes dari GitHub
echo -e "${YELLOW}Pulling latest changes from GitHub...${NC}"
git fetch origin
git reset --hard origin/main  # atau origin/master jika menggunakan branch master
git pull origin main

# Install/Update dependencies
echo -e "${YELLOW}Installing dependencies...${NC}"
composer install --no-dev --optimize-autoloader --no-interaction

# Clear cache
echo -e "${YELLOW}Clearing cache...${NC}"
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run migrations
echo -e "${YELLOW}Running migrations...${NC}"
php artisan migrate --force

# Create storage link
echo -e "${YELLOW}Creating storage link...${NC}"
php artisan storage:link

# Optimize for production
echo -e "${YELLOW}Optimizing for production...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
echo -e "${YELLOW}Setting permissions...${NC}"
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chown -R $(whoami):$(whoami) storage
chown -R $(whoami):$(whoami) bootstrap/cache

# Restart PHP-FPM (jika diperlukan)
# sudo systemctl restart php8.2-fpm
# atau
# sudo service php8.2-fpm restart

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}Deploy completed successfully!${NC}"
echo -e "${GREEN}========================================${NC}"
echo "$(date '+%Y-%m-%d %H:%M:%S') - Deploy completed" >> "$LOG_FILE"

