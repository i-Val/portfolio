@extends('layouts.admin')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Edit Skill</h4>
                        <a href="{{ route('admin.skills.index') }}" class="btn btn-soft-secondary">Back</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('admin.skills.update', $skill) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" value="{{ old('title', $skill->title) }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Icon (PNG/JPG/SVG/WebP)</label>
                                    <input type="file" name="icon" class="form-control">
                                    @if($skill->icon)
                                        <div class="mt-2">
                                            <img src="{{ Storage::url($skill->icon) }}" alt="{{ $skill->title }}" style="height: 48px; width: 48px; object-fit: contain;">
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Percent (0-100)</label>
                                        <input type="number" name="percent" value="{{ old('percent', $skill->percent) }}" min="0" max="100" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order) }}" min="0" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $skill->is_active))>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
