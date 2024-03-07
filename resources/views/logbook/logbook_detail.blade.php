@extends('partials_mahasiswa.template')

@section('page_style')
<link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
<link rel="stylesheet" href="{{ url('../../app-assets/css/yearpicker.css') }}" />
<style>
    .btn-success {
        color: #fff;
        background-color: #4EA971 !important;
        border-color: #4EA971 !important;
    }
</style>
@endsection

@section('main')
<div class="container-xxl flex-grow-1 container-p-y">
    <a href="/logbook" type="button" class="btn btn-outline-success mt-4 mb-3 waves-effect">
        <span class="ti ti-arrow-left me-2"></span>Kembali
    </a>
    <div class="col-md-10 col-12">
        <h4 class="fw-bold"> <span class="text-muted fw-light text-xs">Kegiatan Saya / </span> Logbook Mahasiswa - Periode 20-25 Januari 2024</h4>
    </div>
    <div class="col-12">
        <div class="card mb-4 ">
            <div class="user-profile-header-banner">
                <img src="../assets/logbookbg.png" alt="Banner image" class="rounded-top" width="100%" style="height: 129px !important;" />
            </div>
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4" style="justify-content: space-between !important;">
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

                <div class="mt-3">
                    <div class="card-body" style="width: 400px !important; ">
                        <div class="text-light row small fw-semibold">
                            <div class="col-6"> Kelengkapan Logbook</div>
                            <div class="col-6 text-end">75%</div>
                        </div>
                        <div class="demo-vertical-spacing text-end">
                            <div class="progress text-end">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-3" style="padding-left: 10px; padding-right:10px;">
            <div class="text-center" style="border: 1px solid #D3D6DB; border-radius: 6px; padding: 20px;  height: fit-content !important; background-color:white">
                <div class="d-flex">
                <span class="badge bg-label-warning mb-2">Belum Disetujui</span>
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
                        <img src="../assets/images/sad.png" alt="">
                    </div>
                    <div class="text-center" style=" margin-left: 5px; ">
                        <p>Selasa</p><img src="../assets/images/jutek.png" alt="">
                    </div>
                    <div class="text-center" style=" margin-left: 5px; ">
                        <p>Rabu</p><img src="../assets/images/kyaa.png" alt="">
                    </div>
                    <div class="text-center" style=" margin-left: 5px; ">
                        <p>kamis</p>
                        <img src="../assets/images/love.png" alt="">
                    </div>
                    <div class=" text-center" style=" margin-left: 5px; ">
                        <p>Jumat</p>
                        <img src="../assets/images/smile.png" alt="">
                    </div>
                </div>
            </div>
            <!-- <div class="fw-bold mt-3" style="border: 1px solid #D3D6DB; border-radius: 6px; padding: 20px;height: fit-content !important; background-color:white;">
                <p>Alasan penolakan logbook :</p>
                <p class="fw-normal">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Neque
                    dignissimos adipisci
                    debitis quam consequatur totam molestias magnam excepturi nihil officia, minus ipsam?
                    Adipisci eum quibusdam fugiat aliquid consequuntur sed.</p>
            </div> -->
        </div>
        <div class="col-9">
            <div class="ps-4 mb-4" style="border: 1px solid #D3D6DB; border-radius: 6px; background-color:white;">
                <div class="d-flex justify-content-between mt-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-pill d-flex flex-column align-items-center justify-content-center" style="background-color: #C4E2D0; width: 70px; height: 70px; ">
                            <img src="../assets/images/smile.png" alt="">
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Senin</h6>
                            <p class="fw-normal mb-0">2 Januari 2023</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between" style="margin-right: 25px;">
                        <a class='btn-icon text-warning waves-effect waves-light' data-bs-toggle='modal' data-bs-target='#modalEditJadwal'><i class='ti ti-edit ti-md'></i></a>
                    </div>
                </div>
                <p style="color: #B6BAC3; margin-top: 15px;">Kamu melakukan Pekerjaan Apa Hari Ini ?</p>
                <div class="text-block">
                    <p class="mb-2">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in. Suspendisse blandit maximus mauris, vitae pharetra risus gravida eu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in.
                        <span class="ellipsis">...</span>
                        <span class="content-new" style="display: none;"> Suspendisse blandit maximus mauris, vitae pharetra risus gravida eu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in.</span>
                        <a class="show_hide_new cursor-pointer" style="color:#4EA971">Show More</a>
                    </p>
                </div>
            </div>

            <div class="ps-4 mb-4" style="border: 1px solid #D3D6DB; border-radius: 6px; background-color:white;">
                <div class="d-flex justify-content-between mt-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-pill d-flex flex-column align-items-center justify-content-center" style="background-color: #C4E2D0; width: 70px; height: 70px;">
                            <img src="../assets/images/smile.png" alt="">
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Selasa</h6>
                            <p class="fw-normal mb-0">2 Januari 2023</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between" style="margin-right: 25px;">
                        <a class='btn-icon text-warning waves-effect waves-light' data-bs-toggle='modal' data-bs-target='#modalEditJadwal'><i class='ti ti-edit ti-md'></i></a>
                    </div>
                </div>
                <p style="color: #B6BAC3; margin-top: 15px;">Kamu melakukan Pekerjaan Apa Hari Ini ?</p>
                <div class="text-block">
                    <p class="mb-2">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in. Suspendisse blandit maximus mauris, vitae pharetra risus gravida eu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in.
                        <span class="ellipsis">...</span>
                        <span class="content-new" style="display: none;"> Suspendisse blandit maximus mauris, vitae pharetra risus gravida eu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in.</span>
                        <a class="show_hide_new cursor-pointer" style="color:#4EA971">Show More</a>
                    </p>
                </div>
            </div>

            <div class="ps-4 mb-4" style="border: 1px solid #D3D6DB; border-radius: 6px; background-color:white;">
                <div class="d-flex justify-content-between mt-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-pill d-flex flex-column align-items-center justify-content-center" style="background-color: #C4E2D0; width: 70px; height: 70px;">
                            <img src="../assets/images/smile.png" alt="">
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Rabu</h6>
                            <p class="fw-normal mb-0">2 Januari 2023</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between" style="margin-right: 25px;">
                        <a class='btn-icon text-warning waves-effect waves-light' data-bs-toggle='modal' data-bs-target='#modalEditJadwal'><i class='ti ti-edit ti-md'></i></a>
                    </div>
                </div>
                <p style="color:#B6BAC3; margin-top: 15px;">Kamu melakukan Pekerjaan Apa Hari Ini ?</p>
                <div class="text-block">
                    <p class="mb-2">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in. Suspendisse blandit maximus mauris, vitae pharetra risus gravida eu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in.
                        <span class="ellipsis">...</span>
                        <span class="content-new" style="display: none;"> Suspendisse blandit maximus mauris, vitae pharetra risus gravida eu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque iaculis lacinia erat in auctor. In venenatis nisl vel nisl laoreet, in feugiat nibh tincidunt. Donec fermentum interdum nunc, ac viverra tellus molestie in.</span>
                        <a class="show_hide_new cursor-pointer" style="color:#4EA971">Show More</a>
                    </p>
                </div>
            </div>

            <div class="ps-4 mb-4 pe-4" style="border: 1px solid #D3D6DB; border-radius: 6px; background-color:white;">
                <div class="d-flex justify-content-between mt-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-pill d-flex flex-column align-items-center justify-content-center" style="background-color: #070A0F80; width: 70px; height: 70px;">
                            <img src="../assets/images/smile.png" alt="" style="filter: grayscale(80%) opacity(50%);">
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Kamis</h6>
                            <p class="fw-normal mb-0">2 Januari 2023</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a class='btn-icon text-warning waves-effect waves-light' data-bs-toggle='modal' data-bs-target='#modalEditJadwal'><i class='ti ti-edit ti-md'></i></a>
                    </div>
                </div>
                <hr>
                <div class="text-center" style="padding: 20px; margin-bottom: 30px !important;">
                    <button data-bs-toggle='modal' data-bs-target='#modalEditJadwal' type="button" class="btn btn-success">Buat Laporan Harian</button>
                </div>
            </div>

            <div class="ps-4 mb-4 pe-4" style="border: 1px solid #D3D6DB; border-radius: 6px; background-color:white;">
                <div class="d-flex justify-content-between mt-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-pill d-flex flex-column align-items-center justify-content-center" style="background-color: #070A0F80; width: 70px; height: 70px;">
                            <img src="../assets/images/smile.png" alt="" style="filter: grayscale(80%) opacity(50%);">
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Jumat</h6>
                            <p class="fw-normal mb-0">2 Januari 2023</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a class='btn-icon text-warning waves-effect waves-light' data-bs-toggle='modal' data-bs-target='#modalEditJadwal'><i class='ti ti-edit ti-md'></i></a>
                    </div>
                </div>
                <hr>
                <div class="text-center" style=" border-radius: 0 0 6px 6px; padding: 20px; margin-bottom: 30px !important;">
                    <button data-bs-toggle='modal' data-bs-target='#modalEditJadwal' type="button" class="btn btn-secondary">Buat
                        Laporan Harian</button>
                </div>
            </div>
            <!-- <div class="mt-4">
                <button type="button" class="btn btn-success" style="width: 1035px;">Ajukan Logbook</button>
            </div> -->
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="modalEditJadwal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-block">
                <h4 class="modal-title text-center" id="modal-title">Laporan Harian Magang </h4>
                <h6 class="modal-title text-center" id="modal-title">Kamis, 23 Januari 2023 </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="desc" class="form-label">Kamu melakukan pekerjan apa hari ini?</label>
                    <textarea type="text" class="form-control" id="desc" placeholder="Tulis Disini"></textarea>
                </div>
                <div class="mt-4">
                    <label for="mood" class="form-label">Silahkan pilih mood anda pada hari ini :</label>
                    <div class="d-flex mt-1">
                        <div class="text-center">
                            <img id="imageOne" src="../app-assets/img/emot/happy.png" data-original-src="../app-assets/img/emot/happy.png" data-selected-src="../app-assets/img/emot/happy1.png" onclick="changeImage('imageOne')" style="cursor: pointer;" />
                        </div>
                        <div class="text-center">
                            <img id="imageTwo" src="../app-assets/img/emot/love.png" data-original-src="../app-assets/img/emot/love.png" data-selected-src="../app-assets/img/emot/love1.png" onclick="changeImage('imageTwo')" style="cursor: pointer;" />
                        </div>
                        <div class="text-center">
                            <img id="imageThree" src="../app-assets/img/emot/sad.png" data-original-src="../app-assets/img/emot/sad.png" data-selected-src="../app-assets/img/emot/sad1.png" onclick="changeImage('imageThree')" style="cursor: pointer;" />
                        </div>
                        <div class="text-center">
                            <img id="imageFour" src="../app-assets/img/emot/frustasi.png" data-original-src="../app-assets/img/emot/frustasi.png" data-selected-src="../app-assets/img/emot/frustasi1.png" onclick="changeImage('imageFour')" style="cursor: pointer;" />
                        </div>
                        <div class="text-center">
                            <img id="imageFive" src="../app-assets/img/emot/datar.png" data-original-src="../app-assets/img/emot/datar.png" data-selected-src="../app-assets/img/emot/datar1.png" onclick="changeImage('imageFive')" style="cursor: pointer;" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalalert" data-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_script')
<script src="{{ url('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ url('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
<script src="{{ url('app-assets/js/yearpicker.js') }}"></script>
<script>
    var lastSelectedImage = null;

    function changeImage(imageId) {
        var image = document.getElementById(imageId);


        if (lastSelectedImage && lastSelectedImage !== image) {
            lastSelectedImage.src = lastSelectedImage.getAttribute('data-original-src');
        }


        if (image.getAttribute('src') === image.getAttribute('data-original-src')) {
            image.src = image.getAttribute('data-selected-src');
        } else {
            image.src = image.getAttribute('data-original-src');
        }

        lastSelectedImage = image;
    }

    $(document).ready(function() {
        $(".show_hide_new").on("click", function() {
            var content = $(this).siblings('.content-new');
            var ellipsis = $(this).siblings('.ellipsis');

            content.slideToggle(100);
            ellipsis.toggle(); // Menyembunyikan/menampilkan titik tiga

            if ($(this).text().trim() == "Show More") {
                $(this).text("Show Less");
            } else {
                $(this).text("Show More");
            }
        });
    });
</script>
@endsection