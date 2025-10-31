@extends('admin.layout')

@section('title', 'Testimonials')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Testimonials</h2>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Quote</th>
                    <th>Rating</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $testimonial)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $testimonial->customer_image) }}" alt="{{ $testimonial->customer_name }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                                <div>
                                    <strong>{{ $testimonial->customer_name }}</strong><br>
                                    <small class="text-muted">{{ $testimonial->customer_location }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ Str::limit($testimonial->quote, 100) }}</td>
                        <td>
                            @for($i = 0; $i < $testimonial->rating; $i++)
                                <i class="bi bi-star-fill text-warning"></i>
                            @endfor
                        </td>
                        <td>{{ $testimonial->sort_order }}</td>
                        <td>
                            @if($testimonial->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                        <td colspan="6" class="text-center">No testimonials found. <a href="{{ route('admin.testimonials.create') }}">Add one</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

