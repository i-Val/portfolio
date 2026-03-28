@extends('layouts.site')
@section('content')
        <section class="blog-banner wave-secondary">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Services</h1>
                        <div class="bread-crumb">
                            <a href='{{route("home")}}'>Home</a>
                            >
                            <span class="current-page">Services</span>
                        </div>
                    </div>
                </div>
            </div>
            <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1400 100" preserveAspectRatio="none">
                <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z"/>
            </svg>
        </section>

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
            <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1400 100" preserveAspectRatio="none">
                <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z"/>
            </svg>
        </section>
@endsection
