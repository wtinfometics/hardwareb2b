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
                        <h2>Order</h2>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <form method="post" action="{{ isset($data->order_id) ? url('/admin/orders/' . $data->order_id) : '' }}"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Product Data-->
                    <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="heading1 margin_0">
                                    <h2>Edit Order </h2>
                                </div>
                            </div>
                            <div class="table_section padding_infor_info">
                                <div class="table-responsive-md">
                                    <div class="row ">
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="postname" class="col-sm-3 col-form-label">First Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="first_name"
                                                        value="{{ old('first_name', $data->first_name ?? '') }}"
                                                        class="form-control @error('first_name') is-invalid @enderror"
                                                        id="postname" placeholder="Enter First Name">
                                                    @error('first_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="postname" class="col-sm-3 col-form-label">Last Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="last_name"
                                                        value="{{ old('last_name', $data->last_name ?? '') }}"
                                                        class="form-control @error('last_name') is-invalid @enderror"
                                                        id="postname" placeholder="Enter Last Name">
                                                    @error('last_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="postname" class="col-sm-3 col-form-label">Company name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="company_name"
                                                        value="{{ old('company_name', $data->company_name ?? '') }}"
                                                        class="form-control @error('company_name') is-invalid @enderror"
                                                        id="postname" placeholder="Enter Company Name">
                                                    @error('company_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="postname" class="col-sm-3 col-form-label">Tax / WAT
                                                    Number</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="wat_number"
                                                        value="{{ old('wat_number', $data->wat_number ?? '') }}"
                                                        class="form-control @error('wat_number') is-invalid @enderror"
                                                        id="postname" placeholder="Enter  Tax / WAT Number">
                                                    @error('wat_number')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="postname" class="col-sm-3 col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="address"
                                                        value="{{ old('address', $data->address ?? '') }}"
                                                        class="form-control @error('address') is-invalid @enderror"
                                                        id="postname" placeholder="Enter Building Number Building Name ">
                                                    @error('address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="postname" class="col-sm-3 col-form-label">Street </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="street"
                                                        value="{{ old('street', $data->street ?? '') }}"
                                                        class="form-control @error('street') is-invalid @enderror"
                                                        id="postname" placeholder="Enter Street Name And Road Name">
                                                    @error('street')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="postname" class="col-sm-3 col-form-label">Land mark</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="landmark"
                                                        value="{{ old('landmark', $data->landmark ?? '') }}"
                                                        class="form-control @error('landmark') is-invalid @enderror"
                                                        id="postname" placeholder="Enter Landmark ">
                                                    @error('landmark')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="postname" class="col-sm-3 col-form-label">City </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="city"
                                                        value="{{ old('city', $data->city ?? '') }}"
                                                        class="form-control @error('city') is-invalid @enderror"
                                                        id="postname" placeholder="Enter City Name">
                                                    @error('city')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="postname" class="col-sm-3 col-form-label">State</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="state"
                                                        value="{{ old('state', $data->state ?? '') }}"
                                                        class="form-control @error('state') is-invalid @enderror"
                                                        id="postname" placeholder="Enter State Name">
                                                    @error('state')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="postname" class="col-sm-3 col-form-label">Country</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="country"
                                                        value="{{ old('country', $data->country ?? '') }}"
                                                        class="form-control @error('country') is-invalid @enderror"
                                                        id="postname" placeholder="Enter Country Name">
                                                    @error('country')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="postname" class="col-sm-3 col-form-label">Pin Code</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="pin_code"
                                                        value="{{ old('pin_code', $data->pin_code ?? '') }}"
                                                        class="form-control @error('pin_code') is-invalid @enderror"
                                                        id="postname" placeholder="Enter Postal Code ">
                                                    @error('pin_code')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="postname" class="col-sm-3 col-form-label">Phone Number</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="phone"
                                                        value="{{ old('phone', $data->phone ?? '') }}"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        id="postname" placeholder="Enter Phone Number ">
                                                    @error('phone')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="postname" class="col-sm-3 col-form-label">Email ID </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="email"
                                                        value="{{ old('email', $data->email ?? '') }}"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="postname" placeholder="Enter Email Address ">
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="postname" class="col-sm-3 col-form-label"> Delivery Date
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="date" name="delivery_date"
                                                        value="{{ old('delivery_date', $data->delivery_date ?? '') }}"
                                                        class="form-control @error('delivery_date') is-invalid @enderror"
                                                        id="postname" placeholder="Enter Delivery date ">
                                                    @error('delivery_date')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="category">Status</label>
                                                <div class="col-sm-9">
                                                    <select id="inputState" name="status"
                                                        value="{{ old('status', $data->status ?? '') }}"
                                                        class="form-control @error('status') is-invalid @enderror">
                                                        <option value="" selected> Select The Order Delivery States</option>
                                                        <option value="pending"
                                                            {{ $data->status == 'pending' ? 'selected' : '' }}> Pending
                                                        </option>
                                                        <option value="confirmed"
                                                            {{ $data->status == 'confirmed' ? 'selected' : '' }}>Confirmed
                                                        </option>
                                                        <option value="shipped"
                                                            {{ $data->status == 'shipped' ? 'selected' : '' }}>Shipped
                                                        </option>
                                                        <option value="delivered"
                                                            {{ $data->status == 'delivered' ? 'selected' : '' }}>Delivered
                                                        </option>
                                                        <option value="cancelled"
                                                            {{ $data->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                                        </option>
                                                    </select>
                                                    @error('status')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-2">
                                            <div class=" d-flex justify-content-end">
                                                <button class="btn btn-primary btn-lg submit-btn"
                                                    type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
