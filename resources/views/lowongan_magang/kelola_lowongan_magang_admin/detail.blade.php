@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
<a href="{{ route('lowongan.kelola') }}" class="btn btn-primary"><i class="ti ti-arrow-left me-2"></i>Kembali</a>
<div class="d-flex justify-content-start mt-3">
    <h4 class="fw-bold text-sm">
        <span class="text-muted fw-light text-xs">Lowongan Magang / Kelola Magang /</span>
        {{$lowongan->intern_position}}
    </h4>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body m-3">
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-start align-items-center">
                        @if ($lowongan->industri->image)
                            <img src="{{ asset('storage/' . $lowongan->industri->image) }}" alt="user-avatar" style="max-width:170px; max-height: 140px" id="imgPreview">
                        @else
                            <img src="{{ asset('app-assets/img/avatars/14.png') }}" alt="user-avatar" class="" height="125" width="125" id="imgPreview" data-default-src="{{ asset('app-assets/img/avatars/14.png') }}">
                        @endif
                        <div class="ms-4">
                            <h4 class="fw-bolder mb-0">{{$lowongan->industri?->namaindustri ?? ''}}</h4>
                            <h5 class="fw-lighter text-muted">{{$lowongan->intern_position}}</h5>
                        </div>
                    </div>
                    <div class="d-flex flex-column my-auto align-items-center">
                        @switch($lowongan->statusaprove)
                            @case('ditolak')
                                <div class='badge w-100 bg-label-danger'>{{ucfirst($lowongan->statusaprove)}}</div>
                                @break
                            @case('tertunda')
                                <div class='badge w-100 bg-label-warning'>{{ucfirst($lowongan->statusaprove)}}</div>
                                @break
                            @case('diterima')
                            <div class='badge w-100 bg-label-success'>{{ucfirst($lowongan->statusaprove)}}</div>
                                @break
                            @default
                        @endswitch
                        <h6 class="fw-bolder my-2">Detail Pengajuan</h6>
                        <small class="mb-0">Pengajuan: <b>25/08/2020</b></small>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-4">
                        <p><i class="ti ti-users me-2"></i>{{ $lowongan->kuota }}</p>
                        <p><i class="ti ti-briefcase me-2"></i>{{ $lowongan->pelaksanaan }}</p>
                        <p><i class="ti ti-calendar-time me-2"></i>{{ implode(' dan ', json_decode($lowongan->durasimagang)) }}</p>
                    </div>
                    <div class="col-4 border-start border-end">
                        <p><i class="ti ti-map-pin me-2"></i>{{ implode(', ', json_decode($lowongan->lokasi)) }}</p>
                        <p><i class="ti ti-currency-dollar me-2"></i>{{ $lowongan->nominal_salary ?? '-' }}</p>
                        <p><i class="ti ti-building-community me-2"></i>{{ implode(', ', $lowongan->jenjang_pendidikan) }}</p>
                    </div>
                    <div class="col-4">
                        <p class="mb-2"><i class="ti ti-school me-2"></i>Program Studi</p>
                        <ul class="ps-2 ms-4 mb-0">
                            @foreach ($lowongan->program_studi as $item)
                                <li>{{ $item->namaprodi }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row mt-4 border-top">
                    <div class="col py-3">
                        <h6 class="mb-1">Deskripsi Pekerjaan</h6>
                        <ul class="ps-2 ms-3 mb-0">
                            @foreach (explode(PHP_EOL, $lowongan->deskripsi) as $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col py-3">
                        <h6 class="mb-1">Requirement</h6>
                        <ul class="ps-2 ms-3 mb-0">
                            @foreach (explode(PHP_EOL, $lowongan->requirements) as $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col py-3">
                        <h6 class="mb-1">Benefit</h6>
                        <ul class="ps-2 ms-3 mb-0">
                            @foreach (explode(PHP_EOL, $lowongan->benefitmagang) as $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col py-3">
                        <h6 class="mb-1">Kemampuan</h6>
                        <div class="d-flex justify-content-start">
                            @foreach (json_decode($lowongan->keterampilan) as $item)
                            <span class="badge rounded-pill bg-primary mx-1">{{ $item }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row border-top">
                    @for ($i = 0; $i <= $lowongan->tahapan_seleksi; $i++)
                    <div class="col-12 pt-3">
                        <h6 class="mb-2">Seleksi Tahap {{ ($i + 1) }}</h6>
                        <p class="mb-1"><i class="ti ti-clipboard-list me-2"></i>{{ $lowongan->seleksi_tahap[$i]->deskripsi }}</p>
                        <p class="mb-1">
                            <i class="ti ti-calendar-event me-2"></i>Range Tanggal Pelaksaan:&ensp;
                            <b>{{ Carbon\Carbon::parse($lowongan->seleksi_tahap[$i]->tgl_mulai)->format('d/m/Y') }}</b> &ensp;-&ensp; <b>{{ Carbon\Carbon::parse($lowongan->seleksi_tahap[$i]->tgl_akhir)->format('d/m/Y') }}</b>
                        </p>
                    </div>
                    @endfor 
                </div>
            </div>
        </div>
    </div>
    @include('lowongan_magang/kelola_lowongan_magang_admin/components/card_right_detail')
</div>
@include('lowongan_magang/kelola_lowongan_magang_admin/components/modal_detail')
@endsection

@section('page_script')
<script>
    $('#btn-approve').on('click', function () {
        let btn = $(this);
        let modal = $('#modalapprove');
        modal.modal('show');
    });

    $('#btn-reject').on('click', function () {
        let btn = $(this);
        let modal = $('#modalreject');
        modal.modal('show');
    });

    function afterApprove(response) {
        window.href.location = "{{ route('lowongan.kelola') }}";
    }

    function afterReject(response) {
        window.href.location = "{{ route('lowongan.kelola') }}";
    }
</script>
@endsection