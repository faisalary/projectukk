@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
    <div class="d-flex justify-content-start">
        <h4>{{ $view['title'] }}</h4>
    </div>
    <div class="nav-align-top mt-3">
        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item" role="presentation">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-diterima" aria-controls="navs-pills-diterima" aria-selected="true">
                    <i class="ti ti-user-check"></i>
                    Diterima
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-ditolak" aria-controls="navs-pills-ditolak" aria-selected="false" tabindex="-1">
                    <i class="ti ti-user-x"></i>
                    Ditolak
                </button>
            </li>
        </ul>
    </div>
    <div class="tab-content px-0">
        @foreach (['diterima', 'ditolak'] as $key => $item)
        <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="navs-pills-{{ $item }}" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center my-4">
                <span class="text-muted">Filter Berdasarkan: </span>
                @if (($view['isKaprodi'] ?? false) && $item == 'diterima')
                <button type="button" id="assign-pembimbing" class="btn btn-primary text-white">Assign Dosen Pembimbing Akademik</button>
                @endif
            </div>
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table" id="{{ $item }}">
                        <thead>
                            <tr>
                                @foreach ($view[$item] as $item)
                                {!! $item !!}
                                @endforeach
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if ($view['isKaprodi'] ?? false)
    @include('data_mahasiswa_magang/components/modal')
    @endif
@endsection

@section('page_script')
<script>
    //fix datatable when click tab
    $('.nav-link').on('click', function() {
        $('.table').each(function () {
            $(this).DataTable().columns.adjust().draw();
        });
    });

    $('.table').each(function () {
        let columns = {!! $view['columnsDiterima'] !!};

        if ($(this).attr('id') == 'ditolak') {
            columns = {!! $view['columnsDitolak'] !!};
        }

        let attrDatatable = {
            ajax: `{{ $view['urlGetData'] }}?type=` + $(this).attr('id'),
            serverSide: false,
            processing: true,
            destroy: true,
            columns: columns,
            columnDefs: [{!! $view['columnDefs'] ?? null !!}],
            ordering: false,
            scrollX: true,
            @if ($view['isKaprodi'] ?? false)
            select: {style: 'multi', selector: 'td:first-child input:checkbox'},
            @endif
        };

        if ($(this).attr('id') == 'ditolak') {
            delete attrDatatable.columnDefs;
            delete attrDatatable.select;
        }

        $(this).DataTable(attrDatatable);
    });
</script>
@if ($view['isKaprodi'] ?? false) 
<script>
    $('#assign-pembimbing').on('click', function() {
        let modal = $('#modal-assign');
        let selectedValue = $('input.dt-checkboxes:checked');

        if (selectedValue.length == 0) {
            showSweetAlert({
                title: 'Invalid',
                text: 'Pilih mahasiswa terlebih dahulu',
                icon: 'warning'
            });
            return;
        }

        selectedValue.each(function() {
            modal.find('form').prepend('<input type="hidden" name="id_pendaftaran[]" value="' + $(this).val() + '">');
        });

        modal.modal('show');
    });

    $('#modal-assign').on('hide.bs.modal', function() {
        $(this).find('form').find('input[name="id_pendaftaran[]"]').remove();
    });

    function afterAssigning(response) {
        $("#modal-assign").modal("hide");
    }
</script>
@endif
@endsection
