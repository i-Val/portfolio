<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from adrian.netlify.app/index-main by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Mar 2026 10:00:29 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>Adrian - Portfolio Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Adrian is a Personal Portfolio Template">
    <meta name="keywords" content="cosmos-themes, resume, cv, portfolio, personal, developer, designer,personal resume, onepage, clean, modern">
    <meta name="author" content="Adrian Jones">


    <!-- Favicon -->
    <link rel="shortcut icon" href='{{asset("assets/images/favicon.ico")}}' type="image/x-icon">

    <!--Bootstrap css-->
    <link rel="stylesheet" href='{{asset("assets/css/bootstrap.css")}}'>

    <!--Font awesome css-->
    <link rel="stylesheet" href='{{asset("assets/css/font-awesome.min.css")}}'>

    <!--Magnific popup css-->
    <link rel="stylesheet" href='{{asset("assets/css/magnific-popup.css")}}'>

    <!--Site main css-->
    <link rel="stylesheet" href='{{asset("assets/css/style.css")}}'>

    <!--Animate css-->
    <link rel="stylesheet" href='{{asset("assets/css/animate.css")}}'>

    <!--Google Fonts link-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900|Poppins:400,500,600" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122650090-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-122650090-2');
    </script>

</head>

<body>

    <!--Preloader Start-->
    <div id="loader-wrapper">
        <div class="loading"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!--Preloader End-->

    <!--Navbar Start-->
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <!--Logo-->
            <a class="navbar-brand" href="{{route('home')}}"><img src='{{asset("assets/images/logo/logo.png")}}' alt="logos"></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('home')}}">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('about')}}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('portfolio')}}">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('services')}}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('blogs')}}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('contact')}}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Navbar End-->
@yield('content')
    <!--Footer Section Start-->
    <footer class="wave-footer">
        <div class="container">
            <div class="col-md-12">
                <ul class="social-icons">
                    <li class="wow fadeInUp" data-wow-delay=".2s">
                        <a href="#">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li class="wow fadeInUp" data-wow-delay=".4s">
                        <a href="#">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li class="wow fadeInUp" data-wow-delay=".6s">
                        <a href="#">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </li>
                    <li class="wow fadeInUp" data-wow-delay=".8s">
                        <a href="#">
                            <i class="fa fa-dribbble"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-12">
                <!--copyright-->
                <p>
                    Copyright &copy; 2024 Adrian Portfolio, All Right Reserved.<br>
                    Created By cosmos-themes.
                </p>
            </div>
        </div>
        <!--Creative Background Wave-->
        <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1400 100" preserveAspectRatio="none">
            <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z" />
        </svg>
    </footer>
    <!--Footer Section End-->

    <!--JQuery js-->
    <script src='{{asset("assets/js/jquery.min.js")}}'></script>
    <!--Bootstrap js-->
    <script src='{{asset("assets/js/bootstrap.min.js")}}'></script>
    <!--Typed js-->
    <script src='{{asset("assets/js/typed.min.js")}}'></script>
    <!--Isotope js-->
    <script src='{{asset("assets/js/isotope.pkgd.min.js")}}'></script>
    <!--Wow js-->
    <script src='{{asset("assets/js/wow.min.js")}}'></script>
    <!--FitText js-->
    <script src='{{asset("assets/js/jquery.fittext.js")}}'></script>
    <!--Magnific popup js-->
    <script src='{{asset("assets/js/jquery.magnific-popup.min.js")}}'></script>
    <!--Site main js-->
    <script src='{{asset("assets/js/main.js")}}'></script>
</body>

<!-- Mirrored from adrian.netlify.app/index-main by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Mar 2026 10:00:41 GMT -->

</html>
