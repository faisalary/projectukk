<!-- Modal Tambah-->
<div class="modal fade" id="modalEditProfile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block">
                <h5 class="modal-title" id="modal-title">Edit Summary Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Account -->
            <form action="{{ url('company/summary-profile/' . $industri->id_industri) }}" class="default-form"
                autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
                        @if ($industri->image)
                            <img src="{{ asset('storage/' . $industri->image) }}" alt="user-avatar"
                                class="d-block w-px-100 h-px-100 rounded" id="imgPreview">
                        @else
                            <img src="../../app-assets/img/avatars/14.png" alt="user-avatar"
                                class="d-block w-px-100 h-px-100 rounded" id="imgPreview">
                        @endif
                        <div class="button-wrapper">
                            <label for="changePicture"
                                class="btn btn-white text-success me-2 mb-3 waves-effect waves-light" tabindex="0">
                                <i class="ti ti-upload d-block pe-2"></i>
                                <span class="d-none d-sm-block">Unggah Baru Logo Perusahaan</span>
                                <input type="file" id="changePicture" name="image" class="account-file-input"
                                    hidden accept="image/png, image/jpeg">
                            </label>
                            <button type="button"
                                class="btn btn-white text-danger account-image-reset mb-3 waves-effect">
                                <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Remove</span>
                            </button>

                            <div class="text-muted">Format FIle JPG, GIF atau PNG. Ukuran Maksimal 800KB</div>
                        </div>
                    </div>
                    <div class="border-top">

                        <div class="row mt-4">
                            <div class="mb-3 col-md-12 fv-plugins-icon-container">
                                <label for="namaperusahaan" class="form-label">Nama Perusahaan <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="namaindustri" name="namaindustri"
                                    placeholder="Nama Perusahaan" autofocus="" value="{{ $industri->namaindustri }}">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="mb-3 col-md-12 fv-plugins-icon-container">
                                <label for="alamat" class="form-label">Alamat Perusahaan <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" rows="2" placeholder="Masukan Alamat Perusahaan" id="alamatindustri"
                                    name="alamatindustri">{{ $industri->alamatindustri }}</textarea>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="mb-3 col-md-12 fv-plugins-icon-container">
                                <label for="deskripsi" class="form-label">Deskripsi Perusahaan <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" rows="2" placeholder="Masukan Deskripsi Perusahaan" id="description"
                                    name="description">{{ $industri->description }}</textarea>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="mb-3 col-md-12 fv-plugins-icon-container">
                                <div class="border rounded p-3">
                                    <label class="form-label">Kontak Perusahaan</label>
                                    <div class="mb-3 col-md-12 fv-plugins-icon-container">
                                        <label for="notelp" class="form-label">No. Telepon Perusahaan <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="notelpon"
                                            name="notelpon"placeholder="Masukan Nomor Telepon"
                                            aria-describedby="floatingInputHelp" value="{{ $industri->notelpon }}">
                                    </div>
                                    <div class="mb-3 col-md-12 fv-plugins-icon-container">
                                        <label for="lastName" class="form-label">E-mail Perusahaan <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="email" name="email" class="form-control"
                                            placeholder="Masukan E-mail Perusahaan" aria-label="john.doe"
                                            aria-describedby="basic-default-email2" value="{{ $industri->email }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success me-2">Simpan</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- /Account -->
</div>
</div>

<script>
    changePicture.onchange = evt => {
        const [file] = changePicture.files
        if (file) {
            imgPreview.src = URL.createObjectURL(file)
        } else {
            imgPreview.src = "../../app-assets/img/avatars/14.png"
        }
    }
</script>
