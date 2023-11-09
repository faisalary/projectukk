<div class="modal fade" id="modal-jenismagang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title">Tambah Jenis Magang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ route('jenismagang.store') }}">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-2">
                            <label for="jenis" class="form-label">Jenis Magang</label>
                            <input type="text" id="jenis" name="jenis" class="form-control" onkeyup="this.value = this.value.replace(/[^a-zA-Z\s]+/gi, '');" placeholder="Jenis Magang" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <select class="form-select select2" id="durasi" name="durasi" data-placeholder="Durasi Magang">
                                <option disabled selected>Pilih Durasi Magang</option>
                                <option value="1 Semester">1 Semester</option>
                                <option value="2 Semester">2 Semester</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="dokumen" class="form-label d-block" >Dokumen Upload</label>
                            <div class="form-check form-check-inline ">
                                <input class="form-check-input" type="radio" name="dokumen" id="inlineRadio1"
                                    value="1">
                                <label class="form-check-label" for="1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="dokumen" id="inlineRadio2"
                                    value="2">
                                <label class="form-check-label" for="2">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="seleksi" class="form-label d-block">Review</label>
                            <div class="form-check form-check-inline ">
                                <input class="form-check-input" type="radio" name="review" id="review1"
                                    value="1">
                                <label class="form-check-label" for="1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="review" id="review2"
                                    value="2">
                                <label class="form-check-label" for="2">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="seleksi" class="form-label d-block">Tipe</label>
                            <div class="form-check form-check-inline ">
                                <input class="form-check-input" type="radio" name="type" id="type1"
                                    value="1">
                                <label class="form-check-label" for="1">Fakultas</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="type2"
                                    value="2">
                                <label class="form-check-label" for="2">Non Fakultas</label>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" id="modal-button" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>