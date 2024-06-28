<div class="modal fade" id="modalapprove" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title">Apakah Anda Yaking Menyetujui Lowongan</h5>
            </div>
            <form action="">
                <div class="modal-body">
                    <div class="row">
                        @foreach ($jenjang as $item)
                        <div class="form-group col-12 mb-3">
                            <label for="prodi-{{ $item }}" class="form-label">Masukkan Program Studi relevan - {{ $item }}<span class="text-danger">*</span></label>
                            <select class="form-select select2" multiple id="prodi-{{ $item }}" name="prodi[]" data-placeholder="Pilih Prodi">
                                @foreach($prodi as $p)
                                <option value="{{$p->id_prodi}}">{{$p->namaprodi ?? ''}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer" style="justify-content:end;">
                    <button type="submit" id="approve-confirm-button" class="btn btn-primary" >Approve Lowongan</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" onclick='rejected($(this))' id="rejected-confirm-button" data-id="{{$lowongan->id_lowongan}}" data-status="{{$lowongan->statusapprove}}"
                        class="btn btn-success">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>