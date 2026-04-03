@extends('layouts.site')
@section('content')
        <section class="blog-banner wave-secondary">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>{{ $project->title }}</h1>
                        <div class="bread-crumb">
                            <a href='{{route("home")}}'>Home</a>
                            >
                            <a href='{{route("portfolio")}}'>Portfolio</a>
                            >
                            <span class="current-page">Project</span>
                        </div>
                    </div>
                </div>
            </div>
            <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1400 100" preserveAspectRatio="none">
                <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z"/>
            </svg>
        </section>

        <section id="single-portfolio-area" style="padding: 80px 0;">
            <div class="container">
                @php
                    $image = $project->image;
                    if (! $image) {
                        $image = asset('assets/images/portfolio/item-1.jpg');
                    } elseif (! str_starts_with($image, 'http://') && ! str_starts_with($image, 'https://') && ! str_starts_with($image, '/')) {
                        $image = Storage::url($image);
                    }
                @endphp
                
                <!-- Hero Image Section -->
                <div class="row pb-5">
                    <div class="col-md-12 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="portfolio-hero-image" style="border-radius: 8px; overflow: hidden; box-shadow: 0 15px 30px rgba(0,0,0,0.1);">
                            <img src="{{ $image }}" alt="{{ $project->title }}" style="width: 100%; height: auto; object-fit: cover; max-height: 650px; display: block;">
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <!-- Project Description -->
                    <div class="col-lg-8 col-md-12 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="single-project-description" style="padding-right: 20px;">
                            <h2 style="font-weight: 700; margin-bottom: 25px; text-transform: uppercase;">Project Overview</h2>
                            <div class="blog-content" style="white-space: pre-wrap; font-size: 16px; line-height: 1.8; color: #555;">{{ $project->description }}</div>
                        </div>
                    </div>

                    <!-- Project Info Sidebar -->
                    <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="project-info-sidebar" style="background: #ffffff; padding: 40px 30px; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">
                            <h4 style="font-weight: 700; text-transform: uppercase; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 15px;">Project Info</h4>
                            
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <li style="margin-bottom: 20px;">
                                    <h6 style="color: #888; font-size: 13px; text-transform: uppercase; margin-bottom: 5px; font-weight: 600;"><i class="fa fa-folder-open-o" style="margin-right: 8px;"></i>Category</h6>
                                    <p style="font-weight: 500; margin-bottom: 0; font-size: 16px; color: #333;">{{ $project->category ?: 'N/A' }}</p>
                                </li>
                                
                                <li style="margin-bottom: 20px;">
                                    <h6 style="color: #888; font-size: 13px; text-transform: uppercase; margin-bottom: 5px; font-weight: 600;"><i class="fa fa-calendar-o" style="margin-right: 8px;"></i>Completed On</h6>
                                    <p style="font-weight: 500; margin-bottom: 0; font-size: 16px; color: #333;">{{ $project->created_at?->format('F d, Y') }}</p>
                                </li>
                            </ul>

                            @if ($project->project_url)
                                <div style="margin-top: 35px;">
                                    <a class="main-button" href="{{ $project->project_url }}" target="_blank" rel="noopener" style="display: block; text-align: center; font-weight: 600;">
                                        Live Preview <i class="fa fa-external-link" style="margin-left: 8px;"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

