@extends('admin.layout')

@section('title', 'General Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>General Settings</h2>
</div>

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Favicon Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Site Favicon</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.settings.general.update-favicon') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Current Favicon</label>
                <div>
                    @if($favicon)
                        <img src="{{ asset('storage/' . $favicon) }}" alt="Favicon" style="max-height: 32px; max-width: 32px; margin-bottom: 15px;" class="d-block">
                        <a href="{{ route('admin.settings.general.delete-favicon') }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete the favicon?')">
                            <i class="bi bi-trash me-1"></i>Delete Favicon
                        </a>
                    @else
                        <p class="text-muted">No favicon uploaded</p>
                    @endif
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Upload New Favicon</label>
                <input type="file" class="form-control" name="favicon" accept="image/x-icon,image/png,image/jpeg,image/gif" required>
                <small class="text-muted">Accepted formats: ICO, PNG, JPG, JPEG, GIF (Max: 512KB). Recommended size: 32x32px or 16x16px</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Favicon</button>
        </form>
    </div>
</div>

<!-- Site Information Section -->
<div class="card">
    <div class="card-header">
        <h5>Site Information</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.settings.general.update-site-info') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Site Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="site_name" value="{{ old('site_name', $siteName) }}" required placeholder="e.g., Food Delivery Mobile App Landing Page">
                <small class="text-muted">This appears in the browser tab and search engine results</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Site Description <span class="text-danger">*</span></label>
                <textarea class="form-control" name="site_description" rows="4" required maxlength="500" placeholder="Enter site description for SEO">{{ old('site_description', $siteDescription) }}</textarea>
                <small class="text-muted">This is used as the meta description for SEO. Maximum 500 characters.</small>
                <div class="mt-1">
                    <small class="text-muted">Characters: <span id="charCount">{{ strlen($siteDescription) }}</span>/500</small>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Site Information</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Character counter for description
    document.querySelector('textarea[name="site_description"]').addEventListener('input', function() {
        document.getElementById('charCount').textContent = this.value.length;
    });
</script>
@endsection

