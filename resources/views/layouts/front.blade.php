@extends('layouts.front_layout')

<!-- Banner Section-->
@section('content-main')
{{--<title>{{$companyName}}</title>--}}
{{--<span class="header-span"></span>--}}

<section class="banner-section-four" style="background-image: url({{asset('assets/images/background/bgEllipse.svg')}});">
    <div class="auto-container">
        <div class="cotnent-box">
            <div class="title-box wow fadeInUp" data-wow-delay="500ms">
                <h3 style="color: var(--primary-500-base, var(--primary-500-base, #4EA971));">Selangkah Lebih Dekat Dengan Pekerjaan Impianmu<h3>
                <h4>Temukan dan wujudkan semua karir impianmu hanya dengan satu klik bersama Talentern</h4> 
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
            <!-- Job Search Form -->
        </div>
    </div>
</section>
<!-- End Banner Section-->
<main class="main-content">

    @yield('content')
    


<!-- Process Section -->
<section class="process-section pt-0">
<div class="row row-cols-1 row-cols-md-3 g-4">
                <div id="diseluruh" class="card" style="max-width: 17rem; height: 201px;">
                    <div class="card-body">

                        <h5 class="card-title">Diseluruh Indonesia</h5>
                        <p class="card-text">Lorem Ipsum</p>
                    </div>
                </div>
                <div id="kemudahan" class="card" style="max-width: 17rem; height: 201px;">
                    <div class="card-body">
                        <h5 class="card-title">Kemudahan Melamar</h5> 
                        <p class="card-text">Lorem Ipsum</p>
                    </div>
                </div>
                <div id="Blowongan" class="card" style="max-width: 17rem; height: 201px;">
                    <div class="card-body">
                        <h5 class="card-title">1000+ Lowongan</h5>
                        <p class="card-text">Lorem Ipsum</p>
                        
                    </div>
                </div>
                <div id="Bperusahaan" class="card" style="max-width: 17rem; height: 201px;">
                    <div class="card-body">
                        <h5 class="card-title">300+ Perusahaan</h5>
                        <p class="card-text">Lorem Ipsum</p>
                    </div>
                </div>
    </div>
</section>



<section class="top-companies style-two">
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
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt=""></figure>
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
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt=""></figure>
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
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt=""></figure>
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
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt=""></figure>
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
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt=""></figure>
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
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt=""></figure>
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
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt=""></figure>
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
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt=""></figure>
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
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt=""></figure>
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
                <div class="sec-title text-center mb-0 pb-4" >
                    <h2 style="color: white;">@lang('modules.front.jobOpenings')</h2>
                    <p style="color: white;">Facilisis in elementum quam orci, nunc velit. Id et ultrices rhoncus gravida. Facilisis eget nunc, euismod odio sit feugiat.</p>  
                </div>
            </header>
        </div> 

        <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Design & Creative -->
            <div class="card"  style="margin-left: 50px; width: 380px; height: 120px; border-radius: 15px;">
                <div class="container">
                    <div class="row" style="display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="auto" height="auto" viewBox="0 0 348 13" fill="none">
                            <path d="M0 10C0 4.47715 4.47715 0 10 0H338C343.523 0 348 4.47715 348 10V13H0V10Z" fill="#4EA971"/>
                        </svg>
                        <div class="text-center" style="margin: 15px;">
                            <h5>Design & Creative</h5>  
                            <ul class="job-info" style="display: flex; list-style: none; padding: 0; margin: 0;">
                                <li style="margin-right: 20px;"><span class="icon flaticon-map-locator"> 34 lokasi</span></li>
                                <li><span class="icon flaticon-briefcase"> 56 Lowongan</span></li>
                            </ul>                       
                        </div>
                    </div>
                </div>
            </div>

            <!-- Development -->
            <div class="card"  style="margin-left: 50px; width: 380px; height: 120px; border-radius: 15px;">
                <div class="container">
                    <div class="row" style="display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="auto" height="auto" viewBox="0 0 348 13" fill="none">
                            <path d="M0 10C0 4.47715 4.47715 0 10 0H338C343.523 0 348 4.47715 348 10V13H0V10Z" fill="#4EA971"/>
                        </svg>
                        <div class="text-center" style="margin: 15px;">
                            <h5>Development</h5>  
                            <ul class="job-info" style="display: flex; list-style: none; padding: 0; margin: 0;">
                                <li style="margin-right: 20px;"><span class="icon flaticon-map-locator"> 34 lokasi</span></li>
                                <li><span class="icon flaticon-briefcase"> 56 Lowongan</span></li>
                            </ul>                       
                        </div>
                    </div>
                </div>
            </div>

            <!-- Finance & Accounting -->
            <div class="card"  style="margin-left: 50px; margin-top: 50px; width: 380px; height: 120px; border-radius: 15px;">
                <div class="container">
                    <div class="row" style="display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="auto" height="auto" viewBox="0 0 348 13" fill="none">
                            <path d="M0 10C0 4.47715 4.47715 0 10 0H338C343.523 0 348 4.47715 348 10V13H0V10Z" fill="#4EA971"/>
                        </svg>
                        <div class="text-center" style="margin: 15px;">
                            <h5>Finance & Accounting</h5>  
                            <ul class="job-info" style="display: flex; list-style: none; padding: 0; margin: 0;">
                                <li style="margin-right: 20px;"><span class="icon flaticon-map-locator"> 34 lokasi</span></li>
                                <li><span class="icon flaticon-briefcase"> 56 Lowongan</span></li>
                            </ul>                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center" style="margin: 20px;">
            <a class="" type="button" class="btn btn-outline-success" style="color: white;">Lihat Kemampuan Lainya <span class="icon flaticon-chevron-right"></span></a>
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
                
                <div class="company-block">
                    <div class="inner-box">
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt=""></figure>
                        <h4 class="name">company_name</h4>
                        <div class="location"><i class="flaticon-map-locator"></i>company_adress</div>
                        <a class="btn btn-outline-success " >Lihat Perusahaan</a>           
                    </div>
                </div>

                <div class="company-block">
                    <div class="inner-box">
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt=""></figure>
                        <h4 class="name">company_name</h4>
                        <div class="location"><i class="flaticon-map-locator"></i>company_adress</div>
                        <a class="btn btn-outline-success">Lihat Perusahaan</a>           
                    </div>
                </div>
                <div class="company-block">
                    <div class="inner-box">
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt=""></figure>
                        <h4 class="name">company_name</h4>
                        <div class="location"><i class="flaticon-map-locator"></i>company_adress</div>
                        <a class="btn btn-outline-success">Lihat Perusahaan</a>           
                    </div>
                </div>
                <div class="company-block">
                    <div class="inner-box">
                        <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="" alt=""></figure>
                        <h4 class="name">company_name</h4>
                        <div class="location"><i class="flaticon-map-locator"></i>company_adress</div>
                        <a class="btn btn-outline-success">Lihat Perusahaan</a>           
                    </div>
                </div>
            </div>
        
    </div>
