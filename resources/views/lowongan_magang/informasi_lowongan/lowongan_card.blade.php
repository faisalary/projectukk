 @foreach($lowongan as $item)
 <div class="card mt-4">
     <div class="card-body">
         <div class="row">
             <div class="col-2">
                 <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%; width: 90px;" src="{{$item->industri->image ?? '\assets\images\no-pictures.png'}}" alt="Logo">
                 </figure>
             </div>
             <div class="col-10 d-flex justify-content-between">
                 <div>
                     <h5>{{$item->intern_position}}</h5>
                     <p>{{$item->bidang}}</p>
                 </div>
                 <div>
                     <span class="badge bg-label-success me-1 text-end">Aktif</span>
                 </div>
             </div>
         </div>
         <div class="row gy-3 mt-3">
             <div class="col-md-2 col-6">
                 <div class="d-flex align-items-center">
                     <div class="badge rounded-pill bg-label-success me-3 p-2">
                         <i class="ti ti-users ti-sm"></i>
                     </div>
                     <div class="card-info">
                         <small>Total Pelamar</small>
                         <h5 class="mb-0">{{$pendaftar_count}}</h5>
                     </div>
                 </div>
             </div>
             <div class="col-md-2 col-6">
                 <div class="d-flex align-items-center">
                     <div class="badge rounded-pill bg-label-success me-3 p-2">
                         <i class="ti ti-files ti-sm"></i>
                     </div>
                     <div class="card-info">
                         <small>Screening</small>
                         <h5 class="mb-0">0</h5>
                     </div>
                 </div>
             </div>
             <div class="col-md-2 col-6">
                 <div class="d-flex align-items-center">
                     <div class="badge rounded-pill bg-label-success me-3 p-2">
                         <i class="ti ti-speakerphone ti-sm"></i>
                     </div>
                     <div class="card-info">
                         <small>Proses Seleksi</small>
                         <h5 class="mb-0">0</h5>
                     </div>
                 </div>
             </div>
             <div class="col-md-2 col-6">
                 <div class="d-flex align-items-center">
                     <div class="badge rounded-pill bg-label-success me-3 p-2">
                         <i class="ti ti-file-report ti-sm"></i>
                     </div>
                     <div class="card-info">
                         <small>Penawaran</small>
                         <h5 class="mb-0">0</h5>
                     </div>
                 </div>
             </div>
             <div class="col-md-2 col-6">
                 <div class="d-flex align-items-center">
                     <div class="badge rounded-pill bg-label-success me-3 p-2">
                         <i class="ti ti-check ti-sm"></i>
                     </div>
                     <div class="card-info">
                         <small>Diterima</small>
                         <h5 class="mb-0">0</h5>
                     </div>
                 </div>
             </div>
             <div class="col-md-2 col-6">
                 <div class="d-flex align-items-center">
                     <div class="badge rounded-pill bg-label-success me-3 p-2">
                         <i class="ti ti-x ti-sm"></i>
                     </div>
                     <div class="card-info">
                         <small>Ditolak</small>
                         <h5 class="mb-0">0</h5>
                     </div>
                 </div>
             </div>
         </div>
         <hr />
         <div class="row mt-2">
             <div class="col-12 d-flex justify-content-between">
                 <div class="col-6">
                     <div class="tf-icons ti ti-calendar" style="font-size: medium; margin-right:10px;"> Tanggal Posting: {{($item->startdate?->format('d M Y') ?? '-')}} - {{($item->enddate?->format('d M Y') ?? '-')}}</div>
                     <div class="tf-icons ti ti-users" style="font-size: medium;"> Kuota Penerimaan : {{$item->kuota}}</div>
                 </div>
                 <div class="col-6 text-end">
                     @can( "button.tnglbts.mitra" )
                     <a href="">


                     </a>
                     <!-- <input class="form-control" type="date" value="0000-00-00" id="mulai"> -->
                     <button class="btn btn-outline-success my-2 waves-effect" type="button" id="datepicker" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi">
                         <i class="ti bi-pencil-square text-success" style="font-size: medium;"> Tanggal Batas Konfirmasi</i>
                     </button>
                     @endcan

                     <a href="/informasi/kandidat/{{$item->id_lowongan}}"><button type="button" class="btn btn-outline-dark waves-effect"><i class="ti bi-eye text-dark" style="font-size: medium;"> Lihat Kandidat</i>
                         </button></a>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal set date before closing -->
 <div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalCenterTitle">Masukkan Tanggal Batas Konfirmasi</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col mb-3">
                         <label for="flatpickr-date" class="form-label">Tanggal Konfirmasi<span style="color: red;">*</span></label>
                         <input type="date" data-date="" data-date-format="d M Y" class="form-control flatpickr-input active" placeholder="DD-MM-YYYY" id="flatpickr-date" readonly="readonly">
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-success">Simpan</button>
             </div>
         </div>
     </div>
 </div>
 <!-- Vendors JS -->
 <script src="../../app-assets/vendor/libs/moment/moment.js"></script>
 <script src="../../app-assets/vendor/libs/flatpickr/flatpickr.js"></script>
 <script src="../../app-assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
 <script src="../../app-assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
 <script src="../../app-assets/vendor/libs/jquery-timepicker/jquery-timepicker.js"></script>
 <script src="../../app-assets/vendor/libs/pickr/pickr.js"></script>

 <!-- Page JS -->
 <script src="../../app-assets/js/forms-pickers.js"></script>
 @endforeach