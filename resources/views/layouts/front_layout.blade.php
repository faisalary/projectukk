
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

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
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

<style>
    .box-icon {
        display: flex;
        align-items: center;
        align-content: center;
        text-align: center;
        height: 49px;
        width: 49px;
        border-radius: 50%;
    }

    .box-icon .material-symbols-outlined {
        width: 100%;
        color: white;
    }
    
    .text-primary {
        color: 'red';
    }

    .bg-primary {
        color: #fff !important;
    }

    .bg-primary, .label-primary {
        background-color: 'red';
    }

    .btn-primary {
        background-color: 'red';
        color: #fff !important;
    }
    #diseluruh {
            display: flex;
            padding: 24px;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            flex-shrink: 0;
            margin-top: 100px;
            margin-right: 20px;
            margin-left: 20px;
            border-radius: 39px;
            background: linear-gradient(180deg, rgba(254, 254, 254, 0.70) 0%, rgba(254, 254, 254, 0.10) 100%);
            box-shadow: 0px 0px 6.257999897003174px 0px #E8E8E8 inset, 0px 0px 14px 0px #E8E8E8 inset, 0px 0px 9px 0px #4EA971 inset;
            backdrop-filter: blur(1px);
        }
        #kemudahan {
            display: flex;
            padding: 24px;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            flex-shrink: 0;
            margin-top: 60px;
            margin-right: 20px;
            margin-left: 20px;
            border-radius: 39px;
            background: linear-gradient(180deg, rgba(254, 254, 254, 0.70) 0%, rgba(254, 254, 254, 0.10) 100%);
            box-shadow: 0px 0px 6.257999897003174px 0px #E8E8E8 inset, 0px 0px 14px 0px #E8E8E8 inset, 0px 0px 9px 0px #4EA971 inset;
            backdrop-filter: blur(1px);
        }
        #Blowongan {
            display: flex;
            padding: 24px;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            flex-shrink: 0;
            margin-top: 80px;
            margin-right: 20px;
            margin-left: 20px;
            border-radius: 39px;
            background: linear-gradient(180deg, rgba(254, 254, 254, 0.70) 0%, rgba(254, 254, 254, 0.10) 100%);
            box-shadow: 0px 0px 6.257999897003174px 0px #E8E8E8 inset, 0px 0px 14px 0px #E8E8E8 inset, 0px 0px 9px 0px #4EA971 inset;
            backdrop-filter: blur(1px);
        }
        #Bperusahaan {
            display: flex;
            padding: 24px;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            flex-shrink: 0;
            margin-top: 40px;
            margin-right: 20px;
            margin-left: 20px;
            border-radius: 39px;
            background: linear-gradient(180deg, rgba(254, 254, 254, 0.70) 0%, rgba(254, 254, 254, 0.10) 100%);
            box-shadow: 0px 0px 6.257999897003174px 0px #E8E8E8 inset, 0px 0px 14px 0px #E8E8E8 inset, 0px 0px 9px 0px #4EA971 inset;
            backdrop-filter: blur(1px);
        }
        .row {
            display: flex;
            justify-content: center;
        }
        
        .card {
            max-width: 15rem;
            height: 201px;
        }
</style>
</head>

<body data-anm=".anm">

<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>
    
    <!-- Main Header-->
    @include('layouts.front_header')
    <!--End Main Header -->

    @yield('content-main')

    
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


