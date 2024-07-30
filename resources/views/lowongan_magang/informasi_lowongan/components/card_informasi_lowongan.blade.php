<div class="card mt-4 border shadow-none border-secondary" style="border-color: #D3D6DB !important">
    <div class="card-body">
        <div class="row">
            <div class="col-2">
                <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload"></figure>
            </div>
            <div class="col-10 d-flex justify-content-between">
                <div>
                    <h5>{{ $data->intern_position }}</h5>
                    <p>{{ $data->deskripsi }}</p>
                </div>
                <div>
                    <span class="badge bg-label-success me-1 text-end">Aktif</span>
                </div>
            </div>
        </div>
        <div class="row gy-3 mt-3">
            <div class="col-md-2 col-6">
                <div class="d-flex align-items-center">
                    <div class="badge rounded-pill bg-label-success me-3 p-2">
                        <i class="ti ti-users ti-sm"></i>
                    </div>
                    <div class="card-info">
                        <small>Total Pelamar</small>
                        <h5 class="mb-0 total_pelamar">{{ $data->total_pelamar }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="d-flex align-items-center">
                    <div class="badge rounded-pill bg-label-success me-3 p-2">
                        <i class="ti ti-files ti-sm"></i>
                    </div>
                    <div class="card-info">
                        <small>Screening</small>
                        <h5 class="mb-0">{{ $data->screening }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="d-flex align-items-center">
                    <div class="badge rounded-pill bg-label-success me-3 p-2">
                        <i class="ti ti-speakerphone ti-sm"></i>
                    </div>
                    <div class="card-info">
                        <small>Proses Seleksi</small>
                        <h5 class="mb-0">{{ $data->proses_seleksi }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="d-flex align-items-center">
                    <div class="badge rounded-pill bg-label-success me-3 p-2">
                        <i class="ti ti-file-report ti-sm"></i>
                    </div>
                    <div class="card-info">
                        <small>Penawaran</small>
                        <h5 class="mb-0">{{ $data->penawaran }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="d-flex align-items-center">
                    <div class="badge rounded-pill bg-label-success me-3 p-2">
                        <i class="ti ti-check ti-sm"></i>
                    </div>
                    <div class="card-info">
                        <small>Diterima</small>
                        <h5 class="mb-0">{{ $data->approved }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="d-flex align-items-center">
                    <div class="badge rounded-pill bg-label-success me-3 p-2">
                        <i class="ti ti-x ti-sm"></i>
                    </div>
                    <div class="card-info">
                        <small>Ditolak</small>
                        <h5 class="mb-0">{{ $data->rejected }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-start">
                <div class="d-flex align-items-center">
                    <i class="ti ti-calendar me-2"></i>
                    <span>{{ Carbon\Carbon::parse($data->startdate)->format('d F Y') }} - {{ Carbon\Carbon::parse($data->enddate)->format('d F Y') }}</span>
                </div>
                <div class="ms-4 d-flex align-items-center">
                    <i class="ti ti-users me-2"></i>
                    <span>Kuota Penerimaan : {{ $data->kuota }}</span>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('lowongan.informasi.detail', $data->id_lowongan) }}" class="btn btn-sm btn-outline-warning">
                    <i class="ti ti-eye me-2"></i>
                    Lihat Kandidat
                </a>
            </div>
        </div>
    </div>
</div>