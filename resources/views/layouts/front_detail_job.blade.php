@extends('layouts.front_layout')
<!-- Banner Section-->
@section('content-main')
<title>{{ $job->title }}</title>
<span class="header-span"></span>
<!-- Job Detail Section -->
<section class="job-detail-section">
    <!-- Upper Box -->
    <div class="upper-box" style="padding-top: 100px !important; padding-bottom: 100px !important;">
        <div class="auto-container">
            <!-- Job Block -->
            <div class="job-block-seven">
                <div class="inner-box">
                    <div class="content">
                        <span class="company-logo"><img src="{{ asset("user-uploads/company-logo/".$job->company->logo) }}" alt=""></span>
                        <h4><a href="#">{{ ucwords($job->title) }}</a></h4>
                        <ul class="job-info">
                            <li><span class="icon flaticon-briefcase"></span>{{ ucwords($job->category->name) }}</li>
                            <li><span class="icon flaticon-map-locator"></span>{{ ucwords($job->location->location)}}</li>
                            <li><span class="icon flaticon-worldwide"></span>{{ ucwords($job->location->country->country_name) }}</li>
                            {{-- <li><span class="icon flaticon-money"></span> $35k - $45k</li> --}}
                        </ul>
                        <ul class="job-other-info">
                            <li class="time">Full Time</li>
                            <li class="privacy">Private</li>
                            <li class="required">Urgent</li>
                        </ul>
                    </div>

                    <div class="btn-box">
                        @if(isset($job_application_id))
                        <a class="bg-secondary btn-style-one" style="color: white;">Submitted !</a>
                        @else
                        <a href="{{ route('jobs.jobApply', [$job->slug]) }}" class="theme-btn btn-style-one">Apply For Job</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="job-detail-outer">
        <div class="my-4 mx-5">
            <div class="row">
                <div class="column mr-lg-5 col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar">
                        <div class="sidebar-widget">
                            <!-- Job Overview -->
                            <h4 class="widget-title">Job Overview</h4>
                            <div class="widget-content">
                                <ul class="job-overview">
                                    <li>
                                        <i class="icon icon-calendar"></i>
                                        <h5>Date Posted:</h5>
                                        <span>{{ ucwords(date_format($job->start_date,"F, d Y")) }}</span>
                                    </li>
                                    <li>
                                        <i class="icon icon-expiry"></i>
                                        <h5>Expiration date:</h5>
                                        <span>{{ ucwords(date_format($job->end_date,"F, d Y")) }}</span>
                                    </li>
                                    <li>
                                        <i class="icon icon-location"></i>
                                        <h5>Location:</h5>
                                        <span>{{ ucwords($job->location->location)}}</span>
                                    </li>
                                    <li>
                                        <i class="icon icon-user-2"></i>
                                        <h5>Required:</h5>
                                        <span>{{ ucwords($job->total_positions) }}</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Map Widget -->
                            {{-- <h4 class="widget-title">Job Location</h4>
                            <div class="widget-content">
                                <div class="map-outer">
                                    <div class="map-canvas"
                                        data-zoom="12"
                                        data-lat="-37.817085"
                                        data-lng="144.955631"
                                        data-type="roadmap"
                                        data-hue="#ffc400"
                                        data-title="Envato"
                                        data-icon-path="images/resource/map-marker.png"
                                        data-content="Melbourne VIC 3000, Australia<br><a href='mailto:info@youremail.com'>info@youremail.com</a>">
                                    </div>
                                </div>
                            </div> --}}

                            <!-- Job Skills -->
                            {{-- <h4 class="widget-title">Job Skills</h4>
                            <div class="widget-content">
                                <ul class="job-skills">
                                    <li><a href="#">{{ ucwords($job->skill) }}</a></li>
                                    <li><a href="#">administrative</a></li>
                                    <li><a href="#">android</a></li>
                                    <li><a href="#">wordpress</a></li>
                                    <li><a href="#">design</a></li>
                                    <li><a href="#">react</a></li>
                                </ul>
                            </div> --}}
                        </div>

                        <div class="sidebar-widget company-widget">
                            <div class="widget-content">
                                <div class="company-title">
                                    <div class="company-logo"><img src="{{ asset("user-uploads/company-logo/".$job->company->logo) }}" alt=""></div>
                                    <h5 class="company-name">{{ ucwords($job->company->company_name) }}</h5>
                                    {{-- <a href="{{ ucwords($job->company->website)}}" class="profile-link">View company profile</a> --}}
                                </div>

                                <ul class="company-info">
                                    <li>Primary industry: <span>{{ ucwords($job->category->name) }}</span></li>
                                    {{-- <li>Company size: <span>501-1,000</span></li>
                                    <li>Founded in: <span>2011</span></li> --}}
                                    <li>Phone: <span>{{ ucwords($job->company->company_phone)}}</span></li>
                                    <li>Email: <span>{{ ucwords($job->company->company_email)}}</span></li>
                                    <li>Location: <span>{{ ucwords($job->company->address)}}</span></li>
                                    <li>Social media: 
                                        <div class="social-links">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </li>
                                </ul>

                                <div class="btn-box"><a href="{{ ucwords($job->company->website)}}" class="theme-btn btn-style-three">{{ ucwords($job->company->website)}}</a></div>
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="column col-lg-7 col-md-12 col-sm-12">
                    <div class="job-detail">
                        <h4>Job Description</h4>
                        <p>{!! $job->job_description !!}</p>
                        <h4>Job Requirement</h4>
                        <ul class="list-style-three">
                            {!! $job->job_requirement !!}
                        </ul>
                        {{-- <h4>Skill & Experience</h4>
                        <ul class="list-style-three">
                            <li>You have at least 3 years’ experience working as a Product Designer.</li>
                            <li>You have experience using Sketch and InVision or Framer X</li>
                            <li>You have some previous experience working in an agile environment – Think two-week sprints.</li>
                            <li>You are familiar using Jira and Confluence in your workflow</li>
                        </ul> --}}
                    </div>

                    <!-- Other Options -->
                    {{-- <div class="other-options">
                        <div class="social-share">
                            <h5>Share this job</h5>
                            <a href="#" class="facebook"><i class="fab fa-facebook-f"></i> Facebook</a>
                            <a href="#" class="twitter"><i class="fab fa-twitter"></i> Twitter</a>
                            <a href="#" class="google"><i class="fab fa-google"></i> Google+</a>
                        </div>
                    </div> --}}

                    <!-- Related Jobs -->
                    <div class="related-jobs">
                        {{-- <div class="title-box">
                            <h3>Related Jobs</h3>
                            <div class="text">2020 jobs live - 293 added today.</div>
                        </div> --}}

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

                        <!-- Job Block -->
                        {{-- <div class="job-block">
                            <div class="inner-box">
                                <div class="content">
                                    <span class="company-logo"><img src="images/resource/company-logo/1-2.png" alt=""></span>
                                    <h4><a href="#">Recruiting Coordinator</a></h4>
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

                        <!-- Job Block -->
                        {{-- <div class="job-block">
                            <div class="inner-box">
                                <div class="content">
                                    <span class="company-logo"><img src="images/resource/company-logo/1-3.png" alt=""></span>
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
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Job Detail Section -->
@endsection






