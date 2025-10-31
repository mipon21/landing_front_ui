@extends('admin.layout')

@section('title', 'Edit Testimonial')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Testimonial</h2>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Back</a>
</div>

<form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Customer Image</label>
                @if($testimonial->customer_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $testimonial->customer_image) }}" alt="Customer" class="img-thumbnail" style="max-height: 150px;">
                    </div>
                @endif
                <input type="file" class="form-control" name="customer_image" accept="image/*">
                <small class="form-text text-muted">Leave empty to keep current image</small>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="customer_name" value="{{ old('customer_name', $testimonial->customer_name) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" class="form-control" name="customer_location" value="{{ old('customer_location', $testimonial->customer_location) }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Company</label>
                <input type="text" class="form-control" name="customer_company" value="{{ old('customer_company', $testimonial->customer_company) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Rating <span class="text-danger">*</span></label>
                <select class="form-control" name="rating" required>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Quote <span class="text-danger">*</span></label>
                <textarea class="form-control" name="quote" rows="3" required>{{ old('quote', $testimonial->quote) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Full Review</label>
                <textarea class="form-control" name="full_review" rows="5">{{ old('full_review', $testimonial->full_review) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order) }}">
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <button type="submit" class="btn btn-primary">Update Testimonial</button>
        </div>
    </div>
</form>
@endsection

