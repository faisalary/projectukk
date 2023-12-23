@extends('partials_admin.template')

@section('page_style')
<link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
<style>
    .tooltip-inner {
        min-width: 100%;
        max-width: 100%;
    }

    .position-relative {
        padding-right: 15px;
        padding-left: 15px;
    }

    h6,
    .h6 {
        font-size: 0.9375rem;
        margin-bottom: 0px;
    }

    #more {
        display: none;
    }

    span.select2-selection.select2-selection--single {
        width: 200px;
    }
</style>

@endsection

@section('main')
<div class="row">
    <div class="col-md-12 col-12">
        <nav aria-label="breadcrumb">
            <h4>
                <ol class="breadcrumb breadcrumb-style1">
                    @can( "title.info.lowongan.admin")
                    <li class="breadcrumb-item text-secondary">
                        Informasi Mitra
                    </li>
                    @endcan
                    <li class="breadcrumb-item">
                        <a class="text-secondary">Informasi Lowongan</a>
                    </li>
                    @foreach($pendaftar as $item)
                    <li class="breadcrumb-item active">Lowongan {{$item->lowonganMagang->intern_position}} Periode 21 April - 14 Juni 2023</li>
                    @endforeach
                </ol>
            </h4>
        </nav>
        <!-- <h4 class="fw-bold"><span class="text-muted fw-light">Lowongan Magang /</span> <span class="text-muted fw-light">Informasi Lowongan /</span> Fullstack Developer - Tahun Ajaran 2324</h4> -->
    </div>
    <div class="col-9"></div>
    <div class="col-md-3 col-12 mb-3 d-flex align-items-center justify-content-between">
        <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
            <option value="1">2023/2024 Genap</option>
            <option value="2">2023/2024 Ganjil</option>
            <option value="3">2022/2023 Genap</option>
            <option value="4">2022/2023 Ganjil</option>
            <option value="5">2021/2022 Genap</option>
            <option value="6">2021/2022 Ganjil</option>
        </select>
        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide"><i class="tf-icons ti ti-filter"></i>
        </button>
    </div>
</div>

