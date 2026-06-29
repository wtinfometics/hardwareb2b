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
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Cheackout Page</h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cheackout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Searvices Start -->
    <div class="container-fluid px-0">
        <div class="row g-0">
            <div class="col-6 col-md-4 col-lg-2 border-start border-end wow fadeInUp" data-wow-delay="0.1s">
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
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.2s">
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
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.3s">
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
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.4s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-credit-card fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Receive Gift Card</h6>
                            <p class="mb-0">Recieve gift all over oder $50</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.5s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-lock fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Secure Payment</h6>
                            <p class="mb-0">We Value Your Security</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.6s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-blog fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Online Service</h6>
                            <p class="mb-0">Free return products in 30 days</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Searvices End -->


    <!-- Checkout Page Start -->
    <div class="container-fluid bg-light overflow-hidden py-5">
        <div class="container py-5">
            <h1 class="mb-4 wow fadeInUp" data-wow-delay="0.1s">Billing details</h1>
            <form action="#">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">First Name<sup>*</sup></label>
                                    <input type="text" id="first_name" placeholder="Enter The First Name"
                                        class="form-control">
                                    <small class="text-danger error-first_name"></small>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Last Name<sup>*</sup></label>
                                    <input type="text" id="last_name" placeholder="Enter The Last Name"
                                        class="form-control">
                                    <small class="text-danger error-last_name"></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Company Name</label>
                            <input type="text" id="company_name" placeholder="Enter Company Name" class="form-control">
                            <small class="text-danger error-company_name"></small>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">VAT / TRN Number</label>
                            <input type="text" id="wat_number" placeholder="Enter VAT / TRN Number" class="form-control">
                            <small class="text-danger error-wat_number"></small>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" id="address" placeholder="Enter Building Number Building Name "
                                class="form-control">
                            <small class="text-danger error-address"></small>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Street <sup>*</sup></label>
                            <input type="text" id="street" placeholder="Enter  Street Name" class="form-control">
                            <small class="text-danger error-street"></small>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Land Mark <sup>*</sup></label>
                            <input type="text" id="landmark" placeholder="Enter Landmark" class="form-control">
                            <small class="text-danger error-landmark"></small>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">City<sup>*</sup></label>
                            <input type="text" id="city" placeholder="Enter The City Name"
                                class="form-control">
                            <small class="text-danger error-city"></small>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">State<sup>*</sup></label>
                            <input type="text" id="state" placeholder="Enter The State Name"
                                class="form-control">
                            <small class="text-danger error-state"></small>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Country<sup>*</sup></label>
                            <input type="text" id="country" placeholder="Enter The Country Name"
                                class="form-control">
                            <small class="text-danger error-country"></small>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                            <input type="text" id="pin_code" placeholder="Enter The Zip Code" class="form-control">
                            <small class="text-danger error-pin_code"></small>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="tel" id="phone" placeholder="Enter The Mobile Number"
                                class="form-control">
                            <small class="text-danger error-phone"></small>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" id="email" placeholder="Enter The E-Mail Address"
                                class="form-control">
                            <small class="text-danger error-email"></small>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Variation Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="productList">

                                </tbody>
                            </table>
                            <div class="mt-5 ">
                                <div class="d-flex flex-wrap justify-content-start">
                                    <div class="m-1">
                                        <!-- Coupon Input -->
                                        <input type="text" id="couponCode" name="code"
                                            class="border-0 border-bottom rounded me-5 py-3 mb-2"
                                            placeholder="Coupon Code">

                                        <div id="coupon-error" class="text-danger mb-2"></div>

                                        <div id="coupon-success" class="text-success mb-2"></div>

                                        <input type="hidden" id="couponClaim" value="false">
                                    </div>
                                    <div class="m-1">
                                        <button id="applyCouponBtn" onclick="applyCoupon()"
                                            class="btn btn-primary rounded-pill px-4 py-3" type="button">
                                            Apply Coupon
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="border p-4 my-3 rounded bg-white">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5>
                                        Subtotal
                                    </h5>
                                    <h5>
                                        <span id="subTotal">0</span> AED
                                    </h5>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <h5>
                                        Discount
                                    </h5>
                                    <h5>
                                        <span id="discount">0</span> AED
                                    </h5>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <h5>
                                        Tax (5%)
                                    </h5>
                                    <h5>
                                        <span id="taxAmount">0</span> AED
                                    </h5>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <h5>
                                        Grand Total
                                    </h5>
                                    <h5>
                                        <span id="grandTotal">0</span> AED
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 my-3 col-6 mx-auto">
                            <button class="btn btn-primary rounded-pill" type="button" onclick="placeOrder()"
                                id="placeOrderBtn">
                                Place Order
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->

    <script>
        loadCart();

        /*
        |--------------------------------------------------------------------------
        | LOAD CART
        |--------------------------------------------------------------------------
        */
        let newCartItem = []

        function loadCart() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            if (cart.length == 0) {

                document.getElementById('productList').innerHTML =
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

            fetch('/checkout', {

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

                    let table = '';

                    let grandTotal = 0;



                    data.products.forEach((item, index) => {
                        newCartItem.push({

                            product_id: item.product_id,
                            product_variation_id: item.product_variation_id,
                            quantity: item.quantity,
                            price: item.price,
                            total: item.total

                        });
                        grandTotal += item.total;

                        table += `

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
                    ₹${item.price}
                </td>

                <td>
                    ₹${item.total}
                </td>

            </tr>

            `;
                    });


                    document.getElementById('subTotal').innerHTML =
                        data.sub_total;

                    document.getElementById('taxAmount').innerHTML =
                        data.tax;

                    document.getElementById('grandTotal').innerHTML =
                        data.grand_total;

                    document.getElementById('productList').innerHTML =
                        table;

                });

        }




        /*
        |--------------------------------------------------------------------------
        | Apply Coupon Code 
        |--------------------------------------------------------------------------
        */
        function applyCoupon() {

            let code = $('#couponCode').val();
            let subtotal = $('#subTotal').text();
            let couponClaim = $('#couponClaim').val();

            // Clear old messages
            $('#coupon-error').html('');
            $('#coupon-success').html('');

            $.ajax({

                url: '/applyCoupon',
                type: 'POST',

                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                data: {
                    coupon_code: code,
                    subtotal: subtotal,
                    coupon_claim: couponClaim
                },

                success: function(response) {

                    // Update totals
                    $('#subTotal').text(response.sub_total);
                    $('#taxAmount').text(response.tax);
                    $('#discount').text(response.discount);
                    $('#grandTotal').text(response.grand_total);

                    // Store coupon status
                    $('#couponClaim').val(response.coupon_claim);

                    // Disable after apply
                    $('#couponCode').prop('disabled', true);
                    $('#applyCouponBtn').prop('disabled', true);

                    // Display server success message
                    $('#coupon-success').html(response.message);

                },

                error: function(xhr) {

                    let errorText = '';

                    // Laravel validation errors
                    if (xhr.responseJSON.errors) {

                        $.each(xhr.responseJSON.errors, function(key, value) {

                            errorText += value[0] + '<br>';

                        });

                    }

                    // Custom server message
                    else if (xhr.responseJSON.message) {

                        errorText = xhr.responseJSON.message;

                    } else {

                        errorText = xhr.responseJSON.message;

                    }

                    // Display server error message
                    $('#coupon-error').html(errorText);
                }
            });
        }


        /*
        |--------------------------------------------------------------------------
        | PLACE ORDER
        |--------------------------------------------------------------------------
        */

        function placeOrder() {

            // Billing Details
            let first_name = $('#first_name').val();
            let last_name = $('#last_name').val();
            let company_name = $('#company_name').val();
            let wat_number = $('#wat_number').val();
            let address = $('#address').val();
            let street = $('#street').val();
            let landmark = $('#landmark').val();

            let city = $('#city').val();
            let state = $('#state').val();
            let country = $('#country').val();
            let pin_code = $('#pin_code').val();
            let phone = $('#phone').val();
            let email = $('#email').val();

            // Totals
            let sub_total = $('#subTotal').text();
            let tax = $('#taxAmount').text();
            let discount = $('#discount').text();
            let grand_total = $('#grandTotal').text();

            // Prepare Products
            let products = [];

            newCartItem.forEach(item => {

                products.push({

                    product_id: item.product_id,
                    product_variation_id: item.product_variation_id,
                    quantity: item.quantity,
                    price: item.price,
                    total: item.total

                });

            });

            // Disable button while processing
            $('#placeOrderBtn').prop('disabled', true).text('Processing...');

            $.ajax({

                url: '/placeOrder',

                type: 'POST',

                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                data: {

                    products: products,

                    first_name: first_name,
                    last_name: last_name,
                    company_name: company_name,
                    wat_number: wat_number,

                    address: address,
                    street: street,
                    landmark: landmark,

                    city: city,
                    state: state,

                    country: country,
                    pin_code: pin_code,

                    phone: phone,
                    email: email,

                    sub_total: sub_total,
                    tax: tax,
                    discount: discount,
                    grand_total: grand_total
                },

                success: function(response) {

                    if (response.success) {

                        $('#modalIcon')
                            .removeClass('error-icon')
                            .addClass('success-icon')
                            .html('✓');

                        $('#messageModalLabel').text('Order Successful');
                        $('#messageBody').html(response.message);

                        $('#messageModal').modal('show');

                        // Clear cart
                        localStorage.removeItem('cart');


                        setTimeout(function() {
                            window.location.href = "/";
                        }, 3000);


                    } else {

                        $('#modalIcon')
                            .removeClass('success-icon')
                            .addClass('error-icon')
                            .html('✕');

                        $('#messageModalLabel').text('Order Failed');
                        $('#messageBody').html(response.message);
                    }

                    $('#messageModal').modal('show');
                },

                error: function(xhr) {
                    // Clear old errors
                    $('.text-danger').html('');

                    if (xhr.status === 422 && xhr.responseJSON.errors) {

                        $.each(xhr.responseJSON.errors, function(field, messages) {

                            $('.error-' + field).html(messages[0]);

                            $('#' + field).addClass('is-invalid');
                        });

                    }

                    let errorText = 'Something went wrong!';

                    if (xhr.responseJSON?.errors) {

                        errorText = '';

                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorText += value[0] + '<br>';
                        });

                    } else if (xhr.responseJSON?.message) {

                        errorText = xhr.responseJSON.message;
                    }

                    $('#messageModalLabel')
                        .removeClass('text-success')
                        .addClass('text-danger')
                        .text('Validation Error');

                    $('#messageBody').html(errorText);

                    $('#messageModal').modal('show');

                    $('#placeOrderBtn')
                        .prop('disabled', false)
                        .text('Place Order');
                }

            });

        }
    </script>

    <div class="modal fade" id="messageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center border-0 shadow">

                <div class="modal-header border-0">
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body pb-4">

                    <div id="modalIcon" class="success-icon mx-auto mb-3">
                        ✓
                    </div>

                    <h3 id="messageModalLabel">Success</h3>

                    <p id="messageBody" class="text-muted">
                        Your order has been placed successfully.
                    </p>

                </div>

            </div>
        </div>
    </div>
@endsection
<!-- Page Content Ends -->
