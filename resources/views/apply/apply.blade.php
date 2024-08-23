@extends('partials.horizontal_menu')

@section('page_style')

<style>
    .hidden {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y bg-white px-5">
    <a href="{{ $urlBack }}" class="btn btn-outline-primary mt-4 mb-3">
        <i class="ti ti-arrow-left me-2 text-primary"></i>
        Kembali
    </a>
    
    <div class="sec-title">
        <h4>{{$lowongandetail->intern_position}}</h4>
    </div>

    @if($persentase < 80)
    <div class="alert alert-warning alert-dismissible" role="alert">
        <i class="ti ti-alert-triangle ti-xs"></i>
        <span style=" padding-left:10px; padding-top:5px; color:#322F3D;"> Silahkan melakukan pengisian data dengan minimal kelengkapan 80% untuk melanjutkan proses melamar pekerjaan</span>
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
    </div>
    @endif

    <div id="sudah-daftar-container"></div>

    <div class="card">
        <div class="card-body">
            <h4>Informasi Data Diri</h4>
            <div class="d-flex justify-content-between mt-4">
                <div class="text-center" style="overflow: hidden; width: 100px; height: 100px;">
                @if ($mahasiswa->profile_picture)
                    <img src="{{ asset('storage/' . $mahasiswa->profile_picture) }}" alt="profile-image" class="d-block" width="100" alt="img">
                @else
                    <img src="{{ asset('app-assets/img/avatars/user.png')}}" alt="user-avatar" class="d-block" width="100">
                @endif
                </div>
                <div class="d-flex flex-column">
                    <h6 class="mb-0">Nama Lengkap</h6>
                    <p>{{$mahasiswa->namamhs}}</p>
                    <h6 class="mb-0">NIM</h6>
                    <p>{{$mahasiswa->nim}}</p>
                </div>
                <div class="d-flex flex-column">
                    <h6 class="mb-0">Alamat Email</h6>
                    <p>{{$mahasiswa->emailmhs}}</p>
                    <h6 class="mb-0">No.Telp</h6>
                    <p>{{$mahasiswa->nohpmhs}}</p>
                </div>
                <div class="d-flex flex-column">
                    <h6 class="mb-0">Program Studi</h6>
                    <p>{{$mahasiswaprodi->prodi->namaprodi}}</p>
                    <h6 class="mb-0">Fakultas</h6>
                    <p>{{$mahasiswaprodi->fakultas->namafakultas}}</p>
                </div>
                <div class="d-flex flex-column">
                    <h6 class="mb-0">Universitas</h6>
                    <p>{{$mahasiswaprodi->univ->namauniv}}</p>
                </div>
                <div class="d-flex flex-column" style="flex: 0 0 auto;width: 20%;">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-1">Kelengkapan</h6>
                        <h6 class="mb-1">{{$persentase}}%</h6>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: {{$persentase}}%" role="progressbar" aria-valuenow="{{$persentase}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    @if(isset($persentase) && $persentase != 100)
                    <a href="{{url('profile?lamaran='.$urlId)}}" class="btn btn-outline-success btn-label-success mt-2" type="button">Lengkapi Profile</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($sudahDaftar == false)
    <div class="card mt-5" id="card-apply">
        <div class="card-body">
            <div>
                <form class="default-form" action="{{ route('apply_lowongan.apply', ['id' => $lowongandetail->id_lowongan]) }}" method="POST" enctype="multipart/form-data" function-callback="afterApplyLowongan">
                    @csrf
                        <h4>Portofolio</h4>
                        <div class="mt-3 form-group">
                            <label for="formFile" class="form-label text-secondary">Unggah Portofolio (opsional)</label>
                            @if(isset($persentase) && ($magang != null || $persentase < 70)) 
                                <input class="form-control" type="file" id="formFile" name="porto" disabled>
                            @else
                                <input class="form-control" type="file" id="formFile" name="porto">
                            @endif
                            <p class="mt-1 mb-0" style="font-size: 14px;">Mendukung tipe file PDF dan Ukuran Maksimal 5 MB</p>
                            <div class="invalid-feedback"></div>
                        </div>
                        <h4 class="mt-4">Mengapa Saya Harus Diterima</h4>
                        <div class="mt-3">
                            <label for="reasonTextarea" class="form-label text-secondary">Jelaskan mengapa Anda layak diterima untuk posisi ini</label>
                            <textarea class="form-control" id="reasonTextarea" name="reason" rows="5" required></textarea>
                        </div>
                        @if(isset($persentase) && ($magang != null || $persentase < 70)) 
                            <button type="submit" class="btn btn-secondary waves-effect waves-light mt-3" disabled>Kirim lamaran sekarang</button>
                        @else
                            <button type="submit" class="btn btn-primary waves-effect waves-light mt-3">Kirim lamaran sekarang</button>
                        @endif
                </form>
            </div>
        </div>
    </div>
    @endif

    <div class="card mt-5">
        <div class="card-body">
            <div class="border-bottom pb-4">
                <h4>Deskipsi pekerjaan</h4>
                <ul class="ps-2 ms-3 mb-0">
                    @foreach (explode(PHP_EOL, $lowongandetail->deskripsi) as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-4 border-bottom pb-4">
                <h4>Requirements</h4>
                <ul class="ps-2 ms-3 mb-0">
                    @foreach (explode(PHP_EOL, $lowongandetail->requirements) as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-4 border-bottom pb-4">
                <h4>Benefit</h4>
                <ul class="ps-2 ms-3 mb-0">
                    @foreach (explode(PHP_EOL, $lowongandetail->benefitmagang) as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-4 border-bottom pb-4">
                <h4>Kemampuan</h4>
                <div class="d-flex justify-content-start">
                    @foreach (json_decode($lowongandetail->keterampilan) as $item)
                    <span class="badge rounded-pill bg-primary mx-1">{{ $item }}</span>
                    @endforeach
                </div>
            </div>
            <div class="mt-4">
                <h4>Tentang Perusahaan</h4>
                <div class="d-flex justify-content-start">
                    <div class="text-center" style="overflow: hidden; width: 70px; height: 70px;">
                        @if ($lowongandetail->industri->image)
                            <img src="{{ url('storage/' .$lowongandetail->industri->image) }}" alt="profile-image" class="d-block" width="70" alt="img">
                        @else
                            <img src="{{ url('app-assets/img/avatars/14.png')}}" alt="user-avatar" class="d-block" width="70">
                        @endif
                    </div>
                    <h5 class="ms-4 mt-4">{{$lowongandetail->industri->namaindustri}}</h5>
                </div>
                <p>{{ $lowongandetail->industri->description }}</p>
                <div class="mb-3">
                    <a href="#" class="btn btn-outline-primary mt-2">Lihat Perusahaan</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page_script')
<script>
    function changeColor(button) {
        button.classList.toggle('highlight');
    }

    let sudahDaftar = `
        <div class="alert alert-warning alert-dismissible" role="alert">
            <i class="ti ti-alert-triangle ti-xs"></i>
            <span style=" padding-left:10px; padding-top:5px; color:#322F3D;"> Anda sudah mengajukan lamaran untuk pekerjaan ini</span>
        </div>
    `;

    @if($sudahDaftar == true)
        document.getElementById("sudah-daftar-container").innerHTML = sudahDaftar;
    @endif


    //  Button Back
    document.getElementById("back").addEventListener("click", () => {
        history.back();
    });

    function afterApplyLowongan(){
        $('#card-apply').remove();
        $('#sudah-daftar-container').html(sudahDaftar);
    }
</script>
<script src="{{ asset('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
@endsection