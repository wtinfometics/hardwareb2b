@extends('User.main')

@section('metadata')
    <title>{{ $product->product_name }}</title>

    <meta name="keywords" content="{{ $product->meta->keyword ?? '' }}">

    <meta name="description" content="{{ $product->meta->meta_description ?? '' }}">
@endsection


@section('pagecontent')
    @php

        $defaultVariation = $product->variations->first();

        $defaultAttributes = [];

        foreach ($defaultVariation->attributes as $attr) {
            $defaultAttributes[$attr->attribute->attribute_name] = $attr->attributeVariation->attribute_variation_name;
        }
        $groupedAttributes = [];

        foreach ($product->variations as $variation) {
            foreach ($variation->attributes as $attr) {
                $attributeName = $attr->attribute->attribute_name;

                $attributeValue = $attr->attributeVariation->attribute_variation_name;

                $groupedAttributes[$attributeName][] = $attributeValue;
            }
        }

    @endphp



    <!-- Page Header -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp">
            Product Details
        </h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp">
            <li class="breadcrumb-item">
                <a href="/">Home</a>
            </li>
            <li class="breadcrumb-item active text-white">
                Product Details
            </li>
        </ol>
    </div>



    <!-- PRODUCT DETAILS -->

    <div class="container-fluid shop py-5">

        <div class="container py-5">

            <div class="row g-4">

                <div class="col-lg-12">

                    <div class="row g-4 single-product">



                        <!-- PRODUCT IMAGES -->

                        <div class="col-xl-6">

                            <div class="single-carousel owl-carousel" id="variationImages">

                                @foreach ($defaultVariation->images as $image)
                                    <div class="single-item"
                                        data-dot="
                                    <img
                                    class='img-fluid'
                                    src='{{ asset('Products/' . $image->product_variation_image_name) }}'
                                    >">

                                        <div class="single-inner bg-light rounded">

                                            <img src="{{ asset('Products/' . $image->product_variation_image_name) }}"
                                                class="img-fluid rounded">

                                        </div>

                                    </div>
                                @endforeach

                            </div>

                        </div>



                        <!-- PRODUCT INFO -->

                        <div class="col-xl-6">

                            <h4 class="fw-bold mb-3">

                                {{ $product->product_name }}

                            </h4>


                            <div class="row">

                                <div class="col-12 col-md-6 mb-3">
                                    <p class="mb-0">
                                        <span class="fw-bold text-primary">Category :</span>
                                        {{ $product->category->category_name ?? '' }}
                                    </p>
                                </div>

                                <div class="col-12 col-md-6 mb-3">
                                    <p class="mb-0">
                                        <span class="fw-bold text-primary">Sub Category :</span>
                                        {{ $product->subcategory->subcategory_name ?? '' }}
                                    </p>
                                </div>

                                <div class="col-12 col-md-6 mb-3">
                                    <p class="mb-0">
                                        <span class="fw-bold text-primary">Brand :</span>
                                        {{ $product->brand->brand_name ?? '' }}
                                    </p>
                                </div>

                            </div>



                            <!-- PRICE -->

                            <h5 class="fw-bold mb-3">

                                <del class="me-2 text-danger" id="variationPrice">

                                    {{ $defaultVariation->price }} AED
                                </del>


                                <span id="variationDiscountPrice">

                                    {{ $defaultVariation->discount_price }}

                                </span> AED

                            </h5>



                            <!-- SKU + STOCK -->

                            <div class="d-flex flex-column mb-3">

                                <small>

                                    Product SKU :

                                    <span id="variationSku">

                                        {{ $defaultVariation->sku }}

                                    </span>

                                </small>

                                <small>

                                    Available :

                                    <strong class="text-primary">

                                        <span id="variationStock">

                                            {{ $defaultVariation->stock }}

                                        </span>

                                        items in stock

                                    </strong>

                                </small>

                            </div>



                            <!-- ATTRIBUTES -->

                            <div class="d-flex flex-column mb-4">

                                @foreach ($groupedAttributes as $attributeName => $values)
                                    <div class="mb-3">

                                        <strong>

                                            {{ $attributeName }}

                                        </strong>



                                        @foreach (array_unique($values) as $key => $value)
                                            @php
                                                $id = strtolower($attributeName) . $key;

                                                $isChecked =
                                                    isset($defaultAttributes[$attributeName]) &&
                                                    $defaultAttributes[$attributeName] == $value;
                                            @endphp

                                            <input type="radio" class="btn-check variation-option"
                                                name="{{ $attributeName }}" id="{{ $id }}"
                                                data-attribute="{{ $attributeName }}" data-value="{{ $value }}"
                                                autocomplete="off" {{ $isChecked ? 'checked' : '' }}>

                                            <label class="m- btn btn-outline-primary mt-2" for="{{ $id }}">

                                                {{ $value }}

                                            </label>
                                        @endforeach

                                    </div>
                                @endforeach

                            </div>



                            <!-- DESCRIPTION -->

                            <p class="mb-4" id="variationDescription">


                            </p>



                            <!-- QUANTITY -->

                            <div class="input-group quantity mb-5" style="width: 120px;">

                                <div class="input-group-btn">

                                    <button type="button" id="minusBtn"
                                        class="btn btn-sm btn-minus rounded-circle bg-light border">

                                        <i class="fa fa-minus"></i>

                                    </button>

                                </div>

                                <input type="text" id="quantityInput"
                                    class="form-control form-control-sm text-center border-0"
                                    value="{{ $product->min_order }}" readonly>

                                <div class="input-group-btn">

                                    <button type="button" id="plusBtn"
                                        class="btn btn-sm btn-plus rounded-circle bg-light border">

                                        <i class="fa fa-plus"></i>

                                    </button>

                                </div>

                            </div>



                            <!-- ADD TO CART -->

                            <a href="javascript:void(0)" id="addToCartBtn" data-product-id="{{ $product->product_id }}"
                                class="btn btn-primary border border-secondary rounded-pill px-4 py-2 mb-4 text-white">

                                <i class="fa fa-shopping-bag me-2"></i>

                                Add To Cart

                            </a>

                        </div>



                        <!-- DESCRIPTION TAB -->

                        <div class="col-lg-12">

                            <nav>

                                <div class="nav nav-tabs mb-3">

                                    <button class="nav-link active border-white border-bottom-0" type="button">

                                        Description

                                    </button>

                                </div>

                            </nav>

                            <div class="tab-content mb-5">

                                <div class="tab-pane active">

                                    {!! $product->description !!}

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>





    <!-- SCRIPTS -->
    <script>
        const variations =
            @json($product->variations);



        /*
        |--------------------------------------------------------------------------
        | SELECTED ATTRIBUTES
        |--------------------------------------------------------------------------
        */

        let selectedAttributes = {};



        /*
        |--------------------------------------------------------------------------
        | CURRENT VARIATION
        |--------------------------------------------------------------------------
        */

        let currentVariation =
            variations[0];

        currentVariation.attributes.forEach(function(attr) {
            selectedAttributes[attr.attribute.attribute_name] =
                attr.attribute_variation.attribute_variation_name;
        });

        /*
        |--------------------------------------------------------------------------
        | ATTRIBUTE CLICK
        |--------------------------------------------------------------------------
        */

        document.querySelectorAll('.variation-option')
            .forEach(option => {

                option.addEventListener('change', function() {

                    let attribute =
                        this.dataset.attribute;

                    let value =
                        this.dataset.value;

                    selectedAttributes[attribute] =
                        value;

                    findMatchingVariation();

                });

            });



        /*
    |--------------------------------------------------------------------------
    | LOAD DEFAULT VARIATION
    |--------------------------------------------------------------------------
    */
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.variation-option:checked')
                .forEach(option => {

                    selectedAttributes[option.dataset.attribute] =
                        option.dataset.value;

                });

            findMatchingVariation();

        });

        /*
        |--------------------------------------------------------------------------
        | FIND MATCHING VARIATION
        |--------------------------------------------------------------------------
        */

        function findMatchingVariation() {
            let matchedVariation = null;

            variations.forEach(function(variation) {

                let variationAttributes = {};

                variation.attributes.forEach(function(attr) {

                    let attrName =
                        attr.attribute.attribute_name;

                    let attrValue =
                        attr.attribute_variation.attribute_variation_name;

                    variationAttributes[attrName] =
                        attrValue;

                });


                let isMatch = true;

                for (let key in selectedAttributes) {

                    if (
                        variationAttributes[key] !=
                        selectedAttributes[key]
                    ) {
                        isMatch = false;
                        break;
                    }

                }

                if (isMatch) {

                    matchedVariation = variation;

                }

            });


            if (matchedVariation) {

                currentVariation =
                    matchedVariation;

                updateVariationUI(matchedVariation);

            }

        }



        /*
        |--------------------------------------------------------------------------
        | UPDATE PRODUCT UI
        |--------------------------------------------------------------------------
        */

        function updateVariationUI(variation) {
            document.getElementById('variationDiscountPrice').innerHTML =
                variation.discount_price;

            document.getElementById('variationPrice').innerHTML =
                variation.price;

            document.getElementById('variationSku').innerHTML =
                variation.sku;

            document.getElementById('variationStock').innerHTML =
                variation.stock;

            document.getElementById('variationDescription').innerHTML =
                variation.short_description ?? '';



            /*
            |--------------------------------------------------------------------------
            | BUILD IMAGES
            |--------------------------------------------------------------------------
            */

            let html = '';

            variation.images.forEach(img => {

                html += `
        <div class="single-item"
            data-dot="<img class='img-fluid'
            src='/Products/${img.product_variation_image_name}'>">

            <div class="single-inner bg-light rounded">

                <img src="/Products/${img.product_variation_image_name}"
                    class="img-fluid rounded">

            </div>

        </div>`;
            });



            /*
            |--------------------------------------------------------------------------
            | UPDATE OWL CAROUSEL
            |--------------------------------------------------------------------------
            */

            let owl = $('#variationImages');

            owl.trigger('destroy.owl.carousel');

            owl.html(html);

            owl.owlCarousel({
                autoplay: true,
                smartSpeed: 1500,
                dots: true,
                dotsData: true,
                loop: true,
                items: 1,
                nav: true,
                navText: [
                    '<i class="bi bi-arrow-left"></i>',
                    '<i class="bi bi-arrow-right"></i>'
                ]
            });

        }




        /*
        |--------------------------------------------------------------------------
        | QUANTITY
        |--------------------------------------------------------------------------
        */

        const minOrder =
            {{ $product->min_order }};

        const quantityInput =
            document.getElementById('quantityInput');

        const minusBtn =
            document.getElementById('minusBtn');

        const plusBtn =
            document.getElementById('plusBtn');



        function toggleMinusButton() {
            let currentQty =
                parseInt(quantityInput.value);

            if (currentQty <= minOrder) {

                minusBtn.disabled = true;

                minusBtn.classList.add('opacity-50');

            } else {

                minusBtn.disabled = false;

                minusBtn.classList.remove('opacity-50');

            }
        }



        toggleMinusButton();



        minusBtn.addEventListener('click', function() {

            let currentQty =
                parseInt(quantityInput.value);

            if (currentQty > minOrder) {

                quantityInput.value =
                    currentQty - 1;

            }

            toggleMinusButton();

        });



        plusBtn.addEventListener('click', function() {

            let currentQty =
                parseInt(quantityInput.value);

            quantityInput.value =
                currentQty + 1;

            toggleMinusButton();

        });



        /*
        |--------------------------------------------------------------------------
        | ADD TO CART
        |--------------------------------------------------------------------------
        */

        document.getElementById('addToCartBtn')
            .addEventListener('click', function(e) {

                e.preventDefault();



                /*
                |--------------------------------------------------------------------------
                | PRODUCT DATA
                |--------------------------------------------------------------------------
                */

                let productId =
                    this.dataset.productId;

                let variationId =
                    currentVariation.product_variation_id;

                let quantity =
                    parseInt(quantityInput.value);



                /*
                |--------------------------------------------------------------------------
                | GET CART
                |--------------------------------------------------------------------------
                */

                let cart =
                    JSON.parse(localStorage.getItem('cart')) || [];



                /*
                |--------------------------------------------------------------------------
                | CHECK EXISTING ITEM
                |--------------------------------------------------------------------------
                */

                let existingItem =
                    cart.find(item =>
                        item.product_variation_id == variationId
                    );



                /*
                |--------------------------------------------------------------------------
                | UPDATE OR INSERT
                |--------------------------------------------------------------------------
                */

                if (existingItem) {

                    existingItem.quantity += quantity;

                } else {

                    cart.push({

                        product_id: productId,

                        product_variation_id: variationId,

                        quantity: quantity

                    });

                }



                /*
                |--------------------------------------------------------------------------
                | SAVE TO LOCAL STORAGE
                |--------------------------------------------------------------------------
                */

                localStorage.setItem(
                    'cart',
                    JSON.stringify(cart)
                );





                $('#cartSuccessModal').modal('show');

            });
    </script>
    <div class="modal fade" id="cartSuccessModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">

                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center pb-4">

                    <div class="success-circle mx-auto mb-3">
                        <span>✓</span>
                    </div>

                    <h3 class="fw-bold">Added to Cart</h3>

                    <p class="text-muted">
                        Your product has been added to the cart successfully.
                    </p>

                    <div class="mt-4">
                        <a href="/cart" class="btn btn-success me-2">
                            View Cart
                        </a>

                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Continue Shopping
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
