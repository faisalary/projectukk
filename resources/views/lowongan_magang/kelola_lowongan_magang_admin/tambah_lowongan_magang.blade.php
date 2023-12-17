@extends('partials_admin.template')

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/tagify/tagify.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/bs-stepper/bs-stepper.css" />
    <style>
        .light-style .bs-stepper:not(.wizard-modern) {
            box-shadow: none;
            border-bottom: none;
        }

        light-style .bs-stepper .bs-stepper-header {
            border-bottom: 0px !important;
        }

        body {
            background-color: #ffffff;
            color: #444444;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 300;
            margin: 0;
            padding: 0;
        }

        .wizard-content-left {
            background-blend-mode: darken;
            background-color: rgba(0, 0, 0, 0.45);
            background-image: url("https://i.ibb.co/X292hJF/form-wizard-bg-2.jpg");
            background-position: center center;
            background-size: cover;
            height: 100vh;
            padding: 30px;
        }

        .wizard-content-left h1 {
            color: #ffffff;
            font-size: 38px;
            font-weight: 600;
            padding: 12px 20px;
            text-align: center;
        }

        .form-wizard {
            color: #888888;
            padding: 30px;
        }

        .form-wizard .wizard-form-radio {
            display: inline-block;
            margin-left: 5px;
            position: relative;
        }

        .form-wizard .wizard-form-radio input[type="radio"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            -o-appearance: none;
            appearance: none;
            background-color: #dddddd;
            height: 25px;
            width: 25px;
            display: inline-block;
            vertical-align: middle;
            border-radius: 50%;
            position: relative;
            cursor: pointer;
        }

        .form-wizard .wizard-form-radio input[type="radio"]:focus {
            outline: 0;
        }

        /* .form-wizard .wizard-form-radio input[type="radio"]:checked {
                background-color: #fb1647;
            } */

        /* .form-wizard .wizard-form-radio input[type="radio"]:checked::before {
                content: "";
                position: absolute;
                width: 10px;
                height: 10px;
                display: inline-block;
                background-color: #ffffff;
                border-radius: 50%;
                left: 1px;
                right: 0;
                margin: 0 auto;
                top: 8px;
            } */

        /* .form-wizard .wizard-form-radio input[type="radio"]:checked::after {
                content: "";
                display: inline-block;
                webkit-animation: click-radio-wave 0.65s;
                -moz-animation: click-radio-wave 0.65s;
                animation: click-radio-wave 0.65s;
                background: #000000;
                content: '';
                display: block;
                position: relative;
                z-index: 100;
                border-radius: 50%;
            }

            .form-wizard .wizard-form-radio input[type="radio"]~label {
                padding-left: 10px;
                cursor: pointer;
            } */

        .form-wizard .form-wizard-header {
            text-align: center;
        }

        .form-wizard .form-wizard-next-btn,
        .form-wizard .form-wizard-previous-btn,
        .form-wizard .form-wizard-submit {
            background-color: #4EA971;
            color: #ffffff;
            display: inline-block;
            min-width: 100px;
            min-width: 120px;
            padding-top: 10px !important;
            padding-bottom: 10px;
            text-align: center;
            border-radius: 8px;
            font-size: 20px;
        }

        .form-wizard .form-wizard-next-btn:hover,
        .form-wizard .form-wizard-next-btn:focus,
        .form-wizard .form-wizard-previous-btn:hover,
        .form-wizard .form-wizard-previous-btn:focus,
        .form-wizard .form-wizard-submit:hover,
        .form-wizard .form-wizard-submit:focus {
            color: #ffffff;
            opacity: 0.6;
            text-decoration: none;
        }

        .form-wizard .wizard-fieldset {
            display: none;
        }

        .form-wizard .wizard-fieldset.show {
            display: block;
        }

        .form-wizard .wizard-form-error {
            display: none;
            background-color: #d70b0b;
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px;
            width: 100%;
        }

        .form-wizard .form-wizard-previous-btn {
            background-color: #a8aaae;
        }

        .form-wizard .form-control {
            font-weight: 300;
            height: auto !important;
            color: #888888;
            background-color: #ffffff;
        }

        .form-wizard .form-control:focus {
            box-shadow: none;
        }

        .form-wizard .form-group {
            position: relative;
            margin: 25px 0;
            padding-top: 10px !important;
            padding-bottom: 10px;
        }

        .form-wizard .wizard-form-text-label {
            position: absolute;
            left: 10px;
            top: 16px;
            transition: 0.2s linear all;
        }

        .form-wizard .focus-input .wizard-form-text-label {
            color: #4EA971;
            top: -18px;
            transition: 0.2s linear all;
            font-size: 12px;
        }

        .form-wizard .form-wizard-steps {
            margin-top: 30px;
            margin-bottom: 30px;
            margin-left: 100px;
        }

        .form-wizard .form-wizard-steps li {
            width: 30%;
            float: left;
            position: relative;
        }

        .form-wizard .form-wizard-steps li::after {
            background-color: #f3f3f3;
            content: "";
            height: 5px;
            left: 0;
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            border-bottom: 1px solid #dddddd;
            border-top: 1px solid #dddddd;
        }

        .form-wizard .form-wizard-steps li span {
            background-color: #dddddd;
            border-radius: 50%;
            display: inline-block;
            height: 50px;
            line-height: 50px;
            position: relative;
            text-align: center;
            width: 50px;
            z-index: 1;
            font-size: 23px;
        }

        .form-wizard .form-wizard-steps li:last-child::after {
            width: 50%;
        }

        .form-wizard .form-wizard-steps li.active span,
        .form-wizard .form-wizard-steps li.activated span {
            background-color: #4EA971;
            color: #ffffff;
        }

        .form-wizard .form-wizard-steps li.active::after,
        .form-wizard .form-wizard-steps li.activated::after {
            background-color: #4EA971;
            left: 50%;
            width: 50%;
            border-color: #4EA971;
        }

        .form-wizard .form-wizard-steps li.activated::after {
            width: 100%;
            border-color: #4EA971;
        }

        .form-wizard .form-wizard-steps li:last-child::after {
            left: 0;
        }

        @keyframes click-radio-wave {
            0% {
                width: 25px;
                height: 25px;
                opacity: 0.35;
                position: relative;
            }

            100% {
                width: 60px;
                height: 60px;
                margin-left: -15px;
                margin-top: -15px;
                opacity: 0.0;
            }
        }

        @media screen and (max-width: 767px) {
            .wizard-content-left {
                height: auto;
            }
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

    <div class="wizard">
        <div class="card">
            <div class="form-wizard">
                <form action="" method="post" role="form">
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
                                    <option value="">Magang Fakultas</option>
                                    @foreach ($jenismagang as $j)
                                        <option value="{{ $j->id_jenismagang }}">{{ $j->namajenis }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="posisi" class="form-label">Posisi<span class="text-danger">*</span></label>
                                <input type="text" id="posisi" name="posisi" class="form-control"
                                    placeholder="Masukan Posisi Pekerjaan" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="kuota" class="form-label">Kuota Penerimaan<span
                                        class="text-danger">*</span></label>
                                <input type="int" id="kuota" name="kuota" class="form-control"
                                    placeholder="Masukkan Kuota Penerimaan" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="deskripsi" class="form-label">Deskripsi Pekerjaan <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" rows="2" placeholder="Masukan Deskripsi Pekerjaan" id="deskripsi" name="deskripsi"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div>

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
                                <label for="gaji" class="form-label" id="gaji" name="gaji">Gaji
                                    Ditawarkan<span class="text-danger">*</span></label>
                                <div class="col mt-2">
                                    <div class="form-check form-check-inline">
                                        <input name="gaji" class="form-check-input" type="radio" value="1"
                                            checked />
                                        <label class="form-check-label" for="gaji">Berbayar</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="gaji" class="form-check-input" type="radio" value="2" />
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
                            <div class="col mb-2 form-input">
                                <label for="lokasi" class="form-label">Lokasi Pekerjaan<span
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
                                        <input class="form-control" type="date" id="tanggal" name="tanggalmulai"
                                            placeholder="Masukan Tanggal Ditayangkan" id="html5-date-input" />
                                    </div>
                                    <div class = "mt-3"
                                        style="text-align: center; background-color: black; width: 14px; height: 1px; margin: 0 20px">
                                    </div>
                                    <div style="flex: 1;">
                                        <label for="tanggal" class="form-label">Tanggal Lowongan Diturunkan
                                            <span class="text-danger">*</span></label>
                                        <input class="form-control" type="date" id="tanggal" name="tanggalakhir"
                                            placeholder="Masukan Tanggal Diturunkan" id="html5-date-input" />
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
                                        <input name="tahapan" class="form-check-input" type="radio" value="2" />
                                        <label class="form-check-label" for="tahapan">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="tahapan" class="form-check-input" type="radio" value="3" />
                                        <label class="form-check-label" for="tahapan">3</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix text-end">
                            <a href="javascript:;" class="form-wizard-next-btn float-right">Next<i
                                    class="ti ti-arrow-right ms-2 mb-1"></i></a>
                        </div>
                    </fieldset>
                    <fieldset class="wizard-fieldset">
                        <h5>Account Information</h5>
                        <div class="row">
                            <div class="mb-2">
                                <label for="seleksi" class="form-label">Jenis Seleksi Tahap Lanjut</label>
                                <select class="form-select select2" id="seleksifilter" name="seleksi"
                                    data-placeholder="Pilih Status Seleksi">
                                    <option value="Seleksi Tahap 1"> Seleksi Tahap 1</option>
                                    <option value="Seleksi Tahap 2"> Seleksi Tahap 2</option>
                                    <option value="Seleksi Tahap 3"> Seleksi Tahap 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2">
                                <label for="pelaksanaan" class="form-label d-block">Jenis Pelaksanaan<span
                                        class="text-danger">*</span></label>
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="pelaksanaan" id="pelaksanaan1"
                                        value="0">
                                    <label class="form-check-label" for="0">Onsite</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pelaksanaan" id="pelaksanaan2"
                                        value="1">
                                    <label class="form-check-label" for="1">Online</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="detail" class="form-label">Detail Pelaksanaan<span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" rows="2" placeholder="Masukan Detail Pelaksanaan" id="detail"
                                    name="detail"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
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
                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="tempat" class="form-label">Detail Pelaksanaan</label>
                                <input type="text" class="form-control" id="tempat"
                                    placeholder="Masukan Alamat/Link Pelaksanaan"
                                    aria-describedby="defaultFormControlHelp" name="tempat">
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col text-start">
                                    <a href="javascript:;" class="form-wizard-previous-btn float-left"><i
                                            class="ti ti-arrow-left ms-2 mb-1"></i>Previous</a>
                                </div>
                                <div class="col text-end">
                                    <a href="javascript:;" class="form-wizard-next-btn float-right">Next<i
                                            class="ti ti-arrow-right ms-2 mb-1"></i></a>
                                </div>
                            </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
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
