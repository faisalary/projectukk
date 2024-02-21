<!-- Modal Edit Informasi Pribadi -->
<div class="modal fade" id="modalEditInformasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">Informasi Pribadi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Account -->
    
        <form class="default-form" action="{{ url('mahasiswa/profile/pribadi/update/'. Auth::user()->nim)}}" method="POST">
          @csrf
        <div class="modal-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
              @if ($informasiprib?->profile_picture?? '')
                <img src="{{ asset('storage/' . $informasiprib?->profile_picture?? '') }}" alt="user-avatar"
                    class="img-fluid rounded mb-3 pt-1 mt-4" name="profile_picture" id="imgPreview">
              @else
                  <img src="{{ url("app-assets/img/avatars/15.png")}}" alt="user-avatar" 
                  class="img-fluid rounded mb-3 pt-1 mt-4" id="imgPreview" />
              @endif
              <div class="button-wrapper">
                <label for="changePicture" class="btn btn-white text-success me-2 mb-3 waves-effect waves-light"
                  tabindex="0">
                  <i class="ti ti-upload d-block pe-2"></i>
                  <span class="d-none d-sm-block">Upload</span>
                  <input type="file" id="changePicture" name="profile_picture" class="account-file-input" hidden
                      accept="image/png, image/jpeg">
                </label>
                <button type="button" 
                class="btn btn-label-secondary account-image-reset mb-3" 
                onclick="removeImage()">
                  <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Atur Ulang</span>
                </button>
                <div class="text-muted">Format FIle JPG, GIF atau PNG. Ukuran Maksimal 800KB</div>
              </div>
            </div>
            <div class="border-top">
              <div class="row mt-4">
                <div class="mb-3 col-md-6">
                  <label for="NIM" class="form-label">NIM <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="nnim" name="nim" value="{{Auth::user()->nim}}" placeholder="" disabled />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="Name" class="form-label">Nama Lengkap <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="nnamalengkap" name="namalengkap" value="{{$mahasiswa->namamhs}}" autofocus disabled />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="Universitas" class="form-label">Universitas <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="nuniversitas" name="universitas" value="{{$mahasiswa->univ->namauniv}}" autofocus disabled />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="Fakultas" class="form-label">Fakultas <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="nfakultas" name="fakultas" value="{{$mahasiswa->fakultas->namafakultas}}" autofocus disabled />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="Prodi" class="form-label">Program Studi <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="nprodi" name="prodi" value="{{$mahasiswa->prodi->namaprodi}}" autofocus disabled />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="angkatan" class="form-label">Angkatan <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="nangkatan" name="prodi" value="{{$mahasiswa->angkatan}}" autofocus disabled />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="Email" class="form-label">Email <span style="color: red;">*</span></label>
                  <input class="form-control" type="email" id="nemail" name="email" value="{{$mahasiswa->emailmhs}}" autofocus disabled />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="notelp">No. Telp</label>
                  <input type="text" id="nnotelp" name="notelp" class="form-control" value="{{$mahasiswa->nohpmhs}}" autofocus disabled />
                </div>
                <div class="mb-3 col-md-4">
                  <label for="ipk" class="form-label">IPK <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="nipka" name="ipk" placeholder="4.00" value="{{$informasiprib?->ipk??''}}" autofocus />
                </div>
                <div class="mb-3 col-md-4">
                  <label for="eprt" class="form-label">EPRT<span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="neprt" name="eprt" placeholder="550" value="{{$informasiprib?->eprt??''}}" autofocus />
                </div>
                <div class="mb-3 col-md-4">
                  <label for="TAK" class="form-label">TAK <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="nTAK" name="TAK" placeholder="100" value="{{$informasiprib?->TAK??''}}" autofocus />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="tgl_lahir" class="form-label">Tanggal Lahir <span style="color: red;">*</span></label> 
                  <input name="tgl_lahir" value="{{$informasiprib?->tgl_lahir??''}}" type="text" class="form-control flatpickr-input active" placeholder="YYYY-MM-DD" id="flatpickr-date" required>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="gender" class="form-label">Jenis Kelamin <span style="color: red;">*</span></label>
                  <div class="form-check">
                    <div class="row">
                      <div class="col-3" >
                        <input name="gender" class="form-check-input" type="radio" value="Laki-Laki" id="ngender" checked="">
                        <label class="form-check-label" for="gender"> Laki-Laki </label>
                      </div>
                      <div class="col-3 ms-2">
                        <input name="gender" class="form-check-input" type="radio" value="Perempuan" id="ngender" checked="">
                        <label class="form-check-label" for="gender"> Perempuan </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb-3 col-md-12">
                  <label for="headliner" class="form-label">Headliner</label>
                  <input class="form-control" value="{{$informasiprib?->headliner??''}}" type="text" id="nheadliner" name="headliner" placeholder="cth. UI/UX Desginer" />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="alamat" class="form-label">Alamat <span style="color: red;">*</span></label>
                  <input class="form-control" type="text" id="alamat" name="alamat" value="{{$mahasiswa?->alamatmhs??''}}" placeholder="jln. merdeka" disabled />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="deskripsi_diri" class="form-label">Deskripsi Diri</label>
                  <input class="form-control" value="{{$informasiprib?->deskripsi_diri??''}}" type="textarea" id="ndeskripsi_diri" name="deskripsi_diri" placeholder="Deskripsi Diri">
                </div>
              </div>
              <div class="modal-footer p-0">
                <button id="modal-button"  type="submit" class="btn btn-success m-0">Simpan Data</button>
              </div>
            </div>
          </div>
        </form>
        <!-- /Account -->
      </div>
    </div>
  </div>