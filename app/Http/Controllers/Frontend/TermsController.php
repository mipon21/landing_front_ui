<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FooterMenu;
use App\Models\HeaderMenu;
use App\Models\SocialLink;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        // Get header data (reusable)
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
        $siteDescription = SiteSetting::getValue('site_description', 'Order your favorite meals with ease using our Food Delivery mobile app.');
        $siteFavicon = SiteSetting::getValue('site_favicon', null);

        // Terms & Conditions content
        $content = SiteSetting::getValue('terms_conditions_content', '');

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

        return view('frontend.terms', compact(
            'headerLogo',
            'headerMenus',
            'headerCta',
            'siteName',
            'siteDescription',
            'siteFavicon',
            'content',
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
