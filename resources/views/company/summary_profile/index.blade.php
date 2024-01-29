@extends('partials_admin.template')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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

        Harap lakukan pengecekan data apakah sudah sesuai.
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

                                    @if ($industri->image)
                                        <img src="{{ asset('storage/' . $industri->image) }}" alt="user-avatar"
                                            class="rounded-circle w-px100 mb-3 pt-1 mt-4" height="125" width="125"
                                            id="imgPreview">
                                    @else
                                        <img src="../../app-assets/img/avatars/14.png" alt="user-avatar"
                                            class="rounded-circle w-px100 mb-3 pt-1 mt-4" height="125" width="125"
                                            id="imgPreview" data-default-src="../../app-assets/img/avatars/14.png">
                                    @endif

                                    <div class="user-info text-center">
                                        <h4 class="fw-bold mt-4 mb-2" id="namaindustri">{{ $industri->namaindustri }}</h4>
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
                                    <p id="alamatindustri">{{ $industri->alamatindustri }}</p>
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
                                    <p id="description">{{ $industri->description }}</p>
                                </div>
                                <div class="ms-4 d-flex align-items-center">
                                    <i class="ti ti-phone p-2"></i>
                                    <span class="fw-bold fs-5"> Kontak Perusahaan</span>
                                </div>
                                <div class="ms-5">
                                    <i class="ti ti-phone-call p-2"></i>
                                    <span id="notelpon">{{ $industri->notelpon }}</span>
                                </div>
                                <div class="ms-5">
                                    <i class="ti ti-mail p-2"></i>
                                    <span id="email">{{ $industri->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('company.summary_profile.modal')
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="{{ url('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
    <script>
        // let changePicture = $('#changePicture');

        changePicture.onchange = evt => {
            const [file] = changePicture.files

            if (file) {
                imgPreview2.src = URL.createObjectURL(file)
                console.log(imgPreview2.src);
            } else {
                imgPreview2.src = "../../app-assets/img/avatars/14.png"
            }
        }

        function removeImage() {
            // Hapus kode yang tidak diperlukan di sini

            // Ganti foto dengan sumber aset yang diinginkan
            document.getElementById('imgPreview2').src = "{{ asset('storage/' . $industri->image) }}";
        }
    </script>
@endsection
