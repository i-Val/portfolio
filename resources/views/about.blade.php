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
                    <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 about-intro text-center wow fadeInUp" data-wow-delay="0.2s">
                        <h2 class="text-uppercase marbtm-40">About Me</h2>
                        <p>
                            @if ($profile?->bio)
                                {{ $profile->bio }}
                            @else
                                I’m <strong>Adrian Jones</strong>. I am a graphic designer, and I'm very passionate and dedicated to my work. With 10 years experience as a professional graphic designer and web developer. I have acquired the skills and knowledge necessary to make your project a success.
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-10 offset-xl-1 col-lg-12 about-info-container">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 about-info">
                                <div class="info-item">
                                    <img src='{{asset("assets/images/about.jpg")}}' alt="">
                                </div>
                                <div class="info-item">
                                    <p><span>Name : </span>{{ $profile?->name ?? 'Adrian Jones' }}</p>
                                </div>
                                <div class="info-item">
                                    <p><span>Birthday : </span>{{ $profile?->birthdate?->format('d F Y') ?? '21 June 1992' }}</p>
                                </div>
                                <div class="info-item">
                                    <p><span>Phone Number : </span>{{ $profile?->phone ?? '(1) 123 456 789' }}</p>
                                </div>
                                <div class="info-item">
                                    <p><span>E-Mail : </span>{{ $profile?->email ?? 'example@example.com' }}</p>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12 about-skills">
                                <h3 class="text-uppercase">Skills</h3>
                                <div class="progress-box">
                                    <p>html5 & css3 <span class="pull-right">90%</span></p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-box">
                                    <p>PHP <span class="pull-right">82%</span></p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-box">
                                    <p>Wordpress <span class="pull-right">87%</span></p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-box">
                                    <p>Javascript <span class="pull-right">95%</span></p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
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
