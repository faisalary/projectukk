@extends('partials.horizontal_menu')

@section('page_style')
<style>

</style>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <a href="{{ $urlBack }}" class="btn btn-outline-primary mt-2 mb-3 waves-effect text-primary">
        <span class="ti ti-arrow-left me-2"></span>Kembali
    </a>
    <div class="col-md-10 col-12">
        <h4 class="fw-bold"> <span class="text-muted fw-light text-xs">Daftar Mitra / </span> Detail Mitra </h4>
    </div>

    <div class="card mb-5">
        <div class="card-body"> 
            <div class="d-flex justify-content-between">
                <div class="d-flex justify-content-start">
                    <div class="text-center" style="overflow: hidden; width: 100px; height: 100px;">
                        @if ($detail->image)
                        <img src="{{ asset('storage/'. $detail->image) }}" alt="user-avatar" class="d-block" width="100">
                        @else
                        <img src="{{ asset('app-assets/img/avatars/building.png') }}" alt="user-avatar" class="d-block" width="100">
                        @endif
                    </div>
                    <div class="d-flex flex-column justify-content-center ms-3">
                        <h4 class="mb-1">{{ $detail->namaindustri }}</h4>
                        <span>{{ $detail->kategori_industri }}</span>
                    </div>
                </div>
                <div class="">
                    <button type="button" class="btn btn-outline-dark waves-effect me-3" onclick="changeColor(this)" data-bs-toggle="modal" data-bs-target="#modalbagikan" data-bs-placement="bottom" data-bs-original-title="Bagikan">
                        <i class="ti ti-share me-1"></i>Bagikan
                    </button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4">
                    <h6 class="mb-0">Alamat Perusahaan</h6>
                    <p>{{$detail->alamatindustri ?? '-'}}</p>
                </div>
                <div class="col-4">
                    <h6 class="mb-0">Email</h6>
                    <p>{{$detail->email ?? '-'}}</p>
                </div>
                <div class="col-4">
                    <h6 class="mb-0">Phone</h6>
                    <p>+{{$detail->notelpon ?? '-'}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-5">
        <div class="card-body">
            <div class="border-bottom mt-1">
                <h4> Tentang Perusahaan</h4>
            </div>
            <p class="mt-3">{!! ($detail->description) ? nl2br($detail->description) : '-' !!}</p>
        </div>
    </div>

    <div class="card" style="background-color: #f8f7fa;">
        <div class="card-header p-3" style="background-color: #23314B;">
            <div class="row">
                <div class="col-6 my-auto">
                    <h4 class="ps-2 mb-0" style="color: #FFFFFF;">Lowongan Tersedia di Perusahaan</h4>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-9 my-auto">
                            <div class="input-group input-group-merge ">
                                <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                                <input type="text" id="name_lowongan" class="form-control" placeholder="Lowongan Pekerjaan">
                            </div>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="filter();" style="height: 47px;">Cari Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body mt-3" id="container-lowongan"></div>
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end mb-0 mt-3" id="container-pagination">
            @include('perusahaan/components/pagination')
        </ul>
    </nav>
    @include('perusahaan/components/modal_detail')
</div>

@endsection

@section('page_script')
<script>
    $(document).ready(function () {
        loadData();
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
        let name = $('#name_lowongan').val(); 
        dataFilter.name = name;
        loadData();
    }

    function loadData() {
        let url = `{{ route('daftar_perusahaan.detail' , ['id' => $detail->id_industri]) }}`;

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
</script>
@endsection