# Deployment Guide for TastySo Landing Page

## Problem
Your Laravel application works on `localhost/landing/public/` but shows 404 on `https://tastyso.com/` or `https://tastyso.com/public/`.

## Root Cause
On shared hosting, the document root is typically set to `public_html`, but Laravel's entry point (`index.php`) is in the `public` subdirectory. The server doesn't know to look in the `public` folder.

## Solution

### Step 1: Upload the `.htaccess` file to `public_html` root
I've created a `.htaccess` file in your project root. This file needs to be uploaded to the **root of your `public_html` directory** on the live server.

**File location on live server:** `public_html/.htaccess`

This `.htaccess` will redirect all requests to the `public` directory automatically.

### Step 2: Verify file structure on live server
Your file structure should look like this:
```
public_html/
├── .htaccess          ← NEW FILE (upload this)
├── app/
├── bootstrap/
├── config/
├── public/
│   ├── .htaccess      ← Should already exist
│   ├── index.php      ← Should already exist
│   ├── css/
│   ├── js/
│   └── images/
├── routes/
├── storage/
├── vendor/
└── ... (other Laravel files)
```

### Step 3: Verify permissions
Ensure these permissions are set correctly:
- `.htaccess` files: `644` or `644`
- Directories: `755`
- Files: `644`

### Step 4: Check LiteSpeed configuration
Since you're using LiteSpeed Web Server, ensure:
1. **mod_rewrite is enabled** - This should be enabled by default, but verify with your hosting provider if issues persist.
2. **AllowOverride All** - Your hosting provider should have this configured, but if `.htaccess` isn't working, contact them.

### Step 5: Test the site
After uploading the `.htaccess` file:
1. Clear your browser cache
2. Visit `https://tastyso.com/` - should redirect to `https://tastyso.com/public/` and work
3. Visit `https://tastyso.com/public/` - should also work directly

### Alternative Solution (if .htaccess doesn't work)
If the `.htaccess` approach doesn't work on LiteSpeed, you have two options:

#### Option A: Change Document Root in cPanel
1. Log into cPanel
2. Go to **Domains** → **Addon Domains** or **Subdomains**
3. Find `tastyso.com` and change the document root from `public_html` to `public_html/public`
4. Save changes

#### Option B: Move public contents to root
Move all contents from `public_html/public/` to `public_html/` and update `index.php` paths:
- Change `__DIR__.'/../vendor/autoload.php'` to `__DIR__.'/vendor/autoload.php'`
- Change `__DIR__.'/../bootstrap/app.php'` to `__DIR__.'/bootstrap/app.php'`

**Note:** Option A is preferred as it's cleaner and doesn't require code changes.

## Troubleshooting

### Still getting 404?
1. **Check if `.htaccess` is in the correct location:** `public_html/.htaccess`
2. **Check file permissions:** Should be `644`
3. **Test with a simple redirect:** Add this to `public_html/.htaccess` temporarily:
   ```apache
   RewriteEngine On
   RewriteRule ^test$ /public/test.html [L]
   ```
   If this doesn't work, `.htaccess` might be disabled - contact your hosting provider.

### Getting 500 Internal Server Error?
- Check `.htaccess` syntax
- Check error logs in cPanel
- Verify mod_rewrite is enabled

### Assets (CSS/JS/Images) not loading?
- Ensure `APP_URL` in `.env` is set to `https://tastyso.com`
- Check that asset paths use relative URLs or the `asset()` helper

## Files to Upload
1. **`.htaccess`** (from project root) → Upload to `public_html/`
2. Ensure all other Laravel files are already uploaded

## Environment Configuration
Make sure your `.env` file on the live server has:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tastyso.com
```

Good luck with your deployment!

