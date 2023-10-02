@extends('layouts.front_layout')
<!-- Banner Section-->
@section('content-main')
<title>Find Jobs</title>
<span class="header-span"></span>

<!--Page Title-->
<section class="page-title style-three" style="background-image: url({{asset('assets/images/background/bgEllipse.png')}});">
    <div class="auto-container">
      
        <div class="" >
            {{-- <form method="post" action="{{url('/search')}}">
                
                <div class="row">
                    <!-- Form Group -->
                    <div class="form-group col-lg-4 col-md-12 col-sm-12">
                        <span class="icon flaticon-search-1"></span>
                        <input type="text" name="field_name" placeholder="Job title, keywords, or company">
                    </div>
                    
                    <!-- Form Group -->
                    <div class="form-group col-lg-3 col-md-12 col-sm-12 location">
                        <span class="icon flaticon-map-locator"></span>
                        <input type="text" name="field_name" placeholder="City or postcode">
                    </div>

                    <!-- Form Group -->
                    <div class="form-group col-lg-3 col-md-12 col-sm-12 location">
                        <span class="icon flaticon-briefcase"></span>
                        <select class="chosen-select">
                            <option value="">All Categories</option>
                            <option value="44">Accounting / Finance</option>
                            <option value="106">Automotive Jobs</option>
                            <option value="46">Customer</option>
                            <option value="48">Design</option>
                            <option value="47">Development</option>
                            <option value="45">Health and Care</option>
                            <option value="105">Marketing</option>
                            <option value="107">Project Management</option>
                        </select>
                    </div>

                    <!-- Form Group -->
                    <div class="form-group col-lg-2 col-md-12 col-sm-12 text-right">
                        <button type="submit" class="theme-btn btn-style-one">Find Jobs</button>
                    </div>
                </div>
            </form> --}}
            <form>
                
                <div class="row">
                    <!-- Form Group -->
                    <div class="form m-3">
                        <div class="job-search-form" data-wow-delay="1000ms" style="border-radius: 10px; border: 2px solid #D3D6DB; background: var(--neutral-color-white-color, #FFF); height: auto; width: 480px;">
                            <div class="form-group col-md-12 col-sm-12">
                                <span class="icon flaticon-search-1"></span>
                                <input type="text" class="form-control autocomplete" name="job" autocomplete="off" placeholder="Search jobs" data-url="{{url('/fetch-jobs')}}"  value="{{request()->job}}">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form Group -->
                    <div class="form m-3">
                        <div class="job-search-form" data-wow-delay="1000ms" style="border-radius: 10px; border: 2px solid #D3D6DB; background: var(--neutral-color-white-color, #FFF); height: auto; width: 480px;">
                            <div class="form-group col-md-12 col-sm-12 location">
                                <span class="icon flaticon-map-locator"></span>
                                <input type="text" class="form-control autocomplete" name="loc" autocomplete="off" placeholder="Search locations" data-url="{{url('/fetch-locations')}}"  value="{{request()->loc}}">
                            </div>
                        </div>
                    </div>
                    <!-- Form Group -->
                    <div class="form m-3">
                        <div class="form-group col-lg-2 col-md-12 col-sm-12 text-right m-1">
                            <button  class="btn-success btn-style-two">Find Jobs</button>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
