<div class="content">
    <div class="content-header mb-3">
        <h4 class="mb-0">Kualifikasi Lowongan </h4>
    </div>
    <div class="row g-3">
        <div class="col-lg-12 col-sm-6 form-group">
            <label for="kualifikasi" class="form-label">Requirements <span class="text-danger">*</span></label>
            <textarea class="form-control" rows="3" id="kualifikasi" name="kualifikasi" placeholder="Masukan Kualifikasi Mahasiswa" required></textarea>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-12 col-sm-6 form-group">
            <label class="form-label">Jenis kelamin<span class="text-danger">*</span></label>
            <div class="col mt-2">
                <div class="form-check form-check-inline">
                    <input name="jenis_kelamin" id="laki-laki" class="form-check-input" type="radio" value="Laki-Laki" />
                    <label class="form-check-label" for="laki-laki">Laki-Laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="jenis_kelamin" id="perempuan" class="form-check-input" type="radio" value="Perempuan" />
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="jenis_kelamin" id="laki-laki_perempuan" class="form-check-input " type="radio" value="Laki-Laki & Perempuan" />
                    <label class="form-check-label" for="laki-laki_perempuan">Laki-Laki & Perempuan</label>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-6">
            <div class="border px-3 pb-3 pt-2 rounded-3">
                <span>Kualifikasi Pendidikan</span>
                <div class="form-group mt-2">
                    <label for="jenjang" class="form-label">Jenjang<span class="text-danger">*</span></label>
                    <select name="jenjang" id="jenjang" multiple="multiple" class="select2 form-select" data-placeholder="Pilih Jenjang">
                        <option value="D3">D3</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label" for="fakultas">Fakultas<span class="text-danger">*</span></label>
                    <select name="fakultas" id="fakultas" class="select2 form-select" data-placeholder="Pilih Fakultas" onchange="getDataSelect($(this))" data-after="id_prodi">
                        <option value="" selected disabled>Pilih Fakultas</option>
                        @foreach ($fakultas as $f)
                        <option value="{{ $f->id_fakultas }}">{{ $f->namafakultas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="id_prodi" class="form-label">Prodi<span class="text-danger">*</span></label>
                    <select name="id_prodi" id="id_prodi" class="select2 form-select" data-placeholder="Pilih Prodi" disabled>
                        <option value="" disabled selected>Pilih Prodi</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
        </div>
        <div class="form-group col-lg-12 col-sm-6">
            <label for="keterampilan" class="form-label">Keterampilan<span class="text-danger">*</span></label>
            <select name="keterampilan" id="keterampilan" multiple="multiple" class="select2 form-select" data-placeholder="Pilih Keterampilan" data-tags="true">
                <option value="Figma">Figma</option>
                <option value="Teamwork">Teamwork</option>
                <option value="Leadership">Leadership</option>
                <option value="Laravel">Laravel</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-lg-12 col-sm-6">
            <label for="pelaksanaan" class="form-label">Pelaksanaan Magang<span class="text-danger">*</span></label>
            <div class="col mt-2">
                <div class="form-check form-check-inline">
                    <input name="pelaksanaan" id="pelaksanaan_online" class="form-check-input" type="radio" value="Online" />
                    <label class="form-check-label" for="pelaksanaan_online">Online</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="pelaksanaan" id="pelaksanaan_onsite" class="form-check-input" type="radio" value="Onsite" />
                    <label class="form-check-label" for="pelaksanaan_onsite">Onsite</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="pelaksanaan" id="pelaksanaan_hybrid" class="form-check-input" type="radio" value="Hybrid" />
                    <label class="form-check-label" for="pelaksanaan_hybrid">Hybrid</label>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-lg-12 col-sm-6">
            <label for="gaji" class="form-label d-block">Uang Saku<span class="text-danger">*</span></label>
            <div class="col mt-2">
                <div class="form-check form-check-inline">
                    <input name="gaji" id="gaji_ya" class="form-check-input" type="radio" value="1" />
                    <label class="form-check-label" for="gaji_ya">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="gaji" id="gaji_tidak" class="form-check-input" type="radio" value="0" />
                    <label class="form-check-label" for="gaji_tidak">Tidak</label>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-lg-12 col-sm-6" style="display: none;">
            <label class="form-label" for="nominal">Nominal Uang Saku<span class="text-danger">*</span></label>
            <input type="text" name="nominal" id="nominal" class="form-control" />
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-lg-12 col-sm-6">
            <label for="benefit" class="form-label">Benefits (Addtional)</label>
            <textarea class="form-control" rows="2" id="benefit" name="benefit" placeholder="Masukan Benefits"></textarea>
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-lg-12 col-sm-6">
            <label for="lokasi" class="form-label">Lokasi Penempatan<span class="text-danger">*</span></label>
            <select name="lokasi" id="lokasi" multiple="multiple" class="select2 form-select" data-placeholder="Masukan Lokasi Pekerjaan" data-tags="true"></select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-12 col-sm-6">
            <div class="d-flex justify-content-center">
                <div class="form-group me-4" style="flex: 1;">
                    <label for="tanggal" class="form-label">Tanggal Lowongan Ditayangkan<span class="text-danger">*</span></label>
                    <input class="form-control flatpickr-date" type="text" id="tanggal" name="tanggal" placeholder="YYYY-MM-DD" readonly="readonly">
                    <div class="invalid-feedback"></div>
                </div>
                {{-- <div class="mt-3" style="text-align: center; background-color: black; width: 14px; height: 1px; margin: 0 20px"></div> --}}
                <div class="form-group ms-4" style="flex: 1;">
                    <label for="tanggalakhir" class="form-label">Tanggal Lowongan Diturunkan<span class="text-danger">*</span></label>
                    <input class="form-control flatpickr-date" type="text" id="tanggalakhir" name="tanggalakhir" placeholder="YYYY-MM-DD" readonly="readonly">
                    <div class="invalid-feedback"></div>
                </div>
            </div>
        </div>
        <div class="form-group col-lg-12 col-sm-6">
            <label for="durasimagang" class="form-label">Durasi Magang<span class="text-danger">*</span></label>
            <select name="durasimagang" id="durasimagang" multiple="multiple" class="select2 form-select" data-placeholder="Pilih Durasi Magang">
                <option value="1 Semester">1 Semester</option>
                <option value="2 Semester">2 Semester</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-lg-12 col-sm-6">
            <label for="tahapan" class="form-label">Tahapan Magang<span class="text-danger">*</span></label>
            <div class="col mt-2">
                <div class="form-check form-check-inline">
                    <input name="tahapan" id="tahapan_1" class="form-check-input" type="radio" value="0" />
                    <label class="form-check-label" for="tahapan_1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="tahapan" id="tahapan_2" class="form-check-input" type="radio" value="1" />
                    <label class="form-check-label" for="tahapan_2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="tahapan" id="tahapan_3" class="form-check-input " type="radio" value="2" />
                    <label class="form-check-label" for="tahapan_3">3</label>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-12 d-flex justify-content-between">
            <button type="button" class="btn btn-label-secondary btn-prev">
                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-success button-next" type="button" data-step="{{ Crypt::encryptString("2") }}">
                <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                <i class="ti ti-arrow-right"></i>
            </button>
        </div>
    </div>
</div>