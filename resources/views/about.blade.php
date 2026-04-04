@extends('layouts.site')
@section('content')
        <section class="blog-banner wave-secondary">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>About</h1>
                        <div class="bread-crumb">
                            <a href='{{route("home")}}'>Home</a>
                            >
                            <span class="current-page">About</span>
                        </div>
                    </div>
                </div>
            </div>
            <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1400 100" preserveAspectRatio="none">
                <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z"/>
            </svg>
        </section>

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
                                    @if ($profile?->about_text)
                                        {!! $profile->about_text !!}
                                    @elseif ($profile?->bio)
                                        {!! nl2br(e($profile->bio)) !!}
                                    @else
                                        <p>I’m <strong>Adrian Jones</strong>. I am a graphic designer, and I'm very passionate and dedicated to my work. With 10 years experience as a professional graphic designer and web developer. I have acquired the skills and knowledge necessary to make your project a success.</p>
                                    @endif
                                </div>
                                
                                @if ($profile?->github_url || $profile?->linkedin_url || $profile?->twitter_url)
                                <div class="about-footer-socials mt-4 pt-4" style="border-top: 1px solid #eee;">
                                    <div style="display: flex; gap: 20px; align-items: center;">
                                        <span style="font-weight: 600; color: #333;">Connect with me:</span>
                                        @if ($profile?->github_url)
                                            <a href="{{ $profile->github_url }}" target="_blank" rel="noopener" style="font-size: 24px; color: #333; transition: transform 0.3s ease, color 0.3s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
                                                <i class="fa fa-github"></i>
                                            </a>
                                        @endif
                                        @if ($profile?->linkedin_url)
                                            <a href="{{ $profile->linkedin_url }}" target="_blank" rel="noopener" style="font-size: 24px; color: #0077b5; transition: transform 0.3s ease, color 0.3s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        @endif
                                        @if ($profile?->twitter_url)
                                            <a href="{{ $profile->twitter_url }}" target="_blank" rel="noopener" style="font-size: 24px; color: #1da1f2; transition: transform 0.3s ease, color 0.3s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1400 100" preserveAspectRatio="none">
                <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z"/>
            </svg>
        </section>
@endsection
