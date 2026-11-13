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
    <link rel="stylesheet" href="{{ asset('assets/css/tech-retro-os.css') }}">
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
            <!-- Top Status Bar -->
            <div class="retro-top-bar">
                <div class="system-status">
                    <span class="retro-dot-pulse"></span>
                    <span>SYSTEM_BOOT // initialization // latency: <span id="retro-latency">12ms</span></span>
                </div>
                <div class="system-commits">
                    commits: 142
                </div>
            </div>

            <!-- Horizontal Top Ruler -->
            <div class="retro-ruler-h d-none d-md-flex">
                <div class="ruler-ticks">
                    <span class="ruler-tick">0</span>
                    <span class="ruler-tick">40</span>
                    <span class="ruler-tick">80</span>
                    <span class="ruler-tick">120</span>
                    <span class="ruler-tick">160</span>
                    <span class="ruler-tick">200</span>
                    <span class="ruler-tick">240</span>
                    <span class="ruler-tick">280</span>
                    <span class="ruler-tick">320</span>
                    <span class="ruler-tick">360</span>
                    <span class="ruler-tick">400</span>
                    <span class="ruler-tick">440</span>
                    <span class="ruler-tick">480</span>
                </div>
            </div>

            <!-- Vertical Left Ruler -->
            <div class="retro-ruler-v d-none d-md-flex">
                <span>0</span>
                <span>20</span>
                <span>10</span>
                <span>40</span>
                <span>80</span>
            </div>

            <!-- Left Desktop Shortcut Icons -->
            <div class="retro-desktop-icons">
                <a href="#work" class="retro-desktop-icon link-page" title="Open Portfolio (Portfolio.exe)">
                    <div class="icon-graphic">
                        <svg viewBox="0 0 36 36" width="36" height="36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="30" height="30" rx="2" fill="#2563eb" stroke="#1d4ed8" stroke-width="1.5"/>
                            <rect x="8" y="3" width="20" height="13" fill="#cbd5e1" stroke="#94a3b8" stroke-width="1"/>
                            <rect x="19" y="5" width="4" height="8" fill="#1e293b"/>
                            <rect x="6" y="19" width="24" height="14" rx="1" fill="#f8fafc" stroke="#e2e8f0"/>
                            <line x1="9" y1="23" x2="27" y2="23" stroke="#f97316" stroke-width="2"/>
                            <line x1="9" y1="27" x2="27" y2="27" stroke="#cbd5e1" stroke-width="1.5"/>
                            <line x1="9" y1="30" x2="22" y2="30" stroke="#cbd5e1" stroke-width="1.5"/>
                        </svg>
                    </div>
                    <span class="icon-label">Portfolio.exe</span>
                </a>

                <a href="#services" class="retro-desktop-icon link-page" title="Open Services">
                    <div class="icon-graphic">
                        <svg viewBox="0 0 36 36" width="36" height="36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 8C4 6.89543 4.89543 6 6 6H14L17 9H30C31.1046 9 32 9.89543 32 11V15H4V8Z" fill="#d97706"/>
                            <rect x="4" y="13" width="28" height="17" rx="1.5" fill="#f59e0b" stroke="#b45309" stroke-width="1.5"/>
                            <rect x="6" y="15" width="24" height="4" fill="#fbbf24"/>
                        </svg>
                    </div>
                    <span class="icon-label">Services</span>
                </a>

                <a href="#about" class="retro-desktop-icon link-page" title="Open About Me (About_Me.txt)">
                    <div class="icon-graphic">
                        <svg viewBox="0 0 36 36" width="36" height="36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 4C7 2.89543 7.89543 2 9 2H22L29 9V32C29 33.1046 28.1046 34 27 34H9C7.89543 34 7 33.1046 7 32V4Z" fill="#f8fafc" stroke="#94a3b8" stroke-width="1.5"/>
                            <path d="M22 2V9H29" fill="#e2e8f0" stroke="#94a3b8" stroke-width="1.5"/>
                            <circle cx="18" cy="15" r="4" fill="#3b82f6"/>
                            <path d="M12 25C12 22 14.5 21 18 21C21.5 21 24 22 24 25" stroke="#3b82f6" stroke-width="2" stroke-linecap="round"/>
                            <line x1="11" y1="29" x2="25" y2="29" stroke="#94a3b8" stroke-width="1.5"/>
                        </svg>
                    </div>
                    <span class="icon-label">About_Me.txt</span>
                </a>

                <a href="#contact" class="retro-desktop-icon link-page" title="Open Contact (Contact.lnk)">
                    <div class="icon-graphic">
                        <svg viewBox="0 0 36 36" width="36" height="36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="8" width="28" height="20" rx="2" fill="#f8fafc" stroke="#64748b" stroke-width="1.5"/>
                            <path d="M4 9L18 19L32 9" stroke="#64748b" stroke-width="1.5" stroke-linejoin="round"/>
                            <rect x="2" y="20" width="12" height="12" fill="#ffffff" stroke="#94a3b8" stroke-width="1"/>
                            <path d="M5 28L8 23L11 26" fill="none" stroke="#2563eb" stroke-width="1.5"/>
                            <path d="M8 23L11 26" stroke="#2563eb" stroke-width="1.5"/>
                            <path d="M5 28C6 25 7 24 9 24" stroke="#2563eb" stroke-width="1.5"/>
                        </svg>
                    </div>
                    <span class="icon-label">Contact.lnk</span>
                </a>

                <div class="retro-desktop-icon" id="retro-trash-icon" title="Recycle Bin">
                    <div class="icon-graphic">
                        <svg viewBox="0 0 36 36" width="36" height="36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 9H28L25 32H11L8 9Z" fill="#94a3b8" stroke="#475569" stroke-width="1.5"/>
                            <line x1="6" y1="9" x2="30" y2="9" stroke="#334155" stroke-width="2" stroke-linecap="round"/>
                            <rect x="14" y="5" width="8" height="4" rx="1" fill="#64748b" stroke="#334155" stroke-width="1.5"/>
                            <line x1="13" y1="14" x2="14" y2="27" stroke="#cbd5e1" stroke-width="1.5"/>
                            <line x1="18" y1="14" x2="18" y2="27" stroke="#cbd5e1" stroke-width="1.5"/>
                            <line x1="23" y1="14" x2="22" y2="27" stroke="#cbd5e1" stroke-width="1.5"/>
                        </svg>
                    </div>
                    <span class="icon-label">Trash</span>
                </div>
            </div>

            <!-- Bottom Left / Right Coordinates -->
            <div class="retro-bottom-meta d-none d-md-flex">
                <div>LOC_LAT / LONG</div>
                <div class="system-commits">commits: 142</div>
            </div>

            <!-- Boot Sequence Window (Retro Loading Screen) -->
            <div class="retro-window retro-boot-window" id="boot-window">
                <div class="retro-window-titlebar">
                    <div class="retro-window-title">
                        <span>&gt;_ BOOT_SEQUENCE.sys</span>
                    </div>
                    <div class="retro-window-controls">
                        <button type="button" class="retro-win-btn" id="boot-btn-minimize" aria-label="Minimize">_</button>
                        <button type="button" class="retro-win-btn" id="boot-btn-maximize" aria-label="Maximize">□</button>
                        <button type="button" class="retro-win-btn" id="boot-btn-close" aria-label="Close">✕</button>
                    </div>
                </div>

                <div class="retro-window-body retro-boot-body">
                    <!-- Corner Crosshairs -->
                    <span class="retro-corner-cross tl">+</span>
                    <span class="retro-corner-cross tr">+</span>
                    <span class="retro-corner-cross bl">+</span>
                    <span class="retro-corner-cross br">+</span>

                    <div class="boot-bios-header">
                        BIOS V4.0 // CPU: INTEL_80486_DX4 // MEM: 65536 KB
                    </div>

                    <div class="boot-cmd">
                        C:\&gt; load OS_Y2K.EXE
                    </div>

                    <div class="boot-log-container">
                        <div class="boot-log-item" id="boot-line-1">
                            <span class="boot-tag-ok">[OK]</span> Initializing retro-operating environment...
                        </div>
                        <div class="boot-log-item" id="boot-line-2">
                            <span class="boot-tag-ok">[OK]</span> Establishing terminal interfaces...
                        </div>
                        <div class="boot-log-item" id="boot-line-3">
                            <span class="boot-tag-ok">[OK]</span> Loading system dependencies (Laravel, JS, Docker)...
                        </div>
                        <div class="boot-log-item" id="boot-line-4">
                            <span class="boot-tag-ok">[OK]</span> Connecting to {{ $showLocation && $profile?->location ? $profile->location : 'Merzouga, Morocco' }} [TARGET_HOST]...
                        </div>
                    </div>

                    <div class="boot-meta-line">
                        <span class="retro-dot-pulse"></span> UPTIME: 99.88% // STATUS: <span id="boot-status-text">DEPLOYING</span>
                    </div>

                    <div class="boot-progress-line">
                        <span class="retro-dot-pulse"></span> FILE: portfolio_assets.tar <span class="boot-progress-ascii" id="boot-progress-ascii">[░░░░░░░░░░░░░░░░░]</span> <span id="boot-progress-num">0%</span>
                    </div>

                    <div class="boot-prompt-line">
                        <span id="boot-prompt-msg">Please wait, loading guest environment...</span><span class="retro-cursor"></span>
                    </div>

                    <div class="boot-skip-hint" id="boot-skip-btn">
                        [ ESC or Click to skip ]
                    </div>
                </div>
            </div>

            <!-- Central Retro OS Window (Main Desktop Workspace) -->
            <div class="retro-window" id="welcome-window" style="opacity: 0; pointer-events: none;">
                <div class="retro-window-titlebar">
                    <div class="retro-window-title">
                        <span>&gt;_ WELCOME_DESK.exe</span>
                    </div>
                    <div class="retro-window-controls">
                        <button type="button" class="retro-win-btn" id="win-btn-minimize" aria-label="Minimize">_</button>
                        <button type="button" class="retro-win-btn" id="win-btn-maximize" aria-label="Maximize">□</button>
                        <button type="button" class="retro-win-btn" id="win-btn-close" aria-label="Close">✕</button>
                    </div>
                </div>

                <div class="retro-window-body">
                    <!-- Corner Crosshairs -->
                    <span class="retro-corner-cross tl">+</span>
                    <span class="retro-corner-cross tr">+</span>
                    <span class="retro-corner-cross bl">+</span>
                    <span class="retro-corner-cross br">+</span>

                    <!-- Status Meta Row -->
                    <div class="retro-meta-row">
                        <div class="status-badge">
                            <span class="status-dot"></span>
                            <span>[ USER: GUEST // status: explore_mode ]</span>
                        </div>
                        <div class="role-label">
                            {{ $showHeadline && $profile?->headline ? $profile->headline : 'Software Engineer // Systems & Scalable Web' }}
                        </div>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="retro-heading">
                        @if($showName)
                            Hi ! I'm {{ $profile?->name ?? 'Valentine Iwuchukwu' }}.
                        @else
                            Hello ! Welcome.
                        @endif
                    </h1>

                    <!-- Description Bio -->
                    <p class="retro-bio">
                        {{ $profile?->bio ?: 'Building high-performance backend systems, interactive web applications, and scalable infrastructure.' }}
                    </p>

                    <!-- Actions Row -->
                    <div class="retro-actions">
                        <a href="#work" class="btn-retro-outline link-page">[ EXPLORE PROJECTS.sh ]</a>
                        <a href="#contact" class="btn-retro-beveled link-page">[ GET_IN_TOUCH.exe ]</a>
                    </div>
                </div>
            </div>

            <!-- Retro Start Menu Pop-up -->
            <div class="retro-start-menu" id="retro-start-menu">
                <div class="retro-start-sidebar">
                    <span>DESK_OS 95</span>
                </div>
                <ul class="retro-start-list">
                    <li><a href="#work" class="link-page"><span class="material-icons" style="font-size:16px;">folder</span> Portfolio.exe</a></li>
                    <li><a href="#services" class="link-page"><span class="material-icons" style="font-size:16px;">build</span> Services.dir</a></li>
                    <li><a href="#about" class="link-page"><span class="material-icons" style="font-size:16px;">description</span> About_Me.txt</a></li>
                    <li><a href="#contact" class="link-page"><span class="material-icons" style="font-size:16px;">email</span> Contact.lnk</a></li>
                    <li><a href="{{ route('blogs') }}"><span class="material-icons" style="font-size:16px;">article</span> Blog_Posts.log</a></li>
                    <li class="retro-start-divider"></li>
                    <li><a href="{{ route('dashboard') }}"><span class="material-icons" style="font-size:16px;">terminal</span> Admin_Console.exe</a></li>
                </ul>
            </div>

            <!-- Bottom Retro Win95 Taskbar -->
            <div class="retro-taskbar">
                <div class="retro-taskbar-left">
                    <button type="button" class="retro-start-btn" id="retro-start-button">
                        <svg class="retro-start-flag" viewBox="0 0 16 16" width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="1" y="2" width="6" height="5" fill="#ef4444"/>
                            <rect x="8" y="1" width="6" height="5" fill="#22c55e"/>
                            <rect x="2" y="8" width="6" height="5" fill="#3b82f6"/>
                            <rect x="9" y="7" width="6" height="5" fill="#eab308"/>
                        </svg>
                        <span>Start</span>
                    </button>
                    <button type="button" class="retro-task-btn is-active" id="taskbar-boot-btn">
                        <span>[&gt;_ BOOT_SEQUENCE.sys]</span>
                    </button>
                    <button type="button" class="retro-task-btn" id="taskbar-window-btn">
                        <span>[🗔 WELCOME_DESK.exe]</span>
                    </button>
                </div>
                <div class="retro-systray">
                    <div class="net-bars" title="Connection: Optimal">
                        <span class="net-bar"></span>
                        <span class="net-bar"></span>
                        <span class="net-bar"></span>
                        <span class="net-bar"></span>
                    </div>
                    <span class="location-badge">Niger 🇳🇬</span>
                    <span class="systray-clock" id="systray-clock">16:39</span>
                    <span class="systray-date d-none d-md-inline" id="systray-date">10/11/2026</span>
                </div>
            </div>

            <!-- Retro Toast -->
            <div class="retro-toast" id="retro-toast">
                <span class="material-icons" style="font-size:16px;color:#10b981;">check_circle</span>
                <span id="retro-toast-msg">SYSTEM: All files clean.</span>
            </div>
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
<script>
    (function () {
        // Retro System Tray Clock & Date
        function updateSystrayClock() {
            var now = new Date();
            var hours = String(now.getHours()).padStart(2, '0');
            var minutes = String(now.getMinutes()).padStart(2, '0');
            var clockEl = document.getElementById('systray-clock');
            if (clockEl) {
                clockEl.textContent = hours + ':' + minutes;
            }

            var day = String(now.getDate()).padStart(2, '0');
            var month = String(now.getMonth() + 1).padStart(2, '0');
            var year = now.getFullYear();
            var dateEl = document.getElementById('systray-date');
            if (dateEl) {
                dateEl.textContent = day + '/' + month + '/' + year;
            }
        }
        updateSystrayClock();
        setInterval(updateSystrayClock, 1000);

        // Fluctuate Latency Ping (11ms - 15ms)
        var latencyEl = document.getElementById('retro-latency');
        if (latencyEl) {
            setInterval(function () {
                var ms = Math.floor(Math.random() * 5) + 11;
                latencyEl.textContent = ms + 'ms';
            }, 3500);
        }

        // Boot Sequence & Window Controllers
        var bootWin = document.getElementById('boot-window');
        var win = document.getElementById('welcome-window');
        var taskbarBootBtn = document.getElementById('taskbar-boot-btn');
        var taskbarWinBtn = document.getElementById('taskbar-window-btn');
        var bootProgressAscii = document.getElementById('boot-progress-ascii');
        var bootProgressNum = document.getElementById('boot-progress-num');
        var bootStatusText = document.getElementById('boot-status-text');
        var bootPromptMsg = document.getElementById('boot-prompt-msg');
        var bootSkipBtn = document.getElementById('boot-skip-btn');
        var toast = document.getElementById('retro-toast');
        var toastMsg = document.getElementById('retro-toast-msg');

        var bootLines = [
            document.getElementById('boot-line-1'),
            document.getElementById('boot-line-2'),
            document.getElementById('boot-line-3'),
            document.getElementById('boot-line-4')
        ];

        var bootFinished = false;

        function renderAsciiProgress(filled, empty) {
            var str = '[' + '█'.repeat(filled) + '░'.repeat(empty) + ']';
            if (bootProgressAscii) bootProgressAscii.textContent = str;
        }

        function completeBootSequence() {
            if (bootFinished) return;
            bootFinished = true;

            // Make sure all lines are visible
            bootLines.forEach(function (line) {
                if (line) line.classList.add('is-visible');
            });

            renderAsciiProgress(17, 0);
            if (bootProgressNum) bootProgressNum.textContent = '100%';
            if (bootStatusText) {
                bootStatusText.textContent = 'ONLINE';
                bootStatusText.style.color = '#22c55e';
            }
            if (bootPromptMsg) bootPromptMsg.textContent = 'Boot sequence complete. Launching WELCOME_DESK.exe...';

            setTimeout(function () {
                if (bootWin) {
                    bootWin.classList.add('is-dismissed');
                }
                if (taskbarBootBtn) {
                    taskbarBootBtn.classList.remove('is-active');
                }

                // Reveal Welcome Desk Window smoothly
                if (win) {
                    win.style.opacity = '1';
                    win.style.pointerEvents = 'auto';
                    win.classList.remove('is-minimized');
                }
                if (taskbarWinBtn) {
                    taskbarWinBtn.classList.add('is-active');
                    var span = taskbarWinBtn.querySelector('span');
                    if (span) span.textContent = '[🗔 WELCOME_DESK.exe]';
                }
            }, 600);
        }

        // Sequential line reveals
        bootLines.forEach(function (line, idx) {
            setTimeout(function () {
                if (!bootFinished && line) {
                    line.classList.add('is-visible');
                }
            }, 250 + (idx * 300));
        });

        // Progress bar steps: 0% -> 24% -> 52% -> 74% -> 92% -> 100%
        var progressStages = [
            { pct: 24, filled: 4, empty: 13, ms: 300 },
            { pct: 52, filled: 9, empty: 8, ms: 650 },
            { pct: 74, filled: 13, empty: 4, ms: 1050 },
            { pct: 92, filled: 16, empty: 1, ms: 1450 },
            { pct: 100, filled: 17, empty: 0, ms: 1850 }
        ];

        progressStages.forEach(function (stage) {
            setTimeout(function () {
                if (!bootFinished) {
                    renderAsciiProgress(stage.filled, stage.empty);
                    if (bootProgressNum) bootProgressNum.textContent = stage.pct + '%';
                }
            }, stage.ms);
        });

        setTimeout(function () {
            completeBootSequence();
        }, 2200);

        // Click or ESC to skip boot
        if (bootSkipBtn) {
            bootSkipBtn.addEventListener('click', completeBootSequence);
        }
        if (bootWin) {
            bootWin.addEventListener('click', function (e) {
                if (!bootFinished && !e.target.closest('.retro-win-btn')) {
                    completeBootSequence();
                }
            });
        }
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !bootFinished) {
                completeBootSequence();
            }
        });

        // Taskbar Boot Button (to toggle/re-inspect boot sequence)
        if (taskbarBootBtn && bootWin) {
            taskbarBootBtn.addEventListener('click', function (e) {
                e.preventDefault();
                if (bootWin.classList.contains('is-dismissed') || bootWin.classList.contains('is-minimized')) {
                    bootWin.classList.remove('is-dismissed', 'is-minimized');
                    taskbarBootBtn.classList.add('is-active');
                } else {
                    bootWin.classList.add('is-minimized');
                    taskbarBootBtn.classList.remove('is-active');
                }
            });
        }

        // Boot Window Controls
        var bootMin = document.getElementById('boot-btn-minimize');
        var bootMax = document.getElementById('boot-btn-maximize');
        var bootClose = document.getElementById('boot-btn-close');

        if (bootMin && bootWin && taskbarBootBtn) {
            bootMin.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                bootWin.classList.add('is-minimized');
                taskbarBootBtn.classList.remove('is-active');
            });
        }
        if (bootMax && bootWin) {
            bootMax.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                bootWin.classList.toggle('is-maximized');
                bootMax.textContent = bootWin.classList.contains('is-maximized') ? '❐' : '□';
            });
        }
        if (bootClose && bootWin && taskbarBootBtn) {
            bootClose.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                bootWin.classList.add('is-dismissed');
                taskbarBootBtn.classList.remove('is-active');
                completeBootSequence();
            });
        }

        function showRetroToast(msg) {
            if (!toast || !toastMsg) return;
            toastMsg.textContent = msg;
            toast.classList.add('is-visible');
            setTimeout(function () {
                toast.classList.remove('is-visible');
            }, 2600);
        }

        // Welcome Window Controls
        var minBtn = document.getElementById('win-btn-minimize');
        var maxBtn = document.getElementById('win-btn-maximize');
        var closeBtn = document.getElementById('win-btn-close');

        if (minBtn && win && taskbarWinBtn) {
            minBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                win.classList.add('is-minimized');
                taskbarWinBtn.classList.remove('is-active');
            });
        }

        if (maxBtn && win) {
            maxBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                win.classList.toggle('is-maximized');
                maxBtn.textContent = win.classList.contains('is-maximized') ? '❐' : '□';
            });
        }

        if (closeBtn && win && taskbarWinBtn) {
            closeBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                win.classList.add('is-minimized');
                taskbarWinBtn.classList.remove('is-active');
                var span = taskbarWinBtn.querySelector('span');
                if (span) span.textContent = '[ 🗔 Reopen WELCOME_DESK ]';
                showRetroToast('SYSTEM: WELCOME_DESK.exe closed. Click taskbar to restore.');
            });
        }

        if (taskbarWinBtn && win) {
            taskbarWinBtn.addEventListener('click', function (e) {
                e.preventDefault();
                if (win.classList.contains('is-minimized')) {
                    win.classList.remove('is-minimized');
                    win.style.opacity = '1';
                    win.style.pointerEvents = 'auto';
                    taskbarWinBtn.classList.add('is-active');
                    var span = taskbarWinBtn.querySelector('span');
                    if (span) span.textContent = '[🗔 WELCOME_DESK.exe]';
                } else {
                    win.classList.add('is-minimized');
                    taskbarWinBtn.classList.remove('is-active');
                }
            });
        }

        // Start Menu Pop-up Toggle
        var startBtn = document.getElementById('retro-start-button');
        var startMenu = document.getElementById('retro-start-menu');

        if (startBtn && startMenu) {
            startBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                startMenu.classList.toggle('is-open');
                startBtn.classList.toggle('is-active');
            });

            document.addEventListener('click', function (e) {
                if (!startMenu.contains(e.target) && e.target !== startBtn) {
                    startMenu.classList.remove('is-open');
                    startBtn.classList.remove('is-active');
                }
            });

            startMenu.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    startMenu.classList.remove('is-open');
                    startBtn.classList.remove('is-active');
                });
            });
        }

        // Trash Bin Easter Egg
        var trashIcon = document.getElementById('retro-trash-icon');
        if (trashIcon) {
            trashIcon.addEventListener('click', function () {
                showRetroToast('RECYCLE_BIN // 0 items // Memory is clean.');
            });
        }
    })();
</script>
</body>
</html>
