@extends('partials_admin.template')

@section('page_style')

<link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
<style>
    .tooltip-inner {
        max-width: 900px;
        /* If max-width does not work, try using width instead */
        width: 900px;
    }

    .bg-success {
        --bs-bg-opacity: 1;
        background-color: #4EA971 !important;
    }
</style>
@endsection

@section('main')
@can('slidebar.lkm')
<div class="row mb-3">
    <div class="col-md-6 col-12">
        <h4 class="fw-bold text-sm">Roles</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-konfigurasi">Tambah Role</button>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="card-datatable table-responsive">
            <table class="table" id="table-konfig-role">
                <thead>
                    <tr>
                        <th>NOMOR</th>
                        <th>NAMA ROLE</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@include('konfigurasi.modal')


@endsection

@section('page_script')

<script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
<script src="../../app-assets/js/forms-extras.js"></script>
<script>
    var table = $('#table-konfig-role').DataTable({
        ajax: '{{route("konfigurasi.show")}}',
        processing: true,
        serverSide: false,
        deferrender: true,
        type: 'GET',
        destroy: true,
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'name',
                name: 'name'
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

    // Kelola Lowongan
    const selectAllKelola = document.querySelector('#selectAll'),
        checkboxListKelola = document.querySelectorAll('.kelola');

    selectAllKelola.addEventListener('change', t => {
        checkboxListKelola.forEach(e => {
            e.checked = t.target.checked;
        });
    });

    // Informasi Lowongan
    const selectAllInformasi = document.querySelector('#selectAll_informasi'),
        checkboxListInformasi = document.querySelectorAll('.informasi');

    selectAllInformasi.addEventListener('change', t => {
        checkboxListInformasi.forEach(e => {
            e.checked = t.target.checked;
        });
    });

    // Jadwal Seleksi
    const selectAllSeleksi = document.querySelector('#selectAll_seleksi'),
        checkboxListSeleksi = document.querySelectorAll('.seleksi');

    selectAllSeleksi.addEventListener('change', t => {
        checkboxListSeleksi.forEach(e => {
            e.checked = t.target.checked;
        });
    });
</script>

<script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>

@endcan
@endsection