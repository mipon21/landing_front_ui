@extends('admin.layout')

@section('title', 'Footer Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Footer Settings</h2>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Pre-Footer CTA Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Pre-Footer CTA Section ("Need support?")</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.settings.footer.update-pre-footer-cta') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Heading <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="heading" value="{{ old('heading', $preFooterCta['heading']) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description <span class="text-danger">*</span></label>
                <textarea class="form-control" name="description" rows="3" required>{{ old('description', $preFooterCta['description']) }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Call Button Text <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="call_text" value="{{ old('call_text', $preFooterCta['call_text']) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Call Button URL <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="call_url" value="{{ old('call_url', $preFooterCta['call_url']) }}" required placeholder="e.g., tel:123-456-7890">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="show_call_button" value="1" id="show_call_button" {{ old('show_call_button', $preFooterCta['show_call_button']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_call_button">Show Call Button on Frontend</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Email Button Text <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email_text" value="{{ old('email_text', $preFooterCta['email_text']) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Button URL <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email_url" value="{{ old('email_url', $preFooterCta['email_url']) }}" required placeholder="e.g., mailto:someone@example.com">
                        <small class="text-muted">Use mailto: prefix for email links (e.g., mailto:someone@example.com)</small>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="show_email_button" value="1" id="show_email_button" {{ old('show_email_button', $preFooterCta['show_email_button']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_email_button">Show Email Button on Frontend</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Pre-Footer CTA</button>
        </form>
    </div>
</div>

<!-- Footer Logo Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Footer Logo</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.settings.footer.update-logo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Current Logo</label>
                <div>
                    @if($footerLogo)
                        <img src="{{ asset('storage/' . $footerLogo) }}" alt="Footer Logo" style="max-height: 80px; margin-bottom: 15px;" class="d-block">
                        <a href="{{ route('admin.settings.footer.delete-logo') }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete the logo?')">
                            <i class="bi bi-trash me-1"></i>Delete Logo
                        </a>
                    @else
                        <p class="text-muted">No logo uploaded</p>
                    @endif
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Upload New Logo</label>
                <input type="file" class="form-control" name="logo" accept="image/*" required>
                <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF, WEBP (Max: 2MB)</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Logo</button>
        </form>
    </div>
</div>

<!-- Footer Details Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Footer Details/Description</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.settings.footer.update-details') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Details Text <span class="text-danger">*</span></label>
                <textarea class="form-control" name="details" rows="4" required>{{ old('details', $footerDetails) }}</textarea>
                <small class="text-muted">This text appears below the footer logo</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Details</button>
        </form>
    </div>
</div>

<!-- App Store Buttons Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>App Store Buttons</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.settings.footer.update-app-store-buttons') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">App Store URL</label>
                        <input type="url" class="form-control" name="app_store_url" value="{{ old('app_store_url', $appStoreButtons['app_store_url']) }}" placeholder="e.g., https://apps.apple.com/...">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="show_app_store" value="1" id="show_app_store" {{ old('show_app_store', $appStoreButtons['show_app_store']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_app_store">Show App Store Button</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Google Play URL</label>
                        <input type="url" class="form-control" name="google_play_url" value="{{ old('google_play_url', $appStoreButtons['google_play_url']) }}" placeholder="e.g., https://play.google.com/...">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="show_google_play" value="1" id="show_google_play" {{ old('show_google_play', $appStoreButtons['show_google_play']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_google_play">Show Google Play Button</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update App Store Buttons</button>
        </form>
    </div>
</div>

<!-- Copyright Text Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Copyright Text</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.settings.footer.update-copyright') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Copyright Text <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="copyright_text" value="{{ old('copyright_text', $copyrightText) }}" required>
                <small class="text-muted">Use %Y to auto-update the year (e.g., "© Copyrights %Y. All rights reserved.")</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Copyright Text</button>
        </form>
    </div>
</div>

<!-- Newsletter Backend URL Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Newsletter Subscription Backend URL</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.settings.footer.update-newsletter-backend-url') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Backend Processing URL <span class="text-danger">*</span></label>
                <input type="url" class="form-control" name="backend_url" value="{{ old('backend_url', $newsletterBackendUrl) }}" required placeholder="https://tastyso.com/newsletter">
                <small class="text-muted">The backend URL where newsletter subscription data will be submitted</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Newsletter Backend URL</button>
        </form>
    </div>
</div>

<!-- Quick Links Menu Section -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Quick Links Menu</h5>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addQuickLinksModal">
            <i class="bi bi-plus-circle me-1"></i> Add Quick Link
        </button>
    </div>
    <div class="card-body">
        @if($quickLinks->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Label</th>
                            <th>URL</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quickLinks as $menu)
                            <tr>
                                <td><strong>{{ $menu->label }}</strong></td>
                                <td>{{ $menu->url ?? 'N/A' }}</td>
                                <td>{{ $menu->sort_order }}</td>
                                <td>
                                    @if($menu->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" onclick="editQuickLinksMenu({{ $menu->id }}, '{{ $menu->label }}', '{{ $menu->url }}', {{ $menu->sort_order }}, {{ $menu->is_active ? 'true' : 'false' }})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.settings.footer.destroy-menu', $menu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this menu?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">No Quick Links menu items found. Click "Add Quick Link" to create one.</p>
        @endif
    </div>
</div>

<!-- Support Menu Section -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Support Menu</h5>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSupportModal">
            <i class="bi bi-plus-circle me-1"></i> Add Support Link
        </button>
    </div>
    <div class="card-body">
        @if($supportMenus->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Label</th>
                            <th>URL</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($supportMenus as $menu)
                            <tr>
                                <td><strong>{{ $menu->label }}</strong></td>
                                <td>{{ $menu->url ?? 'N/A' }}</td>
                                <td>{{ $menu->sort_order }}</td>
                                <td>
                                    @if($menu->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" onclick="editSupportMenu({{ $menu->id }}, '{{ $menu->label }}', '{{ $menu->url }}', {{ $menu->sort_order }}, {{ $menu->is_active ? 'true' : 'false' }})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.settings.footer.destroy-menu', $menu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this menu?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">No Support menu items found. Click "Add Support Link" to create one.</p>
        @endif
    </div>
</div>

<!-- Add Quick Links Modal -->
<div class="modal fade" id="addQuickLinksModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Quick Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.settings.footer.store-menu') }}" method="POST">
                @csrf
                <input type="hidden" name="menu_type" value="quick_links">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Menu Label <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="label" required placeholder="e.g., Home">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="text" class="form-control" name="url" placeholder="e.g., / or https://example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" min="0" value="0">
                        <small class="text-muted">Lower numbers appear first</small>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="quick_links_is_active" checked>
                        <label class="form-check-label" for="quick_links_is_active">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Menu Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Support Modal -->
<div class="modal fade" id="addSupportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Support Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.settings.footer.store-menu') }}" method="POST">
                @csrf
                <input type="hidden" name="menu_type" value="support">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Menu Label <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="label" required placeholder="e.g., FAQs">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="text" class="form-control" name="url" placeholder="e.g., /faqs or https://example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" min="0" value="0">
                        <small class="text-muted">Lower numbers appear first</small>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="support_is_active" checked>
                        <label class="form-check-label" for="support_is_active">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Menu Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Quick Links Modal -->
<div class="modal fade" id="editQuickLinksModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Quick Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editQuickLinksForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="menu_type" value="quick_links">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Menu Label <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="label" id="edit_quick_links_label" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="text" class="form-control" name="url" id="edit_quick_links_url">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" id="edit_quick_links_sort_order" min="0">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="edit_quick_links_is_active">
                        <label class="form-check-label" for="edit_quick_links_is_active">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Menu Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Support Modal -->
<div class="modal fade" id="editSupportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Support Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editSupportForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="menu_type" value="support">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Menu Label <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="label" id="edit_support_label" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="text" class="form-control" name="url" id="edit_support_url">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" id="edit_support_sort_order" min="0">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="edit_support_is_active">
                        <label class="form-check-label" for="edit_support_is_active">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Menu Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Social Links Section -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Social Links</h5>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSocialLinkModal">
            <i class="bi bi-plus-circle me-1"></i> Add Social Link
        </button>
    </div>
    <div class="card-body">
        @if($socialLinks->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Platform</th>
                            <th>Icon Class</th>
                            <th>URL</th>
                            <th>Label</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($socialLinks as $link)
                            <tr>
                                <td><strong>{{ ucfirst($link->platform) }}</strong></td>
                                <td><code>{{ $link->icon_class }}</code></td>
                                <td><a href="{{ $link->url }}" target="_blank">{{ Str::limit($link->url, 30) }}</a></td>
                                <td>{{ $link->label ?? '-' }}</td>
                                <td>{{ $link->sort_order }}</td>
                                <td>
                                    @if($link->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" onclick="editSocialLink({{ $link->id }}, '{{ $link->platform }}', '{{ $link->icon_class }}', '{{ $link->url }}', '{{ $link->label }}', {{ $link->sort_order }}, {{ $link->is_active ? 'true' : 'false' }})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.settings.footer.destroy-social-link', $link->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this social link?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">No social links found. Click "Add Social Link" to create one.</p>
        @endif
    </div>
</div>

<!-- Add Social Link Modal -->
<div class="modal fade" id="addSocialLinkModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Social Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.settings.footer.store-social-link') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Platform <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="platform" required placeholder="e.g., Facebook, Twitter, Instagram">
                        <small class="text-muted">Name of the social media platform</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon Class</label>
                        <input type="text" class="form-control" name="icon_class" placeholder="e.g., icofont-facebook">
                        <small class="text-muted">Leave empty to auto-detect based on platform</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" name="url" required placeholder="e.g., https://facebook.com/yourpage">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Label</label>
                        <input type="text" class="form-control" name="label" placeholder="Optional label">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" min="0" value="0">
                        <small class="text-muted">Lower numbers appear first</small>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="social_link_is_active" checked>
                        <label class="form-check-label" for="social_link_is_active">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Social Link</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Social Link Modal -->
<div class="modal fade" id="editSocialLinkModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Social Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editSocialLinkForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Platform <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="platform" id="edit_social_platform" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon Class</label>
                        <input type="text" class="form-control" name="icon_class" id="edit_social_icon_class">
                        <small class="text-muted">Leave empty to auto-detect based on platform</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" name="url" id="edit_social_url" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Label</label>
                        <input type="text" class="form-control" name="label" id="edit_social_label">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" id="edit_social_sort_order" min="0">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="edit_social_is_active">
                        <label class="form-check-label" for="edit_social_is_active">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Social Link</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function editQuickLinksMenu(id, label, url, sortOrder, isActive) {
    document.getElementById('editQuickLinksForm').action = '{{ route("admin.settings.footer.update-menu", ":id") }}'.replace(':id', id);
    document.getElementById('edit_quick_links_label').value = label;
    document.getElementById('edit_quick_links_url').value = url || '';
    document.getElementById('edit_quick_links_sort_order').value = sortOrder;
    document.getElementById('edit_quick_links_is_active').checked = isActive;
    
    var editModal = new bootstrap.Modal(document.getElementById('editQuickLinksModal'));
    editModal.show();
}

function editSupportMenu(id, label, url, sortOrder, isActive) {
    document.getElementById('editSupportForm').action = '{{ route("admin.settings.footer.update-menu", ":id") }}'.replace(':id', id);
    document.getElementById('edit_support_label').value = label;
    document.getElementById('edit_support_url').value = url || '';
    document.getElementById('edit_support_sort_order').value = sortOrder;
    document.getElementById('edit_support_is_active').checked = isActive;
    
    var editModal = new bootstrap.Modal(document.getElementById('editSupportModal'));
    editModal.show();
}

function editSocialLink(id, platform, iconClass, url, label, sortOrder, isActive) {
    document.getElementById('editSocialLinkForm').action = '{{ route("admin.settings.footer.update-social-link", ":id") }}'.replace(':id', id);
    document.getElementById('edit_social_platform').value = platform;
    document.getElementById('edit_social_icon_class').value = iconClass || '';
    document.getElementById('edit_social_url').value = url;
    document.getElementById('edit_social_label').value = label || '';
    document.getElementById('edit_social_sort_order').value = sortOrder;
    document.getElementById('edit_social_is_active').checked = isActive;
    
    var editModal = new bootstrap.Modal(document.getElementById('editSocialLinkModal'));
    editModal.show();
}
</script>
@endsection
