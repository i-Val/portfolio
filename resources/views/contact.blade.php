@extends('layouts.site')
@section('content')
        <section class="blog-banner wave-secondary">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Contact</h1>
                        <div class="bread-crumb">
                            <a href='{{route("home")}}'>Home</a>
                            >
                            <span class="current-page">Contact</span>
                        </div>
                    </div>
                </div>
            </div>
            <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1400 100" preserveAspectRatio="none">
                <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z"/>
            </svg>
        </section>

        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12 address-box">
                        <h2 class="text-left">Get in touch</h2>
                        <div class="contact-info wow fadeInUp" data-wow-delay="0.3s">
                            <div class="contact-item">
                                <h4>Address</h4>
                                <p>{{ $siteProfile?->location ?? '1324 Lorem Ipsum, USA' }}</p>
                            </div>
                            <div class="contact-item">
                                <h4>Email</h4>
                                <p>{{ $siteProfile?->email ?? 'example@example.com' }}</p>
                            </div>
                            <div class="contact-item">
                                <h4>Telephone</h4>
                                <p>{{ $siteProfile?->phone ?? '+00 123 456 789' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 wow fadeInRight message-box" data-wow-delay="0.6s">
                        <h2 class="text-right">Send Us A Message</h2>
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="contactForm" method="POST" action="{{ route('contact.submit') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control con-validate" id="contact-name" name="name" placeholder="Name" minlength="3" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="email" class="form-control con-validate" id="contact-email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control con-validate mb-3" id="contact-subject" name="subject" placeholder="Subject (optional)" value="{{ old('subject') }}">
                                    <textarea class="form-control con-validate" id="contact-message" name="message" placeholder="Message" rows="4" required>{{ old('message') }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <button id="contact-submit" class="main-button" type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
@endsection
