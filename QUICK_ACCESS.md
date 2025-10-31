# Quick Access Guide

## Start Laravel Server

### Option 1: Using Batch File (Easiest)
Double-click: **START_SERVER.bat**

### Option 2: Using PowerShell/Command Prompt
```powershell
php artisan serve
```

### Option 3: Using XAMPP (No server needed)
If XAMPP Apache is running:
```
http://localhost/landing/public/admin/login
```

---

## Admin Panel URLs

### With Laravel Server Running:
**http://localhost:8000/admin/login**

### With XAMPP Apache:
**http://localhost/landing/public/admin/login**

---

## Login Credentials

- **Email:** admin@example.com
- **Password:** admin123

---

## Important Notes

⚠️ **The Laravel server must be running** for `localhost:8000` to work!

If you see "ERR_CONNECTION_REFUSED":
- Start the server first: `php artisan serve`
- Or use XAMPP: `http://localhost/landing/public/admin/login`

---

## Troubleshooting

### Server won't start?
1. Check PHP is working: `php --version`
2. Check port 8000 is available
3. Try different port: `php artisan serve --port=8080`

### Still can't access?
1. Check XAMPP Apache is running
2. Use XAMPP URL instead: `http://localhost/landing/public/admin/login`

