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
    .map{
        height: 450px;
        width: 100%;
    }
</style>
  <!-- contact-area-start -->
  <div class="contact-area pos-rel pt-100 pb-160">
    <div class="shape d-none d-xl-block">
        <div class="shape-item con-01"><img src="{{ asset('forntend/assets/img/icon/s.png') }}" alt=""></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5">
                <div class="contact-address-wrapper mt-20 mb-30">
                    <div class="section-title mb-30">
                        <h2>Conatct Us</h2>
                        <p>Please fill out the form on this section to contact with me.</p>
                    </div>
                    <ul class="contact-address-link">
                        <li>
                            <div class="contact-address-icon f-left mr-25">
                                <i class="far fa-map-marked-alt"></i>
                            </div>
                            <div class="contact-address-text">
                                <span>Head Office</span>
                                <h4 class="text-capitalize">{!! companyInfo()->address !!}</h4>
                            </div>
                        </li>
                        <li>
                            <div class="contact-address-icon f-left mr-25">
                                <i class="far fa-phone"></i>
                            </div>
                            <div class="contact-address-text">
                                <span>phone number</span>
                                <h4>
                                    @php
                                        $phoneArray = explode(',', companyInfo()->phone);
                                        foreach ($phoneArray as $phone) {
                                            echo trim($phone) . "<br>";
                                        }
                                    @endphp
                                </h4>
                            </div>
                        </li>
                        <li>
                            <div class="contact-address-icon f-left mr-25">
                                <i class="far fa-envelope-open"></i>
                            </div>
                            <div class="contact-address-text">
                                <span>Email Address</span>
                                <h4>
                                    @php
                                        $addressesArray = explode(',', companyInfo()->email);
                                        foreach ($addressesArray as $address) {
                                            echo trim($address) . "<br>";
                                        }
                                    @endphp
                                </h4>
                            </div>
                        </li>
                        <li>
                            <div class="contact-address-icon f-left mr-25">
                                <i class="far fa-clock"></i>
                            </div>
                            <div class="contact-address-text">
                                <span>Office Time</span>
                                <h4>Saturday - Thursday, <br> 09 AM - 06 PM</h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7" style="vertical-align: middle; margin: auto;">
                <div class="contact-img mb-30">
                    {{-- <img src="{{ asset('frontend/assets/img/bg/contact.jpg') }}" alt=""> --}}
                    <iframe class="map" src="{{ (companyInfo()->map) ? companyInfo()->map : "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.414983701532!2d90.4121684!3d23.7325767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b9001a46206b%3A0x28d6f2a89fabc31c!2sMedi%20world%20services!5e0!3m2!1sen!2sbd!4v1704396700603!5m2!1sen!2sbd"}}" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact-area-end -->

<!-- contact-area-start -->
<div class="contact-area pt-100 pb-100 grey-2-bg">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 offset-lg-3 offset-xl-3">
                <div class="section-title text-center mb-65">
                    <h2>Send Us A Message</h2>
                    <p>Please fill out the form on this section to contact with me.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <form id="contacts-form" class="contacts-form" action="{{ route('home.contact.sms.send') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="contacts-icon contactss-name">
                                <input type="text" required name="name" placeholder="Your Full Name ">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="contacts-icon contactss-email">
                                <input type="email" required name="email" placeholder="Your Email Address">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="contacts-icon contactss-website">
                                <input type="phone" required name="phone" placeholder="Your Phone">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="contacts-icon contactss-message">
                                <textarea name="message" required id="message" cols="30" rows="10" placeholder="Your Comments...."></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="contacts-form-button text-center">
                                <button class="c-btn" type="submit">
                                    send message <i class="far fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- contact-area-end -->
@endsection
