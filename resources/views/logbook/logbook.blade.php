@extends('partials.horizontal_menu')

@section('page_style')
<style>
    .flatpickr-day.flatpickr-disabled.inRange {
        color: #a5a3ae !important;
        background: none !important;
        border: 1px solid transparent !important;
    }

    .flatpickr-day.flatpickr-disabled.week.selected {
        color: #a5a3ae !important;
        background: none !important;
        border: 1px solid transparent !important;
        box-shadow: none !important;
    }
</style>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-md-10 col-12 mb-4">
        <h4 class="fw-bold"> <span class="text-muted fw-light text-xs">Kegiatan Saya / </span> Logbook Mahasiswa</h4>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="user-profile-header-banner">
                <img src="{{ asset('assets/logbookbg.png') }}" alt="Banner image" class="rounded-top" width="100%" style="height: 129px !important;" />
            </div>
            <div class="user-profile-header text-sm-start text-center mb-4" style="justify-content: space-between !important;">
                <div class="flex-shrink-0 mt-n5 mx-sm-0 mx-auto ms-0 ms-sm-5">
                    <div class="row">
                        <div class="col-6">
                            <div class="text-center mb-4" style="overflow: hidden; width: 150px; height: 150px;">
                                @if ($data->image)
                                <img src="{{ asset('storage/' . $data->image) }}" alt="user-avatar" class="d-block" width="150" id="image_industri">
                                @else
                                <img src="{{ asset('app-assets/img/avatars/user.png') }}" alt="user-avatar" class="d-block" width="150" id="image_industri">
                                @endif
                            </div>
                            <div style="margin-top: 24px;">
                                <h2 class="mb-1">{{ $data->intern_position }}</h2>
                                <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    <li class="list-inline-item">{{ $data->namaindustri }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 mt-5 d-flex justify-content-between">
                            <div class="card-body ms-5 mt-3">
                                <div class="d-flex justify-content-between small fw-semibold">
                                    <span>Kelengkapan Logbook</span>
                                    <span>75%</span>
                                </div>
                                <div class="demo-vertical-spacing text-end">
                                    <div class="progress text-end">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="pe-4">
                                <button class="btn btn-outline-primary mt-5" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false"><span><i class="ti ti-download me-sm-1"></i> <span class="d-none d-sm-inline-block">Ekspor PDF</span></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 d-flex justify-content-between">
        <h4>Logbook Mahasiswa - Januari</h4>
        <div class="col-2">
            <select class="select2 form-select" data-placeholder="Silahkan Pilih Bulan">
                <option value="">Silahkan Pilih Bulan</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
            </select>
        </div>
    </div>

    <div id="container-logbook-week">
        @include('logbook/components/card_weekly')
    </div>

    <div class="d-flex justify-content-center">
        <button type="button" onclick="createLogbook()" class="btn btn-primary">Buat Logbook Minggu ini</button>
    </div>
    
</div>

@include('logbook.components.modal')
@endsection

@section('page_script')
<script>
    function createLogbook() {
        let modal = $('#modal_logbook');

        let startDate = new Date(`{{ $data->startdate_magang }}`);
        let endDate = new Date(`{{ $data->enddate_magang }}`);

        const formatDate = (date) => {
            let day = ("0" + date.getDate()).slice(-2);
            let month = ("0" + (date.getMonth() + 1)).slice(-2);
            let year = date.getFullYear();
            return `${day}-${month}-${year}`;
        };

        const funcDate = (selectedDates, dateStr, instance) => {
            if (selectedDates.length > 0) {
                let start_date = new Date(selectedDates[0]);
                let day = start_date.getDay();
                start_date.setDate(start_date.getDate() - day);
    
                let end_date = new Date(start_date);
                end_date.setDate(start_date.getDate() + 6);
    
                if (end_date > endDate) end_date = endDate;
    
                const formattedDateRange = `${formatDate(start_date)} to ${formatDate(end_date)}`;
                instance.input.value = formattedDateRange;
            }
        }

        $('#range_date').flatpickr({
            plugins: [new weekSelect({})],
            enableTime: false,
            minDate: startDate,
            maxDate: endDate,
            onChange: funcDate,
            onClose: funcDate
        });

        modal.modal('show');
    };

    function afterCreateLogbook(response) {
        $('#modal_logbook').modal('hide');
        $('#container-logbook-week').html(response.data.view);
    }
</script>
@endsection