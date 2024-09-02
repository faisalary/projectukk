<div class="modal fade" id="modal-nilai-akhir" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Presentase Nilai Akhir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" action="" function-callback="afterAction">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-2 form-group">
                            <label for="minimal" class="form-label">Program Studi<span class="text-danger">*</span></label>
                            <input type="text" id="minimal" class="form-control" name="nilaimin" placeholder="Program Studi" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-group">
                            <label for="maksimal" class="form-label">Presentase Nilai Pembimbing Lapangan (%)<span class="text-danger">*</span></label>
                            <input type="text" id="maksimal" class="form-control" name="nilaimax" placeholder="Presentase Nilai Pembimbing Lapangan" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-group">
                            <label for="mutu" class="form-label">Presentase Nilai Pembimbing Akademis (%)<span class="text-danger">*</span></label>
                            <input type="text" id="mutu" class="form-control" onkeyup="this.value = this.value.replace(/[^a-zA-Z\s]+/gi, '').toUpperCase();" name="nilaimutu" placeholder="Presentase Nilai Pembimbing Akademis" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button> -->
                    <button type="submit" id="modal-button" class="btn btn-success">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>