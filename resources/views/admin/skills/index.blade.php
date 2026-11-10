@extends('layouts.admin')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Skills</h4>
                        <div class="d-flex align-items-center gap-3">
                            <form method="POST" action="{{ route('dashboard.skills-percent') }}">
                                @csrf
                                @method('PATCH')
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="show_skill_percent" value="1" id="show_skill_percent" onchange="this.form.submit()" @checked($siteProfile?->show_skill_percent ?? true)>
                                    <label class="form-check-label" for="show_skill_percent">Show skill %</label>
                                </div>
                            </form>
                            <a href="{{ route('admin.skills.create') }}" class="btn btn-primary">New Skill</a>
                        </div>
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
                                            <th>Icon</th>
                                            <th>Title</th>
                                            <th>Percent</th>
                                            <th>Active</th>
                                            <th>Order</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($skills as $skill)
                                            <tr>
                                                <td>
                                                    @if($skill->icon)
                                                        <img src="{{ Storage::url($skill->icon) }}" alt="{{ $skill->title }}" style="height: 28px; width: 28px; object-fit: contain;">
                                                    @endif
                                                </td>
                                                <td class="fw-semibold">{{ $skill->title }}</td>
                                                <td>{{ $skill->percent }}%</td>
                                                <td>
                                                    @if ($skill->is_active)
                                                        <span class="badge bg-success">Yes</span>
                                                    @else
                                                        <span class="badge bg-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td>{{ $skill->sort_order }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-sm btn-soft-primary">Edit</a>
                                                    <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-soft-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No skills yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{ $skills->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
