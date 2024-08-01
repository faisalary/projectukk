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
                        <a href="{{ route('daftar_perusahaan') }}" class="menu-link">
                            <div data-i18n="Mitra Perusahaan">Mitra Perusahaan</div>
                        </a>
                    </li>

                    @role('Mahasiswa')
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
                                <a href="{{ route('lamaran_saya') }}" class="menu-link">
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
                                <a href="{{ route('lowongan_tersimpan') }}" class="menu-link">
                                    <div data-i18n="Lowongan Tersimpan">Lowongan Tersimpan</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endrole

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
            @if (!auth()->check())
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <a href="{{ url('/login') }}">
                        <button class="btn btn-outline-primary me-2" type="button">Masuk</button>
                    </a>
                </ul>
            @else
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <!-- Notification -->
                    <li class="nav-item navbar-dropdown dropdown-notifications dropdown me-3 me-xl-1">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <i class="ti ti-bell ti-md"></i>
                            <span class="badge bg-danger rounded-pill badge-notifications">5</span>
                        </a>
                        @include('partials.notification')
                    </li>
                    <!--/ Notification -->
                    <!-- User -->
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <div class="d-flex justify-content-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ url(Auth::user()->profile_image_url ?? 'assets/images/super-admin.png') }}" alt class="h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block user-name">{{Auth::user()->name ?? 'Unknown User'}}</span>
                                    <small class="text-muted user-status">{{Auth::user()->roles[0]->name ?? 'Unknown Role'}}</small>
                                </div>
                            </div>
                        </a>
                        @include('partials.profile')
                    </li>
                    <!--/ User -->
                </ul>
            </div>
        @endif
    </div>
</nav>
