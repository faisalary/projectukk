@extends('partials.horizontal_menu')

@section('page_style')
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-start">
        <a href="{{ route('lamaran_saya') }}" class="btn btn-outline-primary">
            <i class="ti ti-arrow-left"></i>
            Kembali
        </a>
    </div>
    <div class="d-flex justify-content-start mt-2">
        <h4><span class="text-muted">Kegiatan saya&ensp;/&ensp;Status Lamaran Saya&ensp;/&ensp;</span>Detail</h4>
    </div>
    <div class="my-5 position-relative">
        {!! $pelamar->step_status !!}
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row border-bottom pb-4">
                <div class="col-6">
                    <div class="d-flex justify-content-start">
                        <div class="text-center" style="overflow: hidden; width: 100px; height: 100px;">
                            @if ($pelamar->image)
                            <img src="{{ asset('storage/' . $pelamar->image) }}" alt="user-avatar" class="d-block" width="100" id="image_industri">
                            @else
                            <img src="{{ asset('app-assets/img/avatars/user.png') }}" alt="user-avatar" class="d-block" width="100" id="image_industri">
                            @endif
                        </div>
                        <div class="d-flex flex-column justify-content-center ms-3">
                            <h4 class="mb-1">{{ $pelamar->intern_position }}</h4>
                            <span>{{ $pelamar->namaindustri }}</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-start mt-2">
                            <i class="ti ti-map-pin"></i>
                            <span class="ms-2">{{ implode(', ', json_decode($pelamar->lokasi)) }}</span>
                        </div>
                        <div class="d-flex justify-content-start mt-2">
                            <i class="ti ti-currency-dollar"></i>
                            @if (empty($pelamar->nominal_salary))
                            <span class="ms-2">Tidak Berbayar</span>
                            @else
                            <span class="ms-2">{{ $pelamar->nominal_salary }}</span>
                            @endif
                        </div>
                        <div class="d-flex justify-content-start mt-2">
                            <i class="ti ti-calendar-time"></i>
                            <span class="ms-2">{{ implode(', ', json_decode($pelamar->durasimagang)) }}</span>
                        </div>
                        <div class="d-flex justify-content-start mt-2">
                            <i class="ti ti-users"></i>
                            <span class="ms-2">{{ $pelamar->kuota }} Kuota Penerimaan</span>
                        </div>
                        <div class="d-flex justify-content-start mt-4">
                            <a href="{{ route('lamaran_saya.detail_lowongan', $pelamar->id_pendaftaran) }}" class="btn btn-sm btn-outline-primary">
                                <i class="ti ti-eye"></i>
                                <span class="ms-2">Lihat Detail Pekerjaan</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column justify-content-end align-items-end">
                        <span>Lamaran terkirim pada <span class="fw-semibold">{{ Carbon\Carbon::parse($pelamar->tanggaldaftar)->format('d F Y') }}</span></span>
                        @if (!$pelamar->lowongan_tersedia)
                        <span class="badge fs-6 bg-label-secondary mt-2">Lowongan sudah ditutup</span>
                        @endif
                        <div class="mt-2">
                            {!! $pelamar->status_badge !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 mb-2">
                    <span class="fw-semibold">Portofolio</span>
                </div>
                <div class="col-12 d-flex justify-content-start">
                    <i class="ti ti-file-symlink"></i>
                    <span class="ms-2">anfkwankfnwakfnwakfwajfkjaw.pdf</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_script')
<script>

</script>
@endsection