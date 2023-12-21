<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../../app-assets/" data-template="horizontal-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Talentern</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../app-assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="../../app-assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../app-assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../app-assets/vendor/css/rtl/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../app-assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../app-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/swiper/swiper.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css" />
    <link rel="stylesheet"
        href="../../app-assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/bs-stepper/bs-stepper.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/css/pages/ui-carousel.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/typeahead-js/typeahead.css" />


    <!-- Page CSS -->
    <link rel="stylesheet" href="../../app-assets/vendor/css/pages/cards-advance.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/css/pages/ui-carousel.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/dropzone/dropzone.css" />
    <!-- Helpers -->
    <script src="../../app-assets/vendor/js/helpers.js"></script>

    @yield('page_style')
    <style>
        .dropdown-item:focus,
        .dropdown-item:hover {
            color: #4EA971 !important
        }

        .dropdown-item.active,
        .dropdown-item:active {
            color: #FFF;
            background-color: #4EA971 !important
        }

        .d-flex i:hover {
            text-decoration: none !important;
        }
    </style>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../app-assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../app-assets/js/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
      <div class="layout-container">
        <!-- Navbar -->

        <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar" style="background-color: #FFF !important;">
          <div class="container-xxl">
            <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
              <a href="/" class="app-brand-link gap-2">
                <img src="{{ url('/app-assets/img/Talentern.svg')}}">
              </a>

              <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                <i class="ti ti-x ti-sm align-middle"></i>
              </a>
            </div>

            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
              </a>
            </div>

            <!-- Menu -->
            <aside id="layout-menu" class="navbar-nav layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0" style="box-shadow: none;">
              <div class="d-flex h-100" style="width: 50rem;">
                <ul class="menu-inner">

                  <!-- Perusahaan -->
                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <div data-i18n="Perusahaan">Perusahaan</div>
                    </a>

                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link">
                          <div data-i18n="Daftar Mitra">Daftar Mitra</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link">
                          <div data-i18n="Lowongan Magang">Lowongan Magang</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <!-- Program Magang -->
                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <div data-i18n="Program Magang">Program Magang</div>
                    </a>

                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="/magang_fakultas" class="menu-link">
                          <div data-i18n="Magang Fakultas">Magang Fakultas</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="/informasi/magang" class="menu-link">
                          <div data-i18n="Informasi Magang">Informasi Magang</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <!-- Lamaran Saya -->
                  <li class="menu-item">
                    <a href="/kegiatan_saya/lamaran_saya" class="menu-link">
                      <div data-i18n="Lamaran Saya">Lamaran Saya</div>
                    </a>
                  </li>

                  <!-- Layanan LKM -->
                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <div data-i18n="Layanan LKM">Layanan LKM</div>
                    </a>

                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link">
                          <div data-i18n="Logbook">Logbook</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link">
                          <div data-i18n="Persetujuan Dosen Wali">Persetujuan Dosen Wali</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link">
                          <div data-i18n="Konfirmasi Magang">"Konfirmasi Magang</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link">
                          <div data-i18n="Input Dokumen Magang Mandiri">Input Dokumen Magang Mandiri</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link">
                          <div data-i18n="Input Dokumen Magang Kerja">Input Dokumen Magang Kerja</div>
                        </a>
                      </li>

                    </ul>
                  </li>

                  <li class="menu-item">
                    <a href="#footer" class="menu-link">
                      <div data-i18n="Kontak Kami">Kontak Kami</div>
                    </a>
                  </li>
              </div>
            </aside>

            @php
            $user = Auth::user();
            @endphp
            @if(!$user)
            <!-- Login -->

            <div class="d-flex" id="navbar-collapse">

              <!-- Login dan Daftar -->
              <a href="{{ route('login')}}">
                <button class="btn btn-outline-success me-2" style=" border-radius: 8px;" type="button">Masuk</button>
              </a>
              <!-- <a href="{{ route('register')}}">
               <button class="btn btn-outline-success me-2 ml-2" style="border-radius: 8px;" type="button">Daftar</button>
              </a> -->
            </div>
            @else

            <!-- User -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- Notification -->
              <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                  <i class="ti ti-bell ti-md"></i>
                  <span class="badge bg-danger rounded-pill badge-notifications">5</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0">
                  <li class="dropdown-menu-header border-bottom">
                    <div class="dropdown-header d-flex align-items-center py-3">
                      <h5 class="text-body mb-0 me-auto">Notification</h5>
                      <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="ti ti-mail-opened fs-4"></i></a>
                    </div>
                  </li>
                  <li class="dropdown-notifications-list scrollable-container">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item list-group-item-action dropdown-notifications-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <img src="../../app-assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Congratulation Lettie 🎉</h6>
                            <p class="mb-0">Won the monthly best seller gold badge</p>
                            <small class="text-muted">1h ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Charles Franklin</h6>
                            <p class="mb-0">Accepted your connection</p>
                            <small class="text-muted">12hr ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <img src="../../app-assets/img/avatars/2.png" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">New Message ✉️</h6>
                            <p class="mb-0">You have new message from Natalie</p>
                            <small class="text-muted">1h ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <span class="avatar-initial rounded-circle bg-label-success"><i class="ti ti-shopping-cart"></i></span>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Whoo! You have new order 🛒</h6>
                            <p class="mb-0">ACME Inc. made new order $1,154</p>
                            <small class="text-muted">1 day ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <img src="../../app-assets/img/avatars/9.png" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Application has been approved 🚀</h6>
                            <p class="mb-0">Your ABC project application has been approved.</p>
                            <small class="text-muted">2 days ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <span class="avatar-initial rounded-circle bg-label-success"><i class="ti ti-chart-pie"></i></span>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Monthly report is generated</h6>
                            <p class="mb-0">July monthly financial report is generated</p>
                            <small class="text-muted">3 days ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <img src="../../app-assets/img/avatars/5.png" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Send connection request</h6>
                            <p class="mb-0">Peter sent you connection request</p>
                            <small class="text-muted">4 days ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <img src="../../app-assets/img/avatars/6.png" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">New message from Jane</h6>
                            <p class="mb-0">Your have new message from Jane</p>
                            <small class="text-muted">5 days ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <span class="avatar-initial rounded-circle bg-label-warning"><i class="ti ti-alert-triangle"></i></span>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">CPU is running high</h6>
                            <p class="mb-0">CPU Utilization Percent is currently at 88.63%,</p>
                            <small class="text-muted">5 days ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown-menu-footer border-top">
                    <a href="javascript:void(0);" class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                      View all notifications
                    </a>
                  </li>
                </ul>
              </li>
              <!-- / Notification -->


              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="d-flex align-items-center">
                    <div class="avatar avatar-online me-2">
                      <img src="{{Auth::user()->profile_image_url ?? '\assets\images\user.png'}}" alt class="h-auto rounded-circle" />
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                      <p class="mb-0 me-2">{{ ucwords($user->username) }}</p>
                      <i class="ti ti-chevron-down"></i>
                    </div>
                  </div>
                </a>


                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="{{Auth::user()->profile_image_url ?? '\assets\images\user.png'}}" alt class="h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block">{{ ucwords($user->username) }}</span>
                          <small class="text-muted">{{ ucwords($user->email) }}</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="/informasi/pribadi">
                      <i class="ti ti-user-circle me-2 ti-sm"></i>
                      <span class="align-middle">Profil Saya</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="/lowongan-pekerjaan-tersimpan">
                      <i class="ti ti-briefcase me-2 ti-sm"></i>
                      <span class="align-middle">Lowongan Tersimpan</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="/pengaturan">
                      <i class="ti ti-settings me-2 ti-sm"></i>
                      <span class="align-middle">Pengaturan Akun</span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal" target="_blank">
                      <i class="ti ti-logout me-2 ti-sm"></i>
                      <span class="align-middle">Keluar</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- / User -->
            </ul>
            @endif


            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
              <input type="text" class="form-control search-input border-0" placeholder="Search..." aria-label="Search..." />
              <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
            </div>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Content wrapper -->
          <div class="content-wrapper">


            <!-- Content -->

            <!-- <div class="container-xxl flex-grow-1 container-p-y"> -->
            <!-- <div class="container-xxl flex-grow-1 container-p-y"> -->

            <!-- Modal Delete-->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </button>
                  </div>
                  <div class="modal-body text-center" style="display:block;">
                    Apakah Anda Ingin Keluar Dari Akun Ini?
                  </div>
                  <div class="modal-footer" style="display: flex; justify-content:center;">
                    <a href="{{ route('logout') }}"><button type="button" class="btn btn-success" data-dismiss="modal">Iya</button></a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                  </div>
                </div>
              </div>
            </div>