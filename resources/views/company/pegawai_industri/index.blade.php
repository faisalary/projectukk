@extends('partials.vertical_menu')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 col-12">
        <h4 class="fw-bold">Anggota Tim</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPegawai">Tambah Pegawai Industri</button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="table" id="table-master-pegawai">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>NAMA PEGAWAI</th>
                            <th>KONTAK</th>
                            <th>JABATAN</th>
                            <th>ROLE</th>
                            <th class="text-center">STATUS</th>
                            <th style="min-width:100px;">AKSI</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@include('company.pegawai_industri.modal')
@endsection

@section('page_script')
<script>
    var table = $('#table-master-pegawai').DataTable({
        ajax: "{{ route('pegawaiindustri.show') }}",
        serverSide: false,
        processing: true,
        deferRender: true,
        type: 'GET',
        destroy: true,
        columns: [{
                data: 'DT_RowIndex'
            },
            {
                data: 'pegawai_industri',
                name: 'pegawai_industri'
            },
            {
                data: 'kontak',
                name: 'kontak'
            },
            {
                data: 'jabatan',
                name: 'jabatan'
            },
            {
                data: 'role',
                name: 'role'
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

    function afterAction(response) {
        $('#modalTambahPegawai').modal('hide');
        afterUpdateStatus(response);
    }

    function afterUpdateStatus(response) {
        $('#table-master-pegawai').DataTable().ajax.reload();
    }

    function edit(e) {
        let id = e.attr('data-id');
        let action = `{{ route('pegawaiindustri.update', ['id' => ':id']) }}`.replace(':id', id);
        var url = `{{ route('pegawaiindustri.edit', ['id' => ':id']) }}`.replace(':id', id);

        let modal = $('#modalTambahPegawai');

        modal.find(".modal-title").html("Edit Pegawai");
        modal.find('form').attr('action', action);
        modal.modal('show');

        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $.each(response, function(key, value) {
                    $(`[name=${key}]`).val(value).trigger('change');
                });
            }
        });
    }

    $("#modalTambahPegawai").on("hide.bs.modal", function() {
        $(".modal-title").html("Tambah Pegawai");
        $('#modalTambahPegawai form').attr('action', "{{ route('pegawaiindustri.store') }}");
    });
</script>
@endsection

