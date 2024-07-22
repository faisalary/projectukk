@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
<div class="d-flex justify-content-start">
    <a href="{{ $urlBack }}" class="btn btn-outline-primary">
        <i class="ti ti-arrow-left"></i>&ensp;
        Kembali
    </a>
</div>
<div class="d-flex justify-content-start mt-3">
    <h4><span class="text-muted">Approval Mahasiswa</span>&ensp;/&ensp;Detail Mahasiswa</h4>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-5">
                <div class="d-flex justify-content-start">
                    <div class="text-center" style="overflow: hidden; width: 125px; height: 125px;">
                        <img src="{{ asset('app-assets/img/avatars/user.png') }}" alt="user-avatar" class="d-block" width="125" id="image_industri" data-default-src="{{ asset('app-assets/img/avatars/user.png') }}">
                    </div>
                    <div class="d-flex flex-column justify-content-center ms-4">
                        <h2 class="fw-bolder mb-1">{{ $data->namamhs }}</h2>
                        <h6>{{ $data->intern_position }}</h6>
                    </div>
                </div>
                <div class="border-bottom">
                    <h4 class="fw-semibold mt-5">Mengapa Saya harus diterima?</h4>
                    <p>{{ $data->reason_aplicant }}</p>
                </div>
                <div class="border-bottom mt-3">
                    <h4 class="fw-semibold">Informasi Pribadi</h4>
                    <h5 class="mb-1">Deskripsi Diri</h5>
                    <p>{{ $data->deskripsi_diri }}</p>
                    <table class="mb-3" style="width:100%;">
                        <tbody>
                            <tr>
                                <td class="pb-2"><span class="fw-bolder">NIM</span> : {{ $data->nim }}</td>
                                <td class="pb-2"><span class="fw-bolder">TAK</span> : {{ $data->tak }}</td>
                            </tr>
                            <tr>
                                <td class="pb-2"><span class="fw-bolder">Universitas</span> : {{ $data->namauniv }}</td>
                                <td class="pb-2"><span class="fw-bolder">Email</span> : {{ $data->email }}</td>
                            </tr>
                            <tr>
                                <td class="pb-2"><span class="fw-bolder">Fakultas</span> : {{ $data->namafakultas }}</td>
                                <td class="pb-2"><span class="fw-bolder">No. Telp</span> : {{ $data->nohpmhs }}</td>
                            </tr>
                            <tr>
                                <td class="pb-2"><span class="fw-bolder">Angkatan</span> : {{ $data->angkatan }}</td>
                                <td class="pb-2"><span class="fw-bolder">Jenis Kelamin</span> : {{ $data->gender }}</td>
                            </tr>
                            <tr>
                                <td class="pb-2"><span class="fw-bolder">IPK</span> : {{ $data->ipk }}</td>
                                <td class="pb-2"><span class="fw-bolder">Alamat</span> : {{ $data->alamatmhs }}</td>
                            </tr>
                            <tr>
                                <td class="pb-2"><span class="fw-bolder">EPRT</span> : {{ $data->eprt }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="border-bottom mt-3">
                    <h4>Pendidikan</h4>
                    <ul class="timeline ps-3 mb-0">
                        @foreach ($data->education as $key => $item)
                        <li class="ps-5 timeline-item timeline-item-transparent {{ ($key+1) == count($data->education) ? 'border-0' : '' }}">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event pe-0">
                                <div class="timeline-header mb-2">
                                    <h5 class="fw-bolder mb-0">{{ $item->name_intitutions }}</h5>
                                </div>
                                <p class="mb-1">{{ $item->tingkat }}</p>
                                <p class="mb-1">{{ $item->nilai }}</p>
                                <small>{{ Carbon\Carbon::parse($item->startdate)->format('F Y') }}&ensp;-&ensp;{{ Carbon\Carbon::parse($item->enddate)->format('F Y') }}</small>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="border-bottom mt-3">
                    <h4>Pengalaman</h4>
                    <ul class="timeline ps-3 mb-0">
                        @foreach ($data->experience as $key => $item)
                        <li class="ps-5 timeline-item timeline-item-transparent {{ ($key+1) == count($data->experience) ? 'border-0' : '' }}">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event pe-0">
                                <div class="timeline-header mb-2">
                                    <h5 class="fw-bolder mb-0">{{ $item->name_intitutions }}</h5>
                                </div>
                                <p class="mb-1">{{ $item->posisi }}</p>
                                <small>{{ Carbon\Carbon::parse($item->startdate)->format('F Y') }}&ensp;-&ensp;{{ Carbon\Carbon::parse($item->enddate)->format('F Y') }}</small>
                                <p>{{ $item->deskripsi }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="border-bottom mt-3">
                    <h4 class="mb-3">Keahlian</h4>
                    <div class="d-flex justify-content-start mb-3">
                        <span class="badge rounded-pill mx-1 bg-primary">Check</span>
                        <span class="badge rounded-pill mx-1 bg-primary">Check</span>
                        <span class="badge rounded-pill mx-1 bg-primary">Check</span>
                    </div>
                </div>
                <div class="mt-3">
                    <h4>Dokumen Pendukung</h4>
                    <div>
                        @foreach ($data->sertifikat as $key => $item)
                        <div class="mb-3 pb-3 {{ ($key+1) != count($data->sertifikat) ? 'border-bottom' : '' }}">
                            <div class="d-flex justify-content-between mb-1">
                                <h5 class="mb-0">{{ $item->nama_sertif }}</h5>
                            </div>
                            <p class="mb-1" style="font-size: small">{{ $item->penerbit }}</p>
                            <p class="mb-1">{{ Carbon\Carbon::parse($item->startdate)->format('F Y') }}&ensp;-&ensp;{{ Carbon\Carbon::parse($item->enddate)->format('F Y') }}</p>
                            <p class="mb-1">{{ $item->deskripsi }}</p>
                            <div class="d-flex justfiy-content-start align-items-center">
                                <a href="#" target="_blank" class="text-decoration-underline">
                                    UI UX Website.pdf
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
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
