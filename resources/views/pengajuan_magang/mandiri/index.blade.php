@extends('partials_mahasiswa.template')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <style>

    </style>
@endsection

@section('page_style')
    <style>
        .hidden {
            display: none;
        }

        .page-item>.page-link.active {
            border-color: #4EA971 !important;
            background-color: #4EA971 !important;
            color: #fff;
        }

        .btn-success {
            color: #fff;
            background-color: #4EA971 !important;
            border-color: #4EA971 !important;
        }
    </style>
@endsection

@section('main')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-md-12 col-12 mt-3">
            <h4 class="fw-bold"><span class="text-muted fw-light">Layanan LKM /</span> Pengajuan Surat Pengantar Magang</h4>
        </div>

        {{-- Belum melakukan konfirmasi lowongan magang --}}
        @if (!in_array($nim, $mandiri_nim))
            <div id="container-card" class="mb-3">
                <div class="col-3 mt-3 ">
                    <img class="image" style="border-radius: 0%; margin-left: 400px; width:430px;"
                        src="{{ asset('front/assets/img/pengantar_magang.png') }}" alt="admin.upload">
                </div>
                <div class="sec-title mt-5 mb-4 text-center">
                    <h4>Anda belum mengajukan Surat Pengantar Magang</h4>
                </div>
            </div>
        @else
            {{-- Sudah melakukan konfirmasi lowongan magang --}}
            <div class="card mb-4" style="background-color: #f8f7fa;">
                <div class="card-header p-3" style="background-color: #23314B;">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="mb-0 ps-2" style="color: #FFFFFF;">Riwayat Pengajuan Surat Pengantar Magang</h4>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-9">
                                    <div class="input-group input-group-merge ">
                                        <span class="input-group-text" id="basic-addon-search31"><i
                                                class="ti ti-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Surat Pengantar Magang"
                                            aria-label="Search..." aria-describedby="basic-addon-search31">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <button type="button" class="btn btn-success waves-effect waves-light">Cari
                                        Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($mandiri as $item)
                    @if ($item->nim == $nim)
                        <div class="card-body mt-4">
                            @if ($item->statusapprove == 1)
                                <div class="row border-bottom">
                                    <div class="col-2">
                                        <figure class="image text-center" style="border-radius: 0%;"><img
                                                style="border-radius: 0%; width:100px;"
                                                src="{{ asset('front/assets/img/letter.png') }}" alt="admin.upload">
                                        </figure>
                                    </div>
                                    <div class="col-8">
                                        <h2>{{ $item->posisi_magang }}</h2>
                                        <p>{{ $item->nama_industri }}</p>
                                        <p>{{ $item->alamat_industri }}</p>
                                        <button type="button" class="card-link btn btn-success mb-3"
                                            href={{ asset('storage/format.xlsx') }}> Unduh Surat Disini
                                        </button>
                                    </div>
                                    <div class="col-2">
                                        <div class="text-end mt-3"><span class="badge bg-label-success">Disetujui</span>
                                        </div>
                                        <div class="text-end mt-3 mb-4" style="color: #0971B7;"><u class="cursor-pointer">
                                                <a data-id="{{ $item->id_pengajuan }}"
                                                    onclick="detailDisetujui($(this))">Lihat
                                                    Detail</a>
                                            </u><i class="ti ti-chevron-right mb-1"></i></div>

                                    </div>

                                </div>
                            @elseif($item->statusapprove == 0)
                                <div class="row border-bottom">
                                    <div class="col-2">
                                        <figure class="image text-center" style="border-radius: 0%;"><img
                                                style="border-radius: 0%; width:100px;"
                                                src="{{ asset('front/assets/img/letter.png') }}" alt="admin.upload">
                                        </figure>
                                    </div>
                                    <div class="col-8">
                                        <h2>{{ $item->posisi_magang }}</h2>
                                        <p>{{ $item->nama_industri }}</p>
                                        <p>{{ $item->alamat_industri }}</p>
                                    </div>
                                    <div class="col-2">

                                        <div class="text-end mt-3"><span class="badge bg-label-warning">Pending</span>
                                        </div>

                                    </div>
                                </div>
                            @else
                                <div class="row border-bottom mt-4">
                                    <div class="col-2">
                                        <figure class="image text-center" style="border-radius: 0%;"><img
                                                style="border-radius: 0%; width:100px;"
                                                src="{{ asset('front/assets/img/letter.png') }}" alt="admin.upload">
                                        </figure>
                                    </div>
                                    <div class="col-8">
                                        <h2>{{ $item->posisi_magang }}</h2>
                                        <p>{{ $item->nama_industri }}</p>
                                        <p>{{ $item->alamat_industri }}</p>
                                    </div>
                                    <div class="col-2">
                                        {{-- <div class="text-end ps-5"> <i class="ti ti-clock"> </i> 8 hari lalu</div> --}}
                                        <div class="text-end mt-3"><span class="badge bg-label-danger">Ditolak</span></div>
                                        <div class="text-end mt-3"><button type="button"
                                                class="btn btn-outline-danger waves-effect waves-light"
                                                data-id="{{ $item->id_pengajuan }}" onclick="edit($(this))"
                                                style="height:35px;">
                                                <i class="ti ti-edit mb-1 me-1"></i>
                                                Perbaiki Pengajuan</button></div>
                                        <div class="text-end mt-3 mb-4" style="color: #0971B7;"><u class="cursor-pointer"><a
                                                    data-id="{{ $item->id_pengajuan }}"
                                                    onclick="detailDitolak($(this))">Lihat
                                                    Detail</a></u><i class="ti ti-chevron-right mb-1"></i></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        @endif


        @include('pengajuan_magang.mandiri.modal')

        <div class="text-center">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAjukan">
                Ajukan Surat
            </button>
        </div>

    </div>
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="../../app-assets/js/forms-extras.js"></script>
    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
    <script>
        $("#modalAjukan").on("hide.bs.modal", function() {

            $('#modalAjukan form')[0].reset();
            $('#modalAjukan form').attr('action', "{{ url('pengajuan/surat/store') }}");
            $('.invalid-feedback').removeClass('d-block');
            $('.form-control').removeClass('is-invalid');
        });

        function detailDisetujui(e) {
            let id_pengajuan = e.attr("data-id");

            var url = `{{ url('pengajuan/surat/detail/') }}/${id_pengajuan}`;
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#nama_industri').text(response.nama_industri);
                    $('#posisi_magang').text(response.posisi_magang);
                    $('#jabatan').text(response.jabatan);
                    $('#nim').text(response.nim);
                    $('#email').text(response.email);
                    $('#nohp').text(response.nohp);
                    $('#date').text(response.startdate + '-' + response.enddate);
                    $('#alamat_industri').text(response.alamat_industri);

                    $('#modalDetailDisetujui').modal('show');
                }
            });
        }

        function detailDitolak(e) {
            let id_pengajuan = e.attr("data-id");

            var url = `{{ url('pengajuan/surat/detail/') }}/${id_pengajuan}`;
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#nama_industris').text(response.nama_industri);
                    $('#posisi_magangs').text(response.posisi_magang);
                    $('#jabatans').text(response.jabatan);
                    $('#nims').text(response.nim);
                    $('#emails').text(response.email);
                    $('#nohps').text(response.nohp);
                    $('#dates').text(response.startdate + '-' + response.enddate);
                    $('#alamat_industris').text(response.alamat_industri);
                    $('#alasans').text(response.alasan);
                    $('#modalDetailDitolak').modal('show');
                }
            });
        }

        function edit(e) {
            let id = e.attr('data-id');

            let action = `{{ url('pengajuan/surat/update/') }}/${id}`;
            var url = `{{ url('pengajuan/surat/edit/') }}/${id}`;
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    console.log(response);
                    $('#modalAjukan form').attr('action', action);
                    $('#tglpeng_').val(response.tglpeng).trigger('change');
                    $('#nama_industri_').val(response.nama_industri);
                    $('#posisi_magang_').val(response.posisi_magang);
                    $('#jabatan_').val(response.jabatan);
                    $('#nim_').val(response.nim);
                    $('#email_').val(response.email);
                    $('#nohp_').val(response.nohp);
                    $('#date_').val(response.startdate + '-' + response.enddate).trigger('change');
                    $('#alamat_industri_').val(response.alamat_industri);
                    $('#alasan_').val(response.alasan);

                    $('#modalAjukan').modal('show');
                }
            });
        }

        $(".flatpickr-date").flatpickr({
            altInput: true,
            altFormat: 'j F Y',
            dateFormat: 'Y-m-d'
        });
    </script>
@endsection
