@extends('partials_admin.template')

{{-- @section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection --}}

@section('page_style')
<link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
<style>
    .tooltip-inner {
        min-width: 100%;
        max-width: 100%;
    }

    .position-relative {
        padding-right: 15px;
        padding-left: 15px;
    }

    h6,
    .h6 {
        font-size: 0.9375rem;
        margin-bottom: 0px;
    }

    #more {
        display: none;
    }
</style>

@endsection

@section('main')
<div class="row">
    <div class="col-md-9 col-12">
        <h4 class="fw-bold">Kelola Lowongan-Tahun Ajaran 2324</h4>
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
    </div>

    <div class="col-xl-12">
        <div class="nav-align-top">
            <ul class="nav nav-pills mb-3 " role="tablist">
                <li class="nav-item" style="font-size: small;">
                    <button type="button" class="nav-link active showSingle" target="1" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-dibuat" aria-controls="navs-pills-justified-dibuat" aria-selected="true" style="padding: 8px 9px;">
                        <i class="tf-icons ti ti-briefcase ti-xs me-1"></i> Dibuat
                        <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;">3</span>
                    </button>
                </li>
                <li class="nav-item" style="font-size: small;">
                    <button type="button" class="nav-link showSingle" target="2" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tertunda" aria-controls="navs-pills-justified-tertunda" aria-selected="false" style="padding: 8px 9px;">
                        <i class="tf-icons ti ti-clock ti-xs me-1"></i> Tertunda
                        <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;">2</span>
                    </button>
                </li>
                <li class="nav-item" style="font-size: small;">
                    <button type="button" class="nav-link showSingle" target="3" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-disetujui" aria-controls="navs-pills-justified-disetujui" aria-selected="false" style="padding: 8px 9px;">
                        <i class="tf-icons ti ti-clipboard-check ti-xs me-1"></i> Disetujui
                        <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;">1</span>
                    </button>
                </li>
                <li class="nav-item" style="font-size: small;">
                    <button type="button" class="nav-link showSingle" target="4" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-ditolak" aria-controls="navs-pills-justified-ditolak" aria-selected="false" style="padding: 8px 9px;">
                        <i class="tf-icons ti ti-clipboard-x ti-xs me-1"></i> Ditolak
                        <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;">1</span>
                    </button>
                </li>
            </ul>
        </div>

   <div class="row mb-4">
        <div class="col-md-8 col-12 ">
        <div class="text-secondary mt-4">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Posisi Pekerjaan : -, Durasi Magang : -, Fakultas : -, Universitas : -" id="tooltip-filter"></i></div>
        </div>
    @foreach(['2','3','4'] as $statusId)
    @if($statusId == 2)
    @can("can.view.data.table")
    <div id="div{{$statusId}}" class="col-1 targetDiv" style="display: none;">
    @endcan
    @endif
    @endforeach
        <div class="col-md-4 d-flex justify-content-end align-items-center">
            <a href=' {{ route('lowongan-magang.create') }}'>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalTambahLowongan">+ Tambah Lowongan
                    Magang</button>
            </a>
        </div>
    </div>
   </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="modalSlide" aria-labelledby="offcanvasAddUserLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddUserLabel" class="offcanvas-title" style="padding-left: 15px;">Filter Berdasarkan</h5>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
            <form class="add-new-user pt-0" id="filter">
                <div class="col-12 mb-2">
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="posisi" class="form-label" style="padding-left: 15px;">Posisi</label>
                            <select class="form-select select2" id="posisi" name="posisi" data-placeholder="Pilih posisi pekerjaan">
                                <option disabled selected>Pilih Posisi Pekerjaan</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-2">
                            <label for="durasimagang" class="form-label" style="padding-left: 15px;">Durasi Magang</label>
                            <select class="form-select select2" id="durasimagang" name="durasimagang" data-placeholder="Pilih Durasi Magang">
                                <option disabled selected>Pilih Durasi Magang</option>
                                <option value="1 Semester">1 Semester</option>
                                <option value="2 Semester">2 Semester</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="fakultas" class="form-label" style="padding-left: 15px;">Fakultas</label>
                             <select class="form-select select2" id="fakultas" name="fakultas" data-placeholder="Pilih Fakultas">
                                <option disabled selected>Pilih Fakultas</option>
                                @foreach($fakultas as $f)
                                <option value="{{ $f->id_fakultas }}">{{ $f->fakultas }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row cnt">
                        <div id="div1" class="targetDiv">
                            <div class="col mb-2 form-input">
                                <label for="prodi" class="form-label" style="padding-left: 15px;">Program Studi</label>
                                <select class="form-select select2" id="prodi" name="prodi" data-placeholder="Pilih Program Studi">
                                    <option disabled selected>Pilih Program Studi</option>
                                    <option value="D3 Rekayasa Perangkat Lunak Aplikasi">D3 Rekayasa Perangkat Lunak Aplikasi</option>
                                    <option value="D3 Sistem Informasi">D3 Sistem Informasi</option>
                                    <option value="D3 Teknologi Komputer">D3 Teknologi Komputer</option>
                                    <option value="D3 Teknologi Rekayasa Media">D3 Teknologi Rekayasa Media</option>
                                </select>
                                <select class="form-select select2" id="prodi" name="prodi" data-placeholder="Pilih Program Studi">
                                    <option disabled selected>Pilih Program Studi</option>
                                    @foreach($prodi as $p)
                                    <option value="{{ $f->id_prodi }}">{{ $p->prodi }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 text-end">
                        <button type="button" class="btn btn-label-danger">Reset</button>
                        <button type="submit" class="btn btn-success">Terapkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="tab-content p-0">
        @foreach(['dibuat','tertunda','disetujui','ditolak'] as $tableId)
        <div class="tab-pane fade show {{$loop->iteration == 1 ? 'active' : ''}}" id="navs-pills-justified-{{$tableId}}" role="tabpanel">
            <div class="card">
                <div class="row mt-3 ms-2">
                    <div class="col-6 d-flex align-items-center" style="border: 2px solid #D3D6DB; max-width:280px; height:40px;border-radius:8px;">
                        <span class="badge badge-center bg-label-success mr-10"><i class="ti ti-briefcase"></i></span>Total Lowongan:</span>&nbsp;<span style="color:#7367F0;">50</span>&nbsp;<span style="color:#4EA971;"> Lowongan </span>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="table tab1c" id="{{$tableId}}" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="min-width: auto;">NOMOR</th>
                                <th style="min-width:100px;">POSISI</th>
                                <th style="min-width:100px;">FAKULTAS </th>
                                <th style="min-width:150px;">PROGRAM STUDI</th>
                                <th style="min-width:150px;">TANGGAL</th>
                                <th style="min-width:150px;">DURASI MAGANG</th>
                                <th style="min-width:100px;">STATUS</th>
                                <th style="min-width:100px;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        @endforeach

    <!-- Modal Alert-->
    <div class="modal fade" id="modalalert" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="../../app-assets/img/alert.png" alt="">
                <h5 class="modal-title" id="modal-title">Apakah Anda Yakin Ingin Mengahapus Data?</h5>
                <div class="swal2-html-container" id="swal2-html-container" style="display: block;">Data yang dipilih akan dihapus secara permanen!</div>
                </div>
                    <div class="modal-footer" style="display: flex; justify-content:center;">
                        <button type="submit" id="modal-button" class="btn btn-success">Ya, yakin</button>
                        <button type="submit" id="modal-button" class="btn btn-danger">Batal</button>
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
<script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
<script src="../../app-assets/js/forms-extras.js"></script>
<script>
    // var jsonData = [{
    //         "nomor": "1",
    //         "posisi": "UI/UX Designer",
    //         "fakultas": "fakultas ilmu terapan",
    //         "program studi": "D3 Rekayasa Perangkat Lunak <br> D3 Sistem Informasi <br> D3 Sistem Informatika",
    //         "tanggal": "<div class='flex'><small class='text-light fw-semibold'>Publish</small><h6>20 juli 2023</h6><small class='text-light fw-semibold '>Takedown</small><h6>11 juli 2024</h6></div>",
    //         "durasi magang": "2 semester",
    //         "status": "<span class='badge bg-label-danger'>Non-aktif</span>",
    //         "aksi": "<div class='d-flex'><a href='/edit-lowongan-magang'class='btn-icon text-warning waves-effect waves-light'>@can('only.lkm')<i class='ti ti-edit'>@endcan</i></a><a href='/detail-lowongan-magang' class='btn-icon text-success waves-effect waves-light'><i class='ti ti-file-invoice'></i></a> <a data-bs-toggle='modal' data-bs-target='#modalalert' class='btn-icon text-danger waves-effect waves-light'><i class='ti ti-trash'></i></a>",
    //     },
    //     {
    //         "nomor": "2",
    //         "posisi": "UI/UX Designer",
    //         "fakultas": "fakultas ilmu terapan",
    //         "program studi": "D3 Rekayasa Perangkat Lunak <br> D3 Sistem Informasi <br> D3 Sistem Informatika",
    //         "tanggal": "<div class='flex'><small class='text-light fw-semibold'>Publish</small><h6>20 juli 2023</h6><small class='text-light fw-semibold '>Takedown</small><h6>11 juli 2024</h6></div>",
    //         "durasi magang": "2 semester",
    //         "status": "<span class='badge bg-label-success'>Aktif</span>",
    //         "aksi": "<div class='d-flex'><a href='/edit-lowongan-magang'class='btn-icon text-warning waves-effect waves-light'>@can('only.lkm')<i class='ti ti-edit'>@endcan</i></a><a href='/detail-lowongan-magang' class='btn-icon text-success waves-effect waves-light'><i class='ti ti-file-invoice'></i></a> <a data-bs-toggle='modal' data-bs-target='#modalalert' class='btn-icon text-danger waves-effect waves-light'><i class='ti ti-trash'></i></a>",
    //     }
    // ];

    $('.table').each(function() {
            let idElement = $(this).attr('id');
            let url = "{{ url('kelola/lowongan/show') }}?type=" + idElement;
            console.log(idElement);
            console.log(url);

            $(this).DataTable({
                ajax: url,
                serverSide: false,
                processing: true,
                deferRender: true,
                type: 'GET',
                destroy: true,
                columns: [{
                        data: "DT_RowIndex"
                    },
                    {
                        data: "posisi"
                        name: "posisi"
                    },
                    {
                        data: "fakultas"
                        name: "fakultas"
                    },
                    {
                        data: "prodi"
                        name: "prodi"
                    },
                    {
                        data: "tanggal"
                        name: "tanggal"
                    },
                    {
                        data: "durasimagang"
                        name: "durasimagang"
                    },
                    {
                        data: "status"
                        name: "status"
                    },
                    {
                        data: "action"
                        name: "action"
                    }
                ],
            });

        });

        jQuery(function() {
            jQuery('.showSingle').click(function() {
                let idElement = $(this).attr('target');

                jQuery('.targetDiv').hide('.cnt');
                jQuery("#div" + idElement).slideToggle();

                console.log(idElement);
            });
        });

        $('.display').DataTable({
            responsive: true
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
        });

    $("#modalTambahLowongan").on("hide.bs.modal", function() {

    $("#modal-title").html("Tambah Lowongan Magang");
    $("#modal-button").html("Save Data");
    $('#modalTambahLowongan form #mitra').val('').trigger('change');
    $('#modalTambahLowongan form #tahun').val('').trigger('change');
    $('#modalTambahLowongan form #jenismagang').val('').trigger('change');
    $('#modalTambahLowongan form #fakultas').val('').trigger('change');
    $('#modalTambahLowongan form #prodi').val('').trigger('change');
    // $('#modalTambahLowongan form #pendaftar').val('').trigger('change');
    });

    function edit(e) {
    let id = e.attr('data-id');

    let action = `{{ url('kelola/lowongan/update/') }}/${id}`;
    var url = `{{ url('kelola/lowongan/edit/') }}/${id}`;
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $("#modal-title").html("Edit LowonganMangang");
                $("#modal-button").html("Update Data")
                $('#modalTambahLowongan form').attr('action', action);
                $('#mitra').val(response.id_industri).change();
                $('#tahun').val(response.id_year_Akademik).change();
                $('#jenis').val(response.id_jenismagang).change();
                $('#posisi').val(response.intern_position);
                $('#kuota').val(response.kuota);
                $('#bidang').val(response.bidang);
                $('#deskripsi').val(response.deskripsi);
                $('#kualifikasi').val(response.requirements);
                $('#prodi').val(response.id_prodi).change();
                $('#fakultas').val(response.id_fakultas).change();
                $('#gaji').val(response.paid);
                $('#benefit').val(response.benefitmagang);
                $('#lokasi').val(response.id_lokasi);
                $('#tanggalmulai').val(response.startdate);
                $('#tanggalakhir').val(response.enddate);
                $('#durasimagang').val(response.durasimagang);
                $('#tahapan').val(response.tahapan_seleksi);
                $('#created_by').val(response.created_by());
                // $('#created_at').val(response.created_at());
                $('#tanggalkonfirmasi').val(response.date_confirm_closing);
                // $('#pendaftar').val(response.applicant_status).change();


                $('#modalTambahLowongan').modal('show');
            }
        });
    }

        $( document ).ready(function() {
            });

            $(document).on('submit','#filter',function(e){
            const offcanvasFilter = $('#modalSlide');
            e.preventDefault();
            $('#tooltip-filter').attr('data-bs-original-title', 'Universitas: ' + $('#univ :selected').text() + ', Fakultas: ' + $('#fakultas :selected').text() + ', durasimagang: ' + $('#durasimagang :selected').text() + ', posisipekerjaan: ' + $('#posisipekerjaan :selected').text());
            offcanvasFilter.offcanvas('hide');
            });

            $('.data-reset').on('click',function () {
            $('#univ').val(null).trigger('change');
            $('#fakultas').val(null).trigger('change');
            $('#durasimagang').val(null).trigger('change');
            $('#posisipekerjaan').val(null).trigger('change');
            });

</script>

<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>

@endsection
