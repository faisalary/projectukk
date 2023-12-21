@extends('partials_mahasiswa.template')

@section('page_style')
<!-- <style>
  .col-1-5 {
    flex: 0 0 12.5%;
    max-width: 12.5%;
  }

  .page-item.active .page-link,
  .pagination li.active>a:not(.page-link) {
    border-color: #FFFFFF !important;
    background-color: #4EA971 !important;
  }

  /* .select2-container {
    margin: 0;
    width: 220px !important;
    display: inline-block;
    position: relative;
    vertical-align: middle;
    box-sizing: border-box;
  }

  .select2-results__option[role="option"][aria-selected="true"] {
    background-color: #4EA971;
    color: #fff;
  }

  .select2-container--default .select2-results__option--highlighted:not([aria-selected="true"]) {
    background-color: rgba(115, 103, 240, 0.08) !important;
    color: #4EA971 !important;
  }

  .select2-container--default.select2-container--focus .select2-selection,
  .select2-container--default.select2-container--open .select2-selection {
    border-color: #4EA971 !important;
  } */
</style> -->
@endsection

@section('main')

<div class="sec-title ms-5 me-5 mt-3">
  <h3 class="mt-2 mb-0">Status lamaran anda</h3>
</div>
<!-- <div class="row ms-5 me-5">
  <div class="col-lg-4 col-sm-6 mb-4 p-0">
    <div class="card">
      <div class="p-2">
        <div class="d-flex justify-content-between">
          <h5 class="mb-0 ms-2">Lamaran Pekerjaan</h5>
          <div class="card-icon pe-4">
            <span class="badge bg-label-success rounded-pill p-2">
              <i class="ti ti-file-analytics ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
      <div class="row mt-3" style="margin-left:1px; margin-right:1px; border-bottom: 8px solid black; border-bottom-left-radius:5px; border-bottom-right-radius:5px">
        <div class="col-5 text-center">
          <h6 class="mb-0 me-2">Total Lamaran</h6>
          <h4 class="mt-2 mb-0">8</h4>
        </div>
        <div class="col-2">
          <div class="divider divider-vertical">
          </div>
        </div>
        <div class="col-5 text-center">
          <h6 class="mb-0 me-2">Belum di Proses</h6>
          <h4 class="mt-2 mb-0">3</h4>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-sm-6 mb-4">
    <div class="card">
      <div class="p-2">
        <div class="d-flex justify-content-between">
          <h5 class="mb-0 ms-2">Proses Seleksi</h5>
          <div class="card-icon pe-4">
            <span class="badge bg-label-success rounded-pill p-2">
              <i class="ti ti-clock ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
      <div class="row mt-3" style="margin-left:1px; margin-right:1px; border-bottom: 8px solid #00CFE8; border-bottom-left-radius:5px; border-bottom-right-radius:5px">
        <div class="col-3 text-center">
          <h6 class="mb-0 me-2">Screening</h6>
          <h4 class="mt-2 mb-0">8</h4>
        </div>
        <div class="col-1-5">
          <div class="divider divider-vertical">
          </div>
        </div>
        <div class="col-3 text-center">
          <h6 class="mb-0 me-2">Seleksi</h6>
          <h4 class="mt-2 mb-0">3</h4>
        </div>
        <div class="col-1-5">
          <div class="divider divider-vertical">
          </div>
        </div>
        <div class="col-3 text-center">
          <h6 class="mb-0 me-2">Penawaran</h6>
          <h4 class="mt-2 mb-0">3</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-sm-6 mb-4">
    <div class="card">
      <div class="p-2">
        <div class="d-flex justify-content-between">
          <h5 class="mb-0 ms-2">Hasil Akhir</h5>
          <div class="card-icon pe-4">
            <span class="badge bg-label-success rounded-pill p-2">
              <i class="ti ti-clipboard ti-sm"></i>
            </span>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-5 text-center" style=" border-bottom: 8px solid green; border-bottom-left-radius:5px; margin-left: 10px; width: 222px;">
          <h6 class="mb-0 me-2">Total Lamaran</h6>
          <h4 class="mt-2 mb-0">8</h4>
        </div>
        <div class="col-2 p-0" style="width: 2px;">
          <div class="divider divider-vertical">
          </div>
        </div>
        <div class="col-5 text-center" style=" border-bottom: 8px solid red; border-bottom-right-radius:5px; width: 221px;">
          <h6 class="mb-0 me-2">Belum di Proses</h6>
          <h4 class="mt-2 mb-0">3</h4>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-md-3 col-12 ms-5 mt-2 mb-2">
  <select class="select2 form-select" data-placeholder="Status Lamaran">
    <option value="1">Status Lamaran</option>
    <option value="2">Seleksi Tahap 1</option>
    <option value="3">Seleksi Tahap 2</option>
    <option value="4">Screening</option>
    <option value="5">Penawaran</option>
    <option value="6">Diterima</option>
    <option value="7">Ditolak</option>
  </select>
