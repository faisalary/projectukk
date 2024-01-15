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

    .progress-bar {
        background-color: #4EA971 !important;
        color: #fff;
    }
</style>
@endsection

@section('main')
<div class="auto-container ms-5 me-5">
    <div class="sec-title m-4">
        <h4>Anda akan melamar di PT Wings Surya sebagai Human Resources</h4>
    </div>

    <div class="alert alert-warning alert-dismissible ms-4 me-4 mb-4" role="alert">
        <i class="ti ti-alert-triangle ti-xs"></i>
        <span style="color: #23314B; padding-left:10px; padding-top:5px;"> Silahkan lakukan pengisian data dengan minimal kelengkapan 70% untuk melanjutkan proses melamar pekerjaan</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4>Informasi Data Diri</h4>
                <div class="row">
                    <div class="col-2">
                        <img class="img-fluid rounded" src="../../app-assets/img/avatars/15.png" height="100" width="100" alt="User avatar" />
                        <a href="pratinjau/diri" class="btn btn-outline-secondary btn-label-secondary mt-3" type="button"><i class="ti ti-eye me-1"></i> Pratinjau</a>
                    </div>
                    <div class="col-7">
                        <div class="row">
                            <div class="col-3">
                                <div>
                                    <h6 class="mb-0">Nama Lengkap</h6>
                                    <p>Violet Mendoza</p>
                                </div>
                                <div>
                                    <h6 class="mb-0">NIM</h6>
                                    <p>6705513025</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div>
                                    <h6 class="mb-0">ALamat Email</h6>
                                    <p>jennieruby123@gmail.com</p>
                                </div>
                                <div>
                                    <h6 class="mb-0">No.Telp</h6>
                                    <p>87654321234</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div>
                                    <h6 class="mb-0">Program Studi</h6>
                                    <p>D3 Sistem Informasi</p>
                                </div>
                                <div>
                                    <h6 class="mb-0">Fakultas</h6>
                                    <p>Fakultas Ilmu Terapan</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <h6 class="mb-0">Universitas</h6>
                                <p>Telkom University</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="text-start">Kelengkapan Profil</h6>
                            <h6 class="text-end">68%</h6>
                        </div>
                        <div class="progress">
                            <div class="progress-bar w-75" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <a href="/informasi/pribadi" class="btn btn-outline-success btn-label-success mt-2" type="button">Lengkapi Profile</a>
                    </div>
                </div>
                <div class="mt-5">
                    <h4>Mengapa Kami Harus Menerima Anda?</h4>
                    <textarea class="form-control" type="text" id="deskripsi" name="deskripsi" placeholder="Tulis Disini" disabled></textarea>
                    <h4 class="mt-3">Surat Lamaran Kerja</h4>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" disabled>
                        <label class="form-check-label text-secondary" for="defaultCheck1"> Saya tidak memiliki surat lamaran
                            kerja </label>
                    </div>
                    <div class="mt-3">
                        <label for="formFile" class="form-label text-secondary">Unggah Surat Lamaran Kerja</label>
                        <input class="form-control" type="file" id="formFile" disabled>
                    </div>
                    <button type="button" class="btn btn-success waves-effect waves-light mt-3" disabled>Kirim lamaran sekarang</button>
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <div style="border-bottom: 1px solid #D3D6DB;">
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
                            Manage People Development process from training need analysis into post-training
                            effectiveness
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
                            Experience within a rapidly changing organization in Multinational Company preferably within
                            a
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
                        <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">Microsoft
                            Office</span>
                        <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">Google Suite</span>
                        <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">Counseling
                            Tools</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5 mb-5">
            <div class="card-body">
                <div class="mt-2">
                    <h3>Tentang Perusahaan</h3>
                    <div class="row">
                        <div class="col-6">
                            <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                            </figure>
                        </div>
                        <div class="col-6 text-end">
                            <a href="/detail_perusahaan" class="btn btn-outline-success btn-label-success mt-2" type="button">LIhat Perusahaan</a>
                        </div>
                        <div class="col-12">
                            <p style="text-align: left !important; font-size:18px; margin-bottom: 0px;">PT Wings
                                Surya</p>
                        </div>
                    </div>
                    <p class="mt-3">
                        ÅF and Pöyry joined forces in order to become an international engineering, design and advisory company,
                        driving digitalisation and sustainability for the energy, infrastructure and industrial sectors all over
                        the
                        world.
                    </p>
                    <ul class="list-unstyled">
                        <li class="mb-1">
                            <span class="fw-semibold me-1">Kontak:</span>
                            <span>628123456789</span>
                        </li>
                        <li class="mb-2 pt-1">
                            <span class="fw-semibold me-1">Email:</span>
                            <span>recruiter@wings.id</span>
                        </li>
                        <li class="mb-2 pt-1">
                            <span class="fw-semibold me-1">Website:</span>
                            <span><u style="color:#4EA971; cursor: pointer;">www.wingsfood.com</u></span>
                        </li>
                        <li class="mb-2 pt-1">
                            <span class="fw-semibold me-1">Sosial Media:</span>
                            <span class="social-links">
                                <a href="#" class="ml-0"><i class="fab fa-facebook-f" style="color: #4EA971; margin-right: 10px;"></i></a>
                                <a href="#"><i class="fab fa-instagram" style="color: #4EA971; margin-right: 10px;"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in" style="color: #4EA971; margin-right: 10px;"></i></a>
                                <a href="#"><i class="fab fa-twitter" style="color: #4EA971; margin-right: 10px;"></i></a>
                            </span>
                        </li>
                    </ul>
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