@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-12">
            <h4 class="fw-bolder">Approval Mahasiswa</h4>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="nav-align-top">
                <ul class="nav nav-pills mb-3 " role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-approval" aria-controls="navs-pills-justified-approval"
                            aria-selected="true">
                            <i class="tf-icons ti ti-clock ti-xs me-1"></i> Belum Approval
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-sudah-approval" aria-controls="navs-pills-justified-sudah-approval"
                            aria-selected="false">
                            <i class="tf-icons ti ti-list-check ti-xs me-1"></i> Sudah Approval
                        </button>
                    </li>
                </ul>
                <div class="tab-content p-0">
                    @foreach (['approval', 'sudah-approval'] as $key => $item)
                    <div class="tab-pane fade card-datatable table-responsive {{ $key == 0 ? 'show active' : '' }}" id="navs-pills-justified-{{ $item }}" role="tabpanel">
                        <table class="table" id="{{ $item }}">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>TANGGAL DAFTAR</th>
                                    <th>PERUSAHAAN</th>
                                    <th>POSISI MAGANG</th>
                                    <th>NO. TELEPON</th>
                                    <th style="text-align:center;">STATUS APPROVAL</th>
                                    <th style="text-align:center;">AKSI</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
<script>
    $(document).ready(function () {
        loadData();
    });

    function loadData() {
        $('.table').each(function () {
            $(this).DataTable({
                ajax: {
                    url: `{{ route('approval_mahasiswa.get_data') }}`,
                    type: 'GET',
                    data: { section: $(this).attr('id') }
                },
                serverSide: false,
                processing: true,
                deferRender: true,
                destroy: true,
                scrollX: true,
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'namamhs', name: 'namamhs' }, 
                    { data: 'tanggaldaftar', name: 'tanggaldaftar' },
                    { data: 'namaindustri', name: 'namaindustri' },
                    { data: 'intern_position', name: 'intern_position' },
                    { data: 'nohpmhs', name: 'nohpmhs' },
                    { data: 'current_step', name: 'current_step' },
                    { data: 'action', name: 'action' }
                ]
            });
        });
    }
</script>
@endsection
