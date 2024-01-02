@extends('partials_admin.template')

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

        .u {
            font-size: 10px;
        }
    </style>
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('main')
    <div class="row">
        <div class="row">
            <div class="col-md-6 col-12 mb-4">
                <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Template Email</h4>
            </div>
            <div class="col-md-6 col-12 text-end">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-email">Tambah Template
                    Email</button>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table tab1c" id="table-master-email" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="max-width: 70px;">NOMOR</th>
                            <th style="min-width: 300px;">SUBJEK EMAIL</th>
                            <th>DOKUMEN PENDUKUNG</th>
                            <th style="max-width:80px;">STATUS</th>
                            <th style="max-width:80px;">AKSI</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('company.master_email.modal')
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="../../app-assets/js/forms-extras.js"></script>
    <script>
        // $(document).ready(function() {
        //     $('#table-master-email').DataTable();
        // });
        var table = $('#table-master-email').DataTable({
            ajax: "{{ url('company/master-email/show') }}",
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: 'DT_RowIndex'
                },

                {
                    data: 'subject_email',
                    name: 'subject_email'
                },
                {
                    data: 'attachment',
                    name: 'attachment'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],
            "columnDefs": [{
                    "width": "100px",
                    "targets": 0
                },
                {
                    "width": "100px",
                    "targets": 1
                },
                {
                    "width": "150px",
                    "targets": 2
                },
                {
                    "width": "150px",
                    "targets": 3
                },
                {
                    "width": "100px",
                    "targets": 4
                }
            ]
        });

        function edit(e) {
            let id = e.attr('data-id');
            let action = `{{ url('company/master-email/update/') }}/${id}`;
            var url = `{{ url('company/master-email/edit/') }}/${id}`;
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    console.log(response);
                    $("#modal-title").html("Edit Template Email");
                    $("#buttonSimpan").html("Update Data")
                    $('#modal-email form').attr('action', action);
                    $('#subject_email').val(response.subject_email);
                    $('#headline_email').val(response.headline_email);
                    $('#content_email').val(response.content_email);
                    // $('#attachment').val(response.attachment);

                    $('#modal-email').modal('show');
                }
            });
        }

        $("#modal-email").on("hide.bs.modal", function() {

            $("#modal-title").html("Tambah Template Email");
            $("#buttonSimpan").html("Save Data")
            $('#modal-email form')[0].reset();
            $('#modal-email form').attr('action', "{{ url('company/master-email/store') }}");
            $('.invalid-feedback').removeClass('d-block');
            $('.form-control').removeClass('is-invalid');
        });

    </script>

    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
@endsection
