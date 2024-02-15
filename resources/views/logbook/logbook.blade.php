@extends('partials_mahasiswa.template')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="{{ url('../../app-assets/css/yearpicker.css') }}" />


@section('main')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-md-10 col-12 mb-4">
            <h4 class="fw-bold"> <span class="text-muted fw-light text-xs">Kegiatan Saya / </span> Logbook Mahasiswa</h4>
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="../assets/logbookbg.png" alt="Banner image" class="rounded-top" width="100%"
                        style="height: 129px; !important" />
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4"
                    style="justify-content: space-between; !important">
                    <div class="flex-shrink-0 mt-n5 mx-sm-0 mx-auto ms-0 ms-sm-5">
                        <div class="card" style="width: 12,5rem;">
                            <div class="card-body">
                                <img src="../assets/images/wings.png" alt="user image"
                                    class="d-block h-auto rounded user-profile-img" />
                            </div>
                        </div>
                        <div style="margin-top: 24px;">
                            <h4>Human Resources</h4>
                            <ul
                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                <li class="list-inline-item">PT. Wings Surya</li>
                            </ul>
                        </div>
                    </div>


                    <div class="mt-3 mt-sm-5">
                        <div class="card-body" style="width: 400px !important; ">
                            <div class="text-light row small fw-semibold">
                                <div class="col-6"> Kelengkapan Logbook</div>
                                <div class="col-6 text-end">75%</div>
                            </div>
                            <div class="demo-vertical-spacing text-end">
                                <div class="progress text-end">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="ms-4 me-4" style=" display: flex; justify-content: space-between; !important">
                    <h4>Laporan Bulanan</h4>
                    <select class="select2 form-select" data-placeholder="Pilih Tahun Ajaran">
                        <option value="1">2023/2024 Genap</option>
                        <option value="2">2023/2024 Ganjil</option>
                        <option value="3">2022/2023 Genap</option>
                        <option value="4">2022/2023 Ganjil</option>
                        <option value="5">2021/2022 Genap</option>
                        <option value="6">2021/2022 Ganjil</option>
                    </select>
                </div>

                <div class="ms-4 me-4"
                    style="display: flex; justify-content: space-between; border: 1px solid #D3D6DB; padding: 10px 30px; margin-bottom: 20px; border-radius: 6px; ">
                    <div>
                        <span class="badge bg-label-warning">Warning</span>
                        <h5>20 - 25 Januari 2023</h5>
                        <p>Minggu ke - 1</p>
                    </div>

                    <div style="display: flex; !important">
                        <div class="text-center" style="margin-top: 120px; margin-bottom: 30px">
                            <a href="/logbook-detail" class="btn btn-success active" role="button"
                                style="margin-bottom: 14px">Lengkapi Logbook Mahasiswa</a>
                            <p>Laporan mingguan dapat terkirim ketika laporan harian sudah dilengkapi secara keseluruhan</p>
                        </div>
                        <div class="text-center" style=" margin-left: 20px; ">
                            <p>Senin</p>
                            <img src="../assets/images/smile.png" alt="">
                        </div>
                        <div class="text-center" style=" margin-left: 20px; ">
                            <p>Selasa</p>
                            <img src="../assets/images/love.png" alt="">
                        </div>
                        <div class="text-center" style=" margin-left: 20px; ">
                            <p>Rabu</p>
                            <img src="../assets/images/sad.png" alt="">
                        </div>
                        <div class="text-center" style=" margin-left: 20px; ">
                            <p>kamis</p>
                            <img src="../assets/images/kyaa.png" alt="">
                        </div>
                        <div class="text-center" style=" margin-left: 20px; ">
                            <p>Jumat</p>
                            <img src="../assets/images/jutek.png" alt="">
                        </div>
                    </div>
                </div>

                <div class="ms-4 me-4"
                    style="display: flex; justify-content: space-between; border: 1px solid #D3D6DB; padding: 10px 30px; margin-bottom: 20px; border-radius: 6px; ">
                    <div>
                        <span class="badge bg-label-success">Disetujui</span>
                        <h5>20 - 25 Januari 2023</h5>
                        <p>Minggu ke - 1</p>
                    </div>

                    <div style="display: flex; !important">
                        <div class="text-center" style="margin-top: 120px; margin-bottom: 30px">
                            <a href="/logbook-detail" class="btn btn-success active" role="button"
                                style="margin-bottom: 14px">Lengkapi Logbook Mahasiswa</a>
                            <p>Laporan mingguan dapat terkirim ketika laporan harian sudah dilengkapi secara keseluruhan</p>
                        </div>
                        <div class="text-center" style=" margin-left: 20px; ">
                            <p>Senin</p>
                            <img src="../assets/images/smile.png" alt="">
                        </div>
                        <div class="text-center" style=" margin-left: 20px; ">
                            <p>Selasa</p>
                            <img src="../assets/images/love.png" alt="">
                        </div>
                        <div class="text-center" style=" margin-left: 20px; ">
                            <p>Rabu</p>
                            <img src="../assets/images/sad.png" alt="">
                        </div>
                        <div class="text-center" style=" margin-left: 20px; ">
                            <p>kamis</p>
                            <img src="../assets/images/kyaa.png" alt="">
                        </div>
                        <div class="text-center" style=" margin-left: 20px; ">
                            <p>Jumat</p>
                            <img src="../assets/images/jutek.png" alt="">
                        </div>
                    </div>
                </div>


                <div class="ms-4 me-4"
                    style="display: flex; justify-content: space-between; border: 1px solid #D3D6DB; padding: 10px 30px; margin-bottom: 20px; border-radius: 6px; ">
                    <div>
                        <span class="badge bg-label-danger">Ditolak</span>
                        <h5>20 - 25 Januari 2023</h5>
                        <p>Minggu ke - 1</p>
                    </div>

                    <div style="display: flex; !important">
                        <div class="text-center" style="margin-top: 120px; margin-bottom: 30px">
                            <a href="/logbook-detail" class="btn btn-outline-danger active" role="button"
                                style="margin-bottom: 14px">Perbaiki Logbook Mahasiswa</a>
                            <p>Laporan mingguan dapat terkirim ketika laporan harian sudah dilengkapi secara keseluruhan</p>
                        </div>
                        <div class="text-center" style=" margin-left: 20px; ">
                            <p>Senin</p>
                            <img src="../assets/images/smile.png" alt="">
                        </div>
                        <div class="text-center" style=" margin-left: 20px; ">
                            <p>Selasa</p>
                            <img src="../assets/images/love.png" alt="">
                        </div>
                        <div class="text-center" style=" margin-left: 20px; ">
                            <p>Rabu</p>
                            <img src="../assets/images/sad.png" alt="">
                        </div>
                        <div class="text-center" style=" margin-left: 20px; ">
                            <p>kamis</p>
                            <img src="../assets/images/kyaa.png" alt="">
                        </div>
                        <div class="text-center" style=" margin-left: 20px; ">
                            <p>Jumat</p>
                            <img src="../assets/images/jutek.png" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
