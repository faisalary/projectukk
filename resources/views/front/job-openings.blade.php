@extends('layouts.front')

<style>
    .jobs-all a:hover,
    .jobs-all a:focus,
    .jobs-all a:visited {
        text-decoration: none;
        outline: none;
    }
</style>

@section('header-text')
    {{-- <h1 class="hidden-sm-down"><i class="icon-ribbon"></i> @lang('modules.front.homeHeader') </h1>
    <h4 class="hidden-sm-up"><i class="icon-ribbon"></i> @lang('modules.front.homeHeader') </h4>
    <!-- <form>
        <div class="row">
            <div class="col-5">
                <input type="text" class="form-control autocomplete" name="job" autocomplete="off" placeholder="Search jobs" data-url="{{url('/fetch-jobs')}}" value="{{request()->job}}" />
            </div>
            <div class="col-5">
                <input type="text" class="form-control autocomplete" name="loc" autocomplete="off" placeholder="Search locations" data-url="{{url('/fetch-locations')}}" value="{{request()->loc}}"/>
            </div>
            <div class="col-2">
                <button class="btn btn-secondary">Find</button>
            </div>
        </div>
        <div class="col-6">
            <input type="text" class="form-control autocomplete" name="loc" autocomplete="off" placeholder="Search locations" data-url="{{url('/fetch-locations')}}" />
        </div>
    </form>-->--}}
    <div class="" data-wow-delay="1000ms">
       
        <form action="{{url("/search")}}" method="GET">
            <div class="job-search-form wow fadeInUp " style="border-radius: 10px; border: 2px solid var(--primary-500-base, #4EA971); background: #FFF; height: 69px; width: 834px;;">
                <div class="row">
                
                <div class="form-group col-lg-3 col-md-12 col-sm-12">
                    <span class="icon flaticon-search-1"></span>
                    <input type="text" class="form-control autocomplete" name="job" autocomplete="off" placeholder="Job Vacancy" data-url="{{url('/fetch-jobs')}}"  value="{{request()->job}}">
                </div>
                
                <!-- Form Group - Locations -->
                <div class="form-group col-lg-3 col-md-12 col-sm-12 location">
                    <span class="icon flaticon-map-locator"></span>
                    <input type="text" class="form-control autocomplete" name="loc" autocomplete="off" placeholder="Locations" data-url="{{url('/fetch-locations')}}"  value="{{request()->loc}}">
                </div>
                
                <!-- Form Group - Job Type -->
                <div class="form-group col-lg-3 col-md-12 col-sm-12 briefcase">
                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="auto" height="auto" viewBox="0 0 24 24" fill="none"><rect x="3" y="7" width="18" height="13" rx="2" stroke="#4EA971" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 7V5C8 3.89543 8.89543 3 10 3H14C15.1046 3 16 3.89543 16 5V7" stroke="#4EA971" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 12V12.01" stroke="#4EA971" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M3 13C8.66095 15.8526 15.339 15.8526 21 13" stroke="#4EA971" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                    <input type="text" class="form-control autocomplete" name="type" autocomplete="off" placeholder="Jobs Type" data-url="{{url('/fetch-briefcase')}}"  value="{{request()->job}}">
                </div>

            
                    
                    <!-- Form Group -->
                    {{-- <div class="form-group col-lg-3 col-md-12 col-sm-12 category">
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
                    </div> --}}

                    <!-- Form Group -->
                    <div class="form-group" style=" margin: 7px">
                        <button  class="btn-success btn-style-two">Find Jobs</button>
                    </div>
                </div>
            </div>
           
       
        </form>
    </div>
 
 
@endsection

