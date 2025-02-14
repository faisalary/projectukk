@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
<div class="d-flex mb-3 justify-content-between align-items-center">
    <h4 class="mb-0">Template Email</h4>
    <a href="{{ route('template_email.create') }}" class="btn btn-primary">Tambah Template Email</a>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-email">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Proses</th>
                            <th>Subjek Email</th>
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
    $('#table-master-email').DataTable({
        ajax: '{{ route("template_email.show") }}',
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [
            { data: "DT_RowIndex" },
            { data: 'proses', name: 'proses' },
            { data: 'subject_email', name: 'subject_email' },
            { data: 'aksi', name: 'aksi' },
        ]
    });
</script>
@endsection