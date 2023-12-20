<!-- Modal Tambah-->
<div class="modal fade" id="modal-email" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-block">
                <h5 class="modal-title" id="modal-title">Tambah Template Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="default-form" method="POST" action="{{ route('master_email.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body pt-2">
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="subject" class="form-label">Subjek</label>
                            <input type="text" class="form-control" placeholder="Subjek Email"
                                aria-describedby="defaultFormControlHelp" name="subject_email" id="subject_email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2 form-input">
                            <label for="headline" class="form-label">Headline</label>
                            <input type="text" class="form-control" placeholder="Headline Email"
                                aria-describedby="defaultFormControlHelp" name="headline_email" id="headline_email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="content" class="form-label">Konten</label>
                            <textarea class="form-control" placeholder="Konten Email" id="content_email" name="content_email" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="attachment" class="form-label">Attachment</label>
                            <input class="form-control @error('attachment') is-invalid @enderror" type="file" id="attachment" name="attachment" multiple="">
                            @error('attachment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-subtitle text-muted mb-3">Tipe File: .pdf, xlsx. Maximum upload file size :
                        2 MB.</div>
                    <div class="card-link">
                        <a href={{ asset('storage/format.xlsx') }} class="card-link">Unduh Templat Excel</a>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="submit"class="btn btn-success" name="buttonSimpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
