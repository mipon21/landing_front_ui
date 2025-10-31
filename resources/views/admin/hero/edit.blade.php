@extends('admin.layout')

@section('title', 'Hero Section')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Hero Section</h2>
</div>

<form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card mb-4">
        <div class="card-header">Main Content</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Typed Texts (one per line)</label>
                <textarea class="form-control" name="typed_texts" rows="3">{{ old('typed_texts', is_array($hero->typed_texts) ? implode("\n", $hero->typed_texts) : '') }}</textarea>
                <small class="form-text text-muted">Each line will be a separate text in the typing animation</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Heading</label>
                <input type="text" class="form-control" name="heading" value="{{ old('heading', $hero->heading) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3">{{ old('description', $hero->description) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Active Users Text</label>
                    <input type="text" class="form-control" name="active_users_text" value="{{ old('active_users_text', $hero->active_users_text) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Rating Text</label>
                    <input type="text" class="form-control" name="rating_text" value="{{ old('rating_text', $hero->rating_text) }}">
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Images</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Hero Image</label>
                    @if($hero->hero_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $hero->hero_image) }}" alt="Hero" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    @endif
                    <input type="file" class="form-control" name="hero_image" accept="image/*">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Background Image</label>
                    @if($hero->background_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $hero->background_image) }}" alt="Background" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    @endif
                    <input type="file" class="form-control" name="background_image" accept="image/*">
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">App Store Links</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Google Play URL</label>
                    <input type="url" class="form-control" name="google_play_url" value="{{ old('google_play_url', $hero->google_play_url) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">App Store URL</label>
                    <input type="url" class="form-control" name="app_store_url" value="{{ old('app_store_url', $hero->app_store_url) }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Google Play Image</label>
                    @if($hero->google_play_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $hero->google_play_image) }}" alt="Google Play" class="img-thumbnail" style="max-height: 100px;">
                        </div>
                    @endif
                    <input type="file" class="form-control" name="google_play_image" accept="image/*">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">App Store Image</label>
                    @if($hero->app_store_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $hero->app_store_image) }}" alt="App Store" class="img-thumbnail" style="max-height: 100px;">
                        </div>
                    @endif
                    <input type="file" class="form-control" name="app_store_image" accept="image/*">
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Settings</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Video URL</label>
                <input type="url" class="form-control" name="video_url" value="{{ old('video_url', $hero->video_url) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">User Avatars (one image path per line)</label>
                <textarea class="form-control" name="user_avatars" rows="3">{{ old('user_avatars', is_array($hero->user_avatars) ? implode("\n", $hero->user_avatars) : '') }}</textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $hero->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active</label>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Update Hero Section</button>
</form>
@endsection

