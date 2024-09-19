<div class="modal fade modals" id="largeModal">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        @if (auth()->user()->hasRole('Dosen'))
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="largeModalLabel">Ubah Data Profile</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="default-form" action="{{ route('ganti.update') }}">
                    @csrf
                    <div class="modal-body">
                        <h4>Informasi Pribadi</h4>
                        <div class="row">
                            <div class="col-6 form-group my-2">
                                <label for="id_univ" class="">Universitas</label>
                                <select class="form-select select2" disabled name="id_univ">
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-6 form-group my-2">
                                <label for="id_fakultas" class="">Fakultas</label>
                                <select class="form-select select2" disabled name="id_fakultas">
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-6 form-group my-2">
                                <label for="id_prodi" class="">Prodi</label>
                                <select class="form-select select2" disabled name="id_prodi">
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-6 form-group my-2">
                                <label for="namadosen">Nama Dosen
                                    <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="namadosen"
                                    placeholder="Masukkan Nama Dosen">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <h4 class="mt-3">Kontak</h4>
                        <div class="row">
                            <div class="col-6 form-group">
                                <label for="nohpdosen">No Telp
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nohpdosen" id="nohpdosen" placeholder="Masukkan No Telp"
                                    class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-6 form-group">
                                <label for="emaildosen">Email
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="emaildosen" id="emaildosen"
                                    placeholder="Masukkan Email">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        @elseif (auth()->user()->hasRole('Mitra'))
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="largeModalLabel">Ubah Data Profile</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="default-form" action="{{ route('ganti.update') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 form-group my-2">
                                <label for="namapeg">Nama Pegawai
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="namapeg" id="namapeg" placeholder="Masukkan Nama Pegawai">
                            </div>
                            <div class="col-6 form-group my-2">
                                <label for="nohppeg">
                                    No Telp
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="nohppeg" id="nohppeg" placeholder="Masukan No Telp">
                            </div>
                            <div class="col-6 form-group my-2">
                                <label for="emailpeg">Email
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="emailpeg" id="emailpeg" placeholder="Masukkan Email">
                            </div>
                            <div class="col-6 form-group my-2">
                                <label for="jabatan">Jabatan
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Masukkan Jabatan" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        @elseif (auth()->user()->hasAnyRole(['LKM', 'Super Admin']))
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="largeModalLabel">Ubah Data Profile</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('ganti.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 form-group">
                                <label for="email">Email
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="email"id="email" placeholder="Masukkan Email">
                            </div>
                            <div class="col-6 form-group">
                                <label for="name">
                                    Nama
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
            </div>
            </form>
        @endif
    </div>
</div>
