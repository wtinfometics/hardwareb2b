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
                        <h2>Brands</h2>
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
                                <h2>Add Brand </h2>
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-md">
                                <form method="post"
                                    action="{{ isset($data->brand_id) ? url('/admin/brands/' . $data->brand_id) : url('/admin/brands') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="brand-name" class="col-sm-3 col-form-label">Brand
                                                    Name </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="brand_name"
                                                        value="{{ old('brand_name', $data->brand_name ?? '') }}"
                                                        class="form-control @error('brand_name') is-invalid @enderror"
                                                        id="brand-name" placeholder="Enter Brand Name">
                                                    @error('brand_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="brand-img" class="col-sm-3 col-form-label">Brand Image
                                                </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control @error('brand_image') is-invalid @enderror"
                                                        name="brand_image" type="file" id="brand-img">
                                                    <div class="form-text text-muted mt-1">
                                                        ✔ Required resolution: 100 × 100 pixels<br>
                                                        ✔ Allowed formats: JPG, JPEG, PNG, WEBP<br>
                                                        ✔ Maximum size: 500KB per image
                                                    </div>
                                                    @error('brand_image')
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
