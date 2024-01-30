<div class="modal fade" id="modalTambahMitra" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahMitra">Tambah Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Nama Pengguna</label>
                            <input type="text" id="nama" class="form-control"
                                placeholder="Masukkan Nama Pengguna" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="telepon" class="form-label">No.Telepon</label>
                            <input type="text" id="nohp" class="form-control"
                                placeholder="Masukan No. Telepon" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" class="form-control" placeholder="Masukan Email" />
                        </div>
                    </div>
                    <label for="select2Basic" class="form-label">Role</label>
                    <select id="role" class="select2 form-select" data-placeholder="Pilih Role">
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="AK">Dosen Wali</option>
                        <option value="HI">Pembimbing Akademik</option>
                        <option value="CA">Kaprodi</option>
                        <option value="NV">Koordinator Magang</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" id="modal-button" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
