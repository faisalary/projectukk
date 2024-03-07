@extends('partials_mahasiswa.template')

@section('page_style')
<style>
    .hidden {
        display: none;
    }

    .page-item.active .page-link,
    .pagination li.active>a:not(.page-link) {
        border-color: #FFFFFF !important;
        background-color: #4EA971 !important;
    }

    .btn-success {
        color: #fff;
        background-color: #4EA971 !important;
        border-color: #4EA971 !important;
    }

    .highlight {
        background-color: #4EA971 !important;
        color: white !important;
    }
</style>
@endsection

@section('main')
<div class="container-xxl flex-grow-1 container-p-y">
    <a href="/daftar_perusahaan" type="button" class="btn btn-outline-success mt-4 mb-3 waves-effect">
        <span class="ti ti-arrow-left me-2"></span>Kembali
    </a>
    <div class="sec-title">
        <h4>Detail Lowongan Pekerjaan</h4>
    </div>
    <div class="mb-5">
        <div class="card" style="padding: 50px 30px; width: 100%;">
            <div class="card-body d-flex flex-row justify-content-between" style=" border-bottom: 1px solid #D3D6DB;  !important">
                <div class="">
                    <div class="d-flex items-center justify-content-start">
                        <img src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="" style="width: 150px; height: 90px; !important">
                        <div class="ms-5">
                            <p class="fw-bolder text-black" style="font-size: 32px; color: #23314B">Human Resources</p>
                            <p class="mt-n3" style="font-size: 18px; color: #4B465C">IT consultant</p>
                        </div>
                    </div>
                    <div class="d-flex" style="margin-top: 40px; font-size: 16px; color: #23314B; !important">
                        <ul style="border-right: 1px solid #D3D6DB; padding: 0 20px 0 0;">
                            <li class="d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-users ti-xs me-2"></i>
                                100 Mahasiswa
                            </li>
                            <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-briefcase ti-xs me-2"></i>
                                Onsite
                            </li>
                            <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-calendar-time  ti-xs me-2"></i>
                                2 Semerter
                            </li>
                        </ul>
                        <ul style="border-right: 1px solid #D3D6DB; padding: 0 20px 0 20px;">
                            <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-map-pin  ti-xs me-2"></i>
                                Bandung & Jakarta
                            </li>
                            <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-currency-dollar  ti-xs me-2"></i>
                                Rp 1.000.000 - 5.000.000
                            </li>
                            <li class="d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-building-community  ti-xs me-2"></i>
                                D3
                            </li>
                        </ul>
                        <ul style="padding: 0 0 0 20px;">
                            <li class="list-group-item d-flex align-items-start fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-school ti-xs me-2"></i>
                                <div>
                                    Program Studi
                                    <ul style="list-style-type: disc; padding-left: 20px; margin-top: 5px;">
                                        <li>Rekayasa Perangkat Lunak</li>
                                        <li>Manajemen Pemasaran</li>
                                        <li>Sistem Informasi</li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-auto text-end">
                    <p class="mt-5" style="font-size: 18px;">Batas Melamar 13 Juli 2023</p>
                    <div class="text-end mt-4 me-2">
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-3" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Laporkan"><button type="button" class="btn btn-outline-dark waves-effect me-3" onclick="changeColor(this)" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                    <i class="ti ti-flag"></i>
                                </button>
                            </div>
                            <div class="col-3" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Bagikan "><button type="button" class="btn btn-outline-dark waves-effect me-3" onclick="changeColor(this)" data-bs-toggle="modal" data-bs-target="#modalbagikan">
                                    <i class="ti ti-share"></i>
                                </button>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-outline-dark waves-effect" onclick="changeColor(this)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Simpan">
                                    <i class="ti ti-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4"></div>
                    <a href="/apply" type="submit" class="btn btn-success waves-effect waves-light" style="height: 50px; width: 230px;">
                        Lamar Lowongan
                    </a>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-body text-center">
                                    <figure class="image"><img src="{{ url('/app-assets/img/Talentern.svg')}}"></figure>
                                    <div class="text-center">
                                        <div class=""></div>
                                        <h4>Apakah anda akan melaporkan lowongan ini? </h4>
                                        <p>Jika ya, silahkan plih salah satu alasan berikut dan tim Kepercayaan dan
                                            Keamanan kami akan memeriksanya. </p>
                                    </div>
                                    <div class="modal-body pt-0">
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-outline-dark waves-effect" style="width: 370px;">
                                                Ini adalah akun palsu
                                            </button>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-outline-dark waves-effect" style="width: 370px;">
                                                Mereka berpura-pura menjadi perusahaan lain
                                            </button>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-outline-dark waves-effect" style="width: 370px;">
                                                Mereka mencoba berbagi informasi kontak
                                            </button>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="button" class="btn btn-outline-dark waves-effect" data-bs-toggle="modal" data-bs-target="#modalLaporan" style="width: 370px;">
                                                Lainnya
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalLaporan" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-body text-center pb-0">
                                    <figure class="image"><img src="{{ url('/app-assets/img/Talentern.svg')}}"></figure>
                                    <div>
                                        <h4 class="text-center">Laporkan PT Mencari Cinta Sejati </h4>
                                        <p class="text-start">Harap tambahkan informasi tambahan dan detail pendukung agar tim Kepercayaan dan Keamanan kami dapat memeriksa laporan Anda dengan lebih baik. </p>
                                    </div>
                                </div>
                                <div class="modal-body pt-0">
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="nameWithTitle" class="form-label">Nama Lowongan </label>
                                            <input type="text" id="nameWithTitle" class="form-control" placeholder="Nama Lowongan" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col mb-0">
                                            <label for="namaWithTitle" class="form-label">Nama Depan</label>
                                            <input type="text" id="namaWithTitle" class="form-control" placeholder="Nama Depan">
                                        </div>
                                        <div class="col mb-0">
                                            <label for="namaWithTitle" class="form-label">Nama Belakang</label>
                                            <input type="text" id="namaWithTitle" class="form-control" placeholder="Nama Belakang">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="emailWithTitle" class="form-label">Email<span class="text-danger">*</span></label>
                                            <input type="email" id="emailWithTitle" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="deskripsiWithTitle" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                            <textarea id="deskripsiWithTitle" class="form-control" placeholder="Deskripsi"></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success waves-effect waves-light" style="width: 510px;">
                                            Kirim
                                        </button>
                                    </div>
                                    <div class="mb-1"></div>
                                    <button type="submit" class="btn btn-secondary waves-effect waves-light" data-bs-dismiss="modal" aria-label="Close" style="width: 510px;">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalbagikan" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-body text-center pb-0">
                                    <!-- <figure class="image"><img src="{{ url('/app-assets/img/Talentern.svg')}}"></figure> -->
                                    <div class="text-start">
                                        <h4>Share </h4>
                                    </div>
                                </div>
                                <div class="modal-body pt-0">
                                    <div class="row">
                                        <div class="col-2 mb-3 text-center p-0">
                                            <button type="button" class="btn rounded-pill btn-icon btn-dark waves-effect waves-light" style="width: 50px; height:50px;">
                                                <span class="ti ti-brand-tiktok" style="font-size: 40px;"></span>
                                            </button>
                                            <p class="mt-1">TikTok</p>
                                        </div>
                                        <div class="col-2 mb-3 text-center p-0">
                                            <button type="button" class="btn rounded-pill btn-icon btn-success waves-effect waves-light" style="width: 50px; height:50px; background-color: #65D072 !important;">
                                                <span class="ti ti-brand-whatsapp" style="font-size: 35px;"></span>
                                            </button>
                                            <p class="mt-1">WhatsApp</p>
                                        </div>
                                        <div class="col-2 mb-3 text-center p-0">
                                            <button type="button" class="btn rounded-pill btn-icon btn-primary waves-effect waves-light" style="width: 50px; height:50px; background-color: #425893 !important;">
                                                <span class="ti ti-brand-facebook" style="font-size: 30px;"></span>
                                            </button>
                                            <p class="mt-1">Facebook</p>
                                        </div>
                                        <div class="col-2 mb-3 text-center p-0">
                                            <button type="button" class="btn rounded-pill btn-icon btn-info waves-effect waves-light" style="width: 50px; height:50px; background-color: #1EA1F2 !important;">
                                                <span class="ti ti-brand-twitter" style="font-size: 25px;"></span>
                                            </button>
                                            <p class="mt-1">Twitter</p>
                                        </div>
                                        <div class="col-2 mb-3 text-center p-0">
                                            <button type="button" class="btn rounded-pill btn-icon btn-secondary waves-effect waves-light" style="width: 50px; height:50px;">
                                                <span class="ti ti-mail" style="font-size: 35px;"></span>
                                            </button>
                                            <p class="mt-1">Email</p>
                                        </div>
                                        <div class="col-2 mb-3 text-center p-0">
                                            <button type="button" class="btn rounded-pill btn-icon btn-danger waves-effect waves-light" style="width: 50px; height:50px; background-color: #FF0000 !important;">
                                                <span class="ti ti-brand-youtube" style="font-size: 35px;"></span>
                                            </button>
                                            <p class="mt-1">Youtube</p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="border" style="border-radius: 20px;">
                                            <div class="row">
                                                <div class="col-10">
                                                    <p class="m-2">http://sample.info/?#UIUX</p>
                                                </div>
                                                <div class="col-2">
                                                    <button type="button" class="btn rounded-pill btn-success waves-effect waves-light" style="width: 65px; height:40px;">
                                                        Copy
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
            <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
                <h3 style="color: #23314B; padding-left: 20px;"><b>Deskipsi pekerjaan</b></h3>
                <ul style="list-style-type: disc; padding-left: 50px; margin-top: 5px; padding-bottom: 30px; font-size: 18px; color: #23314B;">
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
                <h3 style="color: #23314B; padding-left: 20px;"><b>Requirements</b></h3>
                <ul style="list-style-type: disc; padding-left: 50px; margin-top: 5px; padding-bottom: 30px; font-size: 18px; color: #23314B;">
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
                <h3 style="color: #23314B; padding-left: 20px;"><b>Benefit</b></h3>
                <ul style="list-style-type: disc; padding-left: 50px; margin-top: 5px; padding-bottom: 30px; font-size: 18px; color: #23314B;">
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
                <h3 style="color: #23314B; padding-left: 20px;"><b>Kemampuan</b></h3>

                <div class="d-flex" style="column-gap: 10px; padding-left: 20px; padding-bottom: 30px !important">
                    <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">SPSS</span>
                    <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">Microsoft Office</span>
                    <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">Google Suite</span>
                    <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">Counseling Tools</span>
                </div>
            </div>

            <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
                <h3 style="color: #23314B; padding-left: 20px;"><b>Tentang Perusahaan</b></h3>

                <p style="margin-top: 5px; padding-left: 20px; font-size: 18px; color: #23314B;">
                    ÅF and Pöyry joined forces in order to become an international engineering, design and advisory company,
                    driving digitalisation and sustainability for the energy, infrastructure and industrial sectors all over
                    the
                    world. AFRY as a new common brand of ÅF Pöyry is one of the largest international power sector
                    consulting
                    and engineering company with about 17,000 experts working across the world to create sustainable
                    solutions
                    for future generations
                </p>
                <div style="margin-top: 5px; padding-left: 20px; padding-bottom: 30px;">
                    <a href="/detail_perusahaan" class="btn btn-outline-success btn-label-success mt-2" type="button">LIhat Perusahaan</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page_script')
<script>
    function changeColor(button) {
        button.classList.toggle('highlight');
    }
</script>
@endsection