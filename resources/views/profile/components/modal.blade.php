<!-- Modal Edit Informasi Pribadi -->
<div class="modal fade" id="modalEditInformasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block">
                <h5 class="modal-title" id="modal-title">Informasi Pribadi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Account -->

            <form class="default-form" action="{{ route('profile.update_data') }}" function-callback="afterUpdateDetailInfo">
                @csrf
                <div class="modal-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4 ">
                        <img src="{{ url('app-assets/img/avatars/14.png') }}" alt="user-avatar" class="img-fluid rounded mb-3 pt-1 mt-4" id="imgPreview" />
                        <div class="button-wrapper form-input">
                            <label for="changePicture" class="btn btn-white text-primary me-2 mb-3 waves-effect waves-light" tabindex="0">
                                <i class="ti ti-upload d-block pe-2"></i>
                                <span class="d-none d-sm-block">Upload</span>
                                <input type="file" id="changePicture" name="profile_picture" class="account-file-input" hidden accept="image/png, image/jpeg">
                            </label>
                            <div class="invalid-feedback"></div>
                            <button type="button" class="btn btn-label-secondary account-image-reset mb-3" onclick="removeImage()">
                                <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Atur Ulang</span>
                            </button>
                            <div class="text-muted">Format FIle JPG, GIF atau PNG. Ukuran Maksimal 800KB</div>
                        </div>
                    </div>
                    <div class="row border-top mt-4">
                        <div class="mb-3 col-md-6 form-group">
                            <label for="nim" class="form-label">NIM <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="nim" name="nim" placeholder="" disabled />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="namamhs" class="form-label">Nama Lengkap <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="namamhs" name="namamhs" disabled />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="namauniv" class="form-label">Universitas <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="namauniv" name="namauniv" disabled />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="namafakultas" class="form-label">Fakultas <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="namafakultas" name="namafakultas" disabled />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="namaprodi" class="form-label">Program Studi <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="namaprodi" name="namaprodi" disabled />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="angkatan" class="form-label">Angkatan <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="angkatan" name="angkatan" disabled />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="emailmhs" class="form-label">Email <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="emailmhs" name="emailmhs" disabled />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label class="form-label" for="nohpmhs">No. Telp</label>
                            <input type="text" id="nohpmhs" name="nohpmhs" class="form-control" disabled />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-4 form-group">
                            <label for="ipk" class="form-label">IPK <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="ipk" name="ipk" disabled />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-4 form-group">
                            <label for="eprt" class="form-label">EPRT<span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="eprt" name="eprt" disabled />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-4 form-group">
                            <label for="tak" class="form-label">TAK <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="tak" name="tak" disabled />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir <span style="color: red;">*</span></label>
                            <input name="tgl_lahir" id="tgl_lahir" type="text" class="form-control flatpickr-date" placeholder="YYYY-MM-DD">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label class="form-label">Jenis Kelamin <span style="color: red;">*</span></label>
                            <div class="form-check mt-2">
                                <div class="row">
                                    <div class="col-3">
                                        <input name="gender" class="form-check-input" type="radio" value="Laki-Laki" id="gender-man">
                                        <label class="form-check-label" for="gender-man"> Laki-Laki </label>
                                    </div>
                                    <div class="col-3 ms-2">
                                        <input name="gender" class="form-check-input" type="radio" value="Perempuan" id="gender-women">
                                        <label class="form-check-label" for="gender-women"> Perempuan </label>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                            <label for="headliner" class="form-label">Headliner</label>
                            <input class="form-control" type="text" id="headliner" name="headliner" placeholder="cth. UI/UX Desginer" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                            <label for="alamatmhs" class="form-label">Alamat <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="alamatmhs" name="alamatmhs" placeholder="jln. merdeka" disabled />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                            <label for="deskripsi_diri" class="form-label">Deskripsi Diri</label>
                            <textarea class="form-control" name="deskripsi_diri" id="deskripsi_diri" rows="2"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary m-0">Simpan Data</button>
                </div>
            </form>
            <!-- /Account -->
        </div>
    </div>
