@extends('layouts.site')
@section('content')
        <!--Banner Section Start-->
        <section id="banner" class="wave-primary" style="background-image: url('{{ asset("assets/images/background/home-header-bg.jpg") }}')">
            <div class="banner-text">
                <h1 class="text-uppercase">{{ $profile?->name ?? 'Adrian Jones' }}</h1>
                <!--Typed String-->
                <div id="typed-strings">
                    <p>Graphics Designer.</p>
                    <p>Freelancer.</p>
                    <p>Web Designer.</p>
                    <p>Programmer.</p>
                </div>
                <span id="typed"></span>
            </div>
            <!--Creative Background Wave-->
            <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1400 100" preserveAspectRatio="none">
                <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z"/>
            </svg>
        </section>
        <!--Banner Section End-->

        <!--About Section Start-->
        <section id="about" class="wave-secondary">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1 col-lg-12 py-5">
                        <div class="row align-items-center">
                            <!-- Image Column -->
                            <div class="col-lg-5 col-md-12 mb-5 mb-lg-0 text-center wow fadeInLeft" data-wow-delay="0.2s">
                                @php
                                    $aboutImage = asset('assets/images/about.jpg');
                                    if ($profile?->about_image) {
                                        $aboutImage = str_starts_with($profile->about_image, 'http') || str_starts_with($profile->about_image, '/') ? $profile->about_image : Storage::url($profile->about_image);
                                    }
                                @endphp
                                <img src='{{ $aboutImage }}' alt="About Me" class="img-fluid" style="border-radius: 8px; box-shadow: 0 15px 40px rgba(0,0,0,0.1); width: 100%; max-width: 400px;">
                            </div>
                            <!-- Text Column -->
                            <div class="col-lg-7 col-md-12 about-info wow fadeInRight" data-wow-delay="0.4s" style="text-align: left; padding-left: 40px;">
                                <h2 class="text-uppercase" style="font-weight: 700; letter-spacing: 2px; margin-bottom: 20px;">About Me</h2>
                                <div style="width: 60px; height: 3px; background-color: #333; margin-bottom: 30px;"></div>
                                <div style="font-size: 16px; line-height: 1.8; color: #666;">
                                    @if ($profile?->bio)
                                        {!! nl2br(e($profile->bio)) !!}
                                    @else
                                        <p>I’m <strong>Adrian Jones</strong>. I am a graphic designer, and I'm very passionate and dedicated to my work. With 10 years experience as a professional graphic designer and web developer. I have acquired the skills and knowledge necessary to make your project a success.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Creative Background Wave-->
            <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1400 100" preserveAspectRatio="none">
                <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z"/>
            </svg>
        </section>
        <!--About Section End-->

        <!--Portfolio Section Start-->
        <section id="portfolio" class="wave-primary">
            <div class="container">
                <div class="portfolio-header padbtm-60">
                    <h2 class="text-uppercase">Portfolio</h2>
                    <div class="portfolio-filter">
                        <ul>
                            <li class="sel-item" data-filter="*">All</li>
                            <li data-filter=".web-design">Web Design</li>
                            <li data-filter=".application">Applications</li>
                            <li data-filter=".development">Development</li>
                        </ul>
                    </div>
                </div>
                <!--portfolio items-->
                <div class="row portfolio-items">
                    @if (isset($projects) && $projects->count())
                        @foreach ($projects as $project)
                            @php
                                $category = strtolower($project->category ?? '');
                                $filterClass = str_contains($category, 'web') ? 'web-design' : (str_contains($category, 'app') ? 'application' : 'development');
                                $image = $project->image;
                                if (! $image) {
                                    $image = asset('assets/images/portfolio/item-'.(($loop->index % 6) + 1).'.jpg');
                                } elseif (! str_starts_with($image, 'http://') && ! str_starts_with($image, 'https://') && ! str_starts_with($image, '/')) {
                                    $image = Storage::url($image);
                                }
                            @endphp
                            <div class="col-lg-4 col-md-6 single-item {{ $filterClass }} wow fadeInUp" data-wow-delay="0.2s">
                                <a class="" href="{{ route('portfolio.show', $project->slug) }}">
                                    <img src="{{ $image }}" alt="">
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-4 col-md-6 single-item application wow fadeInUp" data-wow-delay="0.2s">
                            <a class="" href='javascript:void(0)'>
                                <img src='{{asset("assets/images/portfolio/item-1.jpg")}}' alt="">
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 single-item web-design wow fadeInUp" data-wow-delay="0.4s">
                            <a class="" href='javascript:void(0)'>
                                <img src='{{asset("assets/images/portfolio/item-2.jpg")}}' alt="">
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 single-item web-design wow fadeInUp" data-wow-delay="0.6s">
                            <a class="" href='javascript:void(0)'>
                                <img src='{{asset("assets/images/portfolio/item-3.jpg")}}' alt="">
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 single-item development wow fadeInUp" data-wow-delay="0.8s">
                            <a class="" href='javascript:void(0)'>
                                <img src='{{asset("assets/images/portfolio/item-4.jpg")}}' alt="">
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 single-item application wow fadeInUp" data-wow-delay="1s">
                            <a class="" href='javascript:void(0)'>
                                <img src='{{asset("assets/images/portfolio/item-5.jpg")}}' alt="">
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 single-item web-design wow fadeInUp" data-wow-delay="1.2s">
                            <a class="" href='javascript:void(0)'>
                                <img src='{{asset("assets/images/portfolio/item-6.jpg")}}' alt="">
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <!--Creative Background Wave-->
            <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1400 100" preserveAspectRatio="none">
                <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z"/>
            </svg>
        </section>
        <!--Portfolio Section End-->

        <!--Services Section Start-->
        <section id="services" class="wave-secondary">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 class="text-uppercase marbtm-60">What i Do</h2>
                    </div>
                    @if (isset($services) && $services->count())
                        @foreach ($services as $service)
                            <div class="col-lg-4 col-md-6 wow fadeInDown" data-wow-delay="0.2s">
                                <div class="services-item">
                                    <i class="{{ $service->icon ?: 'fa fa-code' }} fa-2x"></i>
                                    <h3>{{ $service->title }}</h3>
                                    <p>{{ $service->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-4 col-md-6 wow fadeInDown" data-wow-delay="0.2s">
                            <div class="services-item">
                                <i class="fa fa-code fa-2x"></i>
                                <h3>Web Design</h3>
                                <p>Amet illo quos cumque reiciendis vitae dolorum Quas delectus corporis nihil omnis nam labore excepturi error.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInDown" data-wow-delay="0.4s">
                            <div class="services-item">
                                <i class="fa fa-cube fa-2x"></i>
                                <h3>Development</h3>
                                <p>Amet illo quos cumque reiciendis vitae dolorum Quas delectus corporis nihil omnis nam labore excepturi error.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInDown" data-wow-delay="0.6s">
                            <div class="services-item">
                                <i class="fa fa-camera fa-2x"></i>
                                <h3>Graphics Design</h3>
                                <p>Amet illo quos cumque reiciendis vitae dolorum Quas delectus corporis nihil omnis nam labore excepturi error.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInDown" data-wow-delay="0.8s">
                            <div class="services-item">
                                <i class="fa fa-mobile-phone fa-2x"></i>
                                <h3>Responsive Design</h3>
                                <p>Amet illo quos cumque reiciendis vitae dolorum Quas delectus corporis nihil omnis nam labore excepturi error.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInDown" data-wow-delay="1.0s">
                            <div class="services-item">
                                <i class="fa fa-thumbs-up fa-2x"></i>
                                <h3>Seo Friendly</h3>
                                <p>Amet illo quos cumque reiciendis vitae dolorum Quas delectus corporis nihil omnis nam labore excepturi error.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInDown" data-wow-delay="1.2s">
                            <div class="services-item">
                                <i class="fa fa-life-ring fa-2x"></i>
                                <h3>Support</h3>
                                <p>Amet illo quos cumque reiciendis vitae dolorum Quas delectus corporis nihil omnis nam labore excepturi error.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!--Creative Background Wave-->
            <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1400 100" preserveAspectRatio="none">
                <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z"/>
            </svg>
        </section>
        <!--Services Section End-->

        <!--Blog Section Start-->
        <section id="blog" class="wave-primary">
            <div class="container">
                <h2 class="text-uppercase padbtm-40 text-center">Latest News</h2>
                <div class="row">
                    @if (isset($posts) && $posts->count())
                        @foreach ($posts as $post)
                            @php
                                $image = $post->cover_image;
                                if (! $image) {
                                    $image = asset('assets/images/blog/img-'.(($loop->index % 3) + 1).'.jpg');
                                } elseif (! str_starts_with($image, 'http://') && ! str_starts_with($image, 'https://') && ! str_starts_with($image, '/')) {
                                    $image = Storage::url($image);
                                }
                                $date = $post->published_at ?? $post->created_at;
                            @endphp
                            <a class='blog-post col-lg-4 col-md-6 wow fadeInUp' data-wow-delay='0.3s' href='{{ route("single-blog", ["id" => $post->id]) }}'>
                                <div class="post-image">
                                    <img src='{{ $image }}' alt="">
                                </div>
                                <h3 class="post-title">{{ $post->title }}</h3>
                                <p class="post-body">{{ $post->excerpt }}</p>
                                <div class="post-meta"><span>Admin </span>- {{ $date?->format('d F Y') }}</div>
                            </a>
                        @endforeach
                    @else
                        <a class='blog-post col-lg-4 col-md-6 wow fadeInLeft' data-wow-delay='0.3s' href='{{route("single-blog", ["id" => 1])}}'>
                            <div class="post-image">
                                <img src='{{asset("assets/images/blog/img-1.jpg")}}' alt="">
                            </div>
                            <h3 class="post-title">Blog Heading</h3>
                            <p class="post-body">Lorem sit mollitia deserunt ea at. Laudantium nostrum asperiores nulla tempora modi eveniet est Consequuntur repellat totam itaque earum optio hic nulla quia.</p>
                            <div class="post-meta"><span>John Doe </span>- 21 December 2024</div>
                        </a>
                        <a class='blog-post col-lg-4 col-md-6 wow fadeInUp' data-wow-delay='0.3s' href='{{route("single-blog", ["id" => 2])}}'>
                            <div class="post-image">
                                <img src='{{asset("assets/images/blog/img-2.jpg")}}' alt="">
                            </div>
                            <h3 class="post-title">Blog Heading</h3>
                            <p class="post-body">Lorem sit mollitia deserunt ea at. Laudantium nostrum asperiores nulla tempora modi eveniet est Consequuntur repellat totam itaque earum optio hic nulla quia.</p>
                            <div class="post-meta"><span>John Doe </span>- 1 July 2024</div>
                        </a>
                        <a class='blog-post col-lg-4 col-md-6 wow fadeInRight' data-wow-delay='0.3s' href='{{route("single-blog", ["id" => 3])}}'>
                            <div class="post-image">
                                <img src='{{asset("assets/images/blog/img-3.jpg")}}' alt="">
                            </div>
                            <h3 class="post-title">Blog Heading</h3>
                            <p class="post-body">Lorem sit mollitia deserunt ea at. Laudantium nostrum asperiores nulla tempora modi eveniet est Consequuntur repellat totam itaque earum optio hic nulla quia.</p>
                            <div class="post-meta"><span>Jeff Doe </span>- 2 September 2024</div>
                        </a>
                    @endif

                </div>
                <div class="view-more-button"><a class='main-button' href='{{route("blogs")}}'>View More</a></div>

            </div>
            <!--Creative Background Wave-->
            <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1400 100" preserveAspectRatio="none">
                <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z"/>
            </svg>
        </section>
        <!--Blog Section End-->

        <!--Contact Us Section Start-->
        <section id="contact">
            <div class="container">
                <div class="row">
                    <!--contact info-->
                    <div class="col-md-4 col-sm-12 address-box">
                        <h2 class="text-left">Get in touch</h2>
                        <div class="contact-info wow fadeInUp" data-wow-delay="0.3s">
                            <!--Contact Item-->
                            <div class="contact-item">
                                <h4>Address</h4>
                                <p>{{ $siteProfile?->location ?? '1324 Lorem Ipsum, USA' }}</p>
                            </div>
                            <!--Contact Item-->
                            <div class="contact-item">
                                <h4>Email</h4>
                                <p>{{ $siteProfile?->email ?? 'example@example.com' }}</p>
                            </div>
                            <!--Contact Item-->
                            <div class="contact-item">
                                <h4>Telephone</h4>
                                <p>{{ $siteProfile?->phone ?? '+00 123 456 789' }}</p>
                            </div>
                        </div>
                    </div>
                    <!--form section-->
                    <div class="col-md-8 col-sm-12 wow fadeInRight message-box" data-wow-delay="0.6s">
                        <h2 class="text-right">Send Us A Message</h2>
                        <!--form start-->
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
                        <form id="contactForm" method="POST" action="{{ route('contact.submit') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <!--name-->
                                    <input type="text" class="form-control con-validate" id="contact-name" name="name" placeholder="Name" minlength="3" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <!--email-->
                                    <input type="email" class="form-control con-validate" id="contact-email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <!--message box-->
                                    <input type="text" class="form-control con-validate mb-3" id="contact-subject" name="subject" placeholder="Subject (optional)" value="{{ old('subject') }}">
                                    <textarea class="form-control con-validate" id="contact-message" name="message" placeholder="Message" rows="4" required>{{ old('message') }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <button id="contact-submit" class="main-button" type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!--Contact Us Section Start-->
@endsection
