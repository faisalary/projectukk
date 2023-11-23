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

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="mitra" class="form-label">Mitra<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="mitra"
                                placeholder="Masukan Nama Mitra" />
                        </div>

                        <div class="row">
                            <div class="col mb-3 form-input">
                                <label for="tahun" class="form-label">Tahun Ajaran<span class="text-danger">*</span></label>
                                <select class="form-select select2" id="tahunajaran" name="tahun ajaran" data-placeholder="Pilih Tahun Ajaran">
                                    <option disabled selected>Pilih Tahun Ajaran</option>
                                    <option value="1">2023/2024 - Ganjil</option>
                                    <option value="2">2023/2024 - Genap</option>
                                    <option value="3">2023/2024 - Ganjil</option>
                                    <option value="4">2023/2024 - Genap</option>
                                    <option value="3">2023/2024 - Ganjil</option>
                                    <option value="4">2023/2024 - Genap</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="posisi" class="form-label">Posisi<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="posisi"
                                placeholder="Masukan Posisi Pekerjaan" />
                        </div>
                        <div class="mb-3">
                            <label for="kuota penerimaan" class="form-label">Kuota Penerimaan<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kuotapenerimaan"
                                placeholder="Masukkan Kuota Penerimaan" />
                        </div>
                        <div class="mb-3">
                            <label for="industri" class="form-label">Industri Pekerjaan<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="industri"
                                placeholder="Masukkan Industri Pekerjaan" />
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Pekerjaan <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="2" placeholder="Masukan Deskripsi Pekerjaan" id="deskripsi"></textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        <div class="mb-3">
                            <label for="kualifikasi" class="form-label">Requirements <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="2" placeholder="Masukan Kualifikasi Mahasiswa" id="kualifikasi"></textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        <div class="mb-3">
                            <div class="border py-2 px-3 rounded-3">
                                <label class="form-label" for="basic-default-company">
                                    Kualifikasi Pendidikan
                                </label>

                                <div class="row">
                                    <div class="col mb-3 form-input">
                                        <label for="fakultas" class="form-label">Fakultas<span class="text-danger">*</span></label>
                                        <select class="form-select select2" id="fakultas" name="fakultas" data-placeholder="Pilih Fakultas">
                                            <option disabled selected>Pilih Fakultas</option>
                                            <option>Fakultas Ilmu Terapan</option>
                                            <option>Fakultas Komunikasi Bisnis</option>
                                            <option>Fakultas Industri Kreatif</option>
                                            <option>Fakultas Ekonomi Bisnis</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col mb-3 form-input">
                                        <label for="programstudi" class="form-label">Program Studi<span class="text-danger">*</span></label>
                                        <select class="form-select select2" id="program" name="program studi" data-placeholder="Pilih Program Studi">
                                            <option disabled selected>Pilih Program Studi</option>
                                            <option value="D3 Rekayasa Perangkat Lunak Aplikasi">D3 Rekayasa Perangkat Lunak Aplikasi</option>
                                            <option value="D3 Sistem Informasi">D3 Sistem Informasi</option>
                                            <option value="D3 Teknologi Komputer">D3 Teknologi Komputer</option>
                                            <option value="D3 Teknologi Rekayasa Media">D3 Teknologi Rekayasa Media</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label for="TagifyCustomListSuggestion" class="form-label">Keterampilan<span class="text-danger">*</span></label>
                            <input
                              id="TagifyCustomListSuggestion"
                              name="TagifyCustomListSuggestion"
                              class="form-control"
                              placeholder="Pilih Keterampilan"/>
                              <label for="" style="font-size: 13px">Jika keterampilan belum terdaftar silahkan ketik manual</label>
                          </div>

                        <div class="mb-3">
                            <label for="gaji" class="form-label">Gaji Ditawarkan<span class="text-danger">*</span></label>
                            <div class="col mt-2">
                                <div class="form-check form-check-inline">
                                    <input name="collapsible-address-type" class="form-check-input" type="radio"
                                        value="" id="collapsible-address-type-home" checked />
                                    <label class="form-check-label" for="collapsible-address-type-home">Berbayar</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="collapsible-address-type" class="form-check-input" type="radio"
                                        value="" id="collapsible-address-type-home" />
                                    <label class="form-check-label" for="collapsible-address-type-home">Tidak Berbayar</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-message">Benefits (Addtional)</label>
                            <textarea id="basic-default-message" class="form-control" placeholder="Masukan kualifikasi mahasiswa"></textarea>
                        </div>

                        <div class="row">
                            <div class="col mb-3 form-input">
                                <label for="lokasi" class="form-label">Lokasi Pekerjaan<span class="text-danger">*</span></label>
                                <select class="form-select select2" id="lokasi" name="tahun ajaran" data-placeholder="Masukan Lokasi Pekerjaan">
                                    <option disabled selected>Masukan Lokasi Pekerjaan</option>
                                    <option value="1">Bandung</option>
                                    <option value="2">Jakarta</option>
                                    <option value="3">Yogyakarta</option>
                                    <option value="4">Malang</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div style="flex: 1;">
                                    <label for="tanggal" class="form-label">Tanggal Lowongan Ditayangkan <span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" placeholder="Masukan Tanggal Ditayangkan"
                                        id="html5-date-input" />
                                </div>
                                <div class = "mt-3"
                                    style="text-align: center; background-color: black; width: 14px; height: 1px; margin: 0 20px">
                                </div>
                                <div style="flex: 1;">
                                    <label for="tanggal" class="form-label">Tanggal Lowongan Diturunkan <span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" placeholder="Masukan Tanggal Diturunkan"
                                        id="html5-date-input"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3 form-input">
                                <label for="durasi" class="form-label">Durasi Magang<span class="text-danger">*</span></label>
                                <select class="form-select select2" id="durasi" name="durasi magang" data-placeholder="Pilih Durasi Magang">
                                    <option disabled selected>Pilih Durasi Magang</option>
                                    <option value="1">1 Semester</option>
                                    <option value="2">2 Semester</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tahapan" class="form-label">Berapa Banyak Tahapan Seleksi<span class="text-danger">*</span></label>
                            <div class="col mt-2">
                                <div class="form-check form-check-inline">
                                    <input name="collapsible-address-type" class="form-check-input" type="radio"
                                        value="" id="collapsible-address-type-home" checked />
                                    <label class="form-check-label" for="collapsible-address-type-home">1</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="collapsible-address-type" class="form-check-input" type="radio"
                                        value="" id="collapsible-address-type-home" />
                                    <label class="form-check-label" for="collapsible-address-type-home">2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="collapsible-address-type" class="form-check-input" type="radio"
                                        value="" id="collapsible-address-type-home" />
                                    <label class="form-check-label" for="collapsible-address-type-home">3</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
    <script src="../../app-assets/vendor/libs/tagify/tagify.js"></script>
    <script src="../../app-assets/js/forms-tagify.js"></script>
@endsection
