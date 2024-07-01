@extends('partials.horizontal_menu')

@section('page_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .hidden {
        display: none;
    }

    .page-item.active .page-link,
    .pagination li.active>a:not(.page-link) {
        border-color: #4EA971 !important;
        background-color: #4EA971 !important;
        color: #fff;
    }

    .btn-success {
        color: #fff;
        background-color: #4EA971 !important;
        border-color: #4EA971 !important;
    }

    .highlight {
        background-color: #4EA971 !important;
        color: white !important;
    }

    .light-style .select2-container--default .select2-selection--single {
        width: 530px;
    }

    .light-style .select2-container--default .select2-selection {
        border-left: 0px;
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }

    .layout-wrapper,
    .layout-container {
        width: 100%;
        display: flex;
        flex: 1 1 auto;
        align-items: stretch;
        background-color: #fff;
    }

    input[type="checkbox"]:focus {
        outline: 0px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }

    .form-check-input:checked,
    .form-check-input[type=checkbox]:indeterminate {
        background-color: #4EA971 !important;
        border-color: #4EA971 !important;
    }

    .light-style .flatpickr-input[readonly],
    .light-style .flatpickr-input~.form-control[readonly] {
        background: #F8F8F8
    }

    .select2-results__option[role="option"][aria-selected="true"] {
        background-color: #4EA971;
        color: #fff;
    }

    .select2-container--default .select2-results__option--highlighted:not([aria-selected="true"]) {
        background-color: rgba(115, 103, 240, 0.08) !important;
        color: #4EA971 !important;
    }

    .light-style .select2-container--default .select2-selection--single {
        height: 48px !important;
    }

    .light-style .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 2.67rem !important;
    }

    span.select2-dropdown.select2-dropdown--below {
        width: 530px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        position: absolute;
        height: 18px;
        width: 20px;
        top: 36% !important;
        background-repeat: no-repeat;
        background-size: 20px 18px;
        margin-left: 307px !important;
    }

    .input-group:not(.has-validation)> :not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating),
    .input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3),
    .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-control,
    .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-select {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-top: 0;
        border-bottom: 0;
        border-right: 0;
        border-left: 0;
    }

    span.select2-selection.select2-selection--single {
        border-top: 10px !important;
        border-bottom: 10px !important;
        border-right: 10px !important;
    }

    .light-style .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 3.2rem !important;
    }

    .page-item > .page-link.active {
    border-color: #4EA971 !important;
    background-color: #4EA971 !important;
    color: #fff;
}
</style>
@endsection

@section('content')

<div class="auto-container" style="background-color: #F8F8F8;background-repeat: no-repeat; background-size: cover; background-image: url({{asset('assets/images/background.png')}});">
    <div class="row mt-5 mb-5" style="margin-left:70px;">
        <div class="col-5 mt-3">
            <div class="input-group input-group-merge border">
                <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                <input type="text" id="nama_perusahaan" class="form-control" placeholder="Lowongan Magang" aria-label="Lowongan Magang" aria-describedby="basic-addon-search31" style="height: 37px;">
            </div>
        </div>
        <div class="col-5 mt-3">
            <div class="input-group input-group-merge border">
                <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-map-pin"></i></span>
                <select class="select2 form-control" data-placeholder="Pilih lokasi Magang" aria-describedby="basic-addon-search31">
                    <option disabled selected> Lokasi Magang </option>
                    <option> Bandung </option>
                    <option> Jakarta </option>
                    <option> Medan </option>
                    <option> Surabaya </option>
                    <option> Yogyakarta </option>
                </select>
            </div>
        </div>
        <div class="col-2 mt-3">
            <button class="btn btn-success" id="search" type="button" style="height: 50px;" onclick="filter()">Cari sekarang</button>
        </div>
    </div>
</div>
<div class="container-xxl flex-grow-1 container-p-y">
    <div id="container-industri">
        @include("perusahaan.list_perusahaan")
    </div>
</div>


@endsection

@section('page_script')
<script>
    function filter() {
        let name = $('#nama_perusahaan').val(); 
        
        $.ajax({
            url: `{{ url('daftar_perusahaan/filter?name=') }}`+name,
            type: "GET",
            success: function(response) {
                $('#container-industri').html(response);
            }
        });
    }

    $('.page-item').on('click', function() {
        let active = $(this);
        let page = active.attr('page');
        
        console.log(page);
        if(page != 'prev' && page != 'next'){
            active.addClass('active');
            active.siblings().removeClass('active');

            showPage(page);
        }
    });

    function showPage(pageNumber) {
        $('.page-content').hide(); 
        $('.page-' + pageNumber).show(); 
    }

</script>
@endsection