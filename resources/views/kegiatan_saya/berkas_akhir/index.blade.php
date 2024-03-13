@extends('partials_mahasiswa.template')

@section('page_style')
<link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
<style>
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
        <h4 class="fw-bold"><span class="text-muted fw-light">Kegiatan Saya /</span> Berkas Akhir Magang</h4>
    </div>

    {{--Sebelum upload dokumen--}}
    <div class="alert alert-danger alert-dismissible" role="alert">
        Mohon unggah dokumen di bawah ini sebelum tanggal 28 Juni 2024!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="border text-center mt-4" style="border-radius: 8px; background-color:#fff">
        <h4 class="mt-3">Laporan Harian Magang </h4>
        <p>Harap Pastikan dokumen ilaporan harian magang sudah benar dan sesuai. Anda hanya memiliki satu kesempatan untuk mengunggahnya.</p>
        <button type="button" class="btn btn-success waves-effect waves-light mb-3" data-bs-toggle="modal" data-bs-target="#modallaporanharian">Lengkapi Laporan Harian Magang </button>
    </div>

    <div class="border text-center mt-4" style="border-radius: 8px; background-color:#fff">
        <h4 class="mt-3">Laporan Akhir Magang</h4>
        <p>Harap pastikan bahwa laporan akhir magang Anda telah lengkap dan selesai sepenuhnya. Anda hanya memiliki satu kesempatan untuk mengunggahnya.</p>
        <p class="mb-1" style="font-size: 12px;">Dokumen Implementasi pelaksanaan kelompok</p>
        <p style="font-size: 15px; cursor:pointer; color:#4EA971"><u>Tamplate Laporan Akhir Magang.docs</u></p>

        <button type="button" class="btn btn-success waves-effect waves-light mb-3" data-bs-toggle="modal" data-bs-target="#modallaporanakhir">Lengkapi Laporan Akhir Magang</button>
    </div>

    <div class="border text-center mt-4" style="border-radius: 8px; background-color:#fff">
        <h4 class="mt-3">Dokumen Implementasi Pelaksanaan</h4>
        <p>Harap Pastikan dokumen implementasi pelaksanaan sudah benar dan sesuai. Anda hanya memiliki satu kesempatan untuk mengunggahnya.</p>
        <div class="row mb-3">
            <div class="col-6 text-end pe-4 border-end">
                <p class="mb-1" style="font-size: 12px;">Dokumen Implementasi pelaksanaan kelompok</p>
                <u style="font-size: 15px; cursor:pointer; color:#4EA971">Tamplate dokumen IA Kelompok.docs</u>
            </div>
            <div class="col-6 ps-4 text-start ">
                <p class="mb-1" style="font-size: 12px;">Dokumen Implementasi pelaksanaan Individu</p>
                <u style="font-size: 15px; cursor:pointer; color:#4EA971">Tamplate dokumen IA Individu.docs</u>
            </div>
        </div>
        <button type="button" class="btn btn-success waves-effect waves-light mb-3" data-bs-toggle="modal" data-bs-target="#modaldokumen">Lengkapi Dokumen Implementasi Pelaksanaan</button>
    </div>

    {{--Sesudah upload dokumen--}}

    <!-- <div class="border text-center mt-4" style="border-radius: 8px; background-color:#fff">
        <div class="row">
            <div class="col-10 p-0">
                <h4 class="mt-3" style="padding-left: 250px;">Upss! Laporan Harian Magang Anda membutuhkan perbaikan.</h4>
            </div>
            <div class="col-2 text-end pe-5 pt-4">
                <span class="badge bg-label-danger mb-2">Tidak Lengkap</span>
            </div>
        </div>
        <p>Silahkan lakukan pengecekan detail laporan harian magang dibawah ini</p>
        <button type="button" class="btn btn-outline-danger waves-effect waves-light mb-3" data-bs-toggle="modal" data-bs-target="#modallaporanharian style="height: 40px;"> <i class="ti ti-edit mb-1 me-1"></i> Laporan Harian Magang</button>
        <div class="text-start ms-3 me-3">
            <hr>
            <p class="text-danger">Komentar Perbaikan :</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in. Suspendisse blandit maximus mauris, vitae pharetra risus gravida eu. </p>
        </div>
    </div>

    <div class="border text-center mt-4" style="border-radius: 8px; background-color:#fff">
        <div class="row">
            <div class="col-10 p-0">
                <h4 class="mt-3" style="padding-left: 250px;">Terkirim! Laporan Akhir Magang Anda telah berhasil diserahkan.</h4>
            </div>
            <div class="col-2 text-end pe-5 pt-4">
                <span class="badge bg-label-success mb-2">Lengkap</span>
            </div>
        </div>
        <p>Silahkan lakukan pengecekan detail laporan akhir magang dibawah ini.</p>
        <p style="font-size: 15px; cursor:pointer; color:#4EA971">laporan akhir magang.pdf</p>
    </div>

    <div class="border text-center mt-4" style="border-radius: 8px; background-color:#fff"><div class="row">
            <div class="col-10 p-0">
                <h4 class="mt-3" style="padding-left: 250px;">Terkirim! Dokumen Implementasi Pelaksanaan Anda telah berhasil diserahkan.</h4>
            </div>
            <div class="col-2 text-end pe-5 pt-4">
                <span class="badge bg-label-warning mb-2">Menunggu Verifikasi</span>
            </div>
        </div>
        <p>Silahkan lakukan pengecekan detail dokumen implementasi pelaksanaan dibawah ini</p>
        <p style="font-size: 15px; cursor:pointer; color:#4EA971">laporan akhir magang.pdf</p>
    </div> -->

</div>

<!-- Modal Laporan Harian Magang -->
<div class="modal fade" id="modallaporanharian" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Tambah Laporan Harian Magang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <div class="row">
                    <div class="col mb-0">
                        <label for="formFile" class="form-label">Laporan Harian Magang</label>
                        <input class="form-control" type="file" id="formFile">
                        <p class="pt-2" style="font-size: small;">Allowed PDF, JPG, PNG, JPEG. Max size of 1 Mb</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Kirim</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Laporan Akhir Magang -->
<div class="modal fade" id="modallaporanakhir" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Tambah Laporan Akhir Magang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <div class="row">
                    <div class="col mb-0">
                        <label for="formFile" class="form-label">Laporan Akhir Magang</label>
                        <input class="form-control" type="file" id="formFile">
                        <p class="pt-2" style="font-size: small;">Allowed PDF, JPG, PNG, JPEG. Max size of 1 Mb</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Kirim</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Dokumen Implementasi Pelaksanaan -->
<div class="modal fade" id="modaldokumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Dokumen Implementasi Pelaksanaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <div class="row">
                    <div class="col mb-0">
                        <label for="formFile" class="form-label">Dokumen Implementasi Pelaksanaan</label>
                        <input class="form-control" type="file" id="formFile">
                        <p class="pt-2" style="font-size: small;">Allowed PDF, JPG, PNG, JPEG. Max size of 1 Mb</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Kirim</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page_script')

@endsection