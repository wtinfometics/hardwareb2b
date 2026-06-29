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
                        <h2>Order Details <small>( user invoice )</small></h2>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <!-- invoice section -->
                <div class="col-md-12">
                    <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                            <div class="d-flex justify-content-between">

                                <h2 class="mb-0">
                                    <i class="fa fa-file-text-o"></i> Invoice
                                </h2>

                                <div>
                                    <a href="{{ '/admin/orders/' . $order_id . '/invoice' }}" class="btn btn-success">
                                        <i class="fa fa-file-text-o"></i>
                                        download
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="full">
                            <div class="invoice_inner">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="full invoice_blog padding_infor_info padding-bottom_0">
                                            <h4>From</h4>
                                            <p><strong>{{ $companyData->name }}</strong><br>
                                                {{ $companyData->address . ' ' . $companyData->street . ' ' . $companyData->city . ' ' . $companyData->state . ' ' . $companyData->country . ' ' . $companyData->pin_code }}<br><br>
                                                <strong>TRN Number : </strong>{{ $companyData->trn_number }}<br>
                                                <strong>Phone : </strong>{{ $companyData->phone }} <br>
                                                <strong>Email : </strong>{{ $companyData->email }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="full invoice_blog padding_infor_info padding-bottom_0">
                                            <h4>To</h4>
                                            <p><strong>{{ $data->first_name . ' ' . $data->last_name }} </strong><br>
                                                {{ $data->address . ' ' . $data->street . ' ' . $data->city . ' ' . $data->state . ' ' . $data->country . ' ' . $data->pin_code }}
                                                <br><br>
                                                <strong>Landmark : </strong>{{ $data->landmark }}<br>
                                                <strong>Phone : </strong><a
                                                    href="{{ 'tel:' . $data->phone }}">{{ $data->phone }}</a><br>
                                                <strong>Email : </strong>{{ $data->email }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="full invoice_blog padding_infor_info padding-bottom_0">
                                            <h4>Invoice No - {{ $data->order_number }} </h4>
                                            <p><strong>Order Date : </strong> {{ $data->created_at->format('d M/Y') }} <br>
                                                <strong>Order Status : </strong> {{ $data->status }} <br>
                                                <strong>Delivery Date : </strong>
                                                {{ \Carbon\Carbon::parse($data->delivery_date)->format('d M/Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="full padding_infor_info">
                            <div class="table_row">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Product SKU </th>
                                                <th>Product Name</th>
                                                <th>Variation</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($data->orderProduct as $order)
                                                <tr>
                                                    <td>{{ $order->variation->sku }}</td>
                                                    <td>{{ $order->product->product_name }}</td>
                                                    <td>{{ $order->variation->variation_name }}</td>
                                                    <td>{{ $order->quantity }}</td>
                                                    <td>{{ $order->price }}</td>
                                                    <td>{{ $order->total }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No attributes found</td>
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
            <!-- row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="full white_shd">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2>Buyer Details </h2>
                            </div>
                        </div>
                        <div class="full padding_infor_info">

                            <p class="h5"><strong class="text-dark"> Contact Person :
                                </strong>{{ $data->first_name . ' ' . $data->last_name }}<br>
                                <strong class="text-dark">Company Name : </strong>{{ $data->company_name }}<br>
                                <strong class="text-dark">TRN Number :
                                </strong>{{ isset($data->wat_number) ? $data->wat_number : '' }}<br>
                                <strong class="text-dark">Address : </strong>
                                {{ $data->address . ' ' . $data->street . ' ' . $data->city . ' ' . $data->state . ' ' . $data->country . ' ' . $data->pin_code }}
                                <br>
                                <strong class="text-dark">Landmark : </strong>{{ $data->landmark }}<br>
                                <strong class="text-dark">Phone : </strong>{{ $data->phone }}<br>
                                <strong class="text-dark">Email : </strong>{{ $data->email }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="full white_shd">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2>Total Amount</h2>
                            </div>
                        </div>
                        <div class="full padding_infor_info">
                            <div class="price_table">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>{{ $data->subtotal }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tax </th>
                                                <td>{{ $data->tax }}</td>
                                            </tr>
                                            <tr>
                                                <th>Discount:</th>
                                                <td>{{ $data->discount }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>{{ $data->grand_total }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
    </div>
@endsection
