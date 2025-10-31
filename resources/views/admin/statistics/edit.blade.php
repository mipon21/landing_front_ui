@extends('admin.layout')

@section('title', 'Edit Statistic')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Statistic</h2>
    <a href="{{ route('admin.statistics.index') }}" class="btn btn-secondary">Back</a>
</div>

<form action="{{ route('admin.statistics.update', $statistic) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Icon Image</label>
                @if($statistic->icon)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $statistic->icon) }}" alt="Icon" class="img-thumbnail" style="max-height: 100px;">
                    </div>
                @endif
                <input type="file" class="form-control" name="icon" accept="image/*">
            </div>

            <div class="mb-3">
                <label class="form-label">Value <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="value" value="{{ old('value', $statistic->value) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Suffix</label>
                <input type="text" class="form-control" name="suffix" value="{{ old('suffix', $statistic->suffix) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Label <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="label" value="{{ old('label', $statistic->label) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $statistic->sort_order) }}">
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $statistic->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <button type="submit" class="btn btn-primary">Update Statistic</button>
        </div>
    </div>
</form>
@endsection

