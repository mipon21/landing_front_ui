<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\DownloadSectionController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\HowItWorkController;
use App\Http\Controllers\Admin\RestaurantLogoController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\PrivacyPolicyController as AdminPrivacyPolicyController;
use App\Http\Controllers\Admin\TermsController as AdminTermsController;
use App\Http\Controllers\Admin\Settings\FooterController;
use App\Http\Controllers\Admin\Settings\GeneralSettingsController;
use App\Http\Controllers\Admin\Settings\HeaderController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PrivacyPolicyController;
use App\Http\Controllers\Frontend\TermsController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/index.html', [HomeController::class, 'index'])->name('home.html');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
Route::post('/contact-us/submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/newsletter/subscribe', [ContactController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy-policy');
Route::get('/terms-conditions', [TermsController::class, 'index'])->name('terms');

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
        Route::post('restaurant-logos/update-button', [RestaurantLogoController::class, 'updateButton'])->name('restaurant-logos.update-button');

        // Dishes
        Route::resource('dishes', DishController::class);
        Route::post('dishes/update-button-urls', [DishController::class, 'updateButtonUrls'])->name('dishes.update-button-urls');


        // Testimonials
        Route::resource('testimonials', TestimonialController::class);

        // Why Choose Us
        Route::resource('why-choose-us', WhyChooseUsController::class);
        Route::post('why-choose-us/update-feature-image', [WhyChooseUsController::class, 'updateFeatureImage'])->name('why-choose-us.update-feature-image');
        Route::delete('why-choose-us/delete-feature-image', [WhyChooseUsController::class, 'deleteFeatureImage'])->name('why-choose-us.delete-feature-image');
        Route::post('why-choose-us/update-section-settings', [WhyChooseUsController::class, 'updateSectionSettings'])->name('why-choose-us.update-section-settings');

        // Services
        Route::resource('services', ServiceController::class);

        // How It Works
        Route::resource('how-it-works', HowItWorkController::class);
        Route::post('how-it-works/update-section-settings', [HowItWorkController::class, 'updateSectionSettings'])->name('how-it-works.update-section-settings');
        Route::delete('how-it-works/delete-bottom-image', [HowItWorkController::class, 'deleteBottomImage'])->name('how-it-works.delete-bottom-image');

        // Download Sections
        Route::resource('download-sections', DownloadSectionController::class);

        // About Page
        Route::prefix('about-pages')->name('about-pages.')->group(function () {
            Route::get('/', [AboutPageController::class, 'index'])->name('index');
            Route::post('/update-overview', [AboutPageController::class, 'updateOverview'])->name('update-overview');
            Route::post('/update-statistics', [AboutPageController::class, 'updateStatistics'])->name('update-statistics');
            Route::post('/update-about-us', [AboutPageController::class, 'updateAboutUs'])->name('update-about-us');
            Route::post('/update-facts', [AboutPageController::class, 'updateFacts'])->name('update-facts');
            Route::post('/update-text-flow', [AboutPageController::class, 'updateTextFlow'])->name('update-text-flow');
            Route::post('/update-cta', [AboutPageController::class, 'updateCta'])->name('update-cta');
        });

        // Contact Page
        Route::prefix('contact-pages')->name('contact-pages.')->group(function () {
            Route::get('/', [ContactPageController::class, 'index'])->name('index');
            Route::post('/update-contact-info', [ContactPageController::class, 'updateContactInfo'])->name('update-contact-info');
            Route::post('/update-ticket-box', [ContactPageController::class, 'updateTicketBox'])->name('update-ticket-box');
            Route::post('/update-contact-form', [ContactPageController::class, 'updateContactForm'])->name('update-contact-form');
            Route::post('/update-map', [ContactPageController::class, 'updateMap'])->name('update-map');
        });

        // Privacy Policy
        Route::prefix('privacy-policy')->name('privacy-policy.')->group(function () {
            Route::get('/', [AdminPrivacyPolicyController::class, 'index'])->name('index');
            Route::post('/update', [AdminPrivacyPolicyController::class, 'update'])->name('update');
        });

        // Terms & Conditions
        Route::prefix('terms')->name('terms.')->group(function () {
            Route::get('/', [AdminTermsController::class, 'index'])->name('index');
            Route::post('/update', [AdminTermsController::class, 'update'])->name('update');
        });

        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            // Header Settings
            Route::prefix('header')->name('header.')->group(function () {
                Route::get('/', [HeaderController::class, 'index'])->name('index');
                Route::post('/update-logo', [HeaderController::class, 'updateLogo'])->name('update-logo');
                Route::get('/delete-logo', [HeaderController::class, 'deleteLogo'])->name('delete-logo');
                Route::post('/update-cta', [HeaderController::class, 'updateCtaButton'])->name('update-cta');
                Route::post('/menus', [HeaderController::class, 'storeMenu'])->name('store-menu');
                Route::put('/menus/{id}', [HeaderController::class, 'updateMenu'])->name('update-menu');
                Route::delete('/menus/{id}', [HeaderController::class, 'destroyMenu'])->name('destroy-menu');
            });

            // Footer Settings
            Route::prefix('footer')->name('footer.')->group(function () {
                Route::get('/', [FooterController::class, 'index'])->name('index');
                Route::post('/update-logo', [FooterController::class, 'updateLogo'])->name('update-logo');
                Route::get('/delete-logo', [FooterController::class, 'deleteLogo'])->name('delete-logo');
                Route::post('/update-details', [FooterController::class, 'updateDetails'])->name('update-details');
                Route::post('/update-pre-footer-cta', [FooterController::class, 'updatePreFooterCta'])->name('update-pre-footer-cta');
                Route::post('/update-app-store-buttons', [FooterController::class, 'updateAppStoreButtons'])->name('update-app-store-buttons');
                Route::post('/update-copyright', [FooterController::class, 'updateCopyrightText'])->name('update-copyright');
                Route::post('/update-newsletter-backend-url', [FooterController::class, 'updateNewsletterBackendUrl'])->name('update-newsletter-backend-url');
                Route::post('/menus', [FooterController::class, 'storeMenu'])->name('store-menu');
                Route::put('/menus/{id}', [FooterController::class, 'updateMenu'])->name('update-menu');
                Route::delete('/menus/{id}', [FooterController::class, 'destroyMenu'])->name('destroy-menu');
                Route::post('/social-links', [FooterController::class, 'storeSocialLink'])->name('store-social-link');
                Route::put('/social-links/{id}', [FooterController::class, 'updateSocialLink'])->name('update-social-link');
                Route::delete('/social-links/{id}', [FooterController::class, 'destroySocialLink'])->name('destroy-social-link');
            });

            // General Settings
            Route::prefix('general')->name('general.')->group(function () {
                Route::get('/', [GeneralSettingsController::class, 'index'])->name('index');
                Route::post('/update-favicon', [GeneralSettingsController::class, 'updateFavicon'])->name('update-favicon');
                Route::get('/delete-favicon', [GeneralSettingsController::class, 'deleteFavicon'])->name('delete-favicon');
                Route::post('/update-site-info', [GeneralSettingsController::class, 'updateSiteInfo'])->name('update-site-info');
            });
        });
    });
});
