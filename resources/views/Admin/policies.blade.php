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

                <!-- table section -->
                <div class="col-md-12">
                    <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <a type="button" href="/admin/policies/create" class="btn btn-primary m-2 link-btn">Add
                                    New</a>
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Policy Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($paginatedData as $policy)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td> {{ $policy->policy_name }} </td>
                                                <td>
                                                    <a href="{{ url('/admin/policies/' . $policy->policy_id . '/edit') }}"
                                                        class="btn btn-warning text-dark">
                                                        Edit
                                                    </a>
                                                    <form action="{{ url('/admin/policies/' . $policy->policy_id) }}"
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
                                                <td colspan="3" class="text-center">No policies found</td>
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
