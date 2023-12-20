 <!-- Modal Slide-->
 <div class="offcanvas offcanvas-end" tabindex="-1" id="modalSlide" aria-labelledby="offcanvasAddUserLabel">
     <div class="offcanvas-header">
         <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Filter Berdasarkan</h5>
     </div>
     <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
         <form class="add-new-user pt-0" id="filter">
             <div class="col-12 mb-2">
                 <div class="row">
                     <div class="mb-2">
                         <label for="pelaksanaan" class="form-label">Pelaksanaan Seleksi</label>
                         <select class="form-select select2" data-placeholder="Pilih Pelaksanaan Seleksi"
                             id="pelaksanaanseleksi">
                             <option value="Onsite">Onsite</option>
                             <option value="Online">Online</option>
                         </select>
                     </div>
                 </div>
                 <div class="row">
                     <div class="mb-2">
                         <label for="mulai" class="form-label">Tanggal Seleksi Mulai</label>
                         <input class="form-control" type="date" value="0000-00-00" id="tanggalmulai">
                     </div>
                 </div>
                 <div class="row">
                     <div class="mb-2">
                         <label for="seleksi" class="form-label">Status Seleksi</label>
                         <select class="form-select select2" id="seleksifilter" name="seleksi"
                             data-placeholder="Pilih Status Seleksi">
                             <option value="Sudah Seleksi Tahap 1">Sudah Seleksi Tahap 1</option>
                             <option value="Belum Seleksi Tahap 1">Belum Seleksi Tahap 1</option>
                             <option value="Sudah Seleksi Tahap 2">Sudah Seleksi Tahap 2</option>
                             <option value="Belum Seleksi Tahap 2">Belum Seleksi Tahap 2</option>
                             <option value="Sudah Seleksi Tahap 3">Sudah Seleksi Tahap 3</option>
                             <option value="Belum Seleksi Tahap 3">Belum Seleksi Tahap 3</option>
                         </select>
                     </div>
                 </div>
             </div>
             <div class="mt-3 text-end">
                 <button type="reset" class="btn btn-label-danger data-reset">Reset</button>
                 <button type="submit" class="btn btn-success">Terapkan</button>
             </div>
         </form>
     </div>
 </div>

 <!-- Modal Tambah-->
 <div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header d-block border-bottom">
                 <h5 class="modal-title" id="modal-title">Tambah Jadwal Seleksi Lanjutan</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form class="default-form" method="POST" action="{{ url('jadwal-seleksi/store') }}">
                 @csrf
                 <div class="modal-body">
                     <div class="row">
                         <div class="col mb-2">
                             <label for="select2Disabled" class="form-label">Jenis Tahap</label>
                             <div class="position-relative">
                                 <select id="select2Disabled" class="select2 form-select select2-hidden-accessible"
                                     data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" disabled>
                                     <option value="1">Tahap 1</option>
                                     <option value="2">Option3</option>
                                     <option value="3">Option4</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col mb-2">
                             <label for="flatpickr-multi" class="form-label">Jadwal Pelaksanaan</label>
                             <input type="text" class="form-control flatpickr-input" placeholder="YYYY-MM-DD HH:MM"
                                 id="flatpickr-multi" readonly="readonly">
                         </div>
                     </div>
                     <div class="row">
                         <div class="col mb-2 form-input">
                             <label for="seleksi" class="form-label">Subjek Email</label>
                             <select class="form-select select2" id="subjek" name="subjek"
                                 data-placeholder="Pilih Subjek Email">
                                 <option value="Undangan Seleksi Tahap 1">Undangan Seleksi Tahap 1</option>
                                 <option value="Undangan Seleksi Tahap 2">Undangan Seleksi Tahap 2</option>
                                 <option value="Undangan Seleksi Tahap 3">Undangan Seleksi Tahap 3</option>
                             </select>
                             <div class="invalid-feedback"></div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="submit"class="btn btn-success" data-bs-target="#modalalert">Simpan</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <!-- Modal Detail-->
 <div class="modal fade" id="modaldetail" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
         <div class="modal-content">
             <div class="modal-header d-block border-bottom">
                 <div class="d-flex justify-content-between">
                     <h5 class="modal-title" id="modal-title">Jadwal Seleksi Tahap 1</h5>
                     <button for="upload"
                         class="btn btn-outline-success waves-effect me-2 mb-3 waves-effect waves-light"
                         tabindex="0">
                         <i class="ti ti-download d-block pe-2"></i>
                         <span class="d-none d-sm-block">Unduh CV</span>
                         <input type="file" id="upload" class="account-file-input" hidden=""
                             accept="image/png, image/jpeg">
                     </button>
                 </div>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form class="default-form" id="" method="GET" action="{{ route('seleksi.show') }}">
                 @csrf

                 <div class="modal-body">
                     <div class="row">
                         <div class="col-4 mt-2 border-end">
                             <div class="text-center border-bottom pb-2">
                                 <img src="../../app-assets/img/avatars/14.png" alt="user image"
                                     class="rounded user-profile-img mb-2" width="70px">
                                 <h4 class="mb-1">John Doe</h4>
                                 <span>UX Designer</span>
                             </div>
                             <div class="mt-3 ms-4">
                                 <p class="card-text text-uppercase">Biodata Singkat</p>
                                 <div class="row">
                                     <div class="col-5">
                                         <span class="fw-bold">Universitas:</span>
                                     </div>
                                     <div class="col-7">
                                         <span>Universitas Telkom</span><br>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-5">
                                         <span class="fw-bold">Fakultas:</span>
                                     </div>
                                     <div class="col-7">
                                         <span>Ilmu Terapan</span><br>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-5">
                                         <span class="fw-bold">Jurusan:</span>
                                     </div>
                                     <div class="col-7">
                                         <span>Sistem Informasi</span><br>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-5">
                                         <span class="fw-bold">Jenjang:</span>
                                     </div>
                                     <div class="col-7">
                                         <span>S1</span><br>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-5">
                                         <span class="fw-bold">IPK:</span>
                                     </div>
                                     <div class="col-7">
                                         <span>3.77/4.0</span><br>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-5">
                                         <span class="fw-bold">Semester:</span>
                                     </div>
                                     <div class="col-7">
                                         <span>5</span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="col-4 mt-2">
                             <div class="col-6 ms-4">
                                 <span class="text-secondary">Jenis Seleksi</span>
                                 <p class="fw-bold mt-1">Seleksi Tahap 1</p>
                             </div>
                             <div class="col-6 ms-4">
                                 <span class="text-secondary">Tanggal Pelaksanaan</span>
                                 <p class="fw-bold mt-1" id="tglpelaksanaan"></p>
                             </div>
                             <div class="col-6 ms-4">
                                 <span class="text-secondary">Tempat Pelaksanaan</span>
                                 <p class="fw-bold mt-1" id="tpelaksanaan" name="tpelaksanaan"></p>
                             </div>
                             <div class="col-6 ms-4">
                                 <span class="text-secondary">Respon Kandidat</span>
                                 <span class="badge bg-label-success mt-1">Approved</span>
                             </div>
                         </div>
                         <div class="col-4 mt-2">
                             <div class="col-6">
                                 <span class="text-secondary">Jenis Pelaksanaan</span>
                                 <p class="fw-bold mt-1" id="jpelaksanaan">Onsite</p>
                             </div>
                             <div class="col-6">
                                 <span class="text-secondary">Waktu Pelaksanaan</span>
                                 <p class="fw-bold mt-1" id="wpelaksanaan"></p>
                             </div>
                             <div class="col-6">
                                 <span class="text-secondary">Status Seleksi</span>
                                 <p class="fw-bold mt-1" id="seleksiteks"></p>
                             </div>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <!-- Modal Alert-->
 <div class="modal fade" id="modalalert" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body text-center">
                 <img src="../../app-assets/img/alert.png" alt="">
                 <h5 class="modal-title" id="modal-title">Apakah Data Jadwal Seleksi lanjutan anda sudah benar?</h5>
                 <div class="swal2-html-container" id="swal2-html-container" style="display: block;">Jadwal seleksi
                     lanjutan akan otomatis terkirim melalui email aktif kandidat!</div>
             </div>
             <div class="modal-footer" style="display: flex; justify-content:center;">
                 <button type="submit" id="modal-button" class="btn btn-success">Ya, Sudah</button>
                 {{-- <button type="submit" id="modal-button" class="btn btn-danger">Batal</button> --}}
             </div>

         </div>
     </div>
 </div>
