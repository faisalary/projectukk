{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambahMitra" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalTambahMitra">Tambah Mitra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ route('kelola_mitra.store') }}">
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
</div>

{{-- Modal edit --}}
<div class="modal fade" id="modalEditMitra" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modalEditMitra">Edit Mitra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2">
                        <label for="nama" class="form-label">Nama Mitra</label>
                        <input type="text" id="nama" class="form-control" placeholder="Nama Mitra" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" class="form-control" placeholder="Email" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" placeholder="Alamat"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="deskripsi" class="form-label">Deskripsi Perusahaan</label>
                        <textarea class="form-control" id="deskripsi" placeholder="Deskripsi Perusahaan"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="formValidationFile" class="form-label">NPWP Perusahaan</label>
                        <input class="form-control" type="file" id="formValidationFile"
                            name="formValidationFile" />
                        <label for="formValidationFile" class="form-label">Allowed JPG, PNG or PDF.
                            Max
                            size of 800Kb</label>
                    </div>
                </div>
                <div class="row">
                    <form class="form-repeater">
                        <div data-repeater-list="group-a">
                            <div data-repeater-item>
                                <div class="row">
                                    <div class="col-4 mb-2" style="padding-right:0px;">
                                        <label class="form-label" for="form-repeater-1-4">Sosial
                                            Media</label>
                                        <select id="form-repeater-1-4" class="form-select">
                                            <option value="Instagram">Instagram</option>
                                            <option value="LinkedIn">LinkedIn</option>
                                            <option value="Facebook">Facebook</option>
                                            <option value="Twitter">Twitter</option>
                                        </select>
                                    </div>
                                    <div class="col-7" style="margin-top:3px;">
                                        <label class="form-label" for="form-repeater-1-1"></label>
                                        <input type="text" id="form-repeater-1-1" class="form-control"
                                            placeholder="Usename" />
                                    </div>
                                    <div class="col-1" style="padding-left:0px;">
                                        <button class="btn btn-outline-danger waves-effect"
                                            style="width: 10px;     margin-top: 25px;" data-repeater-delete>
                                            <i class="tf-icons ti ti-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-1 mb-0">
                            <button class="btn btn-outline-success waves-effect" data-repeater-create>
                                <i class="ti ti-plus me-1"></i>
                                <span class="align-middle">Add</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
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
