@extends('layouts.front_layout')

<!-- Banner Section-->
@section('content-main')
{{--<title>{{$companyName}}</title>--}}
{{--<span class="header-span"></span>--}}

<section class="banner-section-four" style="background-image: url({{asset('assets/images/background/bgEllipse.svg')}}); ">
    <div class="auto-container">
        <div class="cotnent-box">
            <div class="title-box wow fadeInUp" data-wow-delay="500ms">
                <h3 style="color: var(--primary-500-base, var(--primary-500-base, #4EA971));">Selangkah Lebih Dekat
                    Dengan <br>Pekerjaan Impianmu<h3>
                        <h4>Temukan dan wujudkan semua karir impianmu hanya dengan satu klik <br>bersama Talentern</h4>
            </div>
            @yield('header-text')
            <!-- Job Search Form -->
            <div class="job-search-form " data-wow-delay="1000ms" style="border-radius: 10px; border: 2px solid var(--primary-500-base, #4EA971); background: #FFF; height: auto; width: auto;">
                <form method="post" action="job-list-v10.html">
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
                        <div class="form-group col-lg-3 col-md-12 col-sm-12 category">
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
                            <button type="submit" class="btn-success btn-style-two">Find Jobs</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div id="diseluruh" class="card" style="max-width: 17rem; height: auto;">
                    <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="49" height="48" viewBox="0 0 49 48" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 1.5H47V46.5H2V1.5Z" stroke="white" stroke-opacity="0.2" stroke-width="2.8125"/>
                        <circle cx="24.5" cy="24" r="16.875" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.74902 18.375H40.249" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.74902 18.375H40.249" stroke="white" stroke-opacity="0.2" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.74902 29.625H40.249" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.74902 29.625H40.249" stroke="white" stroke-opacity="0.2" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M23.5619 7.125C17.1174 17.4521 17.1174 30.5479 23.5619 40.875" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M23.5619 7.125C17.1174 17.4521 17.1174 30.5479 23.5619 40.875" stroke="white" stroke-opacity="0.2" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M25.4375 7.125C31.882 17.4521 31.882 30.5479 25.4375 40.875" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg></span>
                    <h5 class="card-title m-2">Diseluruh Indonesia</h5>
                    <p class="card-text m-2">Lorem Ipsum</p>
                    
                    
                </div>
                <div id="kemudahan" class="card" style="max-width: 17rem; height: auto;">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="49" height="48" viewBox="0 0 49 48" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2 1.5H47V46.5H2V1.5Z" stroke="white" stroke-opacity="0.2" stroke-width="2.8125"/>
                                <path d="M28.25 7.125V14.625C28.25 15.6605 29.0895 16.5 30.125 16.5H37.625" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M28.25 7.125V14.625C28.25 15.6605 29.0895 16.5 30.125 16.5H37.625" stroke="white" stroke-opacity="0.2" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M33.875 40.875H15.125C13.0539 40.875 11.375 39.1961 11.375 37.125V10.875C11.375 8.80393 13.0539 7.125 15.125 7.125H28.25L37.625 16.5V37.125C37.625 39.1961 35.9461 40.875 33.875 40.875Z" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M33.875 40.875H15.125C13.0539 40.875 11.375 39.1961 11.375 37.125V10.875C11.375 8.80393 13.0539 7.125 15.125 7.125H28.25L37.625 16.5V37.125C37.625 39.1961 35.9461 40.875 33.875 40.875Z" stroke="white" stroke-opacity="0.2" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M24.5 22.125V33.375" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M24.5 22.125V33.375" stroke="white" stroke-opacity="0.2" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18.875 27.75L24.5 22.125L30.125 27.75" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg></span>    
               
                    <h5 class="card-title m-2">Kemudahan Melamar</h5> 
                    <p class="card-text m-2">Lorem Ipsum</p>
                
                </div>
                <div id="Blowongan" class="card" style="max-width: 17rem; height: auto;">
                <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="49" height="48" viewBox="0 0 49 48" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 1.5H47V46.5H2V1.5Z" stroke="white" stroke-opacity="0.2" stroke-width="2.8125"/>
                    <rect x="7.625" y="14.625" width="33.75" height="24.375" rx="3.75" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17 14.625V10.875C17 8.80393 18.6789 7.125 20.75 7.125H28.25C30.3211 7.125 32 8.80393 32 10.875V14.625" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17 14.625V10.875C17 8.80393 18.6789 7.125 20.75 7.125H28.25C30.3211 7.125 32 8.80393 32 10.875V14.625" stroke="white" stroke-opacity="0.2" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M24.5 24V24.0188" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M24.5 24V24.0188" stroke="white" stroke-opacity="0.2" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.625 25.875C18.2393 31.2236 30.7607 31.2236 41.375 25.875" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.625 25.875C18.2393 31.2236 30.7607 31.2236 41.375 25.875" stroke="white" stroke-opacity="0.2" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                    
                        <h5 class="card-title m-2">1000+ Lowongan</h5>
                        <p class="card-text m-2">Tersedia 1000+ lowongan pekerjaan di Talentern</p>
                        
                    
                </div>
                <div id="Bperusahaan" class="card" style="max-width: 17rem; height: auto;">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="49" height="48" viewBox="0 0 49 48" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 1.5H47V46.5H2V1.5Z" stroke="white" stroke-opacity="0.2" stroke-width="2.8125"/>
                    <path d="M7.625 40.875H41.375" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.625 40.875H41.375" stroke="white" stroke-opacity="0.2" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.375 40.875V14.625L26.375 7.125V40.875" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.375 40.875V14.625L26.375 7.125V40.875" stroke="white" stroke-opacity="0.2" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M37.625 40.875V22.125L26.375 14.625" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M37.625 40.875V22.125L26.375 14.625" stroke="white" stroke-opacity="0.2" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18.875 18.375V18.3938" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18.875 24V24.0188" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18.875 29.625V29.6438" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18.875 35.25V35.2688" stroke="#4EA971" stroke-width="2.8125" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                        <h5 class="card-title m-2">300+ Perusahaan</h5>
                        <p class="card-text m-2">Lebih dari 300 perusahaan terdaftar di Talentern</p>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
