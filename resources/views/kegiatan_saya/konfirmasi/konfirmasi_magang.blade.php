@extends('partials_mahasiswa.template')

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
        <h4 class="fw-bold"><span class="text-muted fw-light">Kegiatan Saya /</span> Konfirmasi Penerimaan Magang</h4>
    </div>

    {{-- Belum melakukan konfirmasi lowongan magang --}}
    <div class="col-3 mt-3 ">
        <img class="image" style="border-radius: 0%; margin-left: 400px; width:430px;" src="{{ asset('front/assets/img/belum_ada_lowongan.png')}}" alt="admin.upload">
    </div>
    <div class="sec-title mt-5 mb-4 text-center">
        <h4>Anda belum melakukan konfirmasi lowongan magang</h4>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi">
            Konfirmasi sekarang
        </button>
    </div>

    {{-- Sudah melakukan konfirmasi lowongan magang --}}
    <!-- <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between border-bottom">
                    <h4 class="text-secondary">Informasi Penerimaan Magang</h4>
                    <i class="menu-icon tf-icons ti ti-edit text-warning" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiEdit"></i>
                </div>
                <div class="row mt-3">
                    <div class="col-5 border-end">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <img class="img-fluid rounded mb-3 pt-1 mt-4" src="../../app-assets/img/avatars/15.png" height="100" width="100" alt="User avatar" />
                                <div class="user-info text-center">
                                    <h4 class="mb-2">Violet Mendoza</h4>
                                    <span class="badge bg-label-success mt-1">Mahasiswa</span>
                                </div>
                            </div>
                        </div>
                        <div class="row text-start mt-4">
                            <div class="col-6">
                                <ul class="list-unstyled" style="margin-left: 100px;">
                                    <li class="mb-1">
                                        <span class="fw-semibold me-1">NIM:</span>
                                    </li>
                                    <li class="mb-2 pt-1">
                                        <span class="fw-semibold me-1">Universitas:</span>
                                    </li>
                                    <li class="mb-2 pt-1">
                                        <span class="fw-semibold me-1">Fakultas:</span>
                                    </li>
                                    <li class="mb-2 pt-1">
                                        <span class="fw-semibold me-1">Program Studi:</span>
                                    </li>
                                    <li class="mb-2 pt-1">
                                        <span class="fw-semibold me-1">IPK:</span>
                                    </li>
                                    <li class="mb-2 pt-1">
                                        <span class="fw-semibold me-1">Semester:</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li class="mb-1">
                                        <span>6705513025</span>
                                    </li>
                                    <li class="mb-2 pt-1">
                                        <span>Universitas Telkom</span>
                                    </li>
                                    <li class="mb-2 pt-1">
                                        <span>Fakultas Ilmu Terapan</span>
                                    </li>
                                    <li class="mb-2 pt-1">
                                        <span>D3 Sistem Informasi</span>
                                    </li>
                                    <li class="mb-2 pt-1">
                                        <span>3.74/4.00</span>
                                    </li>
                                    <li class="mb-2 pt-1">
                                        <span>5</span>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                    <div class="col-7">
                        <div class="row ms-5" style="margin-top: 80px;">
                            <div class="col-6">
                                <h5>Nama Perusahaan</h5>
                                <p>PT. Techno Infinity</p>
                            </div>
                            <div class="col-6">
                                <h5>Posisi Magang</h5>
                                <p>Business Analyst</p>
                            </div>
                        </div>
                        <div class="row ms-5 mt-3">
                            <div class="col-6">
                                <h5>Tanggal Mulai Magang</h5>
                                <p>03 Juli 2023</p>
                            </div>
                            <div class="col-6">
                                <h5>Tanggal Akhir Magang</h5>
                                <p>03 Juni 2024</p>
                            </div>
                        </div>
                        <div class="row ms-5 mt-3">
                            <div class="col-12">
                                <h5>Bukti Penerimaan Magang</h5>
                                <a href="#"> tdifile.pdf </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Modal -->
    <div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Konfirmasi Penerimaan Magang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="namaperusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" id="namaperusahaan" class="form-control" placeholder="PT. Techno Infinity" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="namaposisi" class="form-label">Nama Posisi Magang</label>
                            <input type="text" id="namaperusahaan" class="form-control" placeholder="UIUX Designer" />
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col mb-0">
                            <label for="tanggalmulai" class="form-label">Tanggal Mulai<span style="color: red;">*</span></label>
                            <input type="text" class="form-control flatpickr-date" id="tanggalmulai" placeholder="YYYY-MM-DD" readonly="readonly">
                        </div>
                        <div class="mt-5" style="text-align: center; background-color: black; width: 14px; height: 1px; margin: 0 20px">
                        </div>
                        <div class="col mb-0">
                            <label for="tanggalakhir" class="form-label">Tanggal Akhir<span style="color: red;">*</span></label>
                            <input type="text" class="form-control  flatpickr-date" id="tanggalakhir" placeholder="YYYY-MM-DD" readonly="readonly">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0">
                            <label for="formFile" class="form-label">Bukti Penerimaan Magang</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalKonfirmasiEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Konfirmasi Penerimaan Magang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="namaperusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" id="namaperusahaan" class="form-control" placeholder="PT. Techno Infinity" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="namaposisi" class="form-label">Nama Posisi Magang</label>
                            <input type="text" id="namaperusahaan" class="form-control" placeholder="UIUX Designer" />
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col mb-0">
                            <label for="tanggalmulai" class="form-label">Tanggal Mulai<span style="color: red;">*</span></label>
                            <input type="text" class="form-control  flatpickr-date" id="tanggalakhir" placeholder="YYYY-MM-DD" readonly="readonly">
                        </div>
                        <div class="mt-5" style="text-align: center; background-color: black; width: 14px; height: 1px; margin: 0 20px">
                        </div>
                        <div class="col mb-0">
                            <label for="tanggalakhir" class="form-label">Tanggal Akhir<span style="color: red;">*</span></label>
                            <input type="text" class="form-control  flatpickr-date" id="tanggalakhir" placeholder="YYYY-MM-DD" readonly="readonly">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0">
                            <label for="formFile" class="form-label">Bukti Penerimaan Magang</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
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