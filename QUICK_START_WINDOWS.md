# 🚀 QUICK START - Windows/XAMPP

## ⚠️ Prerequisites First!

### 1. Install Composer (REQUIRED)

**You don't have Composer installed!** Install it first:

1. **Download Composer:**
   - Go to: https://getcomposer.org/download/
   - Download: **Composer-Setup.exe**

2. **Install:**
   - Run the installer
   - ✅ Check "Add to PATH" option
   - Complete installation

3. **Restart PowerShell/Terminal**

4. **Verify:**
   ```powershell
   composer --version
   ```

### 2. Verify PHP is Working

```powershell
php --version
```

If not working, add `C:\xampp\php` to your Windows PATH.

---

## ✅ Installation Steps

### Step 1: Install Laravel Dependencies

```powershell
# Make sure you're in: D:\xampp\htdocs\landing
cd D:\xampp\htdocs\landing

# Install Composer packages
composer install
```

**This may take 2-5 minutes** - downloading Laravel and all dependencies.

---

### Step 2: Create .env File

**Option A - PowerShell:**
```powershell
Copy-Item .env.example .env
```

**Option B - Manual:**
1. In File Explorer, go to `D:\xampp\htdocs\landing`
2. Copy `.env.example` file
3. Rename the copy to `.env` (without .example)

---

### Step 3: Generate Application Key

```powershell
php artisan key:generate
```

---

### Step 4: Create Database

1. **Start XAMPP:**
   - Open XAMPP Control Panel
   - Start **Apache** and **MySQL**

2. **Open phpMyAdmin:**
   - Go to: http://localhost/phpmyadmin

3. **Create Database:**
   - Click "New" on left sidebar
   - Database name: `landing_cms`
   - Collation: `utf8mb4_unicode_ci`
   - Click "Create"

---

### Step 5: Update .env File

Open `.env` file and verify these lines:

```env
DB_DATABASE=landing_cms
DB_USERNAME=root
DB_PASSWORD=          (leave empty if no MySQL password)
```

**XAMPP default:** username=`root`, password=(empty)

---

### Step 6: Run Database Migrations

```powershell
php artisan migrate
```

This creates all database tables.

---

### Step 7: Create Admin User

```powershell
php artisan db:seed
```

This creates default admin:
- Email: `admin@example.com`
- Password: `admin123`

---

### Step 8: Create Storage Link

```powershell
php artisan storage:link
```

This allows uploaded images to be accessible.

---

## 🎉 Access Admin Panel

### Using XAMPP:

1. Make sure **Apache** and **MySQL** are running
2. Open browser: **http://localhost/landing/public/admin/login**

### Using Laravel Server (Alternative):

```powershell
php artisan serve
```

Then open: **http://localhost:8000/admin/login**

---

## 🔐 Login Credentials

- **Email:** admin@example.com
- **Password:** admin123

⚠️ **CHANGE PASSWORD IMMEDIATELY** after first login!

---

## ❌ Troubleshooting

### "Composer not recognized"
- ✅ Install Composer first (see Prerequisites above)
- Restart PowerShell after installation

### ".env.example not found"
- ✅ I just created it - refresh your file explorer
- Or create `.env` manually with content from `.env.example`

### "Class 'X' not found"
- ✅ Run: `composer install` again

### "Access denied for database"
- ✅ Check MySQL is running in XAMPP
- ✅ Verify database `landing_cms` exists
- ✅ Check credentials in `.env` file

### "Storage link failed"
```powershell
# Delete existing link first
Remove-Item public\storage -ErrorAction SilentlyContinue

# Create new link
php artisan storage:link
```

---

## 📋 Complete Command List

Run these in order:

```powershell
# 1. Install dependencies
composer install

# 2. Create .env file
Copy-Item .env.example .env

# 3. Generate key
php artisan key:generate

# 4. Create database (via phpMyAdmin or manually)
# Database name: landing_cms

# 5. Run migrations
php artisan migrate

# 6. Seed admin user
php artisan db:seed

# 7. Create storage link
php artisan storage:link

# 8. Access admin panel
# http://localhost/landing/public/admin/login
```

---

## ✅ Verification Checklist

- [ ] Composer installed and working
- [ ] PHP command works
- [ ] XAMPP Apache running
- [ ] XAMPP MySQL running
- [ ] Database `landing_cms` created
- [ ] `.env` file exists
- [ ] `composer install` completed
- [ ] Migrations run successfully
- [ ] Admin user seeded
- [ ] Storage link created
- [ ] Can access login page

---

## 🆘 Still Having Issues?

1. **Check Laravel logs:** `storage\logs\laravel.log`
2. **Clear all caches:**
   ```powershell
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   ```
3. **Verify file permissions** on `storage` and `bootstrap/cache` folders
4. **Check error messages** carefully - they usually tell you what's wrong

---

**Good luck! 🍀**

