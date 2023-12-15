@extends('partials_admin.template')

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/tagify/tagify.css" />
    <style>

    </style>
@endsection

@section('main')
    <div class="row ">
        <div class="">
            <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs">Lowongan Magang / </span>
                Tambah Lowongan Magang
            </h4>
        </div>
    </div>

    <form class="default-form" method="POST" action="{{ route('lowongan-magang.store') }}">
        @csrf

    <div class="modal-body">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-body">
                <div class="bs-stepper wizard-icons wizard-icons-example ms-5 me-5 mt-5">
                    <div class="bs-stepper-header">
                        <div class="step d-flex flex-column align-items-center">
                            <button type="button" class="btn rounded-pill btn-icon btn-success waves-effect waves-light mb-3">
                                1
                            </button>
                            <p>Detail Lowongan</p>
                        </div>
                        <hr style="width: 10%; height:60px; border-color: #4EA971; border-width: 3px;">
                        <div class="step d-flex flex-column align-items-center">
                            <button type="button" class="btn rounded-pill btn-icon btn-success waves-effect waves-light mb-3">
                                2
                            </button>
                            <p>Seleksi Lanjutan</p>
                        </div>
                        <hr style="width: 10%; height:60px; border-color: #D3D6DB; border-width: 3px;">
                        <div class="step d-flex flex-column align-items-center">
                            <button type="button" class="btn rounded-pill btn-icon btn-secondary waves-effect waves-light mb-3">
                                3
                            </button>
                            <p>Selesai</p>
                        </div>
                    </div>
                </div>

                {{-- <div class="row ">
                    <div class="">
                        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs">Lowongan Magang / </span>
                            Tambah Lowongan Magang
                        </h4>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col mb-3 form-input">
                        <label for="jenis" class="form-label">Jenis Magang</label>
                        <select name="jenismagang" id="jenismagang" class="form-select select2" data-placeholder="Jenis Magang">
                            <option value="">Magang Fakultas</option>
                            @foreach ($jenismagang as $j)
                            <option value="{{$j->id_jenismagang}}">{{$j->namajenis}}</option>
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
                        <label for="kuota" class="form-label">Kuota Penerimaan<span class="text-danger">*</span></label>
                        <input type="int" id="kuota" name="kuota" class="form-control"
                            placeholder="Masukkan Kuota Penerimaan" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="deskripsi" class="form-label">Deskripsi Pekerjaan <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="2" placeholder="Masukan Deskripsi Pekerjaan" id="deskripsi" name="deskripsi"></textarea>
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                </div>

                 <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="kualifikasi" class="form-label">Requirements <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="2" placeholder="Masukan Kualifikasi Mahasiswa" id="kualifikasi" name="kualifikasi"></textarea>
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
                                    <label for="jenjang" class="form-label">Jenjang<span class="text-danger">*</span></label>
                                    <input id="jenjang" name="jengjang" class="form-control"
                                    placeholder="Masukan Jenjang"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-2 form-input">
                                    <label for="bidang" class="form-label">Bidang Keilmuan<span class="text-danger">*</span></label>
                                    <input type="text" id="bidang" name="bidang" class="form-control"
                                        placeholder="Masukan Bidang Keilmuan" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="keterampilan" class="form-label">Keterampilan<span class="text-danger">*</span></label>
                        <input id="keterampilan" name="keterampilan" class="form-control"
                        placeholder="Pilih Keterampilan"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="gaji" class="form-label" id="gaji" name="gaji">Gaji Ditawarkan<span class="text-danger">*</span></label>
                        <div class="col mt-2">
                            <div class="form-check form-check-inline">
                                <input name="gaji" class="form-check-input" type="radio" value="1" checked />
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
                        <label for="benefit" class="form-label">Benefits (Addtional)<span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="2" id="benefit" name="benefit" placeholder="Masukan kualifikasi mahasiswa"></textarea>
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="lokasi" class="form-label">Lokasi Pekerjaan<span class="text-danger">*</span></label>
                        <input id="lokasi" name="lokasi" class="form-control"
                        placeholder="Masukan Lokasi Pekerjaan"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3 form-input">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="flex: 1;">
                                <label for="tanggal" class="form-label">Tanggal Lowongan Ditayangkan <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" id="tanggal" name="tanggalmulai" placeholder="Masukan Tanggal Ditayangkan"
                                    id="html5-date-input" />
                            </div>
                            <div class = "mt-3"
                                style="text-align: center; background-color: black; width: 14px; height: 1px; margin: 0 20px">
                            </div>
                            <div style="flex: 1;">
                                <label for="tanggal" class="form-label">Tanggal Lowongan Diturunkan <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" id="tanggal" name="tanggalakhir" placeholder="Masukan Tanggal Diturunkan"
                                    id="html5-date-input"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="durasimagang" class="form-label">Durasi Magang<span class="text-danger">*</span></label>
                        <input
                        id="durasimagang"
                        name="durasimagang"
                        class="form-control"
                        placeholder="Pilih Durasi Magang"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3 form-input">
                        <label for="tahapan" class="form-label" id="tahapan" name="tahapan">Berapa Banyak Tahapan Seleksi<span class="text-danger">*</span></label>
                        <div class="col mt-2">
                            <div class="form-check form-check-inline">
                                <input name="tahapan" class="form-check-input" type="radio" value="1" checked />
                                <label class="form-check-label" for="tahapan">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="tahapan" class="form-check-input" type="radio" value="2"/>
                                <label class="form-check-label" for="tahapan">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="tahapan" class="form-check-input" type="radio" value="3"/>
                                <label class="form-check-label" for="tahapan">3</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="/kelola/lowongan">
                    <button type="submit" id="modal-button" class="btn btn-success">Selanjutnya</button></a>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

{{-- <div class="row">
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
        <label for="detail" class="form-label">Detail Pelaksanaan<span class="text-danger">*</span></label>
        <textarea class="form-control" rows="2" placeholder="Masukan Detail Pelaksanaan" id="detail" name="detail"></textarea>
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
</div> --}}

@section('page_script')
    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
    <script src="../../app-assets/vendor/libs/tagify/tagify.js"></script>
    <script src="../../app-assets/js/forms-tagify.js"></script>
    <script src="../../app-assets/js/forms-tagify2.js"></script>
    <script src="../../app-assets/js/forms-tagify3.js"></script>
    <script src="../../app-assets/js/forms-tagify4.js"></script>
@endsection
