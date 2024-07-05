@extends('partials.vertical_menu')

@section('page_style')
<style>
    .tooltip-inner {
        max-width: 210px;
        /* If max-width does not work, try using width instead */
        width: 900px;
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h4 class="fw-bold my-auto">Kelola Pengguna</h4>
    <div class="">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahUser">Tambah Pengguna</button>
    </div>
</div>
<div class="col-xl-12 mt-3">
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="table" id="table-pengguna">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th style="min-width: 125px;">NAMA</th>
                        <th>EMAIL</th>
                        <th style="text-align: center;">Role</th>
                        <th style="text-align: center;">AKSI</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
{{-- Modal Edit> --}}
@include('admin.kelola-pengguna.modal')
@endsection

@section('page_script')
<script>
    var table = $('#table-pengguna').DataTable({
        ajax: `{{ route('kelola_pengguna.get_data') }}`,
        columns: [
            { data: "DT_RowIndex" },
            { data: "name" },
            { data: "email" },
            { data: "roles" },
            { data: "action" }
        ]
    });

    function afterAction(response) {
        $('#table-pengguna').DataTable().ajax.reload();
        $('#modalTambahUser').modal('hide');
    }

    function edit(e) {
        let id = e.attr('data-id');

        let url = `{{ route('kelola_pengguna.edit', ['id' => ':id']) }}`.replace(':id', id);
        let action = `{{ route('kelola_pengguna.update', ['id' => ':id']) }}`.replace(':id', id);
        let modal = $('#modalTambahUser');

        modal.find('.modal-title').html('Edit Pengguna');
        modal.find('form').attr('action', action);
        modal.modal('show');

        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                response = response.data;
                $('#name').val(response.name);
                $('#email').val(response.email);
            }
        });
    }

    $("#modalTambahUser").on("hide.bs.modal", function(e) {
        let modal = $("#modalTambahUser");
        modal.find(".modal-title").html('Tambah Pengguna');
        modal.find('form').attr('action', "{{ route('kelola_pengguna.store') }}");
    });
</script>
@endsection