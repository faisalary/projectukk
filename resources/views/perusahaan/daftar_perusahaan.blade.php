@extends('partials_mahasiswa.template')

@section('page_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .hidden {
        display: none;
    }

    .page-item.active .page-link,
    .pagination li.active>a:not(.page-link) {
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
        width: 530px;
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

    input[type="checkbox"]:focus {
        outline: 0px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }

    .form-check-input:checked,
    .form-check-input[type=checkbox]:indeterminate {
        background-color: #4EA971 !important;
        border-color: #4EA971 !important;
    }

    .light-style .flatpickr-input[readonly],
    .light-style .flatpickr-input~.form-control[readonly] {
        background: #F8F8F8
    }

    .select2-results__option[role="option"][aria-selected="true"] {
        background-color: #4EA971;
        color: #fff;
    }

    .select2-container--default .select2-results__option--highlighted:not([aria-selected="true"]) {
        background-color: rgba(115, 103, 240, 0.08) !important;
        color: #4EA971 !important;
    }

    .light-style .select2-container--default .select2-selection--single {
        height: 48px !important;
    }

    .light-style .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 2.67rem !important;
    }

    span.select2-dropdown.select2-dropdown--below {
        width: 530px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        position: absolute;
        height: 18px;
        width: 20px;
        top: 36% !important;
        background-repeat: no-repeat;
        background-size: 20px 18px;
        margin-left: 307px !important;
    }

    .input-group:not(.has-validation)> :not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating),
    .input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3),
    .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-control,
    .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-select {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-top: 0;
        border-bottom: 0;
        border-right: 0;
        border-left: 0;
    }

    span.select2-selection.select2-selection--single {
        border-top: 10px !important;
        border-bottom: 10px !important;
        border-right: 10px !important;
    }

    .light-style .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 3.2rem !important;
    }

    .page-item > .page-link.active {
    border-color: #4EA971 !important;
    background-color: #4EA971 !important;
    color: #fff;
}
</style>
@endsection

@section('main')

<div class="auto-container" style="background-color: #F8F8F8;background-repeat: no-repeat; background-size: cover; background-image: url({{asset('assets/images/background.png')}});">
    <div class="row mt-5 mb-5" style="margin-left:70px;">
        <div class="col-5 mt-3">
            <div class="input-group input-group-merge border">
                <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                <input type="text" class="form-control" placeholder="Lowongan Magang" aria-label="Lowongan Magang" aria-describedby="basic-addon-search31" style="height: 37px;">
            </div>
        </div>
        <div class="col-5 mt-3">
            <div class="input-group input-group-merge border">
                <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-map-pin"></i></span>
                <select class="select2 form-control" data-placeholder="Pilih lokasi Magang" aria-describedby="basic-addon-search31">
                    <option disabled selected> Lokasi Magang </option>
                    <option> Bandung </option>
                    <option> Jakarta </option>
                    <option> Medan </option>
                    <option> Surabaya </option>
                    <option> Yogyakarta </option>
                </select>
            </div>
        </div>
        <div class="col-2 mt-3">
            <button class="btn btn-success" type="button" style="height: 50px;">Cari sekarang
                <!-- <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading... -->
            </button>
        </div>
    </div>
</div>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="ms-2 mt-2 mb-4">Daftar Mitra</h4>
    <div class="row">
        <div class="col-4 pt-0">
            <a href="/detail_perusahaan" style="color: #0C1019;">
                <div class="card border">
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
        <div class="col-4 pt-0">
            <div class="card border">
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
        <div class="col-4 pt-0">
            <div class="card border">
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
    <div class="row">
        <div class="col-4 mt-5">
            <a href="/detail_perusahaan" style="color: #0C1019;">
                <div class="card border">
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
            <div class="card border">
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
            <div class="card border">
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
    <div class="row">
        <div class="col-4 mt-5">
            <a href="/detail_perusahaan" style="color: #0C1019;">
                <div class="card border">
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
            <div class="card border">
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
            <div class="card border">
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
        <ul class="pagination justify-content-end mb-5 mt-3">
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
</div>


@endsection

@section('page_script')

@endsection