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
<div class="container-xxl flex-grow-1 container-p-y">
    <a href="" type="button" class="btn btn-outline-success mt-4 mb-3 waves-effect">
        <span class="ti ti-arrow-left me-2"></span>Kembali
    </a>
    <div class="sec-title">
        <h4>Daftar Untuk UI/UX Designer</h4>
    </div>

    <div class="alert alert-warning alert-dismissible" role="alert">
        <i class="ti ti-alert-triangle ti-xs"></i>
        <span style=" padding-left:10px; padding-top:5px; color:#322F3D;"> Silahkan melakukan pengisian data dengan minimal kelengkapan 70% untuk melanjutkan proses melamar pekerjaan</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

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
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-body">
            <div>
                <h4>Portofolio</h4>
                <div class="mt-3">
                    <label for="formFile" class="form-label text-secondary">Unggah Portofolio</label>
                    <input class="form-control" type="file" id="formFile">
                    <p class="mt-1" style="font-size: 14px;">Allowed PDF and Docs. Max size of 10 GB</p>
                </div>
                <button type="button" class="btn btn-success waves-effect waves-light mt-3">Kirim lamaran sekarang</button>
            </div>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-body">
            <div style="border-bottom: 1px solid #D3D6DB;">
                <h3>Deskipsi pekerjaan</h3>
                <ul>
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
                <h3>Requirements</h3>
                <ul>
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
                <h3>Benefit</h3>
                <ul>
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
                <h3>Kemampuan</h3>
                <div class="d-flex" style="column-gap: 10px;  padding-bottom: 30px !important">
                    <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">SPSS</span>
                    <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">Microsoft
                        Office</span>
                    <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">Google Suite</span>
                    <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">Counseling
                        Tools</span>
                </div>
            </div>

            <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
                <h3>Tentang Perusahaan</h3>
                <div class="d-flex justify-content-start">
                    <figure class="image" style="border-radius: 0%; "><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                    </figure>
                    <h5 class="ms-4 mt-4">PT Wings Surya</h5>
                </div>
                <p>ÅF and Pöyry joined forces in order to become an international engineering, design and advisory company, driving digitalisation and sustainability for the energy, infrastructure and industrial sectors all over the world. AFRY as a new common brand of ÅF Pöyry is one of the largest international power sector consulting and engineering company with about 17,000 experts working across the world to create sustainable solutions for future generations</p>

                <div class="mb-3">
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