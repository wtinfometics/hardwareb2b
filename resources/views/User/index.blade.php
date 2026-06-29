@extends('User.main')

<!-- Page Meta Data Starts -->
@section('metadata')
    <!-- Home Page -->

<title>First Pro UAE | Premium Door Handles, Hinges & Cabinet Hardware Supplier UAE</title>

<meta name="description" content="First Pro UAE is a trusted B2B supplier of premium door handles, security door handles, hinges, sliders, and cabinet hardware. Quality architectural hardware solutions for contractors, builders, and wholesalers across the UAE.">

<meta name="keywords" content="door handles UAE, security door handles, door hardware supplier UAE, hinges supplier UAE, cabinet hardware UAE, drawer sliders UAE, architectural hardware, wholesale door handles, B2B hardware supplier, cabinet accessories UAE, furniture fittings UAE, builders hardware supplier">

@endsection
<!-- Page Meta Data Ends -->

<!-- Page Content Starts -->
@section('pagecontent')
    <!-- Carousel Start -->
    <div class="container-fluid carousel bg-light px-0">
        <div class="row g-0 justify-content-end">
            <div class="col-12 col-lg-7 col-xl-9">
                <div class="header-carousel owl-carousel bg-light py-5">
                    @forelse($BannersData as $banner)
                        <div class="row g-0 header-carousel-item align-items-center">
                            <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                                <img src="{{ $banner->banner_image
                                    ? asset('Banners/' . $banner->banner_image)
                                    : '' }}"
                                    class="img-fluid w-100" alt="Image">
                            </div>

                            <div class="col-xl-6 carousel-content p-4">
                                <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s"
                                    style="letter-spacing: 3px;">
                                    {{ $banner->featured_message }}
                                </h4>

                                <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">
                                    {{ $banner->banner_header }}
                                </h1>

                                @if (!empty($banner->button_text) && $banner->link)
                                    <a href="{{ $banner->link ?? '#' }}" target="_blank"
                                        class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight"
                                        data-wow-delay="0.7s">
                                        {{ $banner->button_text }}
                                    </a>
                                @endif

                            </div>
                        </div>



                    @empty
                        <h2>Banners Table is Empty</h2>
                    @endforelse
                </div>
            </div>
            <div class="col-12 col-lg-5 col-xl-3 wow fadeInRight" data-wow-delay="0.1s">
                <div class="carousel-header-banner h-100">
                    <img src="{{ asset('user/img/cover.png') }}" class="img-fluid w-100 h-100"
                        style="object-fit: cover;" alt="Image">
                
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Searvices Start -->
    <div class="container-fluid px-0">
        <div class="row g-0">
            <div class="col-6 col-md-4 col-lg-3 border-start border-end wow fadeInUp" data-wow-delay="0.1s">
                <div class="p-4">
                    <div class="d-inline-flex align-items-center">
                        <i class="fa fa-sync-alt fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Free Return</h6>
                            <p class="mb-0">30 days money back guarantee!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 border-end wow fadeInUp" data-wow-delay="0.2s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fab fa-telegram-plane fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Free Shipping</h6>
                            <p class="mb-0">Free shipping on all order</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 border-end wow fadeInUp" data-wow-delay="0.3s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-life-ring fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Support 24/7</h6>
                            <p class="mb-0">We support online 24 hrs a day</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 border-end wow fadeInUp" data-wow-delay="0.4s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-credit-card fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Receive Gift Card</h6>
                            <p class="mb-0">Recieve gift all over oder </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Searvices End -->

    <!-- Categories List Satrt -->
    <div class="container-fluid products productList overflow-hidden">
        <div class="container products-mini py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h4 class="text-primary border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp"
                    data-wow-delay="0.1s">Categories</h4>
            </div>
            <div class="productList-carousel owl-carousel pt-4 wow fadeInUp" data-wow-delay="0.3s">
                @forelse($categoryData as $category)
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-6">
                                <div class="products-mini-img border-end h-100">
                                    <img src="{{ $category->category_image
                                        ? asset('Category/' . $category->category_image)
                                        : '' }}"
                                        class="img-fluid w-100 h-100" alt="{{ $category->category_name }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="products-mini-content p-3">
                                    <a href="{{ url('/shop/' . $category->category_id) }}"
                                        class="d-block h4">{{ $category->category_name }} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h2> Categories Table is Empty</h2>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Categories List End -->



    <!-- Our Products Start -->
@if(!empty($data) && count($data) > 0)

