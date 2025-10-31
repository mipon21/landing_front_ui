<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\DownloadSection;
use App\Models\FooterMenu;
use App\Models\HeaderMenu;
use App\Models\SocialLink;
use App\Models\HeroSection;
use App\Models\HowItWork;
use App\Models\RestaurantLogo;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Statistic;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $hero = HeroSection::getActive();
        $statistics = Statistic::active()->get();
        $restaurantLogos = RestaurantLogo::active()->get();
        $whyChooseUs = WhyChooseUs::active()->get();
        $dishes = Dish::active()->get();
        $services = Service::active()->get();
        $howItWorks = HowItWork::active()->get();
        $testimonials = Testimonial::active()->get();
        $downloadSection = DownloadSection::active()->download()->first();
        $registerSection = DownloadSection::active()->register()->first();
        $deliverymanSection = DownloadSection::active()->deliveryman()->first();
        $restaurantRegisterButton = [
            'text' => SiteSetting::getValue('restaurant_section_button_text', 'Register Your Restaurant'),
            'url' => SiteSetting::getValue('restaurant_section_button_url', '#'),
        ];
        $whyChooseUsFeatureImage = SiteSetting::getValue('why_choose_us_feature_image', null);
        $whyChooseUsSettings = [
            'badge_text' => SiteSetting::getValue('why_choose_us_badge_text', 'why use Appiq'),
            'heading' => SiteSetting::getValue('why_choose_us_heading', 'Why choose us'),
            'description' => SiteSetting::getValue('why_choose_us_description', 'Lorem Ipsum is simply dummy text of the printing and typese tting indus orem Ipsum has beenthe standard dummy.'),
        ];
        $dishesSectionButtons = [
            'google_play_url' => SiteSetting::getValue('dishes_section_google_play_url', null),
            'app_store_url' => SiteSetting::getValue('dishes_section_app_store_url', null),
            'show_google_play' => (bool) SiteSetting::getValue('dishes_section_show_google_play', '1'),
            'show_app_store' => (bool) SiteSetting::getValue('dishes_section_show_app_store', '1'),
        ];
        $howItWorksSettings = [
            'badge_text' => SiteSetting::getValue('how_it_works_badge_text', 'Easy Steps'),
            'heading' => SiteSetting::getValue('how_it_works_heading', 'How it Works'),
            'description' => SiteSetting::getValue('how_it_works_description', 'Lorem Ipsum is simply dummy text of the printing indus orem Ipsum has been the industrys standard dummy text ever since.'),
            'promotional_text' => SiteSetting::getValue('how_it_works_promotional_text', 'Get 50% off on your first order ! Grab it now.'),
            'bottom_image' => SiteSetting::getValue('how_it_works_bottom_image', null),
            'show_google_play' => (bool) SiteSetting::getValue('how_it_works_show_google_play', '1'),
            'show_app_store' => (bool) SiteSetting::getValue('how_it_works_show_app_store', '1'),
            'google_play_url' => SiteSetting::getValue('how_it_works_google_play_url', null),
            'app_store_url' => SiteSetting::getValue('how_it_works_app_store_url', null),
        ];

        // Header data
        $headerLogo = SiteSetting::getValue('header_logo', null);
        $headerMenus = HeaderMenu::topLevel()->active()->with(['children' => function($query) {
            $query->active();
        }])->orderBy('sort_order')->get();
        $headerCta = [
            'text' => SiteSetting::getValue('header_cta_text', '7 Days Free Trial'),
            'url' => SiteSetting::getValue('header_cta_url', '#'),
        ];

        // General site settings
        $siteName = SiteSetting::getValue('site_name', 'Food Delivery Mobile App Landing Page');
        $siteDescription = SiteSetting::getValue('site_description', 'Order your favorite meals with ease using our Food Delivery mobile app. Browse local restaurants, customize your order, and enjoy fast, reliable delivery straight to your door. Download now for convenient, delicious dining at your fingertips.');
        $siteFavicon = SiteSetting::getValue('site_favicon', null);

        // Footer settings
        $footerLogo = SiteSetting::getValue('footer_logo', null);
        $footerDetails = SiteSetting::getValue('footer_details', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem sum has been the industrys standard dummytext ever since the when an unknown printer took.');
        $footerQuickLinks = FooterMenu::ofType('quick_links')->active()->orderBy('sort_order')->get();
        $footerSupportMenus = FooterMenu::ofType('support')->active()->orderBy('sort_order')->get();
        $footerAppStoreButtons = [
            'app_store_url' => SiteSetting::getValue('footer_app_store_url', '#'),
            'google_play_url' => SiteSetting::getValue('footer_google_play_url', '#'),
            'show_app_store' => (bool) SiteSetting::getValue('footer_show_app_store', '1'),
            'show_google_play' => (bool) SiteSetting::getValue('footer_show_google_play', '1'),
        ];
        $footerSocialLinks = SocialLink::active()->orderBy('sort_order')->get();
        $footerCopyrightText = SiteSetting::getValue('footer_copyright_text', '© Copyrights %Y. All rights reserved.');

        // Pre-footer CTA settings
        $preFooterCta = [
            'heading' => SiteSetting::getValue('pre_footer_cta_heading', 'Need support?'),
            'description' => SiteSetting::getValue('pre_footer_cta_description', 'Lorem Ipsum is simply dummy text of the printing.'),
            'call_text' => SiteSetting::getValue('pre_footer_cta_call_text', 'Call us now'),
            'call_url' => SiteSetting::getValue('pre_footer_cta_call_url', 'tel:123-456-7890'),
            'show_call_button' => (bool) SiteSetting::getValue('pre_footer_cta_show_call', '1'),
            'email_text' => SiteSetting::getValue('pre_footer_cta_email_text', 'Email us'),
            'email_url' => SiteSetting::getValue('pre_footer_cta_email_url', 'mailto:someone@example.com'),
            'show_email_button' => (bool) SiteSetting::getValue('pre_footer_cta_show_email', '1'),
        ];

        return view('frontend.index', compact(
            'hero',
            'statistics',
            'restaurantLogos',
            'whyChooseUs',
            'dishes',
            'services',
            'howItWorks',
            'testimonials',
            'downloadSection',
            'registerSection',
            'deliverymanSection',
            'restaurantRegisterButton',
            'whyChooseUsFeatureImage',
            'whyChooseUsSettings',
            'dishesSectionButtons',
            'howItWorksSettings',
            'headerLogo',
            'headerMenus',
            'headerCta',
            'siteName',
            'siteDescription',
            'siteFavicon',
            'footerLogo',
            'footerDetails',
            'footerQuickLinks',
            'footerSupportMenus',
            'footerAppStoreButtons',
            'footerSocialLinks',
            'footerCopyrightText',
            'preFooterCta'
        ));
    }
}

