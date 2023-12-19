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
                         <h5 class="mb-0">20</h5>
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
                     <div class="tf-icons ti ti-calendar text-primary" style="font-size: medium; margin-right:10px;"> Batas konfirmasi penerimaan: {{($item->date_confirm_closing?->format('d/m/Y') ?? 'Set Date Closing')}}</div>
                     <div class="tf-icons ti ti-users" style="font-size: medium;"> Kuota Penerimaan : {{$item->kuota}}</div>
                 </div>
                 <div class="col-6 text-end">
                     @can( "button.tnglbts.mitra" )
                     <a href="">


                     </a>
                     <!-- <input class="form-control" type="date" value="0000-00-00" id="mulai"> -->
                     <button class="btn btn-outline-success my-2 waves-effect" type="button" id="datepicker">
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
 @endforeach