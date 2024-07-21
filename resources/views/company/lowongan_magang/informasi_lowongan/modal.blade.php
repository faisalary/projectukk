<!-- Modal Tambah-->
<div class="modal fade" id="modal-set-batas-confirm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto">Masukkan Tanggal Batas Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" action="" function-callback="afterSetConfirmClosing">
                @csrf
                <div class="modal-body pt-2">
                    <div class="row">
                        <div class="col mb-2 form-group">
                            <label for="date" class="form-label">Masukkan Tanggal<span class="text-danger">*</span></label>
                            <input type="text" class="form-control cursor-pointer flatpickr-date" name="date" id="date">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pt-0">
                    <button type="submit"class="btn btn-primary me-0" name="buttonSimpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