<div class="row">
   
    <div class="dropdown-find">
        <button class="btn dropdown-toggle dropdown-toggle-find" type="button" data-toggle="dropdown">
        Tanggal Unggah
        </button>
        <ul class="dropdown-menu" style="height: 120px;" >
                <li><a class="dropdown-item" href="#">7 Hari Lalu</a></li>
                <li><a class="dropdown-item" href="#">30 Hari Lalu</a></li>
                <li><a class="dropdown-item" href="#">365 Hari Lalu</a></li>
        </ul>
    </div>
    <div class="dropdown-find">
        <button class="btn dropdown-toggle dropdown-toggle-find" type="button" data-toggle="dropdown">
        Perusahaan
        </button>
        <ul class="dropdown-menu"style="height: 180px ;">
                <div class="dropdown-item" style="width: 95%; border-radius: 6px 6px 6px 6px;border: 1px solid var(--primary-500-base, #4EA971);background: var(--light-solid-color-extra-card-background, #FFF); margin: 5px">
                    <input class="input" type="text" value="" id="flexCheckDefault" placeholder="Input Perusahan" autocomplete="off">
                    <!-- <input type="text" class="form-control autocomplete" name="loc" autocomplete="off" placeholder="Search locations"> -->
                </div>
                <div class="form-check dropdown-item" style="width: 95%; border-radius: 6px 6px 6px 6px;border: 1px solid var(--primary-500-base, #4EA971);background: var(--light-solid-color-extra-card-background, #FFF); margin: 5px">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    PT ABC
                    </label>
                </div>
                <div class="form-check dropdown-item" style="width: 95%; border-radius: 6px 6px 6px 6px;border: 1px solid var(--primary-500-base, #4EA971);background: var(--light-solid-color-extra-card-background, #FFF); margin: 5px">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        PT DEF
                    </label>
                </div>
                <div class="form-check dropdown-item" style="width: 95%; border-radius: 6px 6px 6px 6px;border: 1px solid var(--primary-500-base, #4EA971);background: var(--light-solid-color-extra-card-background, #FFF); margin: 5px">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    PT GHI
                    </label>
                </div>
                <div class="form-check dropdown-item" style="width: 95%; border-radius: 6px 6px 6px 6px;border: 1px solid var(--primary-500-base, #4EA971);background: var(--light-solid-color-extra-card-background, #FFF); margin: 5px">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        PT JKL
                    </label>
                </div>  
               
        </ul>
    </div>
    <div class="dropdown-find">
        <button class="btn dropdown-toggle dropdown-toggle-find" type="button" data-toggle="dropdown">
        Gaji
        </button>
        <ul class="dropdown-menu">
            <div class="text-center dropdown-item-find">
                <li><a class="">Silahkan Masukkan rentang Gaji Perbulan Pada Posisi Yang Anda Inginkan</a></li>
            </div>
            <div class="btn-dropdown-gaji">
                <button type="button" class="" disabled>Rp. 0</button>
            </div>
            <div class="btn-right-dropdown-gaji">
                <button type="button" class="" disabled>Rp. 100 juta</button>
            </div>
            <div>
                <li><a><label for="customRange3" class="form-label"></label>
                    <input type="range" class="form-range-find" min="0" max="5" step="0.5" id="customRange3">
                </label></a></li> 
            </div>
            <div class="btn btn-outline-warning" style="padding">
                <button type="button" class="" disabled>Terapkan</button>
            </div>   
        </ul>
    </div>
    <div class="dropdown-find">
        <button class="btn dropdown-toggle dropdown-toggle-find" type="button" data-toggle="dropdown">
        Tingkat Pengalaman
        </button>
        <ul class="dropdown-menu"style="height: 160px ;">
                <div class="form-check dropdown-item" style="width: 95%; border-radius: 6px 6px 6px 6px;border: 1px solid var(--primary-500-base, #4EA971);background: var(--light-solid-color-extra-card-background, #FFF); margin: 5px">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    Beginner
                    </label>
                </div>
                <div class="form-check dropdown-item" style="width: 95%; border-radius: 6px 6px 6px 6px;border: 1px solid var(--primary-500-base, #4EA971);background: var(--light-solid-color-extra-card-background, #FFF); margin: 5px">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    Intermediate
                    </label>
                </div>
                <div class="form-check dropdown-item" style="width: 95%; border-radius: 6px 6px 6px 6px;border: 1px solid var(--primary-500-base, #4EA971);background: var(--light-solid-color-extra-card-background, #FFF); margin: 5px">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    Advanced
                    </label>
                </div>               
        </ul>
    </div>
    <div class="dropdown-find">
        <button class="btn dropdown-toggle dropdown-toggle-find" type="button" data-toggle="dropdown">
        Tipe Pekerjaan
        </button>
        <ul class="dropdown-menu"style="height: 180px ;">
                <div class="form-check dropdown-item" style="width: 95%; border-radius: 6px 6px 6px 6px;border: 1px solid var(--primary-500-base, #4EA971);background: var(--light-solid-color-extra-card-background, #FFF); margin: 5px">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Magang
                    </label>
                </div>
                <div class="form-check dropdown-item" style="width: 95%; border-radius: 6px 6px 6px 6px;border: 1px solid var(--primary-500-base, #4EA971);background: var(--light-solid-color-extra-card-background, #FFF); margin: 5px">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    Penuh Waktu
                    </label>
                </div>
                <div class="form-check dropdown-item" style="width: 95%; border-radius: 6px 6px 6px 6px;border: 1px solid var(--primary-500-base, #4EA971);background: var(--light-solid-color-extra-card-background, #FFF); margin: 5px">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    Paruh Waktu
                    </label>
                </div>
                <div class="form-check dropdown-item" style="width: 95%; border-radius: 6px 6px 6px 6px;border: 1px solid var(--primary-500-base, #4EA971);background: var(--light-solid-color-extra-card-background, #FFF); margin: 5px">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    Kontrak
                    </label>
                </div>  
               
        </ul>
    </div>
    
