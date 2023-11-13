@extends('partials_mahasiswa.template')

@section('page_style')
    <style>
        .hidden {
            display: none;
        }

        .page-item.active .page-link, .pagination li.active > a:not(.page-link) {
                border-color: #FFFFFF !important;
                background-color: #4EA971 !important;
                }
    </style>
@endsection

@section('main')
    <div class="auto-container">
        <div class="sec-title mt-4 mb-4">
            <h4>Lowongan Pekerjaan yang tersimpan : <span class="ms-5">10 Lowongan Pekerjaan Tersimpan </span></h4>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-12 mt-3 mb-2">
                        <div class="card" style="width: 650px">
                            <div class="card-body">
                                <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                                    <div class="col-3 text-left">
                                        <figure class="image" style="border-radius: 0%; margin-left: 15px;"><img
                                                style="border-radius: 0%;"
                                                src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                        </figure>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-1"
                                            style="text-align: left !important; font-size:25px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">
                                            Human Resources</h5>
                                        <p style="text-align: left !important; font-size:16px; margin-bottom: 0px;">PT Wings
                                            Surya</p>
                                        <p style="text-align: left !important; font-size:12px; margin-bottom: 0px;">Jl.
                                            Gatot Soebroto No 577, Tangerang</p>
                                    </div>
                                    <div class="col-3">
                                        <div class="d-flex justify-content-end"
                                            style="text-align: left !important; padding: 0px;">
                                            <li class="list-inline-item mt-3 mb-4"><b> 8 hari lalu </b><i
                                                    class="ti ti-clock" style="margin-right: 10px"></i></li>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-2">
                                    <div class="box">
                                        <p class="cursor-pointer content"
                                            style="text-align: left !important; font-size:17px; margin-bottom: 0px;">Lorem
                                            Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                            has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                            book. It has survived not only five centuries, but also the leap into electronic
                                            typesetting, remaining essentially unchanged.
                                        </p>

                                        <div class="content-new">
                                            <!-- This is hide by default and open on toggle -->
                                            <p> It was popularised in the 1960s with the release of Letraset sheets
                                                containing Lorem Ipsum passages, and more recently with desktop publishing
                                                software like Aldus PageMaker including versions of Lorem Ipsum</p>
                                        </div>

                                        <div class="show_hide_new cursor-pointer" style="color:#4EA971">
                                            Lebih banyak
                                        </div>
                                        <br>

                                    </div>
                                    <hr class="mt-3">
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item mt-3 mb-3"><i class="ti ti-currency-dollar"
                                                style="margin-right: 10px;margin-bottom: 5px;"></i>IDR 4.300.000-5.500.000
                                        </li>
                                        <li class="list-inline-item mt-3 mb-3"><i class="ti ti-briefcase"
                                                style="margin-right: 10px;margin-left: 10px;margin-bottom: 5px;"></i> Full
                                            time </li>
                                        <li class="list-inline-item mt-3 mb-3"><i class="fas fa-user-friends"
                                                style="margin-right: 10px;margin-left: 10px;margin-bottom: 6px;"></i>
                                            Advanced </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 mb-2">
                        <div class="card" style="width: 650px">
                            <div class="card-body">
                                <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                                    <div class="col-3 text-left">
                                        <figure class="image" style="border-radius: 0%; margin-left: 15px;"><img
                                                style="border-radius: 0%;"
                                                src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                        </figure>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-1"
                                            style="text-align: left !important; font-size:25px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">
                                            Human Resources</h5>
                                        <p style="text-align: left !important; font-size:16px; margin-bottom: 0px;">PT Wings
                                            Surya</p>
                                        <p style="text-align: left !important; font-size:12px; margin-bottom: 0px;">Jl.
                                            Gatot Soebroto No 577, Tangerang</p>
                                    </div>
                                    <div class="col-3">
                                        <div class="d-flex justify-content-end"
                                            style="text-align: left !important; padding: 0px;">
                                            <li class="list-inline-item mt-3 mb-3"><b> 8 hari lalu </b><i
                                                    class="ti ti-clock" style="margin-right: 10px"></i></li>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-2">
                                    <div class="box">
                                        <p class="cursor-pointer content"
                                            style="text-align: left !important; font-size:17px; margin-bottom: 0px;">Lorem
                                            Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                            has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                            book. It has survived not only five centuries, but also the leap into electronic
                                            typesetting, remaining essentially unchanged.
                                        </p>

                                        <div class="content-new">
                                            <!-- This is hide by default and open on toggle -->
                                            <p> It was popularised in the 1960s with the release of Letraset sheets
                                                containing Lorem Ipsum passages, and more recently with desktop publishing
                                                software like Aldus PageMaker including versions of Lorem Ipsum</p>
                                        </div>

                                        <div class="show_hide_new cursor-pointer" style="color:#4EA971">
                                            Lebih banyak
                                        </div>
                                        <br>

                                    </div>
                                    <hr class="mt-3">
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item mt-3 mb-3"><i class="ti ti-currency-dollar"
                                                style="margin-right: 10px;margin-bottom: 5px;"></i>IDR 4.300.000-5.500.000
                                        </li>
                                        <li class="list-inline-item mt-3 mb-3"><i class="ti ti-briefcase"
                                                style="margin-right: 10px;margin-left: 10px;margin-bottom: 5px;"></i> Full
                                            time </li>
                                        <li class="list-inline-item mt-3 mb-3"><i class="fas fa-user-friends"
                                                style="margin-right: 10px;margin-left: 10px;margin-bottom: 6px;"></i>
                                            Advanced </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 mb-2">
                        <div class="card" style="width: 650px">
                            <div class="card-body">
                                <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                                    <div class="col-3 text-left">
                                        <figure class="image" style="border-radius: 0%; margin-left: 15px;"><img
                                                style="border-radius: 0%;"
                                                src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt="admin.upload">
                                        </figure>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-1"
                                            style="text-align: left !important; font-size:25px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">
                                            Human Resources</h5>
                                        <p style="text-align: left !important; font-size:16px; margin-bottom: 0px;">PT
                                            Wings Surya</p>
                                        <p style="text-align: left !important; font-size:12px; margin-bottom: 0px;">Jl.
                                            Gatot Soebroto No 577, Tangerang</p>
                                    </div>
                                    <div class="col-3">
                                        <div class="d-flex justify-content-end"
                                            style="text-align: left !important; padding: 0px;">
                                            <li class="list-inline-item mt-3 mb-3"><b> 8 hari lalu </b><i
                                                    class="ti ti-clock" style="margin-right: 10px"></i></li>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-2">
                                    <div class="box">
                                        <p class="cursor-pointer content"
                                            style="text-align: left !important; font-size:17px; margin-bottom: 0px;">Lorem
                                            Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                            has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                            book. It has survived not only five centuries, but also the leap into electronic
                                            typesetting, remaining essentially unchanged.
                                        </p>

                                        <div class="content-new">
                                            <!-- This is hide by default and open on toggle -->
                                            <p> It was popularised in the 1960s with the release of Letraset sheets
                                                containing Lorem Ipsum passages, and more recently with desktop publishing
                                                software like Aldus PageMaker including versions of Lorem Ipsum</p>
                                        </div>

                                        <div class="show_hide_new cursor-pointer" style="color:#4EA971">
                                            Lebih banyak
                                        </div>
                                        <br>

                                    </div>
                                    <hr class="mt-3">
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item mt-3 mb-3"><i class="ti ti-currency-dollar"
                                                style="margin-right: 10px;margin-bottom: 5px;"></i>IDR 4.300.000-5.500.000
                                        </li>
                                        <li class="list-inline-item mt-3 mb-3"><i class="ti ti-briefcase"
                                                style="margin-right: 10px;margin-left: 10px;margin-bottom: 5px;"></i> Full
                                            time </li>
                                        <li class="list-inline-item mt-3 mb-3"><i class="fas fa-user-friends"
                                                style="margin-right: 10px;margin-left: 10px;margin-bottom: 6px;"></i>
                                            Advanced </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 mb-2">
                        <div class="card" style="width: 650px">
                            <div class="card-body">
                                <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                                    <div class="col-3 text-left">
                                        <figure class="image" style="border-radius: 0%; margin-left: 15px;"><img
                                                style="border-radius: 0%;"
                                                src="{{ asset('front/assets/img/icon_lowongan.png') }}"
                                                alt="admin.upload">
                                        </figure>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-1"
                                            style="text-align: left !important; font-size:25px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">
                                            Human Resources</h5>
                                        <p style="text-align: left !important; font-size:16px; margin-bottom: 0px;">PT
                                            Wings Surya</p>
                                        <p style="text-align: left !important; font-size:12px; margin-bottom: 0px;">Jl.
                                            Gatot Soebroto No 577, Tangerang</p>
                                    </div>
                                    <div class="col-3">
                                        <div class="d-flex justify-content-end"
                                            style="text-align: left !important; padding: 0px;">
                                            <li class="list-inline-item mt-3 mb-3"><b> 8 hari lalu </b><i
                                                    class="ti ti-clock" style="margin-right: 10px"></i></li>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-2">
                                    <div class="box">
                                        <p class="cursor-pointer content"
                                            style="text-align: left !important; font-size:17px; margin-bottom: 0px;">Lorem
                                            Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                            has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                            book. It has survived not only five centuries, but also the leap into electronic
                                            typesetting, remaining essentially unchanged.
                                        </p>

                                        <div class="content-new">
                                            <!-- This is hide by default and open on toggle -->
                                            <p> It was popularised in the 1960s with the release of Letraset sheets
                                                containing Lorem Ipsum passages, and more recently with desktop publishing
                                                software like Aldus PageMaker including versions of Lorem Ipsum</p>
                                        </div>

                                        <div class="show_hide_new cursor-pointer" style="color:#4EA971">
                                            Lebih banyak
                                        </div>
                                        <br>

                                    </div>
                                    <hr class="mt-3">
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item mt-3 mb-3"><i class="ti ti-currency-dollar"
                                                style="margin-right: 10px;margin-bottom: 5px;"></i>IDR 4.300.000-5.500.000
                                        </li>
                                        <li class="list-inline-item mt-3 mb-3"><i class="ti ti-briefcase"
                                                style="margin-right: 10px;margin-left: 10px;margin-bottom: 5px;"></i> Full
                                            time </li>
                                        <li class="list-inline-item mt-3 mb-3"><i class="fas fa-user-friends"
                                                style="margin-right: 10px;margin-left: 10px;margin-bottom: 6px;"></i>
                                            Advanced </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-2">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item prev">
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
                            <li class="page-item">
                                <a class="page-link waves-effect" href="javascript:void(0);">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link waves-effect" href="javascript:void(0);">5</a>
                            </li>
                            <li class="page-item next">
                                <a class="page-link waves-effect" href="javascript:void(0);">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="col-6">
                <div class="row">
                    <div class="col-12 mt-3 mb-2">
                        <div class="card" style="width: 650px; height: auto;">
                            <div class="card-body">
                                <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                                    <div class="d-flex justify-content-between mb-3">
                                        <figure class="image" style="border-radius: 0%; margin-left: 15px;"><img
                                                style="border-radius: 0%;"
                                                src="{{ asset('front/assets/img/icon_lowongan.png') }}"
                                                alt="admin.upload">
                                        </figure>
                                        <div style="margin-left: 290px;">
                                            <small class="text-muted" style="font-size: 15px;">Batas Melamar 13 Juli
                                                2023</small><br>
                                            <div class="row mt-2">
                                                <a href="javascript:void(0)"><button type="button"
                                                        class="btn btn-sm btn-outline-dark waves-effect"
                                                        style="width: 200px;">Buka dihalaman baru</button>
                                                </a><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-2">
                                        <p style="text-align: left !important; font-size:18px; margin-bottom: 0px;">PT
                                            Wings Surya</p>
                                        <h5 class="mb-1"
                                            style="text-align: left !important; font-size:25px; -webkit-line-clamp: ;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">
                                            Human Resources</h5>
                                    </div>
                                </div>
                                <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin"
                                        style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                                <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i
                                        class="ti ti-currency-dollar" style="margin-right: 10px"></i>IDR 4.300.000 -
                                    5.500.000</div>
                                <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"
                                        style="margin-right: 10px"></i>2 Semester</div>
                                <div class="row mt-4">
                                    <a href="javascript:void(0)"><button type="button" class="btn btn-success"
                                            style="width: 590px; margin-left: 5px;">Lamar Sekarang</button>
                                    </a>
                                </div>
                                <div class="row mt-3 mb-3">
                                    <div class="demo-inline-spacing">
                                        <a href="javascript:void(0)"><button type="button"
                                                class="btn btn-outline-danger">
                                                <span class="ti ti-heart"
                                                    style="margin-left: -5px; width: 35px;"></span>Simpan Lowongan</button>
                                        </a>
                                        <a href="javascript:void(0)"><button type="button"
                                                class="ms-2 btn btn-outline-secondary">
                                                <span class="ti ti-share"
                                                    style="margin-left: -5px; width: 30px;"></span>Bagikan</button>
                                        </a>
                                        <a href="javascript:void(0)"><button type="button"
                                                class="ms-2 btn btn-outline-secondary">
                                                <span class="ti ti-flag"
                                                    style="margin-left: -5px; width: 35px;"></span>Laporkan</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-2">
                                    <p style="text-align: left !important; font-size:25px; margin-bottom: 0px;">
                                        <b>Deskripsi Pekerjaan</b>
                                    </p>
                                    <div class="row mt-2 mb-2">
                                        <ul style="margin-left: 20px;">
                                            <div class="box">
                                                <li class="cursor-pointer content"
                                                    style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text ever
                                                    since the 1500s, when an unknown printer took a galley of type and
                                                </li>

                                                <li class="cursor-pointer content"
                                                    style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text ever
                                                    since the 1500s, when an unknown printer took a galley of type and
                                                </li>

                                                <li class="cursor-pointer content"
                                                    style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text ever
                                                    since the 1500s, when an unknown printer took a galley of type and
                                                </li>

                                                <div class="content-new">
                                                    <!-- This is hide by default and open on toggle -->
                                                    <li class="cursor-pointer content"
                                                        style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                        scrambled it to make a type specimen book. It has survived not only
                                                        five centuries, but also the leap into electronic typesetting,
                                                        remaining essentially unchanged. It was popularised in the 1960s
                                                        with the release of Letraset sheets containing Lorem Ipsum passages,
                                                        and more recently with desktop publishing software like Aldus
                                                        PageMaker including versions of Lorem Ipsum</li>

                                                    <li class="cursor-pointer content"
                                                        style="text-align: left !important; font-size:17px; margin-bottom: 0px;">
                                                        scrambled it to make a type specimen book. It has survived not only
                                                        five centuries, but also the leap into electronic typesetting,
                                                        remaining essentially unchanged. It was popularised in the 1960s
                                                        with the release of Letraset sheets containing Lorem Ipsum passages,
                                                        and more recently with desktop publishing software like Aldus
                                                        PageMaker including versions of Lorem Ipsum</li>
                                                </div>

                                                <div class="show_hide_new cursor-pointer" style="color:#4EA971">
                                                    Lebih banyak
                                                </div>
                                                <br>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row mt-2 mb-2">
                                    <p style="text-align: left !important; font-size:25px; margin-bottom: 0px;">
                                        <b>Kualifikasi Minimal</b>
                                    </p>
                                    <div class="row mt-2 mb-2">
                                        <ul style="margin-left: 20px;">
                                            <li class="cursor-pointer">Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                text ever since the 1500s, when an
                                                unknown printer took a galley of type and scrambled it to make a type
                                                specimen book.</li>
                                            <li class="cursor-pointer">Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                text ever since the 1500s, when an
                                                unknown printer took a galley of type and scrambled it to make a type
                                                specimen book.</li>
                                            <li class="cursor-pointer">Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                text ever since the 1500s, when an
                                                unknown printer took a galley of type and scrambled it to make a type
                                                specimen book.</li>
                                            <li class="cursor-pointer">Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                text ever since the 1500s, when an
                                                unknown printer took a galley of type and scrambled it to make a type
                                                specimen book.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row mt-2 mb-2">
                                    <p style="text-align: left !important; font-size:25px; margin-bottom: 0px;">
                                        <b>Kemampuan</b>
                                    </p>
                                    <div class="row mt-2 mb-2">
                                        <ul style="margin-left: 20px;">
                                            <li class="cursor-pointer">Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry.</li>
                                            <li class="cursor-pointer">Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry.</li>
                                            <li class="cursor-pointer">Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry.</li>
                                        </ul>
                                    </div>
                                </div>
                                <hr class="mt-2">
                                <div class="row mt-2 mb-2">
                                    <p style="text-align: left !important; font-size:20px; margin-bottom: 0px;">
                                        <b>Tentang Perusahaan</b>
                                    </p>
                                </div>
                                <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                                    <div class="col-3 text-left mt-3">
                                        <figure class="image" style="border-radius: 0%; margin-left: 15px;"><img
                                                style="border-radius: 0%;"
                                                src="http://127.0.0.1:8000/front/assets/img/icon_lowongan.png"
                                                alt="admin.upload">
                                        </figure>
                                    </div>
                                    <div class="col-6 mt-4">
                                        <p style="text-align: left !important; font-size:25px; margin-bottom: 0px;"><b>PT
                                                Wings Surya</b></p>
                                        <p style="text-align: left !important; font-size:13px; margin-bottom: 0px;">Fast
                                            Moving Consumer Goods</p>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-2">
                                    <div class="box">
                                        <p class="cursor-pointer content"
                                            style="text-align: left !important; font-size:17px; margin-bottom: 0px;">Lorem
                                            Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                            has been the industry's standard dummy text ever since the 1500s, when an
                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                            book. It has survived not only five centuries, but also the leap into electronic
                                            typesetting, remaining essentially unchanged.
                                        </p>

                                        <div class="content-new">
                                            <!-- This is hide by default and open on toggle -->
                                            <p> It was popularised in the 1960s with the release of Letraset sheets
                                                containing Lorem Ipsum passages, and more recently with desktop publishing
                                                software like Aldus PageMaker including versions of Lorem Ipsum</p>
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
@endsection

@section('page_script')
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
    </script>
@endsection
