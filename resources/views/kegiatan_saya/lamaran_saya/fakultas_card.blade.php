<!-- Magang Fakultas -->
<div class="tab-pane fade show active" id="navs-pills-justified-magang-fakultas" role="tabpanel">
    <div class="row mt-2" style="padding-left: 12px;">
        <ul class="nav nav-pills mb-3 " role="tablist">
            <li class="nav-item" style="font-size: 15px;">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-proses-seleksi" aria-controls="navs-pills-justified-proses-seleksi" aria-selected="false">
                    <i class="ti ti-presentation-analytics pe-1"></i> Proses Seleksi
                </button>
            </li>
            <li class="nav-item" style="font-size: 15px;">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-penawaran" aria-controls="navs-pills-justified-penawaran" aria-selected="false">
                    <i class="ti ti-speakerphone pe-1"></i> Penawaran
                </button>
            </li>
            <li class="nav-item" style="font-size: 15px;">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-terima" aria-controls="navs-pills-justified-terima" aria-selected="false">
                    <i class="ti ti-clipboard-check pe-1"></i> Terima Tawaran
                </button>
            </li>
            <li class="nav-item" style="font-size: 15px;">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tolak" aria-controls="navs-pills-justified-tolak" aria-selected="false">
                    <i class="ti ti-clipboard-x pe-1"></i> Tolak Tawaran
                </button>
            </li>
        </ul>

        <div class="tab-content p-0">
            <!-- Proses Seleksi -->
            <div class="tab-pane fade show active" id="navs-pills-justified-proses-seleksi" role="tabpanel">
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-md-4 col-12 mb-3 d-flex align-items-center justify-content-between">
                        <select class="select2" id="filter-status-lowongan" data-placeholder="Pilih Status Lowongan">
                            <option value="" disabled selected>Pilih Status Lowongan</option>
                            <option value="all">Semua</option>
                            <option value="screening">Screening</option>
                            <option value="tahap1">Tahap 1</option>
                            <option value="tahap2">Tahap 2</option>
                            <option value="tahap3">Tahap 3</option>
                            <option value="penawaran">Penawaran</option>
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                        <!-- <button class="btn btn-success waves-effect waves-light mx-2" type="submit" style="min-width: 142px;"><i class="tf-icons ti ti-checks"> Terapkan</i>
                        </button> -->
                    </div>
                </div>
                <div id="container-proses-seleksi" class="row"></div>
            </div>

            <!-- Penawaran -->
            <div class="tab-pane fade show" id="navs-pills-justified-penawaran" role="tabpanel">
                @if($penawaran->count() == 0)
                <img src="\assets\images\nothing.svg" alt="no-data" style="display: flex; margin-left: 
                    auto; margin-right: auto; margin-top: 5%; margin-bottom: 5%;  width: 28%;">
                <div class="sec-title mt-5 mb-4 text-center">
                    <h4>Anda belum memiliki Lowongan Magang pada tahap Penawaran</h4>
                </div>
                @else
                @foreach($penawaran as $item)
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            Lakukan konfirmasi penerimaan sebelum tanggal {{($item->lowongan_magang->date_confirm_closing?->format('d F Y'))}}!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <a href="{{ url('kegiatan-saya/detail', $item->id_lowongan)}}" style="color:#4B4B4B">
                            <div class="row mb-2">
                                <div class="col-2">
                                    <figure class="image mx-1" style="border-radius: 0%;"><img style="border-radius: 0%; width: 120px;" src="{{$item->img ?? '\assets\images\no-pictures.png'}}" alt="Logo">
                                    </figure>
                                </div>
                                <div class="col-10 d-flex justify-content-between">
                                    <div>
                                        <h5>{{$item->lowongan_magang->intern_position}}</h5>
                                        <p>{{$item->lowongan_magang->industri->namaindustri}}</p>
                                    </div>
                                    <div>
                                        <span class="badge bg-label-{{$item->color}} me-1 text-end">{{$item->step}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-left mb-2">
                                <p>{{$item->lowongan_magang->deskripsi}}</p>
                            </div>
                        </a>
                        <div class="text-left">
                            <button type="button" data-id="{{$item->nim}}" data-lowongan="{{$item->lowongan_magang->id_lowongan}}" onclick="ambil($(this))" class="btn btn-success waves-effect me-2" data-bs-toggle="modal">Ambil Tawaran
                            </button>
                            <button type="button" data-id="{{$item->nim}}" data-lowongan="{{$item->lowongan_magang->id_lowongan}}" onclick="tolak($(this))" class="btn btn-danger waves-effect" data-bs-toggle="modal">Tolak Tawaran
                            </button>
                        </div>
                        <hr />
                        <div class="row mt-2">
                            <div class="col-12 d-flex justify-content-between">
                                <div class="col-6">
                                    <span> <i class="ti ti-map-pin" style="font-size: medium;"></i>
                                        {{$item->lowongan_magang->lokasi}}</span>
                                    @if(empty($item->lowongan_magang->nominal_salary))
                                    <span> <i class="ti ti-currency-dollar ms-3" style="font-size: medium;"></i> Tidak Berbayar</span>
                                    @else
                                    <span> <i class="ti ti-currency-dollar ms-3" style="font-size: medium;"></i> Berbayar</span>
                                    @endif
                                    <span> <i class="ti ti-calendar-time ms-3" style="font-size: medium;"></i> {{$item->lowongan_magang->durasimagang}}</span>
                                    <span> <i class="ti ti-users ms-3" style="font-size: medium;"></i> {{$item->lowongan_magang->kuota}}
                                        Kuota Penerimaan</span>
                                </div>
                                <div class="col-6">
                                    <div class="text-end" style="font-size: medium; color : #4EA971">
                                        Lamaran terkirim pada {{($item->tanggaldaftar?->format('d F Y'))}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            <!-- Terima Tawaran -->
            <div class="tab-pane fade show" id="navs-pills-justified-terima" role="tabpanel">
                <div class="alert alert-dark alert-dismissible" role="alert">
                    Anda hanya bisa menerima satu tawaran lowongan magang!
                </div>
                @if($diterima->count() == 0)
                <img src="\assets\images\nothing.svg" alt="no-data" style="display: flex; margin-left: 
                    auto; margin-right: auto; margin-top: 5%; margin-bottom: 5%;  width: 25%;">
                <div class="sec-title mt-5 mb-4 text-center">
                    <h4>Anda belum memiliki Lowongan Magang yang Diterima</h4>
                </div>
                @else
                @foreach($diterima as $item)
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            Anda harus mengkonfirmasi Mulai Magang untuk menerima tawaran!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            Anda akan dinyatakan mengundurkan diri jika melebihi batas konfirmasi penerimaan tanggal {{($item->lowongan_magang->date_confirm_closing?->format('d F Y'))}}!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <a href="{{ url('kegiatan-saya/detail', $item->id_lowongan)}}" style="color:#4B4B4B">
                            <div class="row mb-2">
                                <div class="col-2">
                                    <figure class="image mx-1" style="border-radius: 0%;"><img style="border-radius: 0%; width: 120px;" src="{{$item->img ?? '\assets\images\no-pictures.png'}}" alt="Logo">
                                    </figure>
                                </div>
                                <div class="col-10 d-flex justify-content-between">
                                    <div>
                                        <h5>{{$item->lowongan_magang->intern_position}}</h5>
                                        <p>{{$item->lowongan_magang->industri->namaindustri}}</p>
                                    </div>
                                    <div>
                                        <span class="badge bg-label-{{$item->color}} me-1 text-end">{{$item->step}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-left mb-2">
                                <p>{{$item->lowongan_magang->deskripsi}}</p>
                            </div>
                        </a>
                        <div class="text-left">
                            @if($item->current_step == 'diterima')
                            <button type="button" class="btn btn-success waves-effect me-2" disabled data-bs-toggle="modal" data-bs-target="#modalMulai" data-id="{{ $item->id_pendaftaran }}" data-lowongan="{{$item->lowongan_magang->intern_position}}" data-industri="{{$item->lowongan_magang->industri->namaindustri}}" onclick="mulai($(this))">Mulai Magang
                            </button>
                            @else
                            <button type="button" data-id="{{$item->nim}}" data-lowongan="{{$item->lowongan_magang->id_lowongan}}" onclick="tolak($(this))" class="btn btn-danger waves-effect" data-bs-toggle="modal">Mengundurkan Diri
                            </button>
                            <button type="button" class="btn btn-success waves-effect me-2" data-bs-toggle="modal" data-bs-target="#modalMulai" data-id="{{ $item->id_pendaftaran }}" data-lowongan="{{$item->lowongan_magang->intern_position}}" data-industri="{{$item->lowongan_magang->industri->namaindustri}}" onclick="mulai($(this))">Mulai Magang
                            </button>
                            @endif
                        </div>
                        <hr />
                        <div class="row mt-2">
                            <div class="col-12 d-flex justify-content-between">
                                <div class="col-6">
                                    <span> <i class="ti ti-map-pin" style="font-size: medium;"></i>
                                        {{$item->lowongan_magang->lokasi}}</span>
                                    @if(empty($item->lowongan_magang->nominal_salary))
                                    <span> <i class="ti ti-currency-dollar ms-3" style="font-size: medium;"></i> Tidak Berbayar</span>
                                    @else
                                    <span> <i class="ti ti-currency-dollar ms-3" style="font-size: medium;"></i> Berbayar</span>
                                    @endif
                                    <span> <i class="ti ti-calendar-time ms-3" style="font-size: medium;"></i> {{$item->lowongan_magang->durasimagang}}</span>
                                    <span> <i class="ti ti-users ms-3" style="font-size: medium;"></i> {{$item->lowongan_magang->kuota}}
                                        Kuota Penerimaan</span>
                                </div>
                                <div class="col-6">
                                    <div class="text-end" style="font-size: medium; color : #4EA971">
                                        Lamaran terkirim pada {{($item->tanggaldaftar?->format('d F Y'))}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            <!-- Tolak Tawaran -->
            <div class="tab-pane fade show" id="navs-pills-justified-tolak" role="tabpanel">
                @if($ditolak->count() == 0)
                <img src="\assets\images\nothing.svg" alt="no-data" style="display: flex; margin-left: 
                    auto; margin-right: auto; margin-top: 5%; margin-bottom: 5%;  width: 28%;">
                <div class="sec-title mt-5 mb-4 text-center">
                    <h4>Anda belum memiliki Lowongan Magang pada tahap Penolakan</h4>
                </div>
                @else
                @foreach($ditolak as $item)
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            Anda dapat mengambil tawaran kembali sebelum batas konfirmasi penerimaan tanggal {{($item->lowongan_magang->date_confirm_closing?->format('d F Y'))}}!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <a href="{{ url('kegiatan-saya/detail', $item->id_lowongan)}}" style="color:#4B4B4B">
                            <div class="row mb-2">
                                <div class="col-2">
                                    <figure class="image mx-1" style="border-radius: 0%;"><img style="border-radius: 0%; width: 120px;" src="{{$item->img ?? '\assets\images\no-pictures.png'}}" alt="Logo">
                                    </figure>
                                </div>
                                <div class="col-10 d-flex justify-content-between">
                                    <div>
                                        <h5>{{$item->lowongan_magang->intern_position}}</h5>
                                        <p>{{$item->lowongan_magang->industri->namaindustri}}</p>
                                    </div>
                                    <div>
                                        <span class="badge bg-label-{{$item->color}} me-1 text-end">{{$item->step}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-left mb-2">
                                <p>{{$item->lowongan_magang->deskripsi}}</p>
                            </div>
                        </a>
                        @if($now->lessThan($item->lowongan_magang->date_confirm_closing))
                        <div class="text-left">
                            <button type="button" data-id="{{$item->nim}}" data-lowongan="{{$item->lowongan_magang->id_lowongan}}" onclick="ambil($(this))" class="btn btn-success waves-effect me-2" data-bs-toggle="modal">Ambil Tawaran
                            </button>
                        </div>
                        @endif
                        <hr />
                        <div class="row mt-2">
                            <div class="col-12 d-flex justify-content-between">
                                <div class="col-6">
                                    <span> <i class="ti ti-map-pin" style="font-size: medium;"></i>
                                        {{$item->lowongan_magang->lokasi}}</span>
                                    @if(empty($item->lowongan_magang->nominal_salary))
                                    <span> <i class="ti ti-currency-dollar ms-3" style="font-size: medium;"></i> Tidak Berbayar</span>
                                    @else
                                    <span> <i class="ti ti-currency-dollar ms-3" style="font-size: medium;"></i> Berbayar</span>
                                    @endif
                                    <span> <i class="ti ti-calendar-time ms-3" style="font-size: medium;"></i> {{$item->lowongan_magang->durasimagang}}</span>
                                    <span> <i class="ti ti-users ms-3" style="font-size: medium;"></i> {{$item->lowongan_magang->kuota}}
                                        Kuota Penerimaan</span>
                                </div>
                                <div class="col-6">
                                    <div class="text-end" style="font-size: medium; color : #4EA971">
                                        Lamaran terkirim pada {{($item->tanggaldaftar?->format('d F Y'))}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>

    </div>
</div>
<!-- /Magang Fakultas -->