@extends('layouts.admin')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Services</h4>
                        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">New Service</a>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Active</th>
                                            <th>Order</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($services as $service)
                                            <tr>
                                                <td>
                                                    <div class="fw-semibold">{{ $service->title }}</div>
                                                    <div class="text-muted">{{ $service->icon }}</div>
                                                </td>
                                                <td>
                                                    @if ($service->is_active)
                                                        <span class="badge bg-success">Yes</span>
                                                    @else
                                                        <span class="badge bg-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td>{{ $service->sort_order }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-soft-primary">Edit</a>
                                                    <form method="POST" action="{{ route('admin.services.destroy', $service) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-soft-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No services yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

