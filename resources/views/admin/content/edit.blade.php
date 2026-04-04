@extends('layouts.admin')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
    <style>
        #about-text-editor {
            height: 380px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editorEl = document.getElementById('about-text-editor');
            var inputEl = document.getElementById('about-text-input');
            if (!editorEl || !inputEl) return;

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

            var initialHtml = @json(old('about_text', $profile->about_text));
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
            <div class="row mb-3">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1">Content Settings</h4>
                            <div class="text-muted">Manage hero headline, alternating text, and about text.</div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-soft-secondary">Back to dashboard</a>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.content.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="hero_image" class="form-label">Hero Background Image</label>
                                        <input type="file" id="hero_image" name="hero_image" class="form-control" accept="image/*">
                                        @if ($profile->hero_image)
                                            <div class="mt-2">
                                                <img src="{{ \Illuminate\Support\Facades\Storage::url($profile->hero_image) }}" alt="Current Hero Image" style="max-height: 100px; border-radius: 4px;">
                                            </div>
                                        @endif
                                        <span class="text-muted small">This image will be displayed behind the hero text on the homepage.</span>
                                    </div>
                                    <div class="col-12">
                                        <label for="hero_headline" class="form-label">Hero Headline</label>
                                        <input type="text" id="hero_headline" name="hero_headline" class="form-control" value="{{ old('hero_headline', $profile->hero_headline) }}" placeholder="e.g. Adrian Jones">
                                        <span class="text-muted small">This is the main headline displayed over the hero banner.</span>
                                    </div>
                                    <div class="col-12">
                                        <label for="alternating_text" class="form-label">Alternating Text (Comma separated)</label>
                                        <input type="text" id="alternating_text" name="alternating_text" class="form-control" value="{{ old('alternating_text', $profile->alternating_text) }}" placeholder="e.g. Graphics Designer, Freelancer, Web Designer">
                                        <span class="text-muted small">This text types and alternates on the homepage banner.</span>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">About Text</label>
                                        <input type="hidden" name="about_text" id="about-text-input">
                                        <div id="about-text-editor" class="bg-white"></div>
                                        <span class="text-muted small mt-1 d-block">This will be used in the about section on the home page and the about page instead of bio, if provided.</span>
                                    </div>
                                    <div class="col-12 mt-4 text-end">
                                        <button type="submit" class="btn btn-primary">Save Content</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
