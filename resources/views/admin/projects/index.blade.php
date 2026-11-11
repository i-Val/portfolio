@extends('layouts.admin')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Portfolio</h4>
                        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">New Item</a>
                    </div>
                    <div id="featured-toggle-feedback" class="alert alert-success {{ session('status') ? '' : 'd-none' }}" role="status">
                        {{ session('status') }}
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Photos</th>
                                            <th>Featured</th>
                                            <th>Order</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($projects as $project)
                                            @php
                                                $photoCount = ($project->image ? 1 : 0) + $project->images_count;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="fw-semibold">{{ $project->title }}</div>
                                                    <div class="text-muted">{{ $project->slug }}</div>
                                                </td>
                                                <td>{{ $project->category }}</td>
                                                <td>
                                                    <span class="badge bg-secondary">{{ $photoCount }} {{ Str::plural('photo', $photoCount) }}</span>
                                                </td>
                                                <td>
                                                    <form
                                                        method="POST"
                                                        action="{{ route('admin.projects.toggle-featured', $project) }}"
                                                        class="d-inline js-featured-toggle-form"
                                                    >
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="is_featured" value="{{ $project->is_featured ? 0 : 1 }}" class="js-featured-next-value">
                                                        <div class="form-check form-switch mb-0 d-inline-flex align-items-center gap-2">
                                                            <input
                                                                class="form-check-input js-featured-checkbox"
                                                                type="checkbox"
                                                                role="switch"
                                                                id="featured_toggle_{{ $project->id }}"
                                                                style="cursor: pointer;"
                                                                aria-label="Toggle featured for {{ $project->title }}"
                                                                @checked($project->is_featured)
                                                            >
                                                            <label
                                                                class="form-check-label small fw-semibold js-featured-label {{ $project->is_featured ? 'text-success' : 'text-secondary' }}"
                                                                for="featured_toggle_{{ $project->id }}"
                                                                style="cursor: pointer;"
                                                            >
                                                                {{ $project->is_featured ? 'Yes' : 'No' }}
                                                            </label>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>{{ $project->sort_order }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-soft-primary">Edit</a>
                                                    <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-soft-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No portfolio items yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function () {
            var feedback = document.getElementById('featured-toggle-feedback');

            document.addEventListener('change', function (event) {
                var checkbox = event.target.closest('.js-featured-checkbox');
                if (!checkbox) {
                    return;
                }

                var form = checkbox.closest('.js-featured-toggle-form');
                if (!form) {
                    return;
                }

                var nextInput = form.querySelector('.js-featured-next-value');
                var label = form.querySelector('.js-featured-label');
                var formData = new FormData(form);

                checkbox.disabled = true;

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData,
                })
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error('Failed to update featured status');
                        }
                        return response.json();
                    })
                    .then(function (data) {
                        var isFeatured = Boolean(data.is_featured);
                        checkbox.checked = isFeatured;
                        if (nextInput) {
                            nextInput.value = isFeatured ? '0' : '1';
                        }
                        if (label) {
                            label.textContent = isFeatured ? 'Yes' : 'No';
                            label.classList.toggle('text-success', isFeatured);
                            label.classList.toggle('text-secondary', !isFeatured);
                        }
                        if (feedback && data.message) {
                            feedback.textContent = data.message;
                            feedback.classList.remove('d-none', 'alert-danger');
                            feedback.classList.add('alert-success');
                        }
                    })
                    .catch(function () {
                        checkbox.checked = !checkbox.checked;
                        if (feedback) {
                            feedback.textContent = 'Could not update featured status. Please try again.';
                            feedback.classList.remove('d-none', 'alert-success');
                            feedback.classList.add('alert-danger');
                        }
                    })
                    .finally(function () {
                        checkbox.disabled = false;
                    });
            });
        })();
    </script>
@endpush

