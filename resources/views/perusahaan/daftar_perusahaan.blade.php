@extends('partials.horizontal_menu')

@section('page_style')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
<style>
    .hidden {
        display: none;
    }

    .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
        /* width: 100% !important; */
        height: 48px !important;
        border: none;
        border-radius: 5px;
    }

    .input-group:not(.has-validation)> :not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating),
    .input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3),
    .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-control,
    .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-select {
        border: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .dropdown.bootstrap-select {
        max-width: 170px;
        max-height: 45px;
    }

    .bootstrap-select .dropdown-toggle:after {
        right: 5px !important;
        top: 50% !important;
    }

    .light-style .bootstrap-select .dropdown-toggle {
        padding-left: 0%;
    }

    .light-style .select2-container--default .select2-selection--single {
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        background-color: #fff;
        border: none;
        border-radius: 0.375rem;
    }

    .select2-container{
        padding: 0.35rem 0rem;
        margin: 0;
        width: 100% !important;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        box-sizing: border-box;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        position: absolute;
        height: 18px;
        width: 20px;
        top: 40%;
        right: 0%;
        background-repeat: no-repeat;
        background-size: 20px 18px;
    }

    .position-relative {
        position: relative !important;
        width: 90% !important;
    }

    .bootstrap-select.dropup .dropdown-toggle:after {
        transform: rotate(-45deg) translateY(-50%);
        height: 0.5em;
        width: 0.5em;
        right: 0px !important;
        top: 60% !important;
    }

    .input-group:focus-within {
        box-shadow: none;
    }
</style>
@endsection

@section('content')
<div class="auto-container" style="background-color: #F8F8F8;background-repeat: no-repeat; background-size: cover; background-image: url({{asset('assets/images/background.png')}});">
    <div class="d-flex justify-content-center mt-5 mb-5 mx-5">
        <div class="col-5">
            <div class="input-group input-group-merge border">
                <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                <input type="text" id="nama_perusahaan" class="form-control" placeholder="Nama Perusahaan">
            </div>
        </div>
        <div class="col-5 mx-2">
            <div class="input-group input-group-merge bg-white border">
                <span class="input-group-text"><i class="ti ti-calendar-time"></i></span>
                <div class="position-relative">
                    <select name="location" id="location" class="form-select" data-placeholder="Lokasi Perusahaan">
                        <option value disabled selected> Lokasi Perusahaan </option>
                        @foreach ($regencies as $item)
                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary" id="search" type="button" style="height: 50px;" onclick="filter()">Cari sekarang</button>
        </div>
    </div>
</div>
<div class="container-xxl flex-grow-1 container-p-y">
    @if(count($industries) != 0)
        <h4 class="ms-2 mt-2 mb-0">Daftar Mitra</h4>
        <div id="container-industri" class="row">
            @include('perusahaan/components/card_perusahaan')
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end mb-5 mt-4" id="container-pagination">
                @include('perusahaan/components/pagination')
            </ul>
        </nav>
    @else
        <img src="\assets\images\nothing.svg" alt="no-data" style="display: flex; margin-left: 
        auto; margin-right: auto; margin-top: 5%; margin-bottom: 5%;  width: 25%;">
        <div class="sec-title mt-5 mb-4 text-center">
            <h4>Belum ada mitra yang terdaftar</h4>
        </div>
    @endif
</div>
@endsection

@section('page_script')
<script>
    $(document).ready(function () {
        $('#location').select2({
            allowClear: true,
            placeholder: $('#location').attr('data-placeholder'),
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $('#location').parent(),
        });
    });

    let dataFilter = {};
    function pagination(e) {
        url = e.attr('data-url');
        if (url == '') return;
        dataFilter.page = url.split('page=')[1];

        $('.page-item').removeClass('active');
        e.addClass('active');

        loadData();
    }

    function filter() {
        let name = $('#nama_perusahaan').val(); 
        let location = $('#location').val();
        dataFilter.name = name;
        dataFilter.location = location;
        loadData();
    }

    function loadData() {
        let url = `{{ route('daftar_perusahaan') }}`;

        $.ajax({
            url: url,
            type: "GET",
            data: dataFilter,
            success: function(response) {
                $('#container-industri').html(response.data.view);
                $('#container-pagination').html(response.data.pagination);
            }
        });
    }
</script>
@endsection