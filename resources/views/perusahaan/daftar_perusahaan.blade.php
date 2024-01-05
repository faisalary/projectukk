@extends('partials_mahasiswa.template')

@section('page_style')
<style>
    .hidden {
        display: none;
    }

    .page-item>.page-link.active {
        border-color: #4EA971 !important;
        background-color: #4EA971 !important;
        color: #fff;
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

    .light-style .select2-container--default .select2-selection--single {
        width: 520px;
    }

    .light-style .select2-container--default .select2-selection {
        border-left: 0px;
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }

    .layout-wrapper,
    .layout-container {
        width: 100%;
        display: flex;
        flex: 1 1 auto;
        align-items: stretch;
        background-color: #fff;
    }
</style>
@endsection

@section('main')

<div class="auto-container" style="background-color:#F8F8F8;background-repeat: no-repeat;
    background-size: cover; background-image: url({{asset('assets/images/background.png')}});">
    <h2 style="margin-left:100px; margin-top:30px;">Mitra Perusahaan</h2>
    <form class="form-inline" style="margin-left:100px; margin-top:20px; margin-bottom:40px;">
        <div class="row">
            <div class="col-5">
                <div class="input-group input-group-merge">
                    <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
                </div>
            </div>
            <div class="col-5">
                <div class="input-group">
                    <span class="input-group-text"><i class="ti ti-map-pin"></i></span>
                    <select id="lokasi" class="form-select select2">
                        <option selected disabled>Lowongan Magang</option>
                        <option value="1">Bandung</option>
                        <option value="2">Jakarta</option>
                        <option value="3">Medan</option>
                        <option value="4">Surabaya</option>
                    </select>
                </div>

            </div>
            <div class="col-2">
                <button class="btn btn-success" type="submit">Cari Sekarang</button>
            </div>
        </div>
    </form>
</div>
<div class="row mx-5">
    <div class="col-4 mt-5">
        <a href="/detail_perusahaan" style="color: #0C1019;">
            <div class="card">
                <div class="card-body" style="text-align: left; border-radius: 4px; flex-shrink: 0;">
                    <div>
                        <div class="row">
                            <div class="col-4">
                                <figure class="image" style="border-radius: 0%; margin-left:0px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload"></figure>
                            </div>
                            <div class="col-8">
                                <h4 style="margin-top: 10px;">PT Wings Surya</h4>
                            </div>
                        </div>
                        <div class="mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i> PT Fast Retailing Indonesia South Quarter Tower C, <br>17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.</div>
                        <div class="mb-3"><i class="ti ti-building" style="padding-right :5px; padding-bottom:5px;"></i>Food
                        </div>
                        <div class="mb-3"><i class="ti ti-briefcase" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>10 lowongan</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-4 mt-5">
        <div class="card">
            <div class="card-body" style="text-align: left; border-radius: 4px;   flex-shrink: 0;">
                <div>
                    <div class="row">
                        <div class="col-4">
                            <figure class="image" style="border-radius: 0%; margin-left:0px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/lowongan_uniqlo.png')}}" alt="admin.upload"></figure>
                        </div>
                        <div class="col-8">
                            <h4 style="margin-top: 10px;">Uniqlo Co., Ltd</h4>
                        </div>
                    </div>
                    <div class="mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i> PT Fast Retailing Indonesia South Quarter Tower C, <br>17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.</div>
                    <div class="mb-3"><i class="ti ti-building" style="padding-right :5px; padding-bottom:5px;"></i>Food
                    </div>
                    <div class="mb-3"><i class="ti ti-briefcase" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>10 lowongan</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4 mt-5">
        <div class="card">
            <div class="card-body" style="text-align: left; border-radius: 4px;   flex-shrink: 0;">
                <div>
                    <div class="row">
                        <div class="col-6">
                            <figure class="image" style="border-radius: 0%; margin-left:0px; height:55px;">
                                <img style="border-radius: 0%;" src="{{ asset('front/assets/img/lazada.png')}}" alt="admin.upload">
                            </figure>
                        </div>
                        <div class="col-6">
                            <h4>Lazada Group</h4>
                        </div>
                    </div>
                    <div class="mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i> PT Fast Retailing Indonesia South Quarter Tower C, <br>17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.</div>
                    <div class="mb-3"><i class="ti ti-building" style="padding-right :5px; padding-bottom:5px;"></i>Food
                    </div>
                    <div class="mb-3"><i class="ti ti-briefcase" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>10 lowongan</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4 mt-5">
        <a href="/detail_perusahaan" style="color: #0C1019;">
            <div class="card">
                <div class="card-body" style="text-align: left; border-radius: 4px; flex-shrink: 0;">
                    <div>
                        <div class="row">
                            <div class="col-4">
                                <figure class="image" style="border-radius: 0%; margin-left:0px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload"></figure>
                            </div>
                            <div class="col-8">
                                <h4 style="margin-top: 10px;">PT Wings Surya</h4>
                            </div>
                        </div>
                        <div class="mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i> PT Fast Retailing Indonesia South Quarter Tower C, <br>17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.</div>
                        <div class="mb-3"><i class="ti ti-building" style="padding-right :5px; padding-bottom:5px;"></i>Food
                        </div>
                        <div class="mb-3"><i class="ti ti-briefcase" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>10 lowongan</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-4 mt-5">
        <div class="card">
            <div class="card-body" style="text-align: left; border-radius: 4px;   flex-shrink: 0;">
                <div>
                    <div class="row">
                        <div class="col-4">
                            <figure class="image" style="border-radius: 0%; margin-left:0px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/lowongan_uniqlo.png')}}" alt="admin.upload"></figure>
                        </div>
                        <div class="col-8">
                            <h4 style="margin-top: 10px;">Uniqlo Co., Ltd</h4>
                        </div>
                    </div>
                    <div class="mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i> PT Fast Retailing Indonesia South Quarter Tower C, <br>17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.</div>
                    <div class="mb-3"><i class="ti ti-building" style="padding-right :5px; padding-bottom:5px;"></i>Food
                    </div>
                    <div class="mb-3"><i class="ti ti-briefcase" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>10 lowongan</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4 mt-5">
        <div class="card">
            <div class="card-body" style="text-align: left; border-radius: 4px;   flex-shrink: 0;">
                <div>
                    <div class="row">
                        <div class="col-6">
                            <figure class="image" style="border-radius: 0%; margin-left:0px; height:55px;">
                                <img style="border-radius: 0%;" src="{{ asset('front/assets/img/lazada.png')}}" alt="admin.upload">
                            </figure>
                        </div>
                        <div class="col-6">
                            <h4>Lazada Group</h4>
                        </div>
                    </div>
                    <div class="mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i> PT Fast Retailing Indonesia South Quarter Tower C, <br>17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.</div>
                    <div class="mb-3"><i class="ti ti-building" style="padding-right :5px; padding-bottom:5px;"></i>Food
                    </div>
                    <div class="mb-3"><i class="ti ti-briefcase" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>10 lowongan</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4 mt-5">
        <a href="/detail_perusahaan" style="color: #0C1019;">
            <div class="card">
                <div class="card-body" style="text-align: left; border-radius: 4px; flex-shrink: 0;">
                    <div>
                        <div class="row">
                            <div class="col-4">
                                <figure class="image" style="border-radius: 0%; margin-left:0px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload"></figure>
                            </div>
                            <div class="col-8">
                                <h4 style="margin-top: 10px;">PT Wings Surya</h4>
                            </div>
                        </div>
                        <div class="mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i> PT Fast Retailing Indonesia South Quarter Tower C, <br>17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.</div>
                        <div class="mb-3"><i class="ti ti-building" style="padding-right :5px; padding-bottom:5px;"></i>Food
                        </div>
                        <div class="mb-3"><i class="ti ti-briefcase" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>10 lowongan</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-4 mt-5">
        <div class="card">
            <div class="card-body" style="text-align: left; border-radius: 4px;   flex-shrink: 0;">
                <div>
                    <div class="row">
                        <div class="col-4">
                            <figure class="image" style="border-radius: 0%; margin-left:0px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/lowongan_uniqlo.png')}}" alt="admin.upload"></figure>
                        </div>
                        <div class="col-8">
                            <h4 style="margin-top: 10px;">Uniqlo Co., Ltd</h4>
                        </div>
                    </div>
                    <div class="mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i> PT Fast Retailing Indonesia South Quarter Tower C, <br>17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.</div>
                    <div class="mb-3"><i class="ti ti-building" style="padding-right :5px; padding-bottom:5px;"></i>Food
                    </div>
                    <div class="mb-3"><i class="ti ti-briefcase" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>10 lowongan</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4 mt-5">
        <div class="card">
            <div class="card-body" style="text-align: left; border-radius: 4px;   flex-shrink: 0;">
                <div>
                    <div class="row">
                        <div class="col-6">
                            <figure class="image" style="border-radius: 0%; margin-left:0px; height:55px;">
                                <img style="border-radius: 0%;" src="{{ asset('front/assets/img/lazada.png')}}" alt="admin.upload">
                            </figure>
                        </div>
                        <div class="col-6">
                            <h4>Lazada Group</h4>
                        </div>
                    </div>
                    <div class="mb-3"><i class="ti ti-map-pin" style="padding-right :5px; padding-bottom:5px;"></i> PT Fast Retailing Indonesia South Quarter Tower C, <br>17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.</div>
                    <div class="mb-3"><i class="ti ti-building" style="padding-right :5px; padding-bottom:5px;"></i>Food
                    </div>
                    <div class="mb-3"><i class="ti ti-briefcase" style="padding-right :5px; padding-bottom:5px;" style="padding-right :5px; padding-bottom:5px;"></i>10 lowongan</div>
                </div>
            </div>
        </div>
    </div>
</div>
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-end mb-5 mt-3 me-5">
        <li class="page-item ">
            <a class="page-link waves-effect" href="javascript:void(0);">Previous</a>
        </li>
        <li class="page-item">
            <a class="page-link waves-effect active" href="javascript:void(0);">1</a>
        </li>
        <li class="page-item">
            <a class="page-link waves-effect" href="javascript:void(0);">2</a>
        </li>
        <li class="page-item">
            <a class="page-link waves-effect" href="javascript:void(0);">3</a>
        </li>
        <li class="page-item ">
            <a class="page-link waves-effect" href="javascript:void(0);">Next</a>
        </li>

    </ul>
</nav>


@endsection

@section('page_script')

@endsection