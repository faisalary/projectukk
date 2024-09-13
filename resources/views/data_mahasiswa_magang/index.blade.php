@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
    <div class="d-flex justify-content-start">
        <h4>{{ $view['title'] }}</h4>
    </div>
    <div class="nav-align-top mt-3">
        <ul class="nav nav-pills" role="tablist">
            @foreach ($view['listTab'] as $item)
                {!! $item !!}
            @endforeach
        </ul>
    </div>
    <div class="tab-content px-0">
        @foreach ($view['listTable'] as $key => $item)
        <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="navs-pills-{{ $item }}" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center my-4">
                <span class="text-muted">Filter Berdasarkan: </span>
                @if (($view['isKaprodi'] ?? false) && $item == 'diterima')
                <button type="button" id="assign-pembimbing" class="btn btn-primary text-white">Assign Dosen Pembimbing Akademik</button>
                @endif
                @if ($item == 'belum_spm')
                <button type="button" id="upload-spm" class="btn btn-primary text-white">Upload SPM</button>
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
    @if ($view['isLKM'] ?? false)
    @include('data_mahasiswa_magang/components/modal_lkm')
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

        if ($(this).attr('id') == 'belum_magang') {
            columns = {!! $view['columnsBelumMagang'] !!};
        } 
        @if ($view['isLKM'] ?? false)
        else if ($(this).attr('id') == 'belum_spm') {
            columns = {!! $view['columnsBelumSPM'] !!};
        }
        @endif

        let attrDatatable = {
            ajax: `{{ $view['urlGetData'] }}?type=` + $(this).attr('id'),
            serverSide: false,
            processing: true,
            destroy: true,
            columns: columns,
            ordering: false,
            scrollX: true,
        };

        @if ($view['isKaprodi'] ?? false)
        if ($(this).attr('id') == 'diterima') {
            attrDatatable.select = {style: 'multi', selector: 'td:first-child input:checkbox'};
            attrDatatable.columnDefs = [{!! $view['columnDefs'] ?? null !!}]
        }
        @endif

        @if ($view['isLKM'] ?? false)
        if ($(this).attr('id') == 'belum_spm') {
            attrDatatable.select = {style: 'multi', selector: 'td:first-child input:checkbox'};
            attrDatatable.columnDefs = [{!! $view['columnDefs'] ?? null !!}];
        }
        @endif

        $(this).DataTable(attrDatatable);
    });
</script>

@if ($view['isLKM'] ?? false)
<script>
    $('#upload-spm').on('click', function() {
        let modal = $('#modal-spm');
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

    $('#modal-spm').on('hide.bs.modal', function() {
        $(this).find('form').find('input[name="id_pendaftaran[]"]').remove();
    });

    function afterUpload(response) {
        $("#modal-spm").modal("hide");

        $('input.dt-checkboxes').prop('checked', false);

        $('.table').each(function () {
            $(this).DataTable().ajax.reload();
        });
    }
</script>
@endif

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

        $('input.dt-checkboxes').prop('checked', false);

        $('.table').each(function () {
            $(this).DataTable().ajax.reload();
        });
    }
</script>
@endif
@endsection
