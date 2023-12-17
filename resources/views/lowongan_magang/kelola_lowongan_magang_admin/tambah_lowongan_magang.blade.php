@extends('partials_admin.template')

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/tagify/tagify.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/bs-stepper/bs-stepper.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/stepper/stepper.css" />
    <style>
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

    <form class="default-form" method="POST" action="{{ route('lowongan-magang.store') }}">
        @csrf

        <div class="modal-body">
            <div class="wizard">
                <div class="card">
                    <div class="form-wizard">
                        {{-- <form class="default-form" method="POST" action="{{ route('lowongan-magang.store') }}">
                    @csrf --}}

                        {{-- <form action="{{ route('lowongan-magang.store') }}" method="POST" role="form"> --}}
                        <div class="form-wizard-header mb-3">
                            <ul class="list-unstyled form-wizard-steps clearfix">
                                <li class="active"><span>1</span></li>
                                <li><span>2</span></li>
                                <li><span>3</span></li>
                            </ul>
                        </div>
                        <fieldset class="wizard-fieldset show">
                            <h5>Detail Lowongan</h5>
                            <div class="row">
                                <div class="col mb-3 form-input">
                                    <label for="jenis" class="form-label">Jenis Magang<span
                                            class="text-danger">*</span></label>
                                    <select name="jenismagang" id="jenismagang" class="form-select select2"
                                        data-placeholder="Jenis Magang">
                                        <option value="">Jenis Magang</option>
                                        @foreach ($jenismagang as $j)
                                            <option value="{{ $j->id_jenismagang }}">{{ $j->namajenis }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                    <div class="wizard-form-error"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="posisi" class="form-label">Posisi<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="posisi" name="posisi" class="form-control"
                                        placeholder="Masukan Posisi Pekerjaan" />
                                    <div class="invalid-feedback"></div>
                                    <div class="wizard-form-error"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="kuota" class="form-label">Kuota Penerimaan<span
                                            class="text-danger">*</span></label>
                                    <input type="int" id="kuota" name="kuota" class="form-control"
                                        placeholder="Masukkan Kuota Penerimaan" />
                                    <div class="invalid-feedback"></div>
                                    <div class="wizard-form-error"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="deskripsi" class="form-label">Deskripsi Pekerjaan <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="2" placeholder="Masukan Deskripsi Pekerjaan" id="deskripsi" name="deskripsi"></textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                    <div class="wizard-form-error"></div>
                                </div>
                            </div>
                            <div class="form-group clearfix text-end">
                                <a href="javascript:;" class="form-wizard-next-btn float-right">Next<i
                                        class="ti ti-arrow-right ms-2 mb-1"></i></a>
                            </div>
                        </fieldset>
                        <fieldset class="wizard-fieldset">
                            <h5>Kualifikasi Lowongan</h5>
                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="kualifikasi" class="form-label">Requirements <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="2" placeholder="Masukan Kualifikasi Mahasiswa" id="kualifikasi"
                                        name="kualifikasi"></textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3 form-input">
                                    <div class="border py-2 px-3 rounded-3">
                                        <label class="form-label" for="basic-default-company">
                                            Kualifikasi Pendidikan
                                        </label>

                                        <div class="row">
                                            <div class="col mb-2 form-input">
                                                <label for="jenjang" class="form-label">Jenjang<span
                                                        class="text-danger">*</span></label>
                                                <input id="jenjang" name="jengjang" class="form-control"
                                                    placeholder="Masukan Jenjang" />
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col mb-2 form-input">
                                                <label for="bidang" class="form-label">Bidang Keilmuan<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="bidang" name="bidang" class="form-control"
                                                    placeholder="Masukan Bidang Keilmuan" />
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="keterampilan" class="form-label">Keterampilan<span
                                            class="text-danger">*</span></label>
                                    <input id="keterampilan" name="keterampilan" class="form-control"
                                        placeholder="Pilih Keterampilan" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="gaji" class="form-label" id="gaji" name="gaji">Tipe
                                        Magang<span class="text-danger">*</span></label>
                                    <div class="col mt-2">
                                        <div class="form-check form-check-inline">
                                            <input name="gaji" class="form-check-input" type="radio" value="1"
                                                checked />
                                            <label class="form-check-label" for="gaji">Berbayar</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="gaji" class="form-check-input" type="radio"
                                                value="2" />
                                            <label class="form-check-label" for="gaji">Tidak Berbayar</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="benefit" class="form-label">Benefits (Addtional)<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="2" id="benefit" name="benefit"
                                        placeholder="Masukan kualifikasi mahasiswa"></textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3 form-input">
                                    <label for="pelaksanaan" class="form-label" id="pelaksanaan"
                                        name="tahapan">Pelaksanaan<span class="text-danger">*</span></label>
                                    <div class="col mt-2">
                                        <div class="form-check form-check-inline">
                                            <input name="pelaksanaan" class="form-check-input" type="radio"
                                                value="1" checked />
                                            <label class="form-check-label" for="pelaksanaan">Online</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="pelaksanaan" class="form-check-input" type="radio"
                                                value="2" />
                                            <label class="form-check-label" for="pelaksanaan">Onsite</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="pelaksanaan" class="form-check-input" type="radio"
                                                value="3" />
                                            <label class="form-check-label" for="pelaksanaan">Hybird</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="lokasi" class="form-label">Lokasi Penempatan<span
                                            class="text-danger">*</span></label>
                                    <input id="lokasi" name="lokasi" class="form-control"
                                        placeholder="Masukan Lokasi Pekerjaan" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3 form-input">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <div style="flex: 1;">
                                            <label for="tanggal" class="form-label">Tanggal Lowongan Ditayangkan
                                                <span class="text-danger">*</span></label>
                                            <input class="form-control" type="date" id="tanggal"
                                                name="tanggalmulai" placeholder="Masukan Tanggal Ditayangkan"
                                                id="html5-date-input" />
                                        </div>
                                        <div class = "mt-3"
                                            style="text-align: center; background-color: black; width: 14px; height: 1px; margin: 0 20px">
                                        </div>
                                        <div style="flex: 1;">
                                            <label for="tanggal" class="form-label">Tanggal Lowongan Diturunkan
                                                <span class="text-danger">*</span></label>
                                            <input class="form-control" type="date" id="tanggal"
                                                name="tanggalakhir" placeholder="Masukan Tanggal Diturunkan"
                                                id="html5-date-input" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="durasimagang" class="form-label">Durasi Magang<span
                                            class="text-danger">*</span></label>
                                    <input id="durasimagang" name="durasimagang" class="form-control"
                                        placeholder="Pilih Durasi Magang" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3 form-input">
                                    <label for="tahapan" class="form-label" id="tahapan" name="tahapan">Berapa Banyak
                                        Tahapan Seleksi<span class="text-danger">*</span></label>
                                    <div class="col mt-2">
                                        <div class="form-check form-check-inline">
                                            <input name="tahapan" class="form-check-input" type="radio" value="1"
                                                checked />
                                            <label class="form-check-label" for="tahapan">1</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="tahapan" class="form-check-input" type="radio"
                                                value="2" />
                                            <label class="form-check-label" for="tahapan">2</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="tahapan" class="form-check-input" type="radio"
                                                value="3" />
                                            <label class="form-check-label" for="tahapan">3</label>
                                        </div>
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
                                        <a href="javascript:;" class="form-wizard-next-btn float-right">Next<i
                                                class="ti ti-arrow-right ms-1 mb-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="wizard-fieldset">
                            <h5>Seleksi Lanjutan</h5>
                            <div class="mb-2">
                                <label for="seleksi" class="form-label">Jenis Seleksi Tahap Lanjut</label>
                                <select class="form-select select2" id="seleksi1" name="seleksi"
                                    data-placeholder="Pilih Status Seleksi">
                                    <option value="Seleksi Tahap 1"> Seleksi Tahap 1</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label for="mulai" class="form-label">Tanggal Mulai Pelaksanaan<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="date" id="mulai" name="mulai">
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="waktlu" class="form-label">Waktu Mulai Pelaksanaan<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="time" id="waktu" name="waktu">
                                </div>
                            </div>

                            <div class="mb-2">
                                <label for="seleksi" class="form-label">Jenis Seleksi Tahap Lanjut</label>
                                <select class="form-select select2" id="seleksi2" name="seleksi"
                                    data-placeholder="Pilih Status Seleksi">
                                    <option value="Seleksi Tahap 1"> Seleksi Tahap 2</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label for="mulai" class="form-label">Tanggal Mulai Pelaksanaan<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="date" id="mulai" name="mulai">
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="waktlu" class="form-label">Waktu Mulai Pelaksanaan<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="time" id="waktu" name="waktu">
                                </div>
                            </div>

                            <div class="mb-2">
                                <label for="seleksi" class="form-label">Jenis Seleksi Tahap Lanjut</label>
                                <select class="form-select select2" id="seleksi3" name="seleksi">
                                    <option value="Seleksi Tahap 1"> Seleksi Tahap 3</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label for="mulai" class="form-label">Tanggal Mulai Pelaksanaan<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="date" id="mulai" name="mulai">
                                </div>
                                <div class="col-6 mb-2">
                                    <label for="waktlu" class="form-label">Waktu Mulai Pelaksanaan<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="time" id="waktu" name="waktu">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col text-start">
                                    <a href="javascript:;" class="form-wizard-previous-btn float-left"><i
                                            class="ti ti-arrow-left ms-2 mb-1"></i>Previous</a>
                                </div>
                                <div class="modal-footer">
                                    <div class="col text-end">
                                        <a href="/kelola/lowongan">
                                            <button type="submit" id="modal-button"
                                                class="form-wizard-submit float-right">Submit</button></a>
                                        {{-- <button type="submit" id="modal-button" class="btn btn-success">Selanjutnya</button></a> --}}
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
    <script src="../../app-assets/vendor/libs/tagify/tagify.js"></script>
    <script src="../../app-assets/js/forms-tagify.js"></script>
    <script src="../../app-assets/js/forms-tagify2.js"></script>
    <script src="../../app-assets/js/forms-tagify3.js"></script>
    <script src="../../app-assets/js/forms-tagify4.js"></script>
    <script src="../../app-assets/js/form-wizard-numbered.js"></script>
    <script src="../../app-assets/js/form-wizard-validation.js"></script>
    <script src="../../app-assets/js/form-wizard-icons.js"></script>
    <script src="../../app-assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="../../app-assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="../../app-assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
    <script src="../../app-assets/vendor/libs/bs-stepper/bs-stepper.js"></script>
    <script src="../../app-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../app-assets/js/app-stepper.js"></script>
@endsection
