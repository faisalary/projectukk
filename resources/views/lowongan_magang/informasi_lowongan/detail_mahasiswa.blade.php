@extends('partials_admin.template')

@section('page_style')
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<style>
    .tooltip-inner {
        min-width: 100%;
        max-width: 100%;
    }

    .position-relative {
        padding-right: 15px;
        padding-left: 15px;
    }

    h6,
    .h6 {
        font-size: 0.9375rem;
        margin-bottom: 0px;
    }

    #more {
        display: none;
    }
</style>
@endsection

@section('main')
<div class="row">
    <div class="col-md-9 col-12">
        <button class="btn btn-outline-success my-2 waves-effect p-3 mb-4" type="button" id="back" style="width: 15%; height:12%;">
            <i class="bi bi-arrow-left text-success" style="font-size: medium;"> Kembali </i>
        </button>
        <h4 class="fw-bold"><span class="text-muted fw-light">Informasi Mitra / Informasi Lowongan / Informasi Kandidat / </span>Detail Mahasiswa </h4>
    </div>
    <div class="card">
        <div class="card-body mt-3 flex-grow-0 pt-0 h-100">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-success waves-effect waves-light" data-bs-target="" style="min-width: 200px;"><i class="tf-icons ti ti-download me-2"></i><span class="mt-1">Unduh CV</span>
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="{{$img ?? '\assets\images\no-pictures.png'}}" style="border-radius: 0%; width: 90px;" alt="user image" class="d-block ms-0 mt-4  rounded user-profile-img" />
                    </div>
                    <div class="flex-grow-1 mt-0 mt-4">
                        <div class="d-flex align-items-end align-items-sm-start ms-3 flex-md-row flex-column gap-4">
                            <div class="me-2 ms-1">
                                <h1 class="mb-2">{{$pendaftar->mahasiswa->namamhs}}</h1>
                                <p class="text" style="font-size: 20px">{{$pendaftar->lowonganMagang->intern_position }}</p>
                            </div>
                            <div class="ms-auto">
                                <button class="rounded-circle btn-label-success btn-icon btn-sm waves-effect" style="min-width: 40px; height:40px;">
                                    <i class="ti ti-message" style="font-size: 25px;"></i>
                                </button>
                                <button class="rounded-circle btn-label-success btn-icon btn-sm waves-effect me-2" style="min-width: 40px; height:40px;">
                                    <i class="ti ti-phone-call" style="font-size: 25px;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h4> Mengapa Saya Harus Di Terima?</h4>
            <p class="cursor-pointer text-justify">{{$prib->headliner}}</p>
            <hr>

            <h4>Informasi Pribadi</h4>
            <div class="row">
                <h5 class="mt-3"> Deskripsi Diri</h5>
                <div>
                    <p class="mb-0 text-justify">{{$prib->deskripsi_diri}}</p>
                </div>
                <div class="col-4 mt-3">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <span class="fw-semibold me-1">NIM:</span>
                            <span>{{$pendaftar->mahasiswa->nim}}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold me-1">Universitas:</span>
                            <span>{{$pendaftar->mahasiswa->univ->namauniv}}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold me-1">Fakultas:</span>
                            <span>{{$pendaftar->mahasiswa->fakultas->namafakultas}}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold me-1">Program Studi:</span>
                            <span>{{$pendaftar->mahasiswa->prodi->namaprodi}}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold me-1">Angkatan:</span>
                            <span>{{$pendaftar->mahasiswa->angkatan}}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold me-1">IPK:</span>
                            <span>{{$prib->ipk}}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold me-1">Eprt:</span>
                            <span>{{$prib->eprt}}</span>
                        </li>
                    </ul>
                </div>
                <div class="col-4 mt-3">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <span class="fw-semibold me-1">TAK:</span>
                            <span>{{$prib->TAK}}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold me-1">Email:</span>
                            <span>{{$pendaftar->mahasiswa->emailmhs}}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold me-1">No Telp:</span>
                            <span>{{$pendaftar->mahasiswa->nohpmhs}}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold me-1">Tanggal Lahir:</span>
                            <span>
                                {{ is_string($prib->tgl_lahir)
                                ? \Carbon\Carbon::parse($prib->tgl_lahir)->format('d F Y')  
                                : $prib->tgl_lahir?->format('d F Y')  
                                }}
                            </span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold me-1">Jenis Kelamin:</span>
                            <span>Laki-laki</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold me-1">Alamat:</span>
                            <span>{{$pendaftar->mahasiswa->alamatmhs}}</span>
                        </li>
                    </ul>
                </div>
                <div class="col-4"></div>
            </div>
            <hr>

            <h4>Pendidikan</h4>
            <div class="card-body pb-0">
                <ul class="timeline ms-1 mb-0 mt-3">
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <h5 class="mb-2">University Of Melbourne</h5>
                            <p class="mb-2">Magister Management</p>
                            <p class="mb-2">IPK 3.89/4.00</p>
                            <small>Juli 2022 - Juli 2024</small>
                            <div class="border-bottom mt-4"></div>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <h5 class="mb-2">University Of Melbourne</h5>
                            <p class="mb-2">Magister Management</p>
                            <p class="mb-2">IPK 3.89/4.00</p>
                            <p style="font-size: small;" class="mb-2">Juli 2022 - Juli 2024</p>
                            <div class="border-bottom mt-4"></div>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent" style="border-left: 0px solid">
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <h5 class="mb-2">University Of Melbourne</h5>
                            <p class="mb-2">Magister Management</p>
                            <p class="mb-2">IPK 3.89/4.00</p>
                            <small>Juli 2022 - Juli 2024</small>
                        </div>
                    </li>
                </ul>
            </div>
            <hr>

            <h4>Pengalaman</h4>
            <div class="card-body pb-0">
                <ul class="timeline ms-1 mb-0 mt-3">
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <h5 class="mb-2">UI/UX Designer</h5>
                            <p class="mb-2">Techno Infinty - Intership</p>
                            <p style="font-size: small;">Juli 2022 - Juli 2024</p>
                            <p class="mb-0">Lorem ÅF and Pöyry joined forces in order to become an international engineering, design and advisory company, unknown printer took a galley of type and scrambled
                                it to </p>
                            <p class="content-new mb-0">driving digitalisation and sustainability for the energy, infrastructure and industrial sectors all over the world.</p>
                            <u class="show_hide_new cursor-pointer" style="color:#4EA971">
                                Show more
                            </u>
                            <div class="border-bottom mt-4"></div>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <h5 class="mb-2">UI/UX Designer</h5>
                            <p class="mb-2">Techno Infinty - Intership</p>
                            <p style="font-size: small;">Juli 2022 - Juli 2024</p>
                            <p class="mb-0">Lorem ÅF and Pöyry joined forces in order to become an international engineering, design and advisory company, unknown printer took a galley of type and scrambled
                                it to </p>
                            <p class="content-new mb-0">driving digitalisation and sustainability for the energy, infrastructure and industrial sectors all over the world.</p>
                            <u class="show_hide_new cursor-pointer" style="color:#4EA971">
                                Show more
                            </u>
                            <div class="border-bottom mt-4"></div>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent" style="border-left: 0px solid">
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <h5 class="mb-2">UI/UX Designer</h5>
                            <p class="mb-2">Techno Infinty - Intership</p>
                            <p style="font-size: small;">Juli 2022 - Juli 2024</p>
                            <p class="mb-0">Lorem ÅF and Pöyry joined forces in order to become an international engineering, design and advisory company, unknown printer took a galley of type and scrambled
                                it to </p>
                            <p class="content-new mb-0">driving digitalisation and sustainability for the energy, infrastructure and industrial sectors all over the world.</p>
                            <u class="show_hide_new cursor-pointer" style="color:#4EA971">
                                Show more
                            </u>
                        </div>
                    </li>
                </ul>
            </div>
            <hr>

            <h4>Keahlian</h4>
            <div class="d-flex mt-3" style="column-gap: 10px; padding-bottom: 10px  !important">
                <span class="badge rounded-pill bg-success bg-glow">Figma </span>
                <span class="badge rounded-pill bg-success bg-glow">Adobe XD</span>
                <span class="badge rounded-pill bg-success bg-glow">Figma</span>
                <span class="badge rounded-pill bg-success bg-glow">Adobe XD</span>
            </div>
            <hr>

            <h4>Dokumen Pendukung</h4>
            <h5 class="mb-2">Desain UI/UX Design</h5>
            <p class="mb-2">Coursera</p>
            <p class="mb-2">Juli 2023-Juli 2030</p>
            <p class="mb-0">Lorem ÅF and Pöyry joined forces in order to become an international engineering, design and advisory company, unknown printer took a galley of type and scrambled
                it to </p>
            <p class="content-new mb-0">driving digitalisation and sustainability for the energy, infrastructure and industrial sectors all over the world.</p>
            <u class="show_hide_new cursor-pointer" style="color:#4EA971">
                Show more
            </u>
            <br>
            <u style="color: #0099FF">UI/UX Design.pdf</u>
            <div class="border-bottom mt-4"></div>
            <h5 class="mb-2 mt-4">Desain UI/UX Design</h5>
            <p class="mb-2">Coursera</p>
            <p class="mb-2">Juli 2023-Juli 2030</p>
            <p class="mb-0">Lorem ÅF and Pöyry joined forces in order to become an international engineering, design and advisory company, unknown printer took a galley of type and scrambled
                it to </p>
            <p class="content-new mb-0">driving digitalisation and sustainability for the energy, infrastructure and industrial sectors all over the world.</p>
            <u class="show_hide_new cursor-pointer" style="color:#4EA971">
                Show more
            </u>
            <br>
            <u style="color: #0099FF">UI/UX Design.pdf</u>
            <div class="border-bottom mt-4"></div>

            <h4 class="mt-3">Informasi Tambahan</h4>
            <div class="row">
                <div class="col-4">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <span class="fw-semibold me-1" style="font-size: 18px">Instagram:</span>
                            <span style="color: #0099FF; font-size: 17px;">jenyrubyjane</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold me-1" style="font-size: 18px">Linkedin:</span>
                            <span style="color: #0099FF; font-size: 17px;">jenyrubyjane</span>
                        </li>
                    </ul>
                </div>
                <div class="col-8">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <span class="fw-semibold me-1" style="font-size: 18px">Lokasi kerja yang di harapkan:</span>
                            <span style="font-size: 17px;">Bandung</span>
                        </li>
                </div>
            </div>
            <span class="fw-semibold me-1" style="font-size: 18px">Bahasa</span>
            <div class="d-flex mt-3" style="column-gap: 10px; padding-bottom: 10px  !important">
                <span class="badge rounded-pill bg-success bg-glow">Mandarin </span>
                <span class="badge rounded-pill bg-success bg-glow">English</span>
                <span class="badge rounded-pill bg-success bg-glow">Japanese</span>
                <span class="badge rounded-pill bg-success bg-glow">Arabic</span>
            </div>
        </div>

    </div>
    @endsection

    @section('page_script')
    <script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="../../app-assets/js/forms-extras.js"></script>

    <script>
        jQuery(function() {
            jQuery('.showSingle').click(function() {
                jQuery('.targetDiv').hide('.cnt');
                jQuery('#div' + $(this).attr('target')).slideToggle();
            });
        });

        function myFunction() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Show more";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Show less";
                moreText.style.display = "inline";
            }
        }

        $(document).ready(function() {
            $(".content-new").hide();
            $(".show_hide_new").on("click", function() {
                var content = $(this).prev('.content-new');
                content.slideToggle(100);
                if ($(this).text().trim() == "Show more") {
                    $(this).text("Show less");
                } else {
                    $(this).text("Show more");
                }
            });
        });

        document.getElementById("back").addEventListener("click", () => {
            history.back();
        });
    </script>
    <script src="{{ asset('app-assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
    <script src="{{ asset('app-assets/js/extended-ui-sweetalert2.js')}}"></script>
    @endsection