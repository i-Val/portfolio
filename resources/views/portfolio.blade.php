@extends('layouts.site')
@section('content')
    <section class="blog-banner wave-secondary">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Portfolio</h1>
                    <div class="bread-crumb">
                        <a href='{{route("home")}}'>Home</a>
                        >
                        <span class="current-page">Portfolio</span>
                    </div>
                </div>
            </div>
        </div>
        <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 1400 100" preserveAspectRatio="none">
            <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z" />
        </svg>
    </section>

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
            <div class="row portfolio-items">
                @if (isset($projects) && $projects->count())
                    @foreach ($projects as $project)
                        @php
                            $category = strtolower($project->category ?? '');
                            $filterClass = str_contains($category, 'web') ? 'web-design' : (str_contains($category, 'app') ? 'application' : 'development');
                            $image = $project->image;
                            if (!$image) {
                                $image = asset('assets/images/portfolio/item-' . (($loop->index % 6) + 1) . '.jpg');
                            } elseif (!str_starts_with($image, 'http://') && !str_starts_with($image, 'https://') && !str_starts_with($image, '/')) {
                                $image = Storage::url($image);
                            }
                            $excerpt = trim(strip_tags((string) $project->description));
                            if (strlen($excerpt) > 140) {
                                $excerpt = mb_substr($excerpt, 0, 140) . '…';
                            }
                        @endphp
                        <div class="col-lg-4 col-md-6 single-item {{ $filterClass }} fadeInUp" data-wow-delay="0.2s">
                            <div class="card h-100 border-0 shadow-sm">
                                <a class="" href="{{ route('portfolio.show', $project->slug) }}">
                                    <img src='{{ $image }}' alt="" class="card-img-top">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title mb-1"><a
                                            href="{{ route('portfolio.show', $project->slug) }}">{{ $project->title }}</a></h5>
                                    <div class="text-muted mb-2">{{ $project->category }}</div>
                                    @if ($excerpt)
                                        <p class="card-text">{{ $excerpt }}</p>
                                    @endif
                                </div>
                                <div class="card-footer bg-transparent border-0 d-flex gap-2">
                                    <a href="{{ route('portfolio.show', $project->slug) }}"
                                        class="btn btn-sm btn-outline-primary">Details</a>
                                    @if ($project->project_url)
                                        <a href="{{ $project->project_url }}" class="btn btn-sm btn-primary" target="_blank">Visit</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-4 col-md-6 single-item application wow fadeInUp" data-wow-delay="0.2s">
                        <a class="" href=''>
                            <img src='{{asset("assets/images/portfolio/item-1.jpg")}}' alt="">
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 single-item web-design wow fadeInUp" data-wow-delay="0.4s">
                        <a class="" href=''>
                            <img src='{{asset("assets/images/portfolio/item-2.jpg")}}' alt="">
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 single-item web-design wow fadeInUp" data-wow-delay="0.6s">
                        <a class="" href=''>
                            <img src='{{asset("assets/images/portfolio/item-3.jpg")}}' alt="">
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 single-item development wow fadeInUp" data-wow-delay="0.8s">
                        <a class="" href=''>
                            <img src='{{asset("assets/images/portfolio/item-4.jpg")}}' alt="">
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 single-item application wow fadeInUp" data-wow-delay="1s">
                        <a class="" href=''>
                            <img src='{{asset("assets/images/portfolio/item-5.jpg")}}' alt="">
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 single-item web-design wow fadeInUp" data-wow-delay="1.2s">
                        <a class="" href=''>
                            <img src='{{asset("assets/images/portfolio/item-6.jpg")}}' alt="">
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 1400 100" preserveAspectRatio="none">
            <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z" />
        </svg>
    </section>
@endsection