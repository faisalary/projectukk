@extends('partials.horizontal_menu')

@section('page_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y bg-white">
    <div class="row px-4">
        <div class="col">
            <div class="input-group input-group-merge">
                <span class="input-group-text" id="search_lowongan"><i class="ti ti-search"></i></span>
                <input type="text" id="lowongan_search" name="lowongan_search" class="form-control" placeholder="Cari Lowongan Tersimpan" aria-label="Cari Lowongan Tersimpan" aria-describedby="search_lowongan">
            </div>
        </div>
    </div>
    <div class="row mt-2 px-4">
        <div class="col-4">
            <div id="container-lowongan" class="row">
                @include('perusahaan/components/card_lowongan_fp')
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mb-5 mt-4" id="container-pagination">
                    @include('perusahaan/components/pagination')
                </ul>
            </nav>
        </div>
        <div class="col-8" id="container-detail-lowongan"> 
            @include('perusahaan/components/detail_lowongan_fp')
        </div>
    </div>
</div>


@endsection

@section('page_script')
<script>
    let dataFilter = {};

    let timeoutSearch;
    $(document).on('keyup', '#lowongan_search', function () {
        clearTimeout(timeoutSearch);

        timeoutSearch = setTimeout(() => {
            dataFilter.lowongan_search = $(this).val();
            loadData();
        }, 300);
    });

    function pagination(e) {
        url = e.attr('data-url');
        if (url == '') return;
        dataFilter.page = url.split('page=')[1];

        $('.page-item').removeClass('active');
        e.addClass('active');

        loadData();
    }

    function loadData() {
        let url = `{{ route('lowongan_tersimpan') }}`;

        $.ajax({
            url: url,
            type: "GET",
            data: dataFilter,
            success: function(response) {
                $('#container-lowongan').html(response.data.view);
                $('#container-pagination').html(response.data.pagination);
            }
        });
    }

    function detail(e) {
        let dataId = e.attr('data-id');
        let url = `{{ route('apply_lowongan.detail', ['id' => ':id']) }}`.replace(':id', dataId);
        let containerDetailLowongan = $('#container-detail-lowongan');
        sectionBlock(containerDetailLowongan);

        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                containerDetailLowongan.html(response.data);
                sectionBlock(containerDetailLowongan, false);
            }
        });
    }

    $('.form-filter button[type="button"]').on('click', function() {
        let input = $(this).parents('.form-filter').find('input');
        let dataTemp = [];
        let nameElement = input[0].name;

        input.each(function() { 
            if ($(this).is(':checkbox') && $(this).is(':checked')) {
                dataTemp.push($(this).val());
            } else if ($(this).is(':radio') && $(this).is(':checked')) {
                dataTemp = $(this).val();
            } else if ($(this).is(':text')) {
                dataFilter[$(this).attr('name')] = $(this).val();
            }
        });

        $(this).parents('.form-filter').removeClass('show');
        if (dataTemp.length > 0) dataFilter[nameElement] = dataTemp;
        loadData();
    });

    $('.form-filter button[type="reset"]').on('click', function() {
        let input = $(this).parents('.form-filter').find('input');

        input.each(function() { 
            if (($(this).is(':checkbox') || $(this).is(':radio')) && $(this).is(':checked')) {
                $(this).prop('checked', false);
                delete dataFilter[$(this).attr('name')];
            } else if ($(this).is(':text')) {
                $(this).val(null);
                delete dataFilter[$(this).attr('name')];
            }
        });
    });

    function myFunction(event, e) {
        event.stopPropagation();
        let icon = e.find('i');

        if (icon.hasClass('fa-solid fa-bookmark')) {
            icon.removeClass().addClass('fa-regular fa-bookmark');
        } else {
            icon.removeClass().addClass('fa-solid fa-bookmark');
        }

        $.ajax({
            url: "{{ route('lowongan_tersimpan.save', ['id' => ':id']) }}".replace(':id', e.attr('data-id')),
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: (response) => {
                loadData();
            },
            error: (xhr, status, error) => {
                let res = xhr.responseJSON;
                showSweetAlert({
                    title: 'Gagal!',
                    text: res.message,
                    icon: 'error'
                });
            },
        });
    }
</script>
@endsection