<div class="content active">
    <div class="content-header mb-3">
        <h6 class="mb-0">Detail Lowongan</h6>
    </div>
    <div class="row g-3">
        <div class="col-lg-12 col-sm-6 form-group">
            <label class="form-label" for="id_jenismagang">Jenis Magang<span class="text-danger">*</span></label>
            <select name="id_jenismagang" id="id_jenismagang" class="select2 form-select" data-placeholder="Jenis Magang">
                <option value="" disabled selected>Jenis Magang</option>
                @foreach ($jenismagang as $j)
                <option value="{{ $j->id_jenismagang }}">{{ $j->namajenis }} ({{ $j->durasimagang }})</option>
                @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-12 col-sm-6 form-group">
            <label class="form-label" for="intern_position">Posisi<span class="text-danger">*</span></label>
            <input type="text" name="intern_position" id="intern_position" class="form-control" placeholder="Masukan Posisi Pekerjaan" />
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-12 col-sm-6 form-group">
            <label class="form-label" for="kuota">Kuota Penerimaan<span class="text-danger">*</span></label>
            <input type="text" name="kuota" id="kuota" class="form-control" placeholder="Masukan Kuota Penerimaan" />
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-12 col-sm-6 form-group">
            <label class="form-label" for="deskripsi">Deskripsi Pekerjaan<span class="text-danger">*</span></label>
            <textarea class="form-control" rows="4" id="deskripsi" name="deskripsi" placeholder="Masukan Deskripsi Pekerjaan"></textarea>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-12 d-flex justify-content-between">
            <button type="button" class="btn btn-label-secondary" disabled>
                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary button-next" type="button" data-step="{{ Crypt::encryptString("1") }}">
                <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                <i class="ti ti-arrow-right"></i>
            </button>
        </div>
    </div>
</div>