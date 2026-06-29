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
                <form method="post"
                    action="{{ isset($productVariationData->product_variation_id) ? url('/admin/products/' . $product_id . '/variations/' . $productVariationData->product_variation_id) : url('/admin/products/' . $product_id . '/variations') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Product Data-->
                    <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="heading1 margin_0">
                                    <h2>Product Variation </h2>
                                </div>
                            </div>
                            <div class="table_section padding_infor_info">
                                <div class="table-responsive-md">
                                    <div class="row ">
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="variation-name" class="col-sm-3 col-form-label">Variation Name
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="variation_name" id="variation-name"
                                                        placeholder="Enter Variation Name"
                                                        value="{{ old('variation_name', $productVariationData->variation_name ?? '') }}"
                                                        class="form-control @error('variation_name') is-invalid @enderror">

                                                    @error('variation_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}

                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="variation-name" class="col-sm-3 col-form-label">Stock
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="stock" id="variation-name"
                                                        placeholder="Enter Number of Stocks "
                                                        value="{{ old('stock', $productVariationData->stock ?? '') }}"
                                                        class="form-control @error('stock') is-invalid @enderror">

                                                    @error('stock')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-2">
                                            <div class="form-group row">
                                                <label for="meta-description" class="col-md-2 col-form-label">Description</label>
                                                <div class="col-md-10">
                                                    <div class="main-container">
                                                        <textarea id="editor" rows="4" name="short_description"
                                                            class="form-control @error('short_description') is-invalid @enderror" placeholder="Enter The Description">{{ old('short_description', $productVariationData->short_description ?? '') }}</textarea>
                                                        @error('short_description')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @forelse($attributesData as $key => $attribute)
                                            @php

                                                // Default empty
                                                $selectedVariationId = '';

                                                // For Edit Mode
                                                if (isset($productVariationAttributeData)) {
                                                    $attributeData = collect(
                                                        $productVariationAttributeData,
                                                    )->firstWhere('attribute_id', $attribute->attribute_id);

                                                    $selectedVariationId =
                                                        $attributeData['attribute_variation_id'] ?? '';
                                                }

                                            @endphp

                                            <div class="col-md-6 p-2">

                                                <div class="form-group row">

                                                    {{-- Attribute Label --}}
                                                    <label class="col-sm-3 col-form-label">
                                                        {{ $attribute->attribute_name }}
                                                    </label>

                                                    {{-- Hidden Attribute ID --}}
                                                    <input type="hidden"
                                                        name="attributes[{{ $key }}][attribute_id]"
                                                        value="{{ $attribute->attribute_id }}">

                                                    <div class="col-sm-9">

                                                        {{-- Variation Select --}}
                                                        <select
                                                            name="attributes[{{ $key }}][attribute_variation_id]"
                                                            class="form-control @error('attributes.' . $key . '.attribute_variation_id') is-invalid @enderror">

                                                            <option value="">Select Option</option>

                                                            @foreach ($attribute->attributevariations as $variation)
                                                                <option value="{{ $variation->attribute_variation_id }}"
                                                                    {{ old('attributes.' . $key . '.attribute_variation_id', $selectedVariationId) ==
                                                                    $variation->attribute_variation_id
                                                                        ? 'selected'
                                                                        : '' }}>
                                                                    {{ $variation->attribute_variation_name }}
                                                                </option>
                                                            @endforeach

                                                        </select>

                                                        {{-- Error Message --}}
                                                        @error('attributes.' . $key . '.attribute_variation_id')
                                                            <span class="text-danger">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror

                                                    </div>

                                                </div>

                                            </div>

                                        @empty

                                            <div class="text-center">
                                                No attributes found
                                            </div>
                                        @endforelse
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="variation-name" class="col-sm-3 col-form-label">Price
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="price" id="variation-name"
                                                        placeholder="Enter Price"
                                                        value="{{ old('price', $productVariationData->price ?? '') }}"
                                                        class="form-control @error('price') is-invalid @enderror">

                                                    @error('price')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="variation-name" class="col-sm-3 col-form-label">Discounted Price
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="discount_price" id="variation-name"
                                                        placeholder="Enter Discounted Price "
                                                        value="{{ old('discount_price', $productVariationData->discount_price ?? '') }}"
                                                        class="form-control @error('discount_price') is-invalid @enderror">

                                                    @error('discount_price')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="product-image" class="col-sm-3 col-form-label">Product Images
                                                </label>
                                                <div class="col-sm-9">
                                                    <input multiple
                                                        placeholder="Each product image must be exactly 500x400 pixels."
                                                        class="form-control @error('product_image.*') is-invalid @enderror"
                                                        name="product_image[]" type="file" id="product-image">
                                                    <div class="form-text text-muted mt-1">
                                                        ✔ Required resolution: 500 × 400 pixels<br>
                                                        ✔ Allowed formats: JPG, JPEG, PNG, WEBP<br>
                                                        ✔ Maximum size: 2MB per image
                                                    </div>
                                                    @if ($errors->has('product_image.*'))
                                                        <div class="invalid-feedback d-block">
                                                            @foreach ($errors->get('product_image.*') as $messages)
                                                                @foreach ($messages as $message)
                                                                    {{ $message }} <br>
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    @endif

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

                <!-- Product Meta Data  -->
                <div class="col-md-12">
                    <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2>Product Variation Images </h2>
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Category Img</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($productVariationImagesData) && count($productVariationImagesData) > 0)
                                        @forelse($productVariationImagesData as $productVariationImages)
                                            <tr>

                                                <td>{{ $loop->iteration }}</td>

                                                <td>
                                                    <img style="width: 50px; height: 50px;"
                                                        src="{{ $productVariationImages->product_variation_image_name
                                                            ? asset('Products/' . $productVariationImages->product_variation_image_name)
                                                            : 'https://img.freepik.com/free-vector/door-handle-key-set_1284-20884.jpg' }}" />
                                                </td>

                                                <td>

                                                    <form
                                                        action="{{ url('/admin/products/' . $product_id . '/variations/' . $product_variation_id . '/image/' . $productVariationImages->product_variation_image_id) }}"
                                                        method="POST" style="display:inline;">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger text-light">
                                                            Delete
                                                        </button>

                                                    </form>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="3" class="text-center">
                                                    No images found
                                                </td>
                                            </tr>
                                        @endforelse
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                No images found
                                            </td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
