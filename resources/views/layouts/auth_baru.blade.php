
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>{{ $setting->company_name }}</title>

<!-- Stylesheets -->
<link href="{{ asset('front/assets/landing/css/bootstrap.css')}}" rel="stylesheet">
<link href="{{ asset('front/assets/landing/css/style.css')}}" rel="stylesheet">
<link href="{{ asset('front/assets/landing/css/responsive.css')}}" rel="stylesheet">

<link rel="shortcut icon" href="{{ asset('front/assets/landing/images/favicon.png')}}" type="image/x-icon">
<link rel="icon" href="{{ asset('front/assets/landing/images/favicon.png')}}" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
<style>

</style>
</head>

<body>

<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Main Header-->
    <!-- <header class="main-header">
        <div class="container-fluid" style="padding: 0!important;"> -->
            <!-- Main box -->
            <!-- <div class="main-box" style="display: flex; align-items: center; justify-content: right;"> -->
                <!--Nav Outer -->
                <!-- <div class="nav-outer m-4">
                    <a href="{{ url('/') }}"><img src="{{ $setting->logo_url }}" alt="" title="" style="height: 26px; width: auto;"></a>
                </div>
                {{-- <div class="outer-box"> -->
                    <!-- Login/Register -->
                    <!-- <div class="btn-box">
                        <a href="login-popup.html" class="theme-btn btn-style-three call-modal">Login / Register</a>
                        <a href="dashboard-post-job.html" class="theme-btn btn-style-one"><span class="btn-title">Job Post</span></a>
                    </div>
                </div> --}}
            </div>
        </div> -->

        <!-- Mobile Header -->
        <!-- <div class="mobile-header">
            <div class="logo"><a href="{{ url('/') }}"><img src="{{ $setting->logo_url }}" alt="" title="" style="height: 26px; width: auto;"></a></div>
        </div> -->

        <!-- Mobile Nav -->
        <!-- {{-- <div id="nav-mobile"></div> --}}
    </header> -->
    <!--End Main Header -->

    <!-- Info Section -->
    <div class="login-section">
        <div id="imgLogin" class="image-layer" style="background-image: url({{asset('assets/images/background/auth_new.png')}}); background-size: 800px; margin-left: 20px;"></div>
        <div class="outer-box">
             <!-- Login Form -->
            <div class="login-form default-form">
                <div class="form-inner">
                    <div>
                    <a href="{{ url('/login') }}"><img src="{{ $setting->logo_url }}" alt="" title="" style="width: 200px; height: auto;"></a>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-muted"  style="font-weight: 600; font-size: 28px; margin-bottom: 0!important;">
                            @lang('auth.page.welcome')
                        </h4>
                        <p class="text-muted">@lang('auth.page.enterDetails')</p>
                    </div>
                    <!--Login Form-->
                    <!-- {{-- <form method="post" action="add-parcel.html">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" placeholder="Username" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Password</label>
                            <input id="password-field" type="password" name="password" value="" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <div class="field-outer">
                                <div class="input-group checkboxes square">
                                    <input type="checkbox" name="remember-me" value="" id="remember">
                                    <label for="remember" class="remember"><span class="custom-checkbox"></span> Remember me</label>
                                </div>
                                <a href="#" class="pwd">Forgot password?</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="theme-btn btn-style-one" type="submit" name="log-in">Log In</button>
                        </div>
                    </form> --}} -->
                    @yield('conten')
                    
                    <div class="bottom-box ">
                        <div class="text-cnter">@lang('auth.page.dontHaveAccount') <a href="register">@lang('auth.page.signup')</a></div>
                       
                        <div class="divider"><span>or</span></div>
                        
                    
                        <div class="btn-box row">
                                <div class="col-lg-6 col-md-12">
                                    <a href="#" class="theme-btn social-btn-two facebook-btn"><i class="fab fa-facebook-f"></i> Log In via Facebook</a>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <a href="#" class="theme-btn social-btn-two google-btn"><i class="fab fa-google"></i> Log In via Gmail</a>
                                </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!--End Login Form -->
        </div>
    </div>
    <!-- End Info Section -->


</div><!-- End Page Wrapper -->


<script src="{{ asset('front/assets/landing/js/jquery.js') }}"></script> 
<script src="{{ asset('front/assets/landing/js/popper.min.js') }}"></script>
<script src="{{ asset('front/assets/landing/js/chosen.min.js') }}"></script>
<script src="{{ asset('front/assets/landing/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/assets/landing/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('front/assets/landing/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('front/assets/landing/js/jquery.modal.min.js') }}"></script>
<script src="{{ asset('front/assets/landing/js/mmenu.polyfills.js') }}"></script>
<script src="{{ asset('front/assets/landing/js/mmenu.js') }}"></script>
<script src="{{ asset('front/assets/landing/js/appear.js') }}"></script>
<script src="{{ asset('front/assets/landing/js/owl.js') }}"></script>
<script src="{{ asset('front/assets/landing/js/wow.js') }}"></script>
<script src="{{ asset('front/assets/landing/js/script.js') }}"></script>
</body>
</html>