</section>
<section class="section" style="background-image: url({{ asset('front/assets/landing/images/background/blue.png')}}); ; background-size: cover; background-repeat: no-repeat;">
        <div class="container">
            <header class="section-header">
                <div class="sec-title text-center mb-0 pb-4" >
                    <h2 style="color: white;">@lang('modules.front.bestTitle')</h2>
                    <p style="color: white;">Temukan peluang karir anda di kota - kota besar</p>  
                </div>
            </header>
           
                <div class="image" style="border-radius: 26px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('front/assets/img/Rectangle.png') }}" class="img-fluid" alt="bandung">
                    <img src="{{ asset('front/assets/img/Bali.png') }}" class="img-fluid" alt="bali">
                    <img src="{{ asset('front/assets/img/Jakarta.png') }}" class="img-fluid" alt="jakarta">
                    <img src="{{ asset('front/assets/img/Yogya.png') }}" class="img-fluid" alt="yogya">
                </div>
                          
        </div> 

        <div class="text-center" style="margin: 20px;">
            <a class="" type="button" class="btn btn-outline-success" style="color: white;">Lihat Kemampuan Lainya <span class="icon flaticon-chevron-right"></span></a>
        </div>
</section>
<section>
    <div class="auto-container">
        <div class="widgets-section">
            <div class="newsletter-form wow fadeInUp"></div>
                <div class="row">
                    <div class="big-column col-lg-5 col-sm-12">
                        <div style="margin-top: 100px; color: #4EA971; ">
                            <h5>Bagaimana Cara Melamar Pekerjaan di Talentern?</h5>
                        </div>
                        <div class="sec-title">
                            <h1>5 Langkah Melamar Pekerjaan di Talentern<h1>
                            <p>Sodales mauris quam faucibus scelerisque risus malesuada nulla. Cursus enim quis elementum feugiat ut. Phasellus a viverra facilisis eu purus. Et risus magna dis nisl nulla sed diam.</p>
                        </div>
                        <button type="button" class="btn btn-success" style="margin-bottom: 50px ">Cari Lowongan Sekarang</button>
                    </div>
                    <div class="big-column col-lg-5 col-sm-12">
                        <div class="footer-column about-widget">
                            
                        </div>
                    </div>
                </div>
            </div>
    </div>
   
</section>
<!-- End Top Companies -->
@endsection