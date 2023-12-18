<div class="modal fade" id="modal-mahasiswa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" id="" method="POST" action="{{ route('mahasiswa.store') }}">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="univ" class="form-label">Universitas</label>
                            <select class="form-select select2" id="pilihuniversitas_add" name="namauniv"
                                data-placeholder="Pilih Universitas">
                                <option disabled selected>Pilih Universitas</option>
                                @foreach ($universitas as $u)
                                    <option value="{{ $u->id_univ }}">{{ $u->namauniv }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="fakultas" class="form-label">Fakultas</label>
                            <select class="form-select select2" id="pilihfakultas_add" name="namafakultas"
                                data-placeholder="Pilih Fakultas">
                                <option disabled selected>Pilih Fakultas</option>
                                @foreach ($fakultas as $f)
                                    <option value="{{ $f->id_fakultas }}">{{ $f->namafakultas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="prodi" class="form-label">Prodi</label>
                            <select class="form-select select2" id="pilihprodi_add" name="namaprodi"
                                data-placeholder="Pilih Prodi">
                                <option disabled selected>Pilih Prodi</option>
                                @foreach ($prodi as $p)
                                    <option value="{{ $p->id_prodi }}">{{ $p->namaprodi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="nim" class="form-label">NIM</label>
                            <input class="form-control" id="nim" name="nim" placeholder="NIP" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <input type="text" id="angkatan" name="angkatan" class="form-select yearpicker"
                                placeholder="Angkatan" readonly />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="namamhs" class="form-label">Nama Mahasiswa</label>
                            <input type="text" id="namamhs" name="namamhs" class="form-control"
                                placeholder="Nama Mahasiswa" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="nohpmhs" class="form-label">No Telepon</label>
                            <input type="text" id="nohpmhs" name="nohpmhs" class="form-control"
                                placeholder="No Telepon" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="emailmhs" class="form-label">Email</label>
                            <input type="text" id="emailmhs" name="emailmhs" class="form-control"
                                placeholder="Email" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="alamatmhs" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamatmhs" id="alamatmhs" placeholder="Alamat"></textarea>
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

{{-- Modal PopUp --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="modalSlide" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Filter Berdasarkan</h5>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="filter">
            <div class="col-12 mb-2">
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="univ" class="form-label">Universitas</label>
                        <select class="form-select select2" id="univ" name="univ"
                            data-placeholder="Pilih Universitas">
                            <option disabled selected>Pilih Universitas</option>
                            @foreach ($universitas as $u)
                                <option value="{{ $u->id_univ }}">{{ $u->namauniv }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-2">
                        <label for="fakultas" class="form-label">Fakultas</label>
                        <select class="form-select select2" id="fakultas" name="fakultas"
                            data-placeholder="Pilih Fakultas">
                            <option disabled selected>Pilih Fakultas</option>
                            @foreach ($fakultas as $f)
                                <option value="{{ $f->id_fakultas }}">{{ $f->namafakultas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="univ" class="form-label">Prodi</label>
                        <select class="form-select select2" id="prodi" name="prodi"
                            data-placeholder="Pilih Prodi">
                            <option disabled selected>Pilih Prodi</option>
                            @foreach ($prodi as $p)
                                <option value="{{ $p->id_prodi }}">{{ $p->namaprodi }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="mt-3 text-end">
                <button type="reset" class="btn btn-label-danger data-reset">Reset</button>
                <button type="submit" class="btn btn-success">Terapkan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal-import" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Import</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" id="" name="import" method="POST"
                action="{{ route('mahasiswa.import') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="file" class="form-control" id="basic-default-upload-file" required=""
                        name="import">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" id="buttonImport" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
