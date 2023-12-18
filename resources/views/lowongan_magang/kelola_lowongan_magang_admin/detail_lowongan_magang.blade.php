@extends('partials_admin.template')

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <style>
        .hide-me {
            display: none;
        }
    </style>
@endsection

@section('main')
    <div class="row ">
        <div class="">
            <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs">Lowongan Magang / Kelola Magang / </span>
                Detail Lowongan UI/UX Designer
            </h4>
        </div>
    </div>
    <div class="d-flex">
        <div class="card" style="padding: 50px 30px; width: 100%; margin-right: 20px; !important">
            <div class="card-body d-flex flex-row justify-content-between"
                style=" border-bottom: 1px solid #D3D6DB;  !important">
                <div class="">
                    <div class="row">
                        <div class="col-8">
                            <div class="d-flex items-center justify-content-start">
                                <img src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt=""
                                    style="width: 150px; height: 90px; !important">
                                <div class="ms-5">
                                    <p class="fw-bolder text-black" style="font-size: 32px; color: #23314B">Human Resources
                                    </p>
                                    <p class="mt-n3" style="font-size: 18px; color: #4B465C">IT consultant</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 align-items-center d-flex justify-content-end" style="padding-left: 325px">
                            <div class="w-auto">
                                <div class='text-center'>
                                    <div class='badge bg-label-success' style="width: 180px">Disetujui</div>
                                </div>
                                <p class="mt-2" style="font-size: 22px; color: #4B465C !important"><b>Detail Pengajuan</b>
                                </p>
                                <p class="fw-normal" style="font-size: 13px; margin-top: -8px; !important">
                                    Pengajuan : <span class="fw-semibold">25/08/2020</span>
                                </p>
                                <p class="fw-normal" style="font-size: 13px; margin-top: -8px; !important">
                                    Disetujui : <span class="fw-semibold">29/08/2020</span>
                                </p>
                                <p class="fw-normal" style="font-size: 13px; margin-top: -8px; !important">
                                    Oleh : <span class="fw-semibold">Admin 1</span>
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex" style="margin-top: 40px; font-size: 15px; color: #23314B; !important">
                        <ul style="border-right: 1px solid #D3D6DB; padding: 0 20px 0 0; !important">
                            <li class="d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-users me-2"></i>
                                100 Mahasiswa
                            </li>
                            <li class="d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-building-community me-2"></i>
                                Fakultas Ilmu Terapan
                            </li>
                            <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-calendar-time me-2"></i>
                                2 Semerter
                            </li>
                        </ul>
                        <ul style="border-right: 1px solid #D3D6DB; padding: 0 20px 0 20px; !important">

                            <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-map-pin me-2"></i>
                                Bandung & Jakarta
                            </li>
                            <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-currency-dollar me-2"></i>
                                Berbayar
                            </li>
                        </ul>
                        <ul style="padding: 0 0 0 20px; !important">
                            <li class="list-group-item d-flex align-items-start fw-semibold"
                                style="margin-top: 15px !important">
                                <i class="ti ti-school me-2"></i>
                                <div>
                                    Bidang
                                    <ul style="list-style-type: disc; padding-left: 20px; margin-top: 5px;">
                                        <li>Rekayasa Perangkat Lunak Aplikasi</li>
                                        <li>Sistem Informasi</li>
                                        <li>Teknik Komputer</li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
                <span class="fw-bold" style="font-size: 26px; color: #23314B; !important">Deskipsi Pekerjaan</span>
                <ul class="job-description"
                    style="list-style-type: disc; padding-left: 20px; margin-top: 5px; padding-bottom: 30px; font-size: 15px; color: #23314B;">
                    <p>
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
                        </li><span class="dots">.... </span>
                        <span class="hiding">
                            <li>
                                Support Talent Management and Succession Planning function.
                            </li>
                            <li>
                                Manage HR Digital function (Workday) in the country by ensuring data accuracy and updates.
                            <li>
                                Conduct HR People Analytic such as headcount, labor-cost, hours-work, etc.
                            </li>
                            <li>
                                Lead Employee Engagement activities and events.
                            </li>
                            <li>
                                Liaise with relevant parties to ensure HR function executed smoothly.
                            </li>
                            <li>
                                Support other HR Indonesia operations activities.
                            </li>
                        </span>
                        <a href="#" class="read-more">Show More</a>
                        <a href="#" class="show-less hiding">Show Less</a>
                    </p>


                </ul>
            </div>

            <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
                <span class="fw-bold" style="font-size: 26px; color: #23314B; !important">Requirement</span>
                <ul
                    style="list-style-type: disc; padding-left: 20px; margin-top: 5px; padding-bottom: 30px; font-size: 15px; color: #23314B;">
                    <p>
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

                        </li><span class="dots">.... </span>
                        <span class="hiding">
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
                    </span>
                    <a href="#" class="read-more">Show More</a>
                    <a href="#" class="show-less hiding">Show Less</a>
                </p>
                </ul>
            </div>

            <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
                <span class="fw-bold" style="font-size: 26px; color: #23314B; !important">Benefit</span>
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
                <span class="fw-bold" style="font-size: 26px; color: #23314B; !important">Kemampuan</span>

                <div class="d-flex mt-3" style="column-gap: 10px; padding-bottom: 30px !important">
                    <span class="badge rounded-pill bg-success bg-glow">SPSS</span>
                    <span class="badge rounded-pill bg-success bg-glow">Microsoft Office</span>
                    <span class="badge rounded-pill bg-success bg-glow">Google Suite</span>
                    <span class="badge rounded-pill bg-success bg-glow">Counseling Tools</span>
                </div>
            </div>

            <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
                <span class="fw-bold" style="font-size: 26px; color: #23314B; !important">Seleksi Tahap Lanjut</span>
                <ul class="timeline ms-1 mb-0 mt-3">
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <h5 class="mb-0">Seleksi Tahap 1</h5>
                            <div class="d-flex align-items-center" style="margin-top: 15px !important">
                                <i class="ti ti-calendar-event me-2"></i>
                                <p class="mb-0">Tanggal Pelaksanaan : 18/10/2023 - 20/10/2023</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <h5 class="mb-0">Seleksi Tahap 2</h5>
                            <div class="d-flex align-items-center" style="margin-top: 15px !important">
                                <i class="ti ti-calendar-event me-2"></i>
                                <p class="mb-0">Tanggal Pelaksanaan : 25/10/2023 - 30/10/2023</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent" style="border-left: 0px solid">
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <h5 class="mb-0">Seleksi Tahap 3</h5>
                            <div class="d-flex align-items-center" style="margin-top: 15px !important">
                                <i class="ti ti-calendar-event me-2"></i>
                                <p class="mb-0">Tanggal Pelaksanaan : 01/11/2023 - 03/11/2023</p>
                            </div>
                        </div>
                    </li>
                </ul>
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

                        <button type="button" class="btn btn-success">Ya, Yakin</button>
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

    <script>
        $('.hiding').addClass('hide-me');

        $('.read-more').on('click', function() {
            $(this).addClass('hide-me');
            $('.hiding').toggle();
            $('.dots').toggle();
        });
        $('.show-less').on('click', function() {
            $(this).removeClass('hide-me');
            $('.read-more').removeClass('hide-me');
            $('.hiding').toggle();
            $('.dots').toggle();
        });
    </script>
@endsection
