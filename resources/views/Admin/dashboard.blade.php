@extends('Admin.main')

@section('content')
    {{-- Success Message --}}
    @if (!empty($success) && $success === true && !empty($message))
        <div class="alert alert-success auto-hide">
            {{ $message }}
        </div>
    @endif

    {{-- Error Message from Controller --}}
    @if (isset($success) && $success === false && !empty($message))
        <div class="alert alert-danger auto-hide">
            {{ $message }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success auto-hide">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger ">
            {{ session('error') }}
        </div>
    @endif

    <div class="midde_cont">
        <div class="container-fluid">
            <div class="row column_title">
                <div class="col-md-12">
                    <div class="page_title">
                        <h2>Dashboard</h2>
                    </div>
                </div>
            </div>
            <div class="row column1">
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-shopping-cart blue1_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <p class="total_no">{{ $data['totalOrders'] }}</p>
                                <p class="head_couter">Total Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-check-circle green_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <p class="total_no">{{ $data['deliveredOrders'] }}</p>
                                <p class="head_couter">Delivered Orders </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-clock-o orange_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <p class="total_no">{{ $data['pendingOrders'] }}</p>
                                <p class="head_couter">Pending Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-times-circle red_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <p class="total_no">{{ $data['cancelledOrders'] }}</p>
                                <p class="head_couter">Canceled Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row column1 social_media_section">
                <div class="col-md-6 col-lg-3">
                    <div class="full socile_icons fb margin_bottom_30">
                        <div class="social_icon">
                            <i class="fa fa-pencil-square"></i>
                        </div>
                        <div class="social_cont">
                            <ul>
                                <li>
                                    <span><strong>{{ $data['totalPosts'] }}</strong></span>
                                    <span>Posts</span>
                                </li>
                                <li>
                                    <span><strong>{{ $data['activePosts'] }}</strong></span>
                                    <span>Active</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full socile_icons tw margin_bottom_30">
                        <div class="social_icon">
                            <i class="fa fa-cube"></i>
                        </div>
                        <div class="social_cont">
                            <ul>
                                <li>
                                    <span><strong>{{ $data['totalProducts'] }}</strong></span>
                                    <span>Products</span>
                                </li>
                                <li>
                                    <span><strong>{{ $data['activeProducts'] }}</strong></span>
                                    <span>Active</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full socile_icons linked margin_bottom_30">
                        <div class="social_icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="social_cont">
                            <ul>
                                <li>
                                    <span><strong>{{ $data['totalOrders'] }}</strong></span>
                                    <span>Orders</span>
                                </li>
                                <li>
                                    <span><strong>{{ $data['deliveredOrders'] }}</strong></span>
                                    <span>Completed</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full socile_icons google_p margin_bottom_30">
                        <div class="social_icon">
                            <i class="fa fa-folder-open"></i>
                        </div>
                        <div class="social_cont">
                            <ul>
                                <li>
                                    <span><strong>{{ $data['totalCategories'] }}</strong></span>
                                    <span>Category</span>
                                </li>
                                <li>
                                    <span><strong>{{ $data['totalBrands'] }}</strong></span>
                                    <span>Brands</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- graph -->
            <div class="row column2 graph margin_bottom_30">
                <div class="col-md-l2 col-lg-12">
                    <div class="white_shd full">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2>Last 7 Days Orders </h2>
                            </div>
                        </div>
                        <div class="full graph_revenue">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="white_shd full margin_bottom_30">

                                        <div class="table_section padding_infor_info">
                                            <div class="table-responsive-sm">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Sl No</th>
                                                            <th>Order Id </th>
                                                            <th>Delivery date </th>
                                                            <th>Total</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($data['last7DaysOrders'] as $order)
                                                            <tr>
                                                                <td>1</td>
                                                                <td> {{ $order->order_number }} </td>
                                                                <td>{{ $order->delivery_date }}</td>
                                                                <td> {{ $order->grand_total }} </td>
                                                                @php
                                                                    $badgeClasses = [
                                                                        'confirmed' => 'primary',
                                                                        'pending' => 'warning',
                                                                        'shipped    ' => 'info',
                                                                        'delivered' => 'success',
                                                                        'cancelled' => 'danger',
                                                                    ];

                                                                    $badgeClass =
                                                                        $badgeClasses[$order->status] ?? 'secondary';
                                                                @endphp

                                                                <td>
                                                                    <span
                                                                        class="badge badge-lg badge-pill badge-{{ $badgeClass }} "
                                                                        style="font-size:12px;padding:5px;">
                                                                        {{ ucfirst($order->status) }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <a type="button"
                                                                        href="{{ url('/admin/orders/' . $order->order_id) . '/view' }}"
                                                                        class=" btn btn-primary text-light">View</a>
                                                                    <a type="button"
                                                                        href="{{ url('/admin/orders/' . $order->order_id) . '/edit' }}"
                                                                        class=" btn btn-warning text-dark">Edit</a>

                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6" class="text-center">No Orders found
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end graph -->

        </div>
        <!-- footer -->
    </div>
@endsection
