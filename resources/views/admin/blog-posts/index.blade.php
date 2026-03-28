@extends('layouts.admin')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Blog Posts</h4>
                        <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-primary">New Post</a>
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
                                            <th>Published</th>
                                            <th>Updated</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($posts as $post)
                                            <tr>
                                                <td>
                                                    <div class="fw-semibold">{{ $post->title }}</div>
                                                    <div class="text-muted">{{ $post->slug }}</div>
                                                </td>
                                                <td>
                                                    @if ($post->is_published)
                                                        <span class="badge bg-success">Yes</span>
                                                    @else
                                                        <span class="badge bg-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td>{{ $post->updated_at?->format('Y-m-d') }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('admin.blog-posts.edit', $post) }}" class="btn btn-sm btn-soft-primary">Edit</a>
                                                    <form method="POST" action="{{ route('admin.blog-posts.destroy', $post) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-soft-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No posts yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

