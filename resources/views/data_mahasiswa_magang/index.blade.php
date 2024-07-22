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
    <div class="d-flex justify-content-between align-items-center mt-4">
        <span class="text-muted">Filter Berdasarkan: </span>
        {!! $view['buttonRight'] ?? null !!}
    </div>
    <div class="tab-content px-0">
        @foreach (['diterima', 'ditolak'] as $key => $item)
        <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="navs-pills-{{ $item }}" role="tabpanel">
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

        $(this).DataTable({
            ajax: `{{ route('mahasiswa_magang_dosen.get_data') }}?type=` + $(this).attr('id'),
            serverSide: false,
            processing: true,
            deferRender: true,
            destroy: true,
            columns: columns,
            ordering: false,
            scrollX: true
        });
    });
</script>
@endsection
