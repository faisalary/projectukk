<!-- modal tambah -->
<div class="modal fade" id="modal-komponen-nilai" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:1000px;">

        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Komponen Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-repeater default-form" method="POST"
                            action="{{ route('komponen-penilaian.store') }}">>
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-12 ol-lg-6 col-xl-3 col-12 mb-0">
                                    <label for="jenis" class="form-label">Jenis Magang<span
                                            style="color: red;">*</span></label>
                                    <select name="id_jenismagang" class="form-select select2"
                                        data-placeholder="Jenis Magang" id="id_jenismagang">
                                        <option value="">Jenis Magang</option>
                                        @foreach ($id_jenismagang as $u)
                                            <option value="{{ $u->id_jenismagang }}">{{ $u->namajenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                                    <label class="form-label" for="form-repeater-1-1">Bobot Penilaian<span
                                            style="color: red;">*</span></label>
                                    <input type="text" name="bobot" id="bobot" class="form-control" placeholder="30%" />
                                </div>
                            </div>

                            <hr />
                            <div data-repeater-list="komponen">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                                            <label class="form-label" for="form-repeater-1-1">Aspek Penilaian<span
                                                    style="color: red;">*</span></label>
                                            <textarea name="aspek_penilaian" id="aspek_penilaian" class="form-control"
                                                placeholder="Buku Laporan Akhir
- Penulisan dan Tata Bahasa
- Latar Belakang dan Tujuan"></textarea>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                                            <label class="form-label" for="form-repeater-1-1">Deskripsi Aspek
                                                Penilaian<span style="color: red;">*</span></label>
                                            <textarea name="deskripsi_penilaian" id="deskripsi_penilaian" class="form-control"
                                                placeholder="Evaluasi kemampuan magang dalam menyampaikan ide, bertanya, dan menjelaskan secara jelas dan efektif."></textarea>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                                            <label class="form-label" for="form-repeater-1-1">Dinilai Oleh</label>
                                            <select name="scored_by" id="scored_by" class="form-select"
                                                data-placeholder="Dinilai Oleh">
                                                <option value="">Dinilai Oleh</option>
                                                <option value="1">Pembimbing Akademik</option>
                                                <option value="2">Pembimbing Lapangan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                                            <label class="form-label" for="form-repeater-1-1">Nilai Maksimal<span
                                                style="color: red;">*</span></label>
                                            <input type="text" name="nilai_max" id="nilai_max" class="form-control"
                                                placeholder="30" />
                                        </div>
                                        <div class="mb-3 col-lg-12 col-xl-1 col-12 mb-0 p-0">
                                            <button type="button" class="btn btn-label-danger mt-4"
                                                data-repeater-delete>
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <hr />
                                </div>
                            </div>
                            <div class="mb-0">
                                <button class="btn btn-outline-success" type="button" data-repeater-create>
                                    <i class="ti ti-plus me-1"></i>
                                    <span class="align-middle">Data</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="modal-button" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

