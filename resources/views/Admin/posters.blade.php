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

                <!-- table section -->
                <div class="col-md-12">
                    <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <a type="button" href="/admin/posters/create" class="btn btn-primary m-2 link-btn">Add
                                    New</a>
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Poster Img</th>
                                            <th>Poster Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($paginatedData as $poster)
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <img style="width: 50pz; height: 50px;"
                                                        src="{{ $poster->poster_image
                                                            ? asset('Posters/' . $poster->poster_image)
                                                            : 'https://img.freepik.com/free-vector/door-handle-key-set_1284-20884.jpg' }}" />
                                                </td>
                                                <td> {{ $poster->poster_name }} </td>
                                                <td>
                                                    <a href="{{ url('/admin/posters/' . $poster->poster_id . '/edit') }}"
                                                        class="btn btn-warning text-dark">
                                                        Edit
                                                    </a>
                                                    <form action="{{ url('/admin/posters/' . $poster->poster_id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class=" btn btn-danger text-light">delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No Poster found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{ $paginatedData->links('Admin.Pagination.custom') }}

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- footer -->
    </div>
@endsection