</div>

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
                <form class="default-form" action="{{ url('mahasiswa/profile/informasi-tambahan/update/' . Auth::user()->nim) }}">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12 p-0 form-input">
                            <label for="lok_kerja" class="form-label">Lokasi kerja yang diharapkan <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="lok_magang" name="lok_magang" placeholder="Lokasi Kerja" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="border mb-3" style="border-radius: 8px;">
                            <div class="form-repeater">
                                <div data-repeater-list="tambahan">
                                    <div data-repeater-item="">
                                        <div class="row mt-2 me-1">
                                            <div class="mb-3 col-md-11 form-input">
                                                <label class="form-label" for="bahasaedit">Bahasa <span style="color: red;">*</span></label>
                                                <select id="bahasaedit" name="bahasa" class="form-select">
                                                    <option disabled selected>Pilih Jenis Bahasa</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="Inggris">Inggris</option>
                                                    <option value="Korea">Korea</option>
                                                    <option value="Jepang">Jepang</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3 col-md-1 mb-0">
                                                <button type="button" class="btn btn-outline-danger mt-4" style="width:0px" data-repeater-delete>
                                                    <i class="ti ti-trash fa-lg"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-outline-primary" data-repeater-create>
                                        <span class="align-middle">Tambah</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="border" style="border-radius: 8px;">
                            <div class="form-repeater">
                                <div data-repeater-list="sosialmedia">
                                    <div data-repeater-item="">
                                        <div class="row mt-2 me-1">
                                            <div class="mb-3 col-md-4 form-input">
                                                <label for="form-repeater-1-1" class="form-label">Sosial Media <span style="color: red;">*</span></label>
                                                <select id="sosmed1" name="sosmed" class="form-select">
                                                    <option disabled selected>Pilih Sosial Media</option>
                                                    <option value="Instagram">Instagram</option>
                                                    <option value="Linkedin">Linkedin</option>
                                                    <option value="Facebook">Facebook</option>
                                                    <option value="Twiteer">Twiteer</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3 col-md-7 form-input">
                                                <input class="form-control mt-4" type="text" id="urlsosmed" name="url_sosmed" placeholder="URL/Username" />
                                                <div class="invalid-feedback"></div>
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
                                    <button type="button" class="btn btn-outline-primary waves-effect"
                                        data-repeater-create="">
                                        <span class="align-middle">Tambah</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt-3 pe-0">
                        <button type="submit" class="btn btn-primary m-0">Simpan Data</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal Tambah Pendidikan -->
<div class="modal fade" id="modalTambahPendidikan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block">
                <h5 class="modal-title" id="modal-title" data-label-default="Tambah Pendidikan" data-label-edit="Edit Pendidikan">Tambah Pendidikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="default-form" action="{{ route('profile.update_pendidikan') }}" function-callback="afterActionEducation">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12 form-group">
                            <label for="name_intitutions" class="form-label">Nama Sekolah/Universitas<span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="name_intitutions" name="name_intitutions" placeholder="Nama Sekolah" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                            <label for="tingkat" class="form-label">Jenis Pendidikan<span style="color: red;">*</span></label>
                            <select name="tingkat" id="tingkat" class="select2 form-select" data-placeholder="Pilih Tingkat Pendidikan">
                                <option disabled value="" selected>Pilih Tingkat Pendidikan</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="SMK">SMK</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                                <option value="S1">S1</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-6 form-group">
                            <label for="startdate" class="form-label">Tanggal Mulai<span style="color: red;">*</span></label>
                            <input type="text" id="startdate" name="startdate" class="form-control month-picker" placeholder="Tanggal Mulai" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-6 form-group">
                            <label for="enddate" class="form-label">Tanggal Berakhir<span style="color: red;">*</span></label>
                            <input type="text" id="enddate" name="enddate" class="form-control month-picker" placeholder="Tanggal Berakhir" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                            <label for="NILAI" class="form-label">Nilai Akhir</label>
                            <input class="form-control" type="text" id="nilai" name="nilai" placeholder="3.8"/>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer p-0">
                        <button type="submit" class="btn btn-primary m-0">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Keahlian -->
<div class="modal fade" id="modalTambahKeahlian" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-block">
                <h5 class="modal-title" id="modal-title">Edit Keahlian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" action="{{ route('profile.update_keahlian') }}" function-callback="afterActionSkill">
                <div class="modal-body border-top mt-3">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-12 form-group">
                            <label for="skills" class="form-label">Keahlian<span style="color: red;">*</span></label>
                            <select class="form-select select2" name="skills[]" id="skills" data-placeholder="Pilih Keahlian" data-tags="true" multiple>
                                <option value="Figma">Figma</option>
                                <option value="Valorant">Valorant</option>
                                <option value="Mobile Legend">Mobile Legend</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary m-0">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Pengalaman -->
