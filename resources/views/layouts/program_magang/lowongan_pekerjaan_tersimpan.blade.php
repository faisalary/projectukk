@extends('partials_mahasiswa.template')

@section('page_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

</style>
@endsection

@section('main')
<div class="container-xxl flex-grow-1 container-p-y">
    {{-- balum ada lowongan tersimpan --}}
    <!-- <div class="col-3 mt-5 text-left">
    <img class="image" style="border-radius: 0%; margin-left: 400px; justify-content-center" src="{{ asset('front/assets/img/belum_ada_lowongan.png')}}" alt="admin.upload">
</div>
<div class="sec-title mt-5 mb-4" style="text-align:center">
    <p style="text-align: center">
    <h4><b> Belum Ada Lowongan Tersimpan </b></h4>
    </p>
    <div class="mt-4">
        <a href="javascript:void(0)" class="btn btn-success" type="submit">Cari Lowongan</a>
    </div>
</div> -->

    <div class="auto-container">
        <div class="sec-title mt-4 mb-4">
            <h4 class="ms-4">Lowongan Pekerjaan yang tersimpan : <span class="ms-5">10 Lowongan Pekerjaan Tersimpan </span></h4>
        </div>
        <div class="input-group input-group-merge ms-4" style="width:97%">
            <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
            <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
        </div>
        <div class="row mt-2 ps-4">
            <div class="col-5">
                <div class="row">
                    <div class="col-12 mt-3 mb-2">
                        <div class="card" style="width: 530px">
                            <div class="card-body">
                                <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                                    <div class="col-3 text-left">
                                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                                        </figure>
                                    </div>
                                    <div class="col-6 ms-3 ">
                                        <h5 class="mb-1" style="text-align: left !important; font-size: 20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Human Resources</h5>
                                        <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                                    </div>
                                    <div class="col-2 ms-3">
                                        <i onclick="myFunction(this)" class="fa fa-bookmark ms-4" style="font-size: 40px;color:#4EA971; "></i>
                                    </div>
                                </div>
                                <div class="border"></div>
                                <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px;margin-bottom:5px;"></i>Jakarta Selatan, Indonesia</div>
                                <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar" style="margin-right: 10px;margin-bottom:5px;"></i>Berbayar</div>
                                <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-calendar-time" style="margin-right: 10px;margin-bottom:5px;"></i>2 Semester</div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="location" style="margin-left: 2px;"><i class="ti ti-users" style="margin-right: 10px;margin-bottom:5px;"></i>5 Kuota Penerimaan</div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                                        <div class="location"> 8 hari lalu </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 mb-2">
                        <div class="card" style="width: 530px">
                            <div class="card-body">
                                <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                                    <div class="col-3 text-left">
                                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                                        </figure>
                                    </div>
                                    <div class="col-6 ms-3 ">
                                        <h5 class="mb-1" style="text-align: left !important; font-size: 20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Human Resources</h5>
                                        <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                                    </div>
                                    <div class="col-2 ms-3">
                                        <i onclick="myFunction(this)" class="fa fa-bookmark ms-4" style="font-size: 40px;color:#4EA971; "></i>
                                    </div>
                                </div>
                                <div class="border"></div>
                                <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px;margin-bottom:5px;"></i>Jakarta Selatan, Indonesia</div>
                                <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar" style="margin-right: 10px;margin-bottom:5px;"></i>Berbayar</div>
                                <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-calendar-time" style="margin-right: 10px;margin-bottom:5px;"></i>2 Semester</div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="location" style="margin-left: 2px;"><i class="ti ti-users" style="margin-right: 10px;margin-bottom:5px;"></i>5 Kuota Penerimaan</div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                                        <div class="location"> 8 hari lalu </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 mb-2">
                        <div class="card" style="width: 530px">
                            <div class="card-body">
                                <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                                    <div class="col-3 text-left">
                                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                                        </figure>
                                    </div>
                                    <div class="col-6 ms-3 ">
                                        <h5 class="mb-1" style="text-align: left !important; font-size: 20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Human Resources</h5>
                                        <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                                    </div>
                                    <div class="col-2 ms-3">
                                        <i onclick="myFunction(this)" class="fa fa-bookmark ms-4" style="font-size: 40px; color:#4EA971; "></i>
                                    </div>
                                </div>
                                <div class="border"></div>
                                <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px;margin-bottom:5px;"></i>Jakarta Selatan, Indonesia</div>
                                <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar" style="margin-right: 10px;margin-bottom:5px;"></i>Berbayar</div>
                                <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-calendar-time" style="margin-right: 10px;margin-bottom:5px;"></i>2 Semester</div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="location" style="margin-left: 2px;"><i class="ti ti-users" style="margin-right: 10px;margin-bottom:5px;"></i>5 Kuota Penerimaan</div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                                        <div class="location"> 8 hari lalu </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 mb-2">
                        <div class="card" style="width: 530px">
                            <div class="card-body">
                                <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                                    <div class="col-3 text-left">
                                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                                        </figure>
                                    </div>
                                    <div class="col-6 ms-3 ">
                                        <h5 class="mb-1" style="text-align: left !important; font-size: 20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Human Resources</h5>
                                        <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                                    </div>
                                    <div class="col-2 ms-3">
                                        <i onclick="myFunction(this)" class="fa fa-bookmark ms-4" style="font-size: 40px; color:#4EA971; "></i>
                                    </div>
                                </div>
                                <div class="border"></div>
                                <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px;margin-bottom:5px;"></i>Jakarta Selatan, Indonesia</div>
                                <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar" style="margin-right: 10px;margin-bottom:5px;"></i>Berbayar</div>
                                <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-calendar-time" style="margin-right: 10px;margin-bottom:5px;"></i>2 Semester</div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="location" style="margin-left: 2px;"><i class="ti ti-users" style="margin-right: 10px;margin-bottom:5px;"></i>5 Kuota Penerimaan</div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                                        <div class="location"> 8 hari lalu </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 mb-2">
                        <div class="card" style="width: 530px">
                            <div class="card-body">
                                <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                                    <div class="col-3 text-left">
                                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                                        </figure>
                                    </div>
                                    <div class="col-6 ms-3 ">
                                        <h5 class="mb-1" style="text-align: left !important; font-size: 20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Human Resources</h5>
                                        <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                                    </div>
                                    <div class="col-2 ms-3">
                                        <i onclick="myFunction(this)" class="fa fa-bookmark ms-4" style="font-size: 40px; color:#4EA971; "></i>
                                    </div>
                                </div>
                                <div class="border"></div>
                                <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px; margin-bottom:5px;"></i>Jakarta Selatan, Indonesia</div>
                                <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar" style="margin-right: 10px; margin-bottom:5px;"></i>Berbayar</div>
                                <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-calendar-time" style="margin-right: 10px; margin-bottom:5px;"></i>2 Semester</div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="location" style="margin-left: 2px;"><i class="ti ti-users" style="margin-right: 10px; margin-bottom:5px;"></i>5 Kuota Penerimaan</div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                                        <div class="location"> 8 hari lalu </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-2">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item ">
                                <a class="page-link waves-effect" href="javascript:void(0);">Previous</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link waves-effect" href="javascript:void(0);">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link waves-effect" href="javascript:void(0);">2</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link waves-effect" href="javascript:void(0);">3</a>
                            </li>
                            <li class="page-item ">
                                <a class="page-link waves-effect" href="javascript:void(0);">Next</a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>

            <div class="col-7">
                <div class="row">
                    <div class="col-12 mt-3 mb-2">
                        <div class="card" style="width: 765px; height: auto;">
                            <div class="card-body">
                                <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                                    <div class="d-flex justify-content-between mb-3">
                                        <figure class="image" style="border-radius: 0%; margin-left: 10px;"><img style="width:180px;" src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                        </figure>
                                        <div style="margin-left: 250px;">
                                            <small class="text-muted" style="font-size: 18px;">Batas Melamar 13 Juli
                                                2023</small><br>
                                            <div class="row mt-2">
                                                <a href="/detail/lowongan/magang"><button type="button" class="btn btn-sm btn-outline-dark waves-effect" style="width: 200px; margin-left:15px;">Buka dihalaman baru</button>
                                                </a><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2 mb-2 ms-1 p-0">
                                        <h4 style=" margin-bottom: 0px; ">PT
                                            Wings Surya</h4>
                                        <h1 class="mb-1" style="  text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">
                                            Human Resources</h1>
                                    </div>
                                    <div class="d-flex ms-2 mt-2" style="font-size: 14px;  !important">
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
                                                Berbayar
                                            </li>
                                            <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                                <i class="ti ti-calendar-time  ti-xs me-2"></i>
                                                2 Semerter
                                            </li>
                                        </ul>
                                        <ul style="padding: 0 0 0 20px; !important">
                                            <li class="list-group-item d-flex align-items-start fw-semibold" style="margin-top: 15px !important">
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
                                    <button type="submit" class="btn btn-success ms-4" style="height:50px; width:695px; border-radius:8px;">Lamar Lowongan</button>
                                </div>

                                <div class="row mt-3 p-2">
                                    <h3>
                                        <b>Deskripsi Pekerjaan</b>
                                    </h3>
                                    <div class="row">
                                        <ul style="margin-left: 20px; margin-bottom:0;">
                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Manage Talent Acquisition activities for Desk Worker and Non-Desk Worker.
                                            </li>

                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Lead HR Internal Communication and Employer Branding.
                                            </li>

                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Manage On-Boarding program for new hire.
                                            </li>

                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Support employee Performance Evaluation process.
                                            </li>

                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Support Talent Management and Succession Planning function.
                                            </li>

                                            <div class="content-new">
                                                
                                                <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                    Conduct HR People Analytic such as headcount, labor-cost, hours-work, etc. </li>

                                                <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                    Lead Employee Engagement activities and events. </li>

                                                <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                    Liaise with relevant parties to ensure HR function executed smoothly. </li>

                                                <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                    Support other HR Indonesia operations activities. </li>
                                            </div>

                                            <div class="show_hide_new cursor-pointer" style="color:#4EA971">
                                                Lebih banyak
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row mt-3 ps-2">
                                    <h3>
                                        <b>Requirement</b>
                                    </h3>
                                    <div class="row">
                                        <ul style="margin-left: 20px; margin-bottom:0;">
                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                At least Bachelor's degree in any field.
                                            </li>
                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                At least 3 years of experience in HR / HRBP.
                                            </li>
                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Has strong numerical capability and excel expertise.
                                            </li>
                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Has experience using Workday will be an advantage.
                                            </li>
                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                    Good command of spoken and written English. 
                                            </li>
                                            <div class="content-new">
                                                <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                    Strong attention to detail. </li>

                                                <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                    Self-motivated and able to work without supervision. </li>

                                                <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                    Willing to work in Cikampek area. </li>
                                            </div>

                                            <div class="show_hide_new cursor-pointer" style="color:#4EA971">
                                                Lebih banyak
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row mt-3 ps-2">
                                    <h3>
                                        <b>Benefit</b>
                                    </h3>
                                    <div class="row">
                                        <ul style="margin-left: 20px; margin-bottom:0;">
                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Family Care.
                                            </li>
                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Parking Access.
                                            </li>
                                            <li class="cursor-pointer content" style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                Reward Compensation.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row mt-3 ps-2">
                                    <h3>
                                        <b>Kemampuan</b>
                                    </h3>
                                    <div class="row">
                                        <div class="d-flex" style="column-gap: 20px; padding-bottom: 30px !important">
                                            <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">SPSS</span>
                                            <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">Microsoft Office</span>
                                            <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">Google Suite</span>
                                            <span class="badge rounded-pill bg-success bg-glow" style="font-size: 15px;">Counseling Tools</span>
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin-top: -5px;">
                                <div class="row mt-2 mb-2">
                                    <h4 style="text-align: left !important; font-size:20px;">
                                        <b>Tentang Perusahaan</b>
                                    </h4>
                                </div>
                                <div class="row mt-3 mb-2">
                                    <div class="box">
                                        <p class="cursor-pointer content" style="text-align: left !important; font-size:17px;">Lorem
                                            ÅF and Pöyry joined forces in order to become an international engineering, design and advisory company,
                                            driving digitalisation and sustainability for the energy, infrastructure and industrial sectors all over the world.
                                        </p>

                                        <div class="content-new">
                                            <p class="cursor-pointer content" style="text-align: left !important; font-size:17px;"> AFRY as a new common brand of ÅF Pöyry is one of the largest international power sector consulting and engineering
                                                company with about 17,000 experts working across the world to create sustainable solutions for future generations.</p>
                                        </div>

                                        <div class="show_hide_new cursor-pointer" style="color:#4EA971">
                                            Lebih banyak
                                        </div>
                                        <br>

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
@endsection

@section('page_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
<script>
    $(document).ready(function() {
        $(".content-new").hide();
        $(".show_hide_new").on("click", function() {
            $(this).prev('.content-new').slideToggle(100);
            console.log($(this).text().trim())
            if ($(this).text().trim() == "Lebih Banyak") {
                $(this).text("Lebih Banyak");
            } else {
                $(this).text("Lebih Sedikit")
            }
        });
    });

    function myFunction(x) {
        x.classList.toggle("fa-bookmark");
        x.classList.toggle("fa-bookmark-o");
    }
</script>
@endsection