</section>
<!-- End Banner Section-->
<main class="main-content">

    @yield('content')
 
<section class="top-companies " style="background: #FFFFFF;">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h2>Lowongan Untuk Kamu</h2>
            <div class="text">Temukan berbagai lowongan kerja yang kamu inginkan</div>
            <div class="btn" style="border-radius: 10px; border: 2px solid var(--semantic-color-success-900, #28C76F); background: #FFF;">
                <button id="btnTerbaru" class="btn btn-success me-2 ml-2" type="button">Lowongan Terbaru</button>
                <button id="btnPopuler" class="btn btn-outline-success me-2 ml-2" type="button">Lowongan Populer</button>
            </div>
        </div>

        <div class="carousel-outer wow fadeInUp">

        <div class="row">

            <!-- Company-Block  -->
            <div class="company-block">
                <div class="inner-box" style="display: flex; width: 343px; height: 427px; padding: 40px 28px 41px 28px; flex-direction: column; justify-content: center; align-items: center; flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt="admin.upload"></figure>
                        <h4 class="name">company_name</h4>
                        
                        <div class="location"><i class="flaticon-map-locator"></i>company_addres</div>
                        <div class="button-container" >
                            <a  class="btn btn-success text-white" style="margin-left : 20px; border-radius: 8px;">Lamar</a>
                            <a  class="btn btn-outline-success" style="margin-left: 20px; border-radius: 8px;">Detail</a>
                            
                        </div>
                    </div>
                </div>
                    
            </div>
            <!-- Company-Block  -->
            <div class="company-block">
                <div class="inner-box" style="display: flex; width: 343px; height: 427px; padding: 40px 28px 41px 28px; flex-direction: column; justify-content: center; align-items: center; flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt="admin.upload"></figure>
                        <h4 class="name">company_name</h4>
                        
                        <div class="location"><i class="flaticon-map-locator"></i>company_addres</div>
                        <div class="button-container" >
                            <a  class="btn btn-success text-white" style="margin-left : 20px; border-radius: 8px;">Lamar</a>
                            <a  class="btn btn-outline-success" style="margin-left: 20px; border-radius: 8px;">Detail</a>
                            
                        </div>
                    </div>
                </div>
                    
            </div>
            <!-- Company-Block  -->
            <div class="company-block">
                <div class="inner-box" style="display: flex; width: 343px; height: 427px; padding: 40px 28px 41px 28px; flex-direction: column; justify-content: center; align-items: center; flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt="admin.upload"></figure>
                        <h4 class="name">company_name</h4>
                        
                        <div class="location"><i class="flaticon-map-locator"></i>company_addres</div>
                        <div class="button-container" >
                            <a  class="btn btn-success text-white" style="margin-left : 20px; border-radius: 8px;">Lamar</a>
                            <a  class="btn btn-outline-success" style="margin-left: 20px; border-radius: 8px;">Detail</a>
                            
                        </div>
                    </div>
                </div>
                    
            </div>
            <!-- Company-Block  -->
            <div class="company-block">
                <div class="inner-box" style="display: flex; width: 343px; height: 427px; padding: 40px 28px 41px 28px; flex-direction: column; justify-content: center; align-items: center; flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt="admin.upload"></figure>
                        <h4 class="name">company_name</h4>
                        
                        <div class="location"><i class="flaticon-map-locator"></i>company_addres</div>
                        <div class="button-container" >
                            <a  class="btn btn-success text-white" style="margin-left : 20px; border-radius: 8px;">Lamar</a>
                            <a  class="btn btn-outline-success" style="margin-left: 20px; border-radius: 8px;">Detail</a>
                            
                        </div>
                    </div>
                </div>
                    
            </div>
            <!-- Company-Block  -->
            <div class="company-block">
                <div class="inner-box" style="display: flex; width: 343px; height: 427px; padding: 40px 28px 41px 28px; flex-direction: column; justify-content: center; align-items: center; flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt="admin.upload"></figure>
                        <h4 class="name">company_name</h4>
                        
                        <div class="location"><i class="flaticon-map-locator"></i>company_addres</div>
                        <div class="button-container" >
                            <a  class="btn btn-success text-white" style="margin-left : 20px; border-radius: 8px;">Lamar</a>
                            <a  class="btn btn-outline-success" style="margin-left: 20px; border-radius: 8px;">Detail</a>
                            
                        </div>
                    </div>
                </div>
                    
            </div>
            <!-- Company-Block  -->
            <div class="company-block">
                <div class="inner-box" style="display: flex; width: 343px; height: 427px; padding: 40px 28px 41px 28px; flex-direction: column; justify-content: center; align-items: center; flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt="admin.upload"></figure>
                        <h4 class="name">company_name</h4>
                        
                        <div class="location"><i class="flaticon-map-locator"></i>company_addres</div>
                        <div class="button-container" >
                            <a  class="btn btn-success text-white" style="margin-left : 20px; border-radius: 8px;">Lamar</a>
                            <a  class="btn btn-outline-success" style="margin-left: 20px; border-radius: 8px;">Detail</a>
                            
                        </div>
                    </div>
                </div>
                    
            </div>
            <!-- Company-Block  -->
            <div class="company-block">
                <div class="inner-box" style="display: flex; width: 343px; height: 427px; padding: 40px 28px 41px 28px; flex-direction: column; justify-content: center; align-items: center; flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt="admin.upload"></figure>
                        <h4 class="name">company_name</h4>
                        
                        <div class="location"><i class="flaticon-map-locator"></i>company_addres</div>
                        <div class="button-container" >
                            <a  class="btn btn-success text-white" style="margin-left : 20px; border-radius: 8px;">Lamar</a>
                            <a  class="btn btn-outline-success" style="margin-left: 20px; border-radius: 8px;">Detail</a>
                            
                        </div>
                    </div>
                </div>
                    
            </div>
            <!-- Company-Block  -->
            <div class="company-block">
                <div class="inner-box" style="display: flex; width: 343px; height: 427px; padding: 40px 28px 41px 28px; flex-direction: column; justify-content: center; align-items: center; flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt="admin.upload"></figure>
                        <h4 class="name">company_name</h4>
                        
                        <div class="location"><i class="flaticon-map-locator"></i>company_addres</div>
                        <div class="button-container" >
                            <a  class="btn btn-success text-white" style="margin-left : 20px; border-radius: 8px;">Lamar</a>
                            <a  class="btn btn-outline-success" style="margin-left: 20px; border-radius: 8px;">Detail</a>
                            
                        </div>
                    </div>
                </div>
                    
            </div>
            <!-- Company-Block  -->
            <div class="company-block">
                <div class="inner-box" style="display: flex; width: 343px; height: 427px; padding: 40px 28px 41px 28px; flex-direction: column; justify-content: center; align-items: center; flex-shrink: 0;">
                    <div>
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt="admin.upload"></figure>
                        <h4 class="name">company_name</h4>
                        
                        <div class="location"><i class="flaticon-map-locator"></i>company_addres</div>
                        <div class="button-container" >
                            <a  class="btn btn-success text-white" style="margin-left : 20px; border-radius: 8px;">Lamar</a>
                            <a  class="btn btn-outline-success" style="margin-left: 20px; border-radius: 8px;">Detail</a>
                            
                        </div>
                    </div>
                </div>
                    
            </div>
        </div>
    </div>