<div class="container-fluid product py-5">
    <div class="container py-5">
        <div class="tab-class">

            {{-- Heading + Tabs --}}
            <div class="row g-4">
                <div class="col-lg-4 text-start wow fadeInLeft" data-wow-delay="0.1s">
                    <h1>Our Products</h1>
                </div>

                <div class="col-lg-8 text-end wow fadeInRight" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">

                        {{-- ALL PRODUCTS TAB --}}
                        <li class="nav-item mb-4">
                            <a class="d-flex mx-2 py-2 bg-light rounded-pill active"
                                data-bs-toggle="pill"
                                href="#tab-all">
                                <span class="text-dark" style="width:130px;">
                                    All Products
                                </span>
                            </a>
                        </li>

                        {{-- CATEGORY TABS --}}
                        @foreach ($data->take(4) as $category)
                            <li class="nav-item mb-4">
                                <a class="d-flex mx-2 py-2 bg-light rounded-pill"
                                    data-bs-toggle="pill"
                                    href="#tab-{{ $category->category_id }}">
                                    <span class="text-dark" style="width:130px;">
                                        {{ $category->category_name }}
                                    </span>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>

            {{-- TAB CONTENT --}}
            <div class="tab-content">

                {{-- ALL PRODUCTS TAB --}}
                <div id="tab-all" class="tab-pane fade show active p-0">
                    <div class="row g-4">

                        @forelse ($data->pluck('products')->flatten() as $product)

                            @php
                                $variation = $product->variations->first();
                                $image = optional($variation)->images->first();
                            @endphp

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp">
                                    <div class="product-item-inner border rounded">

                                        <a href="{{ url('/product/' . $product->product_slug . '/' . $product->product_id) }}"
                                            class="text-decoration-none text-dark">

                                            <div class="product-item-inner-item">
                                                <img src="{{ asset('Products/' . ($image->product_variation_image_name ?? 'default.png')) }}"
                                                    class="img-fluid w-100 rounded-top">

                                                <div class="product-details">
                                                    <i class="fa fa-eye fa-1x"></i>
                                                </div>
                                            </div>

                                            <div class="text-center rounded-bottom p-4">
                                                <div class="d-block mb-2 text-muted">
                                                    {{ $product->category->category_name ?? '' }}
                                                </div>

                                                <div class="d-block h4">
                                                    {{ Str::limit($product->product_name, 30, '...') }}
                                                </div>

                                                @if ($variation)
                                                    @if ($variation->discount_price)
                                                        <del class="me-2 text-danger">
                                                            {{ $variation->price }} AED
                                                        </del>
                                                    @endif

                                                    <span class="text-primary fw-bold">
                                                        {{ $variation->discount_price ?? $variation->price }} AED
                                                    </span>
                                                @endif
                                            </div>

                                        </a>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <div class="col-12 text-center">
                                <div class="alert alert-warning">
                                    No products found.
                                </div>
                            </div>
                        @endforelse

                    </div>
                </div>

                {{-- CATEGORY-WISE PRODUCTS --}}
                @foreach ($data->take(4) as $category)

                    <div id="tab-{{ $category->category_id }}" class="tab-pane fade p-0">
                        <div class="row g-4">

                            @forelse ($category->products as $product)

                                @php
                                    $variation = $product->variations->first();
                                    $image = optional($variation)->images->first();
                                @endphp

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item rounded wow fadeInUp">
                                        <div class="product-item-inner border rounded">

                                            <a href="{{ url('/product/' . $product->product_slug . '/' . $product->product_id) }}"
                                                class="text-decoration-none text-dark">

                                                <div class="product-item-inner-item">
                                                    <img src="{{ asset('Products/' . ($image->product_variation_image_name ?? 'default.png')) }}"
                                                        class="img-fluid w-100 rounded-top">

                                                    <div class="product-details">
                                                        <i class="fa fa-eye fa-1x"></i>
                                                    </div>
                                                </div>

                                                <div class="text-center rounded-bottom p-4">
                                                    <div class="d-block mb-2 text-muted">
                                                        {{ $product->category->category_name ?? '' }}
                                                    </div>

                                                    <div class="d-block h4">
                                                        {{ Str::limit($product->product_name, 30, '...') }}
                                                    </div>

                                                    @if ($variation)
                                                        @if ($variation->discount_price)
                                                            <del class="me-2 text-danger">
                                                                {{ $variation->price }} AED
                                                            </del>
                                                        @endif

                                                        <span class="text-primary fw-bold">
                                                            {{ $variation->discount_price ?? $variation->price }} AED
                                                        </span>
                                                    @endif
                                                </div>

                                            </a>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <div class="col-12 text-center">
                                    <div class="alert alert-warning">
                                        No products found in this category.
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </div>
</div>

@else

<div class="container py-5">
    <div class="alert alert-warning text-center">
        No categories Of products found.
    </div>
</div>

