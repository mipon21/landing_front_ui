# Landing Page CMS - Laravel Admin Panel

A complete Laravel-based content management system for managing all content sections of the food delivery landing page template.

## Features

- ✅ Admin authentication (login only, no registration)
- ✅ Hero Section management
- ✅ Statistics/Counters management
- ✅ Restaurant logos management
- ✅ Dishes gallery management
- ✅ Testimonials/Reviews management
- ✅ Blog posts management (with editor's choice feature)
- ✅ Image upload and management
- ✅ Sort ordering for all listable items
- ✅ Active/Inactive status toggle
- ✅ Modern, responsive admin interface

## Requirements

- PHP >= 8.1
- MySQL 5.7+ or MariaDB 10.3+
- Composer
- Web server (Apache/Nginx) or Laravel Sail

## Installation

### 1. Install Laravel Dependencies

```bash
composer install
```

### 2. Environment Setup

Copy `.env.example` to `.env`:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

### 3. Configure Database

Edit `.env` file and set your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=landing_cms
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Run Migrations

```bash
php artisan migrate
```

### 5. Seed Admin User

```bash
php artisan db:seed
```

This will create an admin user with:
- **Email:** admin@example.com
- **Password:** admin123

**⚠️ IMPORTANT:** Change the password immediately after first login!

### 6. Create Storage Link

```bash
php artisan storage:link
```

This creates a symbolic link from `storage/app/public` to `public/storage` for uploaded images.

### 7. Set Permissions (if on Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Usage

### Access Admin Panel

Navigate to: `http://your-domain.com/admin/login`

Login credentials:
- Email: `admin@example.com`
- Password: `admin123`

### Admin Panel Sections

#### 1. Dashboard
- Overview of content statistics
- Quick links to main sections

#### 2. Hero Section
- Manage hero banner content
- Typed text animation settings
- Hero images and backgrounds
- App store links and buttons

#### 3. Statistics
- Add/edit/delete statistics counters
- Set icons, values, suffixes, and labels
- Control sort order and visibility

#### 4. Restaurant Logos
- Manage restaurant partner logos
- Upload and organize logo images

#### 5. Dishes
- Manage dish gallery images
- Add dishes with images and descriptions

#### 6. Testimonials
- Add customer testimonials
- Upload customer images
- Set ratings and reviews

#### 7. Blog Posts
- Create and manage blog posts
- Featured images and content
- Editor's choice feature
- Published/Draft status

## Project Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Admin/          # Admin controllers
│   │   └── Middleware/         # Admin authentication middleware
│   └── Models/                  # Eloquent models
├── database/
│   ├── migrations/             # Database migrations
│   └── seeders/                # Database seeders
├── resources/
│   └── views/
│       └── admin/               # Admin panel views
├── routes/
│   └── web.php                  # Routes (admin routes included)
└── storage/
    └── app/
        └── public/              # Uploaded images
```

## Database Tables

- `admins` - Admin users
- `hero_sections` - Hero banner content
- `statistics` - Statistics counters
- `restaurant_logos` - Restaurant partner logos
- `dishes` - Dish gallery items
- `services` - Service sections (restaurant & customer)
- `how_it_works` - How it works steps
- `testimonials` - Customer testimonials
- `blog_posts` - Blog posts
- `faqs` - Frequently asked questions
- `team_members` - Team members
- `site_settings` - Site-wide settings
- `download_sections` - Download/Register sections
- `about_pages` - About page sections

## API Integration (Future)

To integrate with the frontend, you can create API routes that return JSON data:

```php
Route::get('/api/hero', function() {
    return HeroSection::getActive();
});

Route::get('/api/statistics', function() {
    return Statistic::active()->get();
});
```

Then update your frontend HTML to fetch and display dynamic content.

## Security Notes

1. **Change default admin password** immediately
2. **Use HTTPS** in production
3. **Set proper file permissions** on storage directories
4. **Validate all inputs** (already implemented)
5. **Use CSRF protection** (Laravel handles this automatically)
6. **Limit admin panel access** to specific IPs if needed

## Troubleshooting

### Images not displaying
- Ensure `php artisan storage:link` has been run
- Check file permissions on `storage/app/public`
- Verify `.env` has correct `APP_URL`

### Login not working
- Clear config cache: `php artisan config:clear`
- Clear session: `php artisan session:clear`
- Verify admin user exists in database

### 500 errors
- Check Laravel logs: `storage/logs/laravel.log`
- Ensure `.env` is properly configured
- Run `php artisan optimize:clear`

## Development

### Adding New Content Sections

1. Create migration: `php artisan make:migration create_new_section_table`
2. Create model: `php artisan make:model NewSection`
3. Create controller: `php artisan make:controller Admin/NewSectionController --resource`
4. Add routes in `routes/web.php`
5. Create views in `resources/views/admin/new-section/`

### Extending Admin Panel

The admin panel uses Bootstrap 5. You can customize:
- `resources/views/admin/layout.blade.php` - Main layout
- CSS can be added to the `<style>` tag in layout or via external file

## Support

For issues or questions, please check:
- Laravel documentation: https://laravel.com/docs
- Bootstrap documentation: https://getbootstrap.com/docs

## License

This project is open-sourced software licensed under the MIT license.

