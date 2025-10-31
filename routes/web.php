<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\DownloadSectionController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\HowItWorkController;
use App\Http\Controllers\Admin\RestaurantLogoController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/index.html', [HomeController::class, 'index'])->name('home.html');

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Hero Section
        Route::get('/hero', [HeroSectionController::class, 'edit'])->name('hero.edit');
        Route::put('/hero', [HeroSectionController::class, 'update'])->name('hero.update');

        // Statistics
        Route::resource('statistics', StatisticController::class);

        // Restaurant Logos
        Route::resource('restaurant-logos', RestaurantLogoController::class);

        // Dishes
        Route::resource('dishes', DishController::class);

        // Blog Posts
        Route::resource('blog', BlogPostController::class);

        // Testimonials
        Route::resource('testimonials', TestimonialController::class);

        // Why Choose Us
        Route::resource('why-choose-us', WhyChooseUsController::class);

        // Services
        Route::resource('services', ServiceController::class);

        // How It Works
        Route::resource('how-it-works', HowItWorkController::class);

        // Download Sections
        Route::resource('download-sections', DownloadSectionController::class);
    });
});
