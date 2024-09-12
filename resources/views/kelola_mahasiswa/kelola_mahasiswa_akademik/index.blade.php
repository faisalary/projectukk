@extends('partials.vertical_menu')

@section('page_style')
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}" />
@endsection

@section('content')
<div class="row pe-2 ps-2">
    <div class="col-md-9 col-12">
        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs">Logbook Mahasiswa / </span>
        Magang Fakultas Tahun Ajaran 2023/2024
        </h4>
    </div>
    <div class="col-md-3 col-12 mb-3  d-flex align-items-center justify-content-between">
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

    <div class="row">
        <div class="col-md-12 col-12 ">
            <div class="text-secondary mt-3 mb-3 ">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Prodi: D3 Sistem Informasi" id="tooltip-filter"></i></div>
        </div>
    </div>
</div>

<div class="row ps-2 pe-3">
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="table" id="table-lapangan">
                <thead>
                    <tr>
                        <th style="">NOMOR</th>
                        <th style="">NAMA</th>
                        <th style="">PROGRAM STUDI</th>
                        <th style="">PERUSAHAAN</th>
                        <th style="">POSISI MAGANG</th>
                        <th style="">NILAI PBB LAPANGAN</th>
                        <th style="">NILAI PBB AKADEMIK</th>
                        <th style="">NILAI AKHIR</th>
                        <th style="">STATUS MAGANG</th>
                        <th style="">AKSI</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@include('kelola_mahasiswa.kelola_mahasiswa_akademik.modal')
@endsection

@section('page_script')
<script>
    var table = $('#table-lapangan').DataTable({
        ajax: `{{ route('logbook_magang.fakultas.get_data') }}`,
        scrollX: true,
        columns: [
            { data: "DT_RowIndex" },
            { data: "namamhs" },
            { data: "namaprodi" },
            { data: "namaindustri" },
            { data: "intern_position" },
            { data: "nilai_lap" },
            { data: "nilai_akademik" },
            { data: "nilai_akhir_magang" },
            { data: "status" },
            { data: "aksi" }
        ],
        columnDefs: [
            { "width": "50px", "targets": 0 },
            { "width": "200px", "targets": [1, 2, 3, 4, 8] },
            { "width": "100px", "targets": [5, 6, 7], className: "text-center" },
            { "width": "50px", "targets": 9 }
        ],
        fixedColumns: { left: 2, right: 1 },
    });
</script>
@endsection