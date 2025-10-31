@extends('admin.layout')

@section('title', 'Why Choose Us')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Why Choose Us</h2>
    <a href="{{ route('admin.why-choose-us.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New Feature
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Badge</th>
                        <th>Heading</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($features as $feature)
                        <tr>
                            <td>{{ $feature->id }}</td>
                            <td>{{ $feature->title }}</td>
                            <td>{{ $feature->badge_text ?? '-' }}</td>
                            <td>{{ Str::limit($feature->heading, 30) }}</td>
                            <td>{{ $feature->sort_order }}</td>
                            <td>
                                @if($feature->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.why-choose-us.edit', $feature->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.why-choose-us.destroy', $feature->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No features found. <a href="{{ route('admin.why-choose-us.create') }}">Add one</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Section Settings -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Section Settings</h5>
        <small class="text-muted">These settings apply to the entire "Why Choose Us" section. Individual cards only need Title, Content, and Icon.</small>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.why-choose-us.update-section-settings') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Badge Text</label>
                        <input type="text" class="form-control" name="badge_text" value="{{ old('badge_text', $sectionSettings['badge_text']) }}" placeholder="e.g., why use Appiq">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Section Heading <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="heading" value="{{ old('heading', $sectionSettings['heading']) }}" required placeholder="e.g., Why choose us">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Section Description</label>
                <textarea class="form-control" name="description" rows="3">{{ old('description', $sectionSettings['description']) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-2"></i>Update Section Settings
            </button>
        </form>
    </div>
</div>

<!-- Feature Image Settings -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Section Feature Image</h5>
        <small class="text-muted">This image is displayed once for the entire "Why Choose Us" section (on the right side). Each feature card only needs an icon.</small>
    </div>
    <div class="card-body">
        @if($featureImage)
            <div class="mb-3">
                <label class="form-label">Current Feature Image</label>
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $featureImage) }}" alt="Feature Image" style="max-height: 300px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
            </div>
        @endif

        <form action="{{ route('admin.why-choose-us.update-feature-image') }}" method="POST" enctype="multipart/form-data" class="d-inline">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ $featureImage ? 'Update' : 'Upload' }} Feature Image <span class="text-danger">*</span></label>
                <input type="file" class="form-control" name="feature_image" accept="image/*" required>
                <small class="text-muted">Main feature image for the Why Choose Us section (shown on the right side)</small>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-upload me-2"></i>{{ $featureImage ? 'Update' : 'Upload' }} Image
            </button>
        </form>

        @if($featureImage)
            <form action="{{ route('admin.why-choose-us.delete-feature-image') }}" method="POST" class="d-inline ms-2" onsubmit="return confirm('Are you sure you want to delete the feature image?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash me-2"></i>Delete Image
                </button>
            </form>
        @endif
    </div>
</div>
@endsection

