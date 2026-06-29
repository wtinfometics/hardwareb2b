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
    
    <!-- site icon -->
    <link rel="icon" href="{{ asset('admin/images/fevicon.png') }}" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}" />
    <!-- site css -->
    <link rel="stylesheet" href="{{ asset('admin/style.css') }}" />
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('admin/css/responsive.css') }}" />
    <!-- color css -->
    <link rel="stylesheet" href="{{ asset('admin/css/colors.css') }}" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="css/bootstrap-select.css')}}" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="{{ asset('admin/css/perfect-scrollbar.css') }}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

    <!-- CK Editor CDN -->
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/47.5.0/ckeditor5.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="dashboard dashboard_1">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            @include('Admin.Components.sidebar')
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                @include('Admin.Components.topbar')
                <!-- end topbar -->
                <!-- dashboard inner -->
                @yield('content')
                <!-- end dashboard inner -->
            </div>
        </div>
        @include('Admin.Components.footer')
    </div>
    <!-- jQuery -->
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <!-- wow animation -->
    <script src="{{ asset('admin/js/animate.js') }}"></script>
    <!-- select country -->
    <script src="{{ asset('admin/js/bootstrap-select.js') }}"></script>
    <!-- owl carousel -->
    <script src="{{ asset('admin/js/owl.carousel.js') }}"></script>
    <!-- chart js -->
    <script src="{{ asset('admin/js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/utils.js') }}"></script>
    <script src="{{ asset('admin/js/analyser.js') }}"></script>
    <!-- nice scrollbar -->
    <script src="{{ asset('admin/js/perfect-scrollbar.min.js') }}"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
    <!-- custom js -->
    <script src="{{ asset('admin/js/custom.js') }}"></script>
    <script src="{{ asset('admin/js/chart_custom_style1.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor', {
            width: '100%',
            height: 200
        });
    </script>

    <script>
        setTimeout(() => {
            document.querySelectorAll('.auto-hide').forEach(el => {
                el.style.transition = "opacity 0.5s";
                el.style.opacity = "0";
                setTimeout(() => el.remove(), 500);
            });
        }, 3000);
    </script>
</body>

</html>
