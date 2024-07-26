<div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center">
    <div class="text-center my-4" style="overflow: hidden; width: 100px; height: 100px;">
        @if ($pendaftar->profile_picture)
        <img src="{{ asset('storage/' . $pendaftar->profile_picture) }}" alt="user-avatar" class="d-block" width="100" id="image_industri">
        @else
        <img src="{{ asset('app-assets/img/avatars/user.png') }}" alt="user-avatar" class="d-block" width="100" id="image_industri">
        @endif
    </div>
    <div class="flex-grow-1 mt-0 mt-sm-5">
        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start ms-3 flex-md-row flex-column gap-4">
            <div class="me-2 ms-1">
                <h4 class="mb-0">{{ $pendaftar->namamhs }}</h4>
                <large class="text">{{ $pendaftar->headliner }}</large>
            </div>
            <div class="ms-auto">
                <button class="rounded-circle me-2 btn-label-success btn-icon">
                    <i class="ti ti-mail"></i>
                </button>
                <button class="rounded-circle btn-label-success btn-icon">
                    <i class="ti ti-phone-call"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<h5 class="mt-2"> Mengapa Saya Harus Di Terima?</h5>
<p>{{ $pendaftar->reason_aplicant }}</p>
<hr>
<h5>Informasi Pribadi</h5>
<div class="row">
    <div class="col-3">
        <h6>Nama Lengkap</h6>
        <p>{{ $pendaftar->namamhs }}</p>
    </div>
    <div class="col-3">
        <h6>Tanggal Lahir</h6>
        <p>{{ Carbon\Carbon::parse($pendaftar->tgl_lahir)->format('d F Y') }}</p>
    </div>
    <div class="col-3">
        <h6>Jenis Kelamin</h6>
        <p>{{ $pendaftar->gender }}</p>
    </div>
    <div class="col-3">
        <h6>Warga Negara</h6>
        <p>WNA</p>
    </div>
    <div class="col-3">
        <h6>Negara</h6>
        <p>Jamaika</p>
    </div>
    <div class="col-3">
        <h6>Provisi</h6>
        <p>Stockholm</p>
    </div>
    <div class="col-3">
        <h6>Kota</h6>
        <p>Birmingham</p>
    </div>
    <div class="col-3">
        <h6>Kode Pos</h6>
        <p>203044</p>
    </div>
</div>
<hr>
<h5>Pendidikan</h5>
<div class="card-body pb-0">
    <ul class="timeline ms-1 mb-0">
        @foreach ($education as $item)
        <li class="timeline-item timeline-item-transparent ps-3 pb-3 {{ $loop->last ? 'border-0' : '' }}">
            <span class="timeline-point timeline-point-primary"></span>
            <div class="d-flex justify-content-between position-relative" style="top:-0.3rem;">
                <div class="">
                    <h6>Sekolah/Universitas</h6>
                    <p class="mb-0">{{ $item->name_intitutions }}</p>
                    <small>{{ $item->tingkat }}</small>
                </div>
                <div class="">
                    <h6>Mulai - Akhir</h6>
                    <p>{{ Carbon\Carbon::parse($item->startdate)->format('d/m/Y') }} - {{ Carbon\Carbon::parse($item->enddate)->format('d/m/Y') }}</p>
                </div>
                <div class="">
                    <h6>IPK</h6>
                    <p>{{ $item->nilai }}</p>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>

<hr>
<h5>Pengalaman Kerja</h5>
<div class="card-body pb-0">
    <ul class="timeline ms-1 mb-0">
        @foreach ($experience as $item)
        <li class="timeline-item timeline-item-transparent ps-3 pb-3  {{ $loop->last ? 'border-0' : '' }}">
            <span class="timeline-point timeline-point-primary"></span>
            <div class="position-relative" style="top:-0.3rem;">
                <div class="d-flex justify-content-between px-0">
                    <div class="">
                        <h6>Nama Perusahaan</h6>
                        <p>{{ $item->name_intitutions }}</p>
                    </div>
                    <div class="">
                        <h6>Posisi</h6>
                        <p>{{ $item->posisi }}</p>
                    </div>
                    <div class="">
                        <h6>Mulai - Akhir</h6>
                        <p>{{ Carbon\Carbon::parse($item->startdate)->format('d/m/Y') }} - {{ Carbon\Carbon::parse($item->enddate)->format('d/m/Y') }}</p>
                    </div>
                </div>
                <h6>Deskripsi</h6>
                <p>{{ $item->deskripsi }}.</p>
            </div>
        </li>
        @endforeach
    </ul>
</div>
<hr>
<h5>Keahlian</h5>
@foreach ($skills as $item)
<span class='badge rounded-pill bg-label-primary mx-1'>{{ $item }}</span>
@endforeach
<hr>
<h5>Bahasa</h5>
@foreach ($language as $item)
<span class='badge rounded-pill bg-label-primary mx-1'>{{ $item->bahasa }}</span>
@endforeach