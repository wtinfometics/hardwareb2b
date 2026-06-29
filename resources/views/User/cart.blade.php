@extends('User.main')

<!-- Page Meta Data Starts -->
@section('metadata')
    <title>Electro - Electronics Website Template</title>
    <meta content="" name="keywords">
    <meta content="" name="description">
@endsection
<!-- Page Meta Data Ends -->

<!-- Page Content Starts -->
@section('pagecontent')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Cart Page</h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart Page</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Variation Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody id="cartTableBody">

                    </tbody>
                </table>
            </div>

            <div class="row g-4 justify-content-end">

                <div class="col-8"></div>

                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">

                    <div class="bg-light rounded">

                        <div class="p-4">

                            <h1 class="display-6 mb-4">
                                Cart <span class="fw-normal">Total</span>
                            </h1>



                            <!-- SUB TOTAL -->

                            <div class="d-flex justify-content-between mb-4">

                                <h5 class="mb-0 me-4">
                                    Subtotal:
                                </h5>

                                <p class="mb-0">

                                    <span id="subTotal">
                                        0
                                    </span> AED

                                </p>

                            </div>



                            <!-- TAX -->

                            <div class="d-flex justify-content-between mb-4">

                                <h5 class="mb-0 me-4">
                                    Tax (5%)
                                </h5>

                                <p class="mb-0">

                                    <span id="taxAmount">
                                        0
                                    </span> AED

                                </p>

                            </div>



                            <!-- SHIPPING -->

                            <div class="d-flex justify-content-between">

                                <h5 class="mb-0 me-4">
                                    Shipping
                                </h5>

                                <div>

                                    <p class="mb-0">
                                        Free Shipping
                                    </p>

                                </div>

                            </div>

                        </div>



                        <!-- GRAND TOTAL -->

                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">

                            <h5 class="mb-0 ps-4 me-4">
                                Grand Total
                            </h5>

                            <p class="mb-0 pe-4 fw-bold text-success">

                                <span id="grandTotal">
                                    0
                                </span> AED

                            </p>

                        </div>



                        <!-- CHECKOUT BUTTON -->

                        <a href="/checkout" class="btn btn-primary rounded-pill px-4 py-3 text-uppercase mb-4 ms-4"
                            type="button">

                            Proceed Checkout

                        </a>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- Cart Page End -->

    <script>
        loadCart();



        /*
        |--------------------------------------------------------------------------
        | LOAD CART
        |--------------------------------------------------------------------------
        */

        function loadCart() {
            let cart =
                JSON.parse(localStorage.getItem('cart')) || [];



            /*
            |--------------------------------------------------------------------------
            | EMPTY CART
            |--------------------------------------------------------------------------
            */

            if (cart.length == 0) {

                document.getElementById('cartTableBody').innerHTML =
                    `
            <tr>
                <td colspan="6" class="text-center">
                    Cart is empty
                </td>
            </tr>
            `;

                return;
            }



            /*
            |--------------------------------------------------------------------------
            | FETCH PRODUCTS
            |--------------------------------------------------------------------------
            */

            fetch('/cart', {

                    method: 'POST',

                    headers: {

                        'Content-Type': 'application/json',

                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },

                    body: JSON.stringify({

                        cart: cart

                    })

                })

                .then(response => response.json())

                .then(data => {
                    let html = '';

                    let grandTotal = 0;



                    data.products.forEach((item, index) => {

                        grandTotal += item.total;

                        html += `

            <tr>

                <td>
                    ${item.product_name}
                </td>

                <td>
                    ${item.variation_name}
                </td>

                <td>
                    ${item.quantity}
                </td>

                <td>
                    ${item.price} AED
                </td>

                <td>
                    ${item.total} AED
                </td>

                <td>

                <button class="btn btn-md rounded-circle bg-light border"
                onclick="removeCartItem(${item.product_variation_id})" >
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                   

                </td>

            </tr>

            `;
                    });



                    /*
                    |--------------------------------------------------------------------------
                    | GRAND TOTAL
                    |--------------------------------------------------------------------------
                    */

                    document.getElementById('subTotal').innerHTML =
                        data.sub_total;

                    document.getElementById('taxAmount').innerHTML =
                        data.tax;

                    document.getElementById('grandTotal').innerHTML =
                        data.grand_total;



                    document.getElementById('cartTableBody').innerHTML =
                        html;

                });

        }




        /*
        |--------------------------------------------------------------------------
        | DELETE ITEM
        |--------------------------------------------------------------------------
        */

        function removeCartItem(variationId) {
            let cart =
                JSON.parse(localStorage.getItem('cart')) || [];



            cart = cart.filter(item =>

                item.product_variation_id != variationId

            );



            localStorage.setItem(
                'cart',
                JSON.stringify(cart)
            );



            loadCart();
        }
    </script>
@endsection
<!-- Page Content Ends -->
