@extends('layouts.site')
@section('content')
    <section class="blog-banner wave-secondary">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Maintenance</h1>
                    <div class="bread-crumb">
                        <a href='{{ route("home") }}'>Home</a>
                        >
                        <span class="current-page">Maintenance</span>
                    </div>
                </div>
            </div>
        </div>
        <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1400 100" preserveAspectRatio="none">
            <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z"/>
        </svg>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2>We’ll be back soon</h2>
                    <p class="mt-3">{{ $maintenanceMessage ?: 'The site is currently under maintenance. Please check back soon.' }}</p>
                    <div class="mt-4">
                        <a class="main-button" href="{{ route('login') }}">Admin Login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

