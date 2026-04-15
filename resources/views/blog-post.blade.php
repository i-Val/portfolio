<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <link rel="shortcut icon" href="{{ $siteProfile?->favicon ? Storage::url($siteProfile->favicon) : asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400;500;600;700&amp;family=Playfair+Display:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/skins/deeporange.css') }}">
    <script src="{{ asset('assets/js/modernizr.js') }}"></script>
</head>
<body class="dark">
<div id="wrapper" data-simplebar>
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>

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
                            <span><span class="material-icons">person</span> {{ $profile?->name ?? 'Admin' }}</span>
                            <span class="date"><span class="material-icons">date_range</span> {{ $date?->format('d M Y') }}</span>
                            <span><span class="material-icons">visibility</span> {{ $stats['views'] }} views</span>
                            <span><span class="material-icons">favorite</span> {{ $stats['likes'] }} likes</span>
                        </div>
                        <img src="{{ $coverImage }}" class="img-fluid" alt="{{ $post->title }}">
                        <h2>{{ $post->title }}</h2>
                        @if($post->excerpt)<p>{{ $post->excerpt }}</p>@endif
                        <div>{!! nl2br(e($post->body)) !!}</div>

                        <div class="mt-4">
                            <p class="mb-0">Likes: {{ $stats['likes'] }} | Shares: {{ $stats['shares'] }} | Comments: {{ $stats['comments'] }}</p>
                        </div>

                        <div class="mt-5">
                            <h4>{{ $stats['comments'] }} Comments</h4>
                            @forelse($comments as $comment)
                                <div class="mb-3">
                                    <strong>{{ $comment->name }}</strong>
                                    <small class="d-block">{{ $comment->created_at?->format('d M Y H:i') }}</small>
                                    <p class="mb-0">{{ $comment->body }}</p>
                                </div>
                            @empty
                                <p>No comments yet.</p>
                            @endforelse
                        </div>

                        <div class="mt-4">
                            <h4>Leave a Comment</h4>
                            @if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
                            @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                            <form method="POST" action="{{ route('blogs.comment', $post) }}">
                                @csrf
                                <div class="row contactform">
                                    <div class="col-12 col-md-6"><input type="text" name="name" placeholder="YOUR NAME" value="{{ old('name') }}" required></div>
                                    <div class="col-12 col-md-6"><input type="email" name="email" placeholder="YOUR EMAIL" value="{{ old('email') }}"></div>
                                    <div class="col-12"><textarea name="body" placeholder="YOUR COMMENT" required>{{ old('body') }}</textarea></div>
                                    <div class="col-12"><button type="submit" class="btn main-btn"><span>Post Comment</span></button></div>
                                </div>
                            </form>
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
</body>
</html>
