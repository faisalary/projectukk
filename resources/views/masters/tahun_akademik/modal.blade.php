<div class="modal fade" id="modal-thn-akademik" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Tahun Akademik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ route('thn-akademik.store') }}">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="tahun" class="form-label">Tahun Ajaran</label>
                            <input type="text" id="tahun" class="form-control" name="tahun" placeholder="Masukkan Tahun Ajaran">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="mb-2 form-input">
                        <label for="semester" class="form-label">Semester</label>
                        <select class="form-select select2" id="semester" name="semester" data-placeholder="Pilih Semester">
                            <option value="" disabled selected>Pilih Semester</option>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                        <div class="invalid-feedback"></div>
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