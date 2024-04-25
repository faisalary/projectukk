@extends('partials_mahasiswa.template')
@section('meta_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
<!-- Vendors CSS -->

<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/pickr/pickr-themes.css') }}" />
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/tagify/tagify.css') }}" />
<style>
    .nav~.tab-content {
        background: none !important;
    }

    .nav-pills .nav-link.active,
    .nav-pills .nav-link.active:hover,
    .nav-pills .nav-link.active:focus {
        background-color: #4EA971 !important;
        color: #fff;
    }

    .nav-pills .nav-link:not(.active):hover,
    .nav-pills .nav-link:not(.active):focus {
        color: #4EA971 !important;
    }

    .btn-success {
        color: #fff;
        background-color: #4EA971 !important;
        border-color: #4EA971 !important;
    }

    span.select2-selection.select2-selection--single {
        width: 200px;
    }
</style>
@endsection

@section('main')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-md-12 col-12 mt-3">
        <h4 class="fw-bold"><span class="text-muted fw-light">Kegiatan Saya /</span> Status Lamaran Magang</h4>
    </div>

    <div class="row ps-3">
        <ul class="nav nav-pills mb-3 " role="tablist">
            <li class="nav-item" style="font-size: 15px;">
                <button type="button" id="fakultas" target="1" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-magang-fakultas" aria-controls="navs-pills-justified-magang-fakultas" aria-selected="false">
                    Magang Fakultas
                </button>
            </li>
            <li class="nav-item" style="font-size: 15px;">
                <button type="button" target="2" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-magang-mandiri" aria-controls="navs-pills-justified-magang-mandiri" aria-selected="false">
                    Magang Mandiri
                </button>
            </li>
        </ul>
        <!-- Isi Tab Bar -->
        <div class="tab-content p-0">

            <div id="container-card" class="mb-3">
            </div>
        </div>
        <!-- =Isi Tab Bar= -->
    </div>
</div>
@include('kegiatan_saya.lamaran_saya.modal')
@endsection

@section('page_script')
<script src="{{ asset('app-assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
<script src="{{ asset('app-assets/js/forms-extras.js') }}"></script>
<script>
    $(".flatpickr-date").flatpickr({
        altInput: true,
        altFormat: 'j F Y',
        dateFormat: "d M Y",
        minDate: "today",
    });

    $(document).ready(function() {
        let idElement = "navs-pills-justified-magang-fakultas";
        // var select2 = document.querySelector('select[name="filter"]');
        // var status = select2.value;
        // let item = {
        //     status: status,
        // };

        $.ajax({
            url: `{{$urlGetCard}}?type=` + idElement,
            type: "get",
            success: function(res) {
                if (res != "") {
                    $("#container-card").html(res);
                }
            }
        });

        jQuery('.nav-link').click(function() {
            let idElement = $(this).attr('aria-controls');

            $.ajax({
                url: `{{$urlGetCard}}?type=` + idElement,
                type: "get",
                success: function(res) {
                    if (res != "") {
                        $("#container-card").html(res);
                    }
                }
            })

        });
    });

    function loadData() {
        $.ajax({
            url: `{{ $urlGetCard }}?type=get-data-proses`,
            type: "GET",
            success: function(response) {
                console.log(response);
                $('#container-proses-seleksi').html(response);
            },
        });
    }

    $(document).on('change', '#filter-status-lowongan', function() {
        loadData();
    });

    // Fakultas
    function ambil(e) {
        var nim = e.attr('data-id');
        var lowongan = e.attr('data-lowongan');
        var url = `{{ url('kegiatan-saya/ambil') }}/${nim}`;
        var count = `{{$diterima->count()}}`;

        if (count == 1) {
            Swal.fire({
                type: "warning",
                icon: "warning",
                title: "INFO",
                text: "Anda hanya bisa menerima satu tawaran magang!",
                showConfirmButton: false,
                timer: 2500,
            });
        } else {
            Swal.fire({
                title: "Apakah anda yakin ingin mengambil tawaran magang?",
                icon: "warning",
                confirmButtonText: "Ya, Yakin",
                cancelButtonText: "Batal",
                showConfirmButton: true,
                showCancelButton: true,
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger",
                },
                buttonsStyling: false,
            }).then(function(result) {
                if (result.isConfirmed) {
                    jQuery.ajax({
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'lowongan': lowongan
                        },
                        url: url,
                        success: function(data) {
                            if (data.error) {
                                Swal.fire({
                                    type: "error",
                                    title: 'Oops...',
                                    text: data.message,
                                    showConfirmButton: true,
                                    customClass: {
                                        confirmButton: "btn btn-success",
                                    },
                                })
                            } else {
                                location.reload();
                            }
                        }
                    });
                }
            });
        }
    }

    function tolak(e) {
        var nim = e.attr('data-id');
        var lowongan = e.attr('data-lowongan');
        var url = `{{ url('kegiatan-saya/tolak') }}/${nim}`;
        Swal.fire({
            title: "Apakah anda yakin ingin menolak tawaran magang?",
            icon: "warning",
            confirmButtonText: "Ya, Yakin",
            cancelButtonText: "Batal",
            showConfirmButton: true,
            showCancelButton: true,
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        }).then(function(result) {
            if (result.isConfirmed) {
                jQuery.ajax({
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'lowongan': lowongan
                    },
                    url: url,
                    success: function(data) {
                        if (data.error) {
                            Swal.fire({
                                type: "error",
                                title: 'Oops...',
                                text: data.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: "btn btn-success",
                                },
                            })
                        } else {
                            location.reload();
                        }
                    }
                });
            }
        });
    }

    $("#modalMulai").on("hide.bs.modal", function() {

        $('#modalMulai form #mulai').val('').flatpickr({
            dateFormat: "d M Y",
            altInput: true,
            altFormat: 'j F Y',
            minDate: "today",
            defaultDate: 'null'
        });;
        $('#modalMulai form #akhir').val('').flatpickr({
            dateFormat: "d M Y",
            altInput: true,
            altFormat: 'j F Y',
            minDate: "today",
            defaultDate: 'null'
        });;
        $('#modalMulai form #bukti_doc').val('').trigger('change');
    });

    function mulai(e) {
        let id = e.attr('data-id');
        let action = `{{ url('kegiatan-saya/mulai') }}/${id}`;
        var url = `{{ url('kegiatan-saya/editMulai') }}/${id}`;
        Swal.fire({
            title: "Anda tidak dapat mengedit form yang sudah dikirim!",
            text: "Pastikan kembali apakah data sudah benar!",
            icon: "info",
            confirmButtonText: "Oke",
            showConfirmButton: true,
            showCancelButton: false,
            customClass: {
                confirmButton: "btn btn-success"
            },
            buttonsStyling: false,
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(response) {
                        var lowongan = e.attr('data-lowongan');
                        var industri = e.attr('data-industri');

                        $('#modalMulai form').attr('action', action);
                        $('#modalMulai form #nama_industri').val(industri);
                        $('#modalMulai form #posisi_magang').val(lowongan);

                        $('#modalMulai').modal('show');
                    }
                });
            }
        });
    }

    // Mandiri
    function terima(e) {
        let id = e.attr('data-id');
        let action = `{{ url('kegiatan-saya/update/') }}/${id}`;
        var url = `{{ url('kegiatan-saya/edit/') }}/${id}`;
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                console.log(response);
                $('#modalDiterima form').attr('action', action);
                $('#tglpeng_').val(response.tglpeng).trigger('change');
                $('#nama_industri').val(response.nama_industri);
                $('#posisi_magang').val(response.posisi_magang);
                $('#date_').val(response.startdate).trigger('change');
                $('#date').val(response.enddate).trigger('change');

                $('#modalDiterima').modal('show');
            }
        });
    }

    function Ditolak(e) {
        let id = e.attr('data-id');
        let action = `{{ url('kegiatan-saya/updateDitolak/') }}/${id}`;
        var url = `{{ url('kegiatan-saya/edit/') }}/${id}`;
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                console.log(response);
                $('#modalDitolak form').attr('action', action);

                $('#modalDitolak').modal('show');
            }
        });
    }
</script>
<script src="{{ asset('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
<script src="{{ asset('app-assets/vendor/libs/tagify/tagify.js') }}"></script>
<script src="{{ asset('app-assets/js/forms-tagify.js') }}"></script>
<!-- Vendors JS -->
<script src="{{ asset('app-assets/vendor/libs/moment/moment.js') }}"></script>
<script src="{{ asset('app-assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('app-assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('app-assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
<script src="{{ asset('app-assets/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
<script src="{{ asset('app-assets/vendor/libs/pickr/pickr.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('app-assets/js/forms-pickers.js') }}"></script>
@endsection