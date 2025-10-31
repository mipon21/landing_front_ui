<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function index()
    {
        // Contact Information Section
        $contactInfo = [
            'heading' => SiteSetting::getValue('contact_info_heading', 'Contact informations'),
            'description' => SiteSetting::getValue('contact_info_description', 'Get in touch with us.'),
            'email' => SiteSetting::getValue('contact_info_email', 'support@gmail.com'),
            'phone' => SiteSetting::getValue('contact_info_phone', '+1 (456) 125-45-678'),
            'address' => SiteSetting::getValue('contact_info_address', 'Fincop Ltd. 185, Finance Hub, Chikago, USA 4647'),
        ];

        // Ticket Box Section
        $ticketBox = [
            'heading' => SiteSetting::getValue('contact_ticket_heading', 'Generate Ticket'),
            'description' => SiteSetting::getValue('contact_ticket_description', 'Need support for our application, service, payment or company, Please generate ticket.'),
            'button_text' => SiteSetting::getValue('contact_ticket_button_text', 'Generate Ticket Now'),
            'button_url' => SiteSetting::getValue('contact_ticket_button_url', '#'),
        ];

        // Contact Form
        $contactForm = [
            'heading' => SiteSetting::getValue('contact_form_heading', 'Message us'),
            'description' => SiteSetting::getValue('contact_form_description', 'Fill up form below, our team will get back soon'),
            'backend_url' => SiteSetting::getValue('contact_form_backend_url', 'https://tastyso.com/contact-us'),
        ];

        // Map Section
        $map = [
            'iframe_url' => SiteSetting::getValue('contact_map_iframe_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.2799160891!2d-74.25987584510595!3d40.69767006338158!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1664399300741!5m2!1sen!2sin'),
        ];

        return view('admin.contact-pages.index', compact('contactInfo', 'ticketBox', 'contactForm', 'map'));
    }

    public function updateContactInfo(Request $request)
    {
        $validated = $request->validate([
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
        ]);

        SiteSetting::setValue('contact_info_heading', $validated['heading'] ?? '', 'string', 'Contact page info section heading.');
        SiteSetting::setValue('contact_info_description', $validated['description'] ?? '', 'string', 'Contact page info section description.');
        SiteSetting::setValue('contact_info_email', $validated['email'] ?? '', 'string', 'Contact page email address.');
        SiteSetting::setValue('contact_info_phone', $validated['phone'] ?? '', 'string', 'Contact page phone number.');
        SiteSetting::setValue('contact_info_address', $validated['address'] ?? '', 'string', 'Contact page address.');

        return redirect()->route('admin.contact-pages.index')->with('success', 'Contact information updated successfully!');
    }

    public function updateTicketBox(Request $request)
    {
        $validated = $request->validate([
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|url|max:255',
        ]);

        SiteSetting::setValue('contact_ticket_heading', $validated['heading'] ?? '', 'string', 'Contact page ticket box heading.');
        SiteSetting::setValue('contact_ticket_description', $validated['description'] ?? '', 'string', 'Contact page ticket box description.');
        SiteSetting::setValue('contact_ticket_button_text', $validated['button_text'] ?? '', 'string', 'Contact page ticket box button text.');
        SiteSetting::setValue('contact_ticket_button_url', $validated['button_url'] ?? '#', 'string', 'Contact page ticket box button URL.');

        return redirect()->route('admin.contact-pages.index')->with('success', 'Ticket box updated successfully!');
    }

    public function updateContactForm(Request $request)
    {
        $validated = $request->validate([
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'backend_url' => 'nullable|url|max:500',
        ]);

        SiteSetting::setValue('contact_form_heading', $validated['heading'] ?? '', 'string', 'Contact page form section heading.');
        SiteSetting::setValue('contact_form_description', $validated['description'] ?? '', 'string', 'Contact page form section description.');
        SiteSetting::setValue('contact_form_backend_url', $validated['backend_url'] ?? 'https://tastyso.com/contact-us', 'string', 'Contact form backend processing URL.');

        return redirect()->route('admin.contact-pages.index')->with('success', 'Contact form settings updated successfully!');
    }

    public function updateMap(Request $request)
    {
        $validated = $request->validate([
            'iframe_url' => 'nullable|string|max:1000',
        ]);

        SiteSetting::setValue('contact_map_iframe_url', $validated['iframe_url'] ?? '', 'string', 'Contact page map iframe URL.');

        return redirect()->route('admin.contact-pages.index')->with('success', 'Map section updated successfully!');
    }
}
