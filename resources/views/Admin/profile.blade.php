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

    {{-- Exception / Validation Error --}}
    @if (session('error'))
        <div class="alert alert-danger auto-hide">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success auto-hide">
            {{ session('success') }}
        </div>
    @endif

    <div class="midde_cont">
        <div class="container-fluid">
            <div class="row column_title">
                <div class="col-md-12">
                    <div class="page_title">
                        <h2>Profile</h2>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row column1">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2>User profile</h2>
                            </div>
                        </div>
                        <div class="full price_table padding_infor_info">
                            <div class="row">
                                <!-- user profile section -->
                                <!-- profile image -->
                                <div class="col-lg-12">
                                    <div class="full dis_flex center_text">
                                        @php
                                            $colors = [
                                                ['bg-primary', 'text-white'],
                                                ['bg-success', 'text-white'],
                                                ['bg-danger', 'text-white'],
                                                ['bg-dark', 'text-white'],
                                                ['bg-info', 'text-dark'],
                                                ['bg-warning', 'text-dark'],
                                            ];

                                            $color = $colors[array_rand($colors)];

                                            $bg = $color[0];
                                            $text = $color[1];

                                            $firstName = $data->first_name ?? '';
                                            $lastName = $data->last_name ?? '';

                                            $initials = strtoupper(substr($firstName, 0, 1));

                                            if (!empty($lastName)) {
                                                $initials .= strtoupper(substr($lastName, 0, 1));
                                            }
                                        @endphp

                                        <div class="rounded-circle d-inline-flex justify-content-center align-items-center {{ $bg }} {{ $text }}"
                                            style="width:90px; height:90px; font-size:30px; font-weight:bold;">
                                            {{ $initials }}
                                        </div>

                                        <div class="profile_contant">
                                            <div class="contact_inner">
                                                <h3> {{ $data->first_name . ' ' . $data->last_name }} </h3>
                                                <ul class="list-unstyled">
                                                    <li><i class="fa fa-envelope-o"></i> : {{ $data->email }} </li>
                                                    <li><i class="fa fa-phone"></i> : {{ $data->mobile_number }} </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- profile contant section -->
                                    <div class="full inner_elements margin_top_30">
                                        <div class="tab_style2">
                                            <div class="tabbar">
                                                <nav>
                                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                        <a class="nav-item nav-link active" id="nav-info-tab"
                                                            data-toggle="tab" href="#recent_activity" role="tab"
                                                            aria-selected="true">Information </a>
                                                        <a class="nav-item nav-link" id="nav-security-tab" data-toggle="tab"
                                                            href="#project_worked" role="tab"
                                                            aria-selected="false">Security</a>
                                                    </div>
                                                </nav>
                                                <div class="tab-content" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="recent_activity"
                                                        role="tabpanel" aria-labelledby="nav-info-tab">
                                                        <div class="msg_list_main">
                                                            <form method="post" action="/admin/update">
                                                                @csrf
                                                                <div class="row ">
                                                                    <div class="col-md-12 p-2">
                                                                        <div class="form-group row">
                                                                            <label for="name"
                                                                                class="col-sm-3 col-form-label"> First Name
                                                                            </label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="first_name"
                                                                                    value="{{ $data->first_name }}"
                                                                                    class="form-control " id="name"
                                                                                    placeholder="Enter First Name">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 p-2">
                                                                        <div class="form-group row">
                                                                            <label for="name"
                                                                                class="col-sm-3 col-form-label"> Last Name
                                                                            </label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="last_name"
                                                                                    value="{{ $data->last_name }}"
                                                                                    class="form-control " id="name"
                                                                                    placeholder="Enter Last Name">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 p-2">
                                                                        <div class="form-group row">
                                                                            <label for="email"
                                                                                class="col-sm-3 col-form-label"> Email
                                                                            </label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="email"
                                                                                    value="{{ $data->email }}"
                                                                                    class="form-control " id="email"
                                                                                    placeholder="Enter E-mail Address">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 p-2">
                                                                        <div class="form-group row">
                                                                            <label for="mobile"
                                                                                class="col-sm-3 col-form-label"> Mobile
                                                                                Number </label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="mobile_number"
                                                                                    value="{{ $data->mobile_number }}"
                                                                                    class="form-control " id="mobile"
                                                                                    placeholder="Enter Mobile Number">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 p-2">
                                                                        <div class=" d-flex justify-content-end">
                                                                            <button
                                                                                class="btn btn-primary btn-lg submit-btn"
                                                                                type="submit">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="project_worked" role="tabpanel"
                                                        aria-labelledby="nav-security-tab">
                                                        <form method="post" action="/admin/updatePassword">
                                                            @csrf
                                                            <div class="row ">
                                                                <div class="col-md-12 p-2">
                                                                    <div class="form-group row">
                                                                        <label for="password"
                                                                            class="col-sm-3 col-form-label">
                                                                            Password
                                                                        </label>
                                                                        <div class="col-sm-9">
                                                                            <input type="password" name="password"
                                                                                class="form-control " id="password"
                                                                                placeholder="Enter Password ">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 p-2">
                                                                    <div class="form-group row">
                                                                        <label for="conformpassword"
                                                                            class="col-sm-3 col-form-label"> Conform
                                                                            Password
                                                                        </label>
                                                                        <div class="col-sm-9">
                                                                            <input type="password" name="passwordConform"
                                                                                class="form-control " id="conformpassword"
                                                                                placeholder="Conform Password ">
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
                                    <!-- end user profile section -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <!-- end row -->
            </div>
            <!-- footer -->
        </div>
        <!-- end dashboard inner -->
    </div>
@endsection
