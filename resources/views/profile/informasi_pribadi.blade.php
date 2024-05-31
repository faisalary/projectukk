@extends('partials_mahasiswa.template')

@section('page_style')

<link rel="stylesheet" href="{{ url('assets/css/yearpicker.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/monthpicker.css') }}">
<link rel="stylesheet" href="{{ url("app-assets/vendor/libs/sweetalert2/sweetalert2.css")}}" />

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
          <h6 class="text-end">{{ number_format($persentase, 2) }}%</h6>
        </div>
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: {{ $persentase }}%;" aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
      <div class="col-2 text-end ps-0">
        <button class="btn btn-secondary buttons-collection  btn-label-success ms-4 mt-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false"><span><i class="ti ti-download me-sm-1"></i> <span class="d-none d-sm-inline-block">Unduh Profile</span></span></button>
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
            <i class="menu-icon tf-icons ti ti-edit text-warning" data-id="{{$informasiprib?->id_infoprib??''}}" data-bs-toggle="modal" onclick="edit($(this))" data-bs-target="#modalEditInformasi"></i>
          </div>
          <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
              @if ($informasiprib?->profile_picture??'')
                  <img src="{{ url('storage/' .$informasiprib?->profile_picture??'app-assets/img/avatars/14.png') }}" alt="profile-image"
                      class="img-fluid rounded mb-3 pt-1 mt-4" style="max-height: 140px; max-width: 180px;" alt="img" >
              @else
                  <img src="{{ url("app-assets/img/avatars/14.png")}}" alt="user-avatar"
                      class="img-fluid rounded mb-3 pt-1 mt-4">
              @endif
              
              <div class="user-info text-center">
                <h4 class="mb-2">{{$mahasiswa?->namamhs??''}}</h4>
                <span class="badge bg-label-success mt-1">{{$informasiprib?->headliner??''}}</span>
              </div>
            </div>
          </div>
          <div class="border-bottom mb-3">
            <p class="mt-4 mb-0">{{$informasiprib?->deskripsi_diri?? '' }}</p>
          </div>
          <div class="info-container">
            <ul class="list-unstyled">
              <li class="mb-1">
                <span class="fw-semibold me-1">NIM:</span>
                <span>{{$mahasiswa->nim}}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Universitas:</span>
                <span>{{$mahasiswa->univ->namauniv}}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Fakultas:</span>
                <span>{{$mahasiswa->fakultas->namafakultas}}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Program Studi:</span>
                <span>{{$mahasiswa->prodi->namaprodi}}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Angkatan:</span>
                <span>{{$mahasiswa->angkatan}}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">IPK:</span>
                <span>{{$informasiprib?->ipk??''}}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Eprt:</span>
                <span>{{$informasiprib?->eprt?? '' }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">TAK:</span>
                <span>{{$informasiprib?->TAK?? '' }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Email:</span>
                <span>{{$mahasiswa->emailmhs}}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">No.Telp:</span>
                <span>{{$mahasiswa->nohpmhs }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Tanggal Lahir:</span>
                <span>{{$informasiprib?->tgl_lahir??''}}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Jenis Kelamin:</span>
                <span>{{$informasiprib?->gender?? ''}}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Alamat:</span>
                <span>{{$mahasiswa->alamatmhs}}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    @include('profile.modal_informasi_pribadi')

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
              <i class="menu-icon tf-icons ti ti-edit text-warning" onclick="editInformasiTambahan($(this))" data-id="{{$informasitambahan?->nim??''}}" data-bs-toggle="modal" data-bs-target="#modalEditInformasiTambahan"></i>
            </div>
            <div class="card-body pb-0">
              <div class="row mb-2">
                <div class="col-6">
                  <p class="mb-2 pt-1">
                    @if(!empty($informasitambahan->lok_magang))
                    <span class="fw-semibold me-1">Lokasi Kerja yang diharapkan:</span>
                    <span>{{$informasitambahan->lok_magang ?? ''}}</span>
                    @endif
                  </p>
                </div>
                <div class="col-6">
                  <p class="mb-2 pt-1">
                    {{-- @if(!empty( $informasitambahan->sosmed)) --}}
                    @foreach($sosmed->sosmedmhs as $s)
                    <span class="fw-semibold me-1">{{$s?->namaSosmed ?? ''}}</span>
                    <span> <a href="{{$s?->urlSosmed ?? ''}}" target="_blank">Lihat Profile</a></span>
                    {{-- @endif --}}
                    @endforeach
                  </p>
                </div>
              </div>
              {{-- @if(!empty($bahasamahasiswa->bahasa)) --}}
              <p class="mb-2 pt-0">
                <span class="fw-semibold me-1">Bahasa:</span>
              </p>
              <p class="mb-4">
                @foreach($bahasamahasiswa->bahasamhs as $bb)
                <span class="btn rounded-pill btn-success waves-effect waves-light">{{$bb?->bahasa?? 'Indonesia'}}</span>
                @endforeach
              </p>
              {{-- @endif   --}}
            </div>
          </div>
        </div>
        @include('profile.modal_informasi_tambahan')
        <!-- /Informasi Tambahan -->

        <!-- <pendidikan> -->
        <div class="tab-pane fade show" id="navs-pills-justified-pendidikan" role="tabpanel">
          <div class="card mb-4">
            <div class="d-flex justify-content-between border-bottom pt-3 ps-3 pe-3">
              <h5 class="text-secondary">Pendidikan</h5>
              <i class="menu-icon tf-icons ti ti-edit text-warning" data-bs-toggle="modal" data-bs-target="#modalTambahPendidikan"></i>
            </div>
            <div class="card-body pb-0">
              <ul class="timeline mb-0">
                @if(!empty($pendidikan->name_intitutions) || !empty( $pendidikan->tingkat) || !empty($pendidikan->nilai) || !empty($pendidikan->startdate) || !empty($pendidikan->enddate) )
                <li class="timeline-item timeline-item-transparent">
                  <span class="timeline-point timeline-point-success"></span>
                  <div class="timeline">
           
                    <div class="timeline-header">
                      <h6 class="mt-0">{{$pendidikan?->name_intitutions??''}}</h6>
                    </div>
                    <div class="border-bottom mb-3">
                      <p class="mb-1">{{$pendidikan?->tingkat??''}}</p>
                      <p class="mb-1">Nilai Akhir : {{$pendidikan?->nilai??''}}</p>
                      <p style="font-size: small;">{{$pendidikan?->startdate??''}} - {{$pendidikan?->enddate??''}} </p>
                    </div>
                  </div>
                </li>
                @endif
              </ul>
            </div>
          </div>
        </div>
        @include('profile.modal_pendidikan')
        <!-- </pendidikan> -->

        <!-- <Keahlian&Pengalaman> -->
        <div class="tab-pane fade show" id="navs-pills-justified-keahlian-pengalaman" role="tabpanel">
          <div class="card mb-4">
            <div class="d-flex justify-content-between pt-3 ps-4 pe-3">
              <h5 class="text-secondary">Keahlian</h5>
              <div class="text-end">
                <i class="menu-icon tf-icons ti ti-edit text-warning mt-2" data-bs-toggle="modal" data-bs-target="#modalTambahKeahlian"></i>
                <br>
                {{-- <i class="menu-icon tf-icons ti ti-edit text-warning mt-2" data-bs-toggle="modal" data-bs-target="#modalEditKeahlian"></i> --}}
              </div>
            </div>
            <div class="card-body pb-0 pt-0">
              
              @if(!empty($skill->skills))
              <div>
                <span class="btn rounded-pill btn-success waves-effect waves-light">{{$skill?->skills??''}}</span>
              </div>
              @endif
              <div class="border-bottom mt-3"></div>
              <div class="d-flex justify-content-between pt-3 pb-3">
                <h5 class="text-secondary">Pengalaman</h5>
                <div class="text-end">
                  <i class="menu-icon tf-icons ti ti-plus text-success" data-bs-toggle="modal" data-bs-target="#modalTambahPengalaman"></i>
                </div>
              </div>
              @if(count($pengalaman1) > 0)
              <ul class="timeline">
                @foreach ($pengalaman1 as $pe)
                <li class="timeline-item timeline-item-transparent ">
                  <span class="timeline-point timeline-point-success"></span>
                  <div class="timeline">
                    <div class="timeline-header mt-1">
                      <h6 class="mb-0">{{$pe?->posisi??''}}</h6>
                      <div>
                        <i class="menu-icon tf-icons ti ti-edit text-warning" data-id="{{$pe?->id_experience??''}}" onclick="editSkill($(this))" data-bs-toggle="modal" data-bs-target="#modalEditPengalaman"></i>
                        <i class="menu-icon tf-icons ti ti-trash text-danger" data-id="{{$pe?->id_experience??''}}" onclick="destroyPengalaman($(this))"></i>
                      </div>
                    </div>
                    
                    <div class="border-bottom mb-3">
                      <p class="mb-1">{{$pe?->name_intitutions??''}} - {{$pe?->jenis??''}}</p>
                      <p style="font-size: small;">{{$pe?->startdate??''}} - {{$pe?->enddate??''}}
                      <div>
                        <p class="mb-0">{{$pe?->deskripsi??''}}</p>
                        {{-- <p class="content-new mb-0">driving digitalisation and sustainability for the energy, infrastructure and informasipribal sectors all over the world.</p>
                        <u class="show_hide_new cursor-pointer" style="color:#4EA971">
                          Show more --}}
                        </u>
                      </div>
                    </div>
                  </div>
                </li>
                @endforeach
                
                <a href="{{url("mahasiswa/profile/pengalaman/detail/". Auth::user()->nim)}}">
                  <button class="btn btn-outline-success btn-lg col-md-12 toggle-button ms-1 me-7 mb-2 mt-5" 
                  type="button">Selengkapnya</button></a>
              </ul>
              @endif
            </div>
          </div>
        </div>
        @include('profile.modal_skill_pengalaman')
        <!-- </Keahlian&Pengalaman> -->

        <!-- <Dokumen Pendukung> -->
        <div class="tab-pane fade show" id="navs-pills-justified-dokumen-pendukung" role="tabpanel">
          <div class="card mb-4">
            <div class="d-flex justify-content-between border-bottom pt-3 ps-3 pe-3">
              <h5 class="text-secondary pt-2 ps-2 pe-3">Dokumen Pendukung</h5>
              {{-- <i class="menu-icon tf-icons ti ti-plus text-success" data-bs-toggle="modal" data-bs-target="#modalTambahDokumen"></i> --}}
              <i class="menu-icon ps-2 pe-2 pb-2">
                <button class="btn btn-success" data-bs-target="#modalTambahDokumen"   data-bs-toggle="modal">Tambah</button>
              </i>
            </div>
            <div class="card-body">
              <div>
                @if(count($dokumen1) > 0)
                <ul class="timeline mb-0">
                  @foreach($dokumen1 as $dok)
                  <li class="timeline-item timeline-item-transparent">
                    <span class="timeline-point timeline-point-success"></span>
                    <div class="timeline-event">
                      <div class="timeline-header">
                        <h6 class="mb-0">Judul : {{$dok?->nama_sertif??''}}</h6>
                        <div>
                          <i class="menu-icon tf-icons ti ti-edit text-warning" data-id="{{$dok?->id_sertif??''}}" onclick="editDokumen($(this))" data-bs-toggle="modal" data-bs-target="#modalEditDokumen" ></i>
                          <i class="menu-icon tf-icons ti ti-trash text-danger" data-id="{{$dok?->id_sertif??''}}" onclick="destroyDokumen($(this))" data-bs-toggle="modal" data-bs-target=""></i>
                        </div>
                      </div>
                      <div class="border-bottom mb-3">
                        <p class="mb-1">Penerbit : {{$dok?->penerbit??''}}</p>
                        <p style="font-size: small;">{{$dok?->startdate??''}} sampai {{$dok?->enddate??''}}
                        <div>
                          {{-- <p class="mb-0">{{$dok?->deskripsi??''}}</p>
                          <p class="content-new mb-0">driving digitalisation and sustainability for the energy, infrastructure and industrial sectors all over the world.</p>
                          <u class="show_hide_new cursor-pointer" style="color:#4EA971">
                            Show more
                          </u> --}}
                        </div>
                        <div class="d-flex align-items-start mt-3 mb-3">
                          <div>
                            <img src="{{ url('storage/' .$dok?->file_sertif??'assets/images/no-pictures.png')}}" width="200" height="auto" alt="img">
                          </div>
                          <div class="me-2 ms-4">
                            <h6 class="mt-5"><a href="{{$dok?->link_sertif??''}}" target="_blank">Lihat Dokumen</a></h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  @endforeach
                  <li class="timeline-item timeline-item-transparent">
                    <span class="timeline-point timeline-point-success"></span>
                  </li>
                </ul>
              </div>
              <a href="{{url("mahasiswa/profile/dokumen-pendukung/detail/". Auth::user()->nim)}}">
                <button class="btn btn-outline-success btn-lg col-md-12 toggle-button ms-1 me-7 mb-2 mt-5" 
                type="button">Selengkapnya</button>
              </a>
              @endif
            </div>
          </div>
        </div>
        @include('profile.modal_dok_pendukung')
        @include('profile.modal_destroy')
        <!-- </Dokumen Pendukung> -->
      </div>
      <!-- </Content> -->
    </div>
  </div>
</div>
@endsection

@section('page_script')
  <script>
    changePicture.onchange = evt => {
      const [file] = changePicture.files
      if (file) {
          imgPreview.src = URL.createObjectURL(file)
          console.log(imgPreview.src);
      } else {
          imgPreview.src = "{{ Url("app-assets/img/avatars/14.png")}}"
      }
    }
    function removeImage() {
        document.getElementById('imgPreview').src = "{{ asset('storage/' . $informasiprib?->profile_picture??'') }}";
    }
    $(document).ready(function() {
       $(".content-new").hide();
       $(".show_hide_new").on("click", function() {
         var content = $(this).prev('.content-new');
         content.slideToggle(100);
         if ($(this).text().trim() == "Show more") {
           $(this).text("Show less");
         } else {
           $(this).text("Show more");
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

    function edit(e) {
      let id = e.attr('data-id');
      var url = `{{ url('mahasiswa/profile/pribadi/edit/') }}/${id}`;
      let action = `{{ url('mahasiswa/profile/pribadi/update/') }}/${id}`;
      console.log(url);

      $.ajax({
          type: 'GET',
          url: url,
          success: function (response) {
              $("#modal-button").html("Update Data");
              $('#modalEditInformasi form').attr('action', action);
              $('#ipk').val(response.ipk);
              $('#eprt').val(response.eprt);
              $('#TAK').val(response.TAK);
              $('#tgl_lahir').val(response.tgl_lahir);
              $('#headliner').val(response.headliner);
              $('#deskripsi_diri').val(response.deskripsi_diri);
              $('#profile_picture').val(response.profile_picture);
              $("#gender1").prop("checked", true);
              $('.invalid-feedback').removeClass('d-block');
              $('.form-control').removeClass('is-invalid');
          }
      });
    }
    function editDokumen(e) {
      let id = e.attr('data-id');
      var url = `{{ url('mahasiswa/profile/dokumen-pendukung/edit') }}/${id}`;
      let action = `{{ url('mahasiswa/profile/dokumen-pendukung/update/') }}/${id}`;

      $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {
          $("#modal-button").html("Update Data");
          $('#modalEditDokumen form').attr('action', action);
          $('#editnama_sertif').val(response.nama_sertif); 
          $('#editpenerbit').val( response.penerbit);
          $('#editlink_sertif').val(response.link_sertif);
          $('#editdeskripsi').val(response.deskripsi);
          if(response && response.startdate) {
            let startdate = new Date(response.startdate);
            let year = startdate.getFullYear();
            let month = ('0' + (startdate.getMonth() + 1)).slice(-2);  
            let format = year + '-' + month;
            $('#startdateEdit').val(format);
          }
          if(response && response.enddate) {
            let enddate = new Date(response.enddate);
            let year = enddate.getFullYear();
            let month = ('0' + (enddate.getMonth() + 1)).slice(-2);  
            let format = year + '-' + month;
            $('#enddateEdit').val(format);
          }
          // $('#editfile_sertif').val(response.file_sertif);
          $('.invalid-feedback').removeClass('d-block');
          $('.form-control').removeClass('is-invalid');
        }
      });
    }

    function editSkill(e) {
      let id = e.attr('data-id');
      var url = `{{ url('mahasiswa/profile/pengalaman/edit') }}/${id}`;
      let action = `{{ url('mahasiswa/profile/pengalaman/update/') }}/${id}`;
      console.log(id);

      $.ajax({
          type: 'GET',
          url: url,
          success: function (response) {
            $("#modal-button").html("Update Data");
            $('#modalEditPengalaman form').attr('action', action);
            $('#name_intitutions').val(response.name_intitutions);
            $('#posisi').val(response.posisi); 
            $('#editjenis').val(response.jenis).trigger('change');
            if(response && response.startdate) {
              let startdate = new Date(response.startdate);
              let year = startdate.getFullYear();
              let month = ('0' + (startdate.getMonth() + 1)).slice(-2);  // Tambah '0' di depan jika bulan kurang dari 10
              let day = ('0' + startdate.getDate()).slice(-2);  // Tambah '0' di depan jika hari kurang dari 10
              let format = year + '-' + month + '-' + day;
              $('#editstartdate').val(format);
            }
            if(response && response.enddate) {
              let enddate = new Date(response.enddate);
              let year = enddate.getFullYear();
              let month = ('0' + (enddate.getMonth() + 1)).slice(-2);  // Tambah '0' di depan jika bulan kurang dari 10
              let day = ('0' + enddate.getDate()).slice(-2);  // Tambah '0' di depan jika hari kurang dari 10
              let format = year + '-' + month + '-' + day;
              $('#editenddate').val(format);
            }
            $('#deskripsi').val(response.deskripsi);
            console.log(response);
          }
      });
    }

    function destroyDokumen(e) {
      let id = e.attr('data-id');
      let action = `{{ url('mahasiswa/profile/dokumen-pendukung/delete/') }}/${id}`;
      console.log(id);

      Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "ingin menghapus data ini!",
            icon: 'warning',
            showCancelButton: true,
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: action,
              type: "DELETE",
              cache: false,
              data: {
                "_token": "{{ csrf_token() }}",
              },
              success:function(response){ 
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                });
                location.reload();
              },
              error: function(error) {
                    console.log("Error: ", error);
                    let errorMessage = error.responseJSON ? error.responseJSON.message : 'Terjadi kesalahan saat menghapus data!';
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: 'Oops...',
                        text: errorMessage,
                    });
                }
            });
          }
        });
    }

    function destroyPengalaman(e) {
      let id = e.attr('data-id');
      let action = `{{ url('mahasiswa/profile/pengalaman/delete/') }}/${id}`;
      console.log(id);

      Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "ingin menghapus data ini!",
            icon: 'warning',
            showCancelButton: true,
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: action,
              type: "DELETE",
              cache: false,
              data: {
                "_token": "{{ csrf_token() }}",
              },
              success:function(response){ 
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 000
                });
                location.reload();
              },
              error: function(error) {
                    console.log("Error: ", error);
                    let errorMessage = error.responseJSON ? error.responseJSON.message : 'Terjadi kesalahan saat menghapus data!';
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: 'Oops...',
                        text: errorMessage,
                    });
                }
            });
          }
        });
    }
    
  </script>


<script src="{{ url('app-assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ url('app-assets/js/extended-ui-sweetalert2.js') }}"></script>
<script src="{{ url('app-assets/js/app-stepper.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
<script src="{{ url('app-assets/vendor/libs/pickr/pickr.js') }}"></script>
<script src="{{ url('app-assets/js/forms-pickers.js') }}"></script>
<script src="{{ url('assets/js/yearpicker.js') }}"></script>
<script src="{{ url('assets/js/monthpicker.js') }}"></script>
<script src="{{ url('app-assets/js/forms-extras.js')}}"></script>
<script src="{{ url('app-assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
@endsection