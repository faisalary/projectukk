@extends('partials_mahasiswa.template')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <style>

    </style>
@endsection

@section('page_style')
    <style>
        .hidden {
            display: none;
        }

        .page-item>.page-link.active {
            border-color: #4EA971 !important;
            background-color: #4EA971 !important;
            color: #fff;
        }

        .btn-success {
            color: #fff;
            background-color: #4EA971 !important;
            border-color: #4EA971 !important;
        }
    </style>
@endsection

@section('main')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-md-12 col-12 mt-3">
            <h4 class="fw-bold"><span class="text-muted fw-light">Layanan LKM /</span> Pengajuan Surat Pengantar Magang</h4>
        </div>

        {{-- Belum melakukan konfirmasi lowongan magang --}}

        <div class="col-3 mt-3 ">
            <img class="image" style="border-radius: 0%; margin-left: 400px; width:430px;"
                src="{{ asset('front/assets/img/pengantar_magang.png') }}" alt="admin.upload">
        </div>
        <div class="sec-title mt-5 mb-4 text-center">
            <h4>Anda belum mengajukan Surat Pengantar Magang</h4>
        </div>

        {{-- Sudah melakukan konfirmasi lowongan magang --}}
        {{-- <div class="card mb-4" style="background-color: #f8f7fa;">
            <div class="card-header p-3" style="background-color: #23314B;">
                <div class="row">
                    <div class="col-6">
                        <h4 class="mb-0 ps-2" style="color: #FFFFFF;">Riwayat Pengajuan Surat Pengantar Magang</h4>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-9">
                                <div class="input-group input-group-merge ">
                                    <span class="input-group-text" id="basic-addon-search31"><i
                                            class="ti ti-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Surat Pengantar Magang"
                                        aria-label="Search..." aria-describedby="basic-addon-search31">
                                </div>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-success waves-effect waves-light">Cari
                                    Sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body mt-4">
                <div class="row border-bottom">
                    <div class="col-2">
                        <figure class="image text-center" style="border-radius: 0%;"><img
                                style="border-radius: 0%; width:100px;" src="{{ asset('front/assets/img/letter.png') }}"
                                alt="admin.upload">
                        </figure>
                    </div>
                    <div class="col-8">
                        <h2>UI/UX Designer</h2>
                        <p>PT Techno Infinity</p>
                        <p>Jl. Mars Sel. X No.19B, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286</p>
                        <div class="text-left mb-3">
                            <button type="button" class="btn btn-success waves-effect me-2" data-bs-toggle="modal"
                                data-bs-target="#modalDiterima">Diterima</button>
                            <button type="button" class="btn btn-danger waves-effect" data-bs-toggle="modal"
                                data-bs-target="#modalDitolak">Ditolak</button>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="text-end ps-5"> <i class="ti ti-clock"> </i> 8 hari lalu</div>
                        <div class="text-end mt-3"><span class="badge bg-label-success">Disetujui</span></div>
                        <div class="text-end mt-3 mb-4" style="color: #0971B7;"><u class="cursor-pointer"
                                data-bs-toggle="modal" data-bs-target="#modalDetailDisetujui">
                                Lihat Detail
                            </u><i class="ti ti-chevron-right mb-1"></i></div>
                    </div>
                </div>
                <div class="row border-bottom mt-4">
                    <div class="col-2">
                        <figure class="image text-center" style="border-radius: 0%;"><img
                                style="border-radius: 0%; width:100px;" src="{{ asset('front/assets/img/letter.png') }}"
                                alt="admin.upload">
                        </figure>
                    </div>
                    <div class="col-8">
                        <h2>UI/UX Designer</h2>
                        <p>PT Techno Infinity</p>
                        <p>Jl. Mars Sel. X No.19B, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286</p>
                        <div class="text-left mb-3">
                            <button type="button" class="btn btn-success waves-effect me-2" data-bs-toggle="modal"
                                data-bs-target="#modalDiterima">Diterima</button>
                            <button type="button" class="btn btn-danger waves-effect" data-bs-toggle="modal"
                                data-bs-target="#modalDitolak">Ditolak</button>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="text-end ps-5"> <i class="ti ti-clock"> </i> 8 hari lalu</div>
                        <div class="text-end mt-3"><span class="badge bg-label-success">Disetujui</span></div>
                        <div class="text-end mt-3 mb-4" style="color: #0971B7;"><u class="cursor-pointer"
                                data-bs-toggle="modal" data-bs-target="#modalDetailDisetujui">
                                Lihat Detail
                            </u><i class="ti ti-chevron-right mb-1"></i></div>
                    </div>
                </div>
                <div class="row border-bottom mt-4">
                    <div class="col-2">
                        <figure class="image text-center" style="border-radius: 0%;"><img
                                style="border-radius: 0%; width:100px;" src="{{ asset('front/assets/img/letter.png') }}"
                                alt="admin.upload">
                        </figure>
                    </div>
                    <div class="col-8">
                        <h2>UI/UX Designer</h2>
                        <p>PT Techno Infinity</p>
                        <p>Jl. Mars Sel. X No.19B, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286</p>
                    </div>
                    <div class="col-2">
                        <div class="text-end ps-5"> <i class="ti ti-clock"> </i> 8 hari lalu</div>
                        <div class="text-end mt-3"><span class="badge bg-label-danger">Ditolak</span></div>
                        <div class="text-end mt-3"><button type="button"
                                class="btn btn-outline-danger waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target="#modalEdit" style="height:35px;"> <i class="ti ti-edit mb-1 me-1"></i>
                                Perbaiki Pengajuan</button></div>
                        <div class="text-end mt-3 mb-4" style="color: #0971B7;"><u class="cursor-pointer"
                                data-bs-toggle="modal" data-bs-target="#modalDetailDitolak">
                                Lihat Detail
                            </u><i class="ti ti-chevron-right mb-1"></i></div>
                    </div>
                </div>
            </div>
        </div> --}}
        @include('pengajuan_magang.mandiri.modal')

        <div class="text-center">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAjukan">
                Ajukan Surat
            </button>
        </div>

    </div>
@endsection

@section('page_script')
    <script>
        $(".flatpickr-date").flatpickr({
            altInput: true,
            altFormat: 'j F Y',
            dateFormat: 'Y-m-d'
        });
    </script>
@endsection