<!-- Modal -->



@endsection

@section('page_script')
<script>
    $("#modal-mahasiswa").on("hide.bs.modal", function() {

        $("#modal-title").html("Tambah Prodi");
        $("#modal-button").html("Save Data");
        $('#modal-mahasiswa form #pilihuniversitas_add').val('').trigger('change');
        $('#modal-mahasiswa form #pilihfakultas_add').val('').trigger('change');
        $('#modal-mahasiswa form #pilihprodi_add').val('').trigger('change');
    });
    $(document).on('submit', '#filter', function(e) {
        const offcanvasFilter = $('#modalSlide');
        e.preventDefault();
        table_master_mahasiswa();
        $('#tooltip-filter').attr('data-bs-original-title', 'Universitas: ' + $('#univ :selected').text() +
            ', Fakultas: ' + $('#fakultas :selected').text() + ', Prodi: ' + $('#prodi :selected').text());
        offcanvasFilter.offcanvas('hide');
    });

    $('.data-reset').on('click', function() {
        $('#univ').val(null).trigger('change');
        $('#fakultas').val(null).trigger('change');
        $('#prodi').val(null).trigger('change');
    });



    $(document).ready(function() {
        $(".yearpicker").yearpicker({
            startYear: new Date().getFullYear() - 10,
            endYear: new Date().getFullYear() + 10,
        });
    });
</script>

<script src="{{ url('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ url('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
<script src="{{ url('app-assets/js/yearpicker.js') }}"></script>
@endsection
