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
                        <form method="post" action="/verify">
                            @csrf
                            <fieldset>
                                <div class="field">
                                    <label class="label_field">OTP </label>
                                    <input type="text" class="form-control @error('otp') is-invalid @enderror"
                                        id="coupon-name" name="otp" placeholder="Enter The OTP" />
                                    @error('otp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="field margin_0">
                                    <button type="submit" class="main_bt">Submit</button>
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
