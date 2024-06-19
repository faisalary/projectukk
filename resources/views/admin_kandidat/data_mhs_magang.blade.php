@extends('partials.vertical_menu')

@section('page_style')
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<link rel="stylesheet" href="{{ asset('app-assets/vendor/libs/tagify/tagify.css')}}" />
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: #4EA971;
    }

    .light-style .tagify__tag .tagify__tag-text {
        color: #4EA971 !important;
    }
</style>
@endsection

@section('content')
<div class="row pe-2 ps-2">
    <div class="col-md-9 col-12">
        <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs">Data Mahasiswa Magang / </span>
            Mahasiswa Magang Fakultas Tahun Ajaran 2023/2024
        </h4>
    </div>
    <div class="col-md-3 col-12 mb-3  d-flex align-items-center justify-content-between">
        <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
            <option value="1">2023/2024 Genap</option>
            <option value="2">2023/2024 Ganjil</option>
            <option value="3">2022/2023 Genap</option>
            <option value="4">2022/2023 Ganjil</option>
            <option value="5">2021/2022 Genap</option>
            <option value="6">2021/2022 Ganjil</option>
        </select>
        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide"><i class="tf-icons ti ti-filter"></i>
        </button>
    </div>

    <div class="nav-align-top">
        <div class="row">
            <div class="col-6">
                <ul class="nav nav-pills mb-3 " role="tablist">
                    <li class="nav-item" style="font-size: small;">
                        <button type="button" class="nav-link active showSingle" target="1" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-diterima" aria-controls="navs-pills-justified-diterima" aria-selected="false" style="padding: 8px 9px;">
                            <i class="tf-icons ti ti-user-check ti-xs me-1"></i> Diterima
                            <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;"></span>
                        </button>
                    </li>
                    <li class="nav-item" style="font-size: small;">
                        <button type="button" class="nav-link showSingle" target="0" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-ditolak" aria-controls="navs-pills-justified-ditolak" aria-selected="false" style="padding: 8px 9px;">
                            <i class="tf-icons ti ti-user-x ti-xs me-1"></i> Ditolak
                            <span class="badge rounded-pill badge-center h-px-20 w-px-20 ms-1" style="background-color: #DCEEE3; color: #4EA971;"></span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between mt-2">
                <p class="text-secondary">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Prodi:-, Jenis Magang:-" id="tooltip-filter"></i></p>
            </div>
        </div>
    </div>

    <div class="tab-content p-0">
        @foreach (['diterima', 'ditolak'] as $key => $item)
        <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="navs-pills-justified-{{ $item }}" role="tabpanel">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="table" id="{{ $item }}">
                        <thead>
                            <tr>
                                <th style="min-width: 50px;">NOMOR</th>
                                <th style="min-width: 150px;">NAMA/NIM</th>
                                <th style="min-width: 200px;">PROGRAM STUDI</th>
                                <th style="min-width: 200px;">JENIS MAGANG</th>
                                <th style="min-width: 200px;">NAMA PERUSAHAAN</th>
                                <th style="min-width: 150px;">POSISI MAGANG</th>
                                @if ($item == 'diterima')
                                <th style="min-width: 200px;">TANGGAL MAGANG</th>
                                <th style="min-width: 170px;">DOKUMEN</th>
                                <th style="min-width: 200px;">PEMBIMBING LAPANGAN</th>
                                <th style="min-width: 200px;">PEMBIMBING AKADEMIK</th>
                                <th style="min-width: 170px;">NILAI AKHIR</th>
                                <th style="min-width: 170px;">INDEKS NILAI</th>
                                @endif
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- FILTER -->
@include('admin_kandidat.filter_mhs_magang')
<!-- //FILTER -->

@endsection

