@extends('partials_admin.template')

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <style>

    </style>
@endsection

@section('main')
<div class="row ">
    <div class="col-md-12 col-12">
        <nav aria-label="breadcrumb">
            <h4>
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item text-secondary">
                        Lowongan Magang
                    </li>
                    <li class="breadcrumb-item">
                        <a href="/halaman-lowongan-magang" class="text-secondary">Kelola Magang</a>
                    </li>
                    <li class="breadcrumb-item active">Detail Lowongan UI/UX Designer</li>
                </ol>
            </h4>
        </nav>
        <!-- <h4 class="fw-bold"><span class="text-muted fw-light">Lowongan Magang /</span> <span class="text-muted fw-light">Informasi Lowongan /</span> Fullstack Developer - Tahun Ajaran 2324</h4> -->
    </div>

    <div class="d-flex">
        <div class="card" style="padding: 50px 30px; width: 100%; margin-right: 20px; !important">
            <div class="card-body d-flex flex-row justify-content-between"
                style=" border-bottom: 1px solid #D3D6DB;  !important">
                <div class="">
                    <div class="d-flex items-center justify-content-start">
                        <img src="front/assets/img/logo_wings.png" alt="" style="width: 150px; height: 90px; !important">
                        <div class="ms-5">
                            <p class="fw-bolder text-black" style="font-size: 32px; color: #23314B">Human resources</p>
                            <p class="mt-n3" style="font-size: 18px; color: #4B465C">IT consultant</p>
                        </div>
                    </div>
                    <div class="d-flex" style="margin-top: 40px; font-size: 13px; color: #23314B; !important">
                        <ul style="border-right: 1px solid #D3D6DB; padding: 0 20px 0 0; !important">
                            <li class="d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-calendar ti-xs me-2"></i>
                                2023/2024 - Ganjil
                            </li>
                            <li class="d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-users ti-xs me-2"></i>
                                100 Mahasiswa
                            </li>
                            <li class="d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-building-community  ti-xs me-2"></i>
                                Fakultas Ilmu Terapan
                            </li>
                        </ul>
                        <ul style="border-right: 1px solid #D3D6DB; padding: 0 20px 0 20px; !important">

                            <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-map-pin  ti-xs me-2"></i>
                                Bandung & Jakarta
                            </li>
                            <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-currency-dollar  ti-xs me-2"></i>
                                IDR 4.300.000 - 5.500.000
                            </li>
                            <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-clock  ti-xs me-2"></i>
                                2 Semerter
                            </li>
                        </ul>
                        <ul style="padding: 0 0 0 20px; !important">
                            <li class="list-group-item d-flex align-items-start fw-semibold"
                                style="margin-top: 15px !important">
                                <i class="ti ti-school ti-xs me-2"></i>
                                <div>
                                    Program Studi
                                    <ul style="list-style-type: disc; padding-left: 20px; margin-top: 5px;">
                                        <li>D3 Rekayasa Perangkat Lunak</li>
                                        <li>D3 Rekayasa Perangkat Lunak</li>
                                        <li>D3 Rekayasa Perangkat Lunak</li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-auto">
                    <button type="button" class="btn btn-label-warning waves-effect">Menunggu Persetujuan</button>
                    <p class="mt-2" style="font-size: 23px; color: #4B465C !important">Detail pengajuan</p>
                    <p class="fw-normal" style="font-size: 14px; margin-top: -8px; !important">
                        Pengajuan : <span class="fw-semibold">25/08/2020</span>
                    </p>
                </div>
            </div>
            <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
                <p style="font-size: 26px; color: #23314B; !important">Deskipsi pekerjaan</p>
                <ul
                    style="list-style-type: disc; padding-left: 20px; margin-top: 5px; padding-bottom: 30px; font-size: 15px; color: #23314B;">
                    <li>Manage Talent Acquisition activities for Desk Worker and Non-Desk Worker

                    </li>
                    <li>
                        Lead HR Internal Communication and Employer Branding
                    </li>
                    <li>
                        Manage On-Boarding program for new hire.
                    </li>
                    <li>
                        Manage People Development process from training need analysis into post-training effectiveness
                        evaluation including ROI.
                    </li>
                    <li>
                        Support employee Performance Evaluation process.

                    </li>
                    <li>
                        Support Talent Management and Succession Planning function.
                    </li>
                    <li>
                        Manage HR Digital function (Workday) in the country by ensuring data accuracy and updates.
                    </li>
                    <li>
                        Conduct HR People Analytic such as headcount, labor-cost, hours-work, etc.
                    </li>
                    <li>
                        Lead Employee Engagement activities and events.
                    </li>
                    <li>
                        Liaise with relevant parties to ensure HR function executed smoothly.
                    </li>
                    <li>Support other HR Indonesia operations activities.</li>
                </ul>
            </div>

            <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
                <p style="font-size: 26px; color: #23314B; !important">Requirements</p>
                <ul
                    style="list-style-type: disc; padding-left: 20px; margin-top: 5px; padding-bottom: 30px; font-size: 15px; color: #23314B;">
                    <li>
                        At least Bachelor's degree in any field

                    </li>
                    <li>
                        At least 3 years of experience in HR / HRBP

                    </li>
                    <li>
                        Has strong numerical capability and excel expertise

                    </li>
                    <li>
                        Has experience using Workday will be an advantage

                    </li>
                    <li>
                        Good command of spoken and written English.


                    </li>
                    <li>
                        Experience within a rapidly changing organization in Multinational Company preferably within a
                        Manufacturing environment.
                    </li>
                    <li>
                        Strong attention to detail

                    </li>
                    <li>
                        Self-motivated and able to work without supervision

                    </li>
                    <li>
                        Willing to work in Cikampek area.

                    </li>
                </ul>
            </div>

            <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
                <p style="font-size: 26px; color: #23314B; !important">Benefit</p>
                <ul
                    style="list-style-type: disc; padding-left: 20px; margin-top: 5px; padding-bottom: 30px; font-size: 15px; color: #23314B;">
                    <li>
                        Family Care
                    </li>
                    <li>
                        Parking Access
                    </li>
                    <li>
                        Reward Compensation
                    </li>

                </ul>
            </div>

            <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
                <p style="font-size: 26px; color: #23314B; !important">Kemampuan</p>

                <div class="d-flex" style="column-gap: 10px; padding-bottom: 30px !important">
                    <span class="badge rounded-pill bg-success bg-glow">SPSS</span>
                    <span class="badge rounded-pill bg-success bg-glow">Microsoft Office</span>
                    <span class="badge rounded-pill bg-success bg-glow">Google Suite</span>
                    <span class="badge rounded-pill bg-success bg-glow">Counseling Tools</span>
                </div>
            </div>

            <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
                <p style="font-size: 26px; color: #23314B; !important">Tentang Perusahaan</p>

                <p style="margin-top: 5px; padding-bottom: 30px; font-size: 15px; color: #23314B;">
                    ÅF and Pöyry joined forces in order to become an international engineering, design and advisory company,
                    driving digitalisation and sustainability for the energy, infrastructure and industrial sectors all over
                    the
                    world. AFRY as a new common brand of ÅF Pöyry is one of the largest international power sector
                    consulting
                    and engineering company with about 17,000 experts working across the world to create sustainable
                    solutions
                    for future generations
                </p>
            </div>
        </div>
        <div style="width: 25%">
            <div class="card" style=" height: fit-content; padding: 24px;">
                <button type="button" data-bs-toggle='modal' data-bs-target='#acceptModal' class="btn btn-success w-100"
                    style="font-size: 15px; box-shadow: 0 2px 4px rgba(75, 70, 92, 0.1);">
                    <i class="ti ti-check ti-sm" style="margin-right: 10px"></i>
                    Setujui
                </button> <button type="button" data-bs-toggle='modal' data-bs-target='#rejectModal'
                    class="btn btn-danger w-100 mt-3" style="font-size: 15px; box-shadow: 0 2px 4px rgba(75, 70, 92, 0.1);">
                    <i class="ti ti-x ti-sm" style="margin-right: 10px"></i>
                    Tolak
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="acceptModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="text-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle"
                            width="75" height="67" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9v4" />
                            <path
                                d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                            <path d="M12 16h.01" />
                        </svg>
                    </span>
                    <h4 class="mt-4">Apakah anda yakin ingin menyetujui lowongan?</h4>
                    <p>Data terpilih akan secara otomatis berpindah ke tab disetujui!</p>
                    <button type="button" class="btn btn-success">Ya, Yakin</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h4 class="mt-4">Alasan Penolakan Lowongan</h4>
                    <div class="text-start">
                        <label for="exampleFormControlTextarea1" class="form-label text-start">Alasan Penolakan
                            Lowongan</label>
                        <textarea class="form-control" data-bs-toggle="autosize" placeholder="Masukkan alasan penolakan"></textarea>
                    </div>
                    <div class="mt-4 text-end">
                        <button type="button" class="btn btn-success">Ya, Yakin</a></button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection
