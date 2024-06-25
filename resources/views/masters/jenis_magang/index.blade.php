@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Jenis Magang</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <a href="{{ route('jenismagang.create') }}" class="btn btn-success">Tambah Jenis Magang</a>
    </div>
</div>

<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-jenis_magang">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>JENIS MAGANG</th>
                            <th>DURASI MAGANG</th>
                            <th>DOKUMEN UPLOAD</th>
                            <th>BERKAS AKHIR</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page_script')
<script>
    $(document).ready(function() {});

    var table = $('#table-master-jenis_magang').DataTable({
        ajax: '{{ route("jenismagang.show") }}',
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [{
                data: "DT_RowIndex"
            },
            {
                data: 'namajenis',
                name: 'nama_jenis'
            },
            {
                data: 'durasimagang',
                name: 'durasi_magang'
            },
            {
                data: 'status_upload',
                name: 'status_upload'

            },
            {
                data: 'berkas_magang',
                name: 'berkas_magang'
            },
            {
                data: "status",
                name: 'status_active'
            },
            {
                data: "action",
                name: 'action'
            }
        ]
    });

    function afterUpdateStatus(response) {
        table.ajax.reload();
    }
</script>
@endsection