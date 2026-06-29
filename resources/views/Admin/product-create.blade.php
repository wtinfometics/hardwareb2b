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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- site css -->
    <link rel="stylesheet" href="{{ asset('admin/style.css') }}" />

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
            <form method="post"
                action="{{ isset($data->product_id) ? url('/admin/products/' . $data->product_id) : url('/admin/products') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <!-- Product Data-->
                    <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="heading1 margin_0">
                                    <h2>Product Data </h2>
                                </div>
                            </div>
                            <div class="table_section padding_infor_info">
                                <div class="table-responsive-md">
                                    <div class="row ">
                                        <div class="col-md-12 p-2">
                                            <div class="form-group row">
                                                <label for="product-name" class="col-sm-2 col-form-label">Product
                                                    Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="product_name"
                                                        value="{{ old('product_name', $data->product_name ?? '') }}"
                                                        class="form-control @error('product_name') is-invalid @enderror"
                                                        id="product-name" placeholder="Enter Product Name">
                                                    @error('product_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="brand">Brand</label>
                                                <div class="col-sm-8">
                                                    <select id="brand" name="brand_id"
                                                        value="{{ old('brand_id', $data->brand_id ?? '') }}"
                                                        class="form-control @error('brand_id') is-invalid @enderror">
                                                        <option value="" selected> Select The Brand</option>
                                                        @forelse($brands as $brand)
                                                            <option value="{{ $brand->brand_id }}"
                                                                {{ isset($data) && $data->brand_id == $brand->brand_id ? 'selected' : '' }}>
                                                                {{ $brand->brand_name }}
                                                            </option>
                                                        @empty
                                                            <option> No Brands Exists </option>
                                                        @endforelse
                                                    </select>
                                                    @error('brand_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="category">Category</label>
                                                <div class="col-sm-8">
                                                    <select id="category" name="category_id"
                                                        value="{{ old('category_id', $data->category_id ?? '') }}"
                                                        class="form-control @error('category_id') is-invalid @enderror">
                                                        <option value="" selected> Select The Category</option>
                                                        @forelse($categories as $category)
                                                            <option value="{{ $category->category_id }}"
                                                                {{ isset($data) && $data->category_id == $category->category_id ? 'selected' : '' }}>
                                                                {{ $category->category_name }}
                                                            </option>
                                                        @empty
                                                            <option> No Category Exists </option>
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
                                                <label class="col-sm-4 col-form-label" for="category"> Sub Category</label>
                                                <div class="col-sm-8">
                                                    <select id="category" name="subcategory_id"
                                                        value="{{ old('subcategory_id', $data->subcategory_id ?? '') }}"
                                                        class="form-control @error('subcategory_id') is-invalid @enderror">
                                                        <option value="" selected> Select The Sub Category</option>
                                                        @forelse($subcategories as $subcategory)
                                                            <option value="{{ $subcategory->subcategory_id }}"
                                                                {{ isset($data) && $data->subcategory_id == $subcategory->subcategory_id ? 'selected' : '' }}>
                                                                {{ $subcategory->subcategory_name }}
                                                            </option>
                                                        @empty
                                                            <option> No Sub Category Exists </option>
                                                        @endforelse
                                                    </select>
                                                    @error('subcategory_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="min-order" class="col-sm-4 col-form-label">Minimum Orders
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="Number" name="min_order"
                                                        value="{{ old('min_order', $data->min_order ?? '') }}"
                                                        class="form-control @error('min_order') is-invalid @enderror"
                                                        id="min-order" placeholder="Enter Minimum Number of Order ">
                                                    @error('min_order')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">

                                                <label for="promoted" class="col-sm-4 col-form-label">
                                                    Promoted
                                                </label>

                                                <div class="col-sm-8">

                                                    {{-- Yes --}}
                                                    <input type="radio" name="promoted"
                                                        class="btn-check @error('promoted') is-invalid @enderror"
                                                        id="Promoted-yes" value="1" autocomplete="off"
                                                        {{ old('promoted', $data->promoted ?? '') == 1 ? 'checked' : '' }}>

                                                    <label class="btn btn-outline-success" for="Promoted-yes">
                                                        Yes
                                                    </label>

                                                    {{-- No --}}
                                                    <input type="radio" name="promoted"
                                                        class="btn-check @error('promoted') is-invalid @enderror"
                                                        id="Promoted-no" value="0" autocomplete="off"
                                                        {{ old('promoted', $data->promoted ?? '') == 0 ? 'checked' : '' }}>

                                                    <label class="btn btn-outline-danger" for="Promoted-no">
                                                        No
                                                    </label>

                                                    {{-- Error Message --}}
                                                    @error('promoted')
                                                        <div class="text-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="Featured" class="col-sm-4 col-form-label">Featured</label>
                                                <div class="col-sm-8">
                                                    <input type="radio" name="featured"
                                                        class="btn-check @error('featured') is-invalid @enderror"
                                                        id="Featured-yes" value="1" autocomplete="off"
                                                        {{ old('featured', $data->featured ?? '') == 1 ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-success" for="Featured-yes">Yes</label>

                                                    <input type="radio" name="featured"
                                                        class="btn-check @error('featured') is-invalid @enderror"
                                                        id="Featured-no" value="0" autocomplete="off"
                                                        {{ old('featured', $data->featured ?? '') == 0 ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-danger" for="Featured-no">No</label>
                                                </div>
                                                @error('featured')
                                                    <div class="text-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-2">
                                            <div class="form-group row">
                                                <label for="description" class="col-sm-2 col-form-label">Description
                                                </label>
                                                <div class="col-sm-9">
                                                    <div class="main-container">
                                                        <textarea id="editor" name="description" class="form-control w-100">{{ old('description', $data->description ?? '') }}</textarea>
                                                        @error('description')
                                                            <div class="text-danger mt-2">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-2">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label" for="category"> Status</label>
                                                <div class="col-sm-10">
                                                    <select id="category" name="status"
                                                        value="{{ old('status', $data->status ?? '') }}"
                                                        class="form-control @error('status') is-invalid @enderror">
                                                        <option value=""
                                                         > Select status</option>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Meta Data  -->
                    <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="heading1 margin_0">
                                    <h2>Product Meta Data </h2>
                                </div>
                            </div>
                            <div class="table_section padding_infor_info">
                                <div class="table-responsive-md">
                                    <div class="row ">
                                        <div class="col-md-12 p-2">
                                            <div class="form-group row">
                                                <label for="meta-title" class="col-sm-2 col-form-label">Meta Title
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="meta_title"
                                                        value="{{ old('meta_title', $metaData->meta_title ?? '') }}"
                                                        class="form-control @error('meta_title') is-invalid @enderror"
                                                        id="meta-title" placeholder="Enter Product Meta Title">
                                                    @error('meta_title')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-2">
                                            <div class="form-group row">
                                                <label for="meta-description" class="col-sm-2 col-form-label">Meta
                                                    Description</label>
                                                <div class="col-sm-9">
                                                    <div class="main-container">
                                                        <textarea rows="4" name="meta_description"
                                                            class="form-control @error('meta_description') is-invalid @enderror" placeholder="Enter The Meta Description">{{ old('meta_description', $metaData->meta_description ?? '') }}</textarea>
                                                        @error('meta_description')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-2">
                                            <div class="form-group row">
                                                <label for="meta-keyword" class="col-sm-2 col-form-label">Keywords</label>
                                                <div class="col-sm-9">
                                                    <div class="main-container">
                                                        <textarea rows="4" name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror"
                                                            placeholder="Enter The Keywords">{{ old('meta_keywords', $metaData->meta_keywords ?? '') }}</textarea>
                                                        @error('meta_keywords')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
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
                </div>
            </form>

        </div>
    </div>
@endsection
