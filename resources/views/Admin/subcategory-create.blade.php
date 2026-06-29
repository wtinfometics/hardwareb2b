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
                        <h2>Sub Category</h2>
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
                                <h2>Add Sub Category </h2>
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-md">
                                <form method="post"
                                    action="{{ isset($data->subcategory_id) ? url('/admin/subcategories/' . $data->subcategory_id) : url('/admin/subcategories') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="sub-category-name" class="col-sm-3 col-form-label">Sub
                                                    Category Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="subcategory_name"
                                                        value="{{ old('subcategory_name', $data->subcategory_name ?? '') }}"
                                                        class="form-control @error('subcategory_name') is-invalid @enderror"
                                                        id="sub-category-name" placeholder="Enter Sub category Name">
                                                    @error('subcategory_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="category">Category</label>
                                                <div class="col-sm-9">
                                                    <select id="category" name="category_id"
                                                        value="{{ old('category_id', $data->category_id ?? '') }}"
                                                        class="form-control @error('category_id') is-invalid @enderror">
                                                        <option value="" selected> Select The Category</option>
                                                        @forelse($allCategories as $category)
                                                            <option value="{{ $category->category_id }}"
                                                                {{ isset($data) && $data->category_id == $category->category_id ? 'selected' : '' }}>
                                                                {{ $category->category_name }}
                                                            </option>
                                                        @empty
                                                            <option> No category Exists </option>
                                                        @endforelse
                                                    </select>
                                                    @error('category_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="sub-category-image" class="col-sm-3 col-form-label">Sub
                                                    Category Image </label>
                                                <div class="col-sm-9">
                                                    <input
                                                        class="form-control @error('subcategory_image') is-invalid @enderror"
                                                        name="subcategory_image" type="file" id="sub-category-image">
                                                    <div class="form-text text-muted mt-1">
                                                        ✔ Required resolution: 100 × 100 pixels<br>
                                                        ✔ Allowed formats: JPG, JPEG, PNG, WEBP<br>
                                                        ✔ Maximum size: 500KB per image
                                                    </div>
                                                    @error('subcategory_image')
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
