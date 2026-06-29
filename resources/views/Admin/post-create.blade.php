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
                        <h2>Posts</h2>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <form method="post"
                    action="{{ isset($data->post_id) ? url('/admin/posts/' . $data->post_id) : url('/admin/posts') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Product Data-->
                    <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="heading1 margin_0">
                                    <h2>Add Post </h2>
                                </div>
                            </div>
                            <div class="table_section padding_infor_info">
                                <div class="table-responsive-md">
                                    <div class="row ">
                                        <div class="col-md-6 p-2">
                                            <div class="form-group row">
                                                <label for="postname" class="col-sm-3 col-form-label">Post Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="post_name"
                                                        value="{{ old('post_name', $data->post_name ?? '') }}"
                                                        class="form-control @error('post_name') is-invalid @enderror"
                                                        id="postname" placeholder="Enter Post Name">
                                                    @error('post_name')
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
                                                    <select id="inputState" name="category_id"
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
                                        <div class="col-md-12 p-2">
                                            <div class="form-group row">
                                                <label for="shortdescription" class="col-sm-2 col-form-label">Short
                                                    Description
                                                </label>
                                                <div class="col-sm-9">
                                                    <div class="main-container">
                                                        <textarea rows="5" name="short_description" placeholder="Enter Post Short Description"
                                                            class="form-control @error('short_description') is-invalid @enderror">{{ old('short_description', $data->short_description ?? '') }}</textarea>
                                                        @error('short_description')
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
                                                <label for="description" class="col-sm-2 col-form-label">Description
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
                                        <div class="col-md-12 p-2">
                                            <div class="form-group row">
                                                <label for="subcatimage" class="col-sm-2 col-form-label">Sub
                                                    Category Image </label>
                                                <div class="col-sm-10">
                                                    <input
                                                        class="form-control @error('featured_image') is-invalid @enderror"
                                                        name="featured_image" type="file" id="subcatimage">
                                                    <div class="form-text text-muted mt-1">
                                                        ✔ Required resolution: 800 × 500 pixels<br>
                                                        ✔ Allowed formats: JPG, JPEG, PNG, WEBP<br>
                                                        ✔ Maximum size: 2MB per image
                                                    </div>
                                                    @error('featured_image')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-2">
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
                                    <h2>Post Meta Data </h2>
                                </div>
                            </div>
                            <div class="table_section padding_infor_info">
                                <div class="table-responsive-md">
                                    <div class="row ">
                                        <div class="col-md-12 p-2">
                                            <div class="form-group row">
                                                <label for="metatitle" class="col-sm-2 col-form-label">Meta Title </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="meta_title"
                                                        value="{{ old('meta_title', $metaData->meta_title ?? '') }}"
                                                        class="form-control @error('meta_title') is-invalid @enderror"
                                                        id="metatitle" placeholder="Enter Product Meta Title">
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
                                                <label for="metadescription" class="col-sm-2 col-form-label">Meta
                                                    Description</label>
                                                <div class="col-sm-9">
                                                    <div class="main-container">
                                                        <textarea rows="4" name="meta_description" class="form-control @error('meta_description') is-invalid @enderror"
                                                            placeholder="Enter The Meta Description">{{ old('meta_description', $metaData->meta_description ?? '') }}</textarea>
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
                                                <label for="metakeyword" class="col-sm-2 col-form-label">Keywords</label>
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
                </form>
            </div>

        </div>
    </div>
@endsection
