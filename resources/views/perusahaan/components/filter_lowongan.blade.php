<div class="auto-container" style="background-color: #F8F8F8;background-repeat: no-repeat; background-size: cover; background-image: url({{asset('assets/images/background.png')}});">
    <div class="d-flex justify-content-center mt-5 mb-5 mx-5">
        <div class="col-5">
            <div class="input-group input-group-merge border">
                <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                <input type="text" id="lowongan_magang" class="form-control" placeholder="Lowongan Magang">
            </div>
        </div>
        <div class="col-5 mx-2">
            <div class="input-group input-group-merge bg-white border">
                <span class="input-group-text"><i class="ti ti-calendar-time"></i></span>
                <select name="location" id="location" class="select2 form-select" data-placeholder="Lokasi Magang">
                    <option value disabled selected> Lokasi Magang </option>
                    <option value="Bandung">Bandung</option>
                    <option value="Jakarta">Jakarta</option>
                    <option value="Medan">Medan</option>
                    <option value="Surabaya">Surabaya</option>
                    <option value="Yogyakarta">Yogyakarta</option>
                </select>
            </div>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary" id="search" type="button" style="height: 50px;" onclick="filter()">Cari sekarang</button>
        </div>
    </div>
    <div class="row mt-4 mb-3">
        <div class="col-1 ms-5"></div>
        <div class="col-2">
            <p class="flatpickr-input bg-transparent flatpickr-range">Tanggal Posting <i class=" ti ti-chevron-down" style="font-size: 15px;"></i></p>
        </div>
        <div class="col-2">
            <div class="dropdown cursor-pointer">
                <a class="dropdown-toogle" data-bs-toggle="dropdown" aria-expanded="false">
                    Perusahaan
                    <i class="ti ti-chevron-down pb-1" style="font-size: medium;"></i>
                </a>
                <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1" style="min-width: 230px !important;">
                    @foreach ($perusahaan as $key => $item)
                    <li class="mb-2 px-3">
                        <div class="form-check" style="margin-top: 0px; margin-right:3px">
                            <input class="form-check-input" type="checkbox" value="{{ $item->id_industri }}" id="checkbox-{{ $key }}">
                            <label class="form-check-label" for="checkbox-{{ $key }}"> {{ $item->namaindustri }} </label>
                        </div>
                    </li>
                    @endforeach
                    <hr>
                    <div class=" d-flex justify-content-between ms-2 me-2">
                        <button class="btn btn-outline-danger" type="submit">Reset</button>
                        <button class="btn btn-success" type="submit">Terapkan</button>
                    </div>
                </ul>
            </div>
        </div>
        <div class="col-2">
            <div class="dropdown cursor-pointer">
                <a class="dropdown-toogle" data-bs-toggle="dropdown" aria-expanded="false">
                    Uang Saku
                    <i class="ti ti-chevron-down pb-1" style="font-size: medium;"></i>
                </a>
                <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1" style="min-width: 250px !important;">
                    <div class="form-check mb-2 ms-2">
                        <input name="paymentType" class="form-check-input" type="radio" value="tidakBerbayar" id="tidakBerbayarRadio" onclick="toggleDivVisibility(this)">
                        <label class="form-check-label" for="tidakBerbayarRadio"> Tidak Berbayar </label>
                    </div>

                    <div class="form-check mb-2 ms-2">
                        <input name="paymentType" class="form-check-input" type="radio" value="berbayar" id="berbayarRadio" onclick="toggleDivVisibility(this)">
                        <label class="form-check-label" for="berbayarRadio"> Berbayar </label>
                    </div>

                    <div id="myDIV" style="display: none;">
                        <div class="ms-2 me-3">
                            <div class="input-group border">
                                <span class="input-group-text" id="basic-addon11">IDR</span>
                                <input type="text" class="form-control" placeholder="Masukkan minimal nominal" aria-label="Masukkan minimal nominal" aria-describedby="basic-addon11" style="width: 150px !important;">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class=" d-flex justify-content-between ms-2 me-2">
                        <button class="btn btn-outline-danger" type="submit">Reset</button>
                        <button class="btn btn-success" type="submit">Terapkan</button>
                    </div>
                </ul>
            </div>
        </div>
        <div class="col-2">
            <div class="dropdown cursor-pointer">
                <a class="dropdown-toogle" data-bs-toggle="dropdown" aria-expanded="false">
                    Durasi Magang
                    <!-- <span class="badge badge-center rounded-pill bg-success">2</span> -->
                    <i class="ti ti-chevron-down pb-1" style="font-size: medium;"></i>
                </a>
                <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1" style="min-width: 230px !important;">
                    <li class="mb-2 ps-2 pe-5">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px">Magang 1 Semester
                    </li>

                    <li class="mb-2 ps-2 pe-5">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px">Magang 2 Semester
                    </li>
                    <hr>
                    <div class=" d-flex justify-content-between ms-2 me-2">
                        <button class="btn btn-outline-danger" type="submit">Reset</button>
                        <button class="btn btn-success" type="submit">Terapkan</button>
                    </div>
                </ul>
            </div>
        </div>
        <div class="col-2">
            <div class="dropdown cursor-pointer">
                <a class="dropdown-toogle" data-bs-toggle="dropdown" aria-expanded="false">
                    Pelaksanaan
                    <!-- <span class="badge badge-center rounded-pill bg-success">2</span> -->
                    <i class="ti ti-chevron-down pb-1" style="font-size: medium;"></i>
                </a>
                <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1" style="min-width: 230px !important;">
                    <li class="mb-2 ps-2 pe-5">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px"> Onsite
                    </li>

                    <li class="mb-2 ps-2 pe-5">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px"> Hybrid
                    </li>
                    <li class="mb-2 ps-2 pe-5">
                        <input class="form-check-input" type="checkbox" style="margin-top: 0px; margin-right:3px"> Online
                    </li>
                    <hr>
                    <div class=" d-flex justify-content-between ms-2 me-2">
                        <button class="btn btn-outline-danger" type="submit">Reset</button>
                        <button class="btn btn-success" type="submit">Terapkan</button>
                    </div>
                </ul>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
</div>