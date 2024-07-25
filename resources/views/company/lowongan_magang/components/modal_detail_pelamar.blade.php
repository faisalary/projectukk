<style>
    span.select2-dropdown.select2-dropdown--below {
        width: auto !important;
        max-width: 200px !important; 
        position: relative !important;
    }
</style>
<div class="offcanvas offcanvas-end" tabindex="-1" id="detail_pelamar_offcanvas" style="width: 45%;">
    <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <div class="d-flex justify-content-end w-100">
            <button class="btn btn-sm btn-primary" type="button">
                <i class="tf-icons ti ti-file-symlink"></i>
                Unduh Format CV
            </button>
            <div class="col-8" style="max-width:230px;">
                <select name="change_status" id="change_status" class="select2 form-select form-select-sm" data-placeholder="Ubah Status">
                    <option value="" disabled selected>Ubah Status</option>
                    @foreach ($listStatus as $key => $item)
                        <option value="{{ $item['value'] }}">{{ $item['label'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="offcanvas-body pt-1 flex-grow-0 h-100" id="container_detail_pelamar"></div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="filter" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title" style="padding-left: 15px;">Filter Berdasarkan
        </h5>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="filter">
            <div class="col-12 mb-2">
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="univ" class="form-label" style="padding-left: 15px;">Universitas</label>
                        <select class="form-select select2" id="univ" name="univ" data-placeholder="Pilih Universitas">
                            <option disabled selected>Pilih Universitas</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-2">
                        <label for="fakultas" class="form-label" style="padding-left: 15px;">Fakultas</label>
                        <select class="form-select select2" id="fakultas" name="fakultas" data-placeholder="Pilih Fakultas">
                            <option disabled selected>Pilih Fakultas</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="univ" class="form-label" style="padding-left: 15px;">Prodi</label>
                        <select class="form-select select2" id="prodi" name="prodi" data-placeholder="Pilih Prodi">
                            <option disabled selected>Pilih Prodi</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row cnt">
                    <div id="div1" class="targetDiv">
                        <div class="col mb-2 form-input">
                            <label for="univ" class="form-label" style="padding-left: 15px;">Status
                                Kandidat</label>
                            <select class="form-select select2" id="status" name="status" data-placeholder="Status Kandidat">
                                <option disabled selected>Pilih Status Kandidat</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3 text-end">
                <button type="button" class="btn btn-label-danger">Reset</button>
                <button type="submit" class="btn btn-success">Terapkan</button>
            </div>
        </form>
    </div>
</div>