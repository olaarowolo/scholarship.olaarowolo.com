# Deployment Guide - Ola Arowolo Scholarship System

## Overview

This guide provides step-by-step instructions for deploying the Ola Arowolo Scholarship Management System to production environments, including shared hosting (cPanel), VPS servers, and cloud platforms.

---

## Table of Contents

1. [Prerequisites](#prerequisites)
2. [Shared Hosting Deployment (cPanel)](#shared-hosting-deployment-cpanel)
3. [VPS/Cloud Deployment](#vpscloud-deployment)
4. [Domain Configuration](#domain-configuration)
5. [SSL Certificate Setup](#ssl-certificate-setup)
6. [Environment Configuration](#environment-configuration)
7. [Database Setup](#database-setup)
8. [File Permissions](#file-permissions)
9. [Email Configuration](#email-configuration)
10. [Post-Deployment Tasks](#post-deployment-tasks)
11. [Troubleshooting](#troubleshooting)
12. [Maintenance](#maintenance)

---

## Prerequisites

### Required Software Versions

-   **PHP:** 8.2 or higher
-   **MySQL:** 5.7+ or MariaDB 10.3+
-   **Composer:** 2.0+
-   **Node.js:** 18.x or higher
-   **NPM:** 9.x or higher

### PHP Extensions Required

```
- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- PDO_MySQL
- Tokenizer
- XML
- cURL
- GD (for image processing)
- ZIP
```

### Server Requirements

-   Minimum 512MB RAM (1GB recommended)
-   At least 1GB free disk space
-   SSH access (for VPS/Cloud)
-   Git (recommended)

---

## Shared Hosting Deployment (cPanel)

### Step 1: Prepare Your Files

#### 1.1 Build Assets Locally

```bash
# On your local machine
cd /path/to/project

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install

# Build production assets
npm run build

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

#### 1.2 Create Deployment Package

```bash
# Create a ZIP file of your project
zip -r scholarship-app.zip . \
  -x "*.git*" \
  -x "node_modules/*" \
  -x "tests/*" \
  -x "*.env*" \
  -x "storage/logs/*"
```

### Step 2: Upload to Server

#### 2.1 Using cPanel File Manager

1. Log into cPanel
2. Navigate to **File Manager**
3. Go to your domain's root directory (usually `public_html`)
4. Upload `scholarship-app.zip`
5. Extract the ZIP file

#### 2.2 Using FTP

```bash
# Using FileZilla or similar FTP client
# Connect to your server
# Upload all files except .git, node_modules, .env
```

### Step 3: Setup Directory Structure

```bash
# SSH into your server (if available)
cd ~/public_html

# Move Laravel files one directory up
mv scholarship-app/* .
mv scholarship-app/.* .
rmdir scholarship-app

# The public directory should be your document root
# If your cPanel uses public_html as document root:
# Move contents of public/ to public_html/
```

#### Alternative: Subdomain Setup

```
domains/
├── scholarship.olaarowolo.com/        # Laravel root
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   └── vendor/
└── public_html/                       # Document root (points to public/)
    ├── index.php
    ├── .htaccess
    └── assets/
```

### Step 4: Configure Document Root

#### 4.1 Using cPanel Domain Settings

1. Go to **Domains** in cPanel
2. Click **Manage** next to your domain
3. Change **Document Root** to:
    ```
    /home/username/scholarship.olaarowolo.com/public
    ```
4. Save changes

#### 4.2 Update index.php

Edit `public/index.php` to point to correct paths:

```php
// Before
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// After (if needed)
require __DIR__.'/../../scholarship.olaarowolo.com/vendor/autoload.php';
$app = require_once __DIR__.'/../../scholarship.olaarowolo.com/bootstrap/app.php';
```

### Step 5: Create Database

#### 5.1 Using cPanel MySQL Wizard

1. Go to **MySQL Database Wizard**
2. Create database: `username_scholarship`
3. Create user: `username_dbuser`
4. Generate strong password
5. Grant ALL PRIVILEGES to user
6. Note down credentials

### Step 6: Environment Configuration

Create `.env` file in Laravel root:

```bash
cd ~/scholarship.olaarowolo.com
cp .env.example .env
nano .env  # or use File Manager editor
```

Configure `.env`:

```env
APP_NAME="Ola Arowolo Scholarship"
APP_ENV=production
APP_KEY=  # Will generate in next step
APP_DEBUG=false
APP_TIMEZONE=Africa/Lagos
APP_URL=https://scholarship.olaarowolo.com

LOG_CHANNEL=daily
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=username_scholarship
DB_USERNAME=username_dbuser
DB_PASSWORD=your_strong_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=oatutors@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=oatutors@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

SESSION_DRIVER=database
QUEUE_CONNECTION=database

FILESYSTEM_DISK=public
```

### Step 7: Run Artisan Commands

```bash
# If you have SSH access
php artisan key:generate
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
php artisan storage:link
```

#### Without SSH Access

Use cPanel **Terminal** or create a custom PHP script:

```php
<?php
// deploy.php - Place in public_html temporarily
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Run commands
$commands = [
    'key:generate',
    'config:cache',
    'route:cache',
    'view:cache',
    'migrate --force',
    'storage:link',
];

foreach ($commands as $command) {
    echo "Running: $command\n";
    $kernel->call($command);
    echo "Completed: $command\n\n";
}
```

Visit `https://scholarship.olaarowolo.com/deploy.php` then **DELETE** it immediately.

### Step 8: Set File Permissions

```bash
# Using SSH
cd ~/scholarship.olaarowolo.com

chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod 644 .env

# Or use cPanel File Manager
# Right-click folders → Change Permissions
# storage: 755
# bootstrap/cache: 755
```

### Step 9: Test Deployment

1. Visit `https://scholarship.olaarowolo.com`
2. Test registration
3. Test login
4. Test application submission
5. Check email functionality
6. Verify file uploads work

---

## VPS/Cloud Deployment

### Recommended Providers

-   **DigitalOcean** (Laravel-optimized droplets)
-   **AWS Lightsail** (Simple, affordable)
-   **Linode**
-   **Vultr**
-   **Azure** (For enterprise)

### Step 1: Server Provisioning

#### Using DigitalOcean (Recommended)

```bash
# Create a droplet
# - Ubuntu 22.04 LTS
# - 1GB RAM minimum (2GB recommended)
# - SSH key authentication
# - Managed database (optional)
```

### Step 2: Initial Server Setup

```bash
# SSH into your server
ssh root@your_server_ip

# Update system
apt update && apt upgrade -y

# Create application user
adduser laravel
usermod -aG sudo laravel

# Switch to application user
su - laravel
```

### Step 3: Install Required Software

#### Install PHP 8.2

```bash
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update

sudo apt install -y php8.2 \
  php8.2-cli \
  php8.2-fpm \
  php8.2-mysql \
  php8.2-mbstring \
  php8.2-xml \
  php8.2-bcmath \
  php8.2-curl \
  php8.2-gd \
  php8.2-zip \
  php8.2-intl
```

#### Install MySQL

```bash
sudo apt install mysql-server -y

# Secure MySQL installation
sudo mysql_secure_installation

# Create database
sudo mysql -u root -p
```

```sql
CREATE DATABASE scholarship_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'scholarship_user'@'localhost' IDENTIFIED BY 'strong_password_here';
GRANT ALL PRIVILEGES ON scholarship_db.* TO 'scholarship_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### Install Composer

```bash
cd ~
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer --version
```

#### Install Node.js & NPM

```bash
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs
node --version
npm --version
```

#### Install Nginx

```bash
sudo apt install nginx -y
sudo systemctl start nginx
sudo systemctl enable nginx
```

### Step 4: Deploy Application

#### Clone Repository

```bash
cd /var/www
sudo mkdir scholarship.olaarowolo.com
sudo chown -R laravel:laravel scholarship.olaarowolo.com
cd scholarship.olaarowolo.com

# Using Git (recommended)
git clone https://github.com/yourusername/scholarship.git .

# Or upload files via SCP
scp -r /local/path/* laravel@server_ip:/var/www/scholarship.olaarowolo.com/
```

#### Install Dependencies

```bash
cd /var/www/scholarship.olaarowolo.com

# PHP dependencies
composer install --optimize-autoloader --no-dev

# Node dependencies
npm install

# Build assets
npm run build
```

#### Configure Environment

```bash
cp .env.example .env
nano .env
```

Update `.env`:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://scholarship.olaarowolo.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=scholarship_db
DB_USERNAME=scholarship_user
DB_PASSWORD=strong_password_here

# ... other settings
```

#### Run Migrations

```bash
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 5: Configure Nginx

```bash
sudo nano /etc/nginx/sites-available/scholarship.olaarowolo.com
```

Add configuration:

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name scholarship.olaarowolo.com www.scholarship.olaarowolo.com;
    root /var/www/scholarship.olaarowolo.com/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Cache static assets
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

Enable site:

```bash
sudo ln -s /etc/nginx/sites-available/scholarship.olaarowolo.com /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### Step 6: Set Permissions

```bash
cd /var/www/scholarship.olaarowolo.com

sudo chown -R laravel:www-data .
sudo find . -type f -exec chmod 644 {} \;
sudo find . -type d -exec chmod 755 {} \;
sudo chmod -R 775 storage bootstrap/cache
```

### Step 7: Setup SSL with Let's Encrypt

```bash
sudo apt install certbot python3-certbot-nginx -y

sudo certbot --nginx -d scholarship.olaarowolo.com -d www.scholarship.olaarowolo.com

# Test auto-renewal
sudo certbot renew --dry-run
```

### Step 8: Setup Queue Worker (Optional)

```bash
sudo nano /etc/systemd/system/scholarship-queue.service
```

```ini
[Unit]
Description=Scholarship Queue Worker
After=network.target

[Service]
Type=simple
User=laravel
WorkingDirectory=/var/www/scholarship.olaarowolo.com
ExecStart=/usr/bin/php /var/www/scholarship.olaarowolo.com/artisan queue:work --sleep=3 --tries=3 --max-time=3600
Restart=always
RestartSec=5s

[Install]
WantedBy=multi-user.target
```

Enable and start:

```bash
sudo systemctl daemon-reload
sudo systemctl enable scholarship-queue
sudo systemctl start scholarship-queue
```

### Step 9: Setup Cron Jobs

```bash
crontab -e
```

Add:

```cron
* * * * * cd /var/www/scholarship.olaarowolo.com && php artisan schedule:run >> /dev/null 2>&1
```

---

## Domain Configuration

### DNS Settings

Point your domain to your server:

```
Type    Name                        Value                   TTL
A       scholarship.olaarowolo.com  your_server_ip          3600
A       www                         your_server_ip          3600
CNAME   www                         scholarship.olaarowolo.com  3600
```

### Verify DNS Propagation

```bash
dig scholarship.olaarowolo.com
nslookup scholarship.olaarowolo.com
```

---

## SSL Certificate Setup

### Using Let's Encrypt (Free)

Already covered in VPS deployment section.

### Using Custom SSL Certificate

```bash
# Upload certificate files
sudo mkdir /etc/nginx/ssl
sudo cp your-cert.crt /etc/nginx/ssl/
sudo cp your-key.key /etc/nginx/ssl/

# Update Nginx configuration
sudo nano /etc/nginx/sites-available/scholarship.olaarowolo.com
```

Add SSL configuration:

```nginx
server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name scholarship.olaarowolo.com;

    ssl_certificate /etc/nginx/ssl/your-cert.crt;
    ssl_certificate_key /etc/nginx/ssl/your-key.key;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;

    # ... rest of configuration
}

# Redirect HTTP to HTTPS
server {
    listen 80;
    server_name scholarship.olaarowolo.com;
    return 301 https://$server_name$request_uri;
}
```

---

## Environment Configuration

### Production .env Settings

```env
# Application
APP_NAME="Ola Arowolo Scholarship"
APP_ENV=production
APP_KEY=base64:generated_key_here
APP_DEBUG=false
APP_TIMEZONE=Africa/Lagos
APP_URL=https://scholarship.olaarowolo.com

# Logging
LOG_CHANNEL=daily
LOG_LEVEL=error
LOG_DEPRECATIONS_CHANNEL=null

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=scholarship_db
DB_USERNAME=scholarship_user
DB_PASSWORD=secure_password

# Cache & Session
CACHE_STORE=database
QUEUE_CONNECTION=database
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=oatutors@gmail.com
MAIL_PASSWORD=app_specific_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=oatutors@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

# Storage
FILESYSTEM_DISK=public

# Security
SESSION_SECURE_COOKIE=true
SANCTUM_STATEFUL_DOMAINS=scholarship.olaarowolo.com
```

### Environment Security

```bash
# Protect .env file
chmod 600 .env
```

---

## Database Setup

### Run Migrations

```bash
php artisan migrate --force
```

### Seed Initial Data (Optional)

```bash
php artisan db:seed
```

### Database Backups

#### Automated Backup Script

```bash
#!/bin/bash
# /home/laravel/backup-db.sh

DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/home/laravel/backups"
DB_NAME="scholarship_db"
DB_USER="scholarship_user"
DB_PASS="your_password"

mkdir -p $BACKUP_DIR

mysqldump -u $DB_USER -p$DB_PASS $DB_NAME | gzip > $BACKUP_DIR/scholarship_$DATE.sql.gz

# Keep only last 30 days
find $BACKUP_DIR -name "scholarship_*.sql.gz" -mtime +30 -delete
```

Make executable and schedule:

```bash
chmod +x /home/laravel/backup-db.sh

# Add to crontab
crontab -e
# Add line:
0 2 * * * /home/laravel/backup-db.sh
```

---

## File Permissions

### Correct Permissions

```bash
# Application owner
sudo chown -R laravel:www-data /var/www/scholarship.olaarowolo.com

# Directory permissions
sudo find /var/www/scholarship.olaarowolo.com -type d -exec chmod 755 {} \;

# File permissions
sudo find /var/www/scholarship.olaarowolo.com -type f -exec chmod 644 {} \;

# Writable directories
sudo chmod -R 775 /var/www/scholarship.olaarowolo.com/storage
sudo chmod -R 775 /var/www/scholarship.olaarowolo.com/bootstrap/cache

# Secure .env
sudo chmod 600 /var/www/scholarship.olaarowolo.com/.env
```

---

## Email Configuration

### Gmail App Password Setup

1. Go to Google Account settings
2. Enable 2-Factor Authentication
3. Generate App Password:
    - Go to Security → App passwords
    - Select "Mail" and "Other"
    - Generate password
    - Use in `.env` file

### Test Email Configuration

```bash
php artisan tinker
```

```php
Mail::raw('Test email', function($message) {
    $message->to('your-email@example.com')->subject('Test');
});
```

---

## Post-Deployment Tasks

### 1. Security Checklist

-   [ ] Set `APP_DEBUG=false`
-   [ ] Set strong `APP_KEY`
-   [ ] Configure firewall (UFW)
-   [ ] Disable unnecessary PHP functions
-   [ ] Set up fail2ban
-   [ ] Enable HTTPS only
-   [ ] Secure file permissions
-   [ ] Remove deployment scripts

### 2. Performance Optimization

```bash
# Cache configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize Composer autoloader
composer dump-autoload --optimize

# Enable OPcache
sudo nano /etc/php/8.2/fpm/php.ini
```

Add:

```ini
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=10000
opcache.revalidate_freq=2
```

### 3. Monitoring Setup

```bash
# Install monitoring tools
sudo apt install htop iotop -y

# Setup Laravel Telescope (development)
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate
```

### 4. Backup Strategy

-   [ ] Database backups (daily)
-   [ ] File backups (weekly)
-   [ ] Off-site backup storage
-   [ ] Test restoration process

### 5. Create Admin Account

```bash
php artisan tinker
```

```php
$user = new App\Models\User();
$user->name = 'Admin User';
$user->email = 'oa@olaarowolo.com';
$user->password = Hash::make('secure_password');
$user->role = 'admin';
$user->email_verified_at = now();
$user->terms_accepted_at = now();
$user->save();
```

---

## Troubleshooting

### Common Issues

#### 1. 500 Internal Server Error

```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Check Nginx error logs
sudo tail -f /var/log/nginx/error.log

# Check PHP-FPM logs
sudo tail -f /var/log/php8.2-fpm.log
```

**Solutions:**

-   Check file permissions
-   Clear cached configs: `php artisan config:clear`
-   Verify `.env` settings
-   Check database connection

#### 2. File Upload Issues

```bash
# Check storage permissions
ls -la storage/app/public

# Recreate symbolic link
rm public/storage
php artisan storage:link
```

#### 3. Email Not Sending

```bash
# Test mail configuration
php artisan tinker
Mail::raw('test', fn($m) => $m->to('test@example.com')->subject('Test'));

# Check logs
tail -f storage/logs/laravel.log
```

**Solutions:**

-   Verify SMTP credentials
-   Check firewall allows port 587
-   Use app-specific password for Gmail

#### 4. Database Connection Failed

```bash
# Test MySQL connection
mysql -u scholarship_user -p scholarship_db

# Check MySQL service
sudo systemctl status mysql
```

#### 5. Assets Not Loading

```bash
# Rebuild assets
npm run build

# Clear cache
php artisan cache:clear
php artisan view:clear

# Check file permissions
ls -la public/build/
```

### Debug Mode (Temporarily)

```bash
# Enable debug temporarily
php artisan down --secret="debug-secret-key"
# Edit .env: APP_DEBUG=true
php artisan config:clear

# Visit: https://scholarship.olaarowolo.com/debug-secret-key

# After debugging
# Edit .env: APP_DEBUG=false
php artisan config:cache
php artisan up
```

---

## Maintenance

### Regular Maintenance Tasks

#### Daily

-   Monitor logs for errors
-   Check application performance
-   Verify email delivery

#### Weekly

-   Review application submissions
-   Check disk space
-   Review failed jobs queue

#### Monthly

-   Update dependencies (if needed)
-   Database optimization
-   Security audit
-   Backup verification

### Update Deployment

```bash
# Pull latest changes
cd /var/www/scholarship.olaarowolo.com
git pull origin main

# Update dependencies
composer install --no-dev --optimize-autoloader
npm install
npm run build

# Run migrations
php artisan migrate --force

# Clear and rebuild caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Restart services
sudo systemctl restart php8.2-fpm
sudo systemctl reload nginx
sudo systemctl restart scholarship-queue
```

### Zero-Downtime Deployment

```bash
# Enable maintenance mode
php artisan down --retry=60

# Deploy updates
# ... (commands above)

# Bring site back up
php artisan up
```

---

## Monitoring & Alerts

### Setup Log Monitoring

```bash
# Install logwatch
sudo apt install logwatch -y

# Configure email alerts
sudo nano /etc/logwatch/conf/logwatch.conf
```

### Application Monitoring

Consider using:

-   **Laravel Telescope** (development)
-   **Sentry** (error tracking)
-   **New Relic** (APM)
-   **Uptime Robot** (availability monitoring)

---

## Security Hardening

### Firewall Configuration

```bash
# Install UFW
sudo apt install ufw -y

# Allow SSH, HTTP, HTTPS
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp

# Enable firewall
sudo ufw enable
sudo ufw status
```

### Fail2Ban Setup

```bash
# Install fail2ban
sudo apt install fail2ban -y

# Configure
sudo cp /etc/fail2ban/jail.conf /etc/fail2ban/jail.local
sudo nano /etc/fail2ban/jail.local

# Start service
sudo systemctl start fail2ban
sudo systemctl enable fail2ban
```

---

## Rollback Procedure

### Quick Rollback

```bash
# Checkout previous version
git log --oneline
git checkout <previous-commit-hash>

# Restore dependencies
composer install
npm install && npm run build

# Rollback migrations (if needed)
php artisan migrate:rollback

# Clear caches
php artisan config:cache
php artisan route:cache

# Restart services
sudo systemctl restart php8.2-fpm
```

---

## Support & Documentation

### Additional Resources

-   Laravel Documentation: https://laravel.com/docs
-   Deployment Guide: https://laravel.com/docs/deployment
-   Server Setup: https://forge.laravel.com/docs

### Getting Help

-   **Email:** scholarship@olaarowolo.com
-   **Technical:** oatutors@gmail.com

---

## Deployment Checklist

### Pre-Deployment

-   [ ] All tests passing
-   [ ] Dependencies updated
-   [ ] Assets built
-   [ ] Environment configured
-   [ ] Database backed up

### Deployment

-   [ ] Files uploaded/pulled
-   [ ] Dependencies installed
-   [ ] Migrations run
-   [ ] Caches cleared and rebuilt
-   [ ] Permissions set
-   [ ] SSL configured

### Post-Deployment

-   [ ] Application accessible
-   [ ] Registration works
-   [ ] Login works
-   [ ] File uploads work
-   [ ] Emails sending
-   [ ] Admin access verified
-   [ ] Backups scheduled
-   [ ] Monitoring active

---

**Last Updated:** December 6, 2025  
**Version:** 1.0.0
