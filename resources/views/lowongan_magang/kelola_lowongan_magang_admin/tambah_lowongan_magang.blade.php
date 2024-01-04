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
    <div class="row ">
        <div class="mb-2">
            <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs">Lowongan Magang / </span>
                Tambah Lowongan Magang
            </h4>
        </div>
    </div>

    {{-- <form class="default-form" method="POST" action="{{ route('lowongan-magang.store') }}">
        @csrf

        <div class="modal-body">
            <div class="wizard-section">
                <div class="card">
                    <div class="form-wizard">
                        <div class="form-wizard-header mb-3">
                            <ul class="list-unstyled form-wizard-steps clearfix">
                                <li class="active"><span>1</span></li>
                                <li><span>2</span></li>
                                <li><span>3</span></li>
                            </ul>
                        </div>
                        <fieldset class="wizard-fieldset show">
                            <h5>Detail Lowongan</h5>
                            <div class="form-group">
                                <label for="jenismagang" class="form-label">Jenis Magang<span
                                        class="text-danger">*</span></label>
                                <select name="jenismagang" id="jenismagang" class="select2 form-select wizard-required"
                                    data-placeholder="Jenis Magang">
                                    <option value="" disabled selected>Jenis Magang</option>
                                    @foreach ($jenismagang as $j)
                                        <option value="{{ $j->id_jenismagang }}">{{ $j->namajenis }}</option>
                                    @endforeach
                                </select>
                                <div class="wizard-form-error select2-error-form"></div>
                            </div>
                            <div class="form-group" style="margin-top: -20px;">
                                <label for="posisi" class="form-label">Posisi<span class="text-danger">*</span></label>
                                <input type="text" id="posisi" name="posisi" class="form-control wizard-required"
                                    placeholder="Masukan Posisi Pekerjaan" />
                                <div class="wizard-form-error"></div>
                            </div>
                            <div class="form-group" style="margin-top: -20px;">
                                <label for="kuota" class="form-label">Kuota Penerimaan<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="kuota" name="kuota" class="form-control wizard-required"
                                    placeholder="Masukan Kuota Penerimaan" />
                                <div class="wizard-form-error"></div>
                            </div>
                            <div class="form-group" style="margin-top: -20px;">
                                <label for="deskripsi" class="form-label">Deskripsi Pekerjaan <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control wizard-required" rows="2" placeholder="Masukan Deskripsi Pekerjaan" id="deskripsi"
                                    name="deskripsi"></textarea>
                                <div class="wizard-form-error"></div>
                            </div>
                            <div class="form-group clearfix text-end">
                                <a href="javascript:;" class="form-wizard-next-btn float-right" id="next1">Next<i
                                        class="ti ti-arrow-right ms-2 mb-1"></i></a>
                            </div>
                        </fieldset>
                        <fieldset class="wizard-fieldset">
                            <h5>Kualifikasi Lowongan</h5>
                            <div class="form-group">
                                <label for="kualifikasi" class="form-label">Requirements <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control wizard-required" rows="2" placeholder="Masukan Kualifikasi Mahasiswa"
                                    id="kualifikasi" name="kualifikasi"></textarea>
                                <div class="wizard-form-error"></div>
                            </div>

                            <div class="form-group" style="margin-top: -20px;">
                                <label for="gender" class="form-label" id="gender" name="gender">Jenis kelamin<span
                                        class="text-danger">*</span></label>
                                <div class="col mt-2">
                                    <div class="form-check form-check-inline">
                                        <input name="gender" class="form-check-input" type="radio" value="0" />
                                        <label class="form-check-label" for="gender">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="gender" class="form-check-input" type="radio" value="1" />
                                        <label class="form-check-label" for="gender">Perempuan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="gender" class="form-check-input " type="radio" value="2" />
                                        <label class="form-check-label" for="gender">Laki-Laki & Perempuan</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: -20px;">
                                <div class="border py-2 px-3 rounded-3">
                                    <label class="form-label" for="basic-default-company">
                                        Kualifikasi Pendidikan
                                    </label>
                                    <div class="form-group" style="margin-top: -15px;">
                                        <label for="jenjang" class="form-label">Jenjang<span
                                                class="text-danger">*</span></label>
                                        <select name="jenjang" id="jenjang" multiple="multiple"
                                            class="select2-multiple form-select wizard-required"
                                            data-placeholder="Pilih Jenjang">
                                            <option value="d3">D3</option>
                                            <option value="s1">S1</option>
                                            <option value="s2">S2</option>
                                            <option value="s3">S3</option>
                                        </select>
                                        <div class="wizard-form-error select2-error-form"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: -20px;">
                                <label for="keterampilan" class="form-label">Keterampilan<span
                                        class="text-danger">*</span></label>
                                <select name="keterampilan" id="keterampilan" multiple="multiple"
                                    class="select2-multiple form-select wizard-required"
                                    data-placeholder="Pilih Keterampilan">
                                    <option value="PostgreSQL">Figma</option>
                                    <option value="Figma">Teamwork</option>
                                    <option value="PHP Nativ">Leadership</option>
                                    <option value="Sketch">Laravel</option>
                                </select>
                                <div class="wizard-form-error select2-error-form"></div>
                            </div>

                            <div class="form-group" style="margin-top: -20px;">
                                <label for="pelaksanaan" class="form-label" id="pelaksanaan" name="tahapan">Pelaksanaan
                                    Magang<span class="text-danger">*</span></label>
                                <div class="col mt-2">
                                    <div class="form-check form-check-inline">
                                        <input name="pelaksanaan" class="form-check-input" type="radio"
                                            value="0" />
                                        <label class="form-check-label" for="pelaksanaan">Online</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="pelaksanaan" class="form-check-input" type="radio"
                                            value="1" />
                                        <label class="form-check-label" for="pelaksanaan">Onsite</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="pelaksanaan" class="form-check-input " type="radio"
                                            value="2" />
                                        <label class="form-check-label" for="pelaksanaan">Hybird</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: -20px;">
                                <label for="gaji" class="form-label d-block" id="gaji" name="gaji">Uang Saku
                                    <span class="text-danger">*</span></label>
                                <div class="col mt-2">
                                    <div class="form-check form-check-inline">
                                        <input name="gaji" class="form-check-input" type="radio" value="0" />
                                        <label class="form-check-label" for="gaji">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="gaji" class="form-check-input" type="radio" value="1" />
                                        <label class="form-check-label" for="gaji">Tidak</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: -20px;">
                                <label for="benefit" class="form-label">Benefits (Addtional)<span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control wizard-required" rows="2" id="benefit" name="benefit"
                                    placeholder="Masukan kualifikasi mahasiswa"></textarea>
                                <div class="wizard-form-error"></div>
                            </div>

                            <div class="form-group" style="margin-top: -20px;">
                                <label for="lokasi" class="form-label">Lokasi Penempatan<span
                                        class="text-danger">*</span></label>
                                <select name="lokasi" id="lokasi" multiple="multiple"
                                    class="select2-multiple form-select wizard-required"
                                    data-placeholder="Masukan Lokasi Pekerjaan">
                                    <option value="010bccc8-9daf-11ee-bdcc-70665517fcc8">Bandung</option>
                                    <option value="010c0aea-9daf-11ee-bdcc-70665517fcc8">Jakarta</option>
                                </select>
                                <div class="wizard-form-error select2-error-form"></div>
                            </div>
                            <div class="form-group" style="margin-top: -20px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div style="flex: 1;">
                                        <label for="tanggal" class="form-label">Tanggal Lowongan Ditayangkan
                                            <span class="text-danger">*</span></label>
                                        <input class="form-control wizard-required" type="date" id="tanggal"
                                            name="tanggalmulai" placeholder="Masukan Tanggal Ditayangkan"
                                            />
                                    </div>
                                    <div class = "mt-3"
                                        style="text-align: center; background-color: black; width: 14px; height: 1px; margin: 0 20px">
                                    </div>
                                    <div style="flex: 1;">
                                        <label for="tanggal" class="form-label">Tanggal Lowongan Diturunkan
                                            <span class="text-danger">*</span></label>
                                        <input class="form-control wizard-required" type="date" id="tanggal"
                                            name="tanggalakhir" placeholder="Masukan Tanggal Diturunkan"
                                            />
                                    </div>
                                </div>
                                <div class="wizard-form-error"></div>
                            </div>

                            <div class="form-group" style="margin-top: -20px;">
                                <label for="durasimagang" class="form-label">Durasi Magang<span
                                        class="text-danger">*</span></label>
                                <select name="durasimagang" id="durasimagang" multiple="multiple"
                                    class="select2-multiple form-select wizard-required"
                                    data-placeholder="Pilih Durasi Magang">
                                    <option value="1">1 Semester</option>
                                    <option value="2">2 Semester</option>
                                </select>
                                <div class="wizard-form-error select2-error-form"></div>
                            </div>

                            <div class="form-group" style="margin-top: -20px;">
                                <label for="tahapan" class="form-label" id="tahapan" name="tahapan">Berapa Banyak
                                    Tahapan Seleksi<span class="text-danger">*</span></label>
                                <div class="col mt-2">
                                    <div class="form-check form-check-inline">
                                        <input name="tahapan" class="form-check-input" type="radio" value="1" />
                                        <label class="form-check-label" for="tahapan">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="tahapan" class="form-check-input" type="radio" value="2" />
                                        <label class="form-check-label" for="tahapan">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="tahapan" class="form-check-input" type="radio" value="3" />
                                        <label class="form-check-label" for="tahapan">3</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: -20px;">
                                <label for="deskripsi" class="form-label">Deskripsi Tahapan<span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control wizard-required" rows="2" id="deskripsi" name="deskripsi"
                                    placeholder="Masukan Deskripsi Tahapan"></textarea>
                                <div class="wizard-form-error"></div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col text-start">
                                        <a href="javascript:;" class="form-wizard-previous-btn float-left"><i
                                                class="ti ti-arrow-left ms-1 mb-1"></i>Previous</a>
                                    </div>
                                    <div class="col text-end">
                                        <a href="javascript:;" class="form-wizard-next-btn float-right">Next<i
                                                class="ti ti-arrow-right ms-1 mb-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="wizard-fieldset">
                            <h5>Proses Seleksi</h5>

                        <div class="mb-2">
                            <label for="select2Disabled" class="form-label">Jenis Seleksi Tahap Lanjut<span class="text-danger">*</span></label>
                            <select id="select2Disabled" class="select2 form-select" disabled>
                                <option value="1" selected>Seleksi Tahap 1</option>
                                <option value="2">Option2</option>
                                <option value="3">Option3</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="mulai" class="form-label">Tanggal Mulai Pelaksanaan<span class="text-danger">*</span></label>
                                <input class="form-control" type="date" id="mulai" name="mulai">
                            </div>

                            <div class="col-6 mb-2">
                                <label for="mulai" class="form-label">Tanggal Akhir Pelaksanaan<span class="text-danger">*</span></label>
                                <input class="form-control" type="date" id="mulai" name="mulai">
                            </div>
                        </div>

                        <div id="tahap-lanjut-2" style="display: none;">
                            <hr>
                            <div class="mb-2">
                                <label for="select2Disabled" class="form-label">Jenis Seleksi Tahap Lanjut<span class="text-danger">*</span></label>
                                <select id="select2Disabled" class="select2 form-select" disabled>
                                    <option value="1">Seleksi Tahap 1</option>
                                    <option value="2" selected>Seleksi Tahap 2</option>
                                    <option value="3">Option3</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label for="mulai" class="form-label">Tanggal Mulai Pelaksanaan<span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" id="mulai" name="mulai">
                                </div>

                                <div class="col-6 mb-2">
                                    <label for="mulai" class="form-label">Tanggal Akhir Pelaksanaan<span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" id="mulai" name="mulai">
                                </div>
                            </div>
                        </div>

                        <div id="tahap-lanjut-3" style="display: none;">
                            <div class="mb-2">
                                <hr>
                                <label for="select2Disabled" class="form-label">Jenis Seleksi Tahap Lanjut<span class="text-danger">*</span></label>
                                <select id="select2Disabled" class="select2 form-select" disabled>
                                    <option value="1">Seleksi Tahap 1</option>
                                    <option value="2">Seleksi Tahap 2</option>
                                    <option value="3" selected>Seleksi Tahap 3</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label for="mulai" class="form-label">Tanggal Mulai Pelaksanaan<span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" id="mulai" name="mulai">
                                </div>

                                    <div class="col-6 mb-2">
                                        <label for="mulai" class="form-label">Tanggal Akhir Pelaksanaan<span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="date" id="mulai" name="mulai">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col text-start">
                                        <a href="javascript:;" class="form-wizard-previous-btn float-left"><i
                                                class="ti ti-arrow-left ms-1 mb-1"></i>Previous</a>
                                    </div>
                                    <div class="col text-end">
                                        <button type="submit" id="modal-button"
                                            class="form-wizard-submit float-right">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </form> --}}

    <!-- Validation Wizard -->
        <div class="modal-body">
            <div class="col-12 mb-4">
                <div id="wizard-validation" class="bs-stepper mt-2">
                    <div class="bs-stepper-header" style="justify-content: center">
                        <div class="step" data-target="#account-details-validation">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label mt-1">
                                    <span class="bs-stepper-title">Detail Lowongan</span>
                                    <span class="bs-stepper-subtitle">Posisi/Kuota/Deskripsi</span>
                                </span>
                            </button>
                        </div>
                        <div class="line">
                            <i class="ti ti-chevron-right"></i>
                        </div>
                        <div class="step" data-target="#personal-info-validation">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Kualifikasi Lowongan</span>
                                    <span class="bs-stepper-subtitle">Keterampilan/Requriement/Benefit</span>
                                </span>
                            </button>
                        </div>
                        <div class="line">
                            <i class="ti ti-chevron-right"></i>
                        </div>
                        <div class="step" data-target="#social-links-validation">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Proses Seleksi</span>
                                    <span class="bs-stepper-subtitle">Tahap1/Tahap2/Tahap3</span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <form class="default-form" id="wizard-validation-form" onSubmit="return false" method="POST" action="{{ route('lowongan-magang.store') }}">
                            @csrf
                            <!-- Account Details -->
                            <div id="account-details-validation" class="content">
                                <div class="content-header mb-3">
                                    <h6 class="mb-0">Detail Lowongan</h6>
                                </div>
                                <div class="row g-3">
                                    <div class="col-lg-12 col-sm-6">
                                        <label class="form-label" for="jenismagang">Jenis Magang<span
                                                class="text-danger">*</span></label>
                                        <select name="jenismagang" id="jenismagang" class="select2 form-select"
                                            data-placeholder="Jenis Magang">
                                            <option value="" disabled selected>Jenis Magang</option>
                                            @foreach ($jenismagang as $j)
                                                <option value="{{ $j->id_jenismagang }}">{{ $j->namajenis }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <label class="form-label" for="posisi">Posisi<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="posisi" id="posisi" class="form-control"
                                            placeholder="Masukan Posisi Pekerjaan" />
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <label class="form-label" for="kuota">Kuota Penerimaan<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="kuota" id="kuota" class="form-control"
                                            placeholder="Masukan Kuota Penerimaan" required/>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <label class="form-label" for="deskripsi">Deskripsi Pekerjaan<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="2" id="deskripsi" name="deskripsi" placeholder="Masukan Deskripsi Pekerjaan"></textarea>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <button class="btn btn-label-secondary btn-prev" disabled>
                                            <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button class="btn btn-success btn-next" type="button">
                                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                            <i class="ti ti-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Personal Info -->
                            <div id="personal-info-validation" class="content">
                                <div class="content-header mb-3">
                                    <h4 class="mb-0">Kualifikasi Lowongan </h4>
                                </div>
                                <div class="row g-3">
                                    <div class="col-lg-12 col-sm-6">
                                        <label for="kualifikasi" class="form-label">Requirements <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="2" id="kualifikasi" name="kualifikasi"
                                            placeholder="Masukan Kualifikasi Mahasiswa"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <label for="jenis" class="form-label">Jenis
                                            kelamin<span class="text-danger">*</span></label>
                                        <div class="col mt-2">
                                            <div class="form-check form-check-inline">
                                                <input name="jenis" id="jenis" class="form-check-input"
                                                    type="radio" value="0" />
                                                <label class="form-check-label" for="jenis">Laki-Laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="jenis" id="jenis" class="form-check-input"
                                                    type="radio" value="1" />
                                                <label class="form-check-label" for="jenis">Perempuan</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="jenis" id="jenis" class="form-check-input "
                                                    type="radio" value="2" />
                                                <label class="form-check-label" for="jenis">Laki-Laki &
                                                    Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <div class="border py-2 px-3 rounded-3">
                                            <label class="form-label" for="basic-default-company">
                                                Kualifikasi Pendidikan
                                            </label>
                                            <div class="form-group" style="margin-top: 5px;">
                                                <label for="jenjang" class="form-label">Jenjang<span
                                                        class="text-danger">*</span></label>
                                                <select name="jenjang" id="jenjang" multiple="multiple"
                                                    class="select2-multiple form-select" data-placeholder="Pilih Jenjang">
                                                    <option value="d3">D3</option>
                                                    <option value="s1">S1</option>
                                                    <option value="s2">S2</option>
                                                    <option value="s3">S3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <label for="keterampilan" class="form-label">Keterampilan<span
                                                class="text-danger">*</span></label>
                                        <select name="keterampilan" id="keterampilan" multiple="multiple"
                                            class="select2-multiple form-select" data-placeholder="Pilih Keterampilan">
                                            <option value="PostgreSQL">Figma</option>
                                            <option value="Figma">Teamwork</option>
                                            <option value="PHP Nativ">Leadership</option>
                                            <option value="Sketch">Laravel</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <label for="pelaksanaan" class="form-label">Pelaksanaan Magang<span
                                                class="text-danger">*</span></label>
                                        <div class="col mt-2">
                                            <div class="form-check form-check-inline">
                                                <input name="pelaksanaan" id="pelaksanaan" class="form-check-input"
                                                    type="radio" value="0" />
                                                <label class="form-check-label" for="pelaksanaan">Online</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="pelaksanaan" id="pelaksanaan" class="form-check-input"
                                                    type="radio" value="1" />
                                                <label class="form-check-label" for="pelaksanaan">Onsite</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="pelaksanaan" id="pelaksanaan" class="form-check-input "
                                                    type="radio" value="2" />
                                                <label class="form-check-label" for="pelaksanaan">Hybird</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <label for="gaji" class="form-label d-block">Uang
                                            Saku
                                            <span class="text-danger">*</span></label>
                                        <div class="col mt-2">
                                            <div class="form-check form-check-inline">
                                                <input name="gaji" id="gaji"class="form-check-input"
                                                    type="radio" value="1" />
                                                <label class="form-check-label" for="gaji">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="gaji" id="gaji" class="form-check-input"
                                                    type="radio" value="0" />
                                                <label class="form-check-label" for="gaji">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <label class="form-label" for="nominal">Nominal Uang Saku<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="nominal" id="nominal" class="form-control" />
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <label for="benefit" class="form-label">Benefits (Addtional)<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="2" id="benefit" name="benefit"
                                            placeholder="Masukan kualifikasi mahasiswa"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <label for="lokasi" class="form-label">Lokasi Penempatan<span
                                                class="text-danger">*</span></label>
                                        <select name="lokasi" id="lokasi" multiple="multiple"
                                            class="select2-multiple form-select wizard-required"
                                            data-placeholder="Masukan Lokasi Pekerjaan">
                                            <option value="010bccc8-9daf-11ee-bdcc-70665517fcc8">Bandung</option>
                                            <option value="010c0aea-9daf-11ee-bdcc-70665517fcc8">Jakarta</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <div style="flex: 1;">
                                                <label for="tanggal" class="form-label">Tanggal Lowongan Ditayangkan
                                                    <span class="text-danger">*</span></label>
                                                <input class="form-control wizard-required" type="date" id="tanggal"
                                                    name="tanggal" placeholder="Masukan Tanggal Ditayangkan" />
                                            </div>
                                            <div class = "mt-3"
                                                style="text-align: center; background-color: black; width: 14px; height: 1px; margin: 0 20px">
                                            </div>
                                            <div style="flex: 1;">
                                                <label for="tanggalakhir" class="form-label">Tanggal Lowongan Diturunkan
                                                    <span class="text-danger">*</span></label>
                                                <input class="form-control wizard-required" type="date"
                                                    id="tanggalakhir" name="tanggalakhir"
                                                    placeholder="Masukan Tanggal Diturunkan" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <label for="durasimagang" class="form-label">Durasi Magang<span
                                                class="text-danger">*</span></label>
                                        <select name="durasimagang" id="durasimagang" multiple="multiple"
                                            class="select2-multiple form-select wizard-required"
                                            data-placeholder="Pilih Durasi Magang">
                                            <option value="1">1 Semester</option>
                                            <option value="2">2 Semester</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <label for="tahapan" class="form-label">Tahapan
                                            Magang<span class="text-danger">*</span></label>
                                        <div class="col mt-2">
                                            <div class="form-check form-check-inline">
                                                <input name="tahapan" class="form-check-input"
                                                    type="radio" value="0" />
                                                <label class="form-check-label" for="tahapan">1</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="tahapan"  class="form-check-input"
                                                    type="radio" value="1" />
                                                <label class="form-check-label" for="tahapan">2</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="tahapan" class="form-check-input "
                                                    type="radio" value="2" />
                                                <label class="form-check-label" for="tahapan">3</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <button class="btn btn-label-secondary btn-prev">
                                            <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button class="btn btn-success btn-next" type="button">
                                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                            <i class="ti ti-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Social Links -->
                            <div id="social-links-validation" class="content">
                                <div class="content-header mb-3">
                                    <h4 class="mb-0">Proses Seleksi</h4>
                                </div>
                                <div class="row g-3">
                                    <div class="col-lg-12 col-sm-6">
                                        <label for="select2Disabled" class="form-label">Jenis Seleksi Tahap Lanjut<span
                                                class="text-danger">*</span></label>
                                        <select id="select2Disabled" class="select2 form-select" disabled>
                                            <option value="1"selected>Seleksi Tahap 1</option>
                                            <option value="2">Option2</option>
                                            <option value="3">Option3</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <label for="deskripsi" class="form-label">Deskripsi Seleksi<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="2" id="deskripsi" name="deskripsi[]"
                                            placeholder="Masukan Deskripsi Tahapan"></textarea>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6 mb-2">
                                            <label for="mulai" class="form-label">Tanggal Mulai Pelaksanaan<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" type="date" id="mulai" 
                                                name="mulai[]">
                                        </div>

                                        <div class="col-6 mb-2">
                                            <label for="mulai" class="form-label">Tanggal Akhir Pelaksanaan<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" type="date" id="mulai" 
                                                name="akhir[]">
                                        </div>
                                    </div>
                                    <div id="tahap-lanjut-2" style="display: none;">
                                        <hr>
                                        <div class="col-lg-12 col-sm-6">
                                            <label for="select2Disabled" class="form-label">Jenis Seleksi Tahap
                                                Lanjut<span class="text-danger">*</span></label>
                                            <select id="select2Disabled" class="select2 form-select" disabled>
                                                <option value="1">Seleksi Tahap 1</option>
                                                <option value="2" selected>Seleksi Tahap 2</option>
                                                <option value="3">Option3</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 col-sm-6">
                                            <label for="deskripsi" class="form-label">Deskripsi Seleksi<span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="2" id="deskripsi" name="deskripsi[]"
                                                placeholder="Masukan Deskripsi Tahapan"></textarea>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-6 mb-2">
                                                <label for="mulai" class="form-label">Tanggal Mulai Pelaksanaan<span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control" type="date" id="mulai"
                                                    name="mulai[]">
                                            </div>

                                            <div class="col-6 mb-2">
                                                <label for="mulai" class="form-label">Tanggal Akhir Pelaksanaan<span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control" type="date" id="mulai"
                                                    name="akhir[]">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tahap-lanjut-3" style="display: none;">
                                        <div class="mb-2">
                                            <hr>
                                            <div class="col-lg-12 col-sm-6">
                                                <label for="select2Disabled" class="form-label">Jenis Seleksi Tahap
                                                    Lanjut<span class="text-danger">*</span></label>
                                                <select id="select2Disabled" class="select2 form-select" disabled>
                                                    <option value="1">Seleksi Tahap 1</option>
                                                    <option value="2">Seleksi Tahap 2</option>
                                                    <option value="3" selected>Seleksi Tahap 3</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-12 col-sm-6">
                                                <label for="deskripsi" class="form-label">Deskripsi Seleksi<span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" rows="2" id="deskripsi" name="deskripsi[]"
                                                    placeholder="Masukan Deskripsi Tahapan"></textarea>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-6 mb-2">
                                                    <label for="mulai" class="form-label">Tanggal Mulai
                                                        Pelaksanaan<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="date" id="mulai"
                                                        name="mulai[]">
                                                </div>

                                                <div class="col-6 mb-2">
                                                    <label for="mulai" class="form-label">Tanggal Akhir
                                                        Pelaksanaan<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="date" id="mulai"
                                                        name="akhir[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <button class="btn btn-label-secondary btn-prev">
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
    <!-- /Validation Wizard -->
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
    <script src="../../app-assets/js/app-stepper.js"></script>
@endsection