@section('page_script')
<script>
    $(document).ready(function() {
        loadData();
    });

    $('.filter-reset').on('click', function() {
        $('#jenis').val(null).trigger('change');
        $('#prodi').val(null).trigger('change');
    });

    $(document).on('submit', '#filter', function(e) {
        const offcanvasFilter = $('#modalSlide');
        e.preventDefault();
        let prodi = $("#prodi option:selected").val();
        let jenis = $("#jenis option:selected").val();

        let data = {
            'prodi': prodi,
            'jenis': jenis
        };

        $('#tooltip-filter').attr('data-bs-original-title', 'Prodi: ' + $('#prodi :selected').text() + ', Jenis Magang: ' + $('#jenis :selected').text());
        offcanvasFilter.offcanvas('hide');
    });

    jQuery(function() {
        jQuery('.showSingle').click(function() {
            jQuery('.targetDiv').hide('.cnt');
            jQuery('#div' + $(this).attr('target')).slideToggle();
        });
    });

    function loadData() {
        $('.table').each(function () {

            let url = `{{ route('data_magang.show') }}?type=` + $(this).attr('id');
            let idElement = $(this).attr('id');

            let dataColumn = [{
                        data: "DT_RowIndex"
                    },
                    {
                        data: null,
                        name: 'combined_column',
                        render: function(data, type, row) {
                            return data.mahasiswa.namamhs + '<br>' + (data.mahasiswa.nim);
                        }
                    },
                    {
                        data: function(data, type, row) {
                            return data.mahasiswa.prodi.namaprodi;
                        },
                        name: 'prodi'
                    },
                    {
                        data: function(data, type, row) {
                            return data.lowongan_magang.jenis_magang.namajenis;
                        },
                        name: 'jenis_magang'
                    },
                    {
                        data: function(data, type, row) {
                            return data.lowongan_magang.industri.namaindustri;
                        },
                        name: 'nama_perusahaan'
                    },
                    {
                        data: function(data, type, row) {
                            return data.lowongan_magang.intern_position;
                        },
                        name: 'posisi_magang'
                    }];
            let columnDefs = [{
                        "width": "10px",
                        "targets": 0
                    },
                    {
                        "width": "170px",
                        "targets": 1
                    },
                    {
                        "width": "150px",
                        "targets": 2
                    },
                    {
                        "width": "150px",
                        "targets": 3
                    },
                    {
                        "width": "170px",
                        "targets": 4
                    },
                    {
                        "width": "170px",
                        "targets": 5
                    }];
            if (idElement == 'diterima') {
                dataColumn.push(
                    {data: 'tgl_magang', name: "tanggal_magang"},
                    {data: 'doc_terima', name: 'doc_magang'},
                    {
                        data: null,
                        name: 'pbb_lapangan',
                        render: function(data, type, row) {
                            if (data.mahasiswa_magang.id_peg_industri) {
                                return data.mahasiswa_magang.peg_industri.namapeg;
                            }
                            return '-';
                        },
                    },
                    {
                        data: null,
                        name: 'pbb_akademik',
                        render: function(data, type, row) {
                            if (data.mahasiswa_magang.nip) {
                                return data.mahasiswa_magang.dosen.namadosen + '<br>' + (data.mahasiswa_magang.dosen.nip);
                            }
                            return '-';
                        },
                    },
                    {
                        data: null,
                        name: 'nilai_akhir',
                        render: function(data, type, row) {
                            if (data.mahasiswa_magang.nilai_akhir_magang) {
                                return data.mahasiswa_magang.nilai_akhir_magang;
                            }
                            return '-';
                        },
                    },
                    {
                        data: null,
                        name: 'indeks_nilai',
                        render: function(data, type, row) {
                            if (data.mahasiswa_magang.indeks_nilai_akhir) {
                                return data.mahasiswa_magang.indeks_nilai_akhir;
                            }
                            return '-';
                        },
                    }
                );

                columnDefs.push(
                    {
                        "width": "200px",
                        "targets": 6
                    },
                    {
                        "width": "150px",
                        "targets": 7
                    },
                    {
                        "width": "200px",
                        "targets": 8
                    },
                    {
                        "width": "200px",
                        "targets": 9
                    },
                    {
                        "width": "170px",
                        "targets": 10
                    },
                    {
                        "width": "170px",
                        "targets": 11
                    }
                );
            }

            $(this).DataTable({
                ajax: {
                    url: url,
                    type: 'GET'
                },
                scrollX: true,
                processing: true,
                destroy: true,
                columns: dataColumn,
                columnDefs: columnDefs,
                });
        });
    }
</script>

<script src="{{ asset('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
<script src="{{ asset('app-assets/vendor/libs/tagify/tagify.js') }}"></script>
<script src="{{ asset('app-assets/js/forms-tagify.js') }}"></script>
@endsection