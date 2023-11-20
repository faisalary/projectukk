@extends('partials_mahasiswa.template')

@section('page_style')
<style>
</style>
  
@endsection

@section('main')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="sec-title mt-4 mb-4">
      <h4>Profil / Informasi Pribadi / Dokumen Pendukung</h4>
  </div>
  <!-- Dokumen Pendukung -->

  <div class="row mt-4 mb-4">
      <div class="col-12">
      <div class="card">
          <div class="card-body">
              <div class="d-flex justify-content-between border-bottom pb-2">
                  <h5 class="text-secondary">DOKUMEN PENDUKUNG</h5>
                  <span class="badge bg-label-success rounded-pill p-2">
                      <i class="ti ti-plus ti-sm" data-bs-toggle="modal" data-bs-target="#modalTambahDokumen"></i>
                    </span>
              </div>
              <div class=" border-bottom item">
                  <ul class="timeline ms-4 mb-0 mt-4">
                      <li class="timeline-item timeline-item-transparent" style="border-left: 0px solid">
                          <span class="timeline-point timeline-point-success"></span>
                          <div class="timeline-event">
                                  <div class="timeline-header d-flex justify-content-between">
                                  <h6 class="mb-0">Desain UI/UX Website</h6> 
                                  <div>
                                  <i class="menu-icon tf-icons ti ti-edit text-success" data-bs-toggle="modal" data-bs-target="#modalEditDokumen"></i>
                                  <i class="menu-icon tf-icons ti ti-trash text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"></i>
                              </div>
                                  </div>
                                  <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tristique eros eget mauris blandit, vel gravida turpis molestie.</p>
                                  <div class="d-flex align-items-start">
                                      <div>
                                        <img src="../../app-assets/img/avatars/2.png">
                                      </div>
                                      <div class="me-2 ms-4">
                                        <h6 class="mt-5">UI/UX Website.pdf</h6>
                                      </div>
                                  </div>
                          </div>
                      </li>
                  </ul> 
              </div>
              <div class="border-bottom item">
                  <ul class="timeline ms-4 mb-0 mt-4">
                      <li class="timeline-item timeline-item-transparent" style="border-left: 0px solid">
                          <span class="timeline-point timeline-point-success"></span>
                          <div class="timeline-event">
                                  <div class= "timeline-header d-flex justify-content-between">
                                  <h6 class="mb-0">Desain UI/UX Mobile App</h6> 
                                  <div>
                                  <i class="menu-icon tf-icons ti ti-edit text-success"></i>
                                  <i class="menu-icon tf-icons ti ti-trash text-danger"></i>
                                  </div>
                                  </div>
                                  <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tristique eros eget mauris blandit, vel gravida turpis molestie.</p>
                                  <div class="d-flex align-items-start">
                                      <div>
                                        <img src="../../app-assets/img/avatars/2.png">
                                      </div>
                                      <div class="me-2 ms-4">
                                        <h6 class="mt-5">UI/UX Mobile App.pdf</h6>
                                      </div>
                                  </div>
                          </div>
                      </li>
                  </ul> 
              </div>
              <div class="border-bottom item">
                  <ul class="timeline ms-4 mb-0 mt-4">
                      <li class="timeline-item timeline-item-transparent" style="border-left: 0px solid">
                          <span class="timeline-point timeline-point-success"></span>
                          <div class="timeline-event">
                                  <div class="timeline-header d-flex justify-content-between">
                                  <h6 class="mb-0">Desain UI/UX Website</h6> 
                                  <div>
                                  <i class="menu-icon tf-icons ti ti-edit text-success"></i>
                                  <i class="menu-icon tf-icons ti ti-trash text-danger"></i>
                              </div>
                                  </div>
                                  <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tristique eros eget mauris blandit, vel gravida turpis molestie.</p>
                                  <div class="d-flex align-items-start">
                                      <div>
                                        <img src="../../app-assets/img/avatars/2.png">
                                      </div>
                                      <div class="me-2 ms-4">
                                        <h6 class="mt-5">UI/UX Website.pdf</h6>
                                      </div>
                                  </div>
                          </div>
                      </li>
                  </ul> 
              </div>
              <div class="border-bottom item">
                  <ul class="timeline ms-4 mb-0 mt-4">
                      <li class="timeline-item timeline-item-transparent" style="border-left: 0px solid">
                          <span class="timeline-point timeline-point-success"></span>
                          <div class="timeline-event">
                                  <div class="timeline-header d-flex justify-content-between">
                                  <h6 class="mb-0">Desain UI/UX Mobile App</h6> 
                                  <div>
                                  <i class="menu-icon tf-icons ti ti-edit text-success"></i>
                                  <i class="menu-icon tf-icons ti ti-trash text-danger"></i>
                                  </div>
                                  </div>
                                  <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tristique eros eget mauris blandit, vel gravida turpis molestie.</p>
                                  <div class="d-flex align-items-start">
                                      <div>
                                        <img src="../../app-assets/img/avatars/2.png">
                                      </div>
                                      <div class="me-2 ms-4">
                                        <h6 class="mt-5">UI/UX Mobile App.pdf</h6>
                                      </div>
                                  </div>
                          </div>
                      </li>
                  </ul> 
              </div>
          </div>
      </div>
      </div>
  </div>

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
        <form id="formAccountSettings" method="POST" onsubmit="return false">
          <div class="row">
              <div class="mb-3 col-md-6">
                  <label for="judul" class="form-label">Judul</label>
                  <input class="form-control" type="text" id="judul" name="judul" placeholder="EX: Portofolio"/>
            </div>
            <div class="mb-3 col-md-6">
              <label for="unggahfile" class="form-label">Unggah File</label>
              <input class="form-control" type="file" id="unggahfile" multiple="">
              </div>
              <div class="mb-3 col-md-12">
                  <label for="deskripsi" class="form-label">Deskripsi</label>
                  <input class="form-control form-control-lg" type="text" id="deskripsi" name="deskripsi" placeholder="Ketik di sini..."/>
                </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success me-2">Simpan</button>
            <button type="reset" class="btn btn-label-secondary">Batalkan</button>
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
        <div class="d-flex align-items-start align-items-sm-center gap-4 mb-2">
        </div>
        <form id="formAccountSettings" method="POST" onsubmit="return false">
          <div class="row">
              <div class="mb-3 col-md-6">
                  <label for="judul" class="form-label">Judul</label>
                  <input class="form-control" type="text" id="judul" name="judul" placeholder="Portofolio"/>
            </div>
            <div class="mb-3 col-md-6">
              <label for="unggahfile" class="form-label">Unggah File</label>
              <input class="form-control" type="file" id="unggahfile" multiple="">
              </div>
              <div class="mb-3 col-md-12">
                  <label for="deskripsi" class="form-label">Deskripsi</label>
                  <input class="form-control form-control-lg" type="text" id="deskripsi" name="deskripsi" placeholder="Lorem Ipsum"/>
                </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success me-2">Simpan</button>
            <button type="reset" class="btn btn-label-secondary">Batalkan</button>
          </div>
        </form>
      
      </div>
      <!-- /Account -->
          </div>
      </div>
  </div>

  <!-- Modal Delete Dokumen Pendukung-->
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
                    <button type="submit" id="modal-button" class="btn btn-success">Iya</button>
                    <button type="submit" id="modal-button" class="btn btn-danger">Tidak</button>
                </div>
            
        </div>
    </div>
  </div>

</div>

@endsection

@section('page_script')

@endsection