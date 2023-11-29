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

<div class="row">
    <div class="col-md-9 col-12"><nav aria-label="breadcrumb">
    <div class="row ">
    <div class="">
        <h4 class="fw-bold text-sm">Roles<span class="text-muted fw-light text-xs"></span>
        </h4>
    </div>
    </div>
</div>
<div class="col-xl-12">
    <div class="nav-align-top">
        <div class="row mb-4">
            <div class="col-12 mb-4 text-end">                       
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-konfigurasi">+ Tambah Role</button>               
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-konfig-role">
                        <thead>
                            <tr>
                                <th>nomor</th>
                                <th style="min-width: 100px;">Nama Role</th>
                                <th>STATUS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                    </table>    
                </div>
            </div>
        </div>
    </div>        
</div>
@include('konfigurasi.modal')

@endsection

@section('page_script')

<script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
<script src="../../app-assets/js/forms-extras.js"></script>
<script>
    var jsonData = [{
            "nomor": "1",
            "namarole": "Admin",
            "status": "<span class='badge bg-label-success'>Aktif</span>",
            "aksi": "<a href='/edit'class='btn-icon text-warning waves-effect waves-light'><i class='ti ti-edit'></i></a><a class='btn-icon text-success waves-effect waves-light'><i class='ti ti-circle-check'></i></a>",
        },
        {
            "nomor": "2",
            "namarole": "Mitra",
            "status": "<span class='badge bg-label-success'>Aktif</span>",
            "aksi": "<a class='btn-icon text-warning waves-effect waves-light'><i class='ti ti-edit'></i></a><a class='btn-icon text-success waves-effect waves-light'><i class='ti ti-circle-check'></i></a>",
        },
        {
            "nomor": "3",
            "namarole": "Mahasiswa",
            "status": "<span class='badge bg-label-success'>Aktif</span>",
            "aksi": "<a class='btn-icon text-warning waves-effect waves-light'><i class='ti ti-edit'></i></a><a class='btn-icon text-success waves-effect waves-light'><i class='ti ti-circle-check'></i></a>",
        }
    ];

    var table = $('#table-konfig-role').DataTable({
        "data": jsonData,
        columns: [{
                data: "nomor"
            },
            {
                data: "namarole"
            },
            {
                data: "status"
            },
            {
                data: "aksi"
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
