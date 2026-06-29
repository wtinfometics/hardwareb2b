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
                        <h2>Coupon</h2>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">

                <!-- Product Data-->
                <div class="col-md-12">
                    <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                            <div class="heading1 margin_0 d-flex ">
                                <h2>Add Coupon </h2>
                                {!! isset($data->coupon_code)
                                    ? '<h2 class="mx-5">
                                                                            Coupon Code :-
                                                                            <span class="text-danger">' .
                                        $data->coupon_code .
                                        '</span>
                                                                       </h2>'
                                    : '' !!}
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-md">
                                <form method="post"
                                    action="{{ isset($data->coupon_id) ? url('/admin/coupons/' . $data->coupon_id) : url('/admin/coupons') }}">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="coupon-name" class="col-sm-3 col-form-label">Coupon
                                                    Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="coupon_name"
                                                        value="{{ old('coupon_name', $data->coupon_name ?? '') }}"
                                                        class="form-control @error('coupon_name') is-invalid @enderror"
                                                        id="coupon-name" placeholder="Enter Coupon Name">
                                                    @error('coupon_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="exp-date" class="col-sm-3 col-form-label"> Expiry
                                                    date</label>
                                                <div class="col-sm-9">
                                                    <input type="date" name="expiry_date"
                                                        value="{{ old('expiry_date', $data->expiry_date ?? '') }}"
                                                        class="form-control @error('expiry_date') is-invalid @enderror"
                                                        id="exp-date" placeholder="Enter Expiry date ">
                                                    @error('expiry_date')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">

                                                <label class="col-sm-3 col-form-label" for="disc-type">
                                                    Discount Type
                                                </label>
                                                <div class="col-sm-9">
                                                    <select id="disc-type" name="discount_type"
                                                        class="form-control @error('discount_type') is-invalid @enderror">
                                                        <option value="">Select The Discount Type</option>
                                                        <option value="percentage"
                                                            {{ old('discount_type', $data->discount_type ?? '') == 'percentage' ? 'selected' : '' }}>
                                                            Percentage
                                                        </option>
                                                        <option value="fixed"
                                                            {{ old('discount_type', $data->discount_type ?? '') == 'fixed' ? 'selected' : '' }}>
                                                            Flat
                                                        </option>
                                                    </select>
                                                    @error('discount_type')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="coupon-value" class="col-sm-3 col-form-label">Coupon
                                                    Value</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="discount"
                                                        value="{{ old('discount', $data->discount ?? '') }}"
                                                        class="form-control @error('discount') is-invalid @enderror"
                                                        id="coupon-value" placeholder="Enter Coupon Value">
                                                    @error('discount')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="max-limit" class="col-sm-3 col-form-label">Minimum Discount
                                                    Limit </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="max_discount"
                                                        value="{{ old('max_discount', $data->max_discount ?? '') }}"
                                                        class="form-control @error('max_discount') is-invalid @enderror"
                                                        id="max-limit" placeholder="Enter Maximum Discount Limit">
                                                    @error('max_discount')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="status">Status
                                                </label>
                                                <div class="col-sm-9">
                                                    <select id="status" name="status"
                                                        class="form-control @error('status') is-invalid @enderror">
                                                        <option value="" > Select The Product</option>
                                                        <option value="1"
                                                            {{ old('status', $data->status ?? '') == 1 ? 'selected' : '' }}>
                                                            Active
                                                        </option>

                                                        <option value="0"
                                                            {{ old('status', $data->status ?? '') == 0 ? 'selected' : '' }}>
                                                            InActive
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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
