<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar"
    style="background-color: #FFF !important;">
    <div class="container-xxl">
        <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
            <a href="/" class="app-brand-link gap-2">
                <img src="{{ url('/app-assets/img/Talentern.svg') }}">
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                <i class="ti ti-x ti-sm align-middle"></i>
            </a>
        </div>

        <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0"
            style="box-shadow: none;">
            <div class="container-xxl d-flex h-100" style="width: 62rem;">
                <ul class="menu-inner">

                    <!-- Lowongan Magang -->
                    <li class="menu-item">
                        <a href="/apply-lowongan" class="menu-link">
                            <div data-i18n="Lowongan Magang">Lowongan Magang</div>
                        </a>
                    </li>

                    <!-- Perusahaan -->
                    <li class="menu-item">
                        <a href="/daftar_perusahaan" class="menu-link">
                            <div data-i18n="Mitra Perusahaan">Mitra Perusahaan</div>
                        </a>
                    </li>

                    <!-- Kegiatan Saya -->
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <div data-i18n="Kegiatan Saya">Kegiatan Saya</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="/logbook" class="menu-link">
                                    <div data-i18n="Logbook Mahasiswa">Logbook Mahasiswa</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ url('kegiatan-saya/lamaran-saya') }}" class="menu-link">
                                    <div data-i18n="Status Lamaran Magang">Status Lamaran Magang</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="" class="menu-link">
                                    <div data-i18n="Riwayat Penerimaan Magang">Riwayat Penerimaan Magang
                                    </div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="status/magang" class="menu-link">
                                    <div data-i18n="Status Magang Aktif">Status Magang Aktif</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/nilai/magang" class="menu-link">
                                    <div data-i18n="Nilai Magang">Nilai Magang</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/berkas/akhir" class="menu-link">
                                    <div data-i18n="Berkas Akhir Magang">Berkas Akhir Magang</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/lowongan-pekerjaan-tersimpan" class="menu-link">
                                    <div data-i18n="Lowongan Tersimpan">Lowongan Tersimpan</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Layanan LKM -->
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <div data-i18n="Layanan LKM">Layanan LKM</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="/pengajuan/surat" class="menu-link">
                                    <div data-i18n="Pengajuan Magang">Pengajuan Magang</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/informasi/magang" class="menu-link">
                                    <div data-i18n="Informasi Magang">Informasi Magang</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Tentang Kami -->
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <div data-i18n="Tentang Kami">Tentang Kami</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="/aboutus/talentern" class="menu-link">
                                    <div data-i18n="Talentern">Talentern</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/aboutus/techno" class="menu-link">
                                    <div data-i18n="Techno Infinity">Techno Infinity</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/aboutus/lkmfit" class="menu-link">
                                    <div data-i18n="Layanan Kerjasama dan Magang Fakultas Ilmu Terapan">
                                        Layanan Kerjasama dan Magang Fakultas Ilmu Terapan</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="#footer" class="menu-link">
                            <u>
                                <div data-i18n="Kontak Kami">Kontak Kami</div>
                            </u>
                        </a>
                    </li>


                </ul>
            </div>
        </aside>

        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Login dan Daftar -->

            @php
                $user = Auth::user();
            @endphp
            @if (!$user)

                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <a href="{{ url('/login') }}">
                        <button class="btn btn-outline-success me-2" type="button">Masuk</button>
                    </a>
                </ul>
            @else
                <ul class="navbar-nav flex-row align-items-center ms-auto">
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
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i
                                            class="ti ti-mail-opened fs-4"></i></a>
                                </div>
                            </li>
                            <li class="dropdown-notifications-list scrollable-container">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <img src="{{ url('app-assets/img/avatars/1.png') }}" alt
                                                        class="h-auto rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Congratulation Lettie 🎉</h6>
                                                <p class="mb-0">Won the monthly best seller gold badge
                                                </p>
                                                <small class="text-muted">1h ago</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                        class="badge badge-dot"></span></a>
                                                <a href="javascript:void(0)"
                                                    class="dropdown-notifications-archive"><span
                                                        class="ti ti-x"></span></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
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
                                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span
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
                                                    <img src="{{ url('app-assets/img/avatars/2.png') }}" alt
                                                        class="h-auto rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">New Message ✉️</h6>
                                                <p class="mb-0">You have new message from Natalie</p>
                                                <small class="text-muted">1h ago</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                        class="badge badge-dot"></span></a>
                                                <a href="javascript:void(0)"
                                                    class="dropdown-notifications-archive"><span
                                                        class="ti ti-x"></span></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <span class="avatar-initial rounded-circle bg-label-success"><i
                                                            class="ti ti-shopping-cart"></i></span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Whoo! You have new order 🛒</h6>
                                                <p class="mb-0">ACME Inc. made new order $1,154</p>
                                                <small class="text-muted">1 day ago</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span
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
                                                    <img src="{{ url('app-assets/img/avatars/9.png') }}" alt
                                                        class="h-auto rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Application has been approved 🚀</h6>
                                                <p class="mb-0">Your ABC project application has been
                                                    approved.</p>
                                                <small class="text-muted">2 days ago</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span
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
                                                    <span class="avatar-initial rounded-circle bg-label-success"><i
                                                            class="ti ti-chart-pie"></i></span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Monthly report is generated</h6>
                                                <p class="mb-0">July monthly financial report is
                                                    generated</p>
                                                <small class="text-muted">3 days ago</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span
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
                                                    <img src="{{ url('app-assets/img/avatars/5.png') }}" alt
                                                        class="h-auto rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Send connection request</h6>
                                                <p class="mb-0">Peter sent you connection request</p>
                                                <small class="text-muted">4 days ago</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                        class="badge badge-dot"></span></a>
                                                <a href="javascript:void(0)"
                                                    class="dropdown-notifications-archive"><span
                                                        class="ti ti-x"></span></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <img src="{{ url('app-assets/img/avatars/6.png') }}" alt
                                                        class="h-auto rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">New message from Jane</h6>
                                                <p class="mb-0">Your have new message from Jane</p>
                                                <small class="text-muted">5 days ago</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span
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
                                                    <span class="avatar-initial rounded-circle bg-label-warning"><i
                                                            class="ti ti-alert-triangle"></i></span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">CPU is running high</h6>
                                                <p class="mb-0">CPU Utilization Percent is currently at
                                                    88.63%,</p>
                                                <small class="text-muted">5 days ago</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span
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
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                            data-bs-toggle="dropdown">
                            <div class="avatar avatar-online">
                                <img src="{{ Auth::user()->profile_image_url ?? '\assets\images\user.png' }}" alt
                                    class="h-auto rounded-circle" />
                            </div>
                        </a>
                        @if (Auth::user()->hasRole('user'))
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ url('mahasiswa/profile/pribadi', Auth::user()->nim) }}">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="{{ Auth::user()->profile_image_url ?? '\assets\images\user.png' }}"
                                                        alt class="h-auto rounded-circle" />
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
                                    <a class="dropdown-item"
                                        href="{{ url('mahasiswa/profile/pribadi', Auth::user()->nim) }}">
                                        <i class="ti ti-user-circle me-2 ti-sm"></i>
                                        <span class="align-middle">Profil Saya</span>
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
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        href="{{ route('logout') }}">
                                        <i class="ti ti-logout me-2 ti-sm"></i>
                                        <span class="align-middle">Keluar</span>
                                    </a>
                                </li>
                            </ul>
                        @endif
                        @if (Auth::user()->hasRole('admin'))
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ url('company/profile-company') }}">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="{{ Auth::user()->profile_image_url ?? '\assets\images\user.png' }}"
                                                        alt class="h-auto rounded-circle" />
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
                                    <a class="dropdown-item" href="{{ url('company/profile-company') }}">
                                        <i class="ti ti-user-circle me-2 ti-sm"></i>
                                        <span class="align-middle">Profil Saya</span>
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
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        href="{{ route('logout') }}">
                                        <i class="ti ti-logout me-2 ti-sm"></i>
                                        <span class="align-middle">Keluar</span>
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </li>
                    <!--/ User -->
                </ul>
            </div>
        @endif
    </div>
</nav>
