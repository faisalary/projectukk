<div class="modal fade" id="modal-komponen-nilai" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Komponen Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ route('komponen-penilaian.store') }}">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="jenis" class="form-label">Jenis Magang</label>
                            <select name="jenismagang" id="jenismagang" class="form-select select2" data-placeholder="Jenis Magang">
                                <option value="">Magang Fakultas</option>
                                @foreach ($id_jenismagang as $halo)
                                <option value="{{$halo->id_jenismagang}}">{{$halo->namajenis}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row repeater">
                        <div data-repeater-list="halo1" class="nilai">
                            <div data-repeater-item class="row">
                                <div class="col-md-4 col-12 form-input">
                                    <label class="form-label" for="form-repeater-1-1">Nama Komponen</label>
                                    <input name="namakomponen" onkeyup="this.value = this.value.replace(/[^a-zA-Z\s]+/gi, '');" type="text" id="namakomponen" class="form-control" placeholder="Nama Komponen">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class=" col-md-4 col-15 form-input" style="margin-right: -1rem; margin-left: -1rem;">
                                    <label class="form-label" for="form-repeater-1-2">Bobot Penilaian</label>
                                    <input name="bobot" type="text" id="bobot" class="form-control" placeholder="Bobot Penilaian">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-3 col-12 form-input">
                                    <label class="form-label" for="form-repeater-1-2">Dinilai Oleh</label>
                                    <input name="scoredby" onkeyup="this.value = this.value.replace(/[^a-zA-Z\s]+/gi, '');" type="text" id="scoredby" class="form-control" placeholder="Dinilai Oleh">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-1 col-12 d-flex align-items-center mb-3" style="margin-right: -1rem; margin-left: -1rem; margin-top: 1.3rem;">
                                    <a class="btn waves-effect" data-repeater-delete>
                                        <i class="tf-icons ti ti-trash text-danger trash-icon"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn waves-effect bg-label-success w-auto" type="button" name="add" id="add" data-repeater-create>
                                <i class="ti ti-plus me-1"></i>
                                <span class="align-middle">Tambah Data</span>
                            </button>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" id="modal-button" class="btn btn-success">Simpan</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>