@section('content')



    <!--
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    | Working at TheThemeio
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    !--
    <section class="section bg-gray py-60">
        <div class="container">

            <div class="row gap-y align-items-center">

                <div class="col-12">
                    {{-- <h3>@if(!is_null($frontTheme->welcome_title)) {{ $frontTheme->welcome_title }} @else @lang('modules.front.jobOpeningHeading') @endif</h3>
                    <p>@if(!is_null($frontTheme->welcome_sub_title)) {!! $frontTheme->welcome_sub_title !!}  @else @lang('modules.front.jobOpeningText') @endif</p> --}}

                </div>

            </div>

        </div>
    </section>-->

@endsection

@section('openings')
    <!--
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    | Open positions
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    !-->
 
                <!-- Ui lama di komen ya -->

            <!-- <div data-provide="shuffle"> -->
                <!-- {{-- <div class="text-center gap-multiline-items-2 job-filters" data-shuffle="filter">
                    @if(request()->loc == '')
                        <button class="btn btn-w-md btn-outline btn-round btn-primary active" data-shuffle="button">All
                        </button>
                    @endif --}}
                    {{-- @foreach($locations as $location)
                        <button class="btn  btn-outline btn-round btn-primary" data-shuffle="button"
                                data-group="{{ $location->location }}">{{ ucwords($location->location) }}</button>
                    @endforeach
                    <p>&nbsp;</p>
                    @foreach($categories as $category)
                        <button class="btn btn-xs btn-outline btn-round btn-dark" data-shuffle="button"
                                data-group="{{ $category->name }}">{{ ucwords($category->name) }}</button>
                    @endforeach
                </div> --}}

                <div data-provide="shuffle" class="tabs-content wow fadeInUp">
                    <div class="container">
                        @if(count($jobs) > 0)
                        <div class="row">
                        @else
                        <div class="row" style="display: flex; align-items: center; justify-content: center;">
                        @endif
                            @php
                                $count = 1;
                            @endphp
                            @foreach($jobs as $job)
                                @if($count <= 5)
                                    {{-- @foreach ($companies as $item) --}}
                                    <div class="col-xl-6 col-lg-6 jobs-all">
                                        <a href="{{ route('jobs.jobDetail', [$job->slug]) }}">
                                            <div class="job-block" data-shuffle="list" data-groups="{{ $job->location->location.','.$job->category->name }}">
                                                <div class="inner-box" >
                                                    
                                                    <div class="content">
                                                        {{-- <span class="company-logo"><img src="{{ ucwords($item->logo) }}" alt=""></span> --}}
                                                        <span class="company-logo"><img src="{{ asset("user-uploads/company-logo/".$job->company->logo) }}" alt=""></span>
                                                        <h4 class="text-truncate">{{ ucwords($job->title) }}</h4>
                                                        <ul class="job-info">
                                                            <li><span class="icon flaticon-briefcase"></span>{{ ucwords($job->category->name) }}</li>
                                                            <li><span class="icon flaticon-map-locator"></span>{{ ucwords($job->location->location)}}</li>
                                                            <li><span class="icon flaticon-worldwide"></span>{{ ucwords($job->location->country->country_name)}}</li>
                                                        </ul>
                                                        {{-- <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button> --}}
                                                    </div>
                                                </div>
                                            </div> 
                                        </a>            
                                    </div>
                                    {{-- <div class="job-block" data-shuffle="list" data-groups="{{ $job->location->location.','.$job->category->name }}">
                                        <div class="inner-box">
                                            <div class="content">
                                                <span class="company-logo"><img src="images/resource/company-logo/1-9.png" alt=""></span>
                                                <h4><a href="#">Product Manager, Studio</a></h4>
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
                                    </div> --}} -->
                                    <!-- {{-- @endforeach --}}
                                @endif
                                @php
                                    $count++;
                                @endphp
                            @endforeach
                             -->
                            <!-- <div class="col-xl-6 col-lg-6 jobs-all">
                                <a onclick="goToSearch(null)">
                                    <div class="job-block" data-shuffle="list">
                                        <div class="inner-box">
                                            <div class="content px-0" style="display: flex; align-items: center; justify-content: center; padding: 19.5px 0 20px 0;">
                                                <i class="material-symbols-outlined mr-2" style="font-size: 24px; margin-top: 2.5px;">add_circle</i>
                                                @lang('modules.module.todos.viewAll')
                                            </div>
                                        </div>
                                    </div> 
                                </a>            
                            </div>
                        </div>
                    </div>
                </div> -->

    
