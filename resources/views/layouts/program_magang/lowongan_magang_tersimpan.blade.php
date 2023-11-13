@extends('partials_mahasiswa.template')

@section('page_style')
<style>
    .page-item.active .page-link, .pagination li.active > a:not(.page-link) {
                border-color: #FFFFFF !important;
                background-color: #4EA971 !important;
                }

</style>
@endsection

@section('main')
{{-- balum ada lowongan tersimpan --}}
{{-- <div class="col-3 text-left">
    <img class="image" style="border-radius: 0%; margin-left: 400px; justify-content-center" src="{{ asset('front/assets/img/belum_ada_lowongan.png')}}" alt="admin.upload">
</div>
<div class="sec-title mt-5 mb-4" style="text-align:center">
    <p style="text-align: center"><h4><b> Belum Ada Lowongan Tersimpan </b></h4></p>
    <div class="mt-4">
    <a href="javascript:void(0)" class="btn btn-success" type="submit">Cari Lowongan</a>
    </div>
  </div> --}}

    <div class="auto-container">
      <div class="sec-title mt-5 mb-4">
        <h4><b>Lowongan Tersimpan</b></h4>
      </div>
      <form class="d-flex" onsubmit="return false">
        <div class="input-group input-group-merge" style="margin-right: 15px;">
            <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
            <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
          </div>
        <button class="btn btn-success" type="submit" style="width: 160px">Cari sekarang</button>
      </form>
      <div class="row mt-3 mb-2">
        <div class="col-md-6 col-lg-4 mb-3">
          <div class="card" >
            <div class="card-body">
                <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                    <div class="col-3 text-left">
                        <figure class="image" style="border-radius: 0%; margin-left: -15px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                        </figure>
                    </div>
                    <div class="col-7">
                        <h5 class="mb-1" style="text-align: left !important; font-size: 20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Back End Developer</h5>
                        <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                    </div>
                    <div class="col-2">
                        <!-- <img src="{{ asset('front/assets/img/bookmark.svg')}}" onclick="changeImage(this)" /> -->

                        <img src="{{ asset('front/assets/img/bookmark.svg')}}" class="getImage" onclick="imagefun()">
                    </div>
                </div>
                <div class="border"></div>
                <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar"  style="margin-right: 10px"></i>IDR 4.300.000 - 5.500.000</div>
                <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"  style="margin-right: 10px"></i>2 Semester</div>
                <div class="row">
                    <div class="col-6">
                        <div class="location" style="margin-left: 2px;"><i class="fas fa-user-friends" style="margin-right: 10px"></i>2 Semester</div>
                    </div>
                    <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                        <div class="location"> 8 hari lalu <i class="ti ti-clock"></i></div>
                    </div>
                </div>
            </div>
          </div>
        </div>
            <div class="col-md-6 col-lg-4 mb-3">
              <div class="card" >
                <div class="card-body">
                    <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                        <div class="col-3 text-left">
                            <figure class="image" style="border-radius: 0%; margin-left: -15px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                            </figure>
                        </div>
                        <div class="col-7">
                            <h5 class="mb-1" style="text-align: left !important; font-size: 20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Back End Developer</h5>
                            <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                        </div>
                        <div class="col-2">
                            <!-- <img src="{{ asset('front/assets/img/bookmark.svg')}}" onclick="changeImage(this)" /> -->

                            <img src="{{ asset('front/assets/img/bookmark.svg')}}" class="getImage" onclick="imagefun()">
                        </div>
                    </div>
                    <div class="border"></div>
                    <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                      <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar"  style="margin-right: 10px"></i>IDR 4.300.000 - 5.500.000</div>
                      <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"  style="margin-right: 10px"></i>2 Semester</div>
                      <div class="row">
                          <div class="col-6">
                              <div class="location" style="margin-left: 2px;"><i class="fas fa-user-friends" style="margin-right: 10px"></i>2 Semester</div>
                          </div>
                        <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                            <div class="location"> 8 hari lalu <i class="ti ti-clock"></i></div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card" >
                  <div class="card-body">
                      <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                          <div class="col-3 text-left">
                              <figure class="image" style="border-radius: 0%; margin-left: -15px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                              </figure>
                          </div>
                          <div class="col-7">
                              <h5 class="mb-1" style="text-align: left !important; font-size: 20px;-webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Back End Developer</h5>
                              <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                          </div>
                          <div class="col-2">
                              <!-- <img src="{{ asset('front/assets/img/bookmark.svg')}}" onclick="changeImage(this)" /> -->

                              <img src="{{ asset('front/assets/img/bookmark.svg')}}" class="getImage" onclick="imagefun()">
                          </div>
                      </div>
                      <div class="border"></div>
                      <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                      <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar"  style="margin-right: 10px"></i>IDR 4.300.000 - 5.500.000</div>
                      <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"  style="margin-right: 10px"></i>2 Semester</div>
                      <div class="row">
                          <div class="col-6">
                              <div class="location" style="margin-left: 2px;"><i class="fas fa-user-friends" style="margin-right: 10px"></i>2 Semester</div>
                          </div>
                          <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                              <div class="location"> 8 hari lalu <i class="ti ti-clock"></i></div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card" >
                  <div class="card-body">
                      <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                          <div class="col-3 text-left">
                              <figure class="image" style="border-radius: 0%; margin-left: -15px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                              </figure>
                          </div>
                          <div class="col-7">
                              <h5 class="mb-1" style="text-align: left !important; font-size: 20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Back End Developer</h5>
                              <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                          </div>
                          <div class="col-2">
                              <!-- <img src="{{ asset('front/assets/img/bookmark.svg')}}" onclick="changeImage(this)" /> -->

                              <img src="{{ asset('front/assets/img/bookmark.svg')}}" class="getImage" onclick="imagefun()">
                          </div>
                      </div>
                      <div class="border"></div>
                      <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                        <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar"  style="margin-right: 10px"></i>IDR 4.300.000 - 5.500.000</div>
                        <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"  style="margin-right: 10px"></i>2 Semester</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="location" style="margin-left: 2px;"><i class="fas fa-user-friends" style="margin-right: 10px"></i>2 Semester</div>
                            </div>
                          <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                              <div class="location"> 8 hari lalu <i class="ti ti-clock"></i></div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <div class="card" >
                  <div class="card-body">
                      <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                          <div class="col-3 text-left">
                              <figure class="image" style="border-radius: 0%; margin-left: -15px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                              </figure>
                          </div>
                          <div class="col-7">
                              <h5 class="mb-1" style="text-align: left !important; font-size:20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Back End Developer</h5>
                              <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                          </div>
                          <div class="col-2">
                              <!-- <img src="{{ asset('front/assets/img/bookmark.svg')}}" onclick="changeImage(this)" /> -->

                              <img src="{{ asset('front/assets/img/bookmark.svg')}}" class="getImage" onclick="imagefun()">
                          </div>
                      </div>
                      <div class="border"></div>
                      <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                        <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar"  style="margin-right: 10px"></i>IDR 4.300.000 - 5.500.000</div>
                        <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"  style="margin-right: 10px"></i>2 Semester</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="location" style="margin-left: 2px;"><i class="fas fa-user-friends" style="margin-right: 10px"></i>2 Semester</div>
                            </div>
                          <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                              <div class="location"> 8 hari lalu <i class="ti ti-clock"></i></div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <div class="card" >
                  <div class="card-body">
                      <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                          <div class="col-3 text-left">
                              <figure class="image" style="border-radius: 0%; margin-left: -15px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                              </figure>
                          </div>
                          <div class="col-7">
                              <h5 class="mb-1" style="text-align: left !important; font-size:20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Back End Developer</h5>
                              <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                          </div>
                          <div class="col-2">
                              <!-- <img src="{{ asset('front/assets/img/bookmark.svg')}}" onclick="changeImage(this)" /> -->

                              <img src="{{ asset('front/assets/img/bookmark.svg')}}" class="getImage" onclick="imagefun()">
                          </div>
                      </div>
                      <div class="border"></div>
                      <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                        <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar"  style="margin-right: 10px"></i>IDR 4.300.000 - 5.500.000</div>
                        <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"  style="margin-right: 10px"></i>2 Semester</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="location" style="margin-left: 2px;"><i class="fas fa-user-friends" style="margin-right: 10px"></i>2 Semester</div>
                            </div>
                          <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                              <div class="location"> 8 hari lalu <i class="ti ti-clock"></i></div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <div class="card" >
                  <div class="card-body">
                      <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                          <div class="col-3 text-left">
                              <figure class="image" style="border-radius: 0%; margin-left: -15px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                              </figure>
                          </div>
                          <div class="col-7">
                              <h5 class="mb-1" style="text-align: left !important; font-size:20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Back End Developer</h5>
                              <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                          </div>
                          <div class="col-2">
                              <!-- <img src="{{ asset('front/assets/img/bookmark.svg')}}" onclick="changeImage(this)" /> -->

                              <img src="{{ asset('front/assets/img/bookmark.svg')}}" class="getImage" onclick="imagefun()">
                          </div>
                      </div>
                      <div class="border"></div>
                      <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                        <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar"  style="margin-right: 10px"></i>IDR 4.300.000 - 5.500.000</div>
                        <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"  style="margin-right: 10px"></i>2 Semester</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="location" style="margin-left: 2px;"><i class="fas fa-user-friends" style="margin-right: 10px"></i>2 Semester</div>
                            </div>
                          <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                              <div class="location"> 8 hari lalu <i class="ti ti-clock"></i></div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <div class="card" >
                  <div class="card-body">
                      <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                          <div class="col-3 text-left">
                              <figure class="image" style="border-radius: 0%; margin-left: -15px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                              </figure>
                          </div>
                          <div class="col-7">
                              <h5 class="mb-1" style="text-align: left !important; font-size:20px;-webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Back End Developer</h5>
                              <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                          </div>
                          <div class="col-2">
                              <!-- <img src="{{ asset('front/assets/img/bookmark.svg')}}" onclick="changeImage(this)" /> -->

                              <img src="{{ asset('front/assets/img/bookmark.svg')}}" class="getImage" onclick="imagefun()">
                          </div>
                      </div>
                      <div class="border"></div>
                      <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                        <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar"  style="margin-right: 10px"></i>IDR 4.300.000 - 5.500.000</div>
                        <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"  style="margin-right: 10px"></i>2 Semester</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="location" style="margin-left: 2px;"><i class="fas fa-user-friends" style="margin-right: 10px"></i>2 Semester</div>
                            </div>
                          <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                              <div class="location"> 8 hari lalu <i class="ti ti-clock"></i></div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <div class="card" >
                  <div class="card-body">
                      <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                          <div class="col-3 text-left">
                              <figure class="image" style="border-radius: 0%; margin-left: -15px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                              </figure>
                          </div>
                          <div class="col-7">
                              <h5 class="mb-1" style="text-align: left !important; font-size:20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Back End Developer</h5>
                              <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                          </div>
                          <div class="col-2">
                              <!-- <img src="{{ asset('front/assets/img/bookmark.svg')}}" onclick="changeImage(this)" /> -->

                              <img src="{{ asset('front/assets/img/bookmark.svg')}}" class="getImage" onclick="imagefun()">
                          </div>
                      </div>
                      <div class="border"></div>
                      <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                        <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar"  style="margin-right: 10px"></i>IDR 4.300.000 - 5.500.000</div>
                        <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"  style="margin-right: 10px"></i>2 Semester</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="location" style="margin-left: 2px;"><i class="fas fa-user-friends" style="margin-right: 10px"></i>2 Semester</div>
                            </div>
                          <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                              <div class="location"> 8 hari lalu <i class="ti ti-clock"></i></div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <div class="card" >
                  <div class="card-body">
                      <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                          <div class="col-3 text-left">
                              <figure class="image" style="border-radius: 0%; margin-left: -15px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                              </figure>
                          </div>
                          <div class="col-7">
                              <h5 class="mb-1" style="text-align: left !important; font-size:20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Back End Developer</h5>
                              <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                          </div>
                          <div class="col-2">
                              <!-- <img src="{{ asset('front/assets/img/bookmark.svg')}}" onclick="changeImage(this)" /> -->

                              <img src="{{ asset('front/assets/img/bookmark.svg')}}" class="getImage" onclick="imagefun()">
                          </div>
                      </div>
                      <div class="border"></div>
                      <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                        <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar"  style="margin-right: 10px"></i>IDR 4.300.000 - 5.500.000</div>
                        <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"  style="margin-right: 10px"></i>2 Semester</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="location" style="margin-left: 2px;"><i class="fas fa-user-friends" style="margin-right: 10px"></i>2 Semester</div>
                            </div>
                          <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                              <div class="location"> 8 hari lalu <i class="ti ti-clock"></i></div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <div class="card" >
                  <div class="card-body">
                      <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                          <div class="col-3 text-left">
                              <figure class="image" style="border-radius: 0%; margin-left: -15px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                              </figure>
                          </div>
                          <div class="col-7">
                              <h5 class="mb-1" style="text-align: left !important; font-size:20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Back End Developer</h5>
                              <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                          </div>
                          <div class="col-2">
                              <!-- <img src="{{ asset('front/assets/img/bookmark.svg')}}" onclick="changeImage(this)" /> -->

                              <img src="{{ asset('front/assets/img/bookmark.svg')}}" class="getImage" onclick="imagefun()">
                          </div>
                      </div>
                      <div class="border"></div>
                      <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                        <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar"  style="margin-right: 10px"></i>IDR 4.300.000 - 5.500.000</div>
                        <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"  style="margin-right: 10px"></i>2 Semester</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="location" style="margin-left: 2px;"><i class="fas fa-user-friends" style="margin-right: 10px"></i>2 Semester</div>
                            </div>
                          <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                              <div class="location"> 8 hari lalu <i class="ti ti-clock"></i></div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <div class="card" >
                  <div class="card-body">
                      <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                          <div class="col-3 text-left">
                              <figure class="image" style="border-radius: 0%; margin-left: -15px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                              </figure>
                          </div>
                          <div class="col-7">
                              <h5 class="mb-1" style="text-align: left !important; font-size:20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Back End Developer</h5>
                              <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                          </div>
                          <div class="col-2">
                              <!-- <img src="{{ asset('front/assets/img/bookmark.svg')}}" onclick="changeImage(this)" /> -->

                              <img src="{{ asset('front/assets/img/bookmark.svg')}}" class="getImage" onclick="imagefun()">
                          </div>
                      </div>
                      <div class="border"></div>
                      <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                        <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar"  style="margin-right: 10px"></i>IDR 4.300.000 - 5.500.000</div>
                        <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"  style="margin-right: 10px"></i>2 Semester</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="location" style="margin-left: 2px;"><i class="fas fa-user-friends" style="margin-right: 10px"></i>2 Semester</div>
                            </div>
                          <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                              <div class="location"> 8 hari lalu <i class="ti ti-clock"></i></div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <div class="card" >
                  <div class="card-body">
                      <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                          <div class="col-3 text-left">
                              <figure class="image" style="border-radius: 0%; margin-left: -15px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                              </figure>
                          </div>
                          <div class="col-7">
                              <h5 class="mb-1" style="text-align: left !important; font-size:20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Back End Developer</h5>
                              <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                          </div>
                          <div class="col-2">
                              <!-- <img src="{{ asset('front/assets/img/bookmark.svg')}}" onclick="changeImage(this)" /> -->

                              <img src="{{ asset('front/assets/img/bookmark.svg')}}" class="getImage" onclick="imagefun()">
                          </div>
                      </div>
                      <div class="border"></div>
                      <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                        <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar"  style="margin-right: 10px"></i>IDR 4.300.000 - 5.500.000</div>
                        <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"  style="margin-right: 10px"></i>2 Semester</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="location" style="margin-left: 2px;"><i class="fas fa-user-friends" style="margin-right: 10px"></i>2 Semester</div>
                            </div>
                          <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                              <div class="location"> 8 hari lalu <i class="ti ti-clock"></i></div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <div class="card" >
                  <div class="card-body">
                      <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                          <div class="col-3 text-left">
                              <figure class="image" style="border-radius: 0%; margin-left: -15px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                              </figure>
                          </div>
                          <div class="col-7">
                              <h5 class="mb-1" style="text-align: left !important; font-size:20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Back End Developer</h5>
                              <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                          </div>
                          <div class="col-2">
                              <!-- <img src="{{ asset('front/assets/img/bookmark.svg')}}" onclick="changeImage(this)" /> -->

                              <img src="{{ asset('front/assets/img/bookmark.svg')}}" class="getImage" onclick="imagefun()">
                          </div>
                      </div>
                      <div class="border"></div>
                      <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                        <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar"  style="margin-right: 10px"></i>IDR 4.300.000 - 5.500.000</div>
                        <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"  style="margin-right: 10px"></i>2 Semester</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="location" style="margin-left: 2px;"><i class="fas fa-user-friends" style="margin-right: 10px"></i>2 Semester</div>
                            </div>
                            <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                                <div class="location" style=""> 8 hari lalu <i class="ti ti-clock"></i></div>
                            </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-3">
                <div class="card" >
                  <div class="card-body">
                      <div class="row card-header" style="background-color: #FFFFFF; padding:0px;">
                          <div class="col-3 text-left">
                              <figure class="image" style="border-radius: 0%; margin-left: -15px;"><img style="border-radius: 0%;" src="{{ asset('front/assets/img/icon_lowongan.png')}}" alt="admin.upload">
                              </figure>
                          </div>
                          <div class="col-7">
                              <h5 class="mb-1" style="text-align: left !important; font-size:20px; -webkit-line-clamp: 2;text-overflow: ellipsis; overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; word-break: break-word;">Back End Developer</h5>
                              <p style="text-align: left !important; font-size:15px; margin-bottom: 0px;">PT Wings Surya</p>
                          </div>
                          <div class="col-2">
                              <!-- <img src="{{ asset('front/assets/img/bookmark.svg')}}" onclick="changeImage(this)" /> -->

                              <img src="{{ asset('front/assets/img/bookmark.svg')}}" class="getImage" onclick="imagefun()">
                          </div>
                      </div>
                      <div class="border"></div>
                      <div class="map-pin mt-3 mb-3"><i class="ti ti-map-pin" style="margin-right: 10px"></i>Jakarta Selatan, Indonesis</div>
                        <div class="currency-dollar mb-3" style="margin-left: -1px; margin-right: 10px"><i class="ti ti-currency-dollar"  style="margin-right: 10px"></i>IDR 4.300.000 - 5.500.000</div>
                        <div class="briefcase mb-3" style="margin-left: 1px;"><i class="ti ti-briefcase"  style="margin-right: 10px"></i>2 Semester</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="location" style="margin-left: 2px;"><i class="fas fa-user-friends" style="margin-right: 10px"></i>2 Semester</div>
                            </div>
                          <div class="col-6 d-flex justify-content-end" style="padding: 0px; margin-left: -10px;">
                              <div class="location"> 8 hari lalu <i class="ti ti-clock"></i></div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
      </div>
       <!-- Basic Pagination -->
       <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end">
          <li class="page-item prev">
            <a class="page-link" href="javascript:void(0);">Previous</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">1</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">2</a>
          </li>
          <li class="page-item active">
            <a class="page-link" href="javascript:void(0);">3</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="javascript:void(0);">Next</a>
          </li>
        </ul>
      </nav>
      {{-- <i class="ti ti-chevron-left ti-xs"></i> --}}
      <!--/ Basic Pagination -->


@endsection

@section('page_script')
@endsection

