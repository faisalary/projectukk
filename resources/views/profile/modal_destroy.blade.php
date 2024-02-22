  <!-- Modal Delete Pengalaman -->
  <div class="modal fade" id="deleteModalPengalaman" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <h5 class="modal-title" id="modal-title">Apakah Anda Ingin menghapus <br> Pengalaman Ini?</h5>
        </div>
        <div class="modal-footer" style="display: flex; justify-content:center;">
          <button type="submit" id="modal-button" class="btn btn-success">Iya</button>
          <button type="submit" id="modal-button" class="btn btn-danger">Tidak</button>
        </div>

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
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Tidak</button>
        </div>
      </div>
    </div>
  </div>
  