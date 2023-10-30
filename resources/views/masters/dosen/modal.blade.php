<div class="modal fade" id="modal-dosen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Dosen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" id="" method="POST" action="{{ route('dosen.store') }}">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="univ" class="form-label">Universitas</label>
                            <select class="form-select select2" data-placeholder="Pilih Universitas" name="id_univ"
                                id="id_univ_add">
                                <option>Pilih Universitas</option>
                                @foreach ($dosen as $u)
                                    <option value="{{ $u->id_univ }}">{{ $u->namauniv }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="nip" class="form-label">NIP</label>
                            <input class="form-control" id="nip" name="nip" placeholder="NIP" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="kodedosen" class="form-label">Kode Dosen</label>
                            <input type="text" id="kodedosen" name="kodedosen" class="form-control"
                                placeholder="Kode Dosen" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="namadosen" class="form-label">Nama Dosen</label>
                            <input type="text" id="namadosen" name="namadosen" class="form-control"
                                placeholder="Nama Dosen" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="prodi" class="form-label">Prodi</label>
                            <select class="form-select select2" data-placeholder="Nama Prodi" name="id_prodi"
                                id="id_prodi_add">
                                <option>Pilih prodi</option>
                                @foreach ($dosen as $p)
                                    <option value="{{ $p->id_prodi }}">{{ $p->namaprodi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="nohpdosen" class="form-label">No Telepon</label>
                            <input type="text" id="nohpdosen" name="nohpdosen" class="form-control"
                                placeholder="No Telepon" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="emaildosen" class="form-label">Email</label>
                            <input type="text" id="emaildosen" name="emaildosen" class="form-control"
                                placeholder="Email" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" id="modal-button" class="btn btn-success">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>
