<!-- Modal Tambah-->
<div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="modal-title">Buat Jadwal Seleksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ $urlSetJadwal }}" function-callback="afterSetJadwal">
                @csrf
                <input type="hidden" name="tahapan_seleksi">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3 form-group">
                            <label for="tahapan_seleksi" class="form-label">Jenis Tahap</label>
                            <select class="form-select select2 disable" id="tahapan_seleksi" data-placeholder="Pilih Jenis Tahap" disabled>
                                <option value="" disabled selected>Pilih Jenis Tahap</option>
                                @for ($i = 1; $i <= ($lowongan->tahapan_seleksi+1); $i++)
                                <option value="{{ $i }}">Tahap {{ $i }}</option>
                                @endfor
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-6 mb-3 form-group">
                            <label for="mulai_date" class="form-label">Mulai</label>
                            <input type="text" class="form-control flatpickr-date-custom cursor-pointer" name="mulai_date" placeholder="Mulai" id="mulai_date" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-6 mb-3 form-group">
                            <label for="selesai_date" class="form-label">Selesai</label>
                            <input type="text" class="form-control flatpickr-date-custom cursor-pointer" name="selesai_date" placeholder="Selesai" id="selesai_date" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 mb-3 form-group">
                            <label for="seleksi" class="form-label">Subjek Email</label>
                            <select class="form-select select2" id="subjek" name="subjek" data-placeholder="Pilih Subjek Email" disabled>
                                <option disabled selected class="text-danger mt-1">Pilih Subjek Email!</option>
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