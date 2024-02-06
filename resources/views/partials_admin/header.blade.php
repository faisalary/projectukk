<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../../../app-assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    @yield('meta_header')
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Talentern</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('app-assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('app-assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" /> -->
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('app-assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('app-assets/vendor/css/pages/cards-advance.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('app-assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('app-assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('app-assets/js/config.js') }}"></script>

    <style>
        .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: #4EA971 !important;
            box-shadow: none !important;
            color: #fff !important;
        }

        .page-item.active .page-link {
            border-color: #4EA971 !important;
            background-color: #4EA971 !important;
            color: #fff;
        }

        html:not([dir=rtl]) .app-brand-text {
            margin-left: -2.5rem !important;
            background-color: white !important;
        }

        .select2-results__option[role=option][aria-selected=true] {
            background-color: #4EA971 !important;
            color: #fff;
        }

        .form-check-input:checked,
        .form-check-input[type=checkbox]:indeterminate {
            background-color: #4EA971;
            border-color: #4EA971;
        }

        .select2-container--default .select2-results__option--highlighted:not([aria-selected=true]) {
            background-color: rgba(115, 103, 240, 0.08) !important;
            color: #4EA971 !important;
        }

        .nav-pills .nav-link.active,
        .nav-pills .nav-link.active:hover,
        .nav-pills .nav-link.active:focus {
            background-color: #4EA971;
            color: #fff;
        }

        .nav-pills .nav-link:not(.active):hover,
        .nav-pills .nav-link:not(.active):focus {
            color: #4EA971;
        }

        .btn-success {
            background-color: #4EA971;
            border-color: #4EA971;
        }

        .form-check-input:checked,
        .form-check-input[type=checkbox]:indeterminate {
            background-color: #4EA971;
            border-color: #4EA971;
        }

        .select2-container--default .select2-results__option--highlighted:not([aria-selected=true]) {
            background-color: rgba(115, 103, 240, 0.08) !important;
            color: #4EA971 !important;
        }

        .nav-pills .nav-link.active,
        .nav-pills .nav-link.active:hover,
        .nav-pills .nav-link.active:focus {
            background-color: #4EA971;
            color: #fff;
        }

        .nav-pills .nav-link:not(.active):hover,
        .nav-pills .nav-link:not(.active):focus {
            color: #4EA971;
        }

        .btn-success {
            background-color: #4EA971;
            border-color: #4EA971;
        }
    </style>

    @yield('page_style')

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <span class="app-brand-logo demo">
                        <img src="{{ url('/app-assets/img/Logo.svg') }}">
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold">
                            <img src="{{ url('/app-assets/img/Talentern.svg') }}">
                        </span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <!-- Admin -->

                @can('slidebar.lkm')
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Admin</span>
                    </li>
                    <ul class="menu-inner py-1">
                        <!-- Dashboards -->
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-device-desktop-analytics"></i>
                                <div data-i18n="Dashboards">Dashboards</div>
                            </a>
                        </li>

                        <!-- Kelola Mitra -->
                        <li
                            class="menu-item @if (!empty($active_menu)) {{ $active_menu == 'company/kelola-mitra' ? 'active' : '' }} @endif">
                            <a href="/company/kelola-mitra" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-building"></i>
                                <div data-i18n="Kelola Mitra">Kelola Mitra</div>
                            </a>
                        </li>

                        <!-- Lowongan Magang -->
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-briefcase"></i>
                                <div data-i18n="Lowongan Magang">Lowongan Magang</div>
                            </a>
                            <ul class="menu-sub">
                                <li
                                    class="menu-item @if (!empty($active_menu)) {{ $active_menu == 'informasi/mitra/' ? 'active' : '' }} @endif">
                                    <a href="{{ route('mitra.index') }}" class="menu-link">
                                        <div data-i18n="Informasi Lowongan">Informasi Lowongan></div>
                                    </a>
                                </li>
                                <li
                                    class="menu-item @if (!empty($active_menu)) {{ $active_menu == 'kelola/lowongan' ? 'active' : '' }} @endif">
                                    <a href="{{ route('lowongan-magang.index') }}" class="menu-link">
                                        <div data-i18n="Kelola Lowongan">Kelola Lowongan</div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    <!-- Data Kandidat -->
                    <li class="menu-item {{ (request()->is('magang-fakultas*') || request()->is('magang-mandiri*')) ? 'active open' : '' }}">
                        <a href="" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-file-analytics"></i>
                            <div data-i18n="Data Kandidat">Data Kandidat</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ request()->is('magang-fakultas*') ? 'active' : '' }}">
                                <a href="{{ url('magang-fakultas') }}" class="menu-link">
                                    <div data-i18n="Magang Fakultas">Magang Fakultas</div>
                                </a>
                            </li>
                            <li class="menu-item {{ request()->is('magang-mandiri*') ? 'active' : '' }}">
                                <a href="{{ url('magang-mandiri') }}" class="menu-link">
                                    <div data-i18n="Magang Mandiri">Magang Mandiri</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Jadwal Seleksi -->
                    <li
                            class="menu-item @if (!empty($active_menu)) {{ $active_menu == '/seleksi/lanjutan' ? 'active' : '' }} @endif">
                            <a href="/seleksi/lanjutan" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-clock"></i>
                                <div data-i18n="Jadwal Seleksi">Jadwal Seleksi</div>
                            </a>
                        </li>

                    <!-- Kelola Pengguna -->
                    <li class="menu-item {{ request()->is('kelola-pengguna*') ? 'active' : ''}}">
                        <a href="{{ url('kelola-pengguna')}}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-users"></i>
                            <div data-i18n="Kelola Pengguna">Kelola Pengguna</div>
                        </a>
                    </li>


                        <!-- Master Data -->
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-database"></i>
                                <div data-i18n="Master Data">Master Data</div>
                            </a>
                            <ul class="menu-sub">
                                <li
                                    class="menu-item @if (!empty($active_menu)) {{ $active_menu == 'master_universitas' ? 'active' : '' }} @endif">
                                    <a href="{{ route('universitas.index') }}" class="menu-link">
                                        <div data-i18n="Master Universitas">Master Universitas</div>
                                    </a>
                                </li>
                                <li
                                    class="menu-item @if (!empty($active_menu)) {{ $active_menu == 'master_fakultas' ? 'active' : '' }} @endif">
                                    <a href="{{ route('fakultas.index') }}" class="menu-link">
                                        <div data-i18n="Master Fakultas">Master Fakultas</div>
                                    </a>
                                </li>
                                <li
                                    class="menu-item @if (!empty($active_menu)) {{ $active_menu == 'master-prodi' ? 'active' : '' }} @endif">
                                    <a href=/master/prodi class="menu-link">
                                        <div data-i18n="Master Prodi">Master Prodi</div>
                                    </a>
                                </li>
                                <li
                                    class="menu-item @if (!empty($active_menu)) {{ $active_menu == 'master_tahun_akademik' ? 'active' : '' }} @endif">
                                    <a href="{{ route('thn-akademik.index') }}" class="menu-link">
                                        <div data-i18n="Master Tahun Akademik">Master Tahun Akademik</div>
                                    </a>
                                </li>
                                <li
                                    class="menu-item @if (!empty($active_menu)) {{ $active_menu == 'master-jenis-magang' ? 'active' : '' }} @endif">
                                    <a href=/master/jenis-magang class="menu-link">
                                        <div data-i18n="Master Jenis Magang">Master Jenis Magang</div>
                                    </a>
                                </li>
                                <li class="menu-item"
                                    @if (!empty($active_menu)) {{ $active_menu == 'master-mitra' ? 'active' : '' }} @endif>
                                    <a href="{{ route('mitra.index') }}" class="menu-link">
                                        <div data-i18n="Master Industri">Master Industri</div>
                                    </a>
                                </li>
                                <li class="menu-item"
                                    @if (!empty($active_menu)) {{ $active_menu == 'master_dosen' ? 'active' : '' }} @endif>
                                    <a href="{{ route('dosen.index') }}" class="menu-link">
                                        <div data-i18n="Master Dosen">Master Dosen</div>
                                    </a>
                                </li>
                                <li class="menu-item"
                                    @if (!empty($active_menu)) {{ $active_menu == 'master_mahasiswa' ? 'active' : '' }} @endif>
                                    <a href="{{ route('mahasiswa.index') }}" class="menu-link">
                                        <div data-i18n="Master Mahasiswa">Master Mahasiswa</div>
                                    </a>
                                </li>
                                <li class="menu-item"
                                    @if (!empty($active_menu)) {{ $active_menu == 'master-pegawai-industri' ? 'active' : '' }} @endif>
                                    <a href="{{ route('pegawaiindustri.index') }}" class="menu-link">
                                        <div data-i18n="Master Pegawai Industri">Master Pegawai Industri</div>
                                    </a>
                                </li>
                                <li
                                    class="menu-item  @if (!empty($active_menu)) {{ $active_menu == 'master_nilai_mutu' ? 'active' : '' }} @endif">
                                    <a href="{{ route('nilai-mutu.index') }}" class="menu-link">
                                        <div data-i18n="Master Nilai Mutu">Master Nilai Mutu</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('komponen-penilaian.index') }}" class="menu-link">
                                        <div data-i18n="Master Komponen Nilai">Master Komponen Nilai</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('doc-syarat.index') }}" class="menu-link">
                                        <div data-i18n="Dokumen Persyaratan">Dokumen Persyaratan</div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="menu-item">
                            <a href="{{ url('/konfigurasi') }}" class="menu-link">
                                <i class="ti ti-user"></i>
                                <div data-i18n="Konfigurasi">Konfigurasi</div>
                            </a>
                        </li>

                        <!-- Pengaturan -->
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-settings"></i>
                                <div data-i18n="Pengaturan">Pengaturan</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="" class="menu-link">
                                        <div data-i18n="Profil Saya">Profil Saya</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="" class="menu-link">
                                        <div data-i18n="Pengaturan Bahasa">Pengaturan Bahasa</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="javascript:void(0);" class="menu-link ">
                                        <i class="menu-icon tf-icons ti ti-file"></i>
                                        <div data-i18n="Pengaturan Tema">Pengaturan Tema</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="javascript:void(0);" class="menu-link ">
                                        <i class="menu-icon tf-icons ti ti-lock"></i>
                                        <div data-i18n="Pengaturan Email">Pengaturan Email</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endcan


                <!-- Mitra -->
                @can('slidebar.mitra')
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Mitra</span>
                    </li>
                    <ul class="menu-inner py-2">
                        <!-- Dashboards -->
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-device-desktop-analytics"></i>
                                <div data-i18n="Dashboards">Dashboards</div>
                            </a>
                        </li>

                        <!-- Lowongan Magang -->
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-briefcase"></i>
                                <div data-i18n="Lowongan Magang">Lowongan Magang</div>
                            </a>

                            <ul class="menu-sub">
                                <li
                                    class="menu-item @if (!empty($active_menu)) {{ $active_menu == '/informasi/lowongan/' ? 'active' : '' }} @endif">
                                    <a href="{{ url('informasi/lowongan', Auth::user()->id_industri) }}"
                                        class="menu-link">
                                        <div data-i18n="Informasi Lowongan">Informasi Lowongan></div>
                                    </a>
                                </li>
                                <li
                                    class="menu-item @if (!empty($active_menu)) {{ $active_menu == 'informasi/kelola/lowongan' ? 'active' : '' }} @endif">
                                    <a href="{{ route('lowongan-magang.index') }}" class="menu-link">
                                        <div data-i18n="Kelola Lowongan">Kelola Lowongan</div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    <!-- Anggota Tim -->
                    <li class="menu-item @if (!empty($active_menu)) {{ $active_menu == 'anggota/tim' ? 'active' : '' }} @endif"">
                        <a href=" /anggota/tim" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-users"></i>
                        <div data-i18n="Anggota Tim">Anggota Tim</div>
                        </a>
                    </li>

                        <!-- Jadwal Seleksi -->
                        <li
                            class="menu-item @if (!empty($active_menu)) {{ $active_menu == 'jadwal-seleksi/lowongan/' ? 'active' : '' }} @endif">
                            <a href="{{ url('jadwal-seleksi/lowongan', Auth::user()->id_industri) }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-clock"></i>
                                <div data-i18n="Jadwal Seleksi">Jadwal Seleksi</div>
                            </a>
                        </li>

                    <!-- Profile Perusahaan -->
                    <li class="menu-item @if (!empty($active_menu)) {{ $active_menu == 'profile-company' ? 'active' : '' }} @endif">
                        <a href="/company/profile-company" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-building"></i>
                            <div data-i18n="Profile Perusahaan">Profile Perusahaan</div>
                        </a>
                    </li>

                    <!-- Logbook Mahasiswa -->
                    <li class="menu-item">
                        <a href="/logbook/mahasiswa" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-file-analytics"></i>
                            <div data-i18n="Logbook Mahasiswa">Logbook Mahasiswa</div>
                        </a>
                    </li>

                        <!-- Master Data -->
                        <li
                            class="menu-item @if (!empty($active_menu)) {{ $active_menu == 'master-data' ? 'active' : '' }} @endif">
                            <a href="/company/master-email" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-database"></i>
                                <div data-i18n="Master Data Email">Master Data Email</div>
                            </a>
                        </li>

                    </ul>
                @endcan
            </aside>

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="ti ti-menu-2 ti-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <!-- <div class="navbar-nav align-items-center">
                            <div class="nav-item navbar-search-wrapper mb-0">
                                <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                                    <i class="ti ti-search ti-md me-2"></i>
                                    <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                                </a>
                            </div>
                        </div> -->
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Language -->
                            <!-- <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <i class="fi fi-us fis rounded-circle me-1 fs-3"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-language="en">
                                            <i class="fi fi-us fis rounded-circle me-1 fs-3"></i>
                                            <span class="align-middle">English</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-language="fr">
                                            <i class="fi fi-fr fis rounded-circle me-1 fs-3"></i>
                                            <span class="align-middle">French</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-language="de">
                                            <i class="fi fi-de fis rounded-circle me-1 fs-3"></i>
                                            <span class="align-middle">German</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-language="pt">
                                            <i class="fi fi-pt fis rounded-circle me-1 fs-3"></i>
                                            <span class="align-middle">Portuguese</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> -->
                            <!--/ Language -->

                            <!-- Style Switcher -->
                            <!-- <li class="nav-item me-2 me-xl-0">
                                <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                                    <i class="ti ti-md"></i>
                                </a>
                            </li> -->
                            <!--/ Style Switcher -->

                            <!-- Quick links  -->
                            <!-- <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    <i class="ti ti-layout-grid-add ti-md"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end py-0">
                                    <div class="dropdown-menu-header border-bottom">
                                        <div class="dropdown-header d-flex align-items-center py-3">
                                            <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
                                            <a href="javascript:void(0)" class="dropdown-shortcuts-add text-body"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Add shortcuts"><i class="ti ti-sm ti-apps"></i></a>
                                        </div>
                                    </div>
                                    <div class="dropdown-shortcuts-list scrollable-container">
                                        <div class="row row-bordered overflow-visible g-0">
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-calendar fs-4"></i>
                                                </span>
                                                <a href="app-calendar.html" class="stretched-link">Calendar</a>
                                                <small class="text-muted mb-0">Appointments</small>
                                            </div>
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-file-invoice fs-4"></i>
                                                </span>
                                                <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>
                                                <small class="text-muted mb-0">Manage Accounts</small>
                                            </div>
                                        </div>
                                        <div class="row row-bordered overflow-visible g-0">
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-users fs-4"></i>
                                                </span>
                                                <a href="app-user-list.html" class="stretched-link">User App</a>
                                                <small class="text-muted mb-0">Manage Users</small>
                                            </div>
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-lock fs-4"></i>
                                                </span>
                                                <a href="app-access-roles.html" class="stretched-link">Role
                                                    Management</a>
                                                <small class="text-muted mb-0">Permission</small>
                                            </div>
                                        </div>
                                        <div class="row row-bordered overflow-visible g-0">
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-chart-bar fs-4"></i>
                                                </span>
                                                <a href="index.html" class="stretched-link">Dashboard</a>
                                                <small class="text-muted mb-0">User Profile</small>
                                            </div>
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-settings fs-4"></i>
                                                </span>
                                                <a href="pages-account-settings-account.html"
                                                    class="stretched-link">Setting</a>
                                                <small class="text-muted mb-0">Account Settings</small>
                                            </div>
                                        </div>
                                        <div class="row row-bordered overflow-visible g-0">
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-help fs-4"></i>
                                                </span>
                                                <a href="pages-help-center-landing.html" class="stretched-link">Help
                                                    Center</a>
                                                <small class="text-muted mb-0">FAQs & Articles</small>
                                            </div>
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                                    <i class="ti ti-square fs-4"></i>
                                                </span>
                                                <a href="modal-examples.html" class="stretched-link">Modals</a>
                                                <small class="text-muted mb-0">Useful Popups</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li> -->
                            <!-- Quick links -->

                            <!-- Notification -->
                            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    <i class="ti ti-bell ti-md"></i>
                                    <span class="badge bg-danger rounded-pill badge-notifications">5</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end py-0">
                                    <li class="dropdown-menu-header border-bottom">
                                        <div class="dropdown-header d-flex align-items-center py-3">
                                            <h5 class="text-body mb-0 me-auto">Notification</h5>
                                            <a href="javascript:void(0)" class="dropdown-notifications-all text-body"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Mark all as read"><i class="ti ti-mail-opened fs-4"></i></a>
                                        </div>
                                    </li>
                                    <li class="dropdown-notifications-list scrollable-container">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="../../../app-assets/img/avatars/1.png" alt
                                                                class="h-auto rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Congratulation Lettie 🎉</h6>
                                                        <p class="mb-0">Won the monthly best seller gold badge</p>
                                                        <small class="text-muted">1h ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-danger">CF</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Charles Franklin</h6>
                                                        <p class="mb-0">Accepted your connection</p>
                                                        <small class="text-muted">12hr ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="../../../app-assets/img/avatars/2.png" alt
                                                                class="h-auto rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">New Message ✉️</h6>
                                                        <p class="mb-0">You have new message from Natalie</p>
                                                        <small class="text-muted">1h ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-success"><i
                                                                    class="ti ti-shopping-cart"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Whoo! You have new order 🛒</h6>
                                                        <p class="mb-0">ACME Inc. made new order $1,154</p>
                                                        <small class="text-muted">1 day ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="../../../app-assets/img/avatars/9.png" alt
                                                                class="h-auto rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Application has been approved 🚀</h6>
                                                        <p class="mb-0">Your ABC project application has been
                                                            approved.
                                                        </p>
                                                        <small class="text-muted">2 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-success"><i
                                                                    class="ti ti-chart-pie"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Monthly report is generated</h6>
                                                        <p class="mb-0">July monthly financial report is generated
                                                        </p>
                                                        <small class="text-muted">3 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="../../../app-assets/img/avatars/5.png" alt
                                                                class="h-auto rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Send connection request</h6>
                                                        <p class="mb-0">Peter sent you connection request</p>
                                                        <small class="text-muted">4 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="../../../app-assets/img/avatars/6.png" alt
                                                                class="h-auto rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">New message from Jane</h6>
                                                        <p class="mb-0">Your have new message from Jane</p>
                                                        <small class="text-muted">5 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-warning"><i
                                                                    class="ti ti-alert-triangle"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">CPU is running high</h6>
                                                        <p class="mb-0">CPU Utilization Percent is currently at
                                                            88.63%,
                                                        </p>
                                                        <small class="text-muted">5 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-menu-footer border-top">
                                        <a href="javascript:void(0);"
                                            class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                                            View all notifications
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ Notification -->

                            <!-- User -->
                            @php
                                $user = Auth::user();
                            @endphp
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">

                                        @if($user->roles[0]->name == 'superadmin')
                                        <img src="{{Auth::user()->profile_image_url ?? '\assets\images\super-admin.png'}}" alt class="h-auto rounded-circle" />
                                        @elseif($user->roles[0]->name == 'admin')
                                            <img src="{{ Auth::user()->profile_image_url ?? '\assets\images\company.png' }}"
                                                alt class="h-auto rounded-circle" />
                                        @endif
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="pages-account-settings-account.html">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        @if ($user->roles[0]->name == 'superadmin')
                                                            <img src="{{ Auth::user()->profile_image_url ?? '\assets\images\super-admin.png' }}"
                                                                alt class="h-auto rounded-circle" />
                                                        @elseif($user->roles[0]->name == 'admin')
                                                            <img src="{{ Auth::user()->profile_image_url ?? '\assets\images\company.png' }}"
                                                                alt class="h-auto rounded-circle" />
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span
                                                        class="fw-semibold d-block">{{ ucwords($user->username) }}</span>
                                                    <small class="text-muted">{{ ucwords($user->email) }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="pages-profile-user.html">
                                            <i class="ti ti-user-check me-2 ti-sm"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="pages-account-settings-account.html">
                                            <i class="ti ti-settings me-2 ti-sm"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="pages-account-settings-billing.html">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 ti ti-credit-card me-2 ti-sm"></i>
                                                <span class="flex-grow-1 align-middle">Billing</span>
                                                <span
                                                    class="flex-shrink-0 badge badge-center rounded-pill bg-label-danger w-px-20 h-px-20">2</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="pages-help-center-landing.html">
                                            <i class="ti ti-lifebuoy me-2 ti-sm"></i>
                                            <span class="align-middle">Help</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="pages-faq.html">
                                            <i class="ti ti-help me-2 ti-sm"></i>
                                            <span class="align-middle">FAQ</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="pages-pricing.html">
                                            <i class="ti ti-currency-dollar me-2 ti-sm"></i>
                                            <span class="align-middle">Pricing</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            href="{{ route('logout') }}">
                                            <i class="ti ti-logout me-2 ti-sm"></i>
                                            <span class="align-middle">Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>

                    <!-- Search Small Screens -->
                    <div class="navbar-search-wrapper search-input-wrapper d-none">
                        <input type="text" class="form-control search-input container-xxl border-0"
                            placeholder="Search..." aria-label="Search..." />
                        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <!-- Modal Delete-->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                    </button>
                                </div>
                                <div class="modal-body text-center" style="display:block;">
                                    Apakah Anda Ingin Keluar Dari Akun Ini?
                                </div>
                                <div class="modal-footer" style="display: flex; justify-content:center;">
                                    <a href="{{ route('logout') }}"><button type="button" class="btn btn-success"
                                            data-dismiss="modal">Iya</button></a>
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-xxl flex-grow-1 container-p-y">