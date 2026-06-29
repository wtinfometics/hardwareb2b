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
                        <h2>Company</h2>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">

                <!-- Product Data-->
                <div class="col-md-12">
                    <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2>Company Details </h2>
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-md">
                                <form method="post" action="/admin/company" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="company-name" class="col-sm-3 col-form-label">Company
                                                    Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name', $data->name ?? '') }}" id="company-name"
                                                        name="name" placeholder="Enter Company Name ">
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="website-name" class="col-sm-3 col-form-label">Website
                                                    Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('website_name') is-invalid @enderror"
                                                        value="{{ old('website_name', $data->website_name ?? '') }}"
                                                        id="website-name" name="website_name"
                                                        placeholder="Enter The Website Name">
                                                    @error('website_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="url" class="col-sm-3 col-form-label">Website URL</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('website_url') is-invalid @enderror"
                                                        value="{{ old('website_url', $data->website_url ?? '') }}"
                                                        id="url" name="website_url"
                                                        placeholder="Enter The Website URL">
                                                    @error('website_url')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="trn_number" class="col-sm-3 col-form-label"> TRN Number </label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('trn_number') is-invalid @enderror"
                                                        value="{{ old('trn_number', $data->trn_number ?? '') }}"
                                                        id="trn_number" name="trn_number"
                                                        placeholder="Enter Tax Registration Number">
                                                    @error('trn_number')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="address" class="col-sm-3 col-form-label">Address </label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('address') is-invalid @enderror"
                                                        value="{{ old('address', $data->address ?? '') }}" id="address"
                                                        name="address"
                                                        placeholder="Enter Address (ex: Building Name,Building Number,floor) ">
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
                                                <label for="street" class="col-sm-3 col-form-label">Street Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('street') is-invalid @enderror"
                                                        value="{{ old('street', $data->street ?? '') }}" id="street"
                                                        name="street" placeholder="Enter Street Name">
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
                                                <label for="city" class="col-sm-3 col-form-label"> City</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('city') is-invalid @enderror"
                                                        value="{{ old('city', $data->city ?? '') }}" id="city"
                                                        name="city" placeholder="Enter City Name">
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
                                                <label for="state" class="col-sm-3 col-form-label">State </label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('state') is-invalid @enderror"
                                                        value="{{ old('state', $data->state ?? '') }}" id="state"
                                                        name="state" placeholder="Enter State Name">
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
                                                <label for="country" class="col-sm-3 col-form-label"> Country </label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('country') is-invalid @enderror"
                                                        value="{{ old('country', $data->country ?? '') }}" id="country"
                                                        name="country" placeholder="Enter Country Name">
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
                                                <label for="pin-code" class="col-sm-3 col-form-label"> Pin Code</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('pin_code') is-invalid @enderror"
                                                        value="{{ old('pin_code', $data->pin_code ?? '') }}"
                                                        id="pin-code" name="pin_code" placeholder="Enter Pin Code">
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
                                                <label for="email" class="col-sm-3 col-form-label">Company Phone Number
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        value="{{ old('phone', $data->phone ?? '') }}" id="email"
                                                        name="phone" placeholder="Enter Company Phone Number">
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
                                                <label for="phone" class="col-sm-3 col-form-label">Company Email
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        value="{{ old('email', $data->email ?? '') }}" id="phone"
                                                        name="email" placeholder="Enter Company E-mail Address">
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
                                                <label for="logo" class="col-sm-3 col-form-label">Company Logo</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control @error('logo') is-invalid @enderror"
                                                        name="logo" type="file" id="logo">
                                                    <div class="form-text text-muted mt-1">
                                                        ✔ Required resolution: 200 × 72 pixels<br>
                                                        ✔ Allowed formats: JPG, JPEG, PNG, WEBP<br>
                                                        ✔ Maximum size: 500KB per image
                                                    </div>
                                                    @error('logo')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="fav_icon" class="col-sm-3 col-form-label">Fav Icon </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control @error('fav_icon') is-invalid @enderror"
                                                        name="fav_icon" type="file" id="fav_icon">
                                                    <div class="form-text text-muted mt-1">
                                                        ✔ Required resolution: 50 × 50 pixels<br>
                                                        ✔ Allowed formats: JPG, JPEG, PNG, WEBP<br>
                                                        ✔ Maximum size: 80KB per image
                                                    </div>
                                                    @error('fav_icon')
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
