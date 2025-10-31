@extends('admin.layout')

@section('title', 'Edit Dish')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Dish</h2>
    <a href="{{ route('admin.dishes.index') }}" class="btn btn-secondary">Back</a>
</div>

<form action="{{ route('admin.dishes.update', $dish) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Dish Image</label>
                @if($dish->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="img-thumbnail" style="max-height: 300px;">
                    </div>
                @endif
                <input type="file" class="form-control" name="image" accept="image/*">
                <small class="form-text text-muted">Leave empty to keep current image</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Dish Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $dish->name) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Alt Text</label>
                <input type="text" class="form-control" name="alt_text" value="{{ old('alt_text', $dish->alt_text) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $dish->sort_order) }}">
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $dish->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <button type="submit" class="btn btn-primary">Update Dish</button>
        </div>
    </div>
</form>
@endsection

