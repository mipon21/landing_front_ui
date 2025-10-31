@extends('admin.layout')

@section('title', 'Dishes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dishes</h2>
    <a href="{{ route('admin.dishes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            @forelse($dishes as $dish)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $dish->image) }}" class="card-img-top" alt="{{ $dish->name }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title">{{ $dish->name ?? 'Untitled' }}</h6>
                            <p class="card-text small text-muted">Order: {{ $dish->sort_order }}</p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.dishes.destroy', $dish) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p>No dishes found. <a href="{{ route('admin.dishes.create') }}">Add one</a></p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Section Button Settings -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">App Store Button Links</h5>
        <small class="text-muted">Manage the Google Play Store and App Store button links for the "YUMMY DISHES!" section</small>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.dishes.update-button-urls') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="show_google_play" id="show_google_play" value="1" {{ old('show_google_play', $buttonSettings['show_google_play']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_google_play">
                            <strong>Show Google Play Store Button</strong>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Google Play Store URL</label>
                        <input type="url" class="form-control" name="google_play_url" value="{{ old('google_play_url', $buttonSettings['google_play_url']) }}" placeholder="e.g., https://play.google.com/store/apps/details?id=com.example.app">
                        <small class="text-muted">Leave empty to use Hero Section URL as fallback</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="show_app_store" id="show_app_store" value="1" {{ old('show_app_store', $buttonSettings['show_app_store']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_app_store">
                            <strong>Show App Store Button</strong>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">App Store URL</label>
                        <input type="url" class="form-control" name="app_store_url" value="{{ old('app_store_url', $buttonSettings['app_store_url']) }}" placeholder="e.g., https://apps.apple.com/app/id123456789">
                        <small class="text-muted">Leave empty to use Hero Section URL as fallback</small>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-2"></i>Update Button Settings
            </button>
        </form>
    </div>
</div>
@endsection