</div> -->

<div class="row ms-5 me-5">
  <div class="card mt-4">
    <div class="card-body">
      <div class="alert alert-danger alert-dismissible" role="alert">
        Lakukan konfirmasi penerimaan sebelum tanggal 28 Juli 2023!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <a href="/kegiatan_saya/lamaran_saya/status" style="color:#4B4B4B">
        <div class="row">
          <div class="col-2">
            <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
            </figure>
          </div>
          <div class="col-10 d-flex justify-content-between">
            <div>
              <h5>Fullstack Developer</h5>
              <p>IT-Computer - Software</p>
            </div>
            <div>
              <span class="badge bg-label-warning me-1 text-end">Penawaran</span>
            </div>
          </div>
        </div>
        <div class="text-left">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac risus sem. Sed sapien purus, consectetur ac elit non, iaculis bibendum quam. In sed risus quis urna molestie interdum in eu quam. Mauris id dolor semper, fermentum mi non, consectetur ex. Duis aliquam, tortor ut dictum sodales, mauris erat imperdiet lorem, in eleifend purus nisi vitae sapien. Suspendisse eget viverra ex. Sed malesuada elit ut magna interdum finibus. Nulla volutpat posuere felis, ac tempor turpis hendrerit pretium. Duis dictum posuere augue vel aliquet. </p>
        </div>
        <div class="text-left">
          <a href="/kegiatan_saya/lamaran_saya/status"><button type="button" class="btn btn-success waves-effect me-2">Ambil Tawaran
            </button></a>
          <a href="/kegiatan_saya/lamaran_saya/status"><button type="button" class="btn btn-danger waves-effect">Tolak
            </button></a>
        </div>
        <hr />
        <div class="row mt-2">
          <div class="col-12 d-flex justify-content-between">
            <div class="col-6">
              <div class="tf-icons ti ti-map-pin" style="font-size: medium;"> Jakarta Selatan, Indonesia</div>
              <div class="tf-icons ti ti-currency-dollar ms-3" style="font-size: medium;"> Berbayar</div>
              <div class="tf-icons ti ti-calendar-time ms-3" style="font-size: medium;"> 2 Semester</div>
              <div class="tf-icons ti ti-users ms-3" style="font-size: medium;"> 5 Kuota Penerimaan</div>
            </div>
            <div class="col-6">
              <div class="text-end" style="font-size: medium; color : #4EA971"> Lamaran terkirim pada 15 juni 2023</div>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>

  <div class="card mt-4 mb-5">
    <div class="card-body"> <a href="/kegiatan_saya/lamaran_saya/status" style="color:#4B4B4B">
        <div class="row">
          <div class="col-2">
            <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
            </figure>
          </div>
          <div class="col-10 d-flex justify-content-between">
            <div>
              <h5>Fullstack Developer</h5>
              <p>IT-Computer - Software</p>
            </div>
            <div>
              <span class="badge bg-label-secondary me-1 text-end">Belum Proses</span>
            </div>
          </div>
        </div>
        <div class="text-left">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac risus sem. Sed sapien purus, consectetur ac elit non, iaculis bibendum quam. In sed risus quis urna molestie interdum in eu quam. Mauris id dolor semper, fermentum mi non, consectetur ex. Duis aliquam, tortor ut dictum sodales, mauris erat imperdiet lorem, in eleifend purus nisi vitae sapien. Suspendisse eget viverra ex. Sed malesuada elit ut magna interdum finibus. Nulla volutpat posuere felis, ac tempor turpis hendrerit pretium. Duis dictum posuere augue vel aliquet. </p>
        </div>
        <hr />
        <div class="row mt-2">
          <div class="col-12 d-flex justify-content-between">
            <div class="col-6">
              <div class="tf-icons ti ti-map-pin" style="font-size: medium;"> Jakarta Selatan, Indonesia</div>
              <div class="tf-icons ti ti-currency-dollar ms-3" style="font-size: medium;"> Berbayar</div>
              <div class="tf-icons ti ti-calendar-time ms-3" style="font-size: medium;"> 2 Semester</div>
              <div class="tf-icons ti ti-users ms-3" style="font-size: medium;"> 5 Kuota Penerimaan</div>
            </div>
            <div class="col-6">
              <div class="text-end" style="font-size: medium; color : #4EA971"> Lamaran terkirim pada 15 juni 2023</div>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

<!-- <nav aria-label="">
  <ul class="pagination d-flex justify-content-end" style="margin-right: 74px;">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item">
      <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav> -->


@endsection

@section('page_script')

@endsection