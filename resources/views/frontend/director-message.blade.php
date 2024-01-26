@extends('layouts.frontend.app')
@section('meta')
    <title>{{ $pageTitle }} | {{ (companyInfo()->meta_title) ? companyInfo()->meta_title : '' }}</title>
    <meta name="description" content="{{ (companyInfo()->meta_des) ? companyInfo()->meta_des : '' }}">
    <meta name="tags" content="{{ (companyInfo()->meta_keywords) ? companyInfo()->meta_keywords : '' }}">

    <meta property="og:title" content="{{ (companyInfo()->meta_title) ? companyInfo()->meta_title : '' }}" />
    <meta property="og:description" content="{{ (companyInfo()->meta_des) ? companyInfo()->meta_des : '' }}" />
    <meta property="og:image" content="{{ (companyInfo()->meta_image) ? asset('uploads/system/'.companyInfo()->meta_image) : asset('frontend/assets/img/logo/medi-world.png') }}" />
@endsection
@section('content')
<style>
    .missions h4{
        font-size: 16px;
        color: #2b72b9;
    }
    .missions p {
        font-size: 16px !important;
        color: #000000cf;
    }
</style>
<!-- breadcrumb-area-start -->
<div class="breadcrumb-area pt-125 pb-125" style="background-image:url({{ asset('frontend/assets/img/bg/04.jpg') }})">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-wrapper">
                    <div class="breadcrumb-text">
                        <h2>Message From Managing Director</h2>
                    </div>
                    <ul class="breadcrumb-menu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><span>Managing Director</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area-end -->

<div class="about-area about-pb pt-150 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 {{ ($data->image == NULL) ? 'd-none' : '' }}">
                <div class="about-img pos-rel mb-30">
                    <img src="{{ ($data->image != NULL) ? asset('uploads/system/'.$data->image) : '' }}" alt="" style="border: 1px solid #4e97fd;">
                    {{-- <div class="about-tag">
                        <h2>25</h2>
                        <span>Years of <br> experience</span>
                    </div> --}}
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 {{ ($data->image == NULL) ? 'col-lg-12' : '' }}">
                <div class="about-wrapper pos-rel mb-30">
                    <div class="section-title mb-40">
                        <h2>What Our Managing Director Say</h2>
                    </div>
                    <div class="about-item">
                        <div class="about-text">
                            {!! $data->content !!}
                        </div>
                    </div>
                    <div class="about-button mt-45">
                        <a href="{{ route('home.contact') }}" class="c-btn">Contact Us <i class="far fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
