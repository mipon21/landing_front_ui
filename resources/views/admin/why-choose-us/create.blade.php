@extends('admin.layout')

@section('title', 'Add Why Choose Us Feature')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add Why Choose Us Feature</h2>
    <a href="{{ route('admin.why-choose-us.index') }}" class="btn btn-secondary">Back</a>
</div>

<form action="{{ route('admin.why-choose-us.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Badge Text</label>
                        <input type="text" class="form-control" name="badge_text" value="{{ old('badge_text') }}" placeholder="e.g., why use Appiq">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Section Heading <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="heading" value="{{ old('heading') }}" required placeholder="e.g., Why choose us">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Section Description</label>
                        <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Feature Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required placeholder="e.g., Delivery in 30 min">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Feature Content <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="content" rows="4" required>{{ old('content') }}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Icon Image</label>
                        <input type="file" class="form-control" name="icon" accept="image/*">
                        <small class="text-muted">Optional: Upload an icon for this feature</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Feature Image</label>
                        <input type="file" class="form-control" name="feature_image" accept="image/*">
                        <small class="text-muted">Optional: Main feature image</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', 0) }}">
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create Feature</button>
        </div>
    </div>
</form>
@endsection

