<!-- Modal Ditolak-->
<div class="modal fade" id="modalDitolak" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDitolak">Konfirmasi Penolakan Magang Mandiri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" action="{{ url('kegiatan-saya/lamaran-saya/updateDitolak') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="nim" value="{{ $nim ?? '' }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="bukti_doc" class="form-label">Bukti Penolakan Magang</label>
                            <input class="form-control @error('bukti_doc') is-invalid @enderror" type="file"
                                id="bukti_doc" name="bukti_doc" multiple="">
                            @error('bukti_doc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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


<!-- Modal Diterima-->
<div class="modal fade" id="modalDiterima" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDiterima">Konfirmasi Penerimaan Magang Mandiri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" action="{{ url('kegiatan-saya/lamaran-saya/update/') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="nim" value="{{ $nim ?? '' }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="namaperusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" name="nama_industri" id="nama_industri" class="form-control"
                                placeholder="Masukkan Nama Perusahaan" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="namaposisi" class="form-label">Nama Posisi Magang</label>
                            <input type="text" name="posisi_magang" id="posisi_magang" class="form-control"
                                placeholder="Masukkan Nama Posisi Magang" />
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col mb-0">
                            <label for="tanggalmulai" class="form-label">Tanggal Mulai<span
                                    style="color: red;">*</span></label>
                            <input type="text" class="form-control  flatpickr-date" name="startdate" id="date_"
                                placeholder="YYYY-MM-DD" readonly="readonly">
                        </div>
                        <div class="mt-5"
                            style="text-align: center; background-color: black; width: 14px; height: 1px; margin: 0 20px">
                        </div>
                        <div class="col mb-0">
                            <label for="tanggalakhir" class="form-label">Tanggal Akhir<span
                                    style="color: red;">*</span></label>
                            <input type="text" class="form-control  flatpickr-date" name="enddate" id="date"
                                date="YYYY-MM-DD" readonly="readonly">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0">
                            <label for="formFile" class="form-label">Bukti Penerimaan Magang</label>
                            <input class="form-control @error('bukti_doc') is-invalid @enderror" type="file"
                                id="bukti_doc" name="bukti_doc" multiple="">
                            @error('bukti_doc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
