<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>{{$companyName}}</title>

<!-- Stylesheets -->
<link href="{{ url('front/assets/landing/css/bootstrap.css')}}" rel="stylesheet">
<link href="{{ url('front/assets/landing/css/style.css')}}" rel="stylesheet">
<link href="{{ url('front/assets/landing/css/responsive.css')}}" rel="stylesheet">
<link href="{{ asset('froiden-helper/helper.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('assets/node_modules/toast-master/css/jquery.toast.css') }}" rel="stylesheet"> --}}

    {{-- <link href="{{ asset('front/assets/css/core.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('front/assets/css/thesaas.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('front/assets/css/style.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('front/assets/css/custom.css') }}" rel="stylesheet"> --}}


<link rel="shortcut icon" href="{{ asset('front/assets/landing/images/favicon.png')}}" type="image/x-icon">
<link rel="icon" href="{{ asset('front/assets/landing/images/favicon.png')}}" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="">
<meta name="keywords" content="">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>
<div class="page-wrapper">

<!-- Topbar -->
{{-- <nav class="topbar topbar-inverse topbar-expand-md">
    <div class="container">

        <div class="topbar-left">


        </div>


    </div>
</nav> --}}
<!-- END Topbar -->



<!-- Header -->
<header class="main-header header-style-three">
    <div class="auto-container">
        <!-- Main box -->
        <div class="main-box">
            <!--Nav Outer -->
            <div class="nav-outer">
                <div class="logo-box">
                    <div class="logo"><a href="{{ url('/') }}"><img src="{{ $global->logo_url }}" alt="" title="" width="154px" height="50px"></a></div>
                </div>

                <nav class="nav main-menu">
                    <ul class="navigation" id="navbar">
                        {{-- <li class="current dropdown">
                            <span>Home</span>
                            <ul>
                                <li><a href="index.html">Home Page 01</a></li>
                                <li><a href="index-2.html">Home Page 02</a></li>
                                <li><a href="index-3.html">Home Page 03</a></li>
                                <li class="current"><a href="index-4.html">Home Page 04</a></li>
                                <li><a href="index-5.html">Home Page 05</a></li>
                                <li><a href="index-6.html">Home Page 06</a></li>
                                <li><a href="index-7.html">Home Page 07</a></li>
                                <li><a href="index-8.html">Home Page 08</a></li>
                                <li><a href="index-9.html">Home Page 09</a></li>
                                <li><a href="index-10.html">Home Page 10</a></li>
                            </ul>
                        </li> --}}
                    </ul>     
                </nav>
                <!-- Main Menu End-->
            </div>

            <div class="outer-box">
                <!-- Login/Register -->

            </div>
        </div>
    </div>
</header>
<!-- END Header -->




<!-- Main container -->
<main class="main-content">
    <section class="page-title style-two">
        <div class="auto-container">
            <div class="title-outer">
                <h1>Job Offering</h1>
                <ul class="page-breadcrumb">
                    <li><small class="offer-by">@lang('app.by')</small></li>
                    <li>@if($job->company->show_in_frontend == 'true')
                        <small class="company-title"> {{ ucwords($job->company->company_name) }}</small>
                    @endif</li>
                    
                </ul> 
            </div>
        </div>
    </section>
    @yield('content')

</main>
<!-- END Main container -->






<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="row gap-y align-items-center">
            <div class="col-12 col-lg-3">
                &copy; {{ \Carbon\Carbon::today()->year }} @lang('app.by') {{ $companyName }}

            </div>
        </div>
    </div>
</footer>
<!-- END Footer -->
</div>


<!-- Scripts -->
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
<script src="{{ asset('front/assets/landing/js/map-script.js') }}"></script>
<script src="{{ asset('front/assets/js/core.min.js') }}"></script>
<script src="{{ asset('front/assets/js/thesaas.min.js') }}"></script>
<script src="{{ asset('front/assets/js/script.js') }}"></script>
<script src="{{ asset('froiden-helper/helper.js') }}"></script>
<script src="{{ asset('assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>
@stack('footer-script')
<!--Google Map APi Key-->
<script src="http://maps.google.com/maps/api/js?key=AIzaSyDaaCBm4FEmgKs5cfVrh3JYue3Chj1kJMw&#038;ver=5.2.4"></script>
<!--End Google Map APi-->
</body>
</html>