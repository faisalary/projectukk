@extends('partials_admin.template')

@section('page_style')
<link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<style>
    .swal2-icon {
        border-color: transparent !important;
    }

    .swal2-title {
        font-size: 20px !important;
        text-align: center !important;
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }

    .swal2-modal.swal2-popup .swal2-title {
        max-width: 100% !important;
    }

    .swal2-html-container {
        font-size: 16px !important;
    }
</style>
@endsection

@section('main')
<div class="row">

    <div class="col-md-9 col-12">
        <!-- Company -->
        @can('title.info.lowongan.mitra')
        <h4 class="fw-bold"><span class="text-muted fw-light">Lowongan Magang / </span>Informasi Lowongan - {{$industri->namaindustri}}</h4>
        @endcan
        <!-- SuperAdmin -->
        @can('title.info.lowongan.admin')
        <h4 class="fw-bold">Lowongan Magang {{$industri->namaindustri}}</h4>
        <h4 class="fw-bold">Tahun Ajaran</h4>
        @endcan

    </div>
    <div class="col-md-3 col-12 mb-3 float-end d-flex justify-content-end">
        <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran" style="width: 95% !important;">
            <option value="1">2023/2024 Genap</option>
            <option value="2">2023/2024 Ganjil</option>
            <option value="3">2022/2023 Genap</option>
            <option value="4">2022/2023 Ganjil</option>
            <option value="5">2021/2022 Genap</option>
            <option value="6">2021/2022 Ganjil</option>
        </select>
    </div>
</div>

<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4" style="border: 2px solid #D3D6DB; width:300px; height:35px; margin:0 13px; border-radius:8px;">
                        <div class="ti ti-users text-primary" style="margin-top: 5px;"> <span style="color:#4B465C;">Total Pelamar : </span><span style="color:#4EA971;">{{$pendaftar}}</span> <span style="color:#4EA971;">Kandidat</span></div>
                    </div>
                    <div class="col-3" style="border: 2px solid #D3D6DB; width:310px; height:35px; border-radius:8px;">
                        <div class="ti ti-briefcase text-primary" style="margin-top: 5px;"> <span style="color:#4B465C;">Total Lowongan :</span> <span style="color:#4EA971;">{{$lowongan_count}}</span> <span style="color:#4EA971;">Lowongan</span></div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-6">
                        <div class="d-flex align-items-center justify-content-start">
                            <span>Show</span>
                            <select class="form-select mx-2" style="width: 14%;">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span>entries</span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="d-flex align-items-center justify-content-end">
                            <span>Search:</span>
                            <input type="search" class="form-control ms-2" placeholder="Search" style="width: 50%;">
                        </div>
                    </div>
                </div>

                <!-- card-informasi-lowongan -->
                <div id="container-card" class="mb-3"></div>

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end" style="margin-right:25px;">
                        <li class="page-item first">
                            <a class="page-link" href="javascript:void(0);">Previous</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="javascript:void(0);">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0);">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0);">3</a>
                        </li>
                        <li class="page-item last">
                            <a class="page-link" href="javascript:void(0);">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    @endsection

    @section('page_script')

    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                format: 'yyyy-mm-dd'
            });

            loadData();
        });

        function loadData() {
            $.ajax({
                url: "{{$urlGetCard}}?component=card",
                type: "get",
                success: function(res) {
                    $("#container-card").html(res);
                }
            })
        }
    </script>
    @endsection