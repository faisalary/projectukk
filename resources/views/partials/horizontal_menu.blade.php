<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('app-assets') }}" data-template="horizontal-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Talentern</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('app-assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('app-assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('app-assets/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('app-assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ url('app-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ url('app-assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet"
        href="{{ url('app-assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/pickr/pickr-themes.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/tagify/tagify.css') }}" />


    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ url('app-assets/vendor/css/pages/cards-advance.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/css/pages/ui-carousel.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/libs/dropzone/dropzone.css') }}" />
    <link rel="stylesheet" href="{{ url('app-assets/css/style.css') }}" />
    <!-- Helpers -->
    <script src="{{ url('app-assets/vendor/js/helpers.js') }}"></script>


    @yield('page_style')

    <style>
        /* Button used to open the chat form - fixed at the bottom of the page */
        .open-button {
            background-color: #FFFFFF;
            color: #418D5E;
            padding: 0px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            width: 160px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* The popup chat - hidden by default */
        .chat-popup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            border: 3px solid #f1f1f1;
            z-index: 9;
            overflow-y: auto;
            max-height: 500px;

        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }
    </style>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    {{-- <script src="{{ url('app-assets/vendor/js/template-customizer.js') }}"></script> --}}
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ url('app-assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            <!-- Navbar -->
            @include('partials.topbar')
            <!-- / Navbar -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    @yield('content')
                    <!--/ Content -->

                    <!-- <div class="container-xxl flex-grow-1 container-p-y"> -->

                    @if (auth()->check())
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    Apakah Anda Ingin Keluar Dari Akun Ini?
                                </div>
                                <div class="modal-footer" style="display: flex; justify-content:center;">
                                    <a href="{{ route('logout') }}">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Iya</button></a>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- Footer -->

                    <footer class="content-footer footer bg-footer-theme" style="background-color:#1A3826 !important"
                        id="footer">
                        <div class="container-xxl">
                            <div class="row text-white py-4">
                                <div class="col-md-4 col-12 ps-5">
                                    <img src="{{ url('app-assets/img/talentern_white.svg') }}">
                                    <p class="mt-4">Berkarya dan Belajar: Temukan Pengalaman Magang dan Perusahaan
                                        Terbaik Bersama Kami!</p>
                                </div>
                                <div class="col-md-8 col-12">
                                    <div class="row text-white">
                                        <div class="col-md-4 col-12">
                                            <p>Kontak Kami</p>
                                            <p class="location text-secondary"><i class="ti ti-mail"
                                                    style="margin-right: 10px; margin-bottom:5px;"></i><a
                                                    href="mailto:magangfit@telkomuniversity.ac.id"
                                                    style="color: rgba(var(--bs-secondary-rgb), var(--bs-text-opacity)) !important;">magangfit@telkomuniversity.ac.id</a>
                                            </p>
                                            <p class="location text-secondary"><i class="ti ti-brand-whatsapp"
                                                    style="margin-right: 10px; margin-bottom:5px;"></i><a
                                                    href="https://wa.me/6285161415115"
                                                    style="color: rgba(var(--bs-secondary-rgb), var(--bs-text-opacity)) !important;">+62
                                                    851-6141-5115</a></p>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <p>Legal</p>
                                            <p class="text-secondary"><i>Community Guidelines</i></p>
                                            <p class="text-secondary"><i>Privacy & Terms</i></p>
                                        </div>
                                        <div class="col-md-5 col-12">
                                            <p>Tentang Kami</p>
                                            <a href="/aboutus/talentern">
                                                <p class="text-secondary">Talentern</p>
                                            </a>
                                            <a href="/aboutus/techno">
                                                <p class="text-secondary"> PT. Teknologi Nirmala Olah Daya Informasi
                                                </p>
                                            </a>
                                            <a href="/aboutus/lkmfit">
                                                <p class="text-secondary"> Layanan Kerjasama dan Magang Fakultas Ilmu
                                                    Terapan</p>
                                            </a>
                                            <button type="button" class="btn rounded-pill btn-outline-primary" onclick="openForm();" style="background-color: white;">
                                                <span class="ti-xs ti ti-help me-1"></span>Butuh Bantuan ?
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 px-5">
                                    <div class="copyright-text text-left mt-2" style="color: white">
                                        <span>Social Media :</span>
                                        <div class="social-links mt-2">
                                            <a href="#" class="ml-0"><i class="fab fa-facebook-f"
                                                    style="color: white; margin-right: 20px;"></i></a>
                                            <a href="#"><i class="fab fa-instagram"
                                                    style="color: white; margin-right: 20px;"></i></a>
                                            <a href="#"><i class="fab fa-linkedin-in"
                                                    style="color: white; margin-right: 20px;"></i></a>
                                            <a href="#"><i class="fab fa-twitter"
                                                    style="color: white; margin-right: 20px;"></i></a>
                                        </div>
                                    </div>
                                    <hr style="border-color: rgb(255, 255, 255);">

                                    <div class="copyright-text text-left mt-3" style="color: white">©
                                        {{ \Carbon\Carbon::today()->year }}
                                        @lang('app.byFooter') Crafted with PASSION by Proxsis Solusi Humaka & Techno
                                        Infinity
                                    </div>
                                </div>
                            </div>

                            <div class="chat-popup" id="myForm"
                                style=" border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <form action="{{ route('submit-contact') }}" method="POST"
                                    class="form-container p-0" enctype="multipart/form-data">
                                    @csrf

                                    <div class="modal-header" style="background-color: #4EA971 !important;">
                                        <i class="ti ti-x text-white mb-4 ms-2 mt-1" aria-label="Close"
                                            onclick="closeForm()"></i>
                                        <h6 class="pt-3 text-white" style="padding-right: 40px !important;">Tinggalkan
                                            Pesan Untuk Kami</h6>
                                    </div>
                                    <div class="card-body p-4">
                                        <label for="msg">Pusat bantuan bagi mahasiswa dan mitra perusahaan
                                            Talentern</label>
                                        <div>
                                            <label for="name" class="form-label mt-3">Nama Lengkap <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="name" aria-describedby="defaultFormControlHelp">
                                        </div>
                                        <div>
                                            <label for="email" class="form-label mt-3">Email <span
                                                    class="text-danger">*</span> </label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="name@example.com">
                                        </div>
                                        <div>
                                            <label for="institutions" class="form-label mt-3">Asal Instansi/Perusahaan
                                                <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" id="institutions"
                                                name="institutions" placeholder="Telkom University"
                                                aria-describedby="defaultFormControlHelp">
                                        </div>
                                        <div>
                                            <label for="note" class="form-label mt-3">Catatan <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control" id="note" name="note" placeholder="Tulis Disini"
                                                aria-describedby="defaultFormControlHelp"></textarea>
                                        </div>
                                        <div>
                                            <label for="file" class="form-label mt-3">Dokumen Pendukung</label>
                                            <input type="file" class="form-control" id="file" name="file"
                                                autofocus>
                                        </div>
                                        <button type="submit" class="btn btn-success mt-3 w-100">Kirim</button>
                                    </div>
                                </form>
                            </div>
                            {{-- <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div> --}}
                        </div>
                    </footer>
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!--/ Content wrapper -->
                <!-- </div> -->

                <!--/ Layout container -->
            </div>
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>

        <!--/ Layout wrapper -->

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="{{ url('app-assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ url('app-assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/node-waves/node-waves.js') }}"></script>

        <script src="{{ url('app-assets/vendor/libs/hammer/hammer.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/i18n/i18n.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

        <script src="{{ url('app-assets/vendor/js/menu.js') }}"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ url('app-assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/swiper/swiper.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/select2/select2.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/dropzone/dropzone.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/pickr/pickr.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>
        <script src="{{ url('app-assets/vendor/libs/tagify/tagify.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ url('app-assets/js/main.js') }}"></script>

        <!-- Page JS -->
        <script src="{{ url('app-assets/js/dashboards-analytics.js') }}"></script>
        <script src="{{ url('app-assets/js/form-wizard-validation.js') }}"></script>
        <script src="{{ url('app-assets/js/form-wizard-icons.js') }}"></script>
        <script src="{{ url('app-assets/js/ui-carousel.js') }}"></script>
        <script src="{{ url('js/content.js') }}"></script>

        <script>
            $('.flatpickr-range').flatpickr({
                mode: "range",
                enableTime: false,
            });
        </script>

        @yield('page_script')
</body>

</html>
