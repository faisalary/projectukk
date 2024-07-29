@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
<div class="d-flex justify-content-start">
    <a href="{{ route('jadwal_seleksi') }}" class="btn btn-outline-primary">
        <i class="ti ti-arrow-left"></i>
        <span class="ms-2">Kembali</span>
    </a>
</div>
<div class="d-flex justify-content-between mt-3">
    <h4>
        <span class="text-muted">Jadwal Seleksi&ensp;/&ensp;</span>
        <span>Posisi {{ $lowongan->intern_position }}</span>
    </h4>
</div>
<div class="d-flex justify-content-between">
    <div class="nav-align-top">
        <ul class="nav nav-pills mb-3" role="tablist">
            @for ($i = 1; $i <= ($lowongan->tahapan_seleksi+1); $i++)
            <li class="nav-item" role="presentation">
                <button type="button" class="nav-link {{ ($i == 1) ? 'active' : '' }}" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-{{ $i }}" aria-controls="navs-pills-{{ $i }}">
                    Seleksi Tahap {{ $i }}
                </button>
            </li>    
            @endfor
        </ul>
    </div>
    <div class="text-end">
        <button class="btn btn-primary" id="buatJadwalBtn">Buat Jadwal</button>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable">
                <div class="tab-content p-0">
                    @for ($i = 1; $i <= ($lowongan->tahapan_seleksi+1); $i++)
                    <div class="tab-pane fade {{ ($i == 1) ? 'show active' : '' }}" id="navs-pills-{{ $i }}" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table" id="{{ $i }}">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal Pelaksaaan</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>

@include('company/jadwal_seleksi/components/modal')
@endsection

@section('page_script')
<script>
    $(document).ready(function () {
        loadData();

        $(".flatpickr-date-custom").flatpickr({
            enableTime: true,
            altInput: true,
            altFormat: 'j F Y, H:i',
            dateFormat: 'Y-m-d H:i'
        });
    });

    $('#buatJadwalBtn').on('click', function () {
        let modal = $("#modalTambahJadwal");
        let tabActive = $('.nav-link.active').attr('data-bs-target').replace('#navs-pills-', '');
        modal.find('form').find('#tahapan_seleksi').val(tabActive).change();
        modal.find('form').find('input[name="tahapan_seleksi"]').val(tabActive);

        modal.modal('show');
    });

    $("#modalTambahJadwal").on('hide.bs.modal', function () {
        $(this).find('form').find('input[name="mulai_date"]').val(null).change();
        $(this).find('form').find('input[name="selesai_date"]').val(null).change();

        $(".flatpickr-date-custom").flatpickr({
            enableTime: true,
            altInput: true,
            altFormat: 'j F Y, H:i',
            dateFormat: 'Y-m-d H:i'
        });
    })

    function loadData() {
        $('.table').each(function () {
            $(this).DataTable({
                ajax: {
                    url: `{{ $urlGetData }}`,
                    type: 'GET',
                    data: {
                        tahap: $(this).attr('id')
                    }
                },
                serverSide: false,
                processing: true,
                deferRender: true,
                type: 'GET',
                destroy: true,
                drawCallback: function () {
                    initSelect2();
                },
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'namamhs', name: 'namamhs' },
                    { data: 'tanggalpelaksaan', name: 'tanggalpelaksaan' },
                    { data: 'action', name: 'action' },
                ]
            });
        });
    }

    function afterSetJadwal(response) {
        $('#modalTambahJadwal').modal('hide');
    }
</script>
@endsection