</section>

@yield('categori')

<!-- End Process Section -->

<section class="section" style="background-image: url({{ asset('front/assets/landing/images/background/Section.png')}}); ; background-size: cover; background-repeat: no-repeat;">
    <div class="container">
        <header class="section-header">
            <div class="sec-title text-center mb-0 pb-4">
                <h2 style="color: white;">@lang('modules.front.jobOpenings')</h2>
                <p style="color: white;">Facilisis in elementum quam orci, nunc velit. Id et ultrices rhoncus gravida.
                    Facilisis eget nunc, euismod odio sit feugiat.</p>
            </div>
        </header>
    </div>

    <div class="container">
        <div class="row text-center">
            <div class="col-4">
                <div class="bg-white" style="margin: 15px; width: 100%; border-radius: 15px; border-top: 10px solid #4EA971">
                    <div class="text-center p-4">
                        <h5 class="font-weight-semibold">Development & IT</h5>
                        <div class="row text-center mt-3">
                            <div class="col-6">
                                <span class="icon flaticon-map-locator"> 24 lokasi</span>
                            </div>
                            <div class="col-6">
                                <span class="icon flaticon-briefcase"> 70 Lowongan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="bg-white" style="margin: 15px; width: 100%; border-radius: 15px; border-top: 10px solid #4EA971">
                    <div class="text-center p-4">
                        <h5 class="font-weight-semibold">Design & Creatives</h5>
                        <div class="row text-center mt-3">
                            <div class="col-6">
                                <span class="icon flaticon-map-locator"> 34 lokasi</span>
                            </div>
                            <div class="col-6">
                                <span class="icon flaticon-briefcase"> 56 Lowongan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="bg-white" style="margin: 15px; width: 100%; border-radius: 15px; border-top: 10px solid #4EA971">
                    <div class="text-center p-4">
                        <h5 class="font-weight-semibold">Finance & Accounting </h5>
                        <div class="row text-center mt-3">
                            <div class="col-6">
                                <span class="icon flaticon-map-locator"> 14 lokasi</span>
                            </div>
                            <div class="col-6">
                                <span class="icon flaticon-briefcase"> 26 Lowongan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center justify-content-center">
            <div class="col-4">
                <div class="bg-white" style="margin: 15px; width: 100%; border-radius: 15px; border-top: 10px solid #4EA971">
                    <div class="text-center p-4">
                        <h5 class="font-weight-semibold">Writing & Editor</h5>
                        <div class="row text-center mt-3">
                            <div class="col-6">
                                <span class="icon flaticon-map-locator"> 30 lokasi</span>
                            </div>
                            <div class="col-6">
                                <span class="icon flaticon-briefcase"> 56 Lowongan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="bg-white" style="margin: 15px; width: 100%; border-radius: 15px; border-top: 10px solid #4EA971">
                    <div class="text-center p-4">
                        <h5 class="font-weight-semibold">Business & Sales</h5>
                        <div class="row text-center mt-3">
                            <div class="col-6">
                                <span class="icon flaticon-map-locator"> 34 lokasi</span>
                            </div>
                            <div class="col-6">
                                <span class="icon flaticon-briefcase"> 56 Lowongan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center" style="margin: 20px;">
        <a class="" type="button" class="btn btn-outline-success" style="color: white;">Lihat Kemampuan
            Lainya > <span class="icon flaticon-chevron-right"></span></a>
    </div>
