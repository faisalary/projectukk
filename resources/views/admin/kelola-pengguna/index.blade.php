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
    <h4 class="fw-bold">
        Kelola Pengguna
    </h4>
    <div class="">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahMitra">Tambah Pengguna</button>
    </div>
</div>
<div class="col-xl-12">
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="table" id="table-pengguna">
                <thead>
                    <tr>
                        <th>NOMOR</th>
                        <th style="min-width: 125px;">NAMA</th>
                        <th>EMAIL</th>
                        <th>Role</th>
                        <th>AKSI</th>
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
            { data: null },
            { data: "action" }
        ]
    });

    function afterAction(response) {
        $('#table-pengguna').DataTable().ajax.reload();
        $('#modalTambahMitra').modal('hide');
    }

    function edit(e) {
        let id = e.attr('data-id');

        let action = `{{ url('sesuaikan') }}/${id}`;
        var url = `{{ url('sesuaikan') }}/${id}`;
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $("#modalTambahMitraTitle").html("Edit Pengguna");
                $("#modal-button").html("Update Data")
                $('#modalTambahMitra form').attr('action', action);
                $('#nama').val(response.nama);
                $('#nohp').val(response.nohp);
                $('#email').val(response.email);
                $('#role').val(response.role).trigger('change');

                $('#modal-thn-akademik').modal('show');
            }
        });
    }

    $("#modalTambahMitra").on("hide.bs.modal", function() {

        $("#modalTambahMitraTitle").html("Tambah Pengguna");
        $("#modal-button").html("Simpan")
        $('#modalTambahMitra form')[0].reset();
        $('#modalTambahMitra form #role').val('').trigger('change');
        $('#modalTambahMitra form').attr('action', "{{ url('sesuaikan') }}");
        $('.invalid-feedback').removeClass('d-block');
        $('.form-control').removeClass('is-invalid');
    });
</script>
@endsection