@endif
    <!-- Our Products End -->

    <!-- Product Banner Start -->
    <!-- <div class="container-fluid py-5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                            <a >
                                <div class="bg-primary rounded position-relative">
                                    <img src="{{ asset('user/img/product-banner.jpg') }}" class="img-fluid w-100 rounded"
                                        alt="">
                                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                        style="background: rgba(255, 255, 255, 0.5);">
                                        <h3 class="display-5 text-primary">EOS Rebel <br> <span>T7i Kit</span></h3>
          
                                       
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                            <a >
                                <div class="text-center bg-primary rounded position-relative">
                                    <img src="{{ asset('user/img/product-banner-2.jpg') }}" class="img-fluid w-100"
                                        alt="">
                                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                        style="background: rgba(242, 139, 0, 0.5);">
                                        <h4 class="display-5 text-white mb-4">Get UP To 50% Off</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div> -->
    <!-- Product Banner End -->

    <!-- Products Offer Start -->
    <div class="container-fluid bg-light py-5">
        <div class="container">

            <div class="row g-4">
                @forelse($posterData as $poster)
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                        <a href="#"
                            class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
                            <div>
                                <p class="text-muted mb-3">{{ $poster->featured_message }}</p>
                                <h3 class="text-primary">{{ $poster->poster_header }}</h3>
                                <h1 class="display-3 text-secondary mb-0">
                                    {{ str_replace('Off', '', $poster->poster_name) }}
                                    <span class="text-primary fw-normal">Off</span>
                                </h1>

                            </div>
                            <img src="{{ $poster->poster_image
                                ? asset('Posters/' . $poster->poster_image)
                                : 'https://img.freepik.com/free-vector/door-handle-key-set_1284-20884.jpg' }}"
                                class="img-fluid" alt="" style="width: 150px; height: auto;">
                        </a>
                    </div>
                @empty
                    <h2> Categories Table is Empty</h2>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Products Offer End -->

    <!-- Blog Section starts -->
    <section class="container-fluid my-5">
        <div class="container">
            <div class="text-center mb-5">
                <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp"
                    data-wow-delay="0.1s">Resent Blogs</h4>
            </div>
            <div class="row">
            @forelse(($postData ?? []) as $post)

    @if($loop->index < 3)
        <div class="col-lg-4 col-md-6 mb-2-6 my-3">

            <article class="card card-style2 position-relative">

                <a href="{{ url('/blogs/' . $post->post_slug . '/' . $post->post_id) }}"
                    class="stretched-link"></a>

                <div class="card-img">
                    <img class="rounded-top"
                        src="{{ $post->featured_image
                            ? asset('Posts/' . $post->featured_image)
                            : 'https://img.freepik.com/free-vector/door-handle-key-set_1284-20884.jpg' }}"
                        alt="{{ $post->post_name }}">

                    <div class="date">
                        <span>{{ \Carbon\Carbon::parse($post->created_at)->format('d') }}</span>
                        {{ \Carbon\Carbon::parse($post->created_at)->format('M') }}
                    </div>
                </div>

                <div class="card-body">
                    <h3 class="h5">
                        <a>{{ Str::limit($post->post_name, 50, '...') }}</a>
                    </h3>

                    <p class="display-30">
                        {{ Str::limit($post->short_description, 150, '...') }}
                    </p>

                    <span class="read-more">Read more</span>
                </div>

                <div class="card-footer">
                    <ul>
                        <li>
                            <span>
                                <i class="fa fa-list"></i>
                                {{ $post->category->category_name ?? 'Uncategorized' }}
                            </span>
                        </li>
                        <li>
                            <span>
                                <i class="fas fa-user"></i>
                                Admin
                            </span>
                        </li>
                    </ul>
                </div>

            </article>

        </div>
    @endif

@empty

    <div class="col-12">
        <div class="alert alert-warning text-center">
            No posts available.
        </div>
    </div>

@endforelse
            </div>
        </div>
    </section>
    <!-- Blog Section Ends -->

    <!-- Bestseller Products Start -->
    <div class="container-fluid products pb-5">
        <div class="container products-mini py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 700px;">
                <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp"
                    data-wow-delay="0.1s">Bestseller Products</h4>

            </div>
            <div class="row g-4">
                @forelse($productData as $product)
                    @php
                        $variation = $product->variations->first();
                        $image = optional($variation)->images->first();
                    @endphp
                    <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                        <a href="{{ url('/product/' . $product->product_slug . '/' . $product->product_id) }}"
                            class="text-decoration-none text-dark">
                            <div class="products-mini-item border">
                                <div class="row g-0">
                                    <div class="col-5">
                                        <div class="products-mini-img border-end h-100">
                                            <img src="{{ asset('Products/' . $image->product_variation_image_name ?? 'default.png') }}"
                                                class="img-fluid w-100 h-100" alt="Image">
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="products-mini-content p-3">
                                            <span class="d-block mb-2 text-primary">
                                                {{ $product->category->category_name }}
                                            </span>

                                            <span class="d-block h4">
                                                {{ Str::limit($product->product_name, 30, '...') }}
                                            </span>

                                            <del class="me-2 fs-5 text-danger">
                                                {{ $variation->price }} AED
                                            </del>

                                            <span class="text-primary fs-5">
                                                {{ $variation->discount_price ?? $variation->price }} AED
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <h2> Products Not Exists</h2>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Bestseller Products End -->
@endsection
<!-- Page Content Ends -->
