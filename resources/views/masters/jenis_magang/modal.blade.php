<!-- <div class="modal fade" id="modal-jenismagang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title">Tambah Jenis Magang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ route('jenismagang.store') }}">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-2">
                            <label for="jenis" class="form-label">Jenis Magang</label>
                            <input type="text" id="jenis" name="jenis" class="form-control" onkeyup="this.value = this.value.replace(/[^a-zA-Z\s]+/gi, '');" placeholder="Jenis Magang" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <select class="form-select select2" id="durasi" name="durasi" data-placeholder="Durasi Magang">
                                <option disabled selected>Pilih Durasi Magang</option>
                                <option value="1 Semester">1 Semester</option>
                                <option value="2 Semester">2 Semester</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="dokumen" class="form-label d-block" >Dokumen Upload</label>
                            <div class="form-check form-check-inline ">
                                <input class="form-check-input" type="radio" name="dokumen" id="inlineRadio1"
                                    value="1">
                                <label class="form-check-label" for="1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="dokumen" id="inlineRadio2"
                                    value="2">
                                <label class="form-check-label" for="2">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="seleksi" class="form-label d-block">Review</label>
                            <div class="form-check form-check-inline ">
                                <input class="form-check-input" type="radio" name="review" id="review1"
                                    value="1">
                                <label class="form-check-label" for="1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="review" id="review2"
                                    value="2">
                                <label class="form-check-label" for="2">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="seleksi" class="form-label d-block">Tipe</label>
                            <div class="form-check form-check-inline ">
                                <input class="form-check-input" type="radio" name="type" id="type1"
                                    value="1">
                                <label class="form-check-label" for="1">Fakultas</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="type2"
                                    value="2">
                                <label class="form-check-label" for="2">Non Fakultas</label>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" id="modal-button" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div> -->

@extends('partials_admin.template')

@section('page_style')
<style>
    .form-error {
        color: red;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: #4EA971;
    }

    .bs-stepper .step.active .bs-stepper-circle {
        background-color: #4EA971
    }
</style>
@endsection

@section('main')
<a href="/master/jenis-magang" type="button" class="btn btn-outline-success mb-3 waves-effect">
    <span class="ti ti-arrow-left me-2"></span>Kembali
</a>
<div class="row ">
    <div class="mb-2">
        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs">Master Data/ </span>
            Tambah Jenis Magang
        </h4>
    </div>
</div>

<div class="col-12 mb-4">
    <div class="bs-stepper wizard-numbered mt-2">
        <div class="bs-stepper-header" style="justify-content: center">
            <div class="step" data-target="#jenis-magang">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle">1</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Jenis Magang</span>
                        <span class="bs-stepper-subtitle">Jenis/Durasi</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i class="ti ti-chevron-right"></i>
            </div>
            <div class="step" data-target="#berkas-magang">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Detail Berkas Magang</span>
                        <span class="bs-stepper-subtitle">Nama/Status</span>
                    </span>
                </button>
            </div>
        </div>
        <div class="bs-stepper-content">
            <!-- <form onSubmit="return false"> -->
                <!-- Jenis Magang -->
                <div id="jenis-magang" class="content">
                    <div class="content-header mb-3">
                        <h6 class="mb-0">Informasi Umum Magang</h6>
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-6 col-sm-6">
                            <label class="form-label" for="jenis">Jenis Magang<span class="text-danger">*</span></label>
                            <input type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukan Jenis Magang" required />
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <label for="durasimagang" class="form-label">Durasi Magang<span class="text-danger">*</span></label>
                            <select name="durasimagang" id="durasimagang" multiple="multiple" class="select2-multiple form-select wizard-required" data-placeholder="Pilih Durasi Magang">
                                <option value="1 Semester">1 Semester</option>
                                <option value="2 Semester">2 Semester</option>
                            </select>
                        </div>
                        <div class="col-lg-12 col-sm-6">
                            <label for="tahunakademik" class="form-label">Tahun Akademik<span class="text-danger">*</span></label>
                            <select name="tahunakademik" id="tahunakademik" multiple="multiple" class="select2-multiple form-select wizard-required" data-placeholder="Pilih Tahun Akademik">
                                <option value="1 Semester">21/22 Ganjil</option>
                                <option value="2 Semester">21/22 Genap</option>
                            </select>
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-success btn-next">
                                <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                <i class="ti ti-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Berkas Magang -->
                <div id="berkas-magang" class="content">
                    <div class="content-header mb-3">
                        <h6 class="mb-0">Berkas Magang</h6>
                    </div>
                    <div class="row g-3">
                        <form class="form-repeater">
                            <div data-repeater-list="group-a">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="col-lg-8 col-sm-6">
                                            <label class="form-label" for="berkas">Berkas Magang<span class="text-danger">*</span></label>
                                            <input type="text" name="berkas" id="berkas" class="form-control" placeholder="Masukan Nama Berkas" />
                                        </div>
                                        <div class="col-lg-4 col-sm-6">
                                            <label for="status" class="form-label">Status Upload<span class="text-danger">*</span></label>
                                            <div class="col mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input name="status" id="status" class="form-check-input" type="radio" value="0" />
                                                    <label class="form-check-label" for="status">Wajib Upload</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="status" id="status" class="form-check-input" type="radio" value="1" />
                                                    <label class="form-check-label" for="status">Tidak Wajib Upload</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-11 col-sm-6">
                                            <label class="form-label" for="berkas">Upload Template <span class="text-danger">*</span></label>
                                            <input class="form-control" type="file" id="formFile">
                                        </div>
                                        <div class="col-lg-1 d-flex align-items-center mb-0">
                                            <button class="btn btn-label-danger mt-4" data-repeater-delete>
                                                <i class="ti ti-trash ti-xs me-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="border-bottom mt-1 pb-1" style="font-size: smaller;">Tipe File: .PDF Maximum upload file size : 2 MB.</p>

                                </div>
                            </div>
                            <div class="mb-0">
                                <button class="btn btn-outline-success" data-repeater-create>
                                    <span class="align-middle">Tambah</span>
                                </button>
                            </div>
                        </form>
                        <div class="col-12 d-flex justify-content-between">
                            <button class="btn btn-label-secondary btn-prev">
                                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-success btn-submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('page_script')
<script src="{{ url('app-assets/js/app-stepper.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
<script src="{{ url('app-assets/js/forms-extras.js') }}"></script>
@endsection