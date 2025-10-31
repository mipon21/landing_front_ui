# Installation Guide

## Quick Start

### Step 1: Install Composer Dependencies
```bash
composer install
```

### Step 2: Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### Step 3: Configure Database
Edit `.env` file:
```env
DB_DATABASE=landing_cms
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 4: Run Migrations & Seed
```bash
php artisan migrate
php artisan db:seed
```

### Step 5: Create Storage Link
```bash
php artisan storage:link
```

### Step 6: Start Server
```bash
php artisan serve
```

### Step 7: Access Admin Panel
Visit: `http://localhost:8000/admin/login`

**Login Credentials:**
- Email: `admin@example.com`
- Password: `admin123`

## Detailed Setup

### For XAMPP (Windows)

1. **Move project to htdocs:**
   ```
   D:\xampp\htdocs\landing\
   ```

2. **Open terminal in project directory:**
   ```bash
   cd D:\xampp\htdocs\landing
   ```

3. **Run Composer:**
   ```bash
   composer install
   ```

4. **Create .env file:**
   - Copy `.env.example` to `.env`
   - Update database credentials:
     ```env
     DB_DATABASE=landing_cms
     DB_USERNAME=root
     DB_PASSWORD=
     ```

5. **Generate Key:**
   ```bash
   php artisan key:generate
   ```

6. **Create Database:**
   - Open phpMyAdmin: http://localhost/phpmyadmin
   - Create database: `landing_cms`

7. **Run Migrations:**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

8. **Create Storage Link:**
   ```bash
   php artisan storage:link
   ```

9. **Access Admin:**
   - Visit: `http://localhost/landing/public/admin/login`

### For Laravel Valet/Sail

```bash
# Valet
valet link landing
valet secure landing

# Sail
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```

## Post-Installation

1. **Change Admin Password:**
   - Login to admin panel
   - Or update directly in database/users table

2. **Configure APP_URL:**
   - In `.env`: `APP_URL=http://your-domain.com`

3. **Test Image Uploads:**
   - Try uploading an image in any section
   - Verify it appears in `storage/app/public/`

## Common Issues

**Issue:** "Class not found"
- Solution: Run `composer install`

**Issue:** "Storage link failed"
- Solution: Delete `public/storage` and run `php artisan storage:link` again

**Issue:** "Access denied for database"
- Solution: Check database credentials in `.env`

**Issue:** "404 on admin routes"
- Solution: Ensure `routes/web.php` is properly configured

