@extends('partials.horizontal_menu')

@section('page_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

@include('perusahaan/components/filter_lowongan')

{{-- Lowongn tidak ditemukan --}}
<!-- <div class="col-3 mt-5">
    <img class="image" style="border-radius: 0%; margin-left:465px;" src="{{ asset('front/assets/img/nodata.png')}}" alt="admin.upload">
</div>
<div class="sec-title mt-5 mb-4 text-center">
    <h4> Maaf, lowongan tidak di temukan</h4>
    <p> Silakan coba sesuaikan filter atau periksa kembali penulisan Anda</p>
</div> -->

<div class="container-xxl flex-grow-1 container-p-y bg-white">
      <div class="row mt-2 ps-4">
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
    function pagination(e) {
        url = e.attr('data-url');
        if (url == '') return;
        dataFilter.page = url.split('page=')[1];

        $('.page-item').removeClass('active');
        e.addClass('active');

        loadData();
    }

    function loadData() {
        let url = `{{ route('apply_lowongan') }}`;

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

        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                $('#container-detail-lowongan').html(response.data);
            }
        });
    }

    function detail_old(e) {
        let id = e.attr('data-id');
        var url = `{{ url('apply-lowongan/detail/') }}/${id}`; 

        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                var response2 = response.prodilowongan;
                var response1 = response.lowonganshow2;
                $('#namaindustri').text(response1.industri.namaindustri);
                $('#intern_position').text(response1.intern_position);
                $('#kuota').text(' ' + response1.kuota);
                $('#pelaksanaan').text(' ' + response1.pelaksanaan);
                $('#durasimagang').text(' ' + response1.durasimagang);
                $('#lokasi').text(' '+response1.lokasi);
                if(response1.nominal_salary !== null) {
                    $('#nominal_salary').text(response1.nominal_salary);
                    $('#nominal_salary').show(); 
                } else {
                    $('#nominal_salary').hide(); 
                }

                response2.forEach(function(lowongan){
                    $('#prodi-lowongan').text(' ' + lowongan.prodi.namaprodi);
                });
                $('#deskripsi').text(response1.deskripsi);
                $('#jenjang').text(' ' + response1.jenjang);   
                $('#btn-detail').click(function(e){
                    e.preventDefault(); 
                    var url = `{{ url('apply-lowongan/lamar/') }}/${id}`; 
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response1) {
                            window.location.href = url 
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
                var dateString = response1.enddate;
                var date = new Date(dateString);
                var tahun = date.getFullYear();
                var bulan = date.getMonth() + 1;
                var tanggal = ('0' + date.getDate()).slice(-2);
                var namaBulan = {
                    1: 'Januari',
                    2: 'Februari',
                    3: 'Maret',
                    4: 'April',
                    5: 'Mei',
                    6: 'Juni',
                    7: 'Juli',
                    8: 'Agustus',
                    9: 'September',
                    10: 'Oktober',
                    11: 'November',
                    12: 'Desember'
                };
                var namaBulanIndonesia = namaBulan[bulan];
                var tanggalBulanTahun = tanggal + ' ' + namaBulanIndonesia + ' ' + tahun;

                $('#batas_melamar').text('Batas Lamaran '+tanggalBulanTahun);
                $('#requirements').text(response1.requirements);
                $('#benefitmagang').text(response1.benefitmagang);
                $('#keterampilan').text(response1.keterampilan);
                $('#keterampilan').text(response1.keterampilan);
                $('#deskripsiperusahaan').text(response1.industri.description);
                // $('#prodi-lowongan').text(response1.prodilowongan.namaprodi);

                $('#image').html(`<img src="{{ asset('storage/${response1.industri.image}') }}" alt="user-avatar"
                                                style="max-width:120px; max-height: 125px"
                                                id="imgPreview" data-default-src="../../app-assets/img/avatars/14.png">`);

                $('#lowongan-terpilih').show();
                $('#tidak-ada-lowongan').hide();
            }   
            
        });
    }

</script>
<script>
    $(".checkbox-menu").on("change", "input[type='checkbox']", function() {
        $(this).closest("li").toggleClass("active", this.checked);
    });

    $(document).on('click', '.allow-focus', function(e) {
        e.stopPropagation();
    });

    function toggleDivVisibility(radio) {
        var x = document.getElementById("myDIV");
        if (radio.value === "berbayar") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }


    function myFunction(x) {
        x.classList.toggle("fa-bookmark-o");
        x.classList.toggle("fa-bookmark");
    }
</script>
@endsection