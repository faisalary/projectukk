@extends('partials_mahasiswa.template')

@section('page_style')
<style>
    .hidden {
        display: none;
    }

    .page-item>.page-link.active {
        border-color: #4EA971 !important;
        background-color: #4EA971 !important;
        color: #fff;
    }

    .btn-success {
        color: #fff;
        background-color: #4EA971 !important;
        border-color: #4EA971 !important;
    }

    .highlight {
        background-color: #4EA971 !important;
        color: white !important;
    }

    .progress-bar {
        background-color: #4EA971 !important;
        color: #fff;
    }
</style>
@endsection

@section('main')
<div class="auto-container m-5">
    <div class="row">
        <div class="col-2 text-left">
            <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%; width:200px;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
            </figure>
        </div>
        <div class="col-4 ">
            <h2 class="mb-1">PT Wings Surya</h2>
            <p>Wings Food</p>
        </div>
        <div class="col-6 text-end">
            <button type="button" class="btn btn-outline-dark waves-effect me-3" onclick="changeColor(this)" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Bagikan">
                <i class="ti ti-share me-1"></i>Bagikan
            </button>
            <button type="button" class="btn btn-outline-dark waves-effect me-3" onclick="changeColor(this)" data-bs-toggle="modal" data-bs-target="#modalCenter" data-bs-original-title="Laporkan">
                <i class="ti ti-flag me-1"></i>Laporkan
            </button>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-3">
            <div>
                <h6 class="mb-0">Lokasi Perusahaan</h6>
                <p>Jl. Tipar Cakung Kav. F 5-7, Cakung Barat, Cakung, Jakarta Timur, Jakarta 13910, ID</p>
            </div>
            <div>
                <h6 class="mb-0">Industri</h6>
                <p>Fast Moving Consumer Good</p>
            </div>
        </div>
        <div class="col-3">
            <div>
                <h6 class="mb-0">Email</h6>
                <p>recruiter@wings.id</p>
            </div>
            <div style="margin-top: 35px;">
                <h6 class="mb-0">Phone</h6>
                <p>+6295948438388</p>
            </div>
        </div>
        <div class="col-3">
            <div>
                <h6 class="mb-0">Sosial Media</h6>
                <span class="social-links">
                    <a href="#" class="ml-0"><i class="fab fa-facebook-f text-secondary" style="margin-right: 10px;"></i></a>
                    <a href="#"><i class="fab fa-instagram text-secondary" style="margin-right: 10px;"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in text-secondary" style="margin-right: 10px;"></i></a>
                    <a href="#"><i class="fab fa-twitter text-secondary" style="margin-right: 10px;"></i></a>
                </span>
            </div>
            <div style="margin-top: 35px;">
                <h6 class="mb-0">Website</h6>
                <p>www.wingsfood.com</p>
            </div>
        </div>
    </div>
    <div class="border-bottom mt-3">
        <h4> Tentang Perusahaan</h4>
    </div>
    <p class="mt-3">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac risus sem. Sed sapien purus, consectetur ac elit
        non, iaculis bibendum quam. In sed risus quis urna molestie interdum in eu quam. Mauris id dolor semper,
        fermentum mi non, consectetur ex. Duis aliquam, tortor ut dictum sodales, mauris erat imperdiet lorem, in
        eleifend purus nisi vitae sapien. Suspendisse eget viverra ex. Sed malesuada elit ut magna interdum finibus.
        Nulla volutpat posuere felis, ac tempor turpis hendrerit pretium. Duis dictum posuere augue vel aliquet.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac risus sem. Sed sapien purus, consectetur ac elit
        non, iaculis bibendum quam. In sed risus quis urna molestie interdum in eu quam. Mauris id dolor semper,
        fermentum mi non, consectetur ex. Duis aliquam, tortor ut dictum sodales, mauris erat imperdiet lorem, in
        eleifend purus nisi vitae sapien. Suspendisse eget viverra ex. Sed malesuada elit ut magna interdum finibus.
        Nulla volutpat posuere felis, ac tempor turpis hendrerit pretium. Duis dictum posuere augue vel aliquet. </p>

    <div class="card" style="background-color: #f8f7fa;">
        <div class="card-header p-3" style="background-color: #23314B;">
            <div class="row">
                <div class="col-6">
                    <h4 class="mb-0 ps-2" style="color: #FFFFFF;">Lowongan Tersedia di Perusahaan</h4>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-9">
                            <div class="input-group input-group-merge ">
                                <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                                <input type="text" class="form-control" placeholder="Lowongan Pekerjaan" aria-label="Search..." aria-describedby="basic-addon-search31">
                            </div>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-success waves-effect waves-light">Cari
                                Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body mt-5">
            <div class="row border-bottom">
                <div class="col-2">
                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%; width:150px;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                    </figure>
                </div>
                <div class="col-8">
                    <h2 class="mb-1">Human Resources</h2>
                    <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                    <p>Jl. Tipar Cakung Kav. F 5-7, Cakung Barat, Cakung, Jakarta Timur, Jakarta 13910, ID</p>
                </div>
                <div class="col-2">
                    <div class="text-end ps-5"> <i class="ti ti-clock mb-1"> </i> 8hari lalu</div>
                </div>
            </div>
            <div class="row border-bottom mt-5">
                <div class="col-2">
                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%; width:150px;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                    </figure>
                </div>
                <div class="col-8">
                    <h2 class="mb-1">Human Resources</h2>
                    <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                    <p>Jl. Tipar Cakung Kav. F 5-7, Cakung Barat, Cakung, Jakarta Timur, Jakarta 13910, ID</p>
                </div>
                <div class="col-2">
                    <div class="text-end ps-5"> <i class="ti ti-clock mb-1"> </i> 8hari lalu</div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-2">
                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%; width:150px;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                    </figure>
                </div>
                <div class="col-8">
                    <h2 class="mb-1">Human Resources</h2>
                    <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                    <p>Jl. Tipar Cakung Kav. F 5-7, Cakung Barat, Cakung, Jakarta Timur, Jakarta 13910, ID</p>
                </div>
                <div class="col-2">
                    <div class="text-end ps-5"> <i class="ti ti-clock mb-1"> </i> 8hari lalu</div>
                </div>
            </div>
        </div>
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end mb-0 mt-3">
            <li class="page-item ">
                <a class="page-link waves-effect" href="javascript:void(0);">Previous</a>
            </li>
            <li class="page-item">
                <a class="page-link waves-effect active" href="javascript:void(0);">1</a>
            </li>
            <li class="page-item">
                <a class="page-link waves-effect" href="javascript:void(0);">2</a>
            </li>
            <li class="page-item">
                <a class="page-link waves-effect" href="javascript:void(0);">3</a>
            </li>
            <li class="page-item ">
                <a class="page-link waves-effect" href="javascript:void(0);">Next</a>
            </li>

        </ul>
    </nav>
</div>

@endsection

@section('page_script')
<script>
    function changeColor(button) {
        button.classList.toggle('highlight');
    }
</script>
@endsection