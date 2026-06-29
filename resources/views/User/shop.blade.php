@extends('User.main')

{{-- META DATA --}}
@section('metadata')
    <title>Shop Page</title>

    <meta content="" name="keywords">

    <meta content="" name="description">
@endsection


{{-- PAGE CONTENT --}}
@section('pagecontent')


    <!-- Page Header -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp">
            Products
        </h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active text-white">
                Shop
            </li>
        </ol>
    </div>



    <!-- Shop Page -->
    <div class="container-fluid shop py-5">

        <div class="container py-5">

            <div class="row g-4">


                {{-- SIDEBAR --}}
                <div class="col-lg-3 wow fadeInUp">


                    {{-- CATEGORY FILTER --}}
                    <div class="product-categories mb-4">

                        <h4>Products Categories</h4>

                        <ul class="list-unstyled">

                            @foreach ($categories as $category)
                                <li>

                                    <div class="categories-item">

                                        <label class="text-dark w-100">

                                            <input type="checkbox" class="filter-input category-filter me-2"
                                                value="{{ $category->category_id }}">

                                            <i class="fas fa-folder text-secondary me-2"></i>

                                            {{ $category->category_name }}

                                        </label>

                                    </div>

                                </li>
                            @endforeach

                        </ul>

                    </div>



                    {{-- BRAND FILTER --}}
                    <div class="product-color mb-4">

                        <h4>Select By Brand</h4>

                        <ul class="list-unstyled">

                            @foreach ($brands as $brand)
                                <li>

                                    <div class="product-color-item">

                                        <label class="text-dark w-100">

                                            <input type="checkbox" class="filter-input brand-filter me-2"
                                                value="{{ $brand->brand_id }}">

                                            <i class="fas fa-tag text-secondary me-2"></i>

                                            {{ $brand->brand_name }}

                                        </label>

                                    </div>

                                </li>
                            @endforeach

                        </ul>

                    </div>



                    {{-- PRICE FILTER --}}
                    <div class="price mb-4">

                        <h4 class="mb-2">
                            Price
                        </h4>

                        <input type="range" class="form-range w-100" id="price_range" min="0" max="500"
                            step="5" value="300">

                        <div class="d-flex justify-content-between">

                            <span>
                                0 AED
                            </span>

                            <span id="price_amount">
                                500
                            </span>

                        </div>

                    </div>

                </div>



                {{-- PRODUCT AREA --}}
                <div class="col-lg-9 wow fadeInUp">


                    {{-- SEARCH + SORT --}}
                    <div class="row g-4 mb-4">


                        {{-- SEARCH --}}
                        <div class="col-xl-7">

                            <div class="input-group">

                                <input type="search" id="search_product" class="form-control p-3"
                                    placeholder="Search Products">

                                <span class="input-group-text p-3">

                                    <i class="fa fa-search"></i>

                                </span>

                            </div>

                        </div>



                        {{-- SORT --}}
                        <div class="col-xl-5">

                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between align-items-center">

                                <label class="mb-0">
                                    Sort By:
                                </label>

                                <select id="sort_by"
                                    class="form-select form-select-sm border-0 bg-light w-50 filter-input">

                                    <option value="">
                                        Default
                                    </option>

                                    <option value="latest">
                                        Latest
                                    </option>

                                    <option value="low_to_high">
                                        Price Low To High
                                    </option>

                                    <option value="high_to_low">
                                        Price High To Low
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>



                    {{-- PRODUCT CONTAINER --}}
                    <div id="product-container">

                        <div class="row g-4">


                            @forelse($products as $product)
                                @php

                                    $variation = $product->variations->first();

                                    $image = optional($variation)->images->first();

                                @endphp



                                <div class="col-md-6 col-lg-4">

                                    {{-- PRODUCT LINK --}}
                                    <a href="{{ url('/product/' . $product->product_slug . '/' . $product->product_id) }}"
                                        class="text-decoration-none text-dark">

                                        <div class="product-item rounded">

                                            <div class="product-item-inner border rounded">


                                                {{-- IMAGE --}}
                                                <div class="product-item-inner-item">

                                                    @if ($image)
                                                        <img src="{{ asset('Products/' . $image->product_variation_image_name) }}"
                                                            class="img-fluid w-100 rounded-top"
                                                            style="height:250px; object-fit:cover;" alt="">
                                                    @else
                                                        <img src="https://via.placeholder.com/300x250"
                                                            class="img-fluid w-100 rounded-top"
                                                            style="height:250px; object-fit:cover;" alt="">
                                                    @endif



                                                </div>



                                                {{-- CONTENT --}}
                                                <div class="text-center rounded-bottom p-4">


                                                    {{-- CATEGORY --}}
                                                    <span class="d-block mb-2 text-muted">

                                                        {{ $product->category->category_name ?? '' }}

                                                    </span>



                                                    {{-- PRODUCT NAME --}}
                                                    <span class="d-block h5 text-dark">
                                                        {{ Str::limit($product->product_name, 30, '...') }}
                                                    </span>



                                                    {{-- PRICE --}}
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
                                            </div>
                                        </div>
                                    </a>

                                </div>
                            @empty
                                <div class="col-12 text-center">
                                    <h4>
                                        No Products Found
                                    </h4>
                                </div>
                            @endforelse
                        </div>
                        {{-- PAGINATION --}}
                        <div class="mt-5 d-flex justify-content-center">
                            {{ $products->links('User.Pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {

            /*
            |--------------------------------------------------------------------------
            | PRICE SLIDER
            |--------------------------------------------------------------------------
            */

            $('#price_range').on('input', function() {
                $('#price_amount').html(
                    $(this).val() + ' AED'
                );
            });

            /*
            |--------------------------------------------------------------------------
            | SEARCH DELAY
            |--------------------------------------------------------------------------
            */

            let typingTimer;

            $('#search_product').keyup(function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function() {
                    filterProducts();
                }, 500);
            });

            /*
            |--------------------------------------------------------------------------
            | FILTER CHANGE
            |--------------------------------------------------------------------------
            */

            $(document).on(
                'change input',
                '.filter-input, #price_range',
                function() {
                    filterProducts();
                }
            );

            /*
            |--------------------------------------------------------------------------
            | FILTER PRODUCTS AJAX
            |--------------------------------------------------------------------------
            */

            function filterProducts() {
                let categories = [];
                $('.category-filter:checked').each(function() {
                    categories.push($(this).val());
                });
                let brands = [];
                $('.brand-filter:checked').each(function() {
                    brands.push($(this).val());
                });

                let max_price =
                    $('#price_range').val();

                let search =
                    $('#search_product').val();

                let sort_by =
                    $('#sort_by').val();

                $.ajax({
                    url: "{{ url('/shop') }}",
                    type: "GET",
                    data: {
                        categories: categories,
                        brands: brands,
                        max_price: max_price,
                        search: search,
                        sort_by: sort_by
                    },


                    beforeSend: function() {
                        $('#product-container').html(
                            '<div class="text-center p-5"><h4>Loading Products...</h4></div>'
                        );
                    },


                    success: function(response) {
                        let html = $(response)
                            .find('#product-container')
                            .html();
                        $('#product-container').html(html);
                    }
                });
            }
        });
    </script>

@endsection
