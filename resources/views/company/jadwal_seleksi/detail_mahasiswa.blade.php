@extends('partials.vertical_menu')

@section('page_style')
@endsection

@section('content')
<div class="d-flex justify-content-start">
    <a href="{{ $urlBack }}" class="btn btn-outline-primary">
        <i class="ti ti-arrow-left"></i>&ensp;
        Kembali
    </a>
</div>
<div class="d-flex justify-content-start mt-3">
    <h4><span class="text-muted">Proses Seleksi</span>&ensp;/&ensp;Detail Mahasiswa</h4>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-5 accordion">
                <div class="d-flex justify-content-start">
                    <div class="text-center" style="overflow: hidden; width: 125px; height: 125px;">
                        {{-- @if ($data->profile_picture)
                        <img src="{{ asset('storage/' . $data->profile_picture) }}" alt="user-avatar" class="d-block" width="125" id="image_mahasiswa">
                        @else
                        <img src="{{ asset('app-assets/img/avatars/user.png') }}" alt="user-avatar" class="d-block" width="125" id="image_mahasiswa">
                        @endif --}}
                        <img src="{{ asset('app-assets/img/avatars/user.png') }}" alt="user-avatar" class="d-block" width="125" id="image_mahasiswa">
                    </div>
                    <div class="d-flex flex-column justify-content-center ms-4">
                        <h2 class="fw-bolder mb-2.5">{{ $data->namamhs }}</h2>
                        <h6>{{ $data->intern_position }}</h6>
                    </div>
                </div>
                <div class="">
                    <p>{{ $data->reason_aplicant }}</p>
                </div>
                <div class="border-bottom mt-4">
                    <h4 class="fw-semibold">Informasi Pribadi</h4>
                    <div class="my-4">
                        <h5 class="mb-1">Deskripsi Diri</h5>
                        <p>{{ $data->deskripsi_diri }}</p>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); height: 100%;" class="data_mahasiswa">
                        <section style="height: 100%;">
                            <h4>Data Pendidikan</h4>
                            <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));">
                                <section>
                                    <p class="d-flex flex-column">
                                        <span class="fw-bolder">NIM</span> 
                                        {{ $data->nim }}
                                    </p>
                                    <p class="d-flex flex-column mt-4">
                                        <span class="fw-bolder">Fakultas</span>{{ $data->namafakultas }}
                                    </p>
                                    <p class="d-flex flex-column mt-4">
                                        <span class="fw-bolder">Angkatan</span> 
                                        {{ $data->angkatan }}
                                    </p>
                                    <p class="d-flex flex-column mt-4">
                                        <span class="fw-bolder">EPrT</span>{{ $data->eprt }}
                                    </p>
                                </section>
                                <section>
                                    <p class="d-flex flex-column">
                                        <span class="fw-bolder">Universitas</span> 
                                        {{ $data->namauniv }}
                                    </p>
                                    <p class="d-flex flex-column mt-4">
                                        <span class="fw-bolder">Program Studi</span>{{ $data->prodi->namaprodi }}
                                    </p>
                                    <p class="d-flex flex-column mt-4">
                                        <span class="fw-bolder">IPK</span> 
                                        {{ $data->ipk }}
                                    </p>
                                    <p class="d-flex flex-column mt-4">
                                        <span class="fw-bolder">TAK</span>{{ $data->tak }}
                                    </p>
                                </section>
                            </div>
                        </section>
                        <section style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <h4>Kontak</h4>
                                <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));">
                                    <p class="d-flex flex-column">
                                        <span class="fw-bolder">Email</span>{{ $data->email }}
                                    </p>
                                    <p class="d-flex flex-column">
                                        <span class="fw-bolder">No, Telp</span>{{ $data->nohpmhs }}
                                    </p>
                                </div>
                            </div>
                            <div>
                                <h4>Data Pribadi</h4>
                                <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));">
                                    <p class="d-flex flex-column">
                                        <span class="fw-bolder">Jenis Kelamin</span>{{ $data->gender }}
                                    </p>
                                    <p class="d-flex flex-column">
                                        <span class="fw-bolder">Tanggal Lahir</span>{{ $data->namafakultas }}
                                    </p>
                                    <p class="d-flex flex-column">
                                        <span class="fw-bolder">Alamat</span>{{ $data->alamatmhs }}
                                    </p>
                                </div>
                            </div>
                        </section>
                    </div>
                    {{-- <table class="mb-3" style="width:100%;">
                        <tbody>
                            <tr>
                                <td class="pb-2"><span class="fw-bolder">NIM</span> : {{ $data->nim }}</td>
                                <td class="pb-2"><span class="fw-bolder">TAK</span> : {{ $data->tak }}</td>  
                            </tr>
                            <tr>
                                <td class="pb-2"><span class="fw-bolder">Universitas</span> : {{ $data->namauniv }}</td>
                                <td class="pb-2"><span class="fw-bolder">Email</span> : {{ $data->email }}</td>
                            </tr>
                            <tr>
                                <td class="pb-2"><span class="fw-bolder">Fakultas</span> : {{ $data->namafakultas }}</td>
                                <td class="pb-2"><span class="fw-bolder">No. Telp</span> : {{ $data->nohpmhs }}</td>
                            </tr>
                            <tr>
                                <td class="pb-2"><span class="fw-bolder">Angkatan</span> : {{ $data->angkatan }}</td>
                                <td class="pb-2"><span class="fw-bolder">Jenis Kelamin</span> : {{ $data->gender }}</td>
                            </tr>
                            <tr>
                                <td class="pb-2"><span class="fw-bolder">IPK</span> : {{ $data->ipk }}</td>
                                <td class="pb-2"><span class="fw-bolder">Alamat</span> : {{ $data->alamatmhs }}</td>
                            </tr>
                            <tr>
                                <td class="pb-2"><span class="fw-bolder">EPRT</span> : {{ $data->eprt }}</td>
                            </tr>
                        </tbody>
                    </table> --}}
                </div>
                <div class="border-bottom mt-3 border accordion-item rounded">
                    <h4 class="accordion-header mb-0" id="headingOne">
                        <button class="accordion-button fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                            Riwayat Pendidikan
                        </button>
                    </h4>
                    <div id="flush-collapseOne" class="accordion-collapse collapse show p-3" data-bs-parent="#accordion-detail" aria-labelledby="headingOne">
                        <ul class="timeline ps-3 mb-0 accordion-body">
                            @foreach ($data->education as $key => $item)
                            <li class="ps-5 timeline-item timeline-item-transparent {{ ($key+1) == count($data->education) ? 'border-0' : '' }}">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event pe-0">
                                    <div class="timeline-header mb-2">
                                        <h5 class="fw-bolder mb-0">{{ $item->name_intitutions }}</h5>
                                    </div>
                                    <p class="mb-1">{{ $item->tingkat }}</p>
                                    <p class="mb-1">{{ $item->nilai }}</p>
                                    <small>{{ Carbon\Carbon::parse($item->startdate)->format('F Y') }}&ensp;-&ensp;{{ Carbon\Carbon::parse($item->enddate)->format('F Y') }}</small>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="border-bottom mt-3 border rounded accordion-item">
                    <h4 class="accordion-header mb-0" id="headingTwo">
                        <button class="accordion-button fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="true" aria-controls="flush-collapseTwo">
                            Pengalaman
                        </button>
                    </h4>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse show p-3" data-bs-parent="#accordion-detail" aria-labelledby="headingTwo">
                    <ul class="timeline ps-3 mb-0">
                        @foreach ($data->experience as $key => $item)
                        <li class="ps-5 timeline-item timeline-item-transparent {{ ($key+1) == count($data->experience) ? 'border-0' : '' }}">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event pe-0">
                                <div class="timeline-header mb-2">
                                    <h5 class="fw-bolder mb-0">{{ $item->name_intitutions }}</h5>
                                </div>
                                <p class="mb-1">{{ $item->posisi }}</p>
                                <small>{{ Carbon\Carbon::parse($item->startdate)->format('F Y') }}&ensp;-&ensp;{{ Carbon\Carbon::parse($item->enddate)->format('F Y') }}</small>
                                <p>{{ $item->deskripsi }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    </div>
                </div>
                <div class="border-bottom mt-3">
                    <h4 class="mb-3">Keahlian</h4>
                    <div class="d-flex justify-content-start mb-3">
                        @foreach (json_decode($data->skills, true) as $item)
                            <span class="badge rounded-pill mx-1 bg-primary">{{ $item }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="my-3">
                    <h4>Dokumen Persyaratan</h4>
                    <div class="border-bottom pb-3">
                        <h6>
                            Portfolio
                        </h6>
                        <div style="display: flex; flex-direction: row; align-items: center; gap: 1rem;">
                            <img src="#" alt="" style="background-color: rgb(86, 86, 86); width: 5rem; height: 5rem; border-radius: 0.5rem;">
                            <a href="#">namafile.pdf</a>
                        </div>
                    </div>
                    <div class="border-bottom pb-3 pt-3">
                        <h6>
                            Portfolio
                        </h6>
                        <div style="display: flex; flex-direction: row; align-items: center; gap: 1rem;">
                            <img src="#" alt="" style="background-color: rgb(86, 86, 86); width: 5rem; height: 5rem; border-radius: 0.5rem;">
                            <a href="#">namafile.pdf</a>
                        </div>
                    </div>
                    <div class="border-bottom pb-3 pt-3">
                        <h6>
                            Portfolio
                        </h6>
                        <div style="display: flex; flex-direction: row; align-items: center; gap: 1rem;">
                            <img src="#" alt="" style="background-color: rgb(86, 86, 86); width: 5rem; height: 5rem; border-radius: 0.5rem;">
                            <a href="#">namafile.pdf</a>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h4>Dokumen Pendukung</h4>
                    <div>
                        @foreach ($data->sertifikat as $key => $item)
                        <div class="mb-3 pb-3 {{ ($key+1) != count($data->sertifikat) ? 'border-bottom' : '' }}">
                            <div class="d-flex justify-content-between mb-1">
                                <h5 class="mb-0">{{ $item->nama_sertif }}</h5>
                            </div>
                            <p class="mb-1" style="font-size: small">{{ $item->penerbit }}</p>
                            <p class="mb-1">{{ Carbon\Carbon::parse($item->startdate)->format('F Y') }}&ensp;-&ensp;{{ Carbon\Carbon::parse($item->enddate)->format('F Y') }}</p>
                            <p class="mb-1">{{ $item->deskripsi }}</p>
                            <div class="d-flex justfiy-content-start align-items-center">
                                <a href="#" target="_blank" class="text-decoration-underline">
                                    UI UX Website.pdf
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-3">
                    <h4>
                        Informasi Tambahan
                    </h4>
                    <div class="mt-4"  style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); width: max-content; height: max-content;  row-gap: 0.5rem; column-gap: 3rem;">
                        <div class="d-flex flex-row justify-content-between" style="width: 20rem; height: max-content;">
                            <h5>Instagram: </h5>
                            <a href="#">sydneysweedney</a>
                        </div>
                        <div class="d-flex flex-row justify-content-between" style="width: 20rem; height: max-content;">
                            <h5>Instagram: </h5>
                            <a href="#">sydneysweedney</a>
                        </div>
                        <div class="d-flex flex-row justify-content-between" style="width: 20rem; height: max-content;">
                            <h5>Instagram: </h5>
                            <a href="#">sydneysweedney</a>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-between mt-4" style="width: 20rem; height: max-content;">
                        <h5>Bahasa: </h5>
                        <div class="d-flex justify-content-start mb-3">
                            <span class="badge rounded-pill mx-1 bg-primary">Indonesia</span>
                            <span class="badge rounded-pill mx-1 bg-primary">Inggris</span>
                            <span class="badge rounded-pill mx-1 bg-primary">Japan</span>
                            <span class="badge rounded-pill mx-1 bg-primary">China</span>
                            <span class="badge rounded-pill mx-1 bg-primary">Spain</span>
                            <span class="badge rounded-pill mx-1 bg-primary">Arabic</span>
                        </div>
                    </div>
                </div>
                <h5 class="mt-5">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="15" cy="15" r="11.25" stroke="#4B465C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="15" cy="15" r="11.25" stroke="white" stroke-opacity="0.2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17.5 12.1874C15.9864 10.8572 13.6943 10.9525 12.2963 12.4037C10.8996 13.8528 10.8996 16.1471 12.2963 17.5962C13.6943 19.0474 15.9864 19.1426 17.5 17.8124" stroke="#4B465C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17.5 12.1874C15.9864 10.8572 13.6943 10.9525 12.2963 12.4037C10.8996 13.8528 10.8996 16.1471 12.2963 17.5962C13.6943 19.0474 15.9864 19.1426 17.5 17.8124" stroke="white" stroke-opacity="0.2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>2023 Crafted with PASSION by <span style="color: #4EA971;">Techno Infinity</span></span>
                </h5>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_script')
<script>
    
</script>
@endsection
