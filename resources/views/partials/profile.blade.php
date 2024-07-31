@php
    if (auth()->user()->hasRole('Mahasiswa')){
        $url = route('profile');
    }else{
        $url = route('profile_company');
    }
@endphp
<ul class="dropdown-menu dropdown-menu-end">
    {{-- <li>
        <a class="dropdown-item" href="{{ $url }}">
            <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar avatar-online">
                        <img src="{{ Auth::user()->profile_image_url ?? '\assets\images\user.png' }}"
                            alt class="h-auto rounded-circle" />
                    </div>
                </div>
                <div class="flex-grow-1">
                    <span
                        class="fw-semibold d-block">{{ ucwords(auth()->user()->username) }}</span>
                    <small class="text-muted">{{ ucwords(auth()->user()->email) }}</small>
                </div>
            </div>
        </a>
    </li>
    <li>
        <div class="dropdown-divider"></div>
    </li> --}}
    @can('dashboard.dashboard_admin')
        <li>
            <a class="dropdown-item" href="{{ route('dashboard_admin') }}">
                <i class="ti ti-database me-2 ti-sm"></i>
                <span class="align-middle">Dashboard Admin</span>
            </a>
        </li>
    @endcan
    @can('dashboard.dashboard_mitra')
        <li>
            <a class="dropdown-item" href="{{ route('dashboard_company') }}">
                <i class="ti ti-database me-2 ti-sm"></i>
                <span class="align-middle">Dashboard Mitra</span>
            </a>
        </li>
    @endcan
    @can('approval_mhs_doswal.view')
        <li>
            <a class="dropdown-item" href="{{ route('approval_mahasiswa') }}">
                <i class="ti ti-database me-2 ti-sm"></i>
                <span class="align-middle">Dashboard Dosen</span>
            </a>
        </li>
    @endcan
    @can('approval_mhs_kaprodi.view')
        <li>
            <a class="dropdown-item" href="{{ route('approval_mahasiswa_kaprodi') }}">
                <i class="ti ti-database me-2 ti-sm"></i>
                <span class="align-middle">Dashboard Kaprodi</span>
            </a>
        </li>
    @endcan
    <li>
        <a class="dropdown-item"
            href="{{ $url }}">
            <i class="ti ti-user-circle me-2 ti-sm"></i>
            <span class="align-middle">Profil</span>
        </a>
    </li>
    {{-- <li>
        <a class="dropdown-item" href="/pengaturan">
            <i class="ti ti-settings me-2 ti-sm"></i>
            <span class="align-middle">Pengaturan Akun</span>
        </a> --}}
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