</section>

<!-- Top Companies -->
<section class="top-companies style-two">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h2>Mitra Perusahaan</h2>
            <div class="text">Talentern menjalin kerjasama dengan 500+ perusahaan nasional dan multinasional</div>
        </div>
        <div class="row">
            @yield('partners')
            <!-- Company Block -->
              
            <div class="company-block" >
                <div class="inner-box" style="text-align: left; border-radius: 4px; width: 405px; height: 349px; flex-shrink: 0;">
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
                <div class="inner-box" style="text-align: left; border-radius: 4px; width: 405px; height: 349px; flex-shrink: 0;">
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
                <div class="inner-box" style="text-align: left; border-radius: 4px; width: 405px; height: 349px; flex-shrink: 0;">
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
                <div class="inner-box" style="text-align: left; border-radius: 4px; width: 405px; height: 349px; flex-shrink: 0;">
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
                <div class="inner-box" style="text-align: left; border-radius: 4px; width: 405px; height: 349px; flex-shrink: 0;">
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
                <div class="inner-box" style="text-align: left; border-radius: 4px; width: 405px; height: 349px; flex-shrink: 0;">
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

<section class="section" style="background-image: url({{ asset('front/assets/landing/images/background/blue.png')}}); ; background-size: cover; background-repeat: no-repeat;">
    <div class="container">
        <header class="section-header">
            <div class="sec-title text-center mb-0 pb-4">
                <h2 style="color: white;">@lang('modules.front.bestTitle')</h2>
                <p style="color: white;">Temukan peluang karir anda di kota - kota besar</p>
            </div>
        </header>
        <div class="image">
            <div class="row">
                <div class="col-3">
                    <div class="row">
                        <div class="col-12">
                            <img src="{{ asset('front/assets/img/Rectangle.png') }}" class="img-fluid" alt="bandung">
                        </div>
                        <div class="col-12">
                            <img src="{{ asset('front/assets/img/Jakarta.png') }}" class="img-fluid" alt="jakarta">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-12">
                            <img src="{{ asset('front/assets/img/Bali.png') }}" class="img-fluid" alt="bali" style="height: 510px;">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <img src="{{ asset('front/assets/img/Yogya.png') }}" class="img-fluid" alt="yogya" style="height: 255px;" width="610px">
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('front/assets/img/surabaya.png') }}" class="img-fluid" alt="surabaya">
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('front/assets/img/medan.png') }}" class="img-fluid" alt="medan">
                        </div>
                    </div>
                </div>
            </div>


            <div class="text-center" style="margin: 20px;">
                <a class="" type="button" class="btn btn-outline-success" style="color: white;">Lihat Kemampuan Lainnya
                    >
                    <span class="icon flaticon-chevron-right"></span></a>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="auto-container">
        <div class="widgets-section">
            <div class="newsletter-form wow fadeInUp"></div>
            <div class="row margin-right:400px; margin-left:400px;">
                <div class="col-6">
                    <div style="margin-top: 100px; color: #4EA971; ">
                        <h4>Bagaimana Cara Melamar Pekerjaan di Talentern?</h4>
                    </div>
                    <div class="sec-title">
                        <h1>5 Langkah Melamar <br> Pekerjaan di Talentern<h1>
                                <p>Sodales mauris quam faucibus scelerisque risus malesuada nulla. Cursus enim quis
                                    elementum feugiat ut. Phasellus a viverra facilisis eu purus. Et risus magna dis
                                    nisl nulla sed diam.</p>
                    </div>

                    <button type="button" class="btn btn-success" style="margin-bottom: 50px ">Cari Lowongan
                        Sekarang</button>
                    <div class="big-column">
                        <div class="footer-column about-widget">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div style="margin-top: 30px; margin-bottom: 30px;">
                        <img src="{{ asset('front/assets/img/background_pekerjaan.svg') }}" class="img-fluid" alt="" style="height: 500px;" width="700px">
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

</main>
<!-- End Top Companies -->
@endsection