</div>
</section>

<section class="ls-section">
    <div class="auto-container">
        <div class="showing-result">
            <div class="text">300+ <strong></strong> Lowongan <strong></strong> Terserdia</div>
            <div class="company-block" >
                <div class="inner-box" style="text-align: left; border-radius: 4px; width: 561px; height: 299px; flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt="admin.upload"></figure>
                        <h4>Uniqlo Co., Ltd</h4>
                        
                        <div class="location">PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.</div>
                        <div class="button-container" >
                        <a class="btn btn-outline-success ">Lihat Perusahaan</a>           
                        </div>
                    </div>
                </div>
            </div>
            <div class="company-block" >
                <div class="inner-box" style="text-align: left; border-radius: 4px; width: 561px; height: 299px; flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt="admin.upload"></figure>
                        <h4>Uniqlo Co., Ltd</h4>
                        
                        <div class="location">PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.</div>
                        <div class="button-container" >
                        <a class="btn btn-outline-success ">Lihat Perusahaan</a>           
                        </div>
                    </div>
                </div>
            </div>
            <div class="company-block" >
                <div class="inner-box" style="text-align: left; border-radius: 10px; width: 561px; height: 299px; flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt="admin.upload"></figure>
                        <h4>Uniqlo Co., Ltd</h4>
                        
                        <div class="location">PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.</div>
                        <div class="button-container" >
                        <a class="btn btn-outline-success ">Lihat Perusahaan</a>           
                        </div>
                    </div>
                </div>
            </div>
            <div class="company-block" >
                <div class="inner-box" style="text-align: left; border-radius: 4px; width: 561px; height: 299px; flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt="admin.upload"></figure>
                        <h4>Uniqlo Co., Ltd</h4>
                        
                        <div class="location">PT Fast Retailing Indonesia South Quarter Tower C, 17th Floor, Jl. R.A. Kartini Kav. 8 Cilandak, Jakarta Selatan, 12430.</div>
                        <div class="button-container" >
                        <a class="btn btn-outline-success ">Lihat Perusahaan</a>           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Listing Section -->
<!-- <section class="ls-section">
    <div class="auto-container">
        <div class="filters-backdrop"></div>
        
        <div class="row">   
            
            <div class="content-column col-lg-12 col-md-12 col-sm-12">
                
                <div class="ls-switcher">
                    <div class="showing-result">
                        <div class="text">300+ <strong></strong> Lowongan <strong></strong> Terserdia</div>
                    </div>
                <div class="sort-by">
                    <select class="chosen-select">
                                    
                        <option>New Jobs</option>
                        <option>Freelance</option>
                        <option>Full Time</option>
                        <option>Internship</option>
                        <option>Part Time</option>
                        <option>Temporary</option>
                    </select>
                    <select class="chosen-select" id="select_row" >
                    </select>
                </div>
            </div>
        </div>
        </div>
    </div>
</section> -->
<!--End Listing Page Section -->

<input type="hidden" id="request_url" value="{{json_encode(request()->all())}}">
@endsection