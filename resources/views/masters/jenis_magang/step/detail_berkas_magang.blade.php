<!-- Berkas Magang -->
<div class="content">
    <div class="content-header">
        <h6 class="mb-0">Berkas Magang</h6>
    </div>
    <div class="row g-3 form-repeater">
        <input type="hidden" name="data_step" value="{{ Crypt::encryptString("2") }}">
        <div data-repeater-list="berkas">
            <div class="border-bottom" data-repeater-item>
                <div class="row my-4">
                    <div class="col-8 form-group">
                        <label class="form-label" for="namaberkas">Berkas Magang<span class="text-danger">*</span></label>
                        <input type="text" name="namaberkas" id="namaberkas" class="form-control" placeholder="Masukan Nama Berkas" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-4 form-group">
                        <label class="form-label">Status Upload<span class="text-danger">*</span></label>
                        <div class="d-flex justify-content-between align-items-center my-2">
                            <div class="form-check">
                                <input name="statusupload" id="statusupload" class="form-check-input" type="radio" value="1" />
                                <label class="form-check-label" for="statusupload">Wajib Upload</label>
                            </div>
                            <div class="form-check">
                                <input name="statusupload" id="statusupload2" class="form-check-input" type="radio" value="0" />
                                <label class="form-check-label" for="statusupload2">Tidak Wajib Upload</label>
                            </div>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 form-group">
                        <label class="form-label" for="template">Upload Template <span class="text-danger">*</span></label>
                        <div class="d-flex justify-content-between">
                            <input class="form-control" name="template" type="file" id="template">
                            <button type="button" class="btn btn-icon ms-3 btn-outline-danger" data-repeater-delete>
                                <i class="ti ti-trash ti-xs"></i>
                            </button>
                        </div>
                        <small>Tipe File: .PDF Maximum upload file size : 2 MB.</small>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-start mt-3">
            <button type="button" class="btn btn-outline-primary" data-repeater-create>
                <span class="align-middle">Tambah</span>
            </button>
        </div>
        <div class="col-12 d-flex justify-content-between mt-5">
            <button type="button" class="btn btn-label-secondary btn-prev">
                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button type="submit" class="btn btn-primary" id="modal-button">Submit</button>
        </div>
    </div>
</div>