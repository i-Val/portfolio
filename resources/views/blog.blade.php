@extends('layouts.site')
@section('content')
        <!--Blog Banner Start-->
        <section class="blog-banner wave-secondary">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Blog Posts</h1>
                        <div class="bread-crumb">
                            <a href='{{route("home")}}'>Home</a>
                            >
                            <span class="current-page" >Blog</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--Creative Background Wave-->
            <svg class="wave" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1400 100" preserveAspectRatio="none">
                <path d="M0,100c0,0,419-178,693-49.5S1400,0,1400,0v100H0z"/>
            </svg>
        </section>
        <!--Blog Banner End-->

        <!--Blog Post Area Start-->
        <section id="blog-posts-area">
            <div class="container">
                <div class="row">
                    <!--Blogs column-->
                    <div class="col-lg-8 col-md-12">
                        @if (isset($posts) && $posts->count())
                            @foreach ($posts as $post)
                                @php
                                    $image = $post->cover_image;
                                    if (! $image) {
                                        $image = asset('assets/images/blog/img-'.(($loop->index % 3) + 1).'.jpg');
                                    } elseif (! str_starts_with($image, 'http://') && ! str_starts_with($image, 'https://') && ! str_starts_with($image, '/')) {
                                        $image = Storage::url($image);
                                    }
                                    $date = $post->published_at ?? $post->created_at;
                                @endphp
                                <div class="single-blog wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="blog-featured-image">
                                        <img class="img-fluid" src='{{ $image }}' alt="">
                                    </div>
                                    <h2>{{ $post->title }}</h2>
                                    <div class="blog-meta">
                                        <span>
                                            <i class="fa fa-user"></i>
                                            Posted By Admin
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar"></i>
                                            {{ $date?->format('d F Y') }}
                                        </span>
                                    </div>
                                    <div class="blog-content">
                                        <p>{{ $post->excerpt }}</p>
                                        <a class='main-button' href='{{ route("single-blog", ["id" => $post->id]) }}'>Read More</a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="pagination">
                                {{ $posts->links() }}
                            </div>
                        @else
                            <div class="single-blog wow fadeInUp" data-wow-delay="0.4s">
                                <div class="blog-featured-image">
                                    <img class="img-fluid" src='{{asset("assets/images/blog/img-1.jpg")}}' alt="">
                                </div>
                                <h2>Lorem ipsum donor sid</h2>
                                <div class="blog-meta">
                                    <span>
                                        <i class="fa fa-user"></i>
                                        Posted By Admin
                                    </span>
                                    <span>
                                        <i class="fa fa-calendar"></i>
                                        10 December 2017
                                    </span>
                                </div>
                                <div class="blog-content">
                                    <p>Sit sint veniam sed exercitationem quod, vero Magni quibusdam labore odio modi necessitatibus Id reiciendis sed in aperiam at. Tempora nam omnis consectetur doloribus ducimus cupiditate? Doloremque iste aperiam modi</p>
                                    <a class='main-button' href='{{route("single-blog", ["id" => 1])}}'>Read More</a>
                                </div>
                            </div>
                            <div class="single-blog wow fadeInUp" data-wow-delay="0.6s">
                                <div class="blog-featured-image">
                                    <img class="img-fluid" src='{{asset("assets/images/blog/img-2.jpg")}}' alt="">
                                </div>
                                <h2>Lorem ipsum donor sid</h2>
                                <div class="blog-meta">
                                    <span>
                                        <i class="fa fa-user"></i>
                                        Posted By Admin
                                    </span>
                                    <span>
                                        <i class="fa fa-calendar"></i>
                                        10 December 2017
                                    </span>
                                </div>
                                <div class="blog-content">
                                    <p>Sit sint veniam sed exercitationem quod, vero Magni quibusdam labore odio modi necessitatibus Id reiciendis sed in aperiam at. Tempora nam omnis consectetur doloribus ducimus cupiditate? Doloremque iste aperiam modi</p>
                                    <a class='main-button' href='{{route("single-blog", ["id" => 2])}}'>Read More</a>
                                </div>
                            </div>
                            <div class="single-blog wow fadeInUp" data-wow-delay="0.8s">
                                <div class="blog-featured-image">
                                    <img class="img-fluid" src='{{asset("assets/images/blog/img-3.jpg")}}' alt="">
                                </div>
                                <h2>Lorem ipsum donor sid</h2>
                                <div class="blog-meta">
                                    <span>
                                        <i class="fa fa-user"></i>
                                        Posted By Admin
                                    </span>
                                    <span>
                                        <i class="fa fa-calendar"></i>
                                        10 December 2017
                                    </span>
                                </div>
                                <div class="blog-content">
                                    <p>Sit sint veniam sed exercitationem quod, vero Magni quibusdam labore odio modi necessitatibus Id reiciendis sed in aperiam at. Tempora nam omnis consectetur doloribus ducimus cupiditate? Doloremque iste aperiam modi</p>
                                    <a class='main-button' href='{{route("single-blog", ["id" => 3])}}'>Read More</a>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!--Sidebar Column-->
                    <div id="sidebar" class="col-lg-4 col-md-12">
                        <div class="widget search">
                            <form class="search-form">
                                <input type="search" placeholder="Search here...">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget featured-post">
                            <h3 class="widget-heading">
                                Featured Post
                            </h3>
                            <img class="img-fluid" src='{{asset("assets/images/blog/img-1.jpg")}}' alt="">
                            <p>Sit tempore illum non vitae porro Iusto neque atque sit laudantium labore Labore blanditiis dolor eos voluptas et cum, possimus.</p>
                            <a class="main-button" href="#">Read More</a>
                        </div>
                        <div class="widget social">
                            <h3 class="widget-heading">Follow Me On</h3>
                            <ul class="social-icons">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-dribbble"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Blog Post Area End-->
@endsection
