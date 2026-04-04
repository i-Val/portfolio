
@extends('layouts.site')
@section('content')
        <!--Blog Banner Start-->
        <section class="blog-banner wave-secondary">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>{{ $post->title }}</h1>
                        <div class="bread-crumb">
                            <a href='{{route("home")}}'>Home</a>
                            >
                            <a href='{{route("blogs")}}'>Blog</a>
                            >
                            <span class="current-page" >Single Blog</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--Creative Background Wave-->
            <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1400 100" preserveAspectRatio="none">
                <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z"/>
            </svg>
        </section>
        <!--Blog Banner End-->

        <!--Single Blog Post Area Start-->
        <section id="single-blog-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="single-blog-details wow fadeInUp" data-wow-delay="0.4s">
                            <div class="blog-featured-image">
                                <!--image-->
                                @php
                                    $image = $post->cover_image;
                                    if (! $image) {
                                        $image = asset('assets/images/blog/img-1.jpg');
                                    } elseif (! str_starts_with($image, 'http://') && ! str_starts_with($image, 'https://') && ! str_starts_with($image, '/')) {
                                        $image = Storage::url($image);
                                    }
                                @endphp
                                <img class="img-fluid" src='{{ $image }}' alt="">
                            </div>
                            <!--heading-->
                            <h2>{{ $post->title }}</h2>
                            <div class="blog-meta">
                                <span>
                                    <i class="fa fa-user"></i>
                                    Posted By Admin
                                </span>
                                <span>
                                    <i class="fa fa-calendar"></i>
                                    {{ ($post->published_at ?? $post->created_at)?->format('d F Y') }}
                                </span>
                                <span>
                                    <i class="fa fa-eye"></i>
                                    <span id="blog-views-count">{{ $stats['views'] ?? 0 }}</span>
                                </span>
                                <span>
                                    <i class="fa fa-heart"></i>
                                    <span id="blog-likes-count">{{ $stats['likes'] ?? 0 }}</span>
                                </span>
                                <span>
                                    <i class="fa fa-share-alt"></i>
                                    <span id="blog-shares-count">{{ $stats['shares'] ?? 0 }}</span>
                                </span>
                                <span>
                                    <i class="fa fa-comment"></i>
                                    <span>{{ $stats['comments'] ?? 0 }}</span>
                                </span>
                            </div>
                            <div class="mt-3">
                                <button
                                    type="button"
                                    id="blog-like-btn"
                                    class="btn btn-sm {{ ($liked ?? false) ? 'btn-danger' : 'btn-outline-danger' }}"
                                    data-liked="{{ ($liked ?? false) ? '1' : '0' }}"
                                    style="margin-right: 8px;"
                                >
                                    {{ ($liked ?? false) ? 'Liked' : 'Like' }}
                                </button>
                                <a
                                    class="btn btn-sm btn-outline-primary"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-share-platform="facebook"
                                    style="margin-right: 8px;"
                                >
                                    Share
                                </a>
                                <a
                                    class="btn btn-sm btn-outline-info"
                                    href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}"
                                    target="_blank"
                                    rel="noopener"
                                    data-share-platform="twitter"
                                >
                                    Tweet
                                </a>
                            </div>
                            <!--content-->
                            <div class="blog-content">
                                {!! $post->body !!}
                            </div>
                        </div>
                        <!--discussion area-->
                        <div class="discussion-area wow fadeInUp" wow-data-delay="0.6s">
                            <div class="discussion-list-area">
                                <h3 class="discussion-title">{{ $stats['comments'] ?? 0 }} Comments on this post</h3>
                                <ul class="discussion-list">
                                    @forelse (($comments ?? []) as $comment)
                                        <li class="discussion-item">
                                            <div class="row">
                                                <div class="col-md-2 col-sm-2">
                                                    <img src='{{asset("assets/images/blog/comment-author.jpg")}}' alt="">
                                                </div>
                                                <div class="col-md-10 col-sm-10">
                                                    <div class="discussion-meta">
                                                        <h5>{{ $comment->name }}</h5>
                                                        <p>{{ $comment->created_at?->format('d F Y') }}</p>
                                                    </div>
                                                    <div class="discussion-content">
                                                        <p style="white-space: pre-wrap;">{{ $comment->body }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="discussion-item">
                                            <div class="discussion-content">
                                                <p>No comments yet.</p>
                                            </div>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>


                            <!--discussion form area-->
                            <div class="discussion-form-container wow fadeInUp" wow-data-delay="0.8s">
                                <h3>Leave a comment</h3>
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
                                <!--form start-->
                                <form method="POST" action="{{ route('blogs.comment', $post) }}">
                                    @csrf
                                    <div class="controls">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!--name-->
                                                    <input id="form-name" type="text" name="name" class="form-control" placeholder="Name*" value="{{ old('name') }}" required>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!--email-->
                                                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Email (optional)" value="{{ old('email') }}">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <!--message-->
                                                    <textarea id="form_message" name="body" class="form-control" placeholder="Message*" rows="7" required>{{ old('body') }}</textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="main-button">Submit Comment</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <script>
                            (function () {
                                var csrf = @json(csrf_token());
                                var likeBtn = document.getElementById('blog-like-btn');
                                var likesCountEl = document.getElementById('blog-likes-count');
                                var sharesCountEl = document.getElementById('blog-shares-count');

                                function postJson(url, body) {
                                    return fetch(url, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': csrf,
                                            'X-Requested-With': 'XMLHttpRequest',
                                            Accept: 'application/json',
                                        },
                                        body: JSON.stringify(body || {}),
                                    }).then(function (res) {
                                        return res.json();
                                    });
                                }

                                if (likeBtn && likesCountEl) {
                                    likeBtn.addEventListener('click', function () {
                                        postJson(@json(route('blogs.like', $post)), {}).then(function (data) {
                                            if (typeof data.likes === 'number') {
                                                likesCountEl.textContent = data.likes;
                                            }
                                            if (data.liked) {
                                                likeBtn.textContent = 'Liked';
                                                likeBtn.classList.remove('btn-outline-danger');
                                                likeBtn.classList.add('btn-danger');
                                            } else {
                                                likeBtn.textContent = 'Like';
                                                likeBtn.classList.remove('btn-danger');
                                                likeBtn.classList.add('btn-outline-danger');
                                            }
                                        });
                                    });
                                }

                                document.querySelectorAll('[data-share-platform]').forEach(function (el) {
                                    el.addEventListener('click', function () {
                                        var platform = el.getAttribute('data-share-platform');
                                        postJson(@json(route('blogs.share', $post)), { platform: platform }).then(function (data) {
                                            if (sharesCountEl && typeof data.shares === 'number') {
                                                sharesCountEl.textContent = data.shares;
                                            }
                                        });
                                    });
                                });
                            })();
                        </script>

                    </div>

                    <!--sidebar column-->
                    <div id="sidebar" class="col-lg-4 col-md-12">
                        <div class="widget search">
                            <form class="search-form">
                                <input type="search" placeholder="Search here...">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget featured-post">
                            <h3 class="widget-heading">
                                Featured Post
                            </h3>
                            <img class="img-fluid" src='{{asset("assets/images/blog/img-1.jpg")}}' alt="">
                            <p>Sit tempore illum non vitae porro Iusto neque atque sit laudantium labore Labore blanditiis dolor eos voluptas et cum, possimus.</p>
                            <a class="main-button" href="#">Read More</a>
                        </div>
                        <div class="widget social">
                            <h3 class="widget-heading">Follow Me On</h3>
                            <ul class="social-icons">
                                @if($profile?->facebook_url)
                                <li>
                                    <a href="{{ $profile->facebook_url }}" target="_blank" rel="noopener">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                @endif
                                @if($profile?->twitter_url)
                                <li>
                                    <a href="{{ $profile->twitter_url }}" target="_blank" rel="noopener">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                @endif
                                @if($profile?->google_plus_url)
                                <li>
                                    <a href="{{ $profile->google_plus_url }}" target="_blank" rel="noopener">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                @endif
                                @if($profile?->dribbble_url)
                                <li>
                                    <a href="{{ $profile->dribbble_url }}" target="_blank" rel="noopener">
                                        <i class="fa fa-dribbble"></i>
                                    </a>
                                </li>
                                @endif
                                @if($profile?->github_url)
                                <li>
                                    <a href="{{ $profile->github_url }}" target="_blank" rel="noopener">
                                        <i class="fa fa-github"></i>
                                    </a>
                                </li>
                                @endif
                                @if($profile?->linkedin_url)
                                <li>
                                    <a href="{{ $profile->linkedin_url }}" target="_blank" rel="noopener">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                                @endif
                                @if($profile?->instagram_url)
                                <li>
                                    <a href="{{ $profile->instagram_url }}" target="_blank" rel="noopener">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                                @endif
                                @if($profile?->youtube_url)
                                <li>
                                    <a href="{{ $profile->youtube_url }}" target="_blank" rel="noopener">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Blog Post Area End-->
@endsection
