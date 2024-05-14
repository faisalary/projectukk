@extends('partials_admin.template')

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="../../app-assets/vendor/libs/tagify/tagify.css" />
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #4EA971;
        }

        .light-style .tagify__tag .tagify__tag-text {
            color: #4EA971 !important;
        }
    </style>
@endsection

@section('main')
    <div class="row mb-2">
        <div class="">
            <a href="/kelola/mahasiswa" type="button" class="btn btn-outline-success mb-3 waves-effect">
                <span class="ti ti-arrow-left me-2"></span>Kembali
            </a>
        </div>
        <div class="col-md-9 col-12">
            <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs">Kelola Mahasiswa/ </span>
                Input Nilai Mahasiswa
            </h4>
        </div>
        <div class="col-md-3 col-12 mb-3  d-flex align-items-center justify-content-between">
            <div></div>
            <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
                <option value="1">21/10/2023-10/11/2023</option>
            </select>
        </div>
    </div>
    <div class="card">
        <div class="card-body ">
            <div class="row ps-2 pe-2">
                <div class="card border mt-2">
                    <div class="card-datatable table-responsive">
                        <table class="table" id="table-input">
                            <thead>
                                <tr>
                                    <th>NOMOR</th>
                                    <th style="min-width:200px;">ASPEK PENILAIAN</th>
                                    <th style="min-width:200px;">DESKRIPSI ASPEK PENILAIAN</th>
                                    <th style="min-width:100px;">NILAI MAX</th>
                                    <th style="min-width:100px;">BOBOT NILAI</th>
                                    <th style="min-width:150px;">NILAI MAGANG</th>
                                </tr>
                            <tfoot>
                                <tr>
                                    <th class="text-center" colspan="5">TOTAL NILAI AKHIR MAGANG (Aspek 1 + Aspek 2 =
                                        100)</th>
                                    <th class=""><input type="text" id="" class="form-control"
                                            placeholder="85" style="max-width: 150px;" disabled /></th>
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="5">PREDIKAT INDEX NILAI AKHIR MAGANG</th>
                                    <th class=""><input type="text" id="" class="form-control"
                                            placeholder="A" style="max-width: 150px;" disabled /></th>
                                </tr>
                            </tfoot>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="mt-3 pe-0 text-end"><button type="submit" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#modalalert">Simpan</button></div>
            </div>
        </div>
    </div>

    <!-- Modal Alert-->
    <div class="modal fade" id="modalalert" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="../../app-assets/img/alert.png" alt="">
                    <h5 class="modal-title" id="modal-title">Apakah data yang anda input sudah benar?</h5>
                    <p>Harap pastikan bahwa data yang Anda input sudah benar!</p>
                </div>
                <div class="modal-footer" style="display: flex; justify-content:center;">
                    <button type="submit" id="modal-button" class="btn btn-success">Ya, yakin</button>
                    <button type="submit" id="modal-button" class="btn btn-danger">Batal</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="../../app-assets/js/forms-extras.js"></script>

    <script>
        var table = $('#table-input').DataTable({
            ajax: "{{ url('master/komponen-penilaian/show/1') }}",
            serverSide: false,
            processing: true,
            deferRender: true,
            type: 'GET',
            destroy: true,
            columns: [{
                    data: "DT_RowIndex"
                },
                {
                    data: 'aspek_penilaian',
                    name: 'aspek_penilaian'
                },
                {
                    data: 'deskripsi_penilaian',
                    name: 'deskripsi_penilaian'
                },
                {
                    data: 'nilai_max',
                    name: 'nilai_max',
                    render: function(data, type, row) {
                        return '0 - ' + row.nilai_max;
                    }
                },
                {
                    data: 'bobot',
                    name: 'bobot',
                    render: function(data, type, row) {
                        return row.bobot + '%';
                    }
                },
                {
                    data: ,
                    render: function(data, type, row) {
                        return "<input type='number' class='form-control' min='0' max='" + row.nilai_max +
                            "' placeholder='Input Disini' style='max-width: 150px;' />";
                    }
                }
            ],

        });

        $('#table-input').on('keyup', 'input', function() {
            var val = parseInt($(this).val());
            var max = parseInt($(this).attr('max'));

            val = isNaN(val) ? 0 : Math.max(Math.min(val, max), 0);
            $(this).val(val);
        });
    </script>

    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>
    <script src="../../app-assets/vendor/libs/tagify/tagify.js"></script>
    <script src="../../app-assets/js/forms-tagify.js"></script>
@endsection
