<div class="modal fade" id="modal-komponen-nilai" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Komponen Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ route('komponen_penilaian.store') }}">
                @csrf
                <div class="modal-body">

                    <form class="form-repeater">
                        <div data-repeater-list="group-a">
                            <div data-repeater-item="">
                                <div class="row">
                                    <div class="col mb-2">
                                        <label for="jenis" class="form-label">Jenis Magang</label>
                                        <select class="form-select select2" data-placeholder="Jenis Magang">
                                            <option value="1">Magang Fakultas</option>
                                            <option value="2">Magang Mandiri</option>
                                            <option value="2">Magang Startup</option>
                                            <option value="2">Magang Kerja</option>
                                            <option value="2">Magang MBKM-Kampus Merdeka</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label class="form-label" for="form-repeater-1-1">Nama Komponen</label>
                                        <input type="text" id="form-repeater-1-1" class="form-control"
                                            placeholder="Nama Komponen">
                                    </div>
                                    <div class="col-md-4 col-15" style="margin-right: -1rem; margin-left: -1rem;">
                                        <label class="form-label" for="form-repeater-1-2">Bobot Penilaian</label>
                                        <input type="text" id="form-repeater-1-2" class="form-control"
                                            placeholder="Bobot Penilaian">
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <label class="form-label" for="form-repeater-1-2">Dinilai Oleh</label>
                                        <input type="text" id="form-repeater-1-2" class="form-control"
                                            placeholder="Dinilai Oleh">
                                    </div>
                                    <div class="col-md-1 col-12 d-flex align-items-center mb-3"
                                        style="margin-right: -1rem; margin-left: -1rem; margin-top: 1.3rem;">
                                        <button class="btn waves-effect" data-repeater-delete="">
                                            <i class="tf-icons ti ti-trash text-danger trash-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button class="btn waves-effect bg-label-success" data-repeater-create="">
                        <i class="ti ti-plus me-1"></i>
                        <span class="align-middle">Data</span>
                    </button>
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