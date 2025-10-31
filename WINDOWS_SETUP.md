# Windows/XAMPP Setup Guide

## Prerequisites

### 1. Install Composer

Composer is required but not installed. Download and install it:

1. Go to: https://getcomposer.org/download/
2. Download **Composer-Setup.exe** (Windows Installer)
3. Run the installer
4. Make sure "Add to PATH" is checked during installation
5. Restart your terminal/PowerShell after installation

**Verify installation:**
```powershell
composer --version
```

### 2. Ensure PHP is in PATH

XAMPP PHP should be accessible. Add to PATH if needed:
- XAMPP PHP path: `C:\xampp\php`
- Add to System Environment Variables PATH

**Verify PHP:**
```powershell
php --version
```

## Installation Steps

### Step 1: Install Composer Dependencies

Open PowerShell in project directory (`D:\xampp\htdocs\landing`) and run:

```powershell
composer install
```

This will install all Laravel dependencies.

### Step 2: Create .env File

**Option A: Using PowerShell**
```powershell
Copy-Item .env.example .env
```

**Option B: Manual**
1. Open the project folder in File Explorer
2. Copy `.env.example` file
3. Rename the copy to `.env`

**Option C: Create new .env file**

Create a new file named `.env` in the root directory with this content:

```env
APP_NAME="Landing Admin"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost/landing/public

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
APP_MAINTENANCE_STORE=database

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=landing_cms
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Step 3: Generate Application Key

```powershell
php artisan key:generate
```

### Step 4: Create Database

1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Click "New" to create database
3. Database name: `landing_cms`
4. Collation: `utf8mb4_unicode_ci`
5. Click "Create"

**OR using MySQL command line:**
```sql
CREATE DATABASE landing_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 5: Update Database Credentials in .env

Edit `.env` file and update these lines if needed:
```env
DB_DATABASE=landing_cms
DB_USERNAME=root
DB_PASSWORD=          (leave empty if no password)
```

### Step 6: Run Migrations

```powershell
php artisan migrate
```

### Step 7: Seed Admin User

```powershell
php artisan db:seed
```

This creates an admin user:
- Email: `admin@example.com`
- Password: `admin123`

### Step 8: Create Storage Link

```powershell
php artisan storage:link
```

### Step 9: Set Directory Permissions (if needed)

If you get permission errors, ensure these directories are writable:
- `storage/`
- `bootstrap/cache/`

Right-click each folder → Properties → Security → Edit → Add "Everyone" with Full Control

## Access Admin Panel

### Option 1: Using XAMPP

1. Make sure Apache and MySQL are running in XAMPP Control Panel
2. Open browser: `http://localhost/landing/public/admin/login`

### Option 2: Using Laravel Built-in Server

```powershell
php artisan serve
```

Then open: `http://localhost:8000/admin/login`

## Default Login

- **Email:** admin@example.com
- **Password:** admin123

⚠️ **IMPORTANT:** Change password immediately after first login!

## Troubleshooting

### "Composer not recognized"

**Solution:** 
1. Install Composer from https://getcomposer.org/download/
2. Restart PowerShell/terminal after installation
3. Verify with: `composer --version`

### ".env.example not found"

**Solution:** 
The file is created. If you don't see it:
1. Show hidden files in File Explorer (View → Show → Hidden items)
2. Or create `.env` manually using the content above

### "PHP not recognized"

**Solution:**
1. Add XAMPP PHP to PATH:
   - Right-click "This PC" → Properties
   - Advanced System Settings → Environment Variables
   - Edit "Path" → Add: `C:\xampp\php`
   - Restart PowerShell

### "Access denied for database"

**Solution:**
1. Check MySQL is running in XAMPP
2. Verify database exists in phpMyAdmin
3. Check username/password in `.env` file
4. Default XAMPP MySQL: username=`root`, password=(empty)

### "Storage link failed"

**Solution:**
1. Delete `public/storage` folder if it exists
2. Run: `php artisan storage:link` again
3. Ensure `storage/app/public` directory exists

### Images not displaying

**Solution:**
1. Run: `php artisan storage:link`
2. Check `public/storage` folder exists
3. Verify images are in `storage/app/public/`

## Quick Reference Commands

```powershell
# Install dependencies
composer install

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Create storage link
php artisan storage:link

# Start development server
php artisan serve

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Need Help?

If you encounter any issues:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check error messages carefully
3. Verify all prerequisites are installed
4. Ensure XAMPP services are running

