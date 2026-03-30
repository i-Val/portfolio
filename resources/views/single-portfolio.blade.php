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

        <section id="single-portfolio-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="single-blog-details wow fadeInUp" data-wow-delay="0.4s">
                            @php
                                $image = $project->image;
                                if (! $image) {
                                    $image = asset('assets/images/portfolio/item-1.jpg');
                                } elseif (! str_starts_with($image, 'http://') && ! str_starts_with($image, 'https://') && ! str_starts_with($image, '/')) {
                                    $image = Storage::url($image);
                                }
                            @endphp
                            <img class="img-fluid mb-3" src='{{ $image }}' alt="">
                            <h2 class="mb-2">{{ $project->title }}</h2>
                            @if ($project->category)
                                <div class="text-muted mb-3">{{ $project->category }}</div>
                            @endif
                            @if ($project->project_url)
                                <div class="mb-3">
                                    <a class="btn btn-primary" href="{{ $project->project_url }}" target="_blank" rel="noopener">Visit Project</a>
                                </div>
                            @endif
                            <div class="blog-content" style="white-space: pre-wrap;">{{ $project->description }}</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Project Info</h5>
                                <div class="mb-1"><strong>Category:</strong> {{ $project->category ?: 'N/A' }}</div>
                                <div class="mb-1"><strong>Published:</strong> {{ $project->created_at?->format('d F Y') }}</div>
                                @if ($project->project_url)
                                    <div class="mt-2">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ $project->project_url }}" target="_blank" rel="noopener">Open in new tab</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

