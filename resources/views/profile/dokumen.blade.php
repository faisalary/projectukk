@extends('partials_mahasiswa.template')

@section('page_style')
<link rel="stylesheet" href="{{ url('assets/css/yearpicker.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/monthpicker.css') }}">
<style>
  .btn-success {
    color: #fff;
    background-color: #4EA971 !important;
    border-color: #4EA971 !important;
  }

  .breadcrumb-item,
  .breadcrumb-item a {
    color: #4b465c !important;
  }

  .select2-results__option[role="option"][aria-selected="true"] {
    background-color: #4EA971 !important;
    color: #fff;
  }

  .select2-container--default .select2-results__option--highlighted:not([aria-selected="true"]) {
    background-color: rgba(115, 103, 240, 0.08) !important;
    color: #4EA971 !important;
  }
</style>

@endsection

@section('main')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="sec-title mt-4 mb-4">
    <div class="sec-title mt-4 mb-4">
      <h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">
              Profil
            </li>
            <li class="breadcrumb-item">
              <a href="/informasi/pribadi">Informasi Pribadi</a>
            </li>
            <li class="breadcrumb-item active">Dokumen Pendukung</li>
          </ol>
        </nav>
      </h4>
    </div>
  </div>
  <!-- Dokumen Pendukung -->

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
        <li class="timeline-item timeline-item-transparent">
                  <span class="timeline-point timeline-point-success"></span>
                  <div class="timeline-event pt-0">
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
                <li class="timeline-item timeline-item-transparent">
                  <span class="timeline-point timeline-point-success"></span>
                  <div class="timeline-event pt-0">
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
                <li class="timeline-item timeline-item-transparent">
                  <span class="timeline-point timeline-point-success"></span>
                  <div class="timeline-event pt-0">
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
@endsection