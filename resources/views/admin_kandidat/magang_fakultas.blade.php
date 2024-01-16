@extends('partials_admin.template')

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <style>
    .tooltip-inner {
        max-width: 210px;
        /* If max-width does not work, try using width instead */
        width: 900px; 
    }
    </style>
@endsection

@section('main')
<div class="row">
    <div class="col-md-9 col-12"><nav aria-label="breadcrumb">
    <div class="row ">
    <div class="">
        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs">Data Kandidat / </span>
            Total Kandidat Tahun Ajaran 2023/2024
        </h4>
    </div>
    </div>
</div>
<div class="col-md-3 col-12 mb-3 ps-5 d-flex align-items-center justify-content-between">
    <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
        <option value="1">2023/2024 Genap</option>
        <option value="2">2023/2024 Ganjil</option>
        <option value="3">2022/2023 Genap</option>
        <option value="4">2022/2023 Ganjil</option>
        <option value="5">2021/2022 Genap</option>
        <option value="6">2021/2022 Ganjil</option>
    </select>
    <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide"><i class="tf-icons ti ti-filter"></i>
    </button>
    </div>
    <div class="col-xl-12">
        <div class="nav-align-top">
            <div class="row mb-4">
                <div class="col-md-8 col-12 ">
                <div class="text-secondary mt-4">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1'
                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Prodi:D3 Sistem Informasi" id="tooltip-filter"></i></div>
                </div>
                {{-- <div class="col-1"></div> --}}
               </div>
               <div class="tab-content mt-4">
                <div class="tab-pane fade show active" id="navs-pills-justified-users" role="tabpanel">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-kelola-mitra1">
                            <thead>
                                <tr>
                                    <th>nomor</th>
                                    <th style="min-width: 125px;">nama/nim</th>
                                    <th>PROGRAM STUDI</th>
                                    <th>POSISI MAGANG</th>
                                    <th>DURASI MAGANG</th>
                                    <th>NAMA<br>PERUSAHAAN</th>
                                    <th>PEMBIMBING<br>LAPANGAN</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>              
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="modalSlide" aria-labelledby="offcanvasAddUserLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Filter Berdasarkan</h5>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
            <form class="add-new-user pt-0" id="filter">
                <div class="col-12 mb-2">
                    <div class="row">
                        <div class="mb-2">
                            <label for="nama/nim" class="form-label">Program Studi</label>
                            <select class="form-select select2" id="prodi" name="prodi"
                                data-placeholder="Pilih Program Studi">
                                <option value="">Pilih Program Studi</option>
                            </select>
                        </div>                                                                  
                    </div>
                </div>
                <div class="mt-3 text-end">
                    <button type="reset" class="btn btn-label-danger data-reset">Reset</button>
                    <button type="submit" class="btn btn-success">Terapkan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- <div class="modal fade" id="modalTambahMitra" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center d-block">
                    <h5 class="modal-title" id="modalTambahMitra">Tambah Mitra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-2">
                            <label for="nama" class="form-label">Nama Perusahaan</label>
                            <input type="text" id="nama" class="form-control" placeholder="Nama Perusahaan" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" class="form-control" placeholder="Email" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="../../app-assets/js/forms-extras.js"></script>
    <script>
        var jsonData = [{
                "nomor": "1",
                "nama/nim": "Jennie Ruby Jane <br> 6701250405",
                "program_studi": "D3 Sistem Informasi",
                "posisi_magang": "UI/UX Designer",
                "durasi_magang": "2 Semester",
                "nama_perusahaan": "Techno Infinity",
                "pembimbing_lapangan": "Mark Lee",
            },
            {
                "nomor": "2",
                "nama/nim": "Jennie Ruby Jane <br> 6701250405",
                "program_studi": "D3 Sistem Informasi",
                "posisi_magang": "UI/UX Designer",
                "durasi_magang": "2 Semester",
                "nama_perusahaan": "Techno Infinty",
                "pembimbing_lapangan": "Mark Lee",
            },
            {
                "nomor": "3",
                "nama/nim": "Jennie Ruby Jane <br> 6701250405",
                "program_studi": "D3 Sistem Informasi",
                "posisi_magang": "UI/UX Designer",
                "durasi_magang": "2 Semester",
                "nama_perusahaan": "Techno Infinity",
                "pembimbing_lapangan": "Mark Lee",
            }
        ];

        var table = $('#table-kelola-mitra1').DataTable({
            "data": jsonData,
            columns: [{
                    data: "nomor"
                },
                {
                    data: "nama/nim"
                },
                {
                    data: "program_studi"
                },

                {
                    data: "posisi_magang"
                },
                {
                    data: "durasi_magang"
                },
                {
                    data: "nama_perusahaan"
                },
                {
                    data: "pembimbing_lapangan"
                }
            ]
        });

        jQuery(function() {
        jQuery('.showSingle').click(function() {
            jQuery('.targetDiv').hide('.cnt');
            jQuery('#div' + $(this).attr('target')).slideToggle();
        });
    });
    </script>

    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection
