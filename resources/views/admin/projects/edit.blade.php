@extends('layouts.admin')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Edit Portfolio Item</h4>
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-soft-secondary">Back</a>
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
                            <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" value="{{ old('title', $project->title) }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" name="slug" value="{{ old('slug', $project->slug) }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <input type="text" name="category" value="{{ old('category', $project->category) }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Project URL</label>
                                    <input type="text" name="project_url" value="{{ old('project_url', $project->project_url) }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Primary Cover Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    @if ($project->image)
                                        <div class="mt-2">
                                            <img
                                                src="{{ str_starts_with($project->image, 'http') || str_starts_with($project->image, '/') ? $project->image : Storage::url($project->image) }}"
                                                alt="{{ $project->title }}"
                                                style="max-height: 90px;"
                                            >
                                        </div>
                                    @endif
                                </div>
                                @if ($project->images->isNotEmpty())
                                    <div class="mb-3">
                                        <label class="form-label">Existing Angle Images ({{ $project->images->count() }})</label>
                                        <div class="row g-3">
                                            @foreach ($project->images as $angleImage)
                                                @php
                                                    $angleSrc = str_starts_with($angleImage->image_path, 'http') || str_starts_with($angleImage->image_path, '/')
                                                        ? $angleImage->image_path
                                                        : Storage::url($angleImage->image_path);
                                                @endphp
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="border rounded p-2 h-100 d-flex flex-column gap-2">
                                                        <img
                                                            src="{{ $angleSrc }}"
                                                            alt="{{ $angleImage->caption ?: $project->title }}"
                                                            class="img-fluid rounded"
                                                            style="height: 110px; width: 100%; object-fit: cover;"
                                                        >
                                                        <div>
                                                            <label class="form-label form-label-sm mb-1">Angle Caption</label>
                                                            <input
                                                                type="text"
                                                                name="existing_captions[{{ $angleImage->id }}]"
                                                                value="{{ old('existing_captions.'.$angleImage->id, $angleImage->caption) }}"
                                                                class="form-control form-control-sm"
                                                                placeholder="e.g. Rear / Mobile View"
                                                                maxlength="255"
                                                            >
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                                            <div style="max-width: 90px;">
                                                                <label class="form-label form-label-sm mb-1">Order</label>
                                                                <input
                                                                    type="number"
                                                                    min="0"
                                                                    name="existing_sort_orders[{{ $angleImage->id }}]"
                                                                    value="{{ old('existing_sort_orders.'.$angleImage->id, $angleImage->sort_order) }}"
                                                                    class="form-control form-control-sm"
                                                                >
                                                            </div>
                                                            <div class="form-check pt-3">
                                                                <input
                                                                    class="form-check-input"
                                                                    type="checkbox"
                                                                    name="delete_gallery_images[]"
                                                                    value="{{ $angleImage->id }}"
                                                                    id="delete_angle_{{ $angleImage->id }}"
                                                                    @checked(in_array($angleImage->id, old('delete_gallery_images', [])))
                                                                >
                                                                <label class="form-check-label text-danger" for="delete_angle_{{ $angleImage->id }}">
                                                                    Remove
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                @include('admin.projects.partials.gallery-upload', ['label' => 'Add More Angle Images'])
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" rows="4" class="form-control">{{ old('description', $project->description) }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3 d-flex align-items-end">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" @checked(old('is_featured', $project->is_featured))>
                                            <label class="form-check-label" for="is_featured">Featured</label>
                                        </div>
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
