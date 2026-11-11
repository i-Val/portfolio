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

    @include('partials.nav', ['active' => 'work'])

    @php
        $resolveImage = static fn (?string $path): ?string => $path
            ? (str_starts_with($path, 'http') || str_starts_with($path, '/') ? $path : Storage::url($path))
            : null;

        $gallery = collect();
        if ($coverSrc = $resolveImage($project->image)) {
            $gallery->push([
                'src' => $coverSrc,
                'caption' => 'Main View',
            ]);
        }

        foreach ($project->images as $angleImage) {
            if ($angleSrc = $resolveImage($angleImage->image_path)) {
                $gallery->push([
                    'src' => $angleSrc,
                    'caption' => $angleImage->caption ?: 'Angle '.($gallery->count() + 1),
                ]);
            }
        }

        if ($gallery->isEmpty()) {
            $gallery->push([
                'src' => asset('assets/images/projects/1.jpg'),
                'caption' => 'Main View',
            ]);
        }
    @endphp

    <div class="section work-section" id="work">
        <div id="work-content">
            <div class="container">
                <div class="row">
                    <div class="col-12 post-container single-post-container">
                        <a href="{{ route('home') }}#work" class="link-blog"><span class="material-icons">keyboard_arrow_left</span> Back to Portfolio</a>

                        <div class="meta d-inline-block">
                            <span><span class="material-icons">cases</span> {{ $project->category ?: 'Portfolio' }}</span>
                            @if($gallery->count() > 1)
                                <span class="ms-3"><span class="material-icons">photo_library</span> {{ $gallery->count() }} Angles</span>
                            @endif
                        </div>

                        <div class="project-gallery" data-project-gallery>
                            <div class="gallery-stage">
                                <img
                                    src="{{ $gallery->first()['src'] }}"
                                    alt="{{ $project->title }} - {{ $gallery->first()['caption'] }}"
                                    class="img-fluid gallery-stage-img"
                                    id="gallery-active-img"
                                    role="button"
                                    tabindex="0"
                                    title="Click to enlarge"
                                >

                                @if($gallery->count() > 1)
                                    <button type="button" class="gallery-nav-btn gallery-nav-btn--prev" id="gallery-prev-btn" aria-label="Previous angle">
                                        <span class="material-icons">chevron_left</span>
                                    </button>
                                    <button type="button" class="gallery-nav-btn gallery-nav-btn--next" id="gallery-next-btn" aria-label="Next angle">
                                        <span class="material-icons">chevron_right</span>
                                    </button>
                                @endif

                                <button type="button" class="gallery-zoom-btn" id="gallery-zoom-btn" aria-label="Open full-screen preview">
                                    <span class="material-icons">zoom_in</span>
                                </button>
                            </div>

                            <div class="gallery-caption-bar">
                                <span class="gallery-caption-text" id="gallery-active-caption">{{ $gallery->first()['caption'] }}</span>
                                <span class="gallery-counter" id="gallery-counter">1 / {{ $gallery->count() }}</span>
                            </div>

                            @if($gallery->count() > 1)
                                <div class="gallery-thumbs" role="tablist" aria-label="Project angles">
                                    @foreach($gallery as $index => $slide)
                                        <button
                                            type="button"
                                            class="gallery-thumb-btn {{ $index === 0 ? 'is-active' : '' }}"
                                            data-gallery-index="{{ $index }}"
                                            data-src="{{ $slide['src'] }}"
                                            data-caption="{{ $slide['caption'] }}"
                                            aria-label="View {{ $slide['caption'] }}"
                                        >
                                            <img src="{{ $slide['src'] }}" alt="{{ $project->title }} - {{ $slide['caption'] }}" class="gallery-thumb-img">
                                            <span class="gallery-thumb-label">{{ $slide['caption'] }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>

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

<div class="gallery-lightbox" id="gallery-lightbox" aria-hidden="true">
    <button type="button" class="gallery-lightbox-close" id="gallery-lightbox-close" aria-label="Close preview">
        <span class="material-icons">close</span>
    </button>
    @if($gallery->count() > 1)
        <button type="button" class="gallery-nav-btn gallery-nav-btn--prev" id="lightbox-prev-btn" aria-label="Previous angle">
            <span class="material-icons">chevron_left</span>
        </button>
        <button type="button" class="gallery-nav-btn gallery-nav-btn--next" id="lightbox-next-btn" aria-label="Next angle">
            <span class="material-icons">chevron_right</span>
        </button>
    @endif
    <div class="gallery-lightbox-body">
        <img src="{{ $gallery->first()['src'] }}" alt="{{ $project->title }}" class="gallery-lightbox-img" id="lightbox-img">
        <div class="gallery-lightbox-caption">
            <span id="lightbox-caption">{{ $gallery->first()['caption'] }}</span>
            <span id="lightbox-counter">1 / {{ $gallery->count() }}</span>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script>
    (function () {
        var galleryRoot = document.querySelector('[data-project-gallery]');
        if (!galleryRoot) {
            return;
        }

        var slides = @json($gallery->values());
        if (!slides.length) {
            return;
        }

        var currentIndex = 0;
        var projectTitle = @json($project->title);
        var activeImg = document.getElementById('gallery-active-img');
        var activeCaption = document.getElementById('gallery-active-caption');
        var counter = document.getElementById('gallery-counter');
        var thumbButtons = Array.prototype.slice.call(galleryRoot.querySelectorAll('.gallery-thumb-btn'));
        var prevBtn = document.getElementById('gallery-prev-btn');
        var nextBtn = document.getElementById('gallery-next-btn');
        var zoomBtn = document.getElementById('gallery-zoom-btn');

        var lightbox = document.getElementById('gallery-lightbox');
        var lightboxImg = document.getElementById('lightbox-img');
        var lightboxCaption = document.getElementById('lightbox-caption');
        var lightboxCounter = document.getElementById('lightbox-counter');
        var lightboxClose = document.getElementById('gallery-lightbox-close');
        var lightboxPrev = document.getElementById('lightbox-prev-btn');
        var lightboxNext = document.getElementById('lightbox-next-btn');

        function render(index) {
            currentIndex = (index + slides.length) % slides.length;
            var slide = slides[currentIndex];
            var counterText = (currentIndex + 1) + ' / ' + slides.length;

            if (activeImg) {
                activeImg.src = slide.src;
                activeImg.alt = projectTitle + ' - ' + slide.caption;
            }
            if (activeCaption) {
                activeCaption.textContent = slide.caption;
            }
            if (counter) {
                counter.textContent = counterText;
            }
            if (lightboxImg) {
                lightboxImg.src = slide.src;
                lightboxImg.alt = projectTitle + ' - ' + slide.caption;
            }
            if (lightboxCaption) {
                lightboxCaption.textContent = slide.caption;
            }
            if (lightboxCounter) {
                lightboxCounter.textContent = counterText;
            }

            thumbButtons.forEach(function (btn, idx) {
                btn.classList.toggle('is-active', idx === currentIndex);
            });
        }

        function openLightbox() {
            if (!lightbox) {
                return;
            }
            lightbox.classList.add('is-open');
            lightbox.setAttribute('aria-hidden', 'false');
        }

        function closeLightbox() {
            if (!lightbox) {
                return;
            }
            lightbox.classList.remove('is-open');
            lightbox.setAttribute('aria-hidden', 'true');
        }

        thumbButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var idx = parseInt(btn.getAttribute('data-gallery-index'), 10);
                if (!isNaN(idx)) {
                    render(idx);
                }
            });
        });

        if (prevBtn) {
            prevBtn.addEventListener('click', function () { render(currentIndex - 1); });
        }
        if (nextBtn) {
            nextBtn.addEventListener('click', function () { render(currentIndex + 1); });
        }
        if (lightboxPrev) {
            lightboxPrev.addEventListener('click', function () { render(currentIndex - 1); });
        }
        if (lightboxNext) {
            lightboxNext.addEventListener('click', function () { render(currentIndex + 1); });
        }
        if (activeImg) {
            activeImg.addEventListener('click', openLightbox);
            activeImg.addEventListener('keydown', function (event) {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    openLightbox();
                }
            });
        }
        if (zoomBtn) {
            zoomBtn.addEventListener('click', openLightbox);
        }
        if (lightboxClose) {
            lightboxClose.addEventListener('click', closeLightbox);
        }
        if (lightbox) {
            lightbox.addEventListener('click', function (event) {
                if (event.target === lightbox) {
                    closeLightbox();
                }
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'ArrowLeft' && slides.length > 1) {
                render(currentIndex - 1);
            } else if (event.key === 'ArrowRight' && slides.length > 1) {
                render(currentIndex + 1);
            } else if (event.key === 'Escape' && lightbox && lightbox.classList.contains('is-open')) {
                closeLightbox();
            }
        });
    })();
</script>
</body>
</html>
