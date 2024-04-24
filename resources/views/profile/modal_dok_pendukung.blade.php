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
          <form class="default-form" action="{{ url('mahasiswa/profile/dokumen-pendukung/store/' . Auth::user()->nim)}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row">
              <div class="mb-3 col-md-12 form-input">
                <label for="sertifikat" class="form-label">Nama Sertifikasi<span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="nama_sertif" name="nama_sertif" placeholder="Masukkan nama sertifikasi " />
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label">Penerbit Sertifikasi<span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="penerbit" placeholder="Masukkan nama penerbit " />
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label">Tanggal Terbit<span style="color: red;">*</span></label>
                <input type="month" id="month" name="startdate" class="form-control" placeholder="Month"/>
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label">Tanggal Kadaluwarsa<span style="color: red;">*</span></label>
                <input type="month" id="month" name="enddate" class="form-control" placeholder="Month" />
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="unggahfile" class="form-label">Upload File<span style="color: red;">*</span></label>
                <input class="form-control" type="file" name="file_sertif" id="unggahfile" multiple="">
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="link" class="form-label"> Link Sertifikasi <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="link" name="link_sertif" placeholder="Masukkan link Sertifikat  " />
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label">Deskripsi</label>
                <textarea class="form-control" type="text" name="deskripsi" placeholder="Ketik di sini..."></textarea>
                <div class="invalid-feedback"></div>
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
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label"> Nama Sertifikasi <span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="nama_sertif" id="editnama_sertif" name="" placeholder="Masukkan nama sertifikasi" />
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label"> Penerbit Sertifikasi <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="editpenerbit" name="penerbit" placeholder="Masukkan nama penerbit " />
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label">Tanggal Terbit<span style="color: red;">*</span></label>
                <input type="text" id="startdate11" name="startdate" class="form-control" />
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-12 form-input">
                  <label for="" class="form-label">Tanggal Kadaluwarsa<span style="color: red;">*</span></label>
                  <input type="month" id="enddate" name="enddate" class="form-control" />
                <div class="invalid-feedback"></div>
                </div>
              <div class="mb-3 col-md-12 form-input">
                  <label for="" class="form-label">Upload File<span style="color: red;">*</span></label>
                  <input class="form-control" type="file" name="file_sertif" id="editfile_sertif">
                  {{-- <small>current file : <a class="currfile" href=""></span></small> --}}
                <div class="invalid-feedback"></div>
                </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label"> Link Sertifikasi <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="editlink_sertif" name="link_sertif" placeholder="Masukkan link Sertifikat " />
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label">Deskripsi</label>
                <textarea class="form-control" type="text" name="deskripsi" id="editdeskripsi" placeholder="Ketik di sini..."></textarea>
                <div class="invalid-feedback"></div>
              </div>
            </div>
            <div class="modal-footer p-0">
              <button id="modal-button" type="submit" class="btn btn-success m-0">Simpan Data</button>
            </div>
          </form>

        </div>
        <!-- /Account -->
      </div>
    </div>
  </div>

