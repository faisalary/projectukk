<div class="modal fade modal-lg" id="modal-konfigurasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header d-block">
                <h5 class="modal-title" id="modal-title">Tambah Roles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ route('universitas.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="">Nama Role</label>
                            <input type="text" class="form-control" placeholder="Nama Role">
                        </div>
                        <div class="col-12">
                            <h5 class="modal-title mt-3">Tetapkan Izin</h5>
                            <ul class="nav nav-pills mb-3 mt-3" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-kelola-lowongan" aria-controls="navs-pills-kelola-lowongan"
                                        aria-selected="true" id="kelola_lowongan" >
                                        Kelola Lowongan 
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button type="button" class="nav-link showSingle" target="2" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-informasi-lowongan" aria-controls="navs-pills-informasi-lowongan"
                                        aria-selected="false">
                                        Informasi Lowongan
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-jadwal-seleksi" aria-controls="navs-pills-jadwal-seleksi"
                                        aria-selected="false">
                                        Jadwal Seleksi
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content mt-4">
                            <div class="tab-pane fade show active" id="navs-pills-kelola-lowongan" role="tabpanel">
                                <div class="col-xl-3 col-md-6 col-12">
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" value="" id="selectAll" />
                                        <label class="form-check-label" for="defaultCheck1">Pilih Semua</label>
                                    </div>
                                    <span class="badge bg-success mt-3
                                     mb-1">Kelola Lowongan</span>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input kelola" type="checkbox" value="" id="defaultCheck1" />
                                        <label class="form-check-label" for="defaultCheck1"> Lihat </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input kelola" type="checkbox" value="" id="defaultCheck2" />
                                        <label class="form-check-label" for="defaultCheck2"> Tambah </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input kelola" type="checkbox" value="" id="defaultCheck3" />
                                        <label class="form-check-label" for="defaultCheck3"> Edit </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input kelola" type="checkbox" value="" id="defaultCheck4" />
                                        <label class="form-check-label" for="defaultCheck4"> Approval </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input kelola" type="checkbox" value="" id="defaultCheck5" />
                                        <label class="form-check-label" for="defaultCheck5"> Hapus </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input kelola" type="checkbox" value="" id="defaultCheck6" />
                                        <label class="form-check-label" for="defaultCheck6"> Lihat Detail </label>
                                    </div>
                                </div>
                            </div>    
                            <div class="tab-pane fade" id="navs-pills-informasi-lowongan" role="tabpanel">
                                <div class="col-xl-3 col-md-6 col-12">
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" value="" id="selectAll_informasi" />
                                        <label class="form-check-label" for="defaultCheck1">Pilih Semua</label>
                                    </div>
                                    <span class="badge bg-success mt-3
                                        mb-1">Informasi Lowongan</span>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input informasi" type="checkbox" value="" id="defaultCheck1" />
                                        <label class="form-check-label" for="defaultCheck1"> Lihat </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input informasi" type="checkbox" value="" id="defaultCheck2" />
                                        <label class="form-check-label" for="defaultCheck2"> Tambah </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input informasi" type="checkbox" value="" id="defaultCheck3" />
                                        <label class="form-check-label" for="defaultCheck3"> Edit </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input informasi" type="checkbox" value="" id="defaultCheck4" />
                                        <label class="form-check-label" for="defaultCheck4"> Screening </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input informasi" type="checkbox" value="" id="defaultCheck5" />
                                        <label class="form-check-label" for="defaultCheck5"> Seleksi </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input informasi" type="checkbox" value="" id="defaultCheck6" />
                                        <label class="form-check-label" for="defaultCheck6"> Penawaran </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input informasi" type="checkbox" value="" id="defaultCheck7" />
                                        <label class="form-check-label" for="defaultCheck7"> Diterima </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input informasi" type="checkbox" value="" id="defaultCheck8" />
                                        <label class="form-check-label" for="defaultCheck8"> Ditolak </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input informasi" type="checkbox" value="" id="defaultCheck9" />
                                        <label class="form-check-label" for="defaultCheck9"> Lihat Detail Kandidat </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input informasi" type="checkbox" value="" id="defaultCheck10" />
                                        <label class="form-check-label" for="defaultCheck10"> Set batas konfirmasi </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input informasi" type="checkbox" value="" id="defaultCheck11" />
                                        <label class="form-check-label" for="defaultCheck11"> Lihat Detail Lowongan </label>
                                    </div>
                                </div>
                            </div>    
                            <div class="tab-pane fade" id="navs-pills-jadwal-seleksi" role="tabpanel">
                                <div class="col-xl-3 col-md-6 col-12">
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" value="" id="selectAll_seleksi" />
                                        <label class="form-check-label" for="defaultCheck1">Pilih Semua</label>
                                    </div>
                                    <span class="badge bg-success mt-3
                                        mb-1">Jadwal Seleksi</span>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input seleksi" type="checkbox" value="" id="defaultCheck1" />
                                        <label class="form-check-label" for="defaultCheck1"> Lihat </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input seleksi" type="checkbox" value="" id="defaultCheck2" />
                                        <label class="form-check-label" for="defaultCheck2"> Tambah </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input seleksi" type="checkbox" value="" id="defaultCheck3" />
                                        <label class="form-check-label" for="defaultCheck3"> Edit </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input seleksi" type="checkbox" value="" id="defaultCheck4" />
                                        <label class="form-check-label" for="defaultCheck4"> Lihat Detail </label>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input seleksi" type="checkbox" value="" id="defaultCheck5" />
                                        <label class="form-check-label" for="defaultCheck5"> Ubah Status Seleksi </label>
                                    </div>
                                </div>
                            </div>    
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