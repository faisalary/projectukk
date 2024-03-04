{{-- Modal Reject --}}
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
            <form class="default-form" action="{{ url('/mandiri/approve-mandiri') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="nim" value="{{ $nim ?? '' }}">
                <div class="modal-body">

                    <div class="row">
                        <div class="col mb-0">
                            <label for="formFile" class="form-label">Unggah Surat Pengantar Magang</label>
                            <input class="form-control @error('bukti_doc') is-invalid @enderror" type="file"
                                id="bukti_doc" name="bukti_doc" multiple="">
                            @error('bukti_doc')
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
</div>
