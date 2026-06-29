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
                        <h2>Social Media</h2>
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
                                <h2>Social Media Accounts </h2>
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-md">
                                <form method="post" action="/admin/social-media">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-md-6 p-2">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text facebook" id="basic-addon1">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </span>
                                                <input type="text"
                                                    class="form-control @error('facebook') is-invalid @enderror"
                                                    name="facebook" value="{{ old('facebook', $data->facebook ?? '') }}"
                                                    placeholder="Enter facebook Link" aria-label="Username"
                                                    aria-describedby="basic-addon1">
                                                @error('facebook')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text instagram" id="basic-addon1">
                                                    <i class="fa-brands fa-instagram"></i>
                                                </span>
                                                <input type="text"
                                                    class="form-control @error('instagram') is-invalid @enderror"
                                                    name="instagram" value="{{ old('instagram', $data->instagram ?? '') }}"
                                                    placeholder="Enter Instagram Link" aria-label="Username"
                                                    aria-describedby="basic-addon1">
                                                @error('instagram')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text linkedin" id="basic-addon1">
                                                    <i class="fa-brands fa-linkedin"></i>
                                                </span>
                                                <input type="text"
                                                    class="form-control @error('linkedin') is-invalid @enderror"
                                                    name="linkedin" value="{{ old('linkedin', $data->linkedin ?? '') }}"
                                                    placeholder="Enter Linkedin Link" aria-label="Username"
                                                    aria-describedby="basic-addon1">
                                                @error('linkedin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text youtube" id="basic-addon1">
                                                    <i class="fa-brands fa-youtube"></i>
                                                </span>
                                                <input type="text"
                                                    class="form-control @error('youtube') is-invalid @enderror"
                                                    name="youtube" value="{{ old('youtube', $data->youtube ?? '') }}"
                                                    placeholder="Enter YouTube Link" aria-label="Username"
                                                    aria-describedby="basic-addon1">
                                                @error('youtube')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text x" id="basic-addon1">
                                                    <i class="fa-brands fa-x-twitter"></i>
                                                </span>
                                                <input type="text" class="form-control @error('x') is-invalid @enderror"
                                                    name="x" value="{{ old('x', $data->x ?? '') }}"
                                                    placeholder="Enter X Account Link" aria-label="Username"
                                                    aria-describedby="basic-addon1">
                                                @error('x')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text whatsapp" id="basic-addon1">
                                                    <i class="fa-brands fa-whatsapp"></i>
                                                </span>
                                                <input type="text"
                                                    class="form-control @error('whatsapp') is-invalid @enderror"
                                                    name="whatsapp" value="{{ old('whatsapp', $data->whatsapp ?? '') }}"
                                                    placeholder="Enter Whatsapp Link" aria-label="Username"
                                                    aria-describedby="basic-addon1">
                                                @error('whatsapp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
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
