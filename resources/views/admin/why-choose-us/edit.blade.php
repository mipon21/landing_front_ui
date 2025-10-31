@extends('admin.layout')

@section('title', 'Edit Why Choose Us Feature')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Why Choose Us Feature</h2>
    <a href="{{ route('admin.why-choose-us.index') }}" class="btn btn-secondary">Back</a>
</div>

<form action="{{ route('admin.why-choose-us.update', $whyChooseUs->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Feature Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $whyChooseUs->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Feature Content <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="content" rows="4" required>{{ old('content', $whyChooseUs->content) }}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Icon Image</label>
                        @if($whyChooseUs->icon)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $whyChooseUs->icon) }}" alt="Icon" style="max-height: 100px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="icon" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $whyChooseUs->sort_order) }}">
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $whyChooseUs->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Feature</button>
        </div>
    </div>
</form>
@endsection

