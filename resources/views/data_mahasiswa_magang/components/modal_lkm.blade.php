<div class="modal fade" id="modal-spm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title">Upload Dokumen SPM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" action="{{ route('data_mahasiswa.upload_spm') }}" function-callback="afterUpload">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mb-3 form-group">
                            <label for="mulai_magang" class="form-label">Mulai Magang<span class="text-danger">*</span></label>
                            <input type="text" class="form-control cursor-pointer flatpickr-date" name="mulai_magang" id="mulai_magang">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-6 mb-3 form-group">
                            <label for="selesai_magang" class="form-label">selesai Magang<span class="text-danger">*</span></label>
                            <input type="text" class="form-control cursor-pointer flatpickr-date" name="selesai_magang" id="selesai_magang">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 mb-3 form-group">
                            <label for="dokumen" class="form-label">Dokumen SPM<span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="dokumen" id="dokumen">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" id="modal-button" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>
