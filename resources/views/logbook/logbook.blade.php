@extends('partials_mahasiswa.template')

@section('page_style')
<link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
<link rel="stylesheet" href="{{ url('../../app-assets/css/yearpicker.css') }}" />
<style>
    .btn-success {
        color: #fff;
        background-color: #4EA971 !important;
        border-color: #4EA971 !important;
    }

    .select2-container--default .select2-results__option--highlighted:not([aria-selected="true"]) {
        background-color: rgba(115, 103, 240, 0.08) !important;
        color: #4EA971 !important;
    }

    .select2-results__option[role="option"][aria-selected="true"] {
        background-color: #4EA971 !important;
        color: #fff;
    }
</style>
@endsection

@section('main')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-md-10 col-12 mt-4 mb-4">
        <h4 class="fw-bold"> <span class="text-muted fw-light text-xs">Kegiatan Saya / </span> Logbook Mahasiswa</h4>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="user-profile-header-banner">
                <img src="../assets/logbookbg.png" alt="Banner image" class="rounded-top" width="100%" style="height: 129px !important;" />
            </div>
            <div class="user-profile-header text-sm-start text-center mb-4" style="justify-content: space-between !important;">
                <div class="flex-shrink-0 mt-n5 mx-sm-0 mx-auto ms-0 ms-sm-5">
                    <div class="row">
                        <div class="col-6">
                            <div class="card" style="max-width:210px">
                                <div class="card-body">
                                    <img src="../assets/images/wings.png" alt="user image" class="d-block h-auto rounded user-profile-img" />
                                </div>
                            </div>
                            <div style="margin-top: 24px;">
                                <h4>Human Resources</h4>
                                <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    <li class="list-inline-item">PT. Wings Surya</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 mt-5 d-flex justify-content-between">
                            <div class="card-body ms-5 mt-3">
                                <div class="text-light row small fw-semibold">
                                    <div class="col-6"> Kelengkapan Logbook</div>
                                    <div class="col-6 text-end">75%</div>
                                </div>
                                <div class="demo-vertical-spacing text-end">
                                    <div class="progress text-end">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="pe-4">
                                <button class="btn btn-outline-success mt-5" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false"><span><i class="ti ti-download me-sm-1"></i> <span class="d-none d-sm-inline-block">Ekspor PDF</span></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4 mt-4" style=" display: flex; justify-content: space-between !important;">
        <h4>Logbook Mahasiswa - Januari 2024</h4>
        <select class="select2 form-select" data-placeholder="Silahkan Pilih Bulan">
            <option value="">Silahkan Pilih Bulan</option>
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
        </select>
    </div>

    <div class="mb-4" style="display: flex; justify-content: space-between; border: 1px solid #D3D6DB; padding: 10px 30px; background-color: white; border-radius: 6px; ">
        <div class="mt-3">
            <span class="badge bg-label-warning mb-2">Belum Disetujui</span>
            <h5 class="mb-1">20 - 25 Januari 2023</h5>
            <p>Minggu ke - 1</p>
        </div>

        <div class="mt-3" style="display: flex !important;">
            <div class="text-center" style="margin-top: 120px; margin-bottom: 30px">
                <a href="/logbook-detail" class="btn btn-success" role="button" style="margin-bottom: 14px">Lengkapi Logbook Mahasiswa</a>
                <p>Laporan mingguan dapat terkirim ketika laporan harian sudah dilengkapi secara keseluruhan</p>
            </div>
            <div class="text-center" style=" margin-left: 20px; ">
                <p>Senin</p>
                <img src="../assets/images/smile.png" alt="">
            </div>
            <div class="text-center" style=" margin-left: 20px; ">
                <p>Selasa</p>
                <img src="../assets/images/love.png" alt="">
            </div>
            <div class="text-center" style=" margin-left: 20px; ">
                <p>Rabu</p>
                <img src="../assets/images/sad.png" alt="">
            </div>
            <div class="text-center" style=" margin-left: 20px; ">
                <p>kamis</p>
                <img src="../assets/images/kyaa.png" alt="">
            </div>
            <div class="text-center" style=" margin-left: 20px; ">
                <p>Jumat</p>
                <img src="../assets/images/jutek.png" alt="">
            </div>
        </div>
    </div>

    <div class="mb-4" style="display: flex; justify-content: space-between; border: 1px solid #D3D6DB; padding: 10px 30px; background-color: white; border-radius: 6px; ">
        <div class="mt-3">
            <span class="badge bg-label-success mb-2">Disetujui</span>
            <h5 class="mb-1">20 - 25 Januari 2023</h5>
            <p>Minggu ke - 1</p>
        </div>

        <div class="mt-3" style="display: flex !important;">
            <!-- <div class="text-center" style="margin-top: 120px; margin-bottom: 30px">
                <a href="/logbook-detail" class="btn btn-success active" role="button" style="margin-bottom: 14px">Lengkapi Logbook Mahasiswa</a>
                <p>Laporan mingguan dapat terkirim ketika laporan harian sudah dilengkapi secara keseluruhan</p>
            </div> -->
            <div class="text-center" style=" margin-left: 20px; ">
                <p>Senin</p>
                <img src="../assets/images/smile.png" alt="">
            </div>
            <div class="text-center" style=" margin-left: 20px; ">
                <p>Selasa</p>
                <img src="../assets/images/love.png" alt="">
            </div>
            <div class="text-center" style=" margin-left: 20px; ">
                <p>Rabu</p>
                <img src="../assets/images/sad.png" alt="">
            </div>
            <div class="text-center" style=" margin-left: 20px; ">
                <p>kamis</p>
                <img src="../assets/images/kyaa.png" alt="">
            </div>
            <div class="text-center" style=" margin-left: 20px; ">
                <p>Jumat</p>
                <img src="../assets/images/jutek.png" alt="">
            </div>
        </div>
    </div>

    <div class="mb-4" style="display: flex; justify-content: space-between; border: 1px solid #D3D6DB; padding: 10px 30px; background-color: white; border-radius: 6px; ">
        <div class="mt-3">
            <span class="badge bg-label-danger mb-2">Ditolak</span>
            <h5 class="mb-1">20 - 25 Januari 2023</h5>
            <p>Minggu ke - 3</p>
        </div>

        <div class="mt-3" style="display: flex !important;">
            <!-- <div class="text-center" style="margin-top: 120px; margin-bottom: 30px">
                <a href="/logbook-detail" class="btn btn-outline-danger" role="button" style="margin-bottom: 14px">Perbaiki Logbook Mahasiswa</a>
                <p>Laporan mingguan ditolak oleh pembimbing, silahkan perbaiki logbook anda</p>
            </div> -->
            <div class="text-center" style=" margin-left: 20px; ">
                <p>Senin</p>
                <img src="../assets/images/smile.png" alt="">
            </div>
            <div class="text-center" style=" margin-left: 20px; ">
                <p>Selasa</p>
                <img src="../assets/images/love.png" alt="">
            </div>
            <div class="text-center" style=" margin-left: 20px; ">
                <p>Rabu</p>
                <img src="../assets/images/sad.png" alt="">
            </div>
            <div class="text-center" style=" margin-left: 20px; ">
                <p>kamis</p>
                <img src="../assets/images/kyaa.png" alt="">
            </div>
            <div class="text-center" style=" margin-left: 20px; ">
                <p>Jumat</p>
                <img src="../assets/images/jutek.png" alt="">
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_script')
<script src="{{ url('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ url('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
<script src="{{ url('app-assets/js/yearpicker.js') }}"></script>
@endsection