<div class="modal fade" id="modalTambahPengalaman" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block">
                <h5 class="modal-title" id="modal-title" data-label-default="Tambah Pengalaman" data-label-edit="Edit Pengalaman">Tambah Pengalaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Account -->
            <div class="modal-body border-top mt-3">
                <div class="d-flex align-items-start align-items-sm-center gap-4 mb-2">
                </div>
                <form class="default-form" action="{{ route('profile.update_experience') }}" function-callback="afterActionExperience">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6 form-group">
                            <label for="posisi" class="form-label">Posisi / Bidang <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" name="posisi" id="posisi" placeholder="Ex: UI/UX Designer" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="jenis" class="form-label">Jenis Pekerjaan <span style="color: red;">*</span></label>
                            <select name="jenis" id="jenis" class="select2 form-select" data-placeholder="Pilih Jenis Pekerjaan" data-tags="true">
                                <option value="" disabled selected>Pilih Jenis Pekerjaan</option>
                                <option value="Front End">Front End</option>
                                <option value="Back End">Back End</option>
                                <option value="Ui/Ux Designer">Ui/Ux Designer</option>
                                <option value="System Analyst">System Analyst</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                            <label for="name_intitutions" class="form-label">Nama Perusahaan <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" name="name_intitutions" id="name_intitutions" placeholder="Ex: PT Techno Infinity" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="startdate" class="form-label">Tanggal Mulai<span style="color: red;">*</span></label>
                            <input type="text" name="startdate" id="startdate" class="form-control month-picker" placeholder="Month" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="enddate" class="form-label">Tanggal Berakhir<span style="color: red;">*</span></label>
                            <input type="text" name="enddate" id="enddate" class="form-control month-picker" placeholder="Month" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" type="text" name="deskripsi" placeholder="Ketik di sini..."></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer p-0">
                        <button type="submit" class="btn btn-primary m-0">Simpan Data</button>
                    </div>
                </form>
            </div>
            <!-- /Account -->
        </div>
    </div>
</div>

<!-- Modal Tambah Dokumen Pendukung -->
<div class="modal fade" id="modalTambahDokumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block">
                <h5 class="modal-title" id="modal-title" data-label-default="Tambah Dokumen Pendukung" data-label-edit="Edit Dokumen Pendukung">Tambah Dokumen Pendukung</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Account -->
            <div class="modal-body border-top mt-3">
                <div class="d-flex align-items-start align-items-sm-center gap-4 mb-2">
                </div>
                <form class="default-form" action="{{ route('profile.update_dokumen') }}" function-callback="afterActionDokumen">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12 form-group">
                            <label for="nama_sertif" class="form-label">Nama Sertifikasi<span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="nama_sertif" name="nama_sertif" placeholder="Masukkan nama sertifikasi " />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                            <label for="penerbit" class="form-label">Penerbit Sertifikasi<span style="color: red;">*</span></label>
                            <input class="form-control" type="text" name="penerbit" id="penerbit" placeholder="Masukkan nama penerbit " />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="startdate" class="form-label">Tanggal Terbit<span style="color: red;">*</span></label>
                            <input type="text" id="startdate" name="startdate" class="form-control month-picker" placeholder="Month" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="enddate" class="form-label">Tanggal Kadaluwarsa<span style="color: red;">*</span></label>
                            <input type="enddate" id="enddate" name="enddate" class="form-control month-picker" placeholder="Month" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                            <label for="file_sertif" class="form-label">Upload File<span style="color: red;">*</span></label>
                            <input class="form-control" type="file" name="file_sertif" id="file_sertif">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                            <label for="link_sertif" class="form-label">Link Sertifikasi <span style="color: red;">*</span>&ensp;</label>
                            <input class="form-control" type="text" id="link_sertif" name="link_sertif" placeholder="Masukkan link Sertifikat  " />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" type="text" id="deskripsi" name="deskripsi" placeholder="Ketik di sini..."></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer p-0">
                        <button type="submit" class="btn btn-primary m-0">Simpan Data</button>
                    </div>
                </form>
            </div>
            <!-- /Account -->
        </div>
    </div>
</div>
