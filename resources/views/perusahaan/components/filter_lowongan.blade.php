<div class="auto-container" style="background-color: #F8F8F8;background-repeat: no-repeat; background-size: cover; background-image: url({{asset('assets/images/background.png')}});">
    <div class="d-flex justify-content-center mt-5 mb-5 mx-5">
        <div class="col-4 me-2">
            <div class="input-group input-group-merge border">
                <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                <input type="text" id="lowongan_magang" class="form-control" placeholder="Lowongan Magang">
            </div>
        </div>
        <div class="col-3 mx-2">
            <div class="input-group input-group-merge bg-white border">
                <span class="input-group-text"><i class="ti ti-map-pin"></i></span>
                <select name="location" id="location" class="select2 form-select" data-placeholder="Lokasi Magang" data-allow-clear="true">
                    <option value disabled selected> Lokasi Magang </option>
                    @foreach($kota as $item)
                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-3 mx-2">
            <div class="input-group input-group-merge bg-white border">
                <span class="input-group-text"><i class="ti ti-calendar-time"></i></span>
                <select name="jenis_magang" id="jenis_magang" class="select2 form-select" data-placeholder="Jenis Magang" data-allow-clear="true">
                    <option value disabled selected> Jenis Magang </option>
                    @foreach($jenisMagang as $item)
                        <option value="{{ $item->id_jenismagang }}">{{ $item->namajenis }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary h-100" id="search" type="button" onclick="filter();">Cari sekarang</button>
        </div>
    </div>
    <div class="row mt-4 mb-3">
        <div class="col-1 ms-5"></div>
        <div class="col-2">
            <p class="flatpickr-input bg-transparent" id="picker_range">Tanggal Posting <i class=" ti ti-chevron-down" style="font-size: 15px;"></i></p>
        </div>
        <div class="col-2">
            <div class="dropdown">
                <a class="dropdown-toogle cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false">
                    Perusahaan
                    <i class="ti ti-chevron-down pb-1" style="font-size: medium;"></i>
                </a>
                <ul class="dropdown-menu form-filter pt-3" aria-labelledby="dropdownMenu1" style="min-width: 230px !important;">
                    @foreach ($perusahaan as $key => $item)
                    <li class="mb-2 px-3">
                        <div class="form-check" style="margin-top: 0px; margin-right:3px">
                            <input class="form-check-input" name="perusahaan[]" type="checkbox" value="{{ $item->id_industri }}" id="checkbox-{{ $key }}">
                            <label class="form-check-label" for="checkbox-{{ $key }}"> {{ $item->namaindustri }} </label>
                        </div>
                    </li>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between ms-2 me-2">
                        <button class="btn btn-sm btn-outline-danger" type="reset">Reset</button>
                        <button class="btn btn-sm btn-success" type="button">Terapkan</button>
                    </div>
                </ul>
            </div>
        </div>
        <div class="col-2">
            <div class="dropdown">
                <a class="dropdown-toogle cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false">
                    Uang Saku
                    <i class="ti ti-chevron-down pb-1" style="font-size: medium;"></i>
                </a>
                <ul class="dropdown-menu form-filter pt-3" aria-labelledby="dropdownMenu1" style="min-width: 250px !important;">
                    <div class="form-check mb-2 ms-2">
                        <input name="paymentType" class="form-check-input" type="radio" value="tidakBerbayar" id="tidakBerbayarRadio">
                        <label class="form-check-label" for="tidakBerbayarRadio"> Tidak Berbayar </label>
                    </div>
                    <div class="form-check mb-2 ms-2">
                        <input name="paymentType" class="form-check-input" type="radio" value="berbayar" id="berbayarRadio">
                        <label class="form-check-label" for="berbayarRadio"> Berbayar </label>
                    </div>
                    <div class="mx-2" id="container-nominal-minimal" style="display: none;">
                        <div class="input-group border">
                            <span class="input-group-text" id="basic-addon11">IDR</span>
                            <input type="text" name="nominal_minimal" class="form-control ps-0" placeholder="Minimal nominal">
                        </div>
                    </div>
                    <hr>
                    <div class=" d-flex justify-content-between ms-2 me-2">
                        <button class="btn btn-sm btn-outline-danger" type="reset">Reset</button>
                        <button class="btn btn-sm btn-success" type="button">Terapkan</button>
                    </div>
                </ul>
            </div>
        </div>
        <div class="col-2">
            <div class="dropdown">
                <a class="dropdown-toogle cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false">
                    Durasi Magang
                    <i class="ti ti-chevron-down pb-1" style="font-size: medium;"></i>
                </a>
                <ul class="dropdown-menu form-filter pt-3" aria-labelledby="dropdownMenu1" style="min-width: 230px !important;">
                    <li class="mb-2 px-3">
                        <div class="form-check" style="margin-top: 0px; margin-right:3px">
                            <input class="form-check-input" name="type_magang[]" type="checkbox" value="1 Semester" id="checkbox-1-semester">
                            <label class="form-check-label" for="checkbox-1-semester"> Magang 1 Semester </label>
                        </div>
                    </li>
                    <li class="mb-2 px-3">
                        <div class="form-check" style="margin-top: 0px; margin-right:3px">
                            <input class="form-check-input" name="type_magang[]" type="checkbox" value="2 Semester" id="checkbox-2-semester">
                            <label class="form-check-label" for="checkbox-2-semester"> Magang 2 Semester </label>
                        </div>
                    </li>
                    <hr>
                    <div class=" d-flex justify-content-between ms-2 me-2">
                        <button class="btn btn-sm btn-outline-danger" type="reset">Reset</button>
                        <button class="btn btn-sm btn-success" type="button">Terapkan</button>
                    </div>
                </ul>
            </div>
        </div>
        <div class="col-2">
            <div class="dropdown">
                <a class="dropdown-toogle cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false">
                    Pelaksanaan
                    <i class="ti ti-chevron-down pb-1" style="font-size: medium;"></i>
                </a>
                <ul class="dropdown-menu form-filter pt-3" aria-labelledby="dropdownMenu1" style="min-width: 230px !important;">
                    <li class="mb-2 px-3">
                        <div class="form-check" style="margin-top: 0px; margin-right:3px">
                            <input class="form-check-input" name="pelaksanaan[]" type="checkbox" value="Onsite" id="checkbox-onsite">
                            <label class="form-check-label" for="checkbox-onsite"> Onsite  </label>
                        </div>
                    </li>
                    <li class="mb-2 px-3">
                        <div class="form-check" style="margin-top: 0px; margin-right:3px">
                            <input class="form-check-input" name="pelaksanaan[]" type="checkbox" value="Hybrid" id="checkbox-hybrid">
                            <label class="form-check-label" for="checkbox-hybrid"> Hybrid  </label>
                        </div>
                    </li>
                    <li class="mb-2 px-3">
                        <div class="form-check" style="margin-top: 0px; margin-right:3px">
                            <input class="form-check-input" name="pelaksanaan[]" type="checkbox" value="Online" id="checkbox-online">
                            <label class="form-check-label" for="checkbox-online"> Online  </label>
                        </div>
                    </li>
                    <hr>
                    <div class=" d-flex justify-content-between ms-2 me-2">
                        <button class="btn btn-sm btn-outline-danger" type="reset">Reset</button>
                        <button class="btn btn-sm btn-success" type="button">Terapkan</button>
                    </div>
                </ul>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
</div>