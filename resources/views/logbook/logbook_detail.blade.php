@extends('partials_mahasiswa.template')

@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="{{ url('../../app-assets/css/yearpicker.css') }}" />


@section('main')
    <div class="row m-1">
        <div class="col-md-10 col-12">
            <h4 class="fw-bold">Logbook Mahasiswa</h4>
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="../assets/profile-banner.png" alt="Banner image" class="rounded-top" width="100%"
                        style="height: 129px; !important" />
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4"
                    style="justify-content: space-between; !important">
                    <div class="flex-shrink-0 mt-n5 mx-sm-0 mx-auto ms-0 ms-sm-5">
                        <img src="../assets/14.png" alt="user image" class="d-block h-auto rounded user-profile-img" />
                        <div style="margin-top: 24px;">
                            <h4>Leonie Artaputri</h4>
                            <ul class="list-inline mb-0 align-items-center gap-2">
                                <li class="mb-2">6706213878 - D3 Teknologi Komputer</li>
                                <li>Universitas Telkom</li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-3 mt-sm-5 mx-sm-5">
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


                <div class="d-flex ms-0 ms-sm-5 mx-sm-5" style="justify-content: space-between;">
                    <div class="text-center"
                        style="border: 1px solid #D3D6DB; border-radius: 6px; padding: 20px; margin-right: 20px; height: fit-content !important">
                        <div class="d-flex">
                            <i class="ti ti-chevron-left"></i>
                            <p class="fw-bold">Kembali</p>
                        </div>
                        <div class="d-flex" style="color: #FF9F43">
                            <i class="ti ti-edit"></i>
                            <p>Belum Disetujui</p>
                        </div>
                        <div class="d-flex">
                            <h5>20 - 25 Januari 2023</h5>
                            <i class="ti ti-chevron-right"></i>
                        </div>
                        <div class="d-flex">
                            <p>Minggu ke - 1</p>
                        </div>
                        <div class="d-flex">
                            <div class="text-center">
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
                    <div>
                        <div
                            style="border: 1px solid #D3D6DB; border-radius: 6px; padding: 20px; margin-bottom: 30px; !important">
                            <div class="d-flex">
                                <div class="rounded-pill d-flex flex-column align-items-center justify-content-center"
                                    style="background-color: #C4E2D0; width: 70px; height: 70px;">
                                    <img src="../assets/images/smile.png" alt="">
                                </div>
                                <div class="fw-bold d-flex flex-column justify-content-center" style="margin-left: 12px">
                                    <div class="">
                                        <h6 class="mb-0">Senin</h6>
                                    </div>
                                    <div class="">
                                        <p class="fw-normal mb-0">2 Januari 2023</p>
                                    </div>
                                </div>
                            </div>
                            <p style="color: #B6BAC3; margin-top: 15px;">Kamu melakukan Pekerjaan Apa Hari Ini ?</p>
                            <p style="color: #23314B">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                                iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh
                                tincidunt.
                                Donec fermentum interdum nunc, ac viverra tellus molestie in. Suspendisse blandit maximus
                                mauris, vitae pharetra risus gravida eu. Lorem ipsum dolor sit amet, consectetur adipiscing
                                elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in
                                feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in.
                                Suspendisse blandit maximus mauris, vitae pharetra risus gravida eu. Lorem ipsum dolor sit
                                amet,
                                consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl
                                vel
                                nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus
                                molestie in....</p>
                        </div>
                        <div
                            style="border: 1px solid #D3D6DB; border-radius: 6px; padding: 20px; margin-bottom: 30px; !important">
                            <div class="d-flex">
                                <div class="rounded-pill d-flex flex-column align-items-center justify-content-center"
                                    style="background-color: #C4E2D0; width: 70px; height: 70px;">
                                    <img src="../assets/images/smile.png" alt="">
                                </div>
                                <div class="fw-bold d-flex flex-column justify-content-center" style="margin-left: 12px">
                                    <div class="">
                                        <h6 class="mb-0">Senin</h6>
                                    </div>
                                    <div class="">
                                        <p class="fw-normal mb-0">2 Januari 2023</p>
                                    </div>
                                </div>
                            </div>
                            <p style="color: #B6BAC3; margin-top: 15px;">Kamu melakukan Pekerjaan Apa Hari Ini ?</p>
                            <p style="color: #23314B">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                                iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh
                                tincidunt.
                                Donec fermentum interdum nunc, ac viverra tellus molestie in. Suspendisse blandit maximus
                                mauris, vitae pharetra risus gravida eu. Lorem ipsum dolor sit amet, consectetur adipiscing
                                elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in
                                feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in.
                                Suspendisse blandit maximus mauris, vitae pharetra risus gravida eu. Lorem ipsum dolor sit
                                amet,
                                consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl
                                vel
                                nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus
                                molestie in....</p>
                        </div>
                        <div>
                            <div style="border: 1px solid #D3D6DB; border-radius: 6px 6px 0 0; padding: 20px; !important">
                                <div class="d-flex">
                                    <div class="rounded-pill d-flex flex-column align-items-center justify-content-center"
                                        style="background-color: #070A0F80; width: 70px; height: 70px;">
                                        <img src="../assets/images/smile.png" alt=""
                                            style="filter: grayscale(100%) opacity(50%);">
                                    </div>
                                    <div class="fw-bold d-flex flex-column justify-content-center"
                                        style="margin-left: 12px">
                                        <div class="">
                                            <h6 class="mb-0">Senin</h6>
                                        </div>
                                        <div class="">
                                            <p class="fw-normal mb-0">2 Januari 2023</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center"
                                style="border-bottom: 1px solid #D3D6DB; border-right: 1px solid #D3D6DB; border-left: 1px solid #D3D6DB;  border-radius: 0 0 6px 6px; padding: 20px; margin-bottom: 30px; !important">
                                <button type="button" class="btn btn-success">Buat Laporan Harian</button>
                            </div>
                        </div>
                        <div>
                            <div style="border: 1px solid #D3D6DB; border-radius: 6px 6px 0 0; padding: 20px; !important">
                                <div class="d-flex">
                                    <div class="rounded-pill d-flex flex-column align-items-center justify-content-center"
                                        style="background-color: #070A0F80; width: 70px; height: 70px;">
                                        <img src="../assets/images/smile.png" alt=""
                                            style="filter: grayscale(100%) opacity(50%);">
                                    </div>

                                    <div class="fw-bold d-flex flex-column justify-content-center"
                                        style="margin-left: 12px">
                                        <div class="">
                                            <h6 class="mb-0">Senin</h6>
                                        </div>
                                        <div class="">
                                            <p class="fw-normal mb-0">2 Januari 2023</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center"
                                style="border-bottom: 1px solid #D3D6DB; border-right: 1px solid #D3D6DB; border-left: 1px solid #D3D6DB;  border-radius: 0 0 6px 6px; padding: 20px; margin-bottom: 30px; !important">
                                <button type="button" class="btn btn-secondary">Buat Laporan Harian</button>
                            </div>
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
