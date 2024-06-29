@extends('partials.vertical_menu')

@section('page_style')
<style>
    .tooltip-inner {
        min-width: 100%;
        max-width: 100%;
    }

    .position-relative {
        padding-right: 15px;
        padding-left: 15px;
    }

    h6,
    .h6 {
        font-size: 0.9375rem;
        margin-bottom: 0px;
    }

    #more {
        display: none;
    }
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-12">
            <h4 class="fw-bold">Kelola Lowongan-Tahun Ajaran 21/10/2023 - 10/11/2023</h4>
        </div>
        <div class="col-md-3 col-12 mb-3 ps-5 d-flex align-items-center justify-content-between">
            <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
                <option value="1">2023/2024 Genap</option>
                <option value="2">2023/2024 Ganjil</option>
                <option value="3">2022/2023 Genap</option>
                <option value="4">2022/2023 Ganjil</option>
                <option value="5">2021/2022 Genap</option>
                <option value="6">2021/2022 Ganjil</option>
            </select>
            <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#modalSlide"><i class="tf-icons ti ti-filter"></i></button>
        </div>
    </div>

    <div class="col-12">
        <div class="nav-align-top">
            <ul class="nav nav-pills mb-1" role="tablist">
                <li class="nav-item" style="font-size: small;">
                    <button type="button" class="nav-link active" target="2" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tertunda" aria-controls="navs-pills-justified-tertunda" aria-selected="false" style="padding: 8px 9px;">
                        <i class="tf-icons ti ti-clock ti-clock me-1"></i> Tertunda
                    </button>
                </li>
                <li class="nav-item" style="font-size: small;">
                    <button type="button" class="nav-link" target="3" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-diterima" aria-controls="navs-pills-justified-diterima" aria-selected="false" style="padding: 8px 9px;">
                        <i class="tf-icons ti ti-clipboard-check ti-clipboard-check me-1"></i> Disetujui
                    </button>
                </li>
                <li class="nav-item" style="font-size: small;">
                    <button type="button" class="nav-link" target="4" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-ditolak" aria-controls="navs-pills-justified-ditolak" aria-selected="false" style="padding: 8px 9px;">
                        <i class="tf-icons ti ti-clipboard-x ti-clipboard-x me-1"></i> Ditolak
                    </button>
                </li>
            </ul>
        </div>

        <div class="row my-4">
            <div class="col-md-8 col-12">
                <div class="text-secondary">Filter Berdasarkan : <i class='tf-icons ti ti-alert-circle text-primary pb-1' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Durasi Magang : -, Posisi Lowongan Magang : -, Status Lowongan Magang : -" id="tooltip-filter"></i></div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="tab-content p-0">
            @foreach (['tertunda', 'diterima', 'ditolak'] as $tableId)
            <div class="tab-pane fade show {{ $loop->iteration == 1 ? 'active' : '' }}" id="navs-pills-justified-{{ $tableId }}" role="tabpanel">
                <div class="card">
                    <div class="row mt-3 ms-4">
                        <div class="col-6 d-flex align-items-center" style="border: 1px solid #D3D6DB; max-width:280px; height:40px;border-radius:8px;">
                            <span class="badge badge-center bg-label-primary me-2"><i class="ti ti-briefcase"></i></span>Total Lowongan:</span>&nbsp;<span id="total_{{ $tableId }}" style="color:#7367F0;">0</span>&nbsp;<span style="color:#4EA971;"> Lowongan </span>
                        </div>
                    </div>
                    <div class="card-datatable table-responsive">
                        <table class="table tab1c" id="{{ $tableId }}" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">No</th>
                                    <th>PERUSAHAAN</th>
                                    <th style="">POSISI</th>
                                    <th style="">Fakultas</th>
                                    <th style="">Program Studi</th>
                                    <th style="">TANGGAL</th>
                                    <th style="">DURASI MAGANG</th>
                                    <th style="text-align:center;">AKSI</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @include('lowongan_magang/kelola_lowongan_magang_admin/modal')
@endsection


@section('page_script')
<script>
    $('.table').each(function() {
        let idElement = $(this).attr('id');

        if (idElement == undefined) return;

        let url = "{{ route('lowongan.kelola.show') }}?type=" + idElement;

        $(this).DataTable({
            ajax: url,
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            scrollX: true,
            drawCallback: function( settings, json ) {
                let total = this.api().data().count();
                $('#total_' + idElement).text(total);
            },
            columns: [
                {
                    data: "DT_RowIndex"
                },
                {
                    data: 'industri.namaindustri',
                    name: 'namaindustri',

                },
                {
                    data: "intern_position",
                    name: "intern_position"
                },
                {
                    data: null,
                    name: "fakultas"
                },
                {
                    data: 'prodi',
                    name: "program_studi"
                },
                {
                    data: "tanggal",
                    name: "tanggal"
                },
                {
                    data: "durasimagang",
                    name: "durasimagang"
                },
                {
                    data: "action",
                    name: "action"
                }
            ],
        });

    });

    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
    });

    $("#modalTambahLowongan").on("hide.bs.modal", function() {

        $("#modal-title").html("Tambah Lowongan Magang");
        $("#modal-button").html("Save Data");
        $('#modalTambahLowongan form #tahun').val('').trigger('change');
        $('#modalTambahLowongan form #jenismagang').val('').trigger('change');
    });

    function edit(e) {
        let id = e.attr('data-id');
        console.log(id);

        let action = `{{ url('kelola/lowongan/lkm/update/') }}/${id}`;
        var url = `{{ url('kelola/lowongan/lkm/edit/') }}/${id}`;
        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                $("#modal-title").html("Edit Lowongan Mangang");
                $("#modal-button").html("Update Data")
                $('#modalTambahLowongan form').attr('action', action);
                $('#jenismagang').val(response.id_jenismagang).change();
                $('#posisi').val(response.intern_position);
                $('#kuota').val(response.kuota);
                $('#deskripsi').val(response.deskripsi);
                $('#kualifikasi').val(response.requirements);
                $('#jenis').val(response.gender);
                $('#jenjang').val(response.jenjang);
                $('#keterampilan').val(response.keterampilan);
                $('#gaji').val(response.paid);
                $('#nominal').val(response.nominal_salary);
                $('#benefit').val(response.benefitmagang);
                $('#lokasi').val(response.id_lokasi).change();
                $('#tanggal').val(response.startdate);
                $('#tanggalakhir').val(response.enddate);
                $('#durasimagang').val(response.durasimagang);
                $('#tahapan').val(response.tahapan_seleksi);
                $('#deskripsiseleksi[]').val(response.deskripsi);
                $('#mulai[]').val(response.tgl_mulai);
                $('#akhir[]').val(response.tgl_akhir);
                $('#prodi').val(response.id_prodi);
                $('#fakultas').val(response.id_fakultas);

                $('#modalTambahLowongan').modal('show');
            }
        });
    }

    $(document).ready(function() {});

    $(document).on('submit', '#filter', function(e) {
        const offcanvasFilter = $('#modalSlide');
        e.preventDefault();
        $('#tooltip-filter').attr('data-bs-original-title', 'durasimagang: ' + $('#durasimagang :selected')
            .text() + ', posisilowongan: ' + $('#posisi :selected').text() + ', statuslowongan: ' + $(
                '#status :selected').text());
        offcanvasFilter.offcanvas('hide');
    });

    $('.data-reset').on('click', function() {
        $('#durasimagang').val(null).trigger('change');
        $('#posisi').val(null).trigger('change');
        $('#status').val(null).trigger('change');
    });
</script>
@endsection