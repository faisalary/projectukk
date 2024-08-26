<div class="modal fade modals" id="largeModal">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        @if (auth()->user()->hasRole('Dosen'))
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="largeModalLabel">Ubah Data Profile</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="modal-body">
            <h4>Informasi Pribadi</h4>
            <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 2rem;">
                <div>
                    <label for="id_univ" class="form-label">Universitas</label>
                    <select class="form-select select2" id="id_univ" name="id_univ" onchange="getDataSelect($(this));" data-after="id_fakultas" data-placeholder="Pilih Universitas" data-select2-id="id_univ_import">
                        <option value="" disabled selected>Pilih Universitas</option>
                        @foreach ($universitas as $u)
                            <option value="{{ $u->id_univ }}" {{ ($dosen->namauniv === $u->namauniv) ? "selected" : "" }}>{{ $u->namauniv }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                <div>
                    <label for="id_fakultas" class="form-label">Fakultas</label>
                    <select class="form-select select2" id="id_fakultas" name="id_fakultas" onchange="getDataSelect($(this));" data-after="id_prodi" data-placeholder="Pilih Fakultas" data-select2-id="id_fakultas_import">
                        <option value="" disabled selected>Pilih Fakultas</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                <div>
                    <label for="id_prodi" class="form-label">Prodi</label>
                    <select class="form-select select2" id="id_prodi" name="id_prodi" onchange="getDataSelect($(this));" data-after="kode_dosen" data-placeholder="Pilih Prodi" data-select2-id="id_prodi_import">
                        <option value="" disabled selected>Pilih Prodi</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                {{-- <div>
                    <label for="changeNIP">NIP
                        <span class="text-danger">*</span>
                    </label>
                    <br>
                    <input type="text" id="changeNIP" placeholder="Masukkan Nomor Induk Dosen" style="width: 100%;  height: 3rem;" class="px-2 rounded border">
                </div>
                <div>
                    <label for="changeKodeDosen">Kode Dosen
                        <span class="text-danger">*</span>
                    </label>
                    <br>
                    <input type="text" id="changeKodeDosen" placeholder="Masukkan Kode Dosen" style="width: 100%;  height: 3rem;" class="px-2 rounded border">
                </div> --}}
                <div>
                    <label for="changeNamaDosen">Nama Dosen
                        <span class="text-danger">*</span>
                    </label>
                    <br>
                    <input type="text" id="changeNamaDosen" placeholder="Masukkan Nama Dosen" style="width: 100%;  height: 3rem;" class="px-2 rounded border">
                </div>
            </div>
            <h4 class="mt-3">Kontak</h4>
            <div style="display:grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap:2rem;">
                <div>
                    <label for="changeNoTelp">No Telp
                        <span class="text-danger">*</span>
                    </label>
                    <br>
                    <input type="text" id="changeNoTelp" placeholder="Masukkan No Telp" style="width: 100%;  height: 3rem;" class="px-2 rounded border">
                </div>
                <div>
                    <label for="changeEmail">Email
                        <span class="text-danger">*</span>
                    </label>
                    <br>
                    <input type="text" id="changeEmail" placeholder="Masukkan Email" style="width: 100%;  height: 3rem;" class="px-2 rounded border">
                </div>
            </div>
          </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Simpan</button>
          </div>
        </div>
        @elseif (auth()->user()->hasRole('Mitra'))
        <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="largeModalLabel">Ubah Data Profile</h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body">
              <div style="display: grid; grid-template-columns: repeat(1, minmax(0, 1fr)); gap: 1rem;">
                  <div>
                      <label for="changeNamaPegawai">Nama Pegawai
                        <span class="text-danger">*</span>
                      </label>
                      <br>
                      <input type="text" id="changeNamaPegawai" placeholder="Masukkan Nama Pegawai" style="width: 100%; height: 3rem;" class="px-2 rounded border">
                  </div>
                  <div>
                      <label for="changeNoTelp">
                         No Telp
                         <span class="text-danger">*</span>
                      </label>
                      <br>
                      <input type="text" id="changeNoTelp" placeholder="Masukan No Telp" style="width: 100%;  height: 3rem;" class="px-2 rounded border">
                  </div>
                  <div>
                      <label for="changeEmail">Email
                        <span class="text-danger">*</span>
                      </label>
                      <br>
                      <input type="text" id="changeEmail" placeholder="Masukkan Email" style="width: 100%;  height: 3rem;" class="px-2 rounded border">
                  </div>
                  <div>
                      <label for="changeJabatan">Jabatan
                        <span class="text-danger">*</span>
                      </label>
                      <br>
                      <input type="text" id="changeJabatan" placeholder="Masukkan Jabatan" style="width: 100%;  height: 3rem;" class="px-2 rounded border">
                  </div>
              </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        @elseif (auth()->user()->hasRole('LKM'))
        <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="largeModalLabel">Ubah Data Profile</h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body">
              <div style="display: grid; grid-template-columns: repeat(1, minmax(0, 1fr)); gap: 1rem;">
                  <div>
                      <label for="changeEmail">Email
                        <span class="text-danger">*</span>
                      </label>
                      <br>
                      <input type="text" id="changeEmail" placeholder="Masukkan Email" style="width: 100%; height: 3rem;" class="px-2 rounded border">
                  </div>
                  <div>
                      <label for="changeUsername">
                         Username
                         <span class="text-danger">*</span>
                      </label>
                      <br>
                      <input type="text" id="changeUsername" placeholder="Masukan Username" style="width: 100%;  height: 3rem;" class="px-2 rounded border">
                  </div>
              </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        @endif
    </div>
</div>