{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambahWilayah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" data-label="Tambah Wilayah">Tambah Wilayah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ route('wilayah.store') }}" function-callback="afterAction">
                @csrf
                <input type="hidden" name="id">
                <input type="hidden" name="type" value="country">
                <div class="modal-body">
                    <div class="row">
                        {{-- <div class="col-12 mb-2 form-group">
                            <label for="nama" class="form-label">Nama Perusahaan</label>
                            <input type="text" id="nama" name="namaindustri"class="form-control" placeholder="Nama Perusahaan" />
                            <div class="invalid-feedback"></div>
                        </div> --}}
                        <div class="col-12 mb-2 form-group">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nama" />
                            <div class="invalid-feedback"></div>
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

<div class="modal fade" id="modalreject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title mx-auto" id="modalreject">Alasan Penolakan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-2">
                <div class="row">
                    <div class="col mb-2">
                        <label for="alasan" class="form-label">Alasan Penolakan</label>
                        <textarea class="form-control" id="alasan" rows="4" placeholder="Alasan Penolakan"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="rejected-confirm-button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
