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
                        <h2>Policies</h2>
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
                                <h2>Add Policy </h2>
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-md">
                                <form method="post"
                                    action="{{ isset($data->policy_id) ? url('/admin/policies/' . $data->policy_id) : url('/admin/policies') }}">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-md-12 p-2">
                                            <div class="form-group row">
                                                <label for="policyname" class="col-sm-2 col-form-label">Policy Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="policy_name"
                                                        value="{{ old('policy_name', $data->policy_name ?? '') }}"
                                                        class="form-control @error('policy_name') is-invalid @enderror"
                                                        id="policyname" placeholder="Enter Policy Name">
                                                    @error('policy_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-2">
                                            <div class="form-group row">
                                                <label for="description" class="col-sm-2 col-form-label">Policy
                                                </label>
                                                <div class="col-sm-9">
                                                    <div class="main-container">
                                                        <textarea id="editor" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $data->description ?? '') }}
                                                                </textarea>
                                                        @error('description')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="inputState">Status</label>
                                                <div class="col-sm-8">
                                                    <select id="inputState" name="status"
                                                        value="{{ old('status', $data->status ?? '') }}"
                                                        class="form-control @error('status') is-invalid @enderror">
                                                        <option value=""> Select The Status</option>
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
