@extends('partials_mahasiswa.template')

@section('page_style')

<link rel="stylesheet" href="{{ url('assets/css/yearpicker.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/monthpicker.css') }}">


<style>
  .hidden {
    display: none;
  }

  .btn-success {
    color: #fff;
    background-color: #4EA971 !important;
    border-color: #4EA971 !important;
  }

  .nav-pills .nav-link.active,
  .nav-pills .nav-link.active:hover,
  .nav-pills .nav-link.active:focus {
    background-color: #4EA971 !important;
    color: #fff;
  }

  .nav-tabs .nav-link:not(.active):hover,
  .nav-tabs .nav-link:not(.active):focus,
  .nav-pills .nav-link:not(.active):hover,
  .nav-pills .nav-link:not(.active):focus {
    color: #4EA971 !important;
  }

  .nav-tabs:not(.nav-fill):not(.nav-justified) .nav-link,
  .nav-pills:not(.nav-fill):not(.nav-justified) .nav-link {
    margin-right: 0.125rem;
    width: 100%;
    font-size: medium;
  }

  .progress-bar {
    background-color: #4EA971 !important;
    color: #fff;
  }

  .select2-results__option[role="option"][aria-selected="true"] {
    background-color: #4EA971 !important;
    color: #fff;
  }

  .select2-container--default .select2-results__option--highlighted:not([aria-selected="true"]) {
    background-color: rgba(115, 103, 240, 0.08) !important;
    color: #4EA971 !important;
  }

  .form-check-input:checked,
  .form-check-input[type=checkbox]:indeterminate {
    background-color: #4EA971 !important;
    border-color: #4EA971 !important;
  }

  .light-style .tagify__tag .tagify__tag-text {
    color: #4EA971 !important;
  }
</style>

@endsection

