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
                        <h2>Posters</h2>
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
                                <h2>Add Poster </h2>
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-md">
                                <form method="post"
                                    action="{{ isset($data->poster_id) ? url('/admin/posters/' . $data->poster_id) : url('/admin/posters') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="banner-name" class="col-sm-3 col-form-label">Poster Name
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="poster_name"
                                                        value="{{ old('poster_name', $data->poster_name ?? '') }}"
                                                        class="form-control @error('poster_name') is-invalid @enderror"
                                                        id="banner-name" placeholder="Enter Banner Name ">
                                                    @error('poster_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="banner-header" class="col-sm-3 col-form-label">Poster Header
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="poster_header"
                                                        value="{{ old('poster_header', $data->poster_header ?? '') }}"
                                                        class="form-control @error('poster_header') is-invalid @enderror"
                                                        id="banner-header" placeholder="Enter Poster Header ">
                                                    @error('poster_header')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="banner-message" class="col-sm-3 col-form-label">Featured Message
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="featured_message"
                                                        value="{{ old('featured_message', $data->featured_message ?? '') }}"
                                                        class="form-control @error('featured_message') is-invalid @enderror"
                                                        id="banner-message" placeholder="Enter Banner Featured Message ">
                                                    @error('featured_message')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="button-text" class="col-sm-3 col-form-label"> Button Text
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="button_text"
                                                        value="{{ old('button_text', $data->button_text ?? '') }}"
                                                        class="form-control @error('button_text') is-invalid @enderror"
                                                        id="button-text" placeholder="Enter Button Text ">
                                                    @error('button_text')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="banner-img" class="col-sm-3 col-form-label"> Banner
                                                    Image </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control @error('poster_image') is-invalid @enderror"
                                                        name="poster_image" type="file" id="banner-img">
                                                    <div class="form-text text-muted mt-1">
                                                        ✔ Required resolution: 600 × 360 pixels<br>
                                                        ✔ Allowed formats: JPG, JPEG, PNG, WEBP<br>
                                                        ✔ Maximum size: 800KB per image
                                                    </div>
                                                    @error('poster_image')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="link" class="col-sm-3 col-form-label">Redirect URL </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="link"
                                                        value="{{ old('link', $data->link ?? '') }}"
                                                        class="form-control @error('link') is-invalid @enderror"
                                                        id="link" placeholder="Enter Redirect URL ">
                                                    @error('link')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="inputState">Status</label>
                                                <div class="col-sm-9">
                                                    <select id="inputState" name="status"
                                                        value="{{ old('status', $data->status ?? '') }}"
                                                        class="form-control @error('status') is-invalid @enderror">
                                                        <option value="" selected> Select The Status</option>
                                                        <option value=1
                                                            {{ isset($data) && $data->status == true ? 'selected' : '' }}>
                                                            Active
                                                        </option>

                                                        <option value=0
                                                            {{ isset($data) && $data->status == false ? 'selected' : '' }}>
                                                            Inactive
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
