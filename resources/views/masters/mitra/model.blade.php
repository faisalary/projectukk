<!-- Modal -->
    <div class="modal fade" id="modalTambahMitra" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Mitra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ route('mitra.store') }}">
                @csrf

            <div class="modal-body">

                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="mitra" class="form-label">Nama Mitra</label>
                        <input type="text" id="mitra" name="namaindustri" class="form-control"
                            placeholder="Nama Mitra" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="telp" class="form-label">No Telepon</label>
                        <input type="text" id="telp" name="notelepon" class="form-control"
                            placeholder="No Telepon" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamatindustri"
                        placeholder="Alamat"></textarea>
                    <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="kmitra" class="form-label">Kategori Mitra</label>
                        <input type="text" id="kategori" name="kategorimitra" class="form-control"
                            placeholder="Kategori Mitra" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="modal-button" class="btn btn-success">Simpan</button>
            </div>
        </form>

        </div>
    </div>
</div>
