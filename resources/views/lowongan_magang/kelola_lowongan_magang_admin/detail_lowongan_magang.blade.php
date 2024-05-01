@extends('partials_admin.template')

@section('page_style')
    <link rel="stylesheet" href="{{asset("app-assets/vendor/libs/sweetalert2/sweetalert2.css")}}" />
    <style>
        .hide-me {
            display: none;
        }
    </style>
@endsection

@section('main')
    @can('btn.back.lkm')
    <a href="{{url("/kelola/lowongan/lkm")}}" type="button" class="btn btn-outline-success mb-3 waves-effect">
        <span class="ti ti-arrow-left me-2"></span>Kembali
    </a>
    @endcan
    @can('btn.back.mitra')
    <a href="{{url("/kelola/lowongan/mitra", Auth::user()->id_industri)}}" type="button" class="btn btn-outline-success mb-3 waves-effect">
        <span class="ti ti-arrow-left me-2"></span>Kembali
    </a>
    @endcan
    <div class="row ">
        <div class="">
            <h4 class="fw-bold text-sm"><span class="text-muted fw-light text-xs">Lowongan Magang / Kelola Magang /
                </span>
                {{$lowongan->intern_position}}
            </h4>
        </div>
    </div>
    <div class="d-flex">
        <div class="card" style="padding: 50px 30px; width: 100%; margin-right: 20px; !important">
            <div class="card-body" style=" border-bottom: 1px solid #D3D6DB;  !important">
                <div class="">
                    <div class="row">
                        <div class="col-8">
                            <div class="d-flex items-center justify-content-start">
                                    @if ($lowongan->industri->image)
                                    <img src="{{ asset('storage/' . $lowongan->industri->image) }}" alt="user-avatar"
                                        style="max-width:170px; max-height: 140px"
                                        id="imgPreview">
                                    @else
                                        <img src="../../app-assets/img/avatars/14.png" alt="user-avatar"
                                            class="" height="125" width="125"
                                            id="imgPreview" data-default-src="../../app-assets/img/avatars/14.png">
                                    @endif
                                <div class="ms-5">
                                    <p class="fw-bolder text-black" style="font-size: 32px; color: #23314B">{{$lowongan->industri?->namaindustri??''}}
                                    </p>
                                    <p class="mt-n3" style="font-size: 18px; color: #4B465C">{{$lowongan->intern_position}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 row justify-content-end">
                            <div class="col-2 d-flex items-center justify-content-start">
                                <div class="w-auto">
                                    <div class='text-center'>
                                        @if($lowongan->statusaprove == 'ditolak') 
                                            <div class='badge bg-label-danger' style="width: 180px">{{$lowongan->statusaprove}}</div>
                                        @else
                                            <div class='badge bg-label-success' style="width: 180px">{{$lowongan->statusaprove}}</div>
                                        @endif
                                    </div>
                                    <p class="mt-2" style="font-size: 22px; color: #4B465C !important"><b>Detail
                                            Pengajuan</b>
                                    </p>
                                    <p class="fw-normal" style="font-size: 13px; margin-top: -8px; !important">
                                        Pengajuan : <span class="fw-semibold">{{$lowongan->created_at}}</span>
                                    </p>
                                    
                                    <p class="fw-normal" style="font-size: 13px; margin-top: -8px; !important">
                                        Disetujui : <span class="fw-semibold">{{$lowongan?->date_confirm_closing??'belum disetujui'}}</span>
                                    </p>
                                </div>
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
                            
                                <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                    <i class="ti ti-map-pin me-2">{{ $lowongan->lokasi}}
                                    </i>
                                </li>
                            <li class=" d-flex align-items-center fw-semibold" style="margin-top: 15px !important">
                                <i class="ti ti-currency-dollar me-2">
                                    {{ $lowongan->nominal_salary}}
                                </i>
                            </li>
                        </ul>
                        
                        <ul style="padding: 0 0 0 20px; !important">
                            
                            <li class="list-group-item d-flex align-items-start fw-semibold"
                                style="margin-top: 15px !important">
                                <i class="ti ti-school me-2"></i>
                                <div>
                                    <p>Program Studi</p>
                                   
                                    <ul style="list-style-type: disc; padding-left: 20px; margin-top: 5px;">
                                        @foreach ($prodilowongan  as $l)
                                            <li> {{$l->prodi?->namaprodi??'tidak ada prodi' }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
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
        @can('btn.edit.lowongan')
            @if($lowongan->statusaprove == 'tertunda')
                <div style="width: 20%">
                    <button type="button" class="btn btn-label-success w-100 mt-3" data-bs-toggle="modal" data-bs-target="#modalapprove" style="font-size: 15px; box-shadow: 0 2px 4px rgba(75, 70, 92, 0.1);">
                        <i class="ti ti-file-check text-success" style="margin-right: 15px"></i>
                        <a>Setujui</a>
                    </button>
                    <button type="button" class="btn btn-label-danger w-100 mt-3" data-bs-toggle="modal" data-bs-target="#modalreject"
                        style="font-size: 15px; box-shadow: 0 2px 4px rgba(75, 70, 92, 0.1);">
                        <i class="ti ti-file-x text-danger" style="margin-right: 15px"></i>
                        <a>Tolak</a>
                    </button>
                </div>
            @endif
        @endcan
        @if (!empty($lowongan->alasantolak))
        <div style="max-width: 20%; min-width: 5%" >
            <div class="card border stretched-link" style="width: auto">
                <div class="card-body">
                    <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                        <p class="mt-2" style="font-size: 22px; color: #4B465C !important">
                            <b>Komentar</b>
                        </p>
                    </div>
                    <p>
                        {{ $lowongan->alasantolak }}
                    </p>
                    <div class="border"></div>
                    <p class="fw-normal mt-2" style="font-size: 13px;!important">
                        Timestamp : <span class="fw-semibold">{{$lowongan?->date_confirm_closing??'belum disetujui'}}</span>
                    </p>
                    <div class="map-pin mt-3 mb-3">
                    </div>
                </div>
            </div>
        </div>
        @endif
        </div>

        
        @if (Auth::user()->hasRole('superadmin'))     
        {{-- modal approve  --}}
        <div class="modal fade" id="modalapprove" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center" style="display:block;">
                        <h5 class="modal-title">Apakah Anda Yaking Menyetujui Lowongan</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="kategori" class="form-label">Masukkan Program Studi relevan<span class="text-danger">*</span></label>
                                <select class="form-select select2" multiple id="prodi" name="prodi[]" data-placeholder="Pilih Prodi">
                                    @foreach($prodi as $p)
                                    <option value="{{$p->id_prodi}}">{{$p->namaprodi ?? ''}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="justify-content:end;">
                        <button type="button" id="approve-confirm-button" class="btn btn-success" onclick='approved($(this))' data-id="{{$lowongan->id_lowongan}}" data-status="{{$lowongan->status}}">Approve Lowongan</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal rejected --}}
        <div class="modal fade" id="modalreject" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center d-block">
                        <h5 class="modal-title" id="modalreject">Alasan Penolakan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-2">
                                <label for="alasan" class="form-label">Alasan Penolakan</label>
                                <textarea class="form-control" id="alasan" placeholder="Alasan Penolakan"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            <button type="button" onclick='rejected($(this))' id="rejected-confirm-button" data-id="{{$lowongan->id_lowongan}}" data-status="{{$lowongan->statusapprove}}"
                                class="btn btn-success">Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
@endsection

@section('page_script')
    <script src="{{url("app-assets/vendor/libs/sweetalert2/sweetalert2.js")}}"></script>
    <script src="{{url("app-assets/js/extended-ui-sweetalert2.js")}}"></script>

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


        function approved(e) {
            var prodiData = $('#prodi').val();
            var approveUrl = '{{url("kelola/lowongan/lkm/approved")}}/' + $('#approve-confirm-button').attr('data-id');           
            $.ajax({
                url: approveUrl,
                type: "POST",
                data: {
                prodi: prodiData 
                },
                headers: {
                    "X-CSRF-TOKEN": "{{csrf_token()}}"
                },
                success: function (response) {
                    if (!response.error) {
                        alert('berhasil');
                    } else {
                        alert('tidak berhasil');
                    }
                    $('#modalapprove').modal('hide');
                }
            });
        }

        
        function rejected(e) {
            $('#modalreject').modal('show');
            var rejectedUrl = '{{ url("kelola/lowongan/lkm/rejected") }}/' + $('#rejected-confirm-button').attr('data-id');

            $('#rejected-confirm-button').on('click', function () {
                var alasan = $('#alasan').val();

                $.ajax({
                    url: rejectedUrl,
                    type: "POST",
                    data: { alasan: alasan, _token: '{{ csrf_token() }}' },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (!response.error) {
                            alert('berhasil');
                        } else {
                            alert('tidak berhasil');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

                $('#modalreject').modal('hide');
            });
        }
    </script>
@endsection
