<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center mb-3" id="modalCenterTitle">Pengurangan Nilai Akhir Mahasiswa</h5>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="nilai-akhir" class="form-label">Nilai Akhir Mahasiswa</label>
                        <input type="text" id="nilai-akhir" class="form-control" placeholder="90" disabled />
                    </div>
                    <div class="col-12 mb-3">
                        <label for="nilai" class="form-label">Pengurangan Nilai</label>
                        <input type="text" id="nilai" class="form-control" placeholder="10" />
                    </div>
                    <div class="col-12 mb-3">
                        <label for="alasan" class="form-label">Alasan Pengurangan Nilai</label>
                        <textarea type="text" id="alasan" class="form-control" placeholder="Masukkan alasan pengurangan nilai"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        @include('berkas_akhir_magang/magang_fakultas/components/card_detail_mhs')
    </div>
</div>