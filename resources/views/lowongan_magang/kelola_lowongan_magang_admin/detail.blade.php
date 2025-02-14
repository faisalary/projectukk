@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
<a href="{{ $urlBack }}" class="btn btn-outline-primary"><i class="ti ti-arrow-left me-2"></i>Kembali</a>
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
                        <small class="mb-0">Pengajuan: <b>{{Carbon\Carbon::parse($lowongan->created_at)->format('d/m/Y')}}</b></small>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-4">
                        <p @if( $kuotaPenuh ) class="fw-bold text-danger" @endif><i class="ti ti-users me-2"></i>{{ $lowongan->kuota_terisi }}/{{ $lowongan->kuota }} @if( $kuotaPenuh ) (Sudah Penuh) @endif</p>
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
    {{-- Bagian Komentar Penolakan --}}
    @if ($lowongan->statusaprove == 'ditolak' && auth()->user()->hasRole('Mitra'))
    <div class="col" style="max-width: 25%;">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="fw-bolder">Komentar</h5>
                <p class="" style="text-align: justify; text-justify: inter-word; hyphens: auto;">
                    {{ $lowongan->alasantolak }}
                </p>
            </div>
            <div class="card-body border-top" style="margin-top: -20px">
                <p class="text-muted fw-semibold text-xs" style="margin: -6px 0px 10px 0px">Timestamp : {{ \Carbon\Carbon::parse($lowongan->status_time)->format('H.i - d/m/Y') }}</p>
                <p class="text-muted fw-semibold text-xs" style="margin: -6px 0px -6px 0px">Oleh : {{ json_decode($lowongan->status_user)[1] }}</p>
            </div>
        </div>
        <a href="{{route('kelola_lowongan.edit' , $lowongan->id_lowongan)}}" class="btn btn-warning w-100" style="color: #ffa754; background-color: #ffecd9; border-color: #ffa75400;"><i class="tf-icons ti ti-edit mb-1"></i>&nbsp; Perbaiki Lowongan</a>
    </div>
    @endif
    {{-- Bagian Komentar Penolakan : END --}}
    @if (auth()->user()->can('kelola_lowongan_lkm.approval'))
    @include('lowongan_magang/kelola_lowongan_magang_admin/components/card_right_detail')
    @endif
</div>
@if (auth()->user()->can('kelola_lowongan_lkm.approval'))
@include('lowongan_magang/kelola_lowongan_magang_admin/components/modal_detail')
@endif
@endsection

@section('page_script')
<script>
    @if (auth()->user()->can('kelola_lowongan_lkm.approval'))
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
        $('#modalapprove').modal('hide');
        setTimeout(() => {
            window.location.href = "{{ $urlBack }}";
        }, 1500);
    }

    function afterReject(response) {
        $('#modalreject').modal('hide');
        setTimeout(() => {
            window.location.href = "{{ $urlBack }}";
        }, 1500);
    }
    @endif
</script>
@endsection
