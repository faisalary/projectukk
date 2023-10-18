<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- Stylesheets -->
    <link href="{{ asset('front/assets/landing/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('front/assets/landing/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('front/assets/landing/css/responsive.css')}}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('front/assets/landing/images/favicon.png')}}" type="image/x-icon">
    <link rel="icon" href="{{ asset('front/assets/landing/images/favicon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">


    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body data-anm=".anm">
    <div class="page-wrapper">

        <!-- Preloader -->
        <div class="preloader"></div>

        <!-- Main Header-->
        @include('layouts.front_header')
        <!--End Main Header -->

        @include('saved-jobs.content_page')


        <!-- Main Footer -->
        @include('layouts.front_footer')
        <!-- End Main Footer -->




    </div><!-- End Page Wrapper -->


    <script src="{{ asset('front/assets/landing/js/jquery.js') }}"></script>
    <script src="{{ asset('front/assets/landing/js/popper.min.js') }}"></script>
    <script src="{{ asset('front/assets/landing/js/chosen.min.js') }}"></script>
    <script src="{{ asset('front/assets/landing/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/assets/landing/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('front/assets/landing/js/jquery.modal.min.js') }}"></script>
    <script src="{{ asset('front/assets/landing/js/mmenu.polyfills.js') }}"></script>
    <script src="{{ asset('front/assets/landing/js/mmenu.js') }}"></script>
    <script src="{{ asset('front/assets/landing/js/appear.js') }}"></script>
    <script src="{{ asset('front/assets/landing/js/anm.min.js') }}"></script>
    <script src="{{ asset('front/assets/landing/js/owl.js') }}"></script>
    <script src="{{ asset('front/assets/landing/js/wow.js') }}"></script>
    <script src="{{ asset('front/assets/landing/js/script.js') }}"></script>
    <script src="{{ asset('assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>
    <script src="{{ asset('froiden-helper/helper.js') }}"></script>
    <script src="{{ asset('front/assets/landing/js/map-script.js') }}"></script>

    <!--Google Map APi Key-->
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyDaaCBm4FEmgKs5cfVrh3JYue3Chj1kJMw&#038;ver=5.2.4"></script>
    @stack('footer-script')

</body>

</html>