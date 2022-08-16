@extends('../welcome')
@section('header')
<header class="rn-header haeder-default black-logo-version header--fixed header--sticky">
    <div class="header-wrapper rn-popup-mobile-menu m--0 row align-items-center">
        <!-- Start Header Left -->
        <div class="col-lg-2 col-6">
            <div class="header-left">
                <div class="logo">
                    <a href="index.html">
                        <img src="assets/images/logo/logo-dark.png" alt="logo">
                    </a>
                </div>
            </div>
        </div>
        <!-- End Header Left -->
        <!-- Start Header Center -->
        <div class="col-lg-10 col-6">
            <div class="header-center">
                <nav id="sideNav" class="mainmenu-nav navbar-example2 d-none d-xl-block">
                    <!-- Start Mainmanu Nav -->
                    <ul class="primary-menu nav nav-pills">
                        <li class="nav-item"><a class="nav-link smoth-animation active" href="#home">Home</a></li>
                        <li class="nav-item"><a class="nav-link smoth-animation" href="#features">Features</a></li>
                        <li class="nav-item"><a class="nav-link smoth-animation" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link smoth-animation" href="#resume">Resume</a></li>
                        <li class="nav-item"><a class="nav-link smoth-animation" href="#clients">Clients</a></li>
                        <li class="nav-item"><a class="nav-link smoth-animation" href="#pricing">Pricing</a></li>
                        <li class="nav-item"><a class="nav-link smoth-animation" href="#blog">blog</a></li>
                        <li class="nav-item"><a class="nav-link smoth-animation" href="#contacts">Contact</a></li>
                    </ul>
                    <!-- End Mainmanu Nav -->
                </nav>
                <!-- Start Header Right  -->
                <div class="header-right">
                    <a class="rn-btn" target="_blank" href="https://themeforest.net/checkout/from_item/33188244?license=regular"><span>BUY NOW</span></a>
                    <div class="hamberger-menu d-block d-xl-none">
                        <i id="menuBtn" class="feather-menu humberger-menu"></i>
                    </div>
                    <div class="close-menu d-block">
                        <span class="closeTrigger">
                        <i data-feather="x"></i>
                    </span>
                    </div>
                </div>
                <!-- End Header Right  -->

            </div>
        </div>
        <!-- End Header Center -->
    </div>
</header>
<!-- End Header Area -->
<!-- Start Popup Mobile Menu  -->
<div class="popup-mobile-menu">
    <div class="inner">
        <div class="menu-top">
            <div class="menu-header">
                <a class="logo" href="index.html">
                    <img src="assets/images/logo/logos-circle.png" alt="Personal Portfolio">
                </a>
                <div class="close-button">
                    <button class="close-menu-activation close"><i data-feather="x"></i></button>
                </div>
            </div>
            <p class="discription">Inbio is a personal portfolio template. You can customize all.</p>
        </div>
        <div class="content">
            <ul class="primary-menu nav nav-pills">
                <li class="nav-item"><a class="nav-link smoth-animation active" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link smoth-animation" href="#features">Features</a></li>
                <li class="nav-item"><a class="nav-link smoth-animation" href="#portfolio">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link smoth-animation" href="#resume">Resume</a></li>
                <li class="nav-item"><a class="nav-link smoth-animation" href="#clients">Clients</a></li>
                <li class="nav-item"><a class="nav-link smoth-animation" href="#pricing">Pricing</a></li>
                <li class="nav-item"><a class="nav-link smoth-animation" href="#blog">blog</a></li>
                <li class="nav-item"><a class="nav-link smoth-animation" href="#contacts">Contact</a></li>
            </ul>
            <!-- social sharea area -->
            <div class="social-share-style-1 mt--40">
                <span class="title">find with me</span>
                <ul class="social-share d-flex liststyle">
                    <li class="facebook"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg></a>
                    </li>
                    <li class="instagram"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg></a>
                    </li>
                    <li class="linkedin"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg></a>
                    </li>
                </ul>
            </div>
            <!-- end -->
        </div>
    </div>
</div>
<!-- End Popup Mobile Menu  -->



<!-- Start Main Page Wrapper -->
<main class="main-page-wrapper">
    <!-- Start Slider Area -->
    <div id="home" class="rn-slider-area">
        <div class="slide slider-style-2">
            <div class="container">
                <div class="row align-items-center row--30">
                    <div class="col-lg-5">
                        <div class="thumbnail style-2">
                            <div class="inner ">
                                <img class="w-100" src="assets/images/slider/banner-04.png" alt="Personal Portfolio Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 mt_md--40 mt_sm--40">
                        <div class="content">
                            <div class="inner">
                                <h1 class="title">Hi, I’m <span>Jone Lee</span><br> a
                                    <span class="header-caption" id="page-top">
                                        <span class="cd-headline clip is-full-width">
                                            <span class="cd-words-wrapper" style="width: 178px;">
                                                <b class="is-visible">Poem Writter.</b>
                                                <b class="is-hidden">Web Coder.</b>
                                                <b class="is-hidden">Content Writter.</b>
                                            </span>
                                    </span>
                                    </span>
                                </h1>

                                <div>
                                    <p class="description">I use animation as a third dimension by which to simplify
                                        experiences and kuiding thro each and every interaction. I’m not adding
                                        motion
                                        just to spruce things up, but doing it in ways that. Lorem ipsum dolor</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 col-12">
                                    <div class="social-share-inner-left">
                                        <span class="title">find with me</span>
                                        <ul class="social-share d-flex liststyle">
                                            <li class="facebook"><a href="#"><i data-feather="facebook"></i></a>
                                            </li>
                                            <li class="instagram"><a href="#"><i data-feather="instagram"></i></a>
                                            </li>
                                            <li class="linkedin"><a href="#"><i data-feather="linkedin"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 col-12 mt_mobile--30">
                                    <div class="skill-share-inner">
                                        <span class="title">best skill on</span>
                                        <ul class="skill-share d-flex liststyle">
                                            <li><img src="assets/images/icons/icons-04.png" alt="Icons Images"></li>
                                            <li><img src="assets/images/icons/icons-05.png" alt="Icons Images"></li>
                                            <li><img src="assets/images/icons/icons-06.png" alt="Icons Images"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection