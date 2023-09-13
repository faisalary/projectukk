
@extends('layouts.front_layout')
<!-- Banner Section-->
@section('content-main')
<title>{{ $job->title }}</title>
<section class="job-detail-section">
    <div class="job-detail-outer">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                    <div class="job-block-outer">
                        <!-- Job Block -->
                        <div class="job-block-seven style-two">
                            <div class="inner-box">
                                <div class="content">
                                    <h4>{{ ucwords($job->company->company_name) }}</h4>
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
                            </div>
                        </div>
                    </div>

                    <div class="job-overview-two">
                        <h4>Job Description</h4>
                        <ul>
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
                                <i class="icon icon-degree"></i>
                                <h5>Required:</h5>
                                <span>{{ ucwords($job->total_positions) }}</span>
                            </li>
                            <li>
                                <i class="icon icon-user-2"></i>
                                <h5>Job Title:</h5>
                                <span>{{ ucwords($job->title) }}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="job-detail">

                        <h4>Job Description</h4>
                        <p>{!! $job->job_description !!}</p>
                        {{-- <h4>Key Responsibilities</h4>
                        <ul class="list-style-three">
                            
                        </ul> --}}
                        <h4>Skill & Experience</h4>
                        <ul class="list-style-three">
                            {{ ucwords($job->required_collumns) }}
                        </ul>
                    </div>

                    <!-- Other Options -->
                    <div class="other-options">
                        <div class="social-share">
                            <h5>Share this job</h5>
                            <a href="#" class="facebook"><i class="fab fa-facebook-f"></i> Facebook</a>
                            <a href="#" class="twitter"><i class="fab fa-twitter"></i> Twitter</a>
                            <a href="#" class="google"><i class="fab fa-google"></i> Google+</a>
                        </div>
                    </div>
                </div>

                <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar">
                        <div class="btn-box">
                            <a href="#" class="theme-btn btn-style-one">Apply For Job</a>
                            <button class="bookmark-btn"><i class="flaticon-bookmark"></i></button>
                        </div>

                        <div class="sidebar-widget company-widget">
                            <div class="widget-content">
                                <div class="company-title">
                                    <div class="company-logo"><img src="images/resource/company-7.png" alt=""></div>
                                    <h5 class="company-name">InVision</h5>
                                    <a href="#" class="profile-link">View company profile</a>
                                </div>

                                <ul class="company-info">
                                    <li>Primary industry: <span>Software</span></li>
                                    <li>Company size: <span>501-1,000</span></li>
                                    <li>Founded in: <span>2011</span></li>
                                    <li>Phone: <span>123 456 7890</span></li>
                                    <li>Email: <span>info@joio.com</span></li>
                                    <li>Location: <span>London, UK</span></li>
                                    <li>Social media: 
                                        <div class="social-links">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </li>
                                </ul>

                                <div class="btn-box"><a href="#" class="theme-btn btn-style-three">www.invisionapp.com</a></div>
                            </div>
                        </div>

                        <div class="sidebar-widget contact-widget">
                            <h4 class="widget-title">Contact Us</h4>
                            <div class="widget-content">
                                <!-- Comment Form -->
                                <div class="default-form">
                                    <!--Comment Form-->
                                    <form>
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <input type="text" name="username" placeholder="Your Name" required>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <input type="email" name="email" placeholder="Email Address" required>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <textarea class="darma" name="message" placeholder="Message"></textarea>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <button class="theme-btn btn-style-one" type="submit" name="submit-form">Send Message</button>
                                            </div> 
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>

            <!-- Related Jobs -->
            <div class="related-jobs">
                <div class="title-box">
                    <h3>Related Jobs</h3>
                    <div class="text">2020 jobs live - 293 added today.</div>
                </div>
                <div class="row">
                    <!-- Job Block -->
                    <div class="job-block-four col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                                <li class="privacy">Private</li>
                                <li class="required">Urgent</li>
                            </ul>
                            <span class="company-logo"><img src="images/resource/company-logo/3-1.png" alt=""></span>
                            <span class="company-name">Catalyst</span>
                            <h4><a href="#">Software Engineer (Android), Libraries</a></h4>
                            <div class="location"><span class="icon flaticon-map-locator"></span> London, UK</div>
                        </div>
                    </div>

                    <!-- Job Block -->
                    <div class="job-block-four col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                            </ul>
                            <span class="company-logo"><img src="images/resource/company-logo/3-2.png" alt=""></span>
                            <span class="company-name">Catalyst</span>
                            <h4><a href="#">Software Engineer (Android), Libraries</a></h4>
                            <div class="location"><span class="icon flaticon-map-locator"></span> London, UK</div>
                        </div>
                    </div>

                    <!-- Job Block -->
                    <div class="job-block-four col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                            </ul>
                            <span class="company-logo"><img src="images/resource/company-logo/3-3.png" alt=""></span>
                            <span class="company-name">Upwork</span>
                            <h4><a href="#">Software Engineer (Android), Libraries</a></h4>
                            <div class="location"><span class="icon flaticon-map-locator"></span> London, UK</div>
                        </div>
                    </div>

                    <!-- Job Block -->
                    <div class="job-block-four col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                            </ul>
                            <span class="company-logo"><img src="images/resource/company-logo/3-4.png" alt=""></span>
                            <span class="company-name">invision</span>
                            <h4><a href="#">Software Engineer (Android), Libraries</a></h4>
                            <div class="location"><span class="icon flaticon-map-locator"></span> London, UK</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection



