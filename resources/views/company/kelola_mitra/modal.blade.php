{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambahMitra" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Mitra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ route('kelola_mitra.store') }}">
                @csrf

                <div class="modal-body">

                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="nama" class="form-label">Nama Perusahaan</label>
                            <input type="text" id="nama" name="namaindustri"class="form-control"
                                placeholder="Nama Perusahaan" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" name="email" class="form-control"
                                placeholder="Email" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="kategori" class="form-label">Pilih Kategori Mitra</label>
                            <select class="form-select select2" id="kategori" name="kategori_industri"
                                data-placeholder="Pilih Kategori Mitra">
                                <option disabled selected>Pilih Kategori Mitra</option>
                                <option value="Internal">Internal</option>
                                <option value="Eksternal">Eksternal</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="statuskerjasama" class="form-label">Pilih Status Kerjasama</label>
                            <select class="form-select select2" id="statuskerjasama" name="statuskerjasama"
                                data-placeholder="Pilih Status Kerjasama">
                                <option disabled selected>Pilih Status Kerjasama</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                                <option value="Internal Telyu">Internal Tel-u</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="simpanButton">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal edit --}}
{{-- <div class="modal fade" id="modalEditMitra" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" >Edit Mitra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ route('kelola_mitra.update') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-2">
                            <label for="nama" class="form-label">Nama Perusahaan</label>
                            <input type="text" id="nama" name="namaindustri"class="form-control" placeholder="Nama Perusahaan" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Email" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="kategori" class="form-label">Pilih Kategori Mitra</label>
                            <select class="form-select select2" id="kategori" name="kategori_industri"
                                data-placeholder="Kategori Mitra">
                                <option disabled selected>Pilih Kategori Mitra</option>
                                <option value="Internal">Internal</option>
                                <option value="Eksternal">Eksternal</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="statuskerjasama" class="form-label">Pilih Status Kerjasama</label>
                            <select class="form-select select2" id="status" name="statuskerjasama"
                                data-placeholder="Status Kerjasama">
                                <option disabled selected>Pilih Status Kerjasama</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                                <option value="Internal Telyu">Internal Tel-u</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="simpanButton">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}
{{-- Modal Reject --}}
<div class="modal fade" id="modalreject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalreject">Alasan Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                        <label for="alasan" class="form-label">Alasan Penolakan</label>
                        <textarea class="form-control" id="alasam" placeholder="Alasan Penolakan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
