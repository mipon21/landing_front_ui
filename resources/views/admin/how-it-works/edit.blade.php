@extends('admin.layout')

@section('title', 'Edit How It Works Step')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit How It Works Step</h2>
    <a href="{{ route('admin.how-it-works.index') }}" class="btn btn-secondary">Back</a>
</div>

<form action="{{ route('admin.how-it-works.update', $howItWork) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Badge Text</label>
                        <input type="text" class="form-control" name="badge_text" value="{{ old('badge_text', $howItWork->badge_text) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Section Heading <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="heading" value="{{ old('heading', $howItWork->heading) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Section Description</label>
                        <textarea class="form-control" name="description" rows="3">{{ old('description', $howItWork->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Step Number <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="step_number" value="{{ old('step_number', $howItWork->step_number) }}" required min="1" max="99">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Step Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="step_title" value="{{ old('step_title', $howItWork->step_title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Step Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="step_description" rows="4" required>{{ old('step_description', $howItWork->step_description) }}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Step Image</label>
                        @if($howItWork->step_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $howItWork->step_image) }}" alt="Step" style="max-height: 200px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="step_image" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $howItWork->sort_order) }}">
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $howItWork->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Step</button>
        </div>
    </div>
</form>
@endsection

