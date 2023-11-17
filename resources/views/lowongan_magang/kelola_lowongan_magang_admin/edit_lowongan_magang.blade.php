@extends('partials_admin.template')

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <style>

    </style>
@endsection

@section('main')
    <div class="row ">
        <div class="col-md-12 col-12"> 
            <nav aria-label="breadcrumb">
                <h4>
                    <ol class="breadcrumb breadcrumb-style1">
                        <li class="breadcrumb-item text-secondary">
                            Lowongan Magang
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/halaman-lowongan-magang" class="text-secondary">Kelola Magang</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Lowongan Magang</li>
                    </ol>
                </h4>
            </nav>
            <!-- <h4 class="fw-bold"><span class="text-muted fw-light">Lowongan Magang /</span> <span class="text-muted fw-light">Informasi Lowongan /</span> Fullstack Developer - Tahun Ajaran 2324</h4> -->
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
                        
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun Ajaran<span class="text-danger">*</span></label>
                            <div class="select2-success">
                                <select id="select2Success" class="select2 form-select"
                                    data-placeholder="Pilih Tahun Ajaran" multiple>
                                    <option value="1">2023/2024 - Ganjil</option>
                                    <option value="2">2023/2024 - Genap</option>
                                    <option value="3">2023/2024 - Ganjil</option>
                                    <option value="4">2023/2024 - Genap</option>
                                    <option value="3">2023/2024 - Ganjil</option>
                                    <option value="4">2023/2024 - Genap</option>
                                </select>
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
                                <div class="mb-2">
                                    <label for="fakultas" class="form-label">Fakultas <span class="text-danger">*</span></label>
                                    <select id="select2basic" class="selectpicker w-100" data-style="btn-default"
                                        placeholder="Pilih Fakultas">
                                        <option>Fakultas Ilmu Terapan</option>
                                        <option>Fakultas Komunikasi Bisnis</option>
                                        <option>Fakultas Industri Kreatif</option>
                                        <option>Fakultas Ekonomi Bisnis</option>
                                    </select>
                                </div>

                                <div class="mb-2 select2-success">
                                    <label for="lastName" class="form-label">Program Studi <span class="text-danger">*</span></label>
                                    <select id=" select2-success" class=" select2 form-select"
                                        data-placeholder="Pilih Program Studi" data-live-search="true" multiple>
                                        <option value="D3 Rekayasa Perangkat Lunak Aplikasi">D3 Rekayasa Perangkat Lunak Aplikasi</option>
                                        <option value="D3 Sistem Informasi">D3 Sistem Informasi</option>
                                        <option value="D3 Teknologi Komputer">D3 Teknologi Komputer</option>
                                        <option value="D3 Teknologi Rekayasa Media">D3 Teknologi Rekayasa Media</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 select2-success">
                            <label for="fakultas" class="form-label">Keterampilan <span class="text-danger">*</span></label>
                            <select id="select2-success" class="select2 form-select" data-placeholder="Pilih Fakultas"
                                multiple>
                                <option>PostgreSQL</option>
                                <option>Figma</option>
                                <option>PHP Native</option>
                                <option>Sketch</option>
                            </select>
                            <label for="" style="font-size: 13px">Jika keterampilan belum terdaftar silahkan ketik
                                manual</label>
                        </div>
                        <div class="mb-3">
                            <label class="switch switch-success">
                                <input type="checkbox" class="switch-input" />
                                <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                </span>
                                <span class="switch-label">Tidak Berbayar</span>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="kualifikasi" class="form-label">Gaji Ditawarkan <span class="text-danger">*</span></label>
                            <div style="display: flex; justify-content: space-between; align-items: center;">

                                <div style="flex: 1;">

                                    <input type="text" id="multicol-first-name" class="form-control"
                                        placeholder="Gaji Minimum" style="width: 100%;" />
                                </div>
                                <div
                                    style="text-align: center; background-color: black; width: 14px; height: 1px; margin: 0 20px">
                                </div>
                                <div style="flex: 1;">
                                    <input type="text" id="multicol-last-name" class="form-control"
                                        placeholder="Gaji Maksimum" style="width: 100%;" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-message">Benefits (Addtional)</label>
                            <textarea id="basic-default-message" class="form-control" placeholder="Masukan kualifikasi mahasiswa"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="select2Success" class="form-label">Lokasi Pekerjaan</label>
                            <div class="select2-success">
                                <select id="select2success" class="select2 form-select"
                                    data-placeholder="Masukan Lokasi Pekerjaan" multiple>
                                    <option value="1">Bandung</option>
                                    <option value="2">Jakarta</option>
                                    <option value="3">Yogyakarta</option>
                                    <option value="4">Malang</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div style="flex: 1;">
                                    <label for="kualifikasi" class="form-label">Tanggal Lowongan Ditayangkan <span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" placeholder="Masukan Tanggal Diturunkan"
                                        id="html5-date-input" />

                                </div>
                                <div class = "mt-3"
                                    style="text-align: center; background-color: black; width: 14px; height: 1px; margin: 0 20px">
                                </div>
                                <div style="flex: 1;">
                                    <label for="kualifikasi" class="form-label">Tanggal Lowongan Diturunkan <span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" placeholder="Masukan Tanggal Diturunkan"
                                        id="html5-date-input" />
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="durasi" class="form-label">Durasi Magang<span class="text-danger">*</span></label>
                            <div class="select2-success">
                                <select id="select2Primary" class="select2 form-select" multiple>
                                    <option value="1">1 Semester</option>
                                    <option value="2">2 Semester</option>
                                </select>
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
@endsection
