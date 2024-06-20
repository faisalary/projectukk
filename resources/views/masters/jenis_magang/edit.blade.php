@extends('partials.vertical_menu')

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

@section('content')

<a id="back" type="button" class="btn btn-outline-success text-success mt-4 mb-3 waves-effect">
    <span class="ti ti-arrow-left me-2"></span>Kembali
</a>
<div class="row ">
    <div class="mb-2">
        <h4 class="fw-bold text-sm modal-title"><span class="text-muted fw-light text-xs">Master Data/ </span>
            Edit Jenis Magang
        </h4>
    </div>
</div>

<div class="modal-body" id="modal-jenismagang">
    <div class="col-12 mb-4">
        <div id="wizard-validation" class="bs-stepper wizard-numbered mt-2">
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
                <form class="default-form form-repeater" id="wizard-validation-form" onSubmit="return false" method="POST" action="{{ url('master/jenis-magang/update') }}/{{ $jenismagang->id_jenismagang }}">
                    @csrf
                    <!-- Jenis Magang -->
                    <div id="jenis-magang" class="content">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">Informasi Umum Magang</h6>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6 col-sm-6 form-input">
                                <label class="form-label" for="jenis">Jenis Magang<span class="text-danger">*</span></label>
                                <input type="text" name="jenis" onkeyup="this.value = this.value.replace(/[^a-zA-Z\s]+/gi, '');" id="jenis" class="form-control" value="{{ $jenismagang->namajenis }}" placeholder="Masukan Jenis Magang" require>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-lg-6 col-sm-6 form-input">
                                <label for="durasimagang" class="form-label">Durasi Magang<span class="text-danger">*</span></label>
                                <select name="durasimagang" id="durasimagang" class="select2 form-select wizard-required" data-placeholder="Pilih Durasi Magang">
                                    <option value="">Pilih Durasi Magang</option>
                                    <option value="1 Semester" {{ $jenismagang->durasimagang == '1 Semester' ? 'selected' : '' }}>
                                        1 Semester
                                    </option>

                                    <option value="2 Semester" {{ $jenismagang->durasimagang == '2 Semester' ? 'selected' : '' }}>
                                        2 Semester
                                    </option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-lg-12 col-sm-6 form-input">
                                <label for="tahunakademik" class="form-label">Tahun Akademik<span class="text-danger">*</span></label>
                                <select name="tahunakademik" id="tahunakademik" class="select2 form-select wizard-required" data-placeholder="Pilih Tahun Akademik">
                                    <option value="">Pilih Tahun Akademik</option>
                                    @foreach($tahun as $item)
                                    <option value="{{$item->id_year_akademik}}" {{ $jenismagang->id_year_akademik? 'selected' : '' }}>{{$item->tahun}} {{$item->semester}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button type="button" class="btn btn-label-secondary btn-prev" disabled>
                                    <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button class="btn btn-success btn-next form-wizard-next-btn" type="button">
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
                            <div data-repeater-list="berkas">
                                @foreach($berkas as $item)
                                <div data-repeater-item>
                                    <div class="row">
                                        <input type="hidden" name="id_berkas" value="{{ $item->id_berkas_magang }}"></input>
                                        <input type="hidden" name="template" value="{{ $item->id_berkas_magang }}"></input>
                                        <div class="col-lg-8 col-sm-6 form-input">
                                            <label class="form-label" for="namaberkas">Berkas Magang<span class="text-danger">*</span></label>
                                            <input type="text" name="namaberkas" id="namaberkas" class="form-control" placeholder="Masukan Nama Berkas" value="{{ $item->nama_berkas }}" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6 form-input">
                                            <label for="status" class="form-label">Status Upload<span class="text-danger">*</span></label>
                                            <div class="col mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input name="statusupload" id="statusupload" class="form-check-input" type="radio" value="1" {{ $item->status_upload == '1' ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="statusupload">Wajib Upload</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="statusupload" id="statusupload" class="form-check-input" type="radio" value="0" {{ $item->status_upload == '0' ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="statusupload">Tidak Wajib Upload</label>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-lg-11 col-sm-6 form-input">
                                            <label class="form-label" for="template">Upload Template <span class="text-danger">*</span></label>
                                            <input class="form-control" name="template" type="file" id="template">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-lg-1 d-flex align-items-center mb-0">
                                            <button type="button" class="btn btn-label-danger mt-4" data-repeater-delete>
                                                <i class="ti ti-trash ti-xs me-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="border-bottom mt-1 pb-1" style="font-size: smaller;">Tipe File: .PDF Maximum upload file size : 2 MB.</p>

                                </div>
                                @endforeach
                            </div>
                            <div class="mb-0">
                                <button type="button" class="btn btn-outline-success" data-repeater-create>
                                    <span class="align-middle">Tambah</span>
                                </button>
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                <button type="button" class="btn btn-label-secondary btn-prev">
                                    <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button type="submit" class="btn btn-success btn-submit" id="modal-button">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page_script')
<script>
    document.getElementById("back").addEventListener("click", () => {
        history.back();
    });
</script>
<script src="{{ url('app-assets/js/app-stepper.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
<script src="{{ url('app-assets/js/forms-extras.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ url('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
<script src="{{ url('app-assets/js/forms-pickers.js') }}"></script>
@endsection