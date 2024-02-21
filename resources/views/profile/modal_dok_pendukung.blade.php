
  
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
          <form class="default-form" action="{{ url('mahasiswa/profile/dokumen-pendukung/store/' . Auth::user()->nim)}}" method="POST">
            @csrf
            <div class="row">
              <div class="mb-3 col-md-12">
                <label for="sertifikat" class="form-label">Nama Sertifikasi<span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="sertifikat" name="sertifikat" placeholder="Masukkan nama sertifikasi " />
              </div>
              <div class="mb-3 col-md-12">
                <label for="penerbit" class="form-label">Penerbit Sertifikasi<span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit " />
              </div>
              <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Terbit<span style="color: red;">*</span></label>
                <input type="month" id="month" name="startdate" class="form-control" placeholder="Month"/>
              </div>
              <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Kadaluwarsa<span style="color: red;">*</span></label>
                <input type="month" id="month" name="enddate" class="form-control" placeholder="Month" />
              </div>
              <div class="mb-3 col-md-12">
                <label for="unggahfile" class="form-label">Upload File<span style="color: red;">*</span></label>
                <input class="form-control" type="file" name="file_sertif" id="unggahfile" multiple="">
              </div>
              <div class="mb-3 col-md-12">
                <label for="link" class="form-label"> Link Sertifikasi <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="link" name="link_sertif" placeholder="Masukkan link Sertifikat  " />
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
          <h5 class="modal-title" id="modal-title">Edit Dokumen Pendukung</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Account -->
        <div class="modal-body border-top mt-3">
          <form class="default-form" action="{{ url('mahasiswa/profile/dokumen-pendukung/update/' . $dokumen?->id_sertif)}}" method="POST">
            @csrf
            <div class="row">
              <div class="mb-3 col-md-12">
                <label for="sertifikat" class="form-label"> Nama Sertifikasi <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="sertifikat" value="{{$dokumen?->nama_sertif}}" name="sertifikat" placeholder="Masukkan nama sertifikasi " />
              </div>
              <div class="mb-3 col-md-12">
                <label for="penerbit" class="form-label"> Penerbit Sertifikasi <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="penerbit" value="{{$dokumen?->penerbit??''}}" name="penerbit" placeholder="Masukkan nama penerbit " />
              </div>
              <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Terbit<span style="color: red;">*</span></label>
                <input type="date" id="startdate" value="{{$dokumen ? $dokumen->startdate : ''}}" name="startdate" class="form-control" />
              </div>
              <div class="mb-3 col-md-12">
                  <label for="" class="form-label">Tanggal Kadaluwarsa<span style="color: red;">*</span></label>
                  <input type="date" id="enddate" value="{{$dokumen ? $dokumen->enddate : ''}}" name="enddate" class="form-control" />
              </div>
              <div class="mb-3 col-md-12">
                  <label for="unggahfile" class="form-label">Upload File<span style="color: red;">*</span></label>
                  <input class="form-control" type="file" name="file_sertif" id="unggahfile" multiple="">
              </div>
              <div class="mb-3 col-md-12">
                <label for="link" class="form-label"> Link Sertifikasi <span style="color: red;">*</span></label>
                <input class="form-control" type="text" value="{{$dokumen?->link_sertif??''}}" id="link" name="link_sertif" placeholder="Masukkan link Sertifikat  " />
              </div>
              <div class="mb-3 col-md-12">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" type="text" id="deskripsi" name="deskripsi" placeholder="Ketik di sini...">{{$dokumen?->deskripsi??''}}</textarea>
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
            <form class="default-form" action="{{ url('mahasiswa/profile/dokumen-pendukung/delete/' . $dokumen?->id_sertif)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" id="modal-button" class="btn btn-success">Iya</button>
            </form>
          <button type="submit" id="modal-button" class="btn btn-danger">Tidak</button>
        </div>
      </div>
    </div>
  </div>