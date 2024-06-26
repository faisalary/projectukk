<div class="offcanvas offcanvas-end" tabindex="-1" id="modalSlide" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title" style="padding-left: 15px;">Filter Berdasarkan
        </h5>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="filter">
            <div class="col-12 mb-2">
                <div class="row">
                    <div class="mb-2">
                        <label for="durasimagang" class="form-label" style="padding-left: 15px;">Durasi
                            Magang</label>
                        <select class="form-select select2" id="durasimagang" name="durasimagang"
                            data-placeholder="Pilih Durasi Magang">
                            <option disabled selected>Pilih Durasi Magang</option>
                            <option value="1 Semester">1 Semester</option>
                            <option value="2 Semester">2 Semester</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="posisi" class="form-label" style="padding-left: 15px;">Posisi Lowongan
                            Magang</label>
                        <select class="form-select select2" id="posisi" name="posisi"
                            data-placeholder="Pilih Fakultas">
                            <option disabled selected>Pilih Posisi Lowongan Magang</option>
                            <option value="UI/UX Designer">UI/UX Designer</option>
                            <option value="Fullstack Developer">Fullstack Developer</option>
                            <option value="Quality Assurance">Quality Assurance</option>
                            <option value="Technical Writter">Technical Writter</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2 form-input">
                        <label for="status" class="form-label" style="padding-left: 15px;">Status Lowongan
                            Magang</label>
                        <select class="form-select select2" id="status" name="status"
                            data-placeholder="Pilih Status Lowongan Magang">
                            <option disabled selected>Pilih Status Lowongan Magang</option>
                            <option value="Diterima">Diterima</option>
                            <option value="Ditolak">Ditolak</option>
                            <option value="Kadaluarsa">Kadaluarsa</option>
                            <option value="Menunggu Persetujuan">Menunggu Persetujuan</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="mt-3 text-end">
                    <button type="button" class="btn btn-label-danger">Reset</button>
                    <button type="submit" class="btn btn-success">Terapkan</button>
                </div>
            </div>
        </form>
    </div>
</div>