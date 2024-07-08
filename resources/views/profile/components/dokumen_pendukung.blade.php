<div class="tab-pane fade show" id="navs-pills-justified-dokumen-pendukung" role="tabpanel">
    <div class="card mb-4">
        <div class="d-flex justify-content-between border-bottom pt-3 ps-3 pe-3">
            <h5 class="text-secondary pt-2 ps-2 pe-3">Dokumen Pendukung</h5>
            {{-- <i class="menu-icon tf-icons ti ti-plus text-success" data-bs-toggle="modal" data-bs-target="#modalTambahDokumen"></i> --}}
            <i class="menu-icon ps-2 pe-2 pb-2">
                <button class="btn btn-success" data-bs-target="#modalTambahDokumen" data-bs-toggle="modal">Tambah</button>
            </i>
        </div>
        <div class="card-body">
            <div>
                <ul class="timeline mb-0">
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">Desain UI/UX Website</h6>
                                <div>
                                    <i class="menu-icon tf-icons ti ti-edit text-warning"></i>
                                    <i class="menu-icon tf-icons ti ti-trash text-danger"></i>
                                </div>
                            </div>
                            <div class="border-bottom mb-3">
                                <p class="mb-1">Coursera</p>
                                <p style="font-size: small;">Juli 2023 - Juli 2030</p>
                                <div class="d-flex align-items-start mt-3 mb-3">
                                    <div>
                                        <img src="{{ url('assets/images/no-pictures.png') }}" width="200" height="auto" alt="img">
                                    </div>
                                    <div class="me-2 ms-4">
                                        <h6 class="mt-5"><a href="#" target="_blank">Lihat Dokumen</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">Desain UI/UX Website</h6>
                                <div>
                                    <i class="menu-icon tf-icons ti ti-edit text-warning"></i>
                                    <i class="menu-icon tf-icons ti ti-trash text-danger"></i>
                                </div>
                            </div>
                            <div class="border-bottom mb-3">
                                <p class="mb-1">Coursera</p>
                                <p style="font-size: small;">Juli 2023 - Juli 2030</p>
                                <div class="d-flex align-items-start mt-3 mb-3">
                                    <div>
                                        <img src="{{ url('assets/images/no-pictures.png') }}" width="200" height="auto" alt="img">
                                    </div>
                                    <div class="me-2 ms-4">
                                        <h6 class="mt-5"><a href="#" target="_blank">Lihat Dokumen</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-success"></span>
                    </li>
                </ul>
            </div>
            <a href="{{ url('mahasiswa/profile/dokumen-pendukung/detail/' . Auth::user()->nim) }}">
                <button class="btn btn-outline-success btn-lg col-md-12 toggle-button ms-1 me-7 mb-2 mt-5"
                    type="button">Selengkapnya</button>
            </a>
        </div>
    </div>
</div>
