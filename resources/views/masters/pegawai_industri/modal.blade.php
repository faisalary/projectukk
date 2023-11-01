<!-- Modal -->
<div class="modal fade" id="modalTambahPegawai" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Pegawai Industri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ route('pegawaiindustri.store') }}">
                @csrf

            <div class="modal-body">

                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="namapeg" class="form-label">Nama Pegawai</label>
                        <div class="col mb-2">
                            <input type="text" id="namapegawai" name="namapeg" class="form-control"
                                placeholder="Nama Pegawai" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <select class="form-select select2" id="namaperusahaan" name="namaperusahaan" data-placeholder="Pilih Perusahaan">
                            <option disabled selected>Pilih Perusahaan</option>
                            @foreach($industri as $i)
                                <option value="{{ $i->id_industri}}">{{ $i->namaindustri}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="telp" class="form-label">No Telepon</label>
                        <div class="row">
                            <div class="col mb-2">
                                <input type="text" id="telp" name="nohppeg" class="form-control"
                                    placeholder="No Telepon" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <input type="text" id="email" name="emailpeg" class="form-control"
                            placeholder="Email" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan" class="form-control"
                            placeholder="Jabatan" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" id="unit" name="unit" class="form-control"
                            placeholder="Unit" />
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
