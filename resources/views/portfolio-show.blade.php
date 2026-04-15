<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->title }}</title>
    <link rel="shortcut icon" href="{{ $siteProfile?->favicon ? Storage::url($siteProfile->favicon) : asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400;500;600;700&amp;family=Playfair+Display:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/skins/grey.css') }}">
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
        $projectImage = $project->image ? Storage::url($project->image) : asset('assets/images/projects/1.jpg');
    @endphp

    <div class="section work-section" id="work">
        <div id="work-content">
            <div class="container">
                <div class="row">
                    <div class="col-12 post-container single-post-container">
                        <a href="{{ route('home') }}#work" class="link-blog"><span class="material-icons">keyboard_arrow_left</span> Back to Portfolio</a>

                        <div class="meta d-inline-block">
                            <span><span class="material-icons">cases</span> {{ $project->category ?: 'Portfolio' }}</span>
                        </div>

                        <img src="{{ $projectImage }}" class="img-fluid" alt="{{ $project->title }}">
                        <h2>{{ $project->title }}</h2>

                        @if($project->description)
                            <div>{!! nl2br(e($project->description)) !!}</div>
                        @endif

                        @if($project->project_url)
                            <div class="mt-4">
                                <a href="{{ $project->project_url }}" target="_blank" rel="noopener" class="btn main-btn"><span>visit</span></a>
                            </div>
                        @endif
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
