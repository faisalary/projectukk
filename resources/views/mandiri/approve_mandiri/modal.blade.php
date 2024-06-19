<!-- {{-- Modal Reject --}}
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
                        <textarea class="form-control" id="alasan" placeholder="Alasan Penolakan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="rejected-confirm-button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalapprove" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDiterima">Persetujuan pengajuan SPM dan Pengiriman SPM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" action="" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="nim" value="{{ $nim ?? '' }}">
                <div class="modal-body">

                    <div class="row">
                        <div class="col mb-0">
                            <label for="formFile" class="form-label">Unggah Surat Pengantar Magang</label>
                            <input class="form-control @error('dokumen_spm') is-invalid @enderror" type="file"
                                id="dokumen_spm" name="dokumen_spm">
                            @error('dokumen_spm')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="card-subtitle text-muted mb-3">Tipe File: PDF. Maximum upload file size :
                            2 MB.</div>
                        <small class="text-muted">Note: Ketika mengirim SPM, secara otomatis pengajuan
                            SPM akan disetujui dan berpindah ke tab disetujui!</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div> -->


<!-- Modal Penolakan -->
<div class="modal fade" id="modalpenolakan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 pb-0">
            <h4 class="text-center">Alasan Penolakan Pengajuan Magang</h4>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameWithTitle" class="form-label">Alasan Penolakan Pengajuan</label>
                        <textarea type="text" class="form-control" placeholder="Masukkan alasan penolakan"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button" class="btn btn-success">Kirim</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Persetujuan SPM -->
<div class="modal fade" id="modalpersetujuanspm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 pb-0">
                <h4 class="text-center">Persetujuan pengajuan SPM dan Pengiriman SPM</h4>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label" for="berkas">Unggah Surat Pengantar Magang</label>
                        <input class="form-control" type="file" id="formFile">
                        <p style="font-size: smaller; padding-top:10px;">Allowed PDF, JPG, PNG, JPEG. Max size of 1 Mb</p>
                    </div>
                    <p class="mb-0" style="font-size: smaller;">Note: Ketika mengirim SPM, secara otomatis pengajuan SPM akan disetujui dan berpindah ke tab disetujui!</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button" class="btn btn-success">Kirim</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Persetujuan Pengajuan Magang -->
<div class="modal fade" id="modalpersetujuanmagang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 pb-0">
                <h4 class="text-center">Persetujuan Pengajuan Magang</h4>
                <p class="text-center mb-3" style="font-size: small;">Dokumen yang diupload wajib bertanda tangan pihak terkait</p>
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="berkas">Unggah Surat Pertanggungjawaban Mutlak </label>
                        <input class="form-control" type="file" id="formFile">
                        <p style="font-size: smaller; padding-top:10px;">Allowed PDF, JPG, PNG, JPEG. Max size of 1 Mb</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label" for="berkas">Unggah Surat Rekomendasi </label>
                        <input class="form-control" type="file" id="formFile">
                        <p style="font-size: smaller; padding-top:10px;">Allowed PDF, JPG, PNG, JPEG. Max size of 1 Mb</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-success">Kirim</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="modalSlide" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Filter Berdasarkan</h5>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="filter">
            <div class="col-12 mb-2">
                <div class="row">
                    <div class="mb-2">
                        <label for="prodi" class="form-label">Program Studi</label>
                        <select class="form-select select2" id="prodi" name="prodi" data-placeholder="Pilih Program Studi">
                            <option value="">Pilih Program Studi</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-2">
                        <label for="prodi" class="form-label">Jenis Magang</label>
                        <select class="form-select select2" id="jenis" name="prodi" data-placeholder="Pilih Jenis Magang">
                            <option value="">Pilih Jenis Magang</option>
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