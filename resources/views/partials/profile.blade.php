@if (auth()->user()->hasRole('mahasiswa'))
<ul class="dropdown-menu dropdown-menu-end">
    <li>
        <a class="dropdown-item" href="{{ url('mahasiswa/profile/pribadi', Auth::user()->nim) }}">
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
@else
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
                        class="fw-semibold d-block">{{ ucwords(auth()->user()->username) }}</span>
                    <small class="text-muted">{{ ucwords(auth()->user()->email) }}</small>
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