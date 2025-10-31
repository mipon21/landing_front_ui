@extends('admin.layout')

@section('title', 'Edit Restaurant Logo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Restaurant Logo</h2>
    <a href="{{ route('admin.restaurant-logos.index') }}" class="btn btn-secondary">Back</a>
</div>

<form action="{{ route('admin.restaurant-logos.update', $restaurantLogo) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Logo Image</label>
                @if($restaurantLogo->logo_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $restaurantLogo->logo_image) }}" alt="Logo" class="img-thumbnail" style="max-height: 150px;">
                    </div>
                @endif
                <input type="file" class="form-control" name="logo_image" accept="image/*">
                <small class="form-text text-muted">Leave empty to keep current image</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Alt Text</label>
                <input type="text" class="form-control" name="alt_text" value="{{ old('alt_text', $restaurantLogo->alt_text) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $restaurantLogo->sort_order) }}">
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $restaurantLogo->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <button type="submit" class="btn btn-primary">Update Logo</button>
        </div>
    </div>
</form>
@endsection

