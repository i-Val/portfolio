<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $post->title }}</title>
    <link rel="shortcut icon" href="{{ $siteProfile?->favicon ? Storage::url($siteProfile->favicon) : asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400;500;600;700&amp;family=Playfair+Display:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/skins/black.css') }}">
    <script src="{{ asset('assets/js/modernizr.js') }}"></script>
</head>
<body class="dark">
<div id="wrapper" data-simplebar>
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>

    @include('partials.nav', ['active' => 'blog'])

    @php
        $date = $post->published_at ?: $post->created_at;
        $coverImage = $post->cover_image ? Storage::url($post->cover_image) : asset('assets/images/blog/blog-post-1.jpg');
    @endphp

    <div class="section blog-section" id="blog">
        <div id="blog-content">
            <div class="container">
                <div class="row">
                    <div class="col-12 post-container single-post-container">
                        <a href="{{ route('blogs') }}" class="link-blog"><span class="material-icons">keyboard_arrow_left</span> Back to Blog</a>
                        <div class="meta d-inline-block">
                            @if($profile?->show_name ?? true)
                                <span><span class="material-icons">person</span> {{ $profile?->name ?? 'Admin' }}</span>
                            @endif
                            <span class="date"><span class="material-icons">date_range</span> {{ $date?->format('d M Y') }}</span>
                            <span><span class="material-icons">visibility</span> {{ $stats['views'] }} views</span>
                            <span><span class="material-icons">favorite</span> <span id="meta-likes-count">{{ $stats['likes'] }}</span> likes</span>
                        </div>
                        <img src="{{ $coverImage }}" class="img-fluid" alt="{{ $post->title }}">
                        <h2>{{ $post->title }}</h2>
                        @if($post->excerpt)<p>{{ $post->excerpt }}</p>@endif
                        <div>{!! nl2br(e($post->body)) !!}</div>

                        <div class="mt-4 blog-actions d-flex flex-wrap align-items-center gap-3">
                            <button id="btn-like" type="button" class="btn action-btn {{ $isLiked ? 'active' : '' }}">
                                <span class="material-icons">{{ $isLiked ? 'favorite' : 'favorite_border' }}</span>
                                <span id="likes-label">{{ $isLiked ? 'Liked' : 'Like' }}</span>
                                (<span id="likes-count">{{ $stats['likes'] }}</span>)
                            </button>
                            <button id="btn-share" type="button" class="btn action-btn">
                                <span class="material-icons">share</span>
                                <span>Share</span>
                                (<span id="shares-count">{{ $stats['shares'] }}</span>)
                            </button>
                            <span id="share-copied" class="share-copied d-none"><span class="material-icons">check</span> Link copied!</span>
                        </div>

                        <div class="mt-5 blog-comments-section">
                            <h4 class="mb-4">{{ $stats['comments'] }} Comments</h4>
                            <div class="blog-comments-list">
                                @forelse($comments as $comment)
                                    <div class="comment-item">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <strong class="comment-author text-white">{{ $comment->name }}</strong>
                                            <small class="text-muted">{{ $comment->created_at?->format('d M Y H:i') }}</small>
                                        </div>
                                        <p class="mb-0 text-secondary">{{ $comment->body }}</p>
                                    </div>
                                @empty
                                    <p class="text-muted">No comments yet. Be the first to comment!</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="mt-5 comment-form-container">
                            <div class="comment-form-box">
                                <div class="form-header mb-4">
                                    <h4 class="form-title mb-1">
                                        <span class="material-icons align-middle me-2">mode_comment</span>Leave a Comment
                                    </h4>
                                    <p class="form-subtitle mb-0">Join the discussion. Your email address will not be published.</p>
                                </div>

                                @if(session('status'))
                                    <div class="alert alert-success d-flex align-items-center mb-4">
                                        <span class="material-icons me-2">check_circle</span>
                                        <div>{{ session('status') }}</div>
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger mb-4">
                                        <ul class="mb-0 ps-3">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('blogs.comment', $post, false) }}" class="blog-comment-form">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label for="comment-name" class="form-label">Name <span class="text-danger">*</span></label>
                                            <div class="input-group-custom">
                                                <span class="input-icon"><span class="material-icons">person_outline</span></span>
                                                <input id="comment-name" type="text" name="name" class="form-input" placeholder="Your name" value="{{ old('name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="comment-email" class="form-label">Email <small class="text-muted">(Optional)</small></label>
                                            <div class="input-group-custom">
                                                <span class="input-icon"><span class="material-icons">mail_outline</span></span>
                                                <input id="comment-email" type="email" name="email" class="form-input" placeholder="your@email.com" value="{{ old('email') }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="comment-body" class="form-label">Comment <span class="text-danger">*</span></label>
                                            <textarea id="comment-body" name="body" class="form-input form-textarea" rows="5" placeholder="Write your thoughts or response..." required>{{ old('body') }}</textarea>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn comment-submit-btn">
                                                <span>Post Comment</span>
                                                <span class="material-icons ms-2">send</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script>
    (function () {
        var btnLike = document.getElementById('btn-like');
        var btnShare = document.getElementById('btn-share');
        var csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (btnLike && csrf) {
            btnLike.addEventListener('click', function () {
                btnLike.disabled = true;
                fetch("{{ route('blogs.like', $post->id) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    var likesCount = document.getElementById('likes-count');
                    var metaLikes = document.getElementById('meta-likes-count');
                    var likesLabel = document.getElementById('likes-label');
                    var icon = btnLike.querySelector('.material-icons');

                    if (likesCount) likesCount.textContent = data.likes;
                    if (metaLikes) metaLikes.textContent = data.likes;

                    if (data.liked) {
                        btnLike.classList.add('active');
                        if (icon) icon.textContent = 'favorite';
                        if (likesLabel) likesLabel.textContent = 'Liked';
                    } else {
                        btnLike.classList.remove('active');
                        if (icon) icon.textContent = 'favorite_border';
                        if (likesLabel) likesLabel.textContent = 'Like';
                    }
                })
                .catch(function (err) {
                    console.error(err);
                })
                .finally(function () {
                    btnLike.disabled = false;
                });
            });
        }

        if (btnShare && csrf) {
            btnShare.addEventListener('click', function () {
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(window.location.href);
                }
                var copied = document.getElementById('share-copied');
                if (copied) {
                    copied.classList.remove('d-none');
                    setTimeout(function () { copied.classList.add('d-none'); }, 3000);
                }
                fetch("{{ route('blogs.share', $post->id) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ platform: 'web' })
                })
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    var sharesCount = document.getElementById('shares-count');
                    if (sharesCount) sharesCount.textContent = data.shares;
                })
                .catch(function (err) {
                    console.error(err);
                });
            });
        }
    })();
</script>
</body>
</html>
