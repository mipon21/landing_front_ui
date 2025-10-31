@extends('admin.layout')

@section('title', 'Add Download Section')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add Download Section</h2>
    <a href="{{ route('admin.download-sections.index') }}" class="btn btn-secondary">Back</a>
</div>

<form action="{{ route('admin.download-sections.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Section Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="section_type" required>
                            <option value="download" {{ old('section_type') === 'download' ? 'selected' : '' }}>Download App</option>
                            <option value="register" {{ old('section_type') === 'register' ? 'selected' : '' }}>Register Restaurant</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Badge Text</label>
                        <input type="text" class="form-control" name="badge_text" value="{{ old('badge_text') }}" placeholder="e.g., Download">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Heading <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="heading" value="{{ old('heading') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Promo Text / Button Text</label>
                        <input type="text" class="form-control" name="promo_text" value="{{ old('promo_text') }}" placeholder="e.g., Register Restaurant">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="url" class="form-control" name="button_url" value="{{ old('button_url') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Google Play URL</label>
                        <input type="url" class="form-control" name="google_play_url" value="{{ old('google_play_url') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">App Store URL</label>
                        <input type="url" class="form-control" name="app_store_url" value="{{ old('app_store_url') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Left Image (Desktop)</label>
                        <input type="file" class="form-control" name="left_image" accept="image/*">
                        <small class="text-muted">For download section</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Right Image</label>
                        <input type="file" class="form-control" name="right_image" accept="image/*">
                        <small class="text-muted">For download section</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mobile Image</label>
                        <input type="file" class="form-control" name="mobile_image" accept="image/*">
                        <small class="text-muted">For download section</small>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create Section</button>
        </div>
    </div>
</form>
@endsection

