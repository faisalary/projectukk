<!-- Modal Tambah Pendidikan -->
<div class="modal fade" id="modalTambahPendidikan" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header d-block">
        <h5 class="modal-title" id="modal-title">Edit Pendidikan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form class="default-form" action="{{ url('mahasiswa/profile/pendidikan/update/'. Auth::user()->nim)}}" method="POST">
        @csrf
        <div class="row">
            <div class="mb-3 col-md-12 form-input">
            <label for="namasekolah" class="form-label">Nama Sekolah/Universitas<span style="color: red;">*</span></label>
            <input class="form-control" type="text" id="namasekolah" name="name_intitutions" value="{{$pendidikan?->name_intitutions??''}}" placeholder="Nama Sekolah" />
            <div class="invalid-feedback"></div>
        </div>
            <div class="mb-3 col-md-12 form-input">
            <label for="pendidikan" class="form-label">Jenis Pendidikan<span style="color: red;">*</span></label>
            <select name="tingkat" id="pendidikan" class="select2 form-select">
                <option disabled selected>Pilih Tingkat Pendidikan</option>
                <option value="SMA">SMA</option>
                <option value="SMK">SMK</option>
            </select>
            <div class="invalid-feedback"></div>
            </div>

            <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label">Tanggal Mulai<span style="color: red;">*</span></label>
                <input type="date" id="startdate" value="{{$pendidikan ? $pendidikan->startdate : ''}}" name="startdate" class="form-control" />
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3 col-md-12 form-input">
                <label for="" class="form-label">Tanggal Berakhir<span style="color: red;">*</span></label>
                <input type="date" id="enddate" value="{{$pendidikan ? $pendidikan->enddate : ''}}" name="enddate" class="form-control" />
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3 col-md-12 form-input">
                <label for="NILAI" class="form-label">Nilai Akhir</label>
                <input class="form-control" type="text" value="{{$pendidikan?->nilai??''}}" id="nilai" name="nilai" autofocus />
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

{{-- <!-- Modal Edit Pendidikan -->
<div class="modal fade" id="modalEditPendidikan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header d-block">
        <h5 class="modal-title" id="modal-title">Edit Pendidikan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form id="form" method="POST" onsubmit="return false">
            <div class="row">
            <div class="mb-3 col-md-12">
                <label for="namasekolah" class="form-label">Nama Sekolah/Universitas<span style="color: red;">*</span></label>
                <input class="form-control" type="text" id="namasekolah" name="namasekolah" value="" placeholder="Nama Sekolah" />
            </div>
            <div class="mb-3 col-md-12">
                <label for="pendidikan1" class="form-label">Tingkat Pendidkan<span style="color: red;">*</span></label>
                <select id="pendidikan1" class="select2 form-select">
                <option disabled selected>Pilih Tingkat Pendidkan</option>
                <option value="pendidikan">D3</option>
                <option value="pendidikan">S1</option>
                </select>
            </div>
            <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Mulai<span style="color: red;">*</span></label>
                <input type="month" id="month" class="form-control" placeholder="Month" />
            </div>
            <div class="mb-3 col-md-12">
                <label for="" class="form-label">Tanggal Berakhir<span style="color: red;">*</span></label>
                <input type="month" id="month" class="form-control" placeholder="Month" />
            </div>
            <div class="mb-3 col-md-12">
                <label for="IPK" class="form-label">IPK</label>
                <input class="form-control" type="text" id="ipk" name="ipk" placeholder="4.00" autofocus />
            </div>
            </div>
            <div class="modal-footer p-0">
            <button type="submit" class="btn btn-success m-0">Simpan Data</button>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>  --}}