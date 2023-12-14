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
                        <div class="row">
                            <div class="col mb-3 form-input">
                            <label for="mitra" class="form-label">Mitra<span class="text-danger">*</span></label>
                            {{-- <select class="form-select select2" id="mitra" name="namaindustri" data-placeholder="Pilih Mitra">
                                <option disabled selected>Pilih Mitra</option>
                                @foreach($industri as $i)
                                <option value="{{ $i->id_industri }}">{{ $f->namaindustri }}</option>
                                @endforeach
                                <div class="invalid-feedback"></div>
                            </select> --}}
                            <select class="form-select select2" id="mitra" name="namaindustri" data-placeholder="Pilih Mitra">
                                <option disabled selected>Pilih Mitra</option>
                                <option value="4">industri</option>
                            </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3 form-input">
                                <label for="tahun" class="form-label">Tahun Ajaran<span class="text-danger">*</span></label>
                                {{-- <select class="form-select select2" id="tahun" name="tahun" data-placeholder="Pilih Tahun Ajaran">
                                    <option disabled selected>Pilih Tahun Ajaran</option>
                                    @foreach($tahun as $t)
                                    <option value="{{ $t->id_year_Akademik }}">{{ $t->tahun }}</option>
                                    @endforeach
                                </select> --}}
                                <select class="form-select select2" id="tahun" name="tahun" data-placeholder="Pilih Tahun Ajaran">
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

                        <div class="row">
                            <div class="col mb-3 form-input">
                                <label for="jenismagang" class="form-label">Jenis Magang<span class="text-danger">*</span></label>
                                {{-- <select class="form-select select2" id="jenis" name="jenismagang" data-placeholder="Pilih Jenis Magang">
                                    <option disabled selected>Pilih Jenis Magang</option>
                                    @foreach($jenismagang as $j)
                                    <option value="{{ $j->id_jenismagang }}">{{ $j->jenismagang }}</option>
                                    @endforeach
                                </select> --}}
                                <select class="form-select select2" id="jenismagang" name="jenismagang" data-placeholder="Pilih Jenis Magang">
                                    <option disabled selected>Pilih Jenis Magang</option>
                                    <option value="3">jenis magang</option>
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
                                <label for="bidang" class="form-label">Industri Pekerjaan<span class="text-danger">*</span></label>
                                <input type="text" id="bidang" name="bidang" class="form-control"
                                    placeholder="Masukkan Industri Pekerjaan" />
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
                                        <div class="col mb-3 form-input">
                                            <label for="fakultas" class="form-label">Fakultas<span class="text-danger">*</span></label>
                                            <select class="form-select select2" id="fakultas" name="fakultas" data-placeholder="Pilih Fakultas">
                                                <option disabled selected>Pilih Fakultas</option>
                                                @foreach($fakultas as $f)
                                                <option value="{{ $f->id_fakultas }}">{{ $f->namafakultas }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3 form-input">
                                            <label for="prodi" class="form-label">Program Studi<span class="text-danger">*</span></label>
                                            <select class="form-select select2" id="prodi" name="prodi" data-placeholder="Pilih Program Studi">
                                                <option disabled selected>Pilih Program Studi</option>
                                                <option value="D3 Rekayasa Perangkat Lunak Aplikasi">D3 Rekayasa Perangkat Lunak Aplikasi</option>
                                                <option value="D3 Sistem Informasi">D3 Sistem Informasi</option>
                                                <option value="D3 Teknologi Komputer">D3 Teknologi Komputer</option>
                                                <option value="D3 Teknologi Rekayasa Media">D3 Teknologi Rekayasa Media</option>
                                            </select>
                                            {{-- <select class="form-select select2" id="prodi" name="prodi" data-placeholder="Pilih Prodi">
                                                <option disabled selected>Pilih Prodi</option>
                                                @foreach($prodi as $p)
                                                    <option value="{{ $p->id_prodi }}">{{ $p->namaprodi }}</option>
                                                @endforeach
                                            </select> --}}
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-2 form-input">
                                <label for="TagifyCustomListSuggestion" class="form-label">Keterampilan<span class="text-danger">*</span></label>
                                <input
                                id="TagifyCustomListSuggestion"
                                name="TagifyCustomListSuggestion"
                                class="form-control"
                                placeholder="Pilih Keterampilan"/>
                                <label for="" style="font-size: 13px">Jika keterampilan belum terdaftar silahkan ketik manual</label>
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
                                <textarea class="form-control" rows="2" placeholder="Masukan kualifikasi mahasiswa" id="benefit" name="benefit"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3 form-input">
                                <label for="lokasi" class="form-label">Lokasi Pekerjaan<span class="text-danger">*</span></label>
                                <select class="form-select select2" id="lokasi" name="lokasi" data-placeholder="Masukan Lokasi Pekerjaan">
                                    <option disabled selected>Masukan Lokasi Pekerjaan</option>
                                    <option value="1">Bandung</option>
                                    <option value="2">Jakarta</option>
                                    <option value="3">Yogyakarta</option>
                                    <option value="4">Malang</option>
                                </select>
                                <div class="invalid-feedback"></div>
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
                            <div class="col mb-3 form-input">
                                <label for="durasimagang" class="form-label">Durasi Magang<span class="text-danger">*</span></label>
                                <select class="form-select select2" type="int" id="durasimagang" name="durasimagang" data-placeholder="Pilih Durasi Magang">
                                    <option disabled selected>Pilih Durasi Magang</option>
                                    <option value="1">1 Semester</option>
                                    <option value="2">2 Semester</option>
                                </select>
                                <div class="invalid-feedback"></div>
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

                        <div class="row">
                            <div class="col mb-3 form-input">
                                <label for="pelaksaan" class="form-label" id="pelaksanaan" name="pelaksanaan">Berapa Banyak Tahapan Seleksi<span class="text-danger">*</span></label>
                                <div class="col mt-2">
                                    <div class="form-check form-check-inline">
                                        <input name="pelaksaan" class="form-check-input" type="radio" value="" checked />
                                        <label class="form-check-label" for="pelaksaan">online</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="pelaksaan" class="form-check-input" type="radio" value=""/>
                                        <label class="form-check-label" for="pelaksaan">offline</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="pelaksaan" class="form-check-input" type="radio" value=""/>
                                        <label class="form-check-label" for="pelaksaan"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="/kelola/lowongan">
                            <button type="submit" id="modal-button" class="btn btn-success">Simpan</button></a>
                        </div>
                    </div>
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
@endsection
