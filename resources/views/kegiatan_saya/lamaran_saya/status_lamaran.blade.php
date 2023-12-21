@extends('partials_mahasiswa.template')

@section('page_style')
<style>
    .col-1-5 {
        flex: 0 0 12.5%;
        max-width: 12.5%;
    }

    .page-item.active .page-link,
    .pagination li.active>a:not(.page-link) {
        border-color: #FFFFFF !important;
        background-color: #4EA971 !important;
    }

    .btn-secondary {
        background-color: #D3D6DB !important;
        border-color: #D3D6DB !important;
    }

    .btn-success {
        background-color: #4EA971 !important;
        border-color: #4EA971 !important;
    }

    .light-style .bs-stepper .bs-stepper-header {
        border-bottom: 0px solid #dbdade !important;
    }

    .light-style .bs-stepper {
        background-color: #f8f7fa;
    }

    .light-style .bs-stepper:not(.wizard-modern) {
        box-shadow: none;
    }
</style>
@endsection

@section('main')

<div class="sec-title ms-5 me-5 mt-4 ">
    <h3 class="mt-2 mb-0">Status lamaran anda</h3>
</div>

<div class="bs-stepper wizard-icons wizard-icons-example ms-5 me-5 mt-5">
    <div class="bs-stepper-header">
        <div class="step d-flex flex-column align-items-center">
            <button type="button" class="btn rounded-pill btn-icon btn-success waves-effect waves-light mb-3">
                1
            </button>
            <p>Belum di Proses</p>
        </div>
        <hr style="width: 10%; height:60px; border-color: #4EA971; border-width: 3px;">
        <div class="step d-flex flex-column align-items-center">
            <button type="button" class="btn rounded-pill btn-icon btn-success waves-effect waves-light mb-3">
                2
            </button>
            <p>Screening</p>
        </div>
        <hr style="width: 10%; height:60px; border-color: #D3D6DB; border-width: 3px;">
        <div class="step d-flex flex-column align-items-center">
            <button type="button" class="btn rounded-pill btn-icon btn-secondary waves-effect waves-light mb-3">
                3
            </button>
            <p>Seleksi</p>
        </div>
        <hr style="width: 10%; height:60px; border-color: #D3D6DB; border-width: 3px;">
        <div class="step d-flex flex-column align-items-center">
            <button type="button" class="btn rounded-pill btn-icon btn-secondary waves-effect waves-light mb-3">
                4
            </button>
            <p>Penawaran</p>
        </div>
        <hr style="width: 10%; height:60px; border-color: #D3D6DB1; border-width: 3px; ">
        <div class="step d-flex flex-column align-items-center">
            <button type="button" class="btn rounded-pill btn-icon btn-secondary waves-effect waves-light mb-3">
                5
            </button>
            <p>Diterima/Ditolak</p>
        </div>
    </div>
</div>

<div class="card ms-5 me-5 mb-5">
    <div class="card-body">
        <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
            <div class="col-3 text-start">
                <figure class="image ms-3"><img style="width:170px; height:100px;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                </figure>
            </div>
            <div class="col-3 text-start" style="margin-left:-100px;">
                <h3>Back End Developer</h3>
                <p style="font-size:15px;">PT Wings Surya</p>
            </div>
            <div class="col-6 text-end" style="margin-left:100px;">
                <div class="waktu"> Lamaran terkirim pada 15 juni 2023 <i class="ti ti-clock"></i></div>
                <button type="button" class="btn btn-sm btn-secondary waves-effect mt-3" style="height:35px; font-size:16px;" disabled>Lowongan Sudah di tutup</button>
                <div><span class="badge bg-label-info me-1 text-end mt-3" style="height:30px; font-size:16px;">Seleksi Tahap 1</span></div>
            </div>
        </div>
        <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px; margin-bottom:5px;"></i>Jakarta Selatan, Indonesia</div>
        <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar" style="margin-right: 10px; margin-bottom:5px;"></i>Berbayar</div>
        <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-calendar-time" style="margin-right: 10px; margin-bottom:5px;"></i>2 Semester</div>
        <div class="location" style="margin-left: 2px;"><i class="ti ti-users" style="margin-right: 10px; margin-bottom:5px;"></i>5 Kuota Penerimaan</div>
        <div><a href="/detail/lowongan/magang"><button type="button" class="btn btn-sm btn-outline-dark waves-effect mt-3" style="width: 200px; height:auto"> <i class="ti ti-eye" style="margin-right: 10px; margin-bottom:5px;"></i>Lihat Detail Pekerjaan</button>
            </a></div>
        <div class="border mt-3"></div>
        <div class="tex-start mt-3">
            <h4>Mengapa Saya Harus Diterima?</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac risus sem. Sed sapien purus, consectetur ac elit non, iaculis bibendum quam. In sed risus quis urna molestie interdum in eu quam. Mauris id dolor semper, fermentum mi non, consectetur ex. Duis aliquam, tortor ut dictum sodales, mauris erat imperdiet lorem, in eleifend purus nisi vitae sapien. Suspendisse eget viverra ex. Sed malesuada elit ut magna interdum finibus. Nulla volutpat posuere felis, ac tempor turpis hendrerit pretium. Duis dictum posuere augue vel aliquet. </p>
        </div>
        <div class="border mt-3"></div>
        <div class="row mt-3">
            <div class="col-4">
                <h6>Resume</h6>
                <a href="#">
                    <div class="map-pin mt-3 mb-3"><i class="ti ti-file-symlink" style="margin-bottom:5px;"></i><u>0d39331a44a645897d14703d4c0ffa12.pdf</u>
                    </div>
                </a>
            </div>
            <div class="col-1">
                <div class="divider divider-vertical"></div>
            </div>
            <div class="col-3 text-start">
                <h6 style="margin-left: -50px">Surat lamaran kerja</h6>
                <a href="#">
                    <div class="map-pin mt-3 mb-3"><i class="ti ti-file-symlink" style="margin-left: -55px; margin-bottom:5px;"></i><u>0d39331a44a645897d14703d4c0ffa12.pdf</u>
                    </div>
                </a>
            </div>
            <div class="col-1">
                <div class="divider divider-vertical"></div>
            </div>
            <div class="col-3 text-start">
                <h6 style="margin-left: -50px">Portofolio</h6>
                <a href="#">
                    <div class="map-pin mt-3 mb-3"><i class="ti ti-file-symlink" style="margin-left: -55px; margin-bottom:5px;"></i><u>0d39331a44a645897d14703d4c0ffa12.pdf</u>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>


@endsection

@section('page_script')

@endsection