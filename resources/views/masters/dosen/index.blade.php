@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-12">
            <h4 class="fw-bold"><span class="text-muted fw-light">Master Data /</span> Dosen</h4>
        </div>
        <div class="col-md-2 col-12 text-end">
            <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide"> <i class="tf-icons ti ti-filter"></i></button>
        </div>
        <div class="col-md-12 d-flex justify-content-between mt-2">
            <p class="text-secondary">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Universitas : -, Fakultas : -, Prodi : -" id="tooltip-filter"></i></p>
            {{-- <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-dosen">Tambah Dosen</button> --}}
            <div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle waves-effect waves-light"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Tambah Dosen
                </button>
                <ul class="dropdown-menu" style="">
                    <li><a class="dropdown-item btn text-success ti ti-upload d-block pe-15" data-bs-toggle="modal"
                            data-bs-target="#modal-import">Import</a></li>
                    <li><a class="dropdown-item btn text-success" data-bs-toggle="modal"
                            data-bs-target="#modal-dosen">Tambah Dosen</a></li>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table" id="table-master-dosen">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Universitas</th>
                                <th>NIP</th>
                                <th style="text-align: center;">KODE DOSEN</th>
                                <th>NAMA DOSEN</th>
                                <th>NOMOR TELEPON</th>
                                <th>EMAIL</th>
                                <th class="text-center">STATUS</th>
                                <th style="text-align: center;">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
@include('masters.dosen.modal')
@endsection


@section('page_script')
<script>

    $(document).ready(function () {
        loadData();
    });

    function getDataSelect(e) {
        let idElement = e.attr('data-after');
        let modalId = e.closest('.modal').attr('id'); // ID modal
        $.ajax({
            url: `{{ route('dosen') }}`,
            type: 'GET',
            data: {
                selected: e.val(),
                section: idElement
            },
            success: function (response) {
                $(`#${modalId} #${idElement}`).find('option:not([disabled])').remove();
                $(`#${modalId} #${idElement}`).val(null).trigger('change');
                $.each(response.data, function () {
                    $(`#${modalId} #${idElement}`).append(new Option(this.name, this.id));
                });
            }
        });
    }

    function afterAction(response) {
        $('#modal-dosen').modal('hide');
        afterUpdateStatus(response);
    }

    function afterUpdateStatus(response) {
        $('#table-master-dosen').DataTable().ajax.reload();
    }

    $("#modal-dosen").on("hide.bs.modal", function() {
        $("#modal-title").html("Tambah Dosen");
    });


    function edit(e) {
        let id = e.attr('data-id');

        let action = `{{ route('dosen.update', ['id' => ':id']) }}`.replace(':id', id);
        var url = `{{ route('dosen.edit', ['id' => ':id']) }}`.replace(':id', id);
        let modal = $('#modal-dosen');

        modal.find(".modal-title").html("Edit Dosen");
        modal.find('form').attr('action', action);
        modal.modal('show');

        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                response = response.data
                $.each(response, function ( key, value ) {
                    let element = modal.find(`#${key}`);
                    if (element.is('select') && element.find('option').length <= 1) {
                        let interval = setInterval(() => {
                            if (element.children('option').length > 1) {
                                element.val(value).trigger('change');
                                clearInterval(interval);
                            }
                        }, 10);
                    } else {
                        element.val(value).trigger('change');
                    }
                });
            }
        });
    }

    function loadData() {
        var table = $('#table-master-dosen').DataTable({
            ajax: "{{ route('dosen.show') }}",
            serverSide: false,
            processing: true,
            // deferRender: true,
            destroy: true,
            scrollX: true,
            columns: [
                { data: 'DT_RowIndex' },
                { data: 'id_univ', name: 'id_univ' },
                { data: 'nip', name: 'nip' },
                { data: 'kode_dosen', name: 'kode_dosen' },
                { data: 'namadosen', name: 'namadosen' },
                { data: 'nohpdosen', name: 'nohpdosen' },
                { data: 'emaildosen', name: 'emaildosen' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' }
            ]
        });
    }
</script>

@endsection
