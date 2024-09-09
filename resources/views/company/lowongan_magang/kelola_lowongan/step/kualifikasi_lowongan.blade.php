<div class="content">
    <div class="content-header mb-3">
        <h4 class="mb-0">Kualifikasi Lowongan </h4>
    </div>
    <div class="row g-3">
        <div class="col-lg-12 col-sm-6 form-group">
            <label for="requirements" class="form-label">Requirements <span class="text-danger">*</span></label>
            <textarea class="form-control" rows="3" id="requirements" name="requirements" placeholder="Masukan Kualifikasi Mahasiswa" required></textarea>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-12 col-sm-6 form-group">
            <label class="form-label">Jenis kelamin<span class="text-danger">*</span></label>
            <div class="col mt-2">
                <div class="form-check form-check-inline">
                    <input name="gender" id="laki-laki" class="form-check-input" type="radio" value="Laki-Laki" />
                    <label class="form-check-label" for="laki-laki">Laki-Laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="gender" id="perempuan" class="form-check-input" type="radio" value="Perempuan" />
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="gender" id="laki-laki_perempuan" class="form-check-input " type="radio" value="Laki-Laki & Perempuan" />
                    <label class="form-check-label" for="laki-laki_perempuan">Laki-Laki & Perempuan</label>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-12 col-sm-6">
            <div class="border px-3 pb-3 pt-2 rounded-3">
                <span>Kualifikasi Pendidikan</span>
                <div class="form-group mt-2">
                    <label for="jenjang" class="form-label">Jenjang<span class="text-danger">*</span></label>
                    <select name="jenjang[]" id="jenjang" multiple="multiple" class="select2 form-select" data-placeholder="Pilih Jenjang">
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
        </div>
        <div class="form-group col-lg-12 col-sm-6">
            <label for="keterampilan" class="form-label">Keterampilan<span class="text-danger">*</span></label>
            <select name="keterampilan[]" id="keterampilan" multiple="multiple" class="select2 form-select" data-placeholder="Pilih Keterampilan" data-tags="true">
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
        <div class="form-group col-lg-12 col-sm-6">
            <label class="form-label" for="nominal_salary">Nominal Uang Saku<span class="text-danger">*</span></label>
            <input type="text" name="nominal_salary" id="nominal_salary" class="form-control" placeholder="Masukan Nominal" />
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-lg-12 col-sm-6">
            <label for="benefitmagang" class="form-label">Benefits (Addtional)</label>
            <textarea class="form-control" rows="2" id="benefitmagang" name="benefitmagang" placeholder="Masukan Benefits"></textarea>
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-lg-12 col-sm-6">
            <label for="lokasi" class="form-label">Lokasi Penempatan<span class="text-danger">*</span></label>
            <select name="lokasi[]" id="lokasi" multiple="multiple" class="select2 form-select" data-placeholder="Masukan Lokasi Pekerjaan">
                @foreach($kota as $k)
                    <option value="{{ $k->name }}">{{ $k->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-12 col-sm-6">
            <div class="d-flex justify-content-center">
                <div class="form-group me-4" style="flex: 1;">
                    <label for="startdate" class="form-label">Tanggal Lowongan Ditayangkan<span class="text-danger">*</span></label>
                    <input class="form-control flatpickr-date" type="text" id="startdate" name="startdate" placeholder="YYYY-MM-DD" readonly="readonly">
                    <div class="invalid-feedback"></div>
                </div>
                {{-- <div class="mt-3" style="text-align: center; background-color: black; width: 14px; height: 1px; margin: 0 20px"></div> --}}
                <div class="form-group ms-4" style="flex: 1;">
                    <label for="enddate" class="form-label">Tanggal Lowongan Diturunkan<span class="text-danger">*</span></label>
                    <input class="form-control flatpickr-date" type="text" id="enddate" name="enddate" placeholder="YYYY-MM-DD" readonly="readonly">
                    <div class="invalid-feedback"></div>
                </div>
            </div>
        </div>
        <div class="form-group col-lg-12 col-sm-6">
            <label for="tahapan" class="form-label">Berapa Tahap Seleksi Magang?<span class="text-danger">*</span></label>
            <div class="col mt-2">
                <div class="form-check form-check-inline">
                    <input name="tahapan_seleksi" id="tahapan_1" class="form-check-input" type="radio" value="0" />
                    <label class="form-check-label" for="tahapan_1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="tahapan_seleksi" id="tahapan_2" class="form-check-input" type="radio" value="1" />
                    <label class="form-check-label" for="tahapan_2">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="tahapan_seleksi" id="tahapan_3" class="form-check-input " type="radio" value="2" />
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