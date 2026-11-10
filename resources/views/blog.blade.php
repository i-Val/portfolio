<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile?->name ? $profile->name . ' - Blog' : 'Blog' }}</title>
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

    <div class="section blog-section" id="blog">
        <div id="blog-content">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-12">
                        <a href="{{ route('home') }}" class="link-blog"><span class="material-icons">keyboard_arrow_left</span> Back to Home</a>
                    </div>
                </div>
                <div class="heading text-left text-md-center">
                    <h2>my <span>blog</span></h2>
                </div>
                <div class="row">
                    @forelse($posts as $post)
                        @php
                            $date = $post->published_at ?: $post->created_at;
                            $coverImage = $post->cover_image ? Storage::url($post->cover_image) : asset('assets/images/blog/blog-post-1.jpg');
                        @endphp
                        <div class="col-12 col-md-6 col-lg-4 blog-grid-item">
                            <div class="blog-grid-card">
                                <div class="post-thumb">
                                    <a href="{{ route('single-blog', $post->id) }}">
                                        <img src="{{ $coverImage }}" class="img-fluid" alt="{{ $post->title }}">
                                    </a>
                                    <div class="post-date-badge">
                                        <span class="day">{{ $date?->format('d') }}</span>
                                        <span class="month">{{ strtoupper($date?->format('M')) }}</span>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <div class="entry-header">
                                        <a href="{{ route('single-blog', $post->id) }}" class="post-title">{{ $post->title }}</a>
                                        <p class="post-excerpt">{{ Str::limit(strip_tags($post->excerpt ?: $post->body), 110) }}</p>
                                    </div>
                                    <div class="post-footer">
                                        <a href="{{ route('single-blog', $post->id) }}" class="read-more-link">
                                            <span>read more</span> <i class="fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12"><p class="text-center">No blog posts published yet.</p></div>
                    @endforelse
                </div>
                <div class="row">
                    <div class="col-12 text-center mt-4">
                        {{ $posts->links() }}
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
