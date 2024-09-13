@extends('partials.vertical_menu')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 col-12">
        <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Posisi Magang</h4>
    </div>
    <div class="col-md-6 col-12 text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-posisi-magang">Tambah Posisi Magang</button>
    </div>
</div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-master-table-master-posisi-magang">
                        <thead>
                            <tr>
                                <th>NOMOR</th>
                                <th>NAMA</th>                                                            
                                <th class="text-center">STATUS</th>                                                            
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('masters.posisi_magang.modal')
@endsection

@section('page_script')
    <script>
        $(document).ready(function() {
            posisiMagangList();
        });        

        function posisiMagangList() {
            var table = $('#table-master-table-master-posisi-magang').DataTable({
                ajax: `{{ route('posisimagang.show') }}`,
                serverSide: false,
                processing: true,
                deferRender: true,
                type: 'GET',
                destroy: true,
                columns: [{
                        data: 'DT_RowIndex'
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
        }



        function edit(e) {
            let id = e.attr('data-id');

            let action = `{{ route('posisimagang.update', ['id' => ':id']) }}`.replace(':id', id);
            var url = `{{ route('posisimagang.edit', ['id' => ':id']) }}`.replace(':id', id);
            let modal = $('#modal-posisi-magang');
            modal.find(".modal-title").html("Edit Posisi Magang");
            modal.find('form').attr('action', action);
            modal.modal('show');

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#name').val(response.name);
                }
            });
        }

        function afterAction(response) {
            $("#modal-posisi-magang").modal("hide");
            afterUpdateStatus(response);
        }

        function afterUpdateStatus(response) {
            $('#table-master-table-master-posisi-magang').DataTable().ajax.reload();            
        }

        $("#modal-posisi-magang").on("hide.bs.modal", function() {
            $(this).find(".modal-title").html("Tambah Posisi Magang");
            $(this).find('form').attr('action', "{{ route('posisimagang.store') }}");
        });
    </script>
@endsection
