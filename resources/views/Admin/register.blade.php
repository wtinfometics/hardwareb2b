<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="{asset('admin/images/fevicon.png')}}" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}" />
    <!-- site css -->
    <link rel="stylesheet" href="{{ asset('admin/style.css') }}" />
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('admin/css/responsive.css') }}" />
    <!-- color css -->
    <link rel="stylesheet" href="{{ asset('admin/css/colors.css') }}" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap-select.css') }}" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="{{ asset('admin/css/perfect-scrollbar.css') }}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}" />
    <!-- calendar file css -->
    <link rel="stylesheet" href="{{ asset('admin/js/semantic.min.css') }}" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="inner_page login">
    <div class="full_container">
        <div class="container">
            <div class="center verticle_center full_height">
                <div class="login_section">
                    <div class="logo_login">
                        <div class="center">
                        </div>
                    </div>
                    <div class="login_form">
                        <form method="post" action="/register">
                            @csrf
                            <fieldset>
                                <div class="field">
                                    <label class="label_field">First Name </label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                        id="coupon-name" name="first_name" placeholder="Enter First name" />
                                    @error('first_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label class="label_field">Last Name </label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                        id="coupon-name" name="last_name" placeholder="Enter Last name" />
                                    @error('last_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label class="label_field">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="coupon-name" name="email" placeholder="Enter E-mail Address" />
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label class="label_field">Mobile Number</label>
                                    <input type="number"
                                        class="form-control @error('mobile_number') is-invalid @enderror"
                                        id="coupon-name" name="mobile_number" placeholder="Enter Mobile Number" />
                                    @error('mobile_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label class="label_field">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="coupon-name" name="password" placeholder="Enter The Password" />
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label class="label_field"> Conform Password</label>
                                    <input type="password"
                                        class="form-control @error('passwordConform') is-invalid @enderror"
                                        id="coupon-name" name="passwordConform" placeholder="Conform Password" />
                                    @error('passwordConform')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="field">
                                    <a class="forgot btn btn-outline-success " href="login.html">LogIn </a>
                                </div>
                                <div class="field margin_0">
                                    <button class="main_bt" type="submit">Sing In</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <!-- wow animation -->
    <script src="{{ asset('admin/js/animate.js') }}"></script>
    <!-- select country -->
    <script src="{{ asset('admin/js/bootstrap-select.js') }}"></script>
    <!-- nice scrollbar -->
    <script src="{{ asset('admin/js/perfect-scrollbar.min.js') }}"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
    <!-- custom js -->
    <script src="{{ asset('admin/js/js/custom.js') }}"></script>
</body>

</html>
