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
                         <label for="mulai" class="form-label">Tanggal Seleksi Mulai</label>
                         <input type="text" class="form-control flatpickr-input" placeholder="YYYY-MM-DD" id="flatpickr-date" readonly="readonly">
                     </div>
                 </div>
                 <div class="row">
                     <div class="mb-2">
                         <label for="seleksi" class="form-label">Progress Seleksi</label>
                         <select class="form-select select2" id="progressfilter" name="progress"
                             data-placeholder="Pilih Status Seleksi">
                             <option disabled selected>Pilih Progress Seleksi</option>
                             <option value="Belum Seleksi">Belum Seleksi</option>
                             <option value="Sudah Seleksi">Sudah Seleksi</option>
                         </select>
                     </div>
                 </div>
                 <div class="row">
                     <div class="mb-2">
                         <label for="seleksi" class="form-label">Status Seleksi</label>
                         <select class="form-select select2" id="seleksifilter" name="seleksi"
                             data-placeholder="Pilih Status Seleksi">
                             <option disabled selected>Pilih Status Seleksi</option>
                             <option value="Diterima">Diterima</option>
                             <option value="Ditolak">Ditolak</option>
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
                                 {{-- <select id="select2Disabled" class="select2 form-select select2-hidden-accessible"
                                     data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" disabled> --}}
                                     <select class="form-select select2" id="tahap" name="tahap"
                                 data-placeholder="Pilih Jenis Tahap">
                                 <option disabled selected>Pilih Jenis Tahap</option>
                                     <option value="tahap1">Tahap 1</option>
                                     <option value="tahap2">Tahap 2</option>
                                     <option value="tahap3">Tahap 3</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col mb-2">
                            <label for="flatpickr-range" class="form-label">Jadwal Pelaksanaan</label>
                            <input type="text" class="form-control" name="mulai" placeholder="Jadwal Pelaksanaan" id="flatpickr-range" />
                          </div>
                     </div>
                     <div class="row">
                         <div class="col mb-2 form-input">
                             <label for="seleksi" class="form-label">Subjek Email</label>
                             <select class="form-select select2" id="subjek" name="subjek"
                                 data-placeholder="Pilih Subjek Email">
                                 <option disabled selected>Pilih Subjek Email</option>
                                 @foreach ($email as $e)
                                     <option value="{{ $e->id_email_template }}">{{ $e->subject_email }}</option>
                                 @endforeach
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
