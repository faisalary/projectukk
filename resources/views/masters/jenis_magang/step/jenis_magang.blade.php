<div class="content active">
    <div class="content-header mb-3">
        <h6 class="mb-0">Informasi Umum Magang</h6>
    </div>
    <div class="row g-3">
        <div class="col-6 form-group">
            <label class="form-label" for="namajenis">Jenis Magang<span class="text-danger">*</span></label>
            <input type="text" name="namajenis" onkeyup="this.value = this.value.replace(/[^a-zA-Z\s]+/gi, '');" id="namajenis" class="form-control" placeholder="Masukan Jenis Magang" />
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-6 form-group">
            <label for="durasimagang" class="form-label">Durasi Magang<span class="text-danger">*</span></label>
            <select name="durasimagang" id="durasimagang" class="form-control select2" data-placeholder="Pilih Durasi Magang">
                <option value="">Pilih Durasi Magang</option>
                <option value="1 Semester">1 Semester</option>
                <option value="2 Semester">2 Semester</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-12 form-group">
            <label for="id_year_akademik" class="form-label">Tahun Akademik<span class="text-danger">*</span></label>
            <select name="id_year_akademik" id="id_year_akademik" class="form-control select2" data-placeholder="Pilih Tahun Akademik">
                <option value="" selected disabled>Pilih Tahun Akademik</option>
                @foreach($tahun as $item)
                <option value="{{$item->id_year_akademik}}">{{$item->tahun}} {{$item->semester}}</option>
                @endforeach
            </select>
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