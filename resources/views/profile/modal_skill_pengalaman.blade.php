<!-- Modal Tambah Keahlian -->
<div class="modal fade" id="modalTambahKeahlian" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">edit Keahlian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body border-top mt-3">
          <form class="default-form" action="{{ url('mahasiswa/profile/skill/update/'. Auth::user()->nim)}}" method="POST">
            @csrf
            <div class="row">
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label">Keahlian<span style="color: red;">*</span></label>
                <input id="" multiple class="form-control" name="skills" value="{{$skill?->skills??''}}" />
              <div class="invalid-feedback"></div>
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
  {{-- <div class="modal fade" id="modalEditKeahlian" tabindex="-1" aria-hidden="true">
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
  </div> --}}

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
          <form class="default-form" action="{{ url('mahasiswa/profile/pengalaman/store/'. Auth::user()->nim)}}" method="POST">
            @csrf
            <div class="row">
              <div class="mb-3 col-md-6 form-input form-input">
                <label for="posisi" class="form-label">Posisi / Bidang <span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="posisi" placeholder="Ex: UI/UX Designer" />
              <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-6 form-input form-input">
                <label for="pekerjaan" class="form-label">Jenis Pekerjaan <span style="color: red;">*</span></label>
                <select name="jenis" class="select2 form-select">
                  <option disabled selected>Pilih Jenis Pekerjaan</option>
                  <option value="Front End">Front End</option>
                  <option value="Back End">Back End</option>
                  <option value="Ui/Ux Designer">Ui/Ux Designer</option>
                  <option value="System Analyst">System Analyst</option>
                </select>
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="namaperusahaan" class="form-label">Nama Perusahaan <span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="name_intitutions" placeholder="Ex: PT Techno Infinity" />
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label">Tanggal Mulai<span style="color: red;">*</span></label>
                <input type="month" name="startdate" class="form-control" placeholder="Month" />
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label">Tanggal Berakhir<span style="color: red;">*</span></label>
                <input type="month" name="enddate" class="form-control" placeholder="Month" />
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="deskripsi" class="form-label">Deskripsi</label>
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
          <form class="default-form" action="{{ url('mahasiswa/profile/pengalaman/update/' . $pengalaman?->id_experience??'')}}" method="POST">
            @csrf
            <div class="row">
              <div class="mb-3 col-md-6 form-input">
                <label for="" class="form-label">Posisi / Bidang <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="posisi" name="posisi"  placeholder="Ex: UI/UX Designer" />
                <div class="invalid-feedback"></div>     
              </div>
              <div class="mb-3 col-md-6 form-input">
                <label for="" class="form-label">Jenis Pekerjaan <span style="color: red;">*</span></label>
                <select id="editjenis" name="jenis" class="select2 form-select">
                  <option disabled selected>Pilih Jenis Pekerjaan</option>
                  <option value="Front End">Front End</option>
                  <option value="Back End">Back End</option>
                  <option value="Ui/Ux Designer">Ui/Ux Designer</option>
                  <option value="System Analyst">System Analyst</option>
                </select>
                <div class="invalid-feedback"></div>
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label">Nama Perusahaan <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="editname_institutions" name="name_institutions" placeholder="Ex: PT Techno Infinity" />
                <div class="invalid-feedback"></div>             
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label">Tanggal Mulai<span style="color: red;">*</span></label>
                <input type="yearpicker" id="editstartdate"  name="startdate" class="form-control" />
                <div class="invalid-feedback"></div>             
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label">Tanggal Berakhir<span style="color: red;">*</span></label>
                <input type="date" id="editenddate" name="enddate" class="form-control" />
                <div class="invalid-feedback"></div>             
              </div>
              <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label">Deskripsi</label>
                <textarea class="form-control" type="text" id="deskripsi" name="deskripsi" placeholder="Ketik di sini..."></textarea>
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
