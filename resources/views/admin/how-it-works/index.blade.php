@extends('admin.layout')

@section('title', 'How It Works')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>How It Works</h2>
    <a href="{{ route('admin.how-it-works.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New Step
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Step #</th>
                        <th>Title</th>
                        <th>Badge</th>
                        <th>Heading</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($steps as $step)
                        <tr>
                            <td><strong>{{ str_pad($step->step_number, 2, '0', STR_PAD_LEFT) }}</strong></td>
                            <td>{{ $step->step_title }}</td>
                            <td>{{ $step->badge_text ?? '-' }}</td>
                            <td>{{ Str::limit($step->heading, 30) }}</td>
                            <td>{{ $step->sort_order }}</td>
                            <td>
                                @if($step->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.how-it-works.edit', $step) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.how-it-works.destroy', $step) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                            <td colspan="7" class="text-center py-4">No steps found. <a href="{{ route('admin.how-it-works.create') }}">Add one</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

