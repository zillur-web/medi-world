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
        font-size: 18px;
        color: #2b72b9;
        font-weight: 700;
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
                        <h2>About Us</h2>
                    </div>
                    <ul class="breadcrumb-menu">
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><span>About Us</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area-end -->

<!-- about-area-start -->
<div class="about-area about-pb pt-40 pb-40">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card p-4 box-shadow missions" style="box-shadow: 0 0 12px 0 rgba(0,0,0,0.08);">
                    {!! $data->about_us_content !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about-area-end -->
@endsection
