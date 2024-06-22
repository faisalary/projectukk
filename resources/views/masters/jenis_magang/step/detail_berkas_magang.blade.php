<!-- Berkas Magang -->
<div class="content">
    <div class="content-header">
        <h6 class="mb-0">Berkas Magang</h6>
    </div>
    <div class="row g-3 form-repeater">
        <div data-repeater-list="berkas">
            @if (isset($berkas_magang))
            @foreach ($berkas_magang as $key => $item)
            <div class="border-bottom" data-repeater-item data-callback="afterShown">
                <input type="hidden" class="id_berkas" name="berkas[][id_berkas_magang]" value="{{ $item->id_berkas_magang }}">
                <div class="row my-4">
                    <div class="mb-3 col-8 form-group">
                        <label class="form-label" for="namaberkas{{ $key }}">Berkas Magang<span class="text-danger">*</span></label>
                        <input type="text" name="berkas[][namaberkas]" id="namaberkas{{ $key }}" class="form-control" placeholder="Masukan Nama Berkas" value="{{ $item->nama_berkas }}" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3 col-4 form-group">
                        <small>Status Upload<span class="text-danger">*</span></small>
                        <div class="d-flex justify-content-between align-items-center my-2">
                            <div class="form-check">
                                <input name="berkas[][statusupload]" id="statusupload{{ $key }}" class="form-check-input" type="radio" value="1" @checked($item->status_upload == 1) />
                                <label class="form-check-label" for="statusupload{{ $key }}">Wajib Upload</label>
                            </div>
                            <div class="form-check">
                                <input name="berkas[][statusupload]" id="statusupload2{{ $key }}" class="form-check-input" type="radio" value="0" @checked($item->status_upload == 0) />
                                <label class="form-check-label" for="statusupload2{{ $key }}">Tidak Wajib Upload</label>
                            </div>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 form-group">
                        <div class="container-label" class="d-flex mb-1 justify-content-start align-items-center">
                            <label class="form-label mb-0 me-2" for="template{{ $key }}">
                                Upload Template<span class="text-danger">*</span>
                            </label>
                            <a href="{{ url('storage/' . $item->template) }}" target="_blank"><small><em>-Existing File-</em></small></a>
                        </div>
                        <div class="d-flex justify-content-between">
                            <input class="form-control" name="berkas[][template]" type="file" id="template{{ $key }}">
                            <button type="button" class="btn btn-icon ms-3 btn-outline-danger" data-repeater-delete>
                                <i class="ti ti-trash ti-xs"></i>
                            </button>
                        </div>
                        <small class="text-muted">Tipe File: .PDF Maximum upload file size : 2 MB.</small>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="border-bottom" data-repeater-item>
                <div class="row my-4">
                    <div class="mb-3 col-8 form-group">
                        <label class="form-label" for="namaberkas">Berkas Magang<span class="text-danger">*</span></label>
                        <input type="text" name="namaberkas" id="namaberkas" class="form-control" placeholder="Masukan Nama Berkas" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3 col-4 form-group">
                        <small>Status Upload<span class="text-danger">*</span></small>
                        <div class="d-flex justify-content-between align-items-center my-2">
                            <div class="form-check">
                                <input name="statusupload" id="statusupload" class="form-check-input" type="radio" value="1" />
                                <label class="form-check-label" for="statusupload">Wajib Upload</label>
                            </div>
                            <div class="form-check">
                                <input name="statusupload" id="statusupload2" class="form-check-input" type="radio" value="0" />
                                <label class="form-check-label" for="statusupload2">Tidak Wajib Upload</label>
                            </div>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 form-group">
                        <div class="d-flex mb-1 justify-content-between align-items-center">
                            <label class="form-label mb-0" for="template">Upload Template<span class="text-danger">*</span></label>
                        </div>
                        <div class="d-flex justify-content-between">
                            <input class="form-control" name="template" type="file" id="template">
                            <button type="button" class="btn btn-icon ms-3 btn-outline-danger" data-repeater-delete>
                                <i class="ti ti-trash ti-xs"></i>
                            </button>
                        </div>
                        <small class="text-muted">Tipe File: .PDF Maximum upload file size : 2 MB.</small>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="d-flex justify-content-start mt-3">
            <button type="button" class="btn btn-outline-primary" data-repeater-create>
                <span class="align-middle">Tambah</span>
            </button>
        </div>
        <div class="col-12 d-flex justify-content-between mt-5">
            <button type="button" class="btn btn-label-secondary btn-prev">
                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary button-next" type="button" data-step="{{ Crypt::encryptString("2") }}">Submit</button>
        </div>
    </div>
</div>