@extends('partials_admin.template')

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <style>
        .swal2-icon {
            border-color: transparent !important;
        }

        .swal2-title {
            font-size: 20px !important;
            text-align: center !important;
            margin-top: 0px !important;
            margin-bottom: 0px !important;
        }

        .swal2-modal.swal2-popup .swal2-title {
            max-width: 100% !important;
        }

        .swal2-html-container {
            font-size: 16px !important;
        }
    </style>
@endsection

@section('main')
    <div class="sec-title mt-4 mb-4">
        <h4>Summary Profile Perusahaan</h4>
    </div>
    <div class="alert alert-danger alert-dismissible" role="alert">

        Harap lakukan pengecekan secara rutin karena akun perusahaan Anda masih menunggu konfirmasi dari admin.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between border-bottom">
                        <h5 class="text-secondary">RINGKASAN PROFILE PERUSAHAAN</h5>
                        <div class="col-md-2 col-12 text-end">
                            <i class="menu-icon tf-icons ti ti-edit text-success" data-bs-toggle="modal"
                                data-bs-target="#modalEditProfile"></i>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-5 col-12 border-end">
                            <div class="user-avatar-section">
                                <div class="d-flex align-items-center flex-column">
                                    <img class="rounded-circle w-px100 mb-3 pt-1 mt-4"
                                        src="../../app-assets/img/avatars/15.png" height="125" width="125"
                                        alt="User avatar" />
                                    <div class="user-info text-center">
                                        <h4 class=" fw-bold mt-4 mb-2">PT. TEKNOLOGI OLAH DAYA <br>INFORMASI</h4>
                                        <span class="badge bg-label-success mt-4 mb-4">Mitra Perusahaan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-1 text-end p-0">
                                    <i class="ti ti-map-pin px-2"></i>
                                </div>
                                <div class="col-11 p-0">
                                    <span class="fw-bold fs-5"> Alamat Perusahaan</span>
                                </div>
                                <div class="col-1 text-end p-0">
                                </div>
                                <div class="col-11 p-0">
                                    <p>Jl. Mars Sel. X No.19B, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa<br> Barat
                                        40286</p>
                                </div>

                                <div class="col-1 text-end p-0">
                                    <i class="ti ti-building px-2"></i>
                                </div>
                                <div class="col-11 p-0">
                                    <span class="fw-bold fs-5"> Deskripsi Perusahaan</span>
                                </div>
                                <div class="col-1 text-end p-0">
                                </div>
                                <div class="col-11 p-0">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dapibus ligula sit
                                        amet massa scelerisque, eget vehicula dui vestibulum. Etiam vitae orci rhoncus,
                                        pulvinar lectus et, dignissim lorem. </p>
                                </div>
                                <div class="ms-4 d-flex align-items-center">
                                    <i class="ti ti-phone p-2"></i>
                                    <span class="fw-bold fs-5"> Kontak Perusahaan</span>
                                </div>
                                <div class="ms-5">
                                    <i class="ti ti-phone-call p-2"></i>
                                    <span>(022)87505501</span>
                                </div>
                                <div class="ms-5">
                                    <i class="ti ti-mail p-2"></i>
                                    <span>hanat57906@othao.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditProfile" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title" id="modal-title">Edit Summary Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Account -->
                <div class="modal-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
                        <img src="../../app-assets/img/avatars/14.png"alt="user-avatar"
                            class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-white text-success me-2 mb-3" tabindex="0">
                                <i class="ti ti-upload d-block pe-2"></i>
                                <span class="d-none d-sm-block">Unggah Baru Logo Perusahaan</span>
                                <input type="file"id="upload" class="account-file-input" hidden
                                    accept="image/png, image/jpeg" />
                            </label>
                            <button type="button" class="btn btn-white text-danger account-image-reset mb-3">
                                <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Remove</span>
                            </button>

                            <div class="text-muted">Format FIle JPG, GIF atau PNG. Ukuran Maksimal 800KB</div>
                        </div>
                    </div>
                    <div class="border-top">
                        <form id="formAccountSettings" method="POST" onsubmit="return false">
                            <div class="row mt-4">
                                <div class="mb-3 col-md-12 fv-plugins-icon-container">
                                    <label for="namaperusahaan" class="form-label">Nama Perusahaan <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="namaperusahaan" name="namaperusahaan"
                                        placeholder="Nama Perusahaan" autofocus="">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="mb-3 col-md-12 fv-plugins-icon-container">
                                    <label for="alamat" class="form-label">Alamat Perusahaan <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="2" placeholder="Masukan Alamat Perusahaan" id="alamat"></textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="mb-3 col-md-12 fv-plugins-icon-container">
                                    <label for="deskripsi" class="form-label">Deskripsi Perusahaan <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="2" placeholder="Masukan Deskripsi Perusahaan" id="deskripsi"></textarea>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="mb-3 col-md-12 fv-plugins-icon-container">
                                    <div class="border rounded p-3">
                                        <label class="form-label">Kontak Perusahaan</label>
                                        <div class="mb-3 col-md-12 fv-plugins-icon-container">
                                            <label for="notelp" class="form-label">No. Telepon Perusahaan <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="notelp"
                                                placeholder="Masukan Nomor Telepon" aria-describedby="floatingInputHelp">
                                        </div>
                                        <div class="mb-3 col-md-12 fv-plugins-icon-container">
                                            <label for="lastName" class="form-label">E-mail Perusahaan <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="email" class="form-control"
                                                placeholder="Masukan E-mail Perusahaan" aria-label="john.doe"
                                                aria-describedby="basic-default-email2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success me-2">Simpan</button>
                        <button type="reset" class="btn btn-label-secondary">Batalkan</button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- /Account -->
        </div>
    </div>
@endsection

@section('page_script')
@endsection
