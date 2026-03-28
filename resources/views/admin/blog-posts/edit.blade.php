@extends('layouts.admin')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
    <style>
        #blog-body-editor {
            height: 380px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editorEl = document.getElementById('blog-body-editor');
            var inputEl = document.getElementById('blog-body-input');
            if (!editorEl || !inputEl) {
                return;
            }

            var quill = new Quill(editorEl, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        [{ align: [] }],
                        ['link', 'blockquote', 'code-block'],
                        ['clean'],
                    ],
                },
            });

            var initialHtml = @json(old('body', $blogPost->body));
            if (initialHtml) {
                quill.root.innerHTML = initialHtml;
            }

            editorEl.closest('form').addEventListener('submit', function () {
                inputEl.value = quill.root.innerHTML;
            });
        });
    </script>
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Edit Blog Post</h4>
                        <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-soft-secondary">Back</a>
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
                            <form method="POST" action="{{ route('admin.blog-posts.update', $blogPost) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" value="{{ old('title', $blogPost->title) }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" name="slug" value="{{ old('slug', $blogPost->slug) }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Excerpt</label>
                                    <textarea name="excerpt" rows="3" class="form-control">{{ old('excerpt', $blogPost->excerpt) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Body</label>
                                    <input type="hidden" name="body" id="blog-body-input" value="{{ old('body', $blogPost->body) }}">
                                    <div id="blog-body-editor" class="bg-white"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Cover Image</label>
                                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                                    @if ($blogPost->cover_image)
                                        <div class="mt-2">
                                            <img
                                                src="{{ str_starts_with($blogPost->cover_image, 'http') || str_starts_with($blogPost->cover_image, '/') ? $blogPost->cover_image : Storage::url($blogPost->cover_image) }}"
                                                alt=""
                                                style="max-height: 90px;"
                                            >
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Published At</label>
                                        <input type="datetime-local" name="published_at" value="{{ old('published_at', optional($blogPost->published_at)->format('Y-m-d\\TH:i')) }}" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3 d-flex align-items-end">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published" @checked(old('is_published', $blogPost->is_published))>
                                            <label class="form-check-label" for="is_published">Published</label>
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