@section('main')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="sec-title mt-4 mb-4">
    <div class="row">
      <div class="col-6 pe-5">
        <h4>Profil Saya</h4>
      </div>
      <div class="col-4 ps-5 pe-0">
        <div class="d-flex justify-content-between">
          <h6 class="text-start">Kelengkapan Profil</h6>
          <h6 class="text-end">68%</h6>
        </div>
        <div class="progress">
          <div class="progress-bar w-75" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
      <div class="col-2 text-end ps-0">
        <button class="btn btn-secondary buttons-collection  btn-label-success ms-4 mt-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false"><span><i class="ti ti-download me-sm-1"></i> <span class="d-none d-sm-inline-block">Ekspor PDF</span></span></button>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
      <!-- User Profile-->
      <div class="card mb-4">
        <div class="card-body pb-0">
          <div class="d-flex justify-content-between border-bottom">
            <h5 class="text-secondary">Informasi Pribadi</h5>
            <i class="menu-icon tf-icons ti ti-edit text-warning" data-bs-toggle="modal" data-bs-target="#modalEditInformasi"></i>
          </div>
          <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
              <img class="img-fluid rounded mb-3 pt-1 mt-4" src="../../app-assets/img/avatars/15.png" height="100" width="100" alt="User avatar" />
              <div class="user-info text-center">
                <h4 class="mb-2">Violet Mendoza</h4>
                <span class="badge bg-label-success mt-1">Fullstack Developer</span>
              </div>
            </div>
          </div>
          <div class="border-bottom mb-3">
            <p class="mt-4 mb-0">Pengembang perangkat lunak berpengalaman selama 7 tahun dengan keahlian dalam pengembangan aplikasi web, manajemen proyek, dan kerja tim lintas disiplin.</p>
            <p class="content-new mb-0 mt-0"> Sertifikasi dalam manajemen proyek. Analitis, adaptif, dan berkomitmen pada kemajuan teknologi.</p>
            <u class="show_hide_new cursor-pointer" style="color:#4EA971">
              See more
            </u>
          </div>
          <div class="info-container">
            <ul class="list-unstyled">
              <li class="mb-1">
                <span class="fw-semibold me-1">NIM:</span>
                <span>6705513025</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Universitas:</span>
                <span>Universitas Telkom</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Fakultas:</span>
                <span>Fakultas Ilmu Terapan</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Program Studi:</span>
                <span>D3 Sistem Informasi</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Angkatan:</span>
                <span>2021</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">IPK:</span>
                <span>4.00</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Eprt:</span>
                <span>1000</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">TAK:</span>
                <span>100</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Email:</span>
                <span>jennieruby123@gmail.com</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">No.Telp:</span>
                <span>087654321234</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Tanggal Lahir:</span>
                <span>01 Januari 2000</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Jenis Kelamin:</span>
                <span>Perempuan</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Alamat:</span>
                <span>Jln. Rancabolang No. 12</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /User Profile -->
    </div>
    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
      <!-- User Pills -->
      <ul class="nav nav-pills mb-3 " role="tablist">
        <li class="nav-item" style="font-size: small;">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-informasi-tambahan" aria-controls="navs-pills-justified-informasi-tambahan" aria-selected="false">
            Informasi Tambahan
          </button>
        </li>
        <li class="nav-item" style="font-size: small;">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-pendidikan" aria-controls="navs-pills-justified-pendidikan" aria-selected="false">
            Pendidikan
          </button>
        </li>
        <li class="nav-item" style="font-size: small;">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-keahlian-pengalaman" aria-controls="navs-pills-justified-keahlian-pengalaman" aria-selected="false">
            Keahlian & Pengalaman
          </button>
        </li>
        <li class="nav-item" style="font-size: small;">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-dokumen-pendukung" aria-controls="navs-pills-justified-dokumen-pendukung" aria-selected="false">
            Dokumen Pendukung
          </button>
        </li>
      </ul>
      <!--/ User Pills -->

      <!-- Content -->
      <div class="tab-content p-0">

        <!-- Informasi Tambahan -->
        <div class="tab-pane fade show active" id="navs-pills-justified-informasi-tambahan" role="tabpanel">
          <div class="card mb-4">
            <div class="d-flex justify-content-between border-bottom pt-3 ps-3 pe-3">
              <h5 class="text-secondary">Informasi Tambahan</h5>
              <i class="menu-icon tf-icons ti ti-edit text-warning" data-bs-toggle="modal" data-bs-target="#modalEditInformasiTambahan"></i>
            </div>
            <div class="card-body pb-0">
              <div class="row">
                <div class="col-6">
                  <p class="mb-2 pt-1">
                    <span class="fw-semibold me-1">Lokasi Kerja yang diharapkan:</span>
                    <span>Bandung</span>
                  </p>
                </div>
                <div class="col-6">
                  <p class="mb-2 pt-1">
                    <span class="fw-semibold me-1">Instagram:</span>
                    <span><u style="color: blue;">jennierubyjane</u></span>
                  </p>
                  <p class="mb-2 pt-1">
                    <span class="fw-semibold me-1">Linkedin:</span>
                    <span><u style="color: blue;">jennierubyjane</u></span>
                  </p>
                </div>
                <p class="mb-2 pt-0">
                  <span class="fw-semibold me-1">Bahasa:</span>
                </p>
                <p class="mb-4">
                  <span class="btn rounded-pill btn-success waves-effect waves-light">Bahasa Indonesia</span>
                  <span class="btn rounded-pill btn-success waves-effect waves-light">Bahasa Inggris</span>
                  <span class="btn rounded-pill btn-success waves-effect waves-light">Bahasa Jepang</span>
                  <span class="btn rounded-pill btn-success waves-effect waves-light">Bahasa Korea</span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- /Informasi Tambahan -->

        <!-- <pendidikan> -->
        <div class="tab-pane fade show" id="navs-pills-justified-pendidikan" role="tabpanel">
          <div class="card mb-4">
            <div class="d-flex justify-content-between border-bottom pt-3 ps-3 pe-3">
              <h5 class="text-secondary">Pendidikan</h5>
              <i class="menu-icon tf-icons ti ti-plus text-success" data-bs-toggle="modal" data-bs-target="#modalTambahPendidikan"></i>
            </div>
            <div class="card-body pb-0">
              <ul class="timeline mb-0">
                <li class="timeline-item timeline-item-transparent">
                  <span class="timeline-point timeline-point-success"></span>
                  <div class="timeline-event">
                    <div class="timeline-header">
                      <h6 class="mb-0">University Of Melbourne</h6>
                      <div>
                        <i class="menu-icon tf-icons ti ti-edit text-warning" data-bs-toggle="modal" data-bs-target="#modalEditPendidikan"></i>
                        <i class="menu-icon tf-icons ti ti-trash text-danger" data-bs-toggle="modal" data-bs-target="#ModalDeletePendidikan"></i>
                      </div>
                    </div>
                    <div class="border-bottom mb-3">
                      <p class="mb-1">Magister Management</p>
                      <p class="mb-1">IPK 3.89/4.00 </p>
                      <p style="font-size: small;">Juli 2022 - Juli 2024</p>
                    </div>
                  </div>
                </li>
                <li class="timeline-item timeline-item-transparent">
                  <span class="timeline-point timeline-point-success"></span>
                  <div class="timeline-event pt-0">
                    <div class="timeline-header">
                      <h6 class="mb-0">University Of Melbourne</h6>
                      <div>
                        <i class="menu-icon tf-icons ti ti-edit text-warning" data-bs-toggle="modal" data-bs-target="#modalEditPendidikan"></i>
                        <i class="menu-icon tf-icons ti ti-trash text-danger" data-bs-toggle="modal" data-bs-target="#ModalDeletePendidikan"></i>
                      </div>
                    </div>
                    <div class="border-bottom mb-3">
                      <p class="mb-1">Magister Management</p>
                      <p class="mb-1">IPK 3.89/4.00 </p>
                      <p style="font-size: small;">Juli 2022 - Juli 2024</p>
                    </div>
                  </div>
                </li>
                <li class="timeline-item timeline-item-transparent border-0">
                  <span class="timeline-point timeline-point-success"></span>
                  <div class="timeline-event pt-0">
                    <div class="timeline-header">
                      <h6 class="mb-0">University Of Melbourne</h6>
                      <div>
                        <i class="menu-icon tf-icons ti ti-edit text-warning" data-bs-toggle="modal" data-bs-target="#modalEditPendidikan"></i>
                        <i class="menu-icon tf-icons ti ti-trash text-danger" data-bs-toggle="modal" data-bs-target="#ModalDeletePendidikan"></i>
                      </div>
                    </div>
                    <p class="mb-1">Magister Management</p>
                    <p class="mb-1">IPK 3.89/4.00 </p>
                    <p style="font-size: small;">Juli 2022 - Juli 2024</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- </pendidikan> -->

        <!-- <Keahlian&Pengalaman> -->
        <div class="tab-pane fade show" id="navs-pills-justified-keahlian-pengalaman" role="tabpanel">
          <div class="card mb-4">
            <div class="d-flex justify-content-between pt-3 ps-3 pe-3">
              <h5 class="text-secondary">Keahlian</h5>
              <div class="text-end">
                <i class="menu-icon tf-icons ti ti-plus text-success" data-bs-toggle="modal" data-bs-target="#modalTambahKeahlian"></i>
                <br>
                <i class="menu-icon tf-icons ti ti-edit text-warning mt-2" data-bs-toggle="modal" data-bs-target="#modalEditKeahlian"></i>
              </div>
            </div>
            <div class="card-body pb-0 pt-0">
              <div>
                <span class="btn rounded-pill btn-success waves-effect waves-light">Figma</span>
                <span class="btn rounded-pill btn-success waves-effect waves-light">Zeplin</span>
                <span class="btn rounded-pill btn-success waves-effect waves-light">Figma</span>
                <span class="btn rounded-pill btn-success waves-effect waves-light">Zeplin</span>
              </div>
              <div class="border-bottom mt-3"></div>
              <div class="d-flex justify-content-between pt-3 pb-3">
                <h5 class="text-secondary">Pengalaman</h5>
                <div class="text-end">
                  <i class="menu-icon tf-icons ti ti-plus text-success" data-bs-toggle="modal" data-bs-target="#modalTambahPengalaman"></i>
                </div>
              </div>
              <ul class="timeline mb-0">
                <li class="timeline-item timeline-item-transparent">
                  <span class="timeline-point timeline-point-success"></span>
                  <div class="timeline-event">
                    <div class="timeline-header">
                      <h6 class="mb-0">UIUX Designer</h6>
                      <div>
                        <i class="menu-icon tf-icons ti ti-edit text-warning" data-bs-toggle="modal" data-bs-target="#modalEditPengalaman"></i>
                        <i class="menu-icon tf-icons ti ti-trash text-danger" data-bs-toggle="modal" data-bs-target="#deleteModalPengalaman"></i>
                      </div>
                    </div>
                    <div class="border-bottom mb-3">
                      <p class="mb-1">Techno Infinity - Internship</p>
                      <p style="font-size: small;">Juli 2022 - Present/p>
                      <div>
                        <p class="mb-0">Lorem ÅF and Pöyry joined forces in order to become an international engineering, design and advisory company,</p>
                        <p class="content-new mb-0">driving digitalisation and sustainability for the energy, infrastructure and industrial sectors all over the world.</p>
                        <u class="show_hide_new cursor-pointer" style="color:#4EA971">
                          See more
                        </u>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="timeline-item timeline-item-transparent border-0">
                  <span class="timeline-point timeline-point-success"></span>
                  <div class="timeline-event pt-0">
                    <div class="timeline-header">
                      <h6 class="mb-0">UIUX Designer</h6>
                      <div>
                        <i class="menu-icon tf-icons ti ti-edit text-warning" data-bs-toggle="modal" data-bs-target="#modalEditPengalaman"></i>
                        <i class="menu-icon tf-icons ti ti-trash text-danger" data-bs-toggle="modal" data-bs-target="#deleteModalPengalaman"></i>
                      </div>
                    </div>
                    <p class="mb-1">Techno Infinity - Internship</p>
                    <p style="font-size: small;">Juli 2022 - Present/p>
                    <div>
                      <p class="mb-0">Lorem ÅF and Pöyry joined forces in order to become an international engineering, design and advisory company,</p>
                      <p class="content-new mb-0">driving digitalisation and sustainability for the energy, infrastructure and industrial sectors all over the world.</p>
                      <u class="show_hide_new cursor-pointer" style="color:#4EA971">
                        See more
                      </u>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <a href='/detail-informasi-pengalaman'>
              <button class="btn btn-outline-success btn-lg toggle-button ms-5 me-5 mb-5 mt-2" style="width: 824px" type="button">Selengkapnya</button>
            </a>
          </div>
        </div>
        <!-- </Keahlian&Pengalaman> -->

        <!-- <Dokumen Pendukung> -->
        <div class="tab-pane fade show" id="navs-pills-justified-dokumen-pendukung" role="tabpanel">
          <div class="card mb-4">
            <div class="d-flex justify-content-between border-bottom pt-3 ps-3 pe-3">
              <h5 class="text-secondary">Dokumen Pendukung</h5>
              <i class="menu-icon tf-icons ti ti-plus text-success" data-bs-toggle="modal" data-bs-target="#modalTambahDokumen"></i>
            </div>
            <div class="card-body pb-0">
              <ul class="timeline mb-0">
                <li class="timeline-item timeline-item-transparent">
                  <span class="timeline-point timeline-point-success"></span>
                  <div class="timeline-event">
                    <div class="timeline-header">
                      <h6 class="mb-0">UIUX Designer</h6>
                      <div>
                        <i class="menu-icon tf-icons ti ti-edit text-warning" data-bs-toggle="modal" data-bs-target="#modalEditDokumen"></i>
                        <i class="menu-icon tf-icons ti ti-trash text-danger" data-bs-toggle="modal" data-bs-target="#ModalDelete"></i>
                      </div>
                    </div>
                    <div class="border-bottom mb-3">
                      <p class="mb-1">Coursera</p>
                      <p style="font-size: small;">Juli 2022 - Present/p>
                      <div>
                        <p class="mb-0">Lorem ÅF and Pöyry joined forces in order to become an international engineering, design and advisory company,</p>
                        <p class="content-new mb-0">driving digitalisation and sustainability for the energy, infrastructure and industrial sectors all over the world.</p>
                        <u class="show_hide_new cursor-pointer" style="color:#4EA971">
                          See more
                        </u>
                      </div>
                      <div class="d-flex align-items-start mt-3 mb-3">
                        <div>
                          <img src="../../app-assets/img/avatars/2.png">
                        </div>
                        <div class="me-2 ms-4">
                          <h6 class="mt-5">UI/UX Website.pdf</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="timeline-item timeline-item-transparent border-0">
                  <span class="timeline-point timeline-point-success"></span>
                  <div class="timeline-event pt-0">
                    <div class="timeline-header">
                      <h6 class="mb-0">UIUX Designer</h6>
                      <div>
                        <i class="menu-icon tf-icons ti ti-edit text-warning" data-bs-toggle="modal" data-bs-target="#modalEditDokumen"></i>
                        <i class="menu-icon tf-icons ti ti-trash text-danger" data-bs-toggle="modal" data-bs-target="#ModalDelete"></i>
                      </div>
                    </div>
                    <p class="mb-1">Coursera</p>
                    <p style="font-size: small;">Juli 2022 - Present/p>
                    <div>
                      <p class="mb-0">Lorem ÅF and Pöyry joined forces in order to become an international engineering, design and advisory company,</p>
                      <p class="content-new mb-0">driving digitalisation and sustainability for the energy, infrastructure and industrial sectors all over the world.</p>
                      <u class="show_hide_new cursor-pointer" style="color:#4EA971">
                        See more
                      </u>
                    </div>
                    <div class="d-flex align-items-start mt-3 mb-3">
                      <div>
                        <img src="../../app-assets/img/avatars/2.png">
                      </div>
                      <div class="me-2 ms-4">
                        <h6 class="mt-5">UI/UX Website.pdf</h6>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <a href='/detail-informasi-dokumen'>
              <button class="btn btn-outline-success btn-lg toggle-button ms-5 me-5 mb-5 mt-2" style="width: 824px" type="button">Selengkapnya</button>
            </a>
          </div>
        </div>
        <!-- </Dokumen Pendukung> -->
      </div>
      <!-- </Content> -->
    </div>
  </div>


  <!-- Modal Edit Informasi Pribadi -->
  <div class="modal fade" id="modalEditInformasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">Informasi Pribadi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Account -->
        <div class="modal-body">
          <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
            <img src="../../app-assets/img/avatars/15.png" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
            <div class="button-wrapper">
              <label for="upload" class="btn btn-success me-2 mb-3" tabindex="0">
                <span class="d-none d-sm-block">Unggah Foto Baru</span>
                <i class="ti ti-upload d-block d-sm-none"></i>
                <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
              </label>
              <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Atur Ulang</span>
              </button>

              <div class="text-muted">Format FIle JPG, GIF atau PNG. Ukuran Maksimal 800KB</div>
            </div>
          </div>
          <div class="border-top">
            <form id="formAccountSettings" method="POST" onsubmit="return false">
              <div class="row mt-4">
                <div class="mb-3 col-md-6">
                  <label for="NIM" class="form-label">NIM <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="nim" name="nim" value="6705513025" placeholder="6705513025" disabled />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="Name" class="form-label">Nama Lengkap <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="namalengkap" name="namalengkap" value="Violet Mendoza" autofocus disabled />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="Universitas" class="form-label">Universitas <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="universitas" name="universitas" value="Telkom University" autofocus disabled />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="Fakultas" class="form-label">Fakultas <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="fakultas" name="fakultas" value="Fakultas Ilmu Terapan" autofocus disabled />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="Prodi" class="form-label">Program Studi <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="prodi" name="prodi" value="D3 Sistem Informasi" autofocus disabled />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="angkatan" class="form-label">Angkatan <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="angkatan" name="prodi" value="2021" autofocus disabled />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="Email" class="form-label">Email <span style="color: red;">*</span></label>
                  <input class="form-control" type="email" id="email" name="email" value="jennieruby123@gmail.com" autofocus disabled />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="notelp">No. Telp</label>
                  <input type="text" id="notelp" name="notelp" class="form-control" placeholder="089123456789" autofocus disabled />
                </div>
                <div class="mb-3 col-md-4">
                  <label for="IPK" class="form-label">IPK <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="ipk" name="ipk" placeholder="4.00" autofocus />
                </div>
                <div class="mb-3 col-md-4">
                  <label for="EPRT" class="form-label">EPRT <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="eprt" name="eprt" placeholder="550" autofocus />
                </div>
                <div class="mb-3 col-md-4">
                  <label for="TAK" class="form-label">TAK <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="tak" name="tak" placeholder="100" autofocus />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="tanggallahir" class="form-label">Tanggal Lahir <span style="color: red;">*</span></label>
                  <input type="text" class="form-control flatpickr-input" placeholder="YYYY-MM-DD" id="tanggallahir" readonly="readonly">
                </div>
                <div class="mb-3 col-md-6">
                  <label for="jeniskelamin" class="form-label">Jenis Kelamin <span style="color: red;">*</span></label>
                  <div class="form-check">
                    <div class="row">
                      <div class="col-3">
                        <input name="default-radio-1" class="form-check-input" type="radio" value="" id="defaultRadio2" checked="">
                        <label class="form-check-label" for="defaultRadio2"> Laki-Laki </label>
                      </div>
                      <div class="col-3 ms-2">
                        <input name="default-radio-1" class="form-check-input" type="radio" value="" id="defaultRadio2" checked="">
                        <label class="form-check-label" for="defaultRadio2"> Perempuan </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb-3 col-md-12">
                  <label for="headliner" class="form-label">Headliner</label>
                  <input class="form-control" type="text" id="headliner" name="headliner" placeholder="cth. UI/UX Desginer" />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="alamat" class="form-label">Alamat <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="alamat" name="alamat" placeholder="Jln. Rancabolang No. 12" disabled />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="deskripsi" class="form-label">Deskripsi Diri</label>
                  <textarea class="form-control" type="text" id="deskripsi" name="deskripsi" placeholder="Deskripsi Diri"></textarea>
                </div>
              </div>
              <div class="modal-footer p-0">
                <button type="submit" class="btn btn-success m-0">Simpan Data</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /Account -->
      </div>
    </div>
  </div>

  <!-- Modal Edit Informasi Tambahan -->
  <div class="modal fade" id="modalEditInformasiTambahan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">Edit Informasi Tambahan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <hr />
        </div>

        <div class="modal-body p-0 ms-5 me-5">
          <form id="" method="POST" onsubmit="return false">
            <div class="row">
              <div class="mb-3 col-md-12 p-0 ">
                <label for="lokasikerja" class="form-label">Lokasi kerja yang diharapkan <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="lokasikerja" name="lokasikerja" placeholder="Lokasi Kerja" />
              </div>
              <div class="border mb-3" style="border-radius: 8px;">
                <div class="form-repeater">
                  <div data-repeater-list>
                    <div data-repeater-item>
                      <div class="row mt-2 me-1">
                        <div class="mb-3 col-md-11">
                          <label class="form-label" for="bahasa">Bahasa <span style="color: red;">*</span></label>
                          <select id="bahasa" class="form-select">
                            <option disabled selected>Pilih Jenis Bahasa</option>
                            <option value="bahasa">Indonesia</option>
                            <option value="bahasa">Inggris</option>
                            <option value="bahasa">Korea</option>
                            <option value="bahasa">Jepang</option>
                          </select>
                        </div>
                        <div class="mb-3 col-md-1 mb-0">
                          <button type="button" class="btn btn-outline-danger mt-4 waves-effect" style="width:0px" data-repeater-delete="">
                            <i class="ti ti-trash fa-lg"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <button type="button" class="btn btn-outline-success waves-effect" data-repeater-create="">
                      <span class="align-middle">Tambah</span>
                    </button>
                  </div>
                </div>
              </div>
              <div class="border " style="border-radius: 8px;">
                <div class="form-repeater">
                  <div data-repeater-list="">
                    <div data-repeater-item="">
                      <div class="row mt-2 me-1">
                        <div class="mb-3 col-md-4">
                          <label for="sosial" class="form-label">Sosial Media <span style="color: red;">*</span></label>
                          <select id="media" class="form-select">
                            <option disabled selected>Pilih Sosial Media</option>
                            <option value="media">Instagram</option>
                            <option value="media">Linkedin</option>
                            <option value="media">Facebook</option>
                            <option value="media">Twiteer</option>
                          </select>
                        </div>
                        <div class="mb-3 col-md-7">
                          <input class="form-control mt-4" type="text" id="username" name="username" placeholder="URL/Username" />
                        </div>
                        <div class="mb-3 col-md-1">
                          <button type="button" class="btn btn-outline-danger mt-4 waves-effect" style="width:0px" data-repeater-delete="">
                            <i class="ti ti-trash fa-lg"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <button type="button" class="btn btn-outline-success waves-effect" data-repeater-create="">
                      <span class="align-middle">Tambah</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer pt-3 pe-0">
              <button type="submit" class="btn btn-success m-0">Simpan Data</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal Tambah Pendidikan -->
  <div class="modal fade" id="modalTambahPendidikan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">Tambah Pendidikan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form" method="POST" onsubmit="return false">
            <div class="row">
              <div class="mb-3 col-md-12">
                <label for="namasekolah" class="form-label">Nama Sekolah/Universitas<span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="namasekolah" name="namasekolah" value="" placeholder="Nama Sekolah" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="pendidikan" class="form-label">Tingkat Pendidkan<span style="color: red;">*</span></label>
                <select id="pendidikan" class="select2 form-select">
                  <option disabled selected>Pilih Tingkat Pendidkan</option>
                  <option value="pendidikan">D3</option>
                  <option value="pendidikan">S1</option>
                </select>
              </div>
              <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Mulai<span style="color: red;">*</span></label>
                <input type="month" id="month" class="form-control" placeholder="Month" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Berakhir<span style="color: red;">*</span></label>
                <input type="month" id="month" class="form-control" placeholder="Month" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="IPK" class="form-label">IPK</label>
                <input class="form-control" type="text" id="ipk" name="ipk" placeholder="4.00" autofocus />
              </div>
            </div>
            <div class="modal-footer p-0">
              <button type="submit" class="btn btn-success m-0">Simpan Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit Pendidikan -->
  <div class="modal fade" id="modalEditPendidikan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">Edit Pendidikan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form" method="POST" onsubmit="return false">
            <div class="row">
              <div class="mb-3 col-md-12">
                <label for="namasekolah" class="form-label">Nama Sekolah/Universitas<span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="namasekolah" name="namasekolah" value="" placeholder="Nama Sekolah" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="pendidikan" class="form-label">Tingkat Pendidkan<span style="color: red;">*</span></label>
                <select id="pendidikan" class="select2 form-select">
                  <option disabled selected>Pilih Tingkat Pendidkan</option>
                  <option value="pendidikan">D3</option>
                  <option value="pendidikan">S1</option>
                </select>
              </div>
              <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Mulai<span style="color: red;">*</span></label>
                <input type="month" id="month" class="form-control" placeholder="Month" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Berakhir<span style="color: red;">*</span></label>
                <input type="month" id="month" class="form-control" placeholder="Month" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="IPK" class="form-label">IPK</label>
                <input class="form-control" type="text" id="ipk" name="ipk" placeholder="4.00" autofocus />
              </div>
            </div>
            <div class="modal-footer p-0">
              <button type="submit" class="btn btn-success m-0">Simpan Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Keahlian -->
  <div class="modal fade" id="modalTambahKeahlian" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">Tambah Keahlian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body border-top mt-3">
          <form id="" method="POST" onsubmit="return false">
            <div class="row">
              <div class="mb-3 col-md-12">
                <label for="TagifyBasic" class="form-label">Keahlian<span style="color: red;">*</span></label>
                <input id="TagifyBasic" class="form-control" name="TagifyBasic" value="" />
              </div>
            </div>
            <div class="modal-footer p-0">
              <button type="submit" class="btn btn-success m-0">Simpan Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit Keahlian -->
  <div class="modal fade" id="modalEditKeahlian" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">Edit Keahlian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body border-top mt-3">
          <form id="" method="POST" onsubmit="return false">
            <div class="row">
              <div class="mb-3 col-md-12">
                <label for="TagifyBasic1" class="form-label">Keahlian<span style="color: red;">*</span></label>
                <input id="TagifyBasic1" class="form-control" name="TagifyBasic1" value="" />
              </div>
            </div>
            <div class="modal-footer p-0">
              <button type="submit" class="btn btn-success m-0">Simpan Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Pengalaman -->
  <div class="modal fade" id="modalTambahPengalaman" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">Tambah Pengalaman</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Account -->
        <div class="modal-body border-top mt-3">
          <div class="d-flex align-items-start align-items-sm-center gap-4 mb-2">
          </div>
          <form id="formAccountSettings" method="POST" onsubmit="return false">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="posisi" class="form-label">Posisi / Bidang <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="posisi" name="posisi" placeholder="Ex: UI/UX Designer" />
              </div>
              <div class="mb-3 col-md-6">
                <label for="pekerjaan" class="form-label">Jenis Pekerjaan <span style="color: red;">*</span></label>
                <select id="pekerjaan" class="select2 form-select">
                  <option disabled selected>Pilih Jenis Pekerjaan</option>
                  <option value="Pekerjaan">Pekerjaan</option>
                  <option value="Pekerjaan">Pekerjaan</option>
                </select>
              </div>
              <div class="mb-3 col-md-12">
                <label for="namaperusahaan" class="form-label">Nama Perusahaan <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="namaperusahaan" name="namaperusahaan" placeholder="Ex: PT Techno Infinity" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Mulai<span style="color: red;">*</span></label>
                <input type="month" id="month" class="form-control" placeholder="Month" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Berakhir<span style="color: red;">*</span></label>
                <input type="month" id="month" class="form-control" placeholder="Month" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" type="text" id="deskripsi" name="deskripsi" placeholder="Ketik di sini..."></textarea>
              </div>
            </div>
            <div class="modal-footer p-0">
              <button type="submit" class="btn btn-success m-0">Simpan Data</button>
            </div>
          </form>

        </div>
        <!-- /Account -->
      </div>
    </div>
  </div>

  <!-- Modal Edit Pengalaman -->
  <div class="modal fade" id="modalEditPengalaman" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">Edit Pengalaman</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Account -->
        <div class="modal-body border-top mt-3">
          <div class="d-flex align-items-start align-items-sm-center gap-4 mb-2">
          </div>
          <form id="formAccountSettings" method="POST" onsubmit="return false">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="posisi" class="form-label">Posisi / Bidang <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="posisi" name="posisi" placeholder="Ex: UI/UX Designer" />
              </div>
              <div class="mb-3 col-md-6">
                <label for="pekerjaan2" class="form-label">Jenis Pekerjaan <span style="color: red;">*</span></label>
                <select id="pekerjaan2" class="select2 form-select">
                  <option disabled selected>Pilih Jenis Pekerjaan</option>
                  <option value="Pekerjaan">Pekerjaan</option>
                  <option value="Pekerjaan">Pekerjaan</option>
                </select>
              </div>
              <div class="mb-3 col-md-12">
                <label for="namaperusahaan" class="form-label">Nama Perusahaan <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="namaperusahaan" name="namaperusahaan" placeholder="Ex: PT Techno Infinity" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Mulai<span style="color: red;">*</span></label>
                <input type="month" id="month" class="form-control" placeholder="Month" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Berakhir<span style="color: red;">*</span></label>
                <input type="month" id="month" class="form-control" placeholder="Month" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" type="text" id="deskripsi" name="deskripsi" placeholder="Ketik di sini..."></textarea>
              </div>
            </div>
            <div class="modal-footer p-0">
              <button type="submit" class="btn btn-success m-0">Simpan Data</button>
            </div>
          </form>

        </div>
        <!-- /Account -->
      </div>
    </div>
  </div>

  <!-- Modal Tambah Dokumen Pendukung -->
  <div class="modal fade" id="modalTambahDokumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">Tambah Dokumen Pendukung</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Account -->
        <div class="modal-body border-top mt-3">
          <div class="d-flex align-items-start align-items-sm-center gap-4 mb-2">
          </div>
          <form id="formAccountSettings" method="POST" onsubmit="return false">
            <div class="row">
              <div class="mb-3 col-md-12">
                <label for="sertifikat" class="form-label"> Nama Sertifikasi <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="sertifikat" name="sertifikat" placeholder="Masukkan nama sertifikasi " />
              </div>
              <div class="mb-3 col-md-12">
                <label for="penerbit" class="form-label"> Penerbit Sertifikasi <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit " />
              </div>
              <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Terbit<span style="color: red;">*</span></label>
                <input type="month" id="month" class="form-control" placeholder="Month" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Kadaluwarsa<span style="color: red;">*</span></label>
                <input type="month" id="month" class="form-control" placeholder="Month" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="unggahfile" class="form-label">Upload File<span style="color: red;">*</span></label>
                <input class="form-control" type="file" id="unggahfile" multiple="">
              </div>
              <div class="mb-3 col-md-12">
                <label for="link" class="form-label"> Link Sertifikasi <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="link" name="link" placeholder="Masukkan link Sertifikat  " />
              </div>
              <div class="mb-3 col-md-12">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" type="text" id="deskripsi" name="deskripsi" placeholder="Ketik di sini..."></textarea>
              </div>
            </div>
            <div class="modal-footer p-0">
              <button type="submit" class="btn btn-success m-0">Simpan Data</button>
            </div>
          </form>

        </div>
        <!-- /Account -->
      </div>
    </div>
  </div>

  <!-- Modal Edit Dokumen Pendukung -->
  <div class="modal fade" id="modalEditDokumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">Tambah Dokumen Pendukung</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Account -->
        <div class="modal-body border-top mt-3">
          <form id="formAccountSettings" method="POST" onsubmit="return false">
            <div class="row">
              <div class="mb-3 col-md-12">
                <label for="sertifikat" class="form-label"> Nama Sertifikasi <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="sertifikat" name="sertifikat" placeholder="Masukkan nama sertifikasi " />
              </div>
              <div class="mb-3 col-md-12">
                <label for="penerbit" class="form-label"> Penerbit Sertifikasi <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit " />
              </div>
              <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Terbit<span style="color: red;">*</span></label>
                <input type="month" id="month" class="form-control" placeholder="Month" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Kadaluwarsa<span style="color: red;">*</span></label>
                <input type="month" id="month" class="form-control" placeholder="Month" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="unggahfile" class="form-label">Upload File<span style="color: red;">*</span></label>
                <input class="form-control" type="file" id="unggahfile" multiple="">
              </div>
              <div class="mb-3 col-md-12">
                <label for="link" class="form-label"> Link Sertifikasi <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="link" name="link" placeholder="Masukkan link Sertifikat  " />
              </div>
              <div class="mb-3 col-md-12">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" type="text" id="deskripsi" name="deskripsi" placeholder="Ketik di sini..."></textarea>
              </div>
            </div>
            <div class="modal-footer p-0">
              <button type="submit" class="btn btn-success m-0">Simpan Data</button>
            </div>
          </form>

        </div>
        <!-- /Account -->
      </div>
    </div>
  </div>

  <!-- Modal Delete Pengalaman -->
  <div class="modal fade" id="deleteModalPengalaman" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <h5 class="modal-title" id="modal-title">Apakah Anda Ingin menghapus <br> Pengalaman Ini?</h5>
        </div>
        <div class="modal-footer" style="display: flex; justify-content:center;">
          <button type="submit" id="modal-button" class="btn btn-success">Iya</button>
          <button type="submit" id="modal-button" class="btn btn-danger">Tidak</button>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal Delete Dokumen-->
  <div class="modal fade" id="ModalDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <h5 class="modal-title" id="modal-title">Apakah Anda Ingin menghapus <br> Dokumen Pendukung Ini?</h5>
        </div>
        <div class="modal-footer" style="display: flex; justify-content:center;">
          <button type="submit" id="modal-button" class="btn btn-success">Iya</button>
          <button type="submit" id="modal-button" class="btn btn-danger">Tidak</button>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal Delete Pendidikan-->
  <div class="modal fade" id="ModalDeletePendidikan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <h5 class="modal-title" id="modal-title">Apakah Anda Ingin menghapus <br> Pendidikan Ini?</h5>
        </div>
        <div class="modal-footer" style="display: flex; justify-content:center;">
          <button type="submit" id="modal-button" class="btn btn-success">Iya</button>
          <button type="submit" id="modal-button" class="btn btn-danger">Tidak</button>
        </div>

      </div>
    </div>
  </div>

</div>


@endsection

@section('page_script')
<script>
  $(document).ready(function() {
    $(".content-new").hide();
    $(".show_hide_new").on("click", function() {
      var content = $(this).prev('.content-new');
      content.slideToggle(100);
      if ($(this).text().trim() == "See more") {
        $(this).text("See less");
      } else {
        $(this).text("See more");
      }
    });
  });

  $(document).ready(function() {
    $(".yearpicker").yearpicker({
      startYear: new Date().getFullYear() - 10,
      endYear: new Date().getFullYear() + 10,
    });
  });

  $('#month').flatpickr({
    altInput: true,
    altFormat: 'F Y',
    plugins: [
      new monthSelectPlugin({
        dateFormat: "Y-m",
      })
    ]
  });
</script>
<script src="{{ url('assets/js/yearpicker.js') }}"></script>
<script src="{{ url('assets/js/monthpicker.js') }}"></script>
<script src="../../app-assets/js/forms-extras.js"></script>
<script src="../../app-assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>


@endsection