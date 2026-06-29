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
                        <h2>Products</h2>
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
                                <h2>Attribute </h2>
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-md">
                                <form method="post"
                                    action="{{ isset($data->attribute_id) ? url('/admin/attributes/' . $data->attribute_id) : url('/admin/attributes') }}">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">Attribute
                                                    Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="attribute_name" id="inputPassword"
                                                        placeholder="Enter Attribute Name"
                                                        value="{{ old('attribute_name', $data->attribute_name ?? '') }}"
                                                        class="form-control @error('attribute_name') is-invalid @enderror">

                                                    @error('attribute_name')
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
