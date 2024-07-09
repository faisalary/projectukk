<div class="card mb-4">
    <div class="card-body pb-0">
        <div class="d-flex justify-content-between border-bottom">
            <h5 class="text-secondary">Informasi Pribadi</h5>
            <a href="#" class="text-warning" onclick="editData($(this));" data-target-modal="modalEditInformasi">
                <i class="menu-icon tf-icons ti ti-edit"></i>
            </a>
        </div>
        <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
                @if ($mahasiswa->profile_picture)
                    <img src="{{ url('storage/' . $mahasiswa->profile_picture) }}" alt="profile-image"
                        class="img-fluid rounded mb-3 pt-1 mt-4" style="max-height: 140px; max-width: 180px;"
                        alt="img">
                @else
                    <img src="{{ url('app-assets/img/avatars/14.png') }}" alt="user-avatar"
                        class="img-fluid rounded mb-3 pt-1 mt-4">
                @endif

                <div class="user-info text-center">
                    <h4 class="mb-2">{{ $mahasiswa->namamhs }}</h4>
                    <span class="badge bg-label-success mt-1">{{ $mahasiswa->headliner }}</span>
                </div>
            </div>
        </div>
        <div class="border-bottom mb-3">
            <p class="mt-4 mb-0">{{ $mahasiswa->deskripsi_diri }}</p>
        </div>
        <div class="info-container">
            <ul class="list-unstyled">
                <li class="mb-1">
                    <span class="fw-semibold me-1">NIM:</span>
                    <span>{{ $mahasiswa->nim }}</span>
                </li>
                <li class="mb-2 pt-1">
                    <span class="fw-semibold me-1">Universitas:</span>
                    <span>{{ $mahasiswa->univ->namauniv }}</span>
                </li>
                <li class="mb-2 pt-1">
                    <span class="fw-semibold me-1">Fakultas:</span>
                    <span>{{ $mahasiswa->fakultas->namafakultas }}</span>
                </li>
                <li class="mb-2 pt-1">
                    <span class="fw-semibold me-1">Program Studi:</span>
                    <span>{{ $mahasiswa->prodi->namaprodi }}</span>
                </li>
                <li class="mb-2 pt-1">
                    <span class="fw-semibold me-1">Angkatan:</span>
                    <span>{{ $mahasiswa->angkatan }}</span>
                </li>
                <li class="mb-2 pt-1">
                    <span class="fw-semibold me-1">IPK:</span>
                    <span>{{ $mahasiswa->ipk }}</span>
                </li>
                <li class="mb-2 pt-1">
                    <span class="fw-semibold me-1">EPRT:</span>
                    <span>{{ $mahasiswa->eprt }}</span>
                </li>
                <li class="mb-2 pt-1">
                    <span class="fw-semibold me-1">TAK:</span>
                    <span>{{ $mahasiswa->tak }}</span>
                </li>
                <li class="mb-2 pt-1">
                    <span class="fw-semibold me-1">Email:</span>
                    <span>{{ $mahasiswa->emailmhs }}</span>
                </li>
                <li class="mb-2 pt-1">
                    <span class="fw-semibold me-1">No.Telp:</span>
                    <span>{{ $mahasiswa->nohpmhs }}</span>
                </li>
                <li class="mb-2 pt-1">
                    <span class="fw-semibold me-1">Tanggal Lahir:</span>
                    <span>{{ $mahasiswa->tgl_lahir }}</span>
                </li>
                <li class="mb-2 pt-1">
                    <span class="fw-semibold me-1">Jenis Kelamin:</span>
                    <span>{{ $mahasiswa->gender }}</span>
                </li>
                <li class="mb-2 pt-1">
                    <span class="fw-semibold me-1">Alamat:</span>
                    <span>{{ $mahasiswa->alamatmhs }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
