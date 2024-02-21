        <!-- Modal -->
        <div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Konfirmasi Penerimaan Magang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label" for="bahasa">Jenis Magang <span
                                        style="color: red;">*</span></label>
                                <select id="jenis" class="form-select select2">
                                    <option disabled selected>Pilih Jenis Magang</option>
                                    <option value="jenis">Magang Fakultas</option>
                                    <option value="jenis">Magang Mandiri</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="namaperusahaan" class="form-label">Nama Perusahaan <span
                                        style="color: red;">*</span></label>
                                <input type="text" id="namaperusahaan" class="form-control"
                                    placeholder="PT. Techno Infinity" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="namaposisi" class="form-label">Nama Posisi Magang <span
                                        style="color: red;">*</span></label>
                                <input type="text" id="namaperusahaan" class="form-control"
                                    placeholder="UIUX Designer" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label" for="bahasa">Status Magang <span
                                        style="color: red;">*</span></label>
                                <select id="status" class="form-select select2">
                                    <option disabled selected>Pilih Status Magang</option>
                                    <option value="status">Diterima</option>
                                    <option value="status">Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col mb-0">
                                <label for="tanggalmulai" class="form-label">Tanggal Mulai<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control flatpickr-date" id="tanggalmulai"
                                    placeholder="YYYY-MM-DD" readonly="readonly">
                            </div>
                            <div class="mt-5"
                                style="text-align: center; background-color: black; width: 14px; height: 1px; margin: 0 20px">
                            </div>
                            <div class="col mb-0">
                                <label for="tanggalakhir" class="form-label">Tanggal Akhir<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control  flatpickr-date" id="tanggalakhir"
                                    placeholder="YYYY-MM-DD" readonly="readonly">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-0">
                                <label for="formFile" class="form-label">Bukti Penerimaan Magang</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalKonfirmasiEdit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Konfirmasi Penerimaan Magang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label" for="bahasa">Jenis Magang <span
                                        style="color: red;">*</span></label>
                                <select id="jenis1" class="form-select select2">
                                    <option disabled selected>Pilih Jenis Magang</option>
                                    <option value="jenis">Magang Fakultas</option>
                                    <option value="jenis">Magang Mandiri</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="namaperusahaan" class="form-label">Nama Perusahaan</label>
                                <input type="text" id="namaperusahaan" class="form-control"
                                    placeholder="PT. Techno Infinity" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="namaposisi" class="form-label">Nama Posisi Magang</label>
                                <input type="text" id="namaperusahaan" class="form-control"
                                    placeholder="UIUX Designer" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label" for="bahasa">Status Magang <span
                                        style="color: red;">*</span></label>
                                <select id="status1" class="form-select select2">
                                    <option disabled selected>Pilih Status Magang</option>
                                    <option value="status">Diterima</option>
                                    <option value="status">Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col mb-0">
                                <label for="tanggalmulai" class="form-label">Tanggal Mulai<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control  flatpickr-date" id="tanggalakhir"
                                    placeholder="YYYY-MM-DD" readonly="readonly">
                            </div>
                            <div class="mt-5"
                                style="text-align: center; background-color: black; width: 14px; height: 1px; margin: 0 20px">
                            </div>
                            <div class="col mb-0">
                                <label for="tanggalakhir" class="form-label">Tanggal Akhir<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control  flatpickr-date" id="tanggalakhir"
                                    placeholder="YYYY-MM-DD" readonly="readonly">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-0">
                                <label for="formFile" class="form-label">Bukti Penerimaan Magang</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>