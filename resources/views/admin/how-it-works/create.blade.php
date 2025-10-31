@extends('admin.layout')

@section('title', 'Add How It Works Step')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add How It Works Step</h2>
    <a href="{{ route('admin.how-it-works.index') }}" class="btn btn-secondary">Back</a>
</div>

<form action="{{ route('admin.how-it-works.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Step Number <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="step_number" value="{{ old('step_number') }}" required min="1" max="99">
                        <small class="text-muted">The step number (1, 2, 3, etc.)</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Step Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="step_title" value="{{ old('step_title') }}" required placeholder="e.g., Download App & create a free account">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Step Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="step_description" rows="4" required>{{ old('step_description') }}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Step Image</label>
                        <input type="file" class="form-control" name="step_image" accept="image/*">
                        <small class="text-muted">Optional: Upload an image for this step</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', 0) }}">
                        <small class="text-muted">Lower numbers appear first</small>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create Step</button>
        </div>
    </div>
</form>
@endsection

