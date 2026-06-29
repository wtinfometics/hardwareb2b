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
                        <h2>Orders</h2>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">

                <!-- table section -->
                <div class="col-md-12">
                    <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2> All Orders</h2>
                            </div>
                        </div>
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
                                        @forelse($paginatedData as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
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

                                                    $badgeClass = $badgeClasses[$order->status] ?? 'secondary';
                                                @endphp

                                                <td>
                                                    <span class="badge badge-lg badge-pill badge-{{ $badgeClass }} "
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
                                                    <form action="{{ url('/admin/orders/' . $order->order_id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class=" btn btn-danger text-light">delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No Orders found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{ $paginatedData->links('Admin.Pagination.custom') }}

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- footer -->
    </div>
@endsection
