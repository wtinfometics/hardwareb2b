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
                        <h2>Contacts</h2>
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
                                <h2> Contact Message </h2>
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-sm">
                                <table class="table table-bordered border-primary">
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td> {{ $data->first_name . ' ' . $data->last_name }} </td>
                                        </tr>
                                        <tr>
                                            <th>Phone Number </th>
                                            <td>{{ $data->phone }} </td>
                                        </tr>
                                        <tr>
                                            <th>E-Mail Address </th>
                                            <td>{{ $data->email }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Subject </th>
                                            <td>{{ $data->subject }} </td>
                                        </tr>
                                        <tr>
                                            <th>Message </th>
                                            <td>{{ $data->message }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- footer -->
    </div>
@endsection
