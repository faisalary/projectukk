@extends('partials_admin.template')

@section('page_style')
    <link rel="stylesheet" href="../../app-assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <style>
        .hide-me {
            display: none;
        }
    </style>
@endsection

@section('main')
    <a href="/kelola/lowongan" type="button" class="btn btn-outline-success mb-3 waves-effect">
        <span class="ti ti-arrow-left me-2"></span>Kembali
    </a>
    <div class="row ">
        <div class="">
            <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs">Lowongan Magang / Kelola Magang /
                </span>
                Detail Lowongan UI/UX Designer
            </h4>
        </div>
    </div>
    <div class="card" style="padding: 50px 30px; width: 100%; margin-right: 20px; !important">
        <div class="card-body" style=" border-bottom: 1px solid #D3D6DB;  !important">
            <div class="">
                <div class="row">
                    <div class="col-8">
                        <div class="d-flex items-center justify-content-start">
                            <img src="{{ asset('front/assets/img/icon_lowongan.png') }}" alt=""
                                style="width: 150px; height: 90px; !important">
                            <div class="ms-5">
                                <p class="fw-bolder text-black" style="font-size: 32px; color: #23314B">Human
                                    Resources
                                </p>
                                <p class="mt-n3" style="font-size: 18px; color: #4B465C">IT consultant</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-2 d-flex items-center justify-content-start">
                        <div class="w-auto">
                            <div class='text-center'>
                                <div class='badge bg-label-success' style="width: 180px">Disetujui</div>
                            </div>
                            <p class="mt-2" style="font-size: 22px; color: #4B465C !important"><b>Detail
                                    Pengajuan</b>
                            </p>
                            <p class="fw-normal" style="font-size: 13px; margin-top: -8px; !important">
                                Pengajuan : <span class="fw-semibold">25/08/2020</span>
                            </p>
                            <p class="fw-normal" style="font-size: 13px; margin-top: -8px; !important">
                                Disetujui : <span class="fw-semibold">29/08/2020</span>
                            </p>
                        </div>

                    </div>
                </div>

                <div class="d-flex" style="margin-top: 40px; font-size: 15px; color: #23314B; !important">
                    <ul style="border-right: 1px solid #D3D6DB; padding: 0 20px 0 0; !important">
                        <li class="d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                            <i class="ti ti-users me-2">
                                {{ $lowongan->kuota }}
                            </i>
                        </li>
                        @foreach ($fakultas as $f)
                        <li class="d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                            <i class="ti ti-building-community me-2">
                                {{ $f->namafakultas }}
                            </i>
                        </li>
                        @endforeach
                        <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                            <i class="ti ti-calendar-time me-2">
                                {{ $lowongan->durasimagang }}
                            </i>
                        </li>
                    </ul>
                    <ul style="border-right: 1px solid #D3D6DB; padding: 0 20px 0 20px; !important">
                        @foreach ($lokasi as $l)
                            <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-map-pin me-2">
                                    {{ $l->kota }}
                                </i>
                            </li>
                        @endforeach
                        <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                            <i class="ti ti-currency-dollar me-2">
                                {{ $lowongan->nominal_salary }}
                            </i>
                        </li>
                    </ul>
                    <ul style="padding: 0 0 0 20px; !important">
                        @foreach ($prodi as $p)
                        <li class="list-group-item d-flex align-items-start fw-semibold"
                            style="margin-top: 15px !important">
                            <i class="ti ti-school me-2"></i>
                            <div>
                                Bidang
                                <ul style="list-style-type: disc; padding-left: 20px; margin-top: 5px;">
                                    <li> {{ $p->namaprodi }}</li>
                                </ul>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
        <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
            <span class="fw-bold" style="font-size: 26px; color: #23314B; !important">Deskipsi Pekerjaan</span>
            <ul class="job-description"
                style="list-style-type: disc; padding-left: 20px; margin-top: 5px; padding-bottom: 30px; font-size: 15px; color: #23314B;">
                <p id="deskripsi" name="deskripsi">
                    @php
                        $deskripsi = nl2br($lowongan->deskripsi);
                        $desc = explode('<br />', $deskripsi);
                    @endphp
                    @foreach ($desc as $d)
                        <li>
                            {{ $d }}
                        </li>
                    @endforeach
                    <span class="content-new mb-0"></span>
                    <u class="show_hide_new cursor-pointer" style="color:#4EA971">
                        Show more
                    </u>
                </p>
            </ul>
        </div>

        <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
            <span class="fw-bold" style="font-size: 26px; color: #23314B; !important">Requirement</span>
            <ul
                style="list-style-type: disc; padding-left: 20px; margin-top: 5px; padding-bottom: 30px; font-size: 15px; color: #23314B;">
                <p id="kualifikasi" name="kualifikasi">
                    @php
                        $requirements = nl2br($lowongan->requirements);
                        $req = explode('<br />', $requirements);
                    @endphp
                    @foreach ($req as $r)
                        <li>
                            {{ $r }}
                        </li>
                    @endforeach
                    <span class="content-new mb-0"></span>
                    <u class="show_hide_new cursor-pointer" style="color:#4EA971">
                        Show more
                    </u>
                </p>
            </ul>
        </div>

        <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
            <span class="fw-bold" style="font-size: 26px; color: #23314B; !important">Benefit</span>
            <ul id="benefit" name="benifit"
                style="list-style-type: disc; padding-left: 20px; margin-top: 5px; padding-bottom: 30px; font-size: 15px; color: #23314B;">
                <p id="benefitmagang" name="benefitmagang">
                    @php
                        $benefitmagang = nl2br($lowongan->benefitmagang);
                        $benefit = explode('<br />', $benefitmagang);
                    @endphp
                    @foreach ($benefit as $b)
                        <li>
                            {{ $b }}
                        </li>
                    @endforeach
                </p>
            </ul>
        </div>
        </ul>


        <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
            <span class="fw-bold" style="font-size: 26px; color: #23314B; !important" id="kemampuan"
                name="kemampuan">Kemampuan</span>
            <div class="d-flex mt-3" style="column-gap: 10px; padding-bottom: 30px !important">
                <span class="badge rounded-pill bg-success bg-glow"> {{ $lowongan->keterampilan }}</span>
                {{-- <span class="badge rounded-pill bg-success bg-glow"> {{ $lowongan->keterampilan }}</span>
                <span class="badge rounded-pill bg-success bg-glow"> {{ $lowongan->keterampilan }}</span>
                <span class="badge rounded-pill bg-success bg-glow"> {{ $lowongan->keterampilan }}</span> --}}
            </div>
        </div>

        <div class="mt-4" style="border-bottom: 1px solid #D3D6DB;">
            <span class="fw-bold" style="font-size: 26px; color: #23314B; !important">Seleksi Tahap Lanjut</span>
            <ul class="timeline ms-1 mb-0 mt-3">
                @foreach ($seleksi as $s)
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <h5 class="mb-0">Seleksi Tahap {{ $loop->iteration }}</h5>
                            <div class="d-flex align-items-center" style="margin-top: 15px !important">
                                <i class="ti ti-calendar-event me-2"></i>
                                <p class="mb-0" id="tgltahap1" name="tgltahap1">
                                    {{ $s->tgl_mulai }}-{{ $s->tgl_akhir }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('page_script')
    <script src="../../app-assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../app-assets/js/extended-ui-sweetalert2.js"></script>

    <script>
        $(document).ready(function() {
            $(".content-new").hide();
            $(".show_hide_new").on("click", function() {
                var content = $(this).prev('.content-new');
                content.slideToggle(100);
                if ($(this).text().trim() == "Show more") {
                    $(this).text("Show less");
                } else {
                    $(this).text("Show more");
                }
            });
        });
    </script>
@endsection
