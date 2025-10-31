@extends('admin.layout')

@section('title', 'Restaurant Logos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Restaurant Logos</h2>
    <a href="{{ route('admin.restaurant-logos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Alt Text</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logos as $logo)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $logo->logo_image) }}" alt="{{ $logo->alt_text }}" style="width: 100px; height: auto; max-height: 60px; object-fit: contain;">
                        </td>
                        <td>{{ $logo->alt_text ?? 'N/A' }}</td>
                        <td>{{ $logo->sort_order }}</td>
                        <td>
                            @if($logo->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.restaurant-logos.edit', $logo) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.restaurant-logos.destroy', $logo) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No logos found. <a href="{{ route('admin.restaurant-logos.create') }}">Add one</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Register Button Settings -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Register Button Settings</h5>
        <small class="text-muted">Manage the "Register Your Restaurant" button below the restaurant logos section</small>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.restaurant-logos.update-button') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Button Text <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="button_text" value="{{ old('button_text', $registerButton['text']) }}" required placeholder="e.g., Register Your Restaurant">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Button URL <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" name="button_url" value="{{ old('button_url', $registerButton['url']) }}" required placeholder="e.g., https://example.com/register or #">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-2"></i>Update Button
            </button>
        </form>
    </div>
</div>
@endsection

