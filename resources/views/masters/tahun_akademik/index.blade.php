@extends('partials_admin.template')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
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
        <div class="col-md-6 col-12">
            <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Tahun Akademik</h4>
        </div>
        <div class="col-md-6 col-12 text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-thn-akademik">Tambah Tahun
                Akademik</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-master-tahun-akademik">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th>TAHUN AJARAN</th>
                                <th>SEMESTER</th>
                                <th>TANGGAL PENDAFTARAN MAGANG</th>
                                <th>TANGGAL PENGUMPULAN BERKAS</th>
                                <th>STATUS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('masters.tahun_akademik.modal')
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="../../app-assets/js/forms-extras.js"></script>
    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
    <script>
        $(".flatpickr-date").flatpickr({
            altInput: true,
            altFormat: 'j F Y',
            dateFormat: 'Y-m-d'
        });


        $('#table-master-tahun-akademik').DataTable({
            ajax: '{{ route('thn-akademik.show') }}',
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: "DT_RowIndex"
                },
                {
                    data: 'tahun',
                    name: 'tahun'
                },
                {
                    data: 'semester',
                    name: 'semester'
                },
                {
                    data: null,
                    name: 'combined_column',
                    render: function(data, type, row) {
                        var startdate = new Date(data.startdate_daftar);
                        var enddate = new Date(data.enddate_daftar);

                        var formatDate = function(date) {
                            var day = date.getDate();
                            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug",
                                "Sep", "Oct", "Nov", "Dec"
                            ];
                            var month = monthNames[date.getMonth()];
                            var year = date.getFullYear();
                            return (day < 10 ? '0' : '') + day + ' ' + month + ' ' + year;
                        };

                        return formatDate(startdate) + '  -  ' + formatDate(enddate);
                    }
                },
                {
                    data: null,
                    name: 'combined_column',
                    render: function(data, type, row) {
                        var startdate = new Date(data.startdate_pengumpulan_berkas);
                        var enddate = new Date(data.enddate_pengumpulan_berkas);

                        var formatDate = function(date) {
                            var day = date.getDate();
                            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug",
                                "Sep", "Oct", "Nov", "Dec"
                            ];
                            var month = monthNames[date.getMonth()];
                            var year = date.getFullYear();
                            return (day < 10 ? '0' : '') + day + ' ' + month + ' ' + year;
                        };

                        return formatDate(startdate) + ' - ' + formatDate(enddate);
                    }
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });


        function edit(e) {
            let id = e.attr('data-id');

            let action = `{{ url('master/tahun-akademik/update/') }}/${id}`;
            var url = `{{ url('master/tahun-akademik/edit/') }}/${id}`;
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $("#modal-title").html("Edit Tahun Akademik");
                    $("#modal-button").html("Update Data")
                    $('#modal-thn-akademik form').attr('action', action);
                    $('#tahun').val(response.tahun);
                    $('#semester').val(response.semester).trigger('change');
                    $('#startdate_daftar').val(response.startdate_daftar).trigger('change');
                    $('#enddate_daftar').val(response.enddate_daftar).trigger('change');
                    $('#startdate_pengumpulan_berkas').val(response.startdate_pengumpulan_berkas).trigger(
                        'change');
                    $('#enddate_pengumpulan_berkas').val(response.enddate_pengumpulan_berkas).trigger('change');


                    $('#modal-thn-akademik').modal('show');
                }
            });
        }

        $("#modal-thn-akademik").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Tahun Akademik");
            $("#modal-button").html("Simpan")
            $('#modal-thn-akademik form')[0].reset();
            $('#modal-thn-akademik form #semester').val('').trigger('change');
            $('#modal-thn-akademik form').attr('action', "{{ url('master/tahun-akademik/store') }}");
            $('.invalid-feedback').removeClass('d-block');
            $('.form-control').removeClass('is-invalid');
        });
    </script>

    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection
