@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h4 class="fw-bold"><span class="text-muted fw-light">Berkas Akhir Magang / </span>Magang Fakultas Tahun Ajaran 2023/2024</h4>
    </div>
    <div class="d-none d-sm-flex">
        <select class="select2 form-select" data-placeholder="Filter Status">
            <option value="0">2022/2023 Ganjil</option>
            <option value="1">2022/2023 Genap</option>
            <option value="2">2023/2024 Ganjil</option>
            <option value="3">2023/2024 Genap</option>
        </select>
    </div>
</div>

<div class="nav-align-top mb-4">
    <ul class="nav nav-pills mb-3" role="tablist">
        <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-pending" aria-controls="navs-pills-pending" aria-selected="true">
                <i class="ti ti-clock pe-1"></i> Menunggu Diverifikasi
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-incomplete" aria-controls="navs-pills-incomplete" aria-selected="false">
                <i class="ti ti-clipboard-x pe-1"></i> Tidak Lengkap
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-complete" aria-controls="navs-pills-complete" aria-selected="false">
                <i class="ti ti-clipboard-check pe-1"></i>Lengkap
            </button>
        </li>
    </ul>
    <div class="tab-content p-0">
        @foreach (['pending', 'incomplete', 'complete'] as $key => $item)
        <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="navs-pills-{{ $item }}" role="tabpanel">
            <div class="card">
                <div class="card-datatable">
                    <div class="table-responsive">
                        <table class="table" id="{{ $item }}">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA/NIM</th>
                                    <th>BERKAS AKHIR MAGANG</th>
                                    <th>TIMESTAP PENGUMPULAN BERKAS AKHIR MAGANG</th>
                                    <th>KETEPATAN WAKTU PENGUMPULAN</th>
                                    <th>NILAI AKHIR</th>
                                    <th>INDEKS</th>
                                    @if ($item != 'pending')
                                    <th>ALASAN PENGURANGAN NILAI</th>   
                                    @endif
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@include('berkas_akhir_magang/magang_fakultas/components/modal')
@endsection

@section('page_script')
<script>
    $(document).ready(function () {
        loadData();
        // fix column datatable when click tab bootstrap
        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            $('.table').DataTable().columns.adjust().draw();
        });
    });

    function loadData() {
        $('.table').each(function () {
            if($(this).attr('id') == undefined) return;

            let data = [
                { data: "DT_RowIndex" },
                { data: "namamhs" },
                { data: "berkas_akhir_magang" },
                { data: "timestap_pengumpulan" },
                { data: "ketepatan_pengumpulan" },
                { data: "nilai_akhir" },
                { data: "indeks" }
            ];

            if ($(this).attr('id') != 'pending') data.push({ data: "alasan_pengurangan_nilai" });

            data.push({ data: "aksi" });

            $(this).DataTable({
                ajax: `{{ route('berkas_akhir_magang.fakultas.get_data') }}?type=` + $(this).attr('id'),
                scrollX: true,
                columns: data
            });
        });
    }

    function adjustmentNilai(e) {
        let dataId = e.attr('data-id');
        let modal = $('#modal-adjustment-nilai');

        modal.modal('show');
        let urlAction = `{{ route('berkas_akhir_magang.fakultas.adjustment_nilai', ['id' => ':id']) }}`.replace(':id', dataId);

        $.ajax({
            url: `{{ route('berkas_akhir_magang.fakultas') }}`,
            type: `GET`,
            data: { section: 'get_data_nilai', data_id: dataId },
            success: function (res) {
                modal.find('form').attr('action', urlAction);
                $.each(res.data, function ( key, value ) {
                    modal.find('form').find(`[name=${key}]`).val(value).change();
                });
            },
            error: function (err) {
                showSweetAlert({
                    type: 'error',
                    title: 'Gagal',
                    text: err.responseJSON.message
                });
            }
        });
    }

    function afterAction(response) {
        let modal = $('#modal-adjustment-nilai');
        $('.table').each(function () {
            $(this).DataTable().ajax.reload();
        }); 
        modal.modal('hide');
    }

    function viewMhs(e) {
        let dataId = e.attr('data-id');
        let modal = $('#modalDetail');

        $.ajax({
            url: `{{ route('berkas_akhir_magang.fakultas.detail_mhs', ['id' => ':id']) }}`.replace(':id', dataId),
            type: 'GET',
            success: function (res) {
                modal.find('.modal-dialog').html(res);
                modal.modal('show');
            }
        });
    }

    $('#modalDetail').on('hidden.bs.modal', function () {
        $('#modalDetail .modal-dialog').html(`{{ $default_detail_mhs }}`);
    });

</script>
@endsection