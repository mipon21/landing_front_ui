@extends('admin.layout')

@section('title', 'Contact Page Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Contact Page Management</h2>
</div>

<!-- Contact Information Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Contact Information Section</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.contact-pages.update-contact-info') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" name="heading" value="{{ old('heading', $contactInfo['heading']) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="2">{{ old('description', $contactInfo['description']) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $contactInfo['email']) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone', $contactInfo['phone']) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea class="form-control" name="address" rows="2">{{ old('address', $contactInfo['address']) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Contact Information</button>
        </form>
    </div>
</div>

<!-- Ticket Box Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Ticket Box Section</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.contact-pages.update-ticket-box') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" name="heading" value="{{ old('heading', $ticketBox['heading']) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3">{{ old('description', $ticketBox['description']) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Button Text</label>
                <input type="text" class="form-control" name="button_text" value="{{ old('button_text', $ticketBox['button_text']) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Button URL</label>
                <input type="url" class="form-control" name="button_url" value="{{ old('button_url', $ticketBox['button_url']) }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Ticket Box</button>
        </form>
    </div>
</div>

<!-- Contact Form Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Contact Form Section</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.contact-pages.update-contact-form') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" name="heading" value="{{ old('heading', $contactForm['heading']) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="2">{{ old('description', $contactForm['description']) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Backend Processing URL <span class="text-danger">*</span></label>
                <input type="url" class="form-control" name="backend_url" value="{{ old('backend_url', $contactForm['backend_url']) }}" required placeholder="https://tastyso.com/contact-us">
                <small class="text-muted">The backend URL where the contact form data will be submitted</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Contact Form Settings</button>
        </form>
    </div>
</div>

<!-- Map Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Map Section</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.contact-pages.update-map') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Map Iframe URL</label>
                <textarea class="form-control" name="iframe_url" rows="5" placeholder="Paste the Google Maps embed code or URL here">{{ old('iframe_url', $map['iframe_url']) }}</textarea>
                <small class="text-muted">Enter the full iframe embed code or URL for Google Maps</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Map</button>
        </form>
    </div>
</div>
@endsection

