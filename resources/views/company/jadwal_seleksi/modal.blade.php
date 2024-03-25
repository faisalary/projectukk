<!-- Modal Slide-->
<div class="offcanvas offcanvas-end" tabindex="-1" id="modalSlide" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Filter Berdasarkan</h5>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="filter">
            <div class="col-12 mb-2">
                <div class="row">
                    <div class="mb-2">
                        <label for="mulai" class="form-label">Tanggal Seleksi Mulai</label>
                        <input type="text" class="form-control flatpickr-input" placeholder="YYYY-MM-DD" id="flatpickr-date" readonly="readonly">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-2">
                        <label for="seleksi" class="form-label">Progress Seleksi</label>
                        <select class="form-select select2" id="progressfilter" name="progress" data-placeholder="Pilih Status Seleksi">
                            <option disabled selected>Pilih Progress Seleksi</option>
                            <option value="Belum Seleksi">Belum Seleksi</option>
                            <option value="Sudah Seleksi">Sudah Seleksi</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-2">
                        <label for="seleksi" class="form-label">Status Seleksi</label>
                        <select class="form-select select2" id="seleksifilter" name="seleksi" data-placeholder="Pilih Status Seleksi">
                            <option disabled selected>Pilih Status Seleksi</option>
                            <option value="Diterima">Diterima</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
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

<!-- Modal Tambah-->
<div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block border-bottom">
                <h5 class="modal-title" id="modal-title">Tambah Jadwal Seleksi Lanjutan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="alert" method="POST" action="{{ url('jadwal-seleksi/lanjutan/store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="tahapan_seleksi" class="form-label">Jenis Tahap</label>
                            <div class="position-relative">
                                <select class="form-select select2" id="tahapan_seleksi" name="tahapan_seleksi" data-placeholder="Pilih Jenis Tahap">
                                    <option value="" disabled selected>Pilih Jenis Tahap</option>
                                    @if ($lowongan->tahapan_seleksi == '1')
                                    <option value="tahap1">Tahap 1</option>
                                    @elseif($lowongan->tahapan_seleksi == '2')
                                    <option value="tahap1">Tahap 1</option>
                                    <option value="tahap2">Tahap 2</option>
                                    @else
                                    <option value="tahap1">Tahap 1</option>
                                    <option value="tahap2">Tahap 2</option>
                                    <option value="tahap3">Tahap 3</option>
                                    @endif
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="flatpickr-range" class="form-label">Jadwal Pelaksanaan</label>
                            <input type="text" class="form-control" name="mulai" data-date-format="d M Y" placeholder="Jadwal Pelaksanaan" id="flatpickr-range" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="seleksi" class="form-label">Subjek Email</label>
                            <select class="form-select select2" id="subjek" name="subjek" data-placeholder="Pilih Subjek Email">
                                <option disabled selected>Pilih Subjek Email</option>
                                @if($email->count() === 0)
                                <option disabled selected class="text-danger mt-1">Buat tamplate email pada Master Data Email terlebih dahulu!</option>
                                @else
                                @foreach ($email as $e)
                                <option value="{{ $e->id_email_template }}">{{ $e->subject_email }}</option>
                                @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>