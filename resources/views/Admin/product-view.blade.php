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

                <!-- table section -->
                <div class="col-md-12">
                    <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2> Product Details</h2>
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-sm">
                                <!-- tab style 2 -->
                                <div class="white_shd full margin_bottom_30">

                                    <div class="full inner_elements">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="tab_style2">
                                                    <div class="tabbar padding_infor_info">
                                                        <nav>
                                                            <div class="nav nav-tabs" id="nav-tab1" role="tablist">
                                                                <a class="nav-item nav-link active" id="nav-home-tab2"
                                                                    data-toggle="tab" href="#nav-home_s2" role="tab"
                                                                    aria-controls="nav-home_s2"
                                                                    aria-selected="true">Details</a>
                                                                <a class="nav-item nav-link" id="nav-profile-tab2"
                                                                    data-toggle="tab" href="#nav-profile_s2" role="tab"
                                                                    aria-controls="nav-profile_s2"
                                                                    aria-selected="false">Variation</a>
                                                                <!-- <a class="nav-item nav-link"
                                                                                            id="nav-contact-tab2" data-toggle="tab"
                                                                                            href="#nav-contact_s2" role="tab"
                                                                                            aria-controls="nav-contacts_s2"
                                                                                            aria-selected="false">Contact</a> -->
                                                            </div>
                                                        </nav>
                                                        <div class="tab-content" id="nav-tabContent_2">
                                                            <div class="tab-pane fade show active" id="nav-home_s2"
                                                                role="tabpanel" aria-labelledby="nav-home-tab">
                                                                <table class="table table-bordered border-primary">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>Product Name</th>
                                                                            <td> {{ $data->product_name }} </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Category </th>
                                                                            <td>{{ $data->category->category_name }} </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Sub Category </th>
                                                                            <td>{{ $data->subcategory->subcategory_name }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Brand </th>
                                                                            <td>{{ $data->brand->brand_name }} </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Minimum orders</th>
                                                                            <td>{{ $data->min_order }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Featured </th>
                                                                            <td>{!! $data->featured == 1
                                                                                ? '<span class="badge badge-pill badge-success">Yes</span>'
                                                                                : '<span class="badge badge-pill badge-danger">No</span>' !!}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Promoted </th>
                                                                            <td>
                                                                                {!! $data->promoted == 1
                                                                                    ? '<span class="badge badge-pill badge-success">Yes</span>'
                                                                                    : '<span class="badge badge-pill badge-danger">No</span>' !!}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Product Status</th>
                                                                            <td>
                                                                                {!! $data->status == 1
                                                                                    ? '<span class="badge badge-pill badge-success">Yes</span>'
                                                                                    : '<span class="badge badge-pill badge-danger">No</span>' !!}
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-profile_s2" role="tabpanel"
                                                                aria-labelledby="nav-profile-tab">
                                                                <div class="heading1 margin_0">
                                                                    <a type="button"
                                                                        href="{{ '/admin/products/' . $product_id . '/variations/create' }}"
                                                                        class="btn btn-primary m-2 link-btn">Add New</a>
                                                                </div>
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Sl No</th>
                                                                            <th>SKU</th>
                                                                            <th>Variation Name </th>
                                                                            <th>stocks</th>
                                                                            <th>price</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @forelse($paginatedData as $pv)
                                                                            <tr>
                                                                                <td>{{ $loop->iteration }}</td>
                                                                                <td> {{ $pv->sku }} </td>
                                                                                <td>{{ $pv->variation_name }}</td>
                                                                                <td>
                                                                                    <p class="text-dark">
                                                                                        {{ $pv->stock }}</p>
                                                                                </td>
                                                                                <td>{{ $pv->price }}</td>
                                                                                <td>
                                                                                    <a type="button"
                                                                                        href="{{ url('/admin/products/' . $product_id . '/variations/' . $pv->product_variation_id . '/edit') }}"
                                                                                        class=" btn btn-warning text-dark">Edit</a>
                                                                                    <form
                                                                                        action="{{ url('/admin/products/' . $product_id . '/variations/' . $pv->product_variation_id) }}"
                                                                                        method="POST"
                                                                                        style="display:inline;">
                                                                                        @csrf
                                                                                        @method('DELETE')

                                                                                        <button type="submit"
                                                                                            class=" btn btn-danger text-light">delete</button>
                                                                                    </form>
                                                                                </td>
                                                                            </tr>
                                                                        @empty
                                                                            <tr>
                                                                                <td colspan="6" class="text-center">No Product Variation found</td>
                                                                            </tr>
                                                                        @endforelse
                                                                    </tbody>
                                                                </table>
                                                                {{ $paginatedData->links('Admin.Pagination.custom') }}
                                                            </div>
                                                            <!-- <div class="tab-pane fade" id="nav-contact_s2"
                                                                                        role="tabpanel"
                                                                                        aria-labelledby="nav-contact-tab">
                                                                                        <p>Sed ut perspiciatis unde omnis iste
                                                                                            natus error sit voluptatem
                                                                                            accusantium doloremque laudantium,
                                                                                            totam rem aperiam, eaque ipsa quae
                                                                                            ab illo inventore veritatis et
                                                                                            quasi architecto beatae vitae dicta
                                                                                            sunt explicabo. Nemo enim ipsam
                                                                                            voluptatem quia voluptas sit
                                                                                            aspernatur aut odit aut fugit, sed
                                                                                            quia consequuntur magni dolores eos
                                                                                            qui ratione voluptatem sequi
                                                                                            nesciunt.
                                                                                        </p>
                                                                                    </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- footer -->
    </div>
@endsection
