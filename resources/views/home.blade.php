@php
    $showName = $profile?->show_name ?? true;
    $showHeadline = $profile?->show_headline ?? true;
    $showBirthdate = $profile?->show_birthdate ?? true;
    $showPhone = $profile?->show_phone ?? true;
    $showLocation = $profile?->show_location ?? true;
    $showEmail = $profile?->show_email ?? true;
@endphp
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $showName && $profile?->name ? $profile->name . ' - Portfolio' : 'Portfolio' }}</title>
    <link rel="shortcut icon" href="{{ $siteProfile?->favicon ? Storage::url($siteProfile->favicon) : asset('favicon.ico') }}">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400;500;600;700&amp;family=Playfair+Display:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/skins/black.css') }}">
    <script src="{{ asset('assets/js/modernizr.js') }}"></script>
</head>
<body class="dark index">
<div id="wrapper" class="page" data-simplebar>
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>

    <div id="transitionblock"></div>
    <div id="navigation" class="is-fixed">
        <a href="#" class="navigation-trigger">Menu<span></span></a>
        <nav id="main-navigation">
            <ul>
                <li><a href="#home" class="link-page link-home active"><span class="material-icons">home</span>home</a></li>
                <li><a href="#about" class="link-page link-about"><span class="material-icons">article</span>about</a></li>
                <li><a href="#services" class="link-page"><span class="material-icons">build</span>services</a></li>
                <li><a href="#work" class="link-page link-work"><span class="material-icons">cases</span>portfolio</a></li>
                <li><a href="#contact" class="link-page"><span class="material-icons">email</span>contact</a></li>
                <li><a href="#blog" class="link-page"><span class="material-icons">topic</span>blog</a></li>
            </ul>
        </nav>
    </div>

    <div class="home-section" id="home">
        <div class="home-content">
            <ul class="circles">
                <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
            </ul>
            <div class="right-dotted-shape"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-section d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                @if($showName)
                                    <h2>hi ! i’m<span> {{ $profile?->name ?? 'Portfolio Owner' }}.</span></h2>
                                @else
                                    <h2>hello !<span> welcome.</span></h2>
                                @endif
                                @php
                                    $heroSubtitle = $showHeadline ? $profile?->headline : null;
                                @endphp
                                <p>{{ $heroSubtitle ?: ($profile?->bio ? Str::limit(strip_tags($profile->bio), 130) : 'Welcome to my portfolio website.') }}</p>
                                <div class="buttons">
                                    <a id="link-about" href="#about" class="btn main-btn link-page"><span>more about me</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="home-social d-none d-sm-block">
                <ul class="social list-unstyled d-flex m-0">
                    @if($siteProfile?->facebook_url)<li class="facebook"><a title="Facebook" href="{{ $siteProfile->facebook_url }}" target="_blank" rel="noopener"><i class="fa fa-facebook"></i></a></li>@endif
                    @if($siteProfile?->twitter_url)<li class="twitter"><a title="Twitter" href="{{ $siteProfile->twitter_url }}" target="_blank" rel="noopener"><i class="fa fa-twitter"></i></a></li>@endif
                    @if($siteProfile?->linkedin_url)<li class="linkedin"><a title="LinkedIn" href="{{ $siteProfile->linkedin_url }}" target="_blank" rel="noopener"><i class="fa fa-linkedin"></i></a></li>@endif
                    @if($siteProfile?->dribbble_url)<li class="dribbble"><a title="Dribbble" href="{{ $siteProfile->dribbble_url }}" target="_blank" rel="noopener"><i class="fa fa-dribbble"></i></a></li>@endif
                    @if($siteProfile?->instagram_url)<li class="instagram"><a title="Instagram" href="{{ $siteProfile->instagram_url }}" target="_blank" rel="noopener"><i class="fa fa-instagram"></i></a></li>@endif
                    @if($siteProfile?->github_url)<li class="github"><a title="GitHub" href="{{ $siteProfile->github_url }}" target="_blank" rel="noopener"><i class="fa fa-github"></i></a></li>@endif
                </ul>
            </div>

            @if($showEmail || ($showPhone && $profile?->phone))
                <div class="home-contact d-none d-sm-block">
                    <p>
                        Let's work together
                        @if($showEmail)
                            <a class="d-block" href="mailto:{{ $profile?->email }}">{{ $profile?->email ?? 'your@email.com' }}</a>
                        @endif
                        @if($showPhone)
                            <span>{{ $profile?->phone ?? '' }}</span>
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>

    <div class="section about-section" id="about">
        <div id="about-content">
            <div class="heading text-left text-md-center">
                <h2>about <span>me</span></h2>
            </div>
            <div class="container infos">
                <div class="row infos-holder align-items-center">
                    <div class="col-12 col-lg-5">
                        @php
                            $aboutPhoto = $profile?->about_image ? Storage::url($profile->about_image) : ($profile?->avatar ? Storage::url($profile->avatar) : asset('assets/images/man.jpg'));
                        @endphp
                        <img class="img-fluid d-block photo" src="{{ $aboutPhoto }}" alt="{{ $showName ? ($profile?->name ?? 'Profile photo') : 'Profile photo' }}">
                    </div>
                    <div class="col-12 col-lg-7">
                        <p class="m-0">{!! $profile?->about_text ?: ($profile?->bio ?: 'Update your About text from admin to introduce yourself here.') !!}</p>
                        @php
                            $aboutLeftItems = array_values(array_filter([
                                $showBirthdate ? ['icon' => 'cake', 'label' => 'Birthdate', 'value' => $profile?->birthdate?->format('d M Y') ?? 'N/A'] : null,
                                $showName ? ['icon' => 'person', 'label' => 'Name', 'value' => $profile?->name ?? 'N/A'] : null,
                                $showHeadline ? ['icon' => 'work', 'label' => 'Headline', 'value' => $profile?->headline ?? 'N/A'] : null,
                            ]));
                            $aboutRightItems = array_values(array_filter([
                                $showPhone ? ['icon' => 'call', 'label' => 'Phone', 'value' => $profile?->phone ?? 'N/A'] : null,
                                $showLocation ? ['icon' => 'location_on', 'label' => 'Address', 'value' => $profile?->location ?? 'N/A'] : null,
                                $showEmail ? ['icon' => 'email', 'label' => 'Email', 'value' => $profile?->email ?? 'N/A'] : null,
                            ]));
                        @endphp
                        @if(!empty($aboutLeftItems) || !empty($aboutRightItems))
                            <div class="row text-nowrap">
                                @foreach([$aboutLeftItems, $aboutRightItems] as $colIndex => $columnItems)
                                    @if(!empty($columnItems))
                                        <div class="d-flex col-12 col-sm-6 personal-list-container personal-list-container-{{ $colIndex + 1 }}">
                                            <ul class="list-unstyled personal-info w-100">
                                                @foreach($columnItems as $infoItem)
                                                    <li><p><span class="material-icons">{{ $infoItem['icon'] }}</span><span>{{ $infoItem['label'] }} : </span>{{ $infoItem['value'] }}</p></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        @if($profile?->resume_url)
                            <a href="{{ $profile->resume_url }}" class="btn main-btn" target="_blank" rel="noopener"><span>download my cv</span></a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="container skills mt-5">
                <div class="row">
                    <div class="col-12">
                        <h4 class="subtitle text-center">My skills</h4>
                    </div>
                    @php
                        $showSkillPercent = $siteProfile?->show_skill_percent ?? true;
                    @endphp
                    @forelse($skills as $skill)
                        @php $pct = max(0, min(100, (int) $skill->percent)); @endphp
                        <div class="col-12 col-sm-6 col-lg-3 mb-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    @if($skill->icon)
                                        <img src="{{ Storage::url($skill->icon) }}" alt="{{ $skill->title }}" style="height: 52px; width: 52px; object-fit: contain;">
                                    @endif
                                    <div class="mt-3 fw-semibold">{{ $skill->title }}</div>
                                    @if($showSkillPercent)
                                        <div class="text-muted mt-1">{{ $pct }}%</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">No skills available yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="section about-section" id="services">
        <div id="services-content">
            <div class="heading text-left text-md-center">
                <h2>my <span>services</span></h2>
            </div>
            <div class="container skills">
                <div class="row">
                    @forelse($services as $service)
                        <div class="col-12 col-md-6 mb-4">
                            <div class="resume-item item">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0">{{ $service->title }}</h5>
                                    @if($service->icon)<h6 class="mb-0"><i class="{{ $service->icon }}"></i></h6>@endif
                                </div>
                                <p>{{ $service->description }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">No services available yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="section work-section" id="work">
        <div id="work-content">
            <div class="heading text-left text-md-center">
                <h2>my <span>portfolio</span></h2>
            </div>
            <div class="container portfolio-container">
                <div class="grid row w-100 m-0 text-left">
                    <div class="item-title-hover"></div>
                    @forelse($projects as $project)
                        @php
                            $projectImage = $project->image
                                ? (str_starts_with($project->image, 'http') || str_starts_with($project->image, '/') ? $project->image : Storage::url($project->image))
                                : asset('assets/images/projects/1.jpg');
                            $totalPhotos = ($project->image ? 1 : 0) + ($project->images_count ?? 0);
                        @endphp
                        <div class="grid__item col-12 col-md-6 col-lg-4">
                            <a class="d-block position-relative" href="{{ route('portfolio.show', $project->slug) }}" data-title="{{ $project->title }}" data-category="{{ $project->category }}">
                                <img class="img-fluid" src="{{ $projectImage }}" alt="{{ $project->title }}">
                                @if(($project->images_count ?? 0) > 0)
                                    <span class="project-angles-badge" title="View {{ $totalPhotos }} project angles">
                                        <span class="material-icons">photo_library</span> {{ $totalPhotos }}
                                    </span>
                                @endif
                                <div class="description description--grid">
                                    <h3>{{ $project->title }}</h3>
                                    <div class="details">
                                        <ul class="list-unstyled">
                                            <li><span>Project : </span><span>{{ $project->category ?: 'General' }}</span></li>
                                            @if(($project->images_count ?? 0) > 0)
                                                <li><span>Gallery : </span><span>{{ $totalPhotos }} {{ Str::plural('angle', $totalPhotos) }}</span></li>
                                            @endif
                                            <li><span>Description : </span><span>{{ Str::limit(strip_tags($project->description ?? ''), 75) ?: 'No description.' }}</span></li>
                                        </ul>
                                        @if($project->project_url)
                                            <span class="btn main-btn d-none d-md-inline-block" onclick="window.open('{{ $project->project_url }}', '_blank')"><span>visit</span></span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                            @if($project->project_url)
                                <span class="btn main-btn d-inline-block d-md-none" onclick="window.open('{{ $project->project_url }}', '_blank')"><span>visit</span></span>
                            @endif
                        </div>
                    @empty
                        <div class="col-12"><p class="text-center">No projects available yet.</p></div>
                    @endforelse
                </div>
                @if($projects->hasPages())
                    <div class="row mt-4 px-3 px-md-0 portfolio-pagination">
                        <div class="col-12">
                            {{ $projects->links() }}
                        </div>
                    </div>
                @endif
                <div class="preview">
                    <button class="action action--close">
                        <span class="position-relative d-block">
                            <span class="navigation-close-line"></span>
                            <span class="navigation-close-line"></span>
                        </span>
                    </button>
                    <div class="description description--preview"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="section contact-section" id="contact">
        <div id="contact-content">
            <div class="heading text-left text-md-center">
                <h2>get <span>in touch</span></h2>
            </div>
            <div class="container">
                @php
                    $contactBoxes = array_values(array_filter([
                        $showPhone ? ['icon' => 'call', 'value' => $profile?->phone ?? 'N/A'] : null,
                        $showEmail ? ['icon' => 'email', 'value' => $profile?->email ?? 'N/A'] : null,
                        $showLocation ? ['icon' => 'location_on', 'value' => $profile?->location ?? 'N/A'] : null,
                    ]));
                    $contactColClass = match (count($contactBoxes)) {
                        1 => 'col-12',
                        2 => 'col-12 col-lg-6',
                        default => 'col-12 col-lg-4',
                    };
                @endphp
                @if(!empty($contactBoxes))
                    <div class="row boxes">
                        @foreach($contactBoxes as $box)
                            <div class="{{ $contactColClass }}">
                                <div class="box {{ $loop->last ? 'last-box' : '' }}">
                                    <span class="material-icons">{{ $box['icon'] }}</span>
                                    <p>{{ $box['value'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="separator"></div>
                @endif
                <div class="row">
                    <div class="col-12 col-lg-4 leftside">
                        <div>
                            <h4 class="mb-0">send me an email</h4>
                            <p>Feel free to get in touch with me. I am always open to discussing new projects or creative ideas.</p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div id="contact-success" class="alert alert-success d-none"></div>
                        <div id="contact-errors" class="alert alert-danger d-none"></div>
                        @if(session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                        @endif
                        <form class="formcontact" method="post" action="{{ route('contact.submit', [], false) }}">
                            @csrf
                            <div class="row contactform">
                                <div class="col-12 col-md-4"><input type="text" name="name" placeholder="YOUR NAME" autocomplete="off" value="{{ old('name') }}" required></div>
                                <div class="col-12 col-md-4"><input type="text" name="subject" placeholder="SUBJECT" autocomplete="off" value="{{ old('subject') }}"></div>
                                <div class="col-12 col-md-4"><input type="email" name="email" placeholder="YOUR EMAIL" autocomplete="off" value="{{ old('email') }}" required></div>
                                <div class="col-12"><textarea name="message" placeholder="YOUR MESSAGE" required>{{ old('message') }}</textarea></div>
                                <div class="col-12"><button type="submit" class="btn main-btn"><span>Send Message</span></button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section blog-section" id="blog">
        <div id="blog-content">
            <div class="heading text-left text-md-center">
                <h2>latest <span>posts</span></h2>
            </div>
            <div class="container">
                <div class="row">
                    @forelse($posts as $post)
                        @php
                            $coverImage = $post->cover_image ? Storage::url($post->cover_image) : asset('assets/images/blog/blog-post-1.jpg');
                            $date = $post->published_at ?: $post->created_at;
                        @endphp
                        <div class="col-12 col-md-6 col-lg-4 blog-grid-item">
                            <div class="blog-grid-card">
                                <div class="post-thumb">
                                    <a href="{{ route('single-blog', $post->id) }}">
                                        <img src="{{ $coverImage }}" class="img-fluid" alt="{{ $post->title }}">
                                    </a>
                                    <div class="post-date-badge">
                                        <span class="day">{{ $date?->format('d') }}</span>
                                        <span class="month">{{ strtoupper($date?->format('M')) }}</span>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <div class="entry-header">
                                        <a href="{{ route('single-blog', $post->id) }}" class="post-title">{{ $post->title }}</a>
                                        <p class="post-excerpt">{{ Str::limit(strip_tags($post->excerpt ?: $post->body), 110) }}</p>
                                    </div>
                                    <div class="post-footer">
                                        <a href="{{ route('single-blog', $post->id) }}" class="read-more-link">
                                            <span>read more</span> <i class="fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12"><p class="text-center">No blog posts published yet.</p></div>
                    @endforelse
                </div>
                <div class="row">
                    <div class="col-12 text-center mt-4">
                        <a href="{{ route('blogs') }}" class="btn main-btn allposts"><span>all posts</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/js/classie.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script>
    if ($(window).width() > 767 && typeof Masonry !== 'undefined') {
        imagesLoaded(document.querySelector('.grid'), function () {
            new Masonry(document.querySelector('.grid'), {
                itemSelector: '.grid__item',
                isFitWidth: true
            });
        });
    }
</script>
<script>
    (function () {
        var target = window.location.hash;
        @if(isset($initialSection) && $initialSection)
            if (!target) target = '#{{ $initialSection }}';
        @endif
        if (target && target !== '#home' && document.querySelector(target)) {
            var pages = [...document.querySelectorAll('#main-navigation .link-page')].map(function (a) {
                return a.getAttribute('href');
            });
            pages.forEach(function (selector) {
                var el = document.querySelector(selector);
                if (el) el.style.display = 'none';
            });
            document.querySelector(target).style.display = 'block';
            var wrapper = document.getElementById('wrapper');
            if (wrapper) wrapper.style.overflow = 'auto';
            document.querySelectorAll('#main-navigation li a').forEach(function (a) {
                a.classList.toggle('active', a.getAttribute('href') === target);
            });
            if (target === '#work' && typeof Masonry !== 'undefined' && window.innerWidth > 767) {
                imagesLoaded(document.querySelector('.grid'), function () {
                    new Masonry(document.querySelector('.grid'), {
                        itemSelector: '.grid__item',
                        isFitWidth: true
                    });
                });
            }
        }
    })();
</script>
<script>
    (function () {
        var form = document.querySelector('form.formcontact');
        if (!form) return;

        var successEl = document.getElementById('contact-success');
        var errorsEl = document.getElementById('contact-errors');
        var csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        function hide(el) {
            if (!el) return;
            el.classList.add('d-none');
            el.textContent = '';
            el.innerHTML = '';
        }

        function showSuccess(message) {
            hide(errorsEl);
            if (!successEl) return;
            successEl.textContent = message || 'Message sent successfully.';
            successEl.classList.remove('d-none');
        }

        function showErrors(errors) {
            hide(successEl);
            if (!errorsEl) return;
            var html = '<ul class="mb-0">';
            errors.forEach(function (e) {
                html += '<li>' + String(e).replaceAll('<', '&lt;').replaceAll('>', '&gt;') + '</li>';
            });
            html += '</ul>';
            errorsEl.innerHTML = html;
            errorsEl.classList.remove('d-none');
        }

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            hide(successEl);
            hide(errorsEl);

            var fd = new FormData(form);
            fetch(form.getAttribute('action'), {
                method: 'POST',
                body: fd,
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf || ''
                }
            }).then(function (res) {
                return res.json().then(function (data) {
                    return { ok: res.ok, status: res.status, data: data };
                }).catch(function () {
                    return { ok: res.ok, status: res.status, data: null };
                });
            }).then(function (result) {
                if (result.ok) {
                    showSuccess(result.data && result.data.message ? result.data.message : 'Message sent successfully.');
                    form.reset();
                    return;
                }

                if (result.status === 422 && result.data && result.data.errors) {
                    var flat = Object.values(result.data.errors).flat();
                    showErrors(flat.length ? flat : ['Validation failed.']);
                    return;
                }

                showErrors(['Something went wrong. Please try again.']);
            }).catch(function () {
                showErrors(['Something went wrong. Please try again.']);
            });
        });
    })();
</script>
</body>
</html>
