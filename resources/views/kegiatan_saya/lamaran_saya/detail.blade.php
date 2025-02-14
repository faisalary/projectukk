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
            <div class="row mx-2 border-bottom pb-4">
                <div class="col-6 px-0">
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
                <div class="col-6 px-0">
                    <div class="d-flex flex-column justify-content-end align-items-end">
                        <span>Lamaran terkirim pada <span class="fw-semibold">{{ Carbon\Carbon::parse($pelamar->tanggaldaftar)->format('d F Y') }}</span></span>
                        @if (!$pelamar->lowongan_tersedia)
                        <span class="badge fs-6 bg-label-secondary mt-2">Lowongan sudah ditutup</span>
                        @endif
                        <div class="mt-2">
                            {!! $pelamar->status_badge !!}
                        </div>
                        @if (in_array($pelamar->current_step, ['approved_penawaran', 'rejected_screening', 'rejected_seleksi_tahap_1', 'rejected_seleksi_tahap_2', 'rejected_seleksi_tahap_3']))
                            <a href="{{ asset('storage/' . $pelamar->file_document_mitra) }}" target="_blank" class="text-primary mt-2">
                                <small class="d-flex align-items-center">
                                    <i class="ti ti-file-symlink me-2"></i>
                                    Berkas {{ in_array($pelamar->current_step, ['rejected_screening', 'rejected_seleksi_tahap_1', 'rejected_seleksi_tahap_2', 'rejected_seleksi_tahap_3']) ? 'Penolakan' : 'Penerimaan' }}
                                </small>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mx-2 mt-3">
                @if($pelamar->reason_reject)
                <div class="col-12 px-0 mb-2">
                    <div class="alert alert-danger">
                        <small class="mb-1 fw-bolder">Alasan Ditolak:</small><br>
                        <small class="mb-1">{{ $pelamar->reason_reject }}</small>
                    </div>
                </div>
                @endif
                <div class="col-12 px-0 mb-2">
                    <h5 class="mb-1">Berkas Persyaratan</h5>
                </div>
                <div class="row">
                    @foreach ($dokumen_pendaftaran as $item)
                    <div class="col-4 my-1 px-0">
                        <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="text-primary">
                            <small class="d-flex align-items-center">
                                <i class="ti ti-file-symlink me-2"></i>
                                {{ $item->namadocument }}
                            </small>
                        </a>  
                    </div>
                    @endforeach
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