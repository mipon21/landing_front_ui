<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FooterMenu;
use App\Models\HeaderMenu;
use App\Models\SocialLink;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
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

        // Contact page sections
        $contactInfo = [
            'heading' => SiteSetting::getValue('contact_info_heading', 'Contact informations'),
            'description' => SiteSetting::getValue('contact_info_description', 'Get in touch with us.'),
            'email' => SiteSetting::getValue('contact_info_email', 'support@gmail.com'),
            'phone' => SiteSetting::getValue('contact_info_phone', '+1 (456) 125-45-678'),
            'address' => SiteSetting::getValue('contact_info_address', 'Fincop Ltd. 185, Finance Hub, Chikago, USA 4647'),
        ];

        $ticketBox = [
            'heading' => SiteSetting::getValue('contact_ticket_heading', 'Generate Ticket'),
            'description' => SiteSetting::getValue('contact_ticket_description', 'Need support for our application, service, payment or company, Please generate ticket.'),
            'button_text' => SiteSetting::getValue('contact_ticket_button_text', 'Generate Ticket Now'),
            'button_url' => SiteSetting::getValue('contact_ticket_button_url', '#'),
        ];

                $contactForm = [
                    'heading' => SiteSetting::getValue('contact_form_heading', 'Message us'),
                    'description' => SiteSetting::getValue('contact_form_description', 'Fill up form below, our team will get back soon'),
                    'iframe_url' => SiteSetting::getValue('contact_form_iframe_url', ''),
                    'backend_url' => SiteSetting::getValue('contact_form_backend_url', 'https://tastyso.com/contact-us'),
                ];

        $map = [
            'iframe_url' => SiteSetting::getValue('contact_map_iframe_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.2799160891!2d-74.25987584510595!3d40.69767006338158!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1664399300741!5m2!1sen!2sin'),
        ];

        $cta = [
            'heading' => SiteSetting::getValue('contact_cta_heading', 'Need support?'),
            'description' => SiteSetting::getValue('contact_cta_description', 'Lorem Ipsum is simply dummy text of the printing.'),
            'call_text' => SiteSetting::getValue('contact_cta_call_text', 'Call us now'),
            'call_url' => SiteSetting::getValue('contact_cta_call_url', 'tel:123-456-7890'),
            'email_text' => SiteSetting::getValue('contact_cta_email_text', 'Email us'),
            'email_url' => SiteSetting::getValue('contact_cta_email_url', 'mailto:someone@example.com'),
        ];

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

        return view('frontend.contact', compact(
            'headerLogo',
            'headerMenus',
            'headerCta',
            'siteName',
            'siteDescription',
            'siteFavicon',
            'contactInfo',
            'ticketBox',
            'contactForm',
            'map',
            'cta',
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

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Get backend URL from settings
            $backendUrl = SiteSetting::getValue('contact_form_backend_url', 'https://tastyso.com/contact-us');
            
            // Submit form data to external URL
            // Use Guzzle directly if Http facade is not available
            $client = new \GuzzleHttp\Client([
                'timeout' => 15,
                'verify' => false, // Disable SSL verification if needed
                'cookies' => true, // Enable cookies to maintain session
            ]);
            
            // First, GET the contact page to get the CSRF token
            $getResponse = $client->get($backendUrl, [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                ],
            ]);
            
            $html = (string) $getResponse->getBody();
            
            // Extract CSRF token from the page
            $csrfToken = null;
            // Try to find CSRF token in meta tag
            if (preg_match('/<meta name="csrf-token" content="([^"]+)"/', $html, $matches)) {
                $csrfToken = $matches[1];
            }
            // Try to find CSRF token in hidden input field
            elseif (preg_match('/<input[^>]*name="_token"[^>]*value="([^"]+)"/', $html, $matches)) {
                $csrfToken = $matches[1];
            }
            // Try to find CSRF token in XSRF-TOKEN cookie
            elseif (preg_match('/XSRF-TOKEN=([^;]+)/', $getResponse->getHeaderLine('Set-Cookie'), $matches)) {
                $csrfToken = urldecode($matches[1]);
            }
            
            // Prepare form data
            $formData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'message' => $validated['message'],
            ];
            
            // Add CSRF token if found
            if ($csrfToken) {
                $formData['_token'] = $csrfToken;
            }
            
            // Submit the form
            $response = $client->post($backendUrl, [
                'form_params' => $formData,
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                    'Referer' => $backendUrl,
                    'Origin' => parse_url($backendUrl, PHP_URL_SCHEME) . '://' . parse_url($backendUrl, PHP_URL_HOST),
                ],
                'allow_redirects' => true,
            ]);
            
            $statusCode = $response->getStatusCode();
            $body = (string) $response->getBody();

            // Check for common success indicators in the response
            $successIndicators = ['success', 'thank you', 'sent', 'submitted'];
            $isSuccess = false;
            foreach ($successIndicators as $indicator) {
                if (stripos($body, $indicator) !== false) {
                    $isSuccess = true;
                    break;
                }
            }

            // Consider 2xx and 3xx status codes as potential success
            if ($isSuccess || in_array($statusCode, [200, 201, 202, 302, 303])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you! Your message has been submitted successfully.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to submit your message. Please try again later.'
                ], 500);
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Log Guzzle-specific errors
            $errorMessage = $e->getMessage();
            if ($e->hasResponse()) {
                $errorMessage .= ' | Status: ' . $e->getResponse()->getStatusCode();
                $errorMessage .= ' | Body: ' . substr((string)$e->getResponse()->getBody(), 0, 200);
            }
            Log::error('Contact form submission error (Guzzle): ' . $errorMessage);
            
            return response()->json([
                'success' => false,
                'message' => 'Unable to connect to the contact form server. Please try again later.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Contact form submission error: ' . $e->getMessage());
            Log::error('File: ' . $e->getFile() . ' | Line: ' . $e->getLine());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting your message. Please try again later.',
                'error' => config('app.debug') ? $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() : null
            ], 500);
        }
    }

    public function subscribeNewsletter(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        try {
            // Get backend URL from settings
            $backendUrl = SiteSetting::getValue('newsletter_backend_url', 'https://tastyso.com/newsletter');
            $baseUrl = parse_url($backendUrl, PHP_URL_SCHEME) . '://' . parse_url($backendUrl, PHP_URL_HOST);
            
            // Submit newsletter subscription to external URL
            $client = new \GuzzleHttp\Client([
                'timeout' => 15,
                'verify' => false, // Disable SSL verification if needed
                'cookies' => true, // Enable cookies to maintain session
            ]);
            
            // First, GET the newsletter page to get the CSRF token and form action
            $getResponse = $client->get($backendUrl, [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                ],
            ]);
            
            $html = (string) $getResponse->getBody();
            
            // Extract form action URL from the page - check both form action and JavaScript fetch/axios calls
            $formAction = null;
            
            // First, check for form action attribute
            if (preg_match('/<form[^>]*action=["\']([^"\']+)["\']/', $html, $matches)) {
                $action = $matches[1];
                if (strpos($action, 'http') === 0) {
                    $formAction = $action;
                } else {
                    $formAction = $baseUrl . (strpos($action, '/') === 0 ? $action : '/' . $action);
                }
            }
            
            // If no form action found, check for JavaScript fetch/AJAX endpoints
            if (!$formAction) {
                // Try to find fetch/axios/AJAX calls in JavaScript
                if (preg_match('/fetch\(["\']([^"\']*newsletter[^"\']*)["\']/', $html, $matches) || 
                    preg_match('/axios\.(post|get)\(["\']([^"\']*newsletter[^"\']*)["\']/', $html, $matches) ||
                    preg_match('/\.ajax\([^)]*url["\']?:["\']([^"\']*newsletter[^"\']*)["\']/', $html, $matches)) {
                    $action = end($matches); // Get the URL from the match
                    if (strpos($action, 'http') === 0) {
                        $formAction = $action;
                    } else {
                        $formAction = $baseUrl . (strpos($action, '/') === 0 ? $action : '/' . $action);
                    }
                }
            }
            
            // Try common newsletter subscription endpoints if still not found
            $commonEndpoints = [
                rtrim($baseUrl, '/') . '/newsletter/subscribe',
                rtrim($baseUrl, '/') . '/subscribe',
                rtrim($baseUrl, '/') . '/api/newsletter',
                rtrim($baseUrl, '/') . '/api/subscribe',
            ];
            
            // Extract CSRF token from the page
            $csrfToken = null;
            // Try to find CSRF token in meta tag
            if (preg_match('/<meta name="csrf-token" content="([^"]+)"/', $html, $matches)) {
                $csrfToken = $matches[1];
            }
            // Try to find CSRF token in hidden input field
            elseif (preg_match('/<input[^>]*name=["\']_token["\'][^>]*value=["\']([^"\']+)["\']/', $html, $matches)) {
                $csrfToken = $matches[1];
            }
            // Try to find CSRF token in XSRF-TOKEN cookie
            elseif (preg_match('/XSRF-TOKEN=([^;]+)/', $getResponse->getHeaderLine('Set-Cookie'), $matches)) {
                $csrfToken = urldecode($matches[1]);
            }
            
            // Extract email field name from the form
            $emailFieldName = 'email'; // Default
            if (preg_match('/<input[^>]*type=["\']email["\'][^>]*name=["\']([^"\']+)["\']/', $html, $matches)) {
                $emailFieldName = $matches[1];
            }
            
            // Prepare form data
            $formData = [
                $emailFieldName => $validated['email'],
            ];
            
            // Add CSRF token if found
            if ($csrfToken) {
                $formData['_token'] = $csrfToken;
            }
            
            // Try submitting to the found form action, or try common endpoints
            $response = null;
            $lastError = null;
            
            if ($formAction) {
                try {
                    Log::info('Newsletter subscription attempt', [
                        'form_action' => $formAction,
                        'email_field' => $emailFieldName,
                        'has_csrf' => !empty($csrfToken)
                    ]);
                    
                    $response = $client->post($formAction, [
                        'form_params' => $formData,
                        'headers' => [
                            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36',
                            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                            'Referer' => $backendUrl,
                            'Origin' => $baseUrl,
                        ],
                        'allow_redirects' => true,
                    ]);
                } catch (\GuzzleHttp\Exception\RequestException $e) {
                    $lastError = $e;
                    Log::warning('Newsletter subscription failed at form action', ['action' => $formAction, 'error' => $e->getMessage()]);
                }
            }
            
            // If form action didn't work, try common endpoints
            if (!$response) {
                foreach ($commonEndpoints as $endpoint) {
                    try {
                        Log::info('Trying newsletter endpoint', ['endpoint' => $endpoint]);
                        
                        $response = $client->post($endpoint, [
                            'form_params' => $formData,
                            'headers' => [
                                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36',
                                'Accept' => 'application/json, text/html, */*',
                                'Referer' => $backendUrl,
                                'Origin' => $baseUrl,
                                'X-Requested-With' => 'XMLHttpRequest',
                            ],
                            'allow_redirects' => true,
                        ]);
                        
                        // If we got a response (even if error), break the loop
                        break;
                    } catch (\GuzzleHttp\Exception\RequestException $e) {
                        $lastError = $e;
                        Log::warning('Newsletter subscription failed at endpoint', ['endpoint' => $endpoint, 'error' => $e->getMessage()]);
                        continue; // Try next endpoint
                    }
                }
            }
            
            // If all attempts failed, throw the last error
            if (!$response && $lastError) {
                throw $lastError;
            }
            
            $statusCode = $response->getStatusCode();
            $body = (string) $response->getBody();

            // Check for common success indicators in the response
            $successIndicators = ['success', 'thank you', 'subscribed', 'subscription', 'confirmed', 'newsletter'];
            $isSuccess = false;
            foreach ($successIndicators as $indicator) {
                if (stripos($body, $indicator) !== false) {
                    $isSuccess = true;
                    break;
                }
            }

            // Consider 2xx and 3xx status codes as potential success
            if ($isSuccess || in_array($statusCode, [200, 201, 202, 302, 303])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you! You have been successfully subscribed to our newsletter.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to subscribe. Please try again later.'
                ], 500);
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Log Guzzle-specific errors
            $errorMessage = $e->getMessage();
            if ($e->hasResponse()) {
                $errorMessage .= ' | Status: ' . $e->getResponse()->getStatusCode();
                $errorMessage .= ' | Body: ' . substr((string)$e->getResponse()->getBody(), 0, 200);
            }
            Log::error('Newsletter subscription error (Guzzle): ' . $errorMessage);
            
            return response()->json([
                'success' => false,
                'message' => 'Unable to connect to the newsletter server. Please try again later.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Newsletter subscription error: ' . $e->getMessage());
            Log::error('File: ' . $e->getFile() . ' | Line: ' . $e->getLine());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while subscribing. Please try again later.',
                'error' => config('app.debug') ? $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() : null
            ], 500);
        }
    }
}
