  <!-- header-start -->
  <style>
    .header-right {
        margin-top: 33px;
    }
    .logo a img{
        width: 220px;
    }
    .cat_menu_icon {
        margin: auto;
        padding: 5px 8px;
        border: 1px solid #4e97fd;
        margin-right: 0px;
        background: #4e97fd;
        border-radius: 2px;
    }
    .main-menu ul li a i {
        font-size: 14px;
        position: relative;
        left: 0px;
        top: 1px;
    }

    .cat_menu_icon i {
        font-size: 20px !important;
        color: #fff;
    }
    .category_lg_manu{
        display: flex;
    }
    .category_lg_manu_mobile{
        display: none;
    }
    .category_mobile_show{
        display: none;
    }
    .sdfdsf.logo{
        display: flex;
    }

    @media (max-width: 992px) {
        .m-logo{
            width: 100%;
            text-align: center;
        }
        .m-logo a img{
            margin-left: -64px;
            width: 175px;
        }
        .category_lg_manu, .category_lg_sub_manu{
            display: none;
        }
        .category_lg_manu_mobile{
            display: flex;
        }
        .category_mobile_show{
            display: block;
            vertical-align: middle;
            margin: auto;
            margin-left: 0px;
            width: 150px;
            margin-right: 0px;
        }
        .dropdown-toggle::after{
            display: none;
        }
    }
    @media (max-width: 400px){
        .m-logo a img {
            margin-left: -48px;
            width: 144px;
        }
    }
    .shop-menu ul li a {
        transition: 0.3s;
        font-size: 15px;
        font-weight: 600;
        color: #86888b;
        /* background: #4e97fd;
        border: 1px solid #4e97fd; */
        text-align: center;
        margin: auto;
        padding: 4px;
        border-radius: 50%;
    }

    .shop-menu ul li a i {
        font-size: 22px;
        padding: 3px 5px;
    }
    .shop-menu ul li {
        margin-left: 5px;
        display: inline-block;
        margin-top: 3px;
    }
    .shop-menu ul li a:hover {
        /* background: #ffffff;
        color: #4e97fd; */
    }

    /* .main-menu ul li .sub-menu {
        background: #ffffff none repeat scroll 0 0;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);
        left: 0;
        opacity: 1;
        position: absolute;
        top: 120%;
        transition: all 0.3s ease 0s;
        visibility: visible;
        width: 220px;
        z-index: 9;
        border-top: 3px solid #4e97fd;
        text-align: left;
        padding: 15px 0;
    } */

    .main-menu ul li .sub-menu {
        /* overflow-y: scroll; */
        width: 250px;
        /* opacity: 1;
        visibility: visible; */
        /* opacity: 1;
        visibility: visible; */
        /* opacity: 1;
        position: absolute;
        top: 120%;
        transition: all 0.3s ease 0s;
        visibility: visible; */
    }

    .sub-menu li ul.submenu {
        display: none;
        background: #fff;
        border-left: 2px solid #4e97fd;
        transition: 0.3s;
        left: 250px;
        position: absolute;
        top: 7px;
        width: 250px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);
        padding: 10px 0px;
    }

    .sub-menu li ul.submenu li {
        /* padding: 4px 2px;
        border: 1px; */
    }

    .sub-menu li ul.submenu li a {
        padding: 10px 10px 10px 16px;
        font-size: 14px;
        transition: 0.3s;
    }
    .sub-menu li ul.submenu li a:hover {
        color: #4e97fd;
        background: hsl(215deg 39.38% 83.36% / 39%);
    }


    .sub-menu li:hover ul.submenu {
        display: block;
        transition: 0.5s;
    }

    .category_mobile_show .dropdown-menu{
        min-width: 20rem;
    }

    .category_mobile_show .dropdown-menu ul.submenu {
        padding: 0px;
        border-left: 1px solid #5c9ffd;
        display: none;
    }

    .category_mobile_show .dropdown-menu ul.submenu li a {
        width: 100px;
        font-size: 15px;
    }

    .category_mobile_show .dropdown-menu ul.submenu li {
        width: 100% !important;
        background: #f9f9f9;
        padding: 5px 15px;
    }
    .category_mobile_show .dropdown-menu ul.submenu li:hover {
        background: #e7edf5;
    }
    .category_mobile_show ul.dropdown-menu li:hover ul.submenu {
        display: block;
    }
    .nav-arrow{
        position: absolute;
        right: 8px;
        margin-top: -27px;
        color: #9b9ba8;
        transition:0.3s;
    }
    .main-menu ul li .sub-menu li:hover .nav-arrow{
        color: #4e97fd !important;
    }

