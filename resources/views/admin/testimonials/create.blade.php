@extends('admin.layout')

@section('title', 'Add Testimonial')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add Testimonial</h2>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Back</a>
</div>

<form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Customer Image <span class="text-danger">*</span></label>
                <input type="file" class="form-control" name="customer_image" accept="image/*" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="customer_name" value="{{ old('customer_name') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" class="form-control" name="customer_location" value="{{ old('customer_location') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Company</label>
                <input type="text" class="form-control" name="customer_company" value="{{ old('customer_company') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Rating <span class="text-danger">*</span></label>
                <select class="form-control" name="rating" required>
                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 Star</option>
                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 Stars</option>
                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 Stars</option>
                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 Stars</option>
                    <option value="5" {{ old('rating', 5) == 5 ? 'selected' : '' }}>5 Stars</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Quote <span class="text-danger">*</span></label>
                <textarea class="form-control" name="quote" rows="3" required>{{ old('quote') }}</textarea>
                <small class="form-text text-muted">Short quote to display in testimonials</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Full Review</label>
                <textarea class="form-control" name="full_review" rows="5">{{ old('full_review') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', 0) }}">
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <button type="submit" class="btn btn-primary">Add Testimonial</button>
        </div>
    </div>
</form>
@endsection

