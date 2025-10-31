@extends('admin.layout')

@section('title', 'Header Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Header Settings</h2>
</div>

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Header Logo Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Header Logo</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.settings.header.update-logo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Current Logo</label>
                <div>
                    @if($headerLogo)
                        <img src="{{ asset('storage/' . $headerLogo) }}" alt="Header Logo" style="max-height: 80px; margin-bottom: 15px;" class="d-block">
                        <a href="{{ route('admin.settings.header.delete-logo') }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete the logo?')">
                            <i class="bi bi-trash me-1"></i>Delete Logo
                        </a>
                    @else
                        <p class="text-muted">No logo uploaded</p>
                    @endif
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Upload New Logo</label>
                <input type="file" class="form-control" name="logo" accept="image/*" required>
                <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF, WEBP (Max: 2MB)</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Logo</button>
        </form>
    </div>
</div>

<!-- CTA Button Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5>CTA Button Settings</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.settings.header.update-cta') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Button Text <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="cta_text" value="{{ old('cta_text', $ctaButton['text']) }}" required placeholder="e.g., 7 Days Free Trial">
            </div>
            <div class="mb-3">
                <label class="form-label">Button URL <span class="text-danger">*</span></label>
                <input type="url" class="form-control" name="cta_url" value="{{ old('cta_url', $ctaButton['url']) }}" required placeholder="e.g., https://example.com">
            </div>
            <button type="submit" class="btn btn-primary">Update CTA Button</button>
        </form>
    </div>
</div>

<!-- Menu Management Section -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Menu Management</h5>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addMenuModal">
            <i class="bi bi-plus-circle me-1"></i> Add Menu Item
        </button>
    </div>
    <div class="card-body">
        @if($menus->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Label</th>
                            <th>URL</th>
                            <th>Parent Menu</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $menu)
                            <tr>
                                <td><strong>{{ $menu->label }}</strong></td>
                                <td>{{ $menu->url ?? 'N/A' }}</td>
                                <td>-</td>
                                <td>{{ $menu->sort_order }}</td>
                                <td>
                                    @if($menu->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" onclick="editMenu({{ $menu->id }}, '{{ $menu->label }}', '{{ $menu->url }}', {{ $menu->parent_id ?? 'null' }}, {{ $menu->sort_order }}, {{ $menu->is_active ? 'true' : 'false' }})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.settings.header.destroy-menu', $menu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this menu? All submenus will also be deleted.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @foreach($menu->children as $child)
                                <tr>
                                    <td style="padding-left: 40px;">└─ {{ $child->label }}</td>
                                    <td>{{ $child->url ?? 'N/A' }}</td>
                                    <td>{{ $menu->label }}</td>
                                    <td>{{ $child->sort_order }}</td>
                                    <td>
                                        @if($child->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" onclick="editMenu({{ $child->id }}, '{{ $child->label }}', '{{ $child->url }}', {{ $child->parent_id }}, {{ $child->sort_order }}, {{ $child->is_active ? 'true' : 'false' }})">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('admin.settings.header.destroy-menu', $child->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this submenu?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">No menu items found. Click "Add Menu Item" to create one.</p>
        @endif
    </div>
</div>

<!-- Add Menu Modal -->
<div class="modal fade" id="addMenuModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Menu Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.settings.header.store-menu') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Menu Label <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="label" required placeholder="e.g., Home">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="text" class="form-control" name="url" placeholder="e.g., / or https://example.com">
                        <small class="text-muted">Leave empty for parent menus with submenus</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Parent Menu</label>
                        <select class="form-control" name="parent_id">
                            <option value="">-- Top Level Menu --</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->label }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Select a parent menu to create a submenu</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" min="0" value="0">
                        <small class="text-muted">Lower numbers appear first</small>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="add_is_active" checked>
                        <label class="form-check-label" for="add_is_active">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Menu Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Menu Modal -->
<div class="modal fade" id="editMenuModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Menu Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editMenuForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Menu Label <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="label" id="edit_label" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="text" class="form-control" name="url" id="edit_url">
                        <small class="text-muted">Leave empty for parent menus with submenus</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Parent Menu</label>
                        <select class="form-control" name="parent_id" id="edit_parent_id">
                            <option value="">-- Top Level Menu --</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" id="edit_sort_order" min="0">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="edit_is_active">
                        <label class="form-check-label" for="edit_is_active">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Menu Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function editMenu(id, label, url, parentId, sortOrder, isActive) {
    document.getElementById('editMenuForm').action = '{{ route("admin.settings.header.update-menu", ":id") }}'.replace(':id', id);
    document.getElementById('edit_label').value = label;
    document.getElementById('edit_url').value = url || '';
    document.getElementById('edit_parent_id').value = parentId || '';
    document.getElementById('edit_sort_order').value = sortOrder;
    document.getElementById('edit_is_active').checked = isActive;
    
    var editModal = new bootstrap.Modal(document.getElementById('editMenuModal'));
    editModal.show();
}
</script>
@endsection

