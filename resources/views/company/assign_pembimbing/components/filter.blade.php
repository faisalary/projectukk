<div class="offcanvas offcanvas-end" tabindex="-1" id="modalSlide" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title" style="padding-left: 15px;">Filter Berdasarkan
        </h5>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="filter">
            <div class="col-12 mb-2">
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="posisi" class="form-label" style="padding-left: 15px;">Posisi Lowongan Magang</label>
                        <select class="form-select select2" id="id_lowongan" name="id_lowongan" data-placeholder="Pilih Posisi Lowongan Magang">
                            <option disabled selected value="">Pilih Posisi Lowongan Magang</option>
                            @foreach($posisi as $item)
                                <option value="{{ $item->id_lowongan }}">{{ $item->intern_position }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="prodi" class="form-label" style="padding-left: 15px;">Program Studi</label>
                        <select class="form-select select2" id="program_studi" name="program_studi.id_prodi"
                            data-placeholder="Pilih Program Studi">
                            <option disabled selected value="">Pilih Program Studi</option>
                            @foreach ($prodi as $item)
                                <option value="{{ $item->id_prodi }}">{{ $item->namaprodi }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="mt-3 text-end">
                    <button type="button" class="btn btn-label-danger" id="data-reset">Reset</button>
                    <button type="submit" class="btn btn-success">Terapkan</button>
                </div>
            </div>
        </form>
    </div>
</div>