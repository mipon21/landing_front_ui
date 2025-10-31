@extends('admin.layout')

@section('title', 'Add Service')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add Service</h2>
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Back</a>
</div>

<form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Service Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="type" required>
                            <option value="restaurant" {{ old('type') === 'restaurant' ? 'selected' : '' }}>Restaurant</option>
                            <option value="customer" {{ old('type') === 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="deliveryman" {{ old('type') === 'deliveryman' ? 'selected' : '' }}>Deliveryman</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Badge Text</label>
                        <input type="text" class="form-control" name="badge_text" value="{{ old('badge_text') }}" placeholder="e.g., for restaurant">
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
                        <label class="form-label">Button Text</label>
                        <input type="text" class="form-control" name="button_text" value="{{ old('button_text') }}" placeholder="e.g., Register Your Restaurant">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="url" class="form-control" name="button_url" value="{{ old('button_url') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Service Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Features</label>
                        <div id="features-container">
                            <div class="feature-item mb-3 border p-3">
                                <div class="mb-2">
                                    <label class="form-label small">Feature Title</label>
                                    <input type="text" class="form-control form-control-sm" name="feature_titles[]" placeholder="e.g., Handling of orders">
                                </div>
                                <div>
                                    <label class="form-label small">Feature Description</label>
                                    <textarea class="form-control form-control-sm" name="feature_descriptions[]" rows="2" placeholder="Feature description"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="addFeature()">
                            <i class="bi bi-plus"></i> Add Feature
                        </button>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create Service</button>
        </div>
    </div>
</form>

<script>
function addFeature() {
    const container = document.getElementById('features-container');
    const div = document.createElement('div');
    div.className = 'feature-item mb-3 border p-3';
    div.innerHTML = `
        <div class="d-flex justify-content-between align-items-start mb-2">
            <span class="small text-muted">Feature</span>
            <button type="button" class="btn btn-sm btn-danger" onclick="this.parentElement.parentElement.remove()">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        <div class="mb-2">
            <label class="form-label small">Feature Title</label>
            <input type="text" class="form-control form-control-sm" name="feature_titles[]" placeholder="e.g., Handling of orders">
        </div>
        <div>
            <label class="form-label small">Feature Description</label>
            <textarea class="form-control form-control-sm" name="feature_descriptions[]" rows="2" placeholder="Feature description"></textarea>
        </div>
    `;
    container.appendChild(div);
}
</script>
@endsection

