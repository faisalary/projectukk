<!-- Modal Edit Informasi Tambahan -->
<div class="modal fade" id="modalEditInformasiTambahan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title" id="modal-title">Edit Informasi Tambahan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <hr />
        </div>

        <div class="modal-body p-0 ms-5 me-5">
          <form class="default-form" action="{{ url('mahasiswa/profile/informasi-tambahan/update/'. Auth::user()->nim)}}" id="informasitambahan" method="POST">
            @csrf
            <div class="row">
              <div class="mb-3 col-md-12 p-0 ">
                <label for="lok_kerja" class="form-label">Lokasi kerja yang diharapkan <span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="lok_kerja" name="lok_kerja" value="{{$informasitambahan?->lok_kerja??''}}" placeholder="Lokasi Kerja" />
              </div>
              <div class="border mb-3" style="border-radius: 8px;">
                <div class="form-repeater">
                  <div data-repeater-list="">
                    <div data-repeater-item="">
                      <div class="row mt-2 me-1">
                        <div class="mb-3 col-md-11">
                          <label class="form-label" for="bahasa">Bahasa <span style="color: red;">*</span></label>
                          <select id="bahasa" name="bahasa" class="form-select select2">
                            <option disabled selected value="{{$informasitamabahan->bahasa?->bahasa??''}}">Pilih Jenis Bahasa</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Inggris">Inggris</option>
                            <option value="Korea">Korea</option>
                            <option value="Jepang">Jepang</option>
                          </select>
                        </div>
                        <div class="mb-3 col-md-1 mb-0">
                          <button type="button" class="btn btn-outline-danger mt-4 waves-effect" style="width:0px" data-repeater-delete="">
                            <i class="ti ti-trash fa-lg"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <button type="button" class="btn btn-outline-success waves-effect" data-repeater-create="">
                      <span class="align-middle">Tambah</span>
                    </button>
                  </div>
                </div>
              </div>
              <div class="border " style="border-radius: 8px;">
                <div class="form-repeater">
                  <div data-repeater-list="">
                    <div data-repeater-item="">
                      <div class="row mt-2 me-1">
                        <div class="mb-3 col-md-4">
                          <label for="sosial" class="form-label">Sosial Media <span style="color: red;">*</span></label>
                          <select id="sosmed" name="sosmed" class="form-select select2">
                            <option disabled selected>Pilih Sosial Media</option>
                            <option value="Instagram">Instagram</option>
                            <option value="Linkedin">Linkedin</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Facebook">Twiteer</option>
                          </select>
                        </div>
                        <div class="mb-3 col-md-7">
                          <input class="form-control mt-4" type="text" id="urlsosmed" name="url_sosmed" placeholder="URL/Username" />
                        </div>
                        <div class="mb-3 col-md-1">
                          <button type="button" class="btn btn-outline-danger mt-4 waves-effect" style="width:0px" data-repeater-delete="">
                            <i class="ti ti-trash fa-lg"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <button type="button" class="btn btn-outline-success waves-effect" data-repeater-create="">
                      <span class="align-middle">Tambah</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer pt-3 pe-0">
              <button id="modal-button-infotam"  type="submit" class="btn btn-success m-0">Simpan Data</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>