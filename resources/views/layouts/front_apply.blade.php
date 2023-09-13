@extends('layouts.front_layout')
<!-- Banner Section-->
@section('content-main')
<title>{{ $job->title }}</title>
<span class="header-span"></span>

<!--CheckOut Page-->
<section class="job-detail-section">
    <section class="page-title style-two">
        <div class="auto-container">
            <div class="title-outer">
                <h1>Form Apply</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ url('job/'.$job->slug) }}">{{ $job->title }}</a></li>
                    <li>Form Applyment</li>
                </ul> 
            </div>
        </div>
    </section>
    @yield('content')
</section>
<!--End CheckOut Page-->
<script src="{{ asset('front/assets/landing/js/jquery.js') }}"></script>

@endsection