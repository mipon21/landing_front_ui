@extends('admin.layout')

@section('title', 'Create Blog Post')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Create Blog Post</h2>
    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Back</a>
</div>

<form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card mb-4">
        <div class="card-header">Basic Information</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Slug</label>
                <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                <small class="form-text text-muted">Leave empty to auto-generate from title</small>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Author</label>
                    <input type="text" class="form-control" name="author" value="{{ old('author', 'Admin') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" class="form-control" name="category" value="{{ old('category') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Published Date</label>
                <input type="date" class="form-control" name="published_at" value="{{ old('published_at') }}">
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Content</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Featured Image</label>
                <input type="file" class="form-control" name="featured_image" accept="image/*">
            </div>

            <div class="mb-3">
                <label class="form-label">Excerpt</label>
                <textarea class="form-control" name="excerpt" rows="3">{{ old('excerpt') }}</textarea>
                <small class="form-text text-muted">Short summary for listing pages</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea class="form-control" name="content" rows="10">{{ old('content') }}</textarea>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Settings</div>
        <div class="card-body">
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_editor_choice" value="1" id="is_editor_choice" {{ old('is_editor_choice') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_editor_choice">Editor's Choice</label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published" {{ old('is_published', true) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_published">Published</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', 0) }}">
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Create Blog Post</button>
</form>
@endsection

