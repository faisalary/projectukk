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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2-bootstrap4.min.css" rel="stylesheet">



    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->


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

        .text-primary {}

        .bg-primary {
            color: #fff !important;
        }

        .btn-success {
            color: #fff;
            background-color: #4EA971 !important;
            border-color: #4EA971 !important;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #4EA971 !important;
            border-color: #4EA971 !important;
        }

        .page-item .page-link {
            color: grey;
        }

        .dropdown-item.active,
        .dropdown-item:active {
            color: #fff;
            background-color: #4EA971 !important;
        }

        .bg-primary,
        .label-primary {}

        .btn-primary {}

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

        .dropbtn {
            background-color: #04AA6D;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #3e8e41;
        }

        #myInput {
            box-sizing: border-box;
            background-image: url('searchicon.png');
            background-position: 14px 12px;
            background-repeat: no-repeat;
            font-size: 16px;
            padding: 14px 20px 12px 45px;
            border: none;
            border-bottom: 1px solid #ddd;
        }

        #myInput:focus {
            outline: 3px solid #ddd;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f6f6f6;
            min-width: 230px;
            overflow: auto;
            border: 1px solid #ddd;
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {
            background-color: #ddd;
        }

        .show {
            display: block;
        }
        .select2-container--default .select2-selection--single {
            width: 500px;
    height: 50px;
    border-left: 0px;
    border-top-left-radius: 0px;
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
    border-bottom-left-radius: 0px;
}

.select2-container {
    width: 418px !important;
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    @stack('footer-script')

    <script>
        function imagefun() {
            var Image_Id = document.getElementById('getImage');
            if (Image_Id.src.match("{{ asset('front/assets/img/bookmark-outline.svg')}}")) {
                Image_Id.src = "{{ asset('front/assets/img/bookmark.svg')}}";
            } else {
                Image_Id.src = "{{ asset('front/assets/img/bookmark-outline.svg')}}";
            }
        }

        function imagefun1() {
            var Image_Id = document.getElementById('getImage1');
            if (Image_Id.src.match("{{ asset('front/assets/img/bookmark-outline.svg')}}")) {
                Image_Id.src = "{{ asset('front/assets/img/bookmark.svg')}}";
            } else {
                Image_Id.src = "{{ asset('front/assets/img/bookmark-outline.svg')}}";
            }
        }

        function imagefun2() {
            var Image_Id = document.getElementById('getImage2');
            if (Image_Id.src.match("{{ asset('front/assets/img/bookmark-outline.svg')}}")) {
                Image_Id.src = "{{ asset('front/assets/img/bookmark.svg')}}";
            } else {
                Image_Id.src = "{{ asset('front/assets/img/bookmark-outline.svg')}}";
            }
        }

        function imagefun3() {
            var Image_Id = document.getElementById('getImage3');
            if (Image_Id.src.match("{{ asset('front/assets/img/bookmark-outline.svg')}}")) {
                Image_Id.src = "{{ asset('front/assets/img/bookmark.svg')}}";
            } else {
                Image_Id.src = "{{ asset('front/assets/img/bookmark-outline.svg')}}";
            }
        }

        function imagefun4() {
            var Image_Id = document.getElementById('getImage4');
            if (Image_Id.src.match("{{ asset('front/assets/img/bookmark-outline.svg')}}")) {
                Image_Id.src = "{{ asset('front/assets/img/bookmark.svg')}}";
            } else {
                Image_Id.src = "{{ asset('front/assets/img/bookmark-outline.svg')}}";
            }
        }

        function imagefun5() {
            var Image_Id = document.getElementById('getImage5');
            if (Image_Id.src.match("{{ asset('front/assets/img/bookmark-outline.svg')}}")) {
                Image_Id.src = "{{ asset('front/assets/img/bookmark.svg')}}";
            } else {
                Image_Id.src = "{{ asset('front/assets/img/bookmark-outline.svg')}}";
            }
        }

        $("#single").select2({
          placeholder: "Lowongan Magang",
          allowClear: true
      });
    </script>

</body>

</html>