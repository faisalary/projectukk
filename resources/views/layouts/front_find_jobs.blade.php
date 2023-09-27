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
        <button class="btn dropdown-toggle-find" type="button" data-toggle="dropdown">
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
    
</div>
</section>
<!--End Page Title-->

<!-- Listing Section -->
<section class="ls-section">
    <div class="auto-container">
        <div class="filters-backdrop"></div>
        
        <div class="row">

            <!-- Filters Column -->
            {{-- <div class="filters-column col-lg-4 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="filters-outer">
                        <button type="button" class="theme-btn close-filters">X</button>
                        
                        <!-- Switchbox Outer -->
                        <div class="switchbox-outer">
                            <h4>Job type</h4>
                            <ul class="switchbox">
                                <li>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                        <span class="title">Freelance</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                        <span class="title">Full Time</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                        <span class="title">Internship</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                        <span class="title">Part Time</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                        <span class="title">Temporary</span>
                                    </label>
                                </li>
                            </ul>
                        </div>

                        <!-- Checkboxes Ouer -->
                        <div class="checkbox-outer">
                            <h4>Date Posted</h4>
                            <ul class="checkboxes">
                                <li>
                                    <input id="check-f" type="checkbox" name="check">
                                    <label for="check-f">All</label>                              
                                </li>
                                <li>
                                    <input id="check-a" type="checkbox" name="check">
                                    <label for="check-a">Last Hour</label>                                
                                </li>
                                <li>
                                    <input id="check-b" type="checkbox" name="check">
                                    <label for="check-b">Last 24 Hours</label>                                
                                </li>
                                <li>
                                    <input id="check-c" type="checkbox" name="check">
                                    <label for="check-c">Last 7 Days</label>                                
                                </li>
                                <li>
                                    <input id="check-d" type="checkbox" name="check">
                                    <label for="check-d">Last 14 Days</label>                                
                                </li>
                                <li>
                                    <input id="check-e" type="checkbox" name="check">
                                    <label for="check-e">Last 30 Days</label>                                
                                </li>
                            </ul>
                        </div>

                        <!-- Checkboxes Ouer -->
                        <div class="checkbox-outer">
                            <h4>Experience Level</h4>
                            <ul class="checkboxes square">
                                <li>
                                    <input id="check-ba" type="checkbox" name="check">
                                    <label for="check-ba">All</label>                                
                                </li>
                                <li>
                                    <input id="check-bb" type="checkbox" name="check">
                                    <label for="check-bb">Internship</label>                                
                                </li>
                                <li>
                                    <input id="check-bc" type="checkbox" name="check">
                                    <label for="check-bc">Entry level</label>                                
                                </li>
                                <li>
                                    <input id="check-bd" type="checkbox" name="check">
                                    <label for="check-bd">Associate</label>                                
                                </li>
                                <li>
                                    <input id="check-be" type="checkbox" name="check">
                                    <label for="check-be">Mid-Senior level4</label>                                
                                </li>
                                <li>
                                    <button class="view-more"><span class="icon flaticon-plus"></span> View More</button>
                                </li>
                            </ul>
                        </div>

                        <!-- Filter Block -->
                        <div class="filter-block">
                            <h4>Salary</h4>

                            <div class="range-slider-one salary-range">
                                <div class="salary-range-slider"></div>
                                <div class="input-outer">
                                    <div class="amount-outer">
                                        <span class="amount salary-amount">
                                            $<span class="min">0</span>
                                            $<span class="max">0</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Block -->
                        <div class="filter-block">
                            <h4>Tags</h4>
                            <ul class="tags-style-one">
                                <li><a href="#">app</a></li>
                                <li><a href="#">administrative</a></li>
                                <li><a href="#">android</a></li>
                                <li><a href="#">wordpress</a></li>
                                <li><a href="#">design</a></li>
                                <li><a href="#">react</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Call To Action -->
                    <div class="call-to-action-four">
                        <h5>Recruiting?</h5>
                        <p>Advertise your jobs to millions of monthly users and search 15.8 million CVs in our database.</p>
                        <a href="#" class="theme-btn btn-style-one bg-blue"><span class="btn-title">Start Recruiting Now</span></a>
                        <div class="image" style="background-image: url(images/resource/ads-bg-4.png);"></div>
                    </div>
                    <!-- End Call To Action -->
                </div>
            </div> --}}
            
            <!-- Content Column -->
            <div class="content-column col-lg-12 col-md-12 col-sm-12">
                <div class="ls-outer">
                    <button type="button" class="theme-btn btn-style-two toggle-filters">Show Filters</button>

                    <!-- ls Switcher -->
                    <div class="ls-switcher">
                        <div class="showing-result">
                          
                            <div class="text">Showing <strong></strong> of <strong></strong> jobs</div>
                        </div>
                        <div class="sort-by">
                            {{-- <select class="chosen-select">
                                
                                <option>New Jobs</option>
                                <option>Freelance</option>
                                <option>Full Time</option>
                                <option>Internship</option>
                                <option>Part Time</option>
                                <option>Temporary</option>
                            </select> --}}

                            <select class="chosen-select" id="select_row" >
                                
                               
                              
                            </select>
                        </div>
                    </div>


                    <!-- Job Block -->
                    {{-- <div class="job-block">
                        <div class="inner-box">
                            <div class="content">
                                <span class="company-logo"><img src="images/resource/company-logo/1-1.png" alt=""></span>
                                <h4><a href="#">Software Engineer (Android), Libraries</a></h4>
                                <ul class="job-info">
                                    <li><span class="icon flaticon-briefcase"></span> Segment</li>
                                    <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                    <li><span class="icon flaticon-clock-3"></span> 11 hours ago</li>
                                    <li><span class="icon flaticon-money"></span> $35k - $45k</li>
                                </ul>
                                <ul class="job-other-info">
                                    <li class="time">Full Time</li>
                                    <li class="privacy">Private</li>
                                    <li class="required">Urgent</li>
                                </ul>
                                <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Pagination -->
                    {{-- <nav class="ls-pagination">
                        <ul>
                            <li class="prev"><a href="#"><i class="fa fa-arrow-left"></i></a></li>
                            <li><a href="#" class="current-page">1</a></li>
                            <li><a href="#" >2</a></li>
                            <li><a href="#">3</a></li>
                            <li class="next"><a href="#"><i class="fa fa-arrow-right"></i></a></li>
                        </ul>
                    </nav> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Listing Page Section -->

<input type="hidden" id="request_url" value="{{json_encode(request()->all())}}">
@endsection