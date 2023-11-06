<div class="modal fade" id="modal-universitas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title" id="modal-title">Tambah Universitas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ route('universitas.store') }}">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="universitas" class="form-label">Nama Universitas</label>
                            <input type="text" id="namauniv" onkeyup="this.value = this.value.replace(/[^a-zA-Z\s]+/gi, '');" name="namauniv" class="form-control" placeholder="Nama Universitas" />
                            <div class="invalid-feedback"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="jalan" class="form-label">Jalan</label>
                            <textarea class="form-control" id="jalan" name="jalan" placeholder="Jalan"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" id="kota" onkeyup="this.value = this.value.replace(/[^a-zA-Z\s]+/gi, '');" name="kota" class="form-control" placeholder="Kota" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="telp" class="form-label">Telp</label>
                            <input type="text" id="telp" name="telp" class="form-control" placeholder="telp" />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
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