@endsection
@section('foryou')
    @foreach($companies as $company) 
    <div class="row">

         <!-- Company-Block  -->
        <div class="company-block">
            <div class="inner-box" style="display: flex; width: 343px; height: 427px; padding: 40px 28px 41px 28px; flex-direction: column; justify-content: center; align-items: center; flex-shrink: 0;">
                <div>
                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset("user-uploads/company-logo/".$company->logo) }}" alt=""></figure>
                    <h4 class="name">{{ ucwords($company->company_name) }}</h4>
                   
                    <div class="location"><i class="flaticon-map-locator"></i>{{ ucwords($company->address)}}</div>
                    <div class="button-container" >
                        <a onclick="goToSearch('<?php echo $company->company_name ?>')" class="btn btn-success text-white" style="margin-left : 20px; border-radius: 8px;">Lamar</a>
                        <a onclick="goToSearch('<?php echo $company->company_name ?>')" class="btn btn-outline-success" style="margin-left: 20px; border-radius: 8px;">Detail</a>
                        
                    </div>
                </div>
                  
            </div>
            
        </div>

        <!-- Company-Block  -->
        <div class="company-block">
            <div class="inner-box" style=" display: flex; width: 343px; height: 427px; padding: 40px 28px 41px 28px; flex-direction: column; justify-content: center; align-items: center; flex-shrink: 0;">
                <div>
                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset("user-uploads/company-logo/".$company->logo) }}" alt=""></figure>
                    <h4 class="name">{{ ucwords($company->company_name) }}</h4>
                   
                    <div class="location"><i class="flaticon-map-locator"></i>{{ ucwords($company->address)}}</div>
                    <div class="button-container" >
                        <a onclick="goToSearch('<?php echo $company->company_name ?>')" class="btn btn-success text-white" style="margin-left : 20px; border-radius: 8px;">Lamar</a>
                        <a onclick="goToSearch('<?php echo $company->company_name ?>')" class="btn btn-outline-success" style="margin-left: 20px; border-radius: 8px;">Detail</a>
                        
                    </div>
                </div>
                    
            </div>
        </div>
        
         <!-- Company-Block  -->
        <div class="company-block">
            <div class="inner-box" style="display: flex; width: 343px; height: 427px; padding: 40px 28px 41px 28px; flex-direction: column; justify-content: center; align-items: center; flex-shrink: 0;">
                <div>
                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset("user-uploads/company-logo/".$company->logo) }}" alt=""></figure>
                    <h4 class="name">{{ ucwords($company->company_name) }}</h4>
                   
                    <div class="location"><i class="flaticon-map-locator"></i>{{ ucwords($company->address)}}</div>
                    <div class="button-container" >
                        <a onclick="goToSearch('<?php echo $company->company_name ?>')" class="btn btn-success text-white" style="margin-left : 20px; border-radius: 8px;">Lamar</a>
                        <a onclick="goToSearch('<?php echo $company->company_name ?>')" class="btn btn-outline-success" style="margin-left: 20px; border-radius: 8px;">Detail</a>
                        
                    </div>
                </div>
                 
            </div>
        </div>

         <!-- Company-Block  -->
        <div class="company-block">
            <div class="inner-box" style="display: flex; width: 343px; height: 427px; padding: 40px 28px 41px 28px; flex-direction: column; justify-content: center; align-items: center; flex-shrink: 0;">
                <div>
                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset("user-uploads/company-logo/".$company->logo) }}" alt=""></figure>
                    <h4 class="name">{{ ucwords($company->company_name) }}</h4>
                   
                    <div class="location"><i class="flaticon-map-locator"></i>{{ ucwords($company->address)}}</div>
                    <div class="button-container" >
                        <a onclick="goToSearch('<?php echo $company->company_name ?>')" class="btn btn-success text-white" style="margin-left : 20px; border-radius: 8px;">Lamar</a>
                        <a onclick="goToSearch('<?php echo $company->company_name ?>')" class="btn btn-outline-success" style="margin-left: 20px; border-radius: 8px;">Detail</a>
                        
                    </div>
                </div>
                  
            </div>
        </div>

         <!-- Company-Block  -->
        <div class="company-block">
            <div class="inner-box" style="display: flex; width: 343px; height: 427px; padding: 40px 28px 41px 28px; flex-direction: column; justify-content: center; align-items: center; flex-shrink: 0;">
                <div>
                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset("user-uploads/company-logo/".$company->logo) }}" alt=""></figure>
                    <h4 class="name">{{ ucwords($company->company_name) }}</h4>
                   
                    <div class="location"><i class="flaticon-map-locator"></i>{{ ucwords($company->address)}}</div>
                    <div class="button-container" >
                        <a onclick="goToSearch('<?php echo $company->company_name ?>')" class="btn btn-success text-white" style="margin-left : 20px; border-radius: 8px;">Lamar</a>
                        <a onclick="goToSearch('<?php echo $company->company_name ?>')" class="btn btn-outline-success" style="margin-left: 20px; border-radius: 8px;">Detail</a>
                        
                    </div>
                </div>
                   
            </div>
        </div>

         <!-- Company-Block  -->
        <div class="company-block">
            <div class="inner-box" style="display: flex; width: 343px; height: 427px; padding: 40px 28px 41px 28px; flex-direction: column; justify-content: center; align-items: center; flex-shrink: 0;">
                <div>
                    <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset("user-uploads/company-logo/".$company->logo) }}" alt=""></figure>
                    <h4 class="name">{{ ucwords($company->company_name) }}</h4>
                   
                    <div class="location"><i class="flaticon-map-locator"></i>{{ ucwords($company->address)}}</div>
                    <div class="button-container" >
                        <a onclick="goToSearch('<?php echo $company->company_name ?>')" class="btn btn-success text-white" style="margin-left : 20px; border-radius: 8px;">Lamar</a>
                        <a onclick="goToSearch('<?php echo $company->company_name ?>')" class="btn btn-outline-success" style="margin-left: 20px; border-radius: 8px;">Detail</a>
                        
                    </div>
                </div>
                  
            </div>
            
        </div> 
    </div>

    <div class="text-center">
        <a onclick="goToSearch('<?php echo $company->company_name ?>')" class="" style="margin-top: 20px">lihat Perusahaan Lainya</a> 
    </div>

    @endforeach
@endsection

@section('partners')
    @foreach($companies as $company) 
        <div class="company-block">
            <div class="inner-box">
                <figure class="image" style="border-radius: 0%;"><img style="border-radius: 0%;" src="{{ asset("user-uploads/company-logo/".$company->logo) }}" alt=""></figure>
                <h4 class="name">{{ ucwords($company->company_name) }}</h4>
                <div class="location"><i class=""></i>{{ ucwords($company->address)}}</div>
                <a class="btn btn-outline-success me-2 ml-2 " onclick="goToSearch('<?php echo $company->company_name ?>')" type="button" class="">Lihat Perusahaan</a>           
            </div>
        </div>
    @endforeach
@endsection


@push('footer-script')
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>
    <script>
        $('.autocomplete').autoComplete({minLength:2});
    </script>

    <script>
        function goToSearch(company){	
            if(company != null){
                window.location.href = "/search?company=" + company;
            }
            else{
                window.location.href = "/search";
            }
        }
    </script>
@endpush