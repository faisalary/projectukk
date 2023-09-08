<footer class="main-footer style-three" style="background-image: url({{ asset('front/assets/landing/images/background/Footer.png')}});">
    <div class="auto-container">
        <div class="widgets-section">
            {{-- <div class="newsletter-form wow fadeInUp">
            </div> --}}

            <div class="row">
                <div class="big-column col-lg-5 col-sm-12">
                    <div class="footer-column about-widget">
                    {{-- <!-- <div class="logo"><a href="#"><img src="{{ $global->logo_url }}" alt="" width="154px" height="50px"></a></div> -->--}}
                        <div class="logo"><a href="#"><img src="{{asset('assets/images/background/iconFooter.png')}}" alt="" width="154px" height="50px"></a></div>

                        {{-- <p class="phone-num"><span>Call us </span>{{ $global->company_phone }}</p>
                        <p class="address">{{ $global->address }}<br>{{$global->company_email}}</p> --}}
                        <p class="address">Permata Kuningan Building 17th Floor, Kawasan Epicentrum, HR Rasuna Said, Jl. Kuningan Mulia, RT.6/RW.1, Menteng Atas, Setiabudi, South Jakarta City, Jakarta 12920</p>
                    </div>
                </div>
                <div class="big-column col-lg-5 col-sm-12">
                    <div class="d-flex align-content-center justify-content-center">
                        <div class="footer-column">
                            <div class="footer-widget links-widget">
                            {{-- <!-- <h4 class="widget-title">{{ $companyName }}</h4> --> --}}
                                <h4 class="widget-title">Proxsis & Co</h4>
                                <div class="widget-content">
                                    <ul class="list">
                                        {{-- @foreach($customPages as $footer)
                                        <li><a href="{{route('custom', [$footer->slug])}}">{{$footer->name}}</a></li>
                                        @endforeach --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="big-column col-lg-2 col-sm-12"></div>
            </div>
        </div>
    </div>
    <!--Bottom-->
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="outer-box">

                <div class="copyright-text text-left">© {{ \Carbon\Carbon::today()->year }} @lang('app.byFooter')
                {{-- <div class="copyright-text">@lang('app.byFooter2') {{ $companyName }}&nbsp;&&nbsp;<a href="https://technoinfinity.co.id/">Techno Infinity</a> --}}
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
        </div>
    </div>
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div> 
</footer>