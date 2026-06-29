@extends('User.main')

<!-- Page Meta Data Starts -->
@section('metadata')
    <title>{{isset($data->meta->meta_title) ? $data->meta->meta_title :''}}</title>
    <meta content="{{isset($data->meta->meta_description) ? $data->meta->meta_description :''}}" name="keywords">
    <meta content="{{isset($data->meta->meta_keywords) ? $data->meta->meta_keywords :''}}" name="description">
@endsection
<!-- Page Meta Data Ends -->

<!-- Page Content Starts -->
@section('pagecontent')
    <!-- Page Header -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp">
            Blogs Details
        </h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item active text-white">
                Blogs
            </li>
        </ol>
    </div>

    <div class="blog-single gray-bg">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-8 m-15px-tb">
                    <article class="article">
                        <div class="article-img">
                            <img src="{{ $data->featured_image
                                ? asset('Posts/' . $data->featured_image)
                                : 'https://img.freepik.com/free-vector/door-handle-key-set_1284-20884.jpg' }}"
                                title="" alt="">
                        </div>
                        <div class="article-title">
                            <h6>{{ $data->category->category_name }}</h6>
                            <h2>{{ $data->post_name }}</h2>

                        </div>
                        <div class="article-content">
                            <p>
                                {!! $data->description !!}
                            </p>
                        </div>
                    </article>
                </div>
                <div class="col-lg-4 m-15px-tb blog-aside">
                    <!-- Author -->
                    <div class="widget widget-author">
                        <!-- <div class="widget-title">
                                    <h3>Author</h3>
                                </div>
                                <div class="widget-body">
                                    <div class="media align-items-center">
                                        <div class="avatar">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" title="" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6>Hello, I'm<br> Rachel Roth</h6>
                                        </div>
                                    </div>
                                    <p>I design and develop services for customers of all sizes, specializing in creating
                                        stylish, modern websites, web services and online stores</p>
                                </div>
                            </div> -->
                        <!-- End Author -->
                        <!-- Trending Post -->
                        <!-- <div class="widget widget-post">
                                <div class="widget-title">
                                    <h3>Trending Now</h3>
                                </div>
                                <div class="widget-body">

                                </div>
                            </div> -->
                        <!-- End Trending Post -->
                        <!-- Latest Post -->
                        <div class="widget widget-latest-post">
                            <div class="widget-title">
                                <h3>Latest Post</h3>
                            </div>
                            <div class="widget-body">
                                @forelse($posts->take(5) as $post)
                                    <a href="{{ url('/blogs/' . $post->post_slug . '/' . $post->post_id) }}">

                                        <div class="latest-post-aside media d-flex flex-wrap justify-content-center">

                                            <div class="lpa-left media-body col-lg-9">

                                                <div class="lpa-title">
                                                    <h5>
                                                        {{ \Illuminate\Support\Str::limit($post->post_name, 30) }}
                                                    </h5>
                                                </div>

                                                <div class="lpa-meta">
                                                    <span class="name">
                                                        {{ $post->category->category_name }}
                                                    </span>

                                                    <span class="date">
                                                        {{ $post->created_at->format('d - M - Y') }}
                                                    </span>
                                                </div>

                                            </div>

                                            <div class="lpa-right col">
                                                <img src="{{ $post->featured_image
                                                    ? asset('Posts/' . $post->featured_image)
                                                    : 'https://img.freepik.com/free-vector/door-handle-key-set_1284-20884.jpg' }}"
                                                    alt="{{ $post->post_name }}">
                                            </div>

                                        </div>

                                    </a>

                                @empty
                                    <h2>Posts Not Exists</h2>
                                @endforelse
                            </div>
                        </div>
                        <!-- End Latest Post -->
                        <!-- Latest Products -->
                        <!-- <div class="widget widget-latest-post">
                                <div class="widget-title">
                                    <h3>Latest Products</h3>
                                </div>
                                <div class="widget-body">

                                    <div class="latest-post-aside media d-flex flex-wrap justify-content-center">
                                        <div class="lpa-left media-body col-lg-9">
                                            <div class="lpa-title">
                                                <h5><a href="#">Prevent 75% of visitors from google analytics</a></h5>
                                            </div>
                                            <div class="lpa-meta">
                                                <a class="name" href="#">
                                                    Rachel Roth
                                                </a>
                                                <a class="date" href="#">
                                                    26 FEB 2020
                                                </a>
                                            </div>
                                        </div>
                                        <div class="lpa-right col">
                                            <a href="#">
                                                <img src="https://www.bootdey.com/image/400x200/FFB6C1/000000" title="" alt="">
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div> -->
                        <!-- End Latest Post -->
                    </div>
                </div>
            </div>
        </div>
    @endsection
    <!-- Page Content Ends -->