<div class="col-xl-12">
    <div class="nav-align-top">
        <ul class="nav nav-pills mb-3 " role="tablist">
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link active showSingle" target="1" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-kandidat" aria-controls="navs-pills-justified-kandidat" aria-selected="true" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-users ti-xs me-1"></i> Data Kandidat
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;">3</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class=" nav-link showSingle" target="2" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-screening" aria-controls="navs-pills-justified-screening" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-files ti-xs me-1"></i> Screening
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;">1</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="3" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tahap1" aria-controls="navs-pills-justified-tahap1" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-user-device-desktop-analytics ti-xs me-1"></i> Seleksi Tahap 1
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;">1</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="4" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tahap2" aria-controls="navs-pills-justified-tahap2" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-user-device-desktop-analytics ti-xs me-1"></i> Seleksi Tahap 2
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;">1</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="5" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-penawaran" aria-controls="navs-pills-justified-penawaran" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-writing-sign ti-xs me-1"></i> Penawaran
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;">2</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="6" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-diterima" aria-controls="navs-pills-justified-diterima" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-user-check ti-xs me-1"></i> Diterima
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;">1</span>
                </button>
            </li>
            <li class="nav-item" style="font-size: small;">
                <button type="button" class="nav-link showSingle" target="7" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-ditolak" aria-controls="navs-pills-justified-ditolak" aria-selected="false" style="padding: 8px 9px;">
                    <i class="tf-icons ti ti-user-x ti-xs me-1"></i> Ditolak
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;">1</span>
                </button>
            </li>
        </ul>
    </div>

    <div class="row cnt">
        <div class="col-8 text-secondary mb-3">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Program Studi : D3 Rekayasa Perangkat Lunak Aplikasi, Fakultas : Ilmu Terapan, Universitas : Tel-U Jakarta" id="tooltip-filter"></i></div>
        @foreach(['2','3','4','5'] as $statusId)
        @if($statusId == 2)
        @can("ubah.lowongan.admin")
        <div id="div{{$statusId}}" class="col-xl-1 targetDiv" style="display: none;">

            <div class="col-md-4 col-12 mb-3 d-flex align-items-center justify-content-between">
                <select class="select2 form-select" data-placeholder="Ubah Status Kandidat">
                    <option disabled selected>Ubah Status Kandidat</option>
                    <option>Screening</option>
                    <option>Ditolak</option>
                </select>
                <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide" style="min-width: 142px;"><i class="tf-icons ti ti-checks"> Terapkan</i>
                </button>
            </div>
        </div>
        @endcan
        @else
        @can("ubah.lowongan.mitra")
        <div id="div{{$statusId}}" class="col-xl-1 targetDiv" style="display: none;">

            <div class="col-md-4 col-12 mb-3 d-flex align-items-center justify-content-between">
                <select class="select2 form-select" data-placeholder="Ubah Status Kandidat">
                    <option disabled selected>Ubah Status Kandidat</option>
                    <option>Seleksi Tahap 1</option>
                    <option>Seleksi Tahap 2</option>
                    <option>Penawaran</option>
                </select>
                <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide" style="min-width: 142px;"><i class="tf-icons ti ti-checks"> Terapkan</i>
                </button>
            </div>
        </div>
        @endcan
        @endif

        @endforeach
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="modalSlide" aria-labelledby="offcanvasAddUserLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddUserLabel" class="offcanvas-title" style="padding-left: 15px;">Filter Berdasarkan</h5>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
            <form class="add-new-user pt-0" id="filter">
                <div class="col-12 mb-2">
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="univ" class="form-label" style="padding-left: 15px;">Universitas</label>
                            <select class="form-select select2" id="univ" name="univ" data-placeholder="Pilih Universitas">
                                <option disabled selected>Pilih Universitas</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-2">
                            <label for="fakultas" class="form-label" style="padding-left: 15px;">Fakultas</label>
                            <select class="form-select select2" id="fakultas" name="fakultas" data-placeholder="Pilih Fakultas">
                                <option disabled selected>Pilih Fakultas</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="univ" class="form-label" style="padding-left: 15px;">Prodi</label>
                            <select class="form-select select2" id="prodi" name="prodi" data-placeholder="Pilih Prodi">
                                <option disabled selected>Pilih Prodi</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row cnt">
                        <div id="div1" class="targetDiv">
                            <div class="col mb-2 form-input">
                                <label for="univ" class="form-label" style="padding-left: 15px;">Status Kandidat</label>
                                <select class="form-select select2" id="status" name="status" data-placeholder="Status Kandidat">
                                    <option disabled selected>Pilih Status Kandidat</option>
                                    <option>Screening</option>
                                    <option>Seleksi Tahap 1</option>
                                    <option>Seleksi Tahap 2</option>
                                    <option>Penawaran</option>
                                    <option>Diterima</option>
                                    <option>Ditolak</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 text-end">
                    <button type="button" class="btn btn-label-danger">Reset</button>
                    <button type="submit" class="btn btn-success">Terapkan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="tab-content p-0">
        @foreach(['kandidat', 'screening','tahap1','tahap2','penawaran','diterima','ditolak'] as $tableId)
        <div class="tab-pane fade show {{$loop->iteration == 1 ? 'active' : ''}}" id="navs-pills-justified-{{$tableId}}" role="tabpanel">
            <div class="card">
                @foreach($pendaftar as $item)
                <div class="row mt-3 ms-2">
                    <div class="col-6 d-flex align-items-center" style="border: 2px solid #D3D6DB; max-width:420px; height:40px;border-radius:8px;">
                        <span style="color:#4B465C;">Total Kandidat {{$item->lowonganMagang->intern_position}}:</span>&nbsp;<span style="color:#7367F0;">50</span>&nbsp;<span style="color:#4EA971;"> Kandidat Melamar </span>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-end" style="margin-left:180px;">
                        <span style="color:#4B465C;">Batas Konfirmasi Penerimaan :</span>&nbsp;<span style="color:#4EA971;">{{($item->lowonganMagang->date_confirm_closing?->format('d-m-Y'))}}</span>
                    </div>
                </div>
                @endforeach

                <div class="card-datatable table-responsive">
                    <table class="table tab1c" id="{{$tableId}}" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="min-width: auto;">NOMOR</th>
                                <th style="min-width:100px;">NAMA</th>
                                <th style="min-width:100px;">NO TELEPON </th>
                                <th style="min-width:150px;">EMAIL</th>
                                <th style="min-width:150px;">PROGRAM STUDI</th>
                                <th style="min-width:100px;">FAKULTAS</th>
                                <th style="min-width:150px;">UNIVERSITAS</th>
                                <th style="min-width:150px;">TANGGAL DAFTAR</th>
                                <th style="min-width:100px;">STATUS</th>
                                <th style="min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        @endforeach

        <!-- pop-up detail -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="modalslide" aria-labelledby="offcanvasAddUserLabel" style="width: 750px;">
            <div class="offcanvas-header">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="" style="min-width: 220px;"><i class="tf-icons ti ti-file-symlink"> Unduh Format CV</i>
                        </button>
                        <select class="select2 form-select" data-placeholder="Ubah Status Kandidat">
                            <option disabled selected>Ubah Status Kandidat</option>
                            <option>Screening</option>
                            <option>Seleksi Tahap 1</option>
                            <option>Seleksi Tahap 2</option>
                            <option>Penawaran</option>
                            <option>Diterima</option>
                            <option>Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                            <img src="../../app-assets/img/avatars/2.png" alt="user image" class="d-block h-auto ms-0 ms-sm-4 mt-4  rounded user-profile-img" />
                        </div>
                        <div class="flex-grow-1 mt-0 mt-sm-5">
                            <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start ms-3 flex-md-row flex-column gap-4">
                                <div class="me-2 ms-1">
                                    <h4 class="mb-0">Cecilia Payne</h4>
                                    <large class="text">UI UX Designer</large>
                                </div>
                                <div class="ms-auto">
                                    <button class="rounded-circle btn-label-success btn-icon btn-sm waves-effect" style="min-width: 40px; height:40px;">
                                        <i class="ti ti-mail" style="font-size: 25px;"></i>
                                    </button>
                                    <button class="rounded-circle btn-label-success btn-icon btn-sm waves-effect" style="min-width: 40px; height:40px;">
                                        <i class="ti ti-phone-call" style="font-size: 25px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5> Mengapa Saya Harus Di Terima?</h5>
                <p class="cursor-pointer">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an <span id="dots">...</span><span id="more"> unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span> <u onclick="myFunction()" id="myBtn" style="color:#4EA971">Lebih Banyak</u></p>
                <hr>
                <h5>Informasi Pribadi</h5>
                <div class="row">
                    <div class="col-3">
                        <h6>Nama Lengkap</h6>
                        <p>Cecilia Payne</p>
                    </div>
                    <div class="col-3">
                        <h6>Tanggal Lahir</h6>
                        <p>25 Desember 2020</p>
                    </div>
                    <div class="col-3">
                        <h6>Jenis Kelamin</h6>
                        <p>Perempuan</p>
                    </div>
                    <div class="col-3">
                        <h6>Marital Status</h6>
                        <p>Belum Menikah</p>
                    </div>

                </div>
                <div class="row mt-2">
                    <div class="col-3">
                        <h6>Warga Negara</h6>
                        <p>WNA</p>
                    </div>
                    <div class="col-2">
                        <h6>Negara</h6>
                        <p>Jamaika</p>
                    </div>
                    <div class="col-2">
                        <h6>Provisi</h6>
                        <p>Stockholm</p>
                    </div>
                    <div class="col-2">
                        <h6>Kota</h6>
                        <p>Birmingham</p>
                    </div>
                    <div class="col-2">
                        <h6>Kode Pos</h6>
                        <p>203044</p>
                    </div>

                </div>
                <hr>
                <h5>Pendidikan</h5>
                <div class="card-body pb-0">
                    <ul class="timeline ms-1 mb-0">
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-success"></span>
                            <div class="row">
                                <div class="col-3">
                                    <h6>Sekolah/Universitas</h6>
                                    <p>Glasgow University</p>
                                </div>
                                <div class="col-2">
                                    <h6>Tingkat </h6>
                                    <p>Bachelor</p>
                                </div>
                                <div class="col-4">
                                    <h6>Mulai - Akhir</h6>
                                    <p>18/10/2011 - 18/10/2015</p>
                                </div>
                                <div class="col-2">
                                    <h6>IPK</h6>
                                    <p>3.89/4.00</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent border-0">
                            <span class="timeline-point timeline-point-success"></span>
                            <div class="row">
                                <div class="col-3">
                                    <h6>Sekolah/Universitas</h6>
                                    <p>Glasgow University</p>
                                </div>
                                <div class="col-2">
                                    <h6>Tingkat</h6>
                                    <p>Bachelor</p>
                                </div>
                                <div class="col-4">
                                    <h6>Mulai - Akhir</h6>
                                    <p>18/10/2011 - 18/10/2015</p>
                                </div>
                                <div class="col-2">
                                    <h6>IPK</h6>
                                    <p>3.89/4.00</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <hr>
                <h5>Pengalaman Kerja</h5>
                <div class="card-body pb-0">
                    <ul class="timeline ms-1 mb-0">
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-success"></span>
                            <div class="row">
                                <div class="col-4">
                                    <h6>Nama Perusahaan</h6>
                                    <p>PT ABCD</p>
                                </div>
                                <div class="col-4">
                                    <h6>Posisi</h6>
                                    <p>Product Designer</p>
                                </div>
                                <div class="col-4">
                                    <h6>Mulai - Akhir</h6>
                                    <p>18/10/2011 - 18/10/2015</p>
                                </div>
                                <h6>Deskripsi</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in.</p>
                            </div>

                        </li>
                        <li class="timeline-item timeline-item-transparent border-0">
                            <span class="timeline-point timeline-point-success"></span>

                            <div class="row">
                                <div class="col-4">
                                    <h6>Nama Perusahaan</h6>
                                    <p>PT ABCD</p>
                                </div>
                                <div class="col-4">
                                    <h6>Posisi</h6>
                                    <p>Product Designer</p>
                                </div>
                                <div class="col-4">
                                    <h6>Mulai - Akhir</h6>
                                    <p>18/10/2011 - 18/10/2015</p>
                                </div>
                                <h6>Deskripsi</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in.</p>
                            </div>

                        </li>
                    </ul>
                </div>
                <hr>
                <h5>Keahlian</h5>
                <span class='badge rounded-pill bg-label-success me-1'>Figma</span>
                <span class='badge rounded-pill bg-label-success me-1'>Figma</span>
                <span class='badge rounded-pill bg-label-success me-1'>Figma</span>
                <span class='badge rounded-pill bg-label-success me-1'>Figma</span>
                <hr>
                <h5>Bahasa</h5>
                <span class='badge rounded-pill bg-label-success me-1'>Inggris</span>
                <span class='badge rounded-pill bg-label-success me-1'>Inggris</span>
                <span class='badge rounded-pill bg-label-success me-1'>Inggris</span>
                <span class='badge rounded-pill bg-label-success me-1'>Inggris</span>
            </div>
        </div>

    </div>
    @endsection

    @section('page_script')
    <script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="../../app-assets/js/forms-extras.js"></script>
    <script>
        // var jsonData = [{
        //         "nomor": "1",
        //         "nama": "Andika Alatas 6701228083",
        //         "no": "+6281298076589",
        //         "email": "dikta@gmail.com",
        //         "prodi": "D3 Sistem Informasi",
        //         "fakultas": "Ilmu Terapan",
        //         "universitas": "Telkom Bandung",
        //         "status": "<span class='badge bg-label-secondary me-1'>Belum Proses</span>",
        //         "aksi": "<a data-bs-toggle='offcanvas' data-bs-target='#modalslide' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        //     },
        //     {
        //         "nomor": "2",
        //         "nama": "Andika Alatas 6701228083",
        //         "no": "+6281298076589",
        //         "email": "dikta@gmail.com",
        //         "prodi": "D3 Sistem Informasi",
        //         "fakultas": "Ilmu Terapan",
        //         "universitas": "Telkom Bandung",
        //         "status": "<span class='badge bg-label-warning me-1'>Screening</span>",
        //         "aksi": "<a data-bs-toggle='offcanvas' data-bs-target='#modalslide' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        //     },
        //     {
        //         "nomor": "3",
        //         "nama": "Andika Alatas 6701228083",
        //         "no": "+6281298076589",
        //         "email": "dikta@gmail.com",
        //         "prodi": "D3 Sistem Informasi",
        //         "fakultas": "Ilmu Terapan",
        //         "universitas": "Telkom Bandung",
        //         "status": "<span class='badge bg-label-success me-1'>Diterima</span>",
        //         "aksi": "<a data-bs-toggle='offcanvas' data-bs-target='#modalslide' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        //     },
        //     {
        //         "nomor": "4",
        //         "nama": "Andika Alatas 6701228083",
        //         "no": "+6281298076589",
        //         "email": "dikta@gmail.com",
        //         "prodi": "D3 Sistem Informasi",
        //         "fakultas": "Ilmu Terapan",
        //         "universitas": "Telkom Bandung",
        //         "status": "<span class='badge bg-label-danger me-1'>Ditolak</span>",
        //         "aksi": "<a data-bs-toggle='offcanvas' data-bs-target='#modalslide' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        //     },
        //     {
        //         "nomor": "5",
        //         "nama": "Andika Alatas 6701228083",
        //         "no": "+6281298076589",
        //         "email": "dikta@gmail.com",
        //         "prodi": "D3 Sistem Informasi",
        //         "fakultas": "Ilmu Terapan",
        //         "universitas": "Telkom Bandung",
        //         "status": "<span class='badge bg-label-info me-1'>Penawaran</span>",
        //         "aksi": "<a data-bs-toggle='offcanvas' data-bs-target='#modalslide' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        //     },
        //     {
        //         "nomor": "6",
        //         "nama": "Andika Alatas 6701228083",
        //         "no": "+6281298076589",
        //         "email": "dikta@gmail.com",
        //         "prodi": "D3 Sistem Informasi",
        //         "fakultas": "Ilmu Terapan",
        //         "universitas": "Telkom Bandung",
        //         "status": "<span class='badge bg-label-primary me-1'>Seleksi Tahap 1</span>",
        //         "aksi": "<a data-bs-toggle='offcanvas' data-bs-target='#modalslide' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        //     },
        //     {
        //         "nomor": "7",
        //         "nama": "Andika Alatas 6701228083",
        //         "no": "+6281298076589",
        //         "email": "dikta@gmail.com",
        //         "prodi": "D3 Sistem Informasi",
        //         "fakultas": "Ilmu Terapan",
        //         "universitas": "Telkom Bandung",
        //         "status": "<span class='badge bg-label-dark me-1'>Seleksi Tahap 2</span>",
        //         "aksi": "<a data-bs-toggle='offcanvas' data-bs-target='#modalslide' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i><a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>"
        //     }
        // ];

        $('.table').each(function() {
            let idElement = $(this).attr('id');
            let url = "{{ url('/informasi/kandidat/$item->id_lowongan') }}?type=" + idElement;



            $(this).DataTable({
                ajax: url,
                serverSide: false,
                processing: true,
                deferRender: true,
                type: 'GET',
                columns: [{
                        data: "DT_RowIndex"
                    },
                    {
                        data: "namaindustri"
                    },
                    {
                        data: "notelpon"
                    },

                    {
                        data: "email"
                    },
                    {
                        data: "prodi"
                    },
                    {
                        data: "fakultas"
                    },
                    {
                        data: "universitas"
                    },
                    {
                        data: "tanggaldaftar"
                    },
                    {
                        data: "status"
                    },
                    {
                        data: "action"
                    }
                ],
            });

        });

        jQuery(function() {
            jQuery('.showSingle').click(function() {
                let idElement = $(this).attr('target');

                jQuery('.targetDiv').hide('.cnt');
                jQuery("#div" + idElement).slideToggle();

                console.log(idElement);
            });
        });

        function myFunction() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");
            https: //meet.google.com/bqa-trxd-gkg

                if (dots.style.display === "none") {
                    dots.style.display = "inline";
                    btnText.innerHTML = "Lebih Banyak";
                    moreText.style.display = "none";
                } else {
                    dots.style.display = "none";
                    btnText.innerHTML = "Lebih Sedikit";
                    moreText.style.display = "inline";
                }
        }


        $('.display').DataTable({
            responsive: true
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
        });
    </script>

    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>

    @endsection