</style>
<header>
    <div class="header-top-area pl-165 pr-165">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="header-top-wrapper">
                        <div class="header-top-info d-none d-xl-block f-left">
                            <span><i class="fas fa-heart"></i> Welcome to {{ companyInfo()->company_name }}.</span>
                        </div>
                        <div class="header-link f-left">
                            <span><a href="tel:{{ explode(',', companyInfo()->phone)[0] }}"><i class="far fa-phone"></i> {{ explode(',', companyInfo()->phone)[0] }}</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="header-top-right text-md-right">
                        <div class="shop-menu">
                            <ul>
                                @if (socials()->email != NULL)
                                    <li><a href="mailto:{{ socials()->email }}"><i class="far fa-envelope" style="padding: 3px 2px;"></i></a></li>
                                @endif
                                @if (socials()->facebook != NULL)
                                    <li><a target="_blank" href="{{ socials()->facebook }}"><i class="fab fa-facebook-square"></i></a></li>
                                @endif
                                {{-- @if (socials()->instagram != NULL)
                                    <li><a target="_blank" href="{{ socials()->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                @endif
                                @if (socials()->linkedin != NULL)
                                    <li><a target="_blank" href="{{ socials()->linkedin }}"><i class="fab fa-linkedin"></i></a></li>
                                @endif
                                @if (socials()->x != NULL)
                                    <li><a target="_blank" href="{{ socials()->x }}"><i class="fab fa-twitter-square"></i></a></li>
                                @endif --}}

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="sticky-header" class="main-menu-area menu-01 pl-165 pr-165">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-3">
                    <div class="sdfdsf logo">
                        <div class="btn-group category_mobile_show">
                            {{-- <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                            </button> --}}
                            <div class="category_lg_manu_mobile w-100 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="cat_menu_icon" style="padding: 2px 7px; margin: auto; width: 40px; margin-right: 5px;">
                                    <i class="fal fa-bars" style="margin-top: 4px;"></i>
                                </div>
                                <div style="line-height: 18px; font-weight: 700; font-size: 14px;">
                                    <span>Product By Categories</span>
                                </div>
                            </div>
                            <ul class="dropdown-menu" style="border-top: 3px solid #4e97fd;">
                                @forelse (categories() as $cat)
                                    <li>
                                        <a class="dropdown-item" style="padding: 6px 22px; border-bottom: 1px solid #4e97fd66;" href="{{ route('home.products') }}?category={{ $cat->id }}">{{ $cat->category_name }}</a>
                                        @if ($cat->subcategory->count() > 0)
                                            <i class="fas fa-angle-right nav-arrow"></i>
                                            <ul class="submenu">
                                                @foreach ($cat->subcategory as $subcategory)
                                                    <li>
                                                        <a href="{{ route('home.products') }}?subcategory={{ $subcategory->id }}">{{ $subcategory->subcategory }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @empty
                                    <li>
                                        <a class="dropdown-item" href="{{ route('home') }}">No More..</a>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="m-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{(companyInfo()->general_logo) ? asset('uploads/system/'.companyInfo()->general_logo) : asset('frontend/assets/img/logo/medi-world.png') }}" alt=""/>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 d-none d-lg-block">

                    <div class="header-right f-right">
                        {{-- <div class="header-lang f-right pos-rel d-none d-md-none d-lg-block">
                            <div class="lang-icon">
                                <img src="{{ asset('frontend/assets/img/icon/flag.png') }}" alt="">
                                <a href="#"><i class="far fa-angle-down"></i></a>
                            </div>
                            <ul class="header-lang-list">
                                <li><a href="#">USA</a></li>
                                <li><a href="#">UK</a></li>
                                <li><a href="#">CA</a></li>
                                <li><a href="#">AU</a></li>
                            </ul>
                        </div> --}}
                        <div class="menu-bar info-bar f-right d-none d-md-none d-lg-block">
                            <a href="#"><i class="fal fa-bars"></i></a>
                        </div>
                        {{-- <div class="header-search f-right d-none d-xl-block">
                            <form class="header-search-form">
                                <input placeholder="Search" type="text">
                                <button type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div> --}}
                    </div>

                    <div class="main-menu">
                        <nav id="mobile-menu" class="main-menu-nav">
                            <ul style="text-align: right; padding-right: 60px;">
                                <li class="category_lg_sub_manu" style="width: 150px;">
                                    {{-- <i class="fal fa-bars"></i> Product By Categories --}}
                                    <a href="javascript:void(0);">
                                        <div class="category_lg_manu w-100">
                                            <div class="cat_menu_icon">
                                                <i class="fal fa-bars"></i>
                                            </div>
                                            <div style="text-align: left; padding-left: 6px;">
                                                Product By Categories
                                            </div>
                                        </div>
                                    </a>
                                    <ul class="sub-menu text-left">
                                        @forelse (categories() as $cat)
                                            <li>
                                                <a href="{{ route('home.products') }}?category={{ $cat->id }}">{{ $cat->category_name }}</a>
                                                @if ($cat->subcategory->count() > 0)
                                                    <i class="fas fa-angle-right nav-arrow"></i>
                                                    <ul class="submenu">
                                                        @foreach ($cat->subcategory as $subcategory)
                                                            <li>
                                                                <a href="{{ route('home.products') }}?subcategory={{ $subcategory->id }}">{{ $subcategory->subcategory }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @empty
                                            <li><a href="{{ route('home') }}">No More..</a></li>
                                        @endforelse

                                    </ul>

                                </li>
                                <li class="@if (Route::current()->getName() == 'home') active @endif">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li><a href="javascript:void(0);">About Us</a>
                                    <ul class="sub-menu text-left">
                                        <li>
                                            <a href="{{ route('home.aboutus') }}">About Us</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('home.director.message') }}">Message From Managing Director</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="@if (Route::current()->getName() == 'home.products') active @endif">
                                    <a href="{{ route('home.products') }}">Products</a>
                                </li>
                                <li class="@if (Route::current()->getName() == 'home.contact') active @endif">
                                    <a href="{{ route('home.contact') }}">Contact Us</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="extra-info">
        <div class="close-icon">
            <button>
                <i class="far fa-window-close"></i>
            </button>
        </div>
        <div class="logo-side mb-30">
            <a href="{{ route('home') }}">
                <img src="{{(companyInfo()->white_logo) ? asset('uploads/system/'.companyInfo()->white_logo) : asset('frontend/assets/img/logo/medi-world-white.png') }}" alt="" />
            </a>
        </div>
        <div class="side-info mb-30">
            <div class="contact-list mb-30">
                <h4>Office Address</h4>
                <p>{!! companyInfo()->address !!}</p>
            </div>
            <div class="contact-list mb-30">
                <h4>Phone Number</h4>
                <p>
                    @php
                        $phoneArray = explode(',', companyInfo()->phone);
                        foreach ($phoneArray as $phone) {
                            echo trim($phone) . "<br>";
                        }
                    @endphp
                </p>
            </div>
            <div class="contact-list mb-30">
                <h4>Email Address</h4>
                <p>
                    @php
                        $addressesArray = explode(',', companyInfo()->email);
                        foreach ($addressesArray as $address) {
                            echo trim($address) . "<br>";
                        }
                    @endphp
                </p>
            </div>
        </div>
        <div class="social-icon-right mt-20">
            @if (socials()->email != NULL)
                <a target="_blank" href="mailto:{{ socials()->email }}">
                    <i style="font-size: 22px;" class="far fa-envelope"></i>
                </a>
            @endif
            @if (socials()->facebook != NULL)
                <a target="_blank" href="{{ socials()->facebook }}">
                    <i style="font-size: 22px;" class="fab fa-facebook-square"></i>
                </a>
            @endif
            @if (socials()->instagram != NULL)
                <a target="_blank" href="{{ socials()->instagram }}">
                    <i style="font-size: 22px;" class="fab fa-instagram"></i>
                </a>
            @endif
            @if (socials()->linkedin != NULL)
                <a target="_blank" href="{{ socials()->linkedin }}">
                    <i style="font-size: 22px;" class="fab fa-linkedin"></i>
                </a>
            @endif
            @if (socials()->x != NULL)
                <a target="_blank" href="{{ socials()->x }}">
                    <i style="font-size: 22px;" class="fab fa-twitter-square"></i>
                </a>
            @endif

        </div>
    </div>

</header>
<!-- header-start -->
