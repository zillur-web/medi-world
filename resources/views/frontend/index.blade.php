@extends('layouts.frontend.app')
@section('meta')
<title>{{ (companyInfo()->meta_title) ? companyInfo()->meta_title : '' }}</title>
    <meta name="description" content="{{ (companyInfo()->meta_des) ? companyInfo()->meta_des : '' }}">
    <meta name="tags" content="{{ (companyInfo()->meta_keywords) ? companyInfo()->meta_keywords : '' }}">

    <meta property="og:title" content="{{ (companyInfo()->meta_title) ? companyInfo()->meta_title : '' }}" />
    <meta property="og:description" content="{{ (companyInfo()->meta_des) ? companyInfo()->meta_des : '' }}" />
    <meta property="og:image" content="{{ (companyInfo()->meta_image) ? asset('uploads/system/'.companyInfo()->meta_image) : asset('frontend/assets/img/logo/medi-world.png') }}" />
@endsection
@section('content')
    <style>
        .product-img.pos-rel {
            background: #f8f8f8;
            padding: 4px;
            border-radius: 6px;
            cursor: pointer;
            color: #45556c;
        }
        .product-img.pos-rel button{
            border: none;
            border-radius: 4px;
            padding: 0px;
            vertical-align: middle;
            text-align: center;
            background: #f8f8f8;
            cursor: pointer;
        }
        .product-img.pos-rel button img{
            width: 100%;
            cursor: pointer;
        }
        .product-img.pos-rel h4{
            font-size: 14px;
            font-weight: 500;
        }
        .product-img.pos-rel:hover {
            box-shadow: 0 0.5rem 1rem rgb(78 151 253 / 23%) !important;
        }
        .product-img.pos-rel:hover button h4 {
            color: #3473cb;
            transition: 0.3s;
        }
        .product-img.pos-rel h4 {
            padding-top: 10px;
            font-size: 15px;
        }
        .product-02-wrapper {
            min-height: 324px;
            padding: 20px 5px;
        }
        .slider-img img {
            width: 100%;
        }

        .product-02-wrapper .product-02-img img{
            max-height: 180px;
        }

        @media (max-width: 991px){
            .hero-text{
                margin-top: 0;
                overflow: hidden;
                z-index: 12222;
                position: absolute;
                margin-top: -5px;
            }
            .slider-img{
                display: block !important;
            }
            .slider-img img {
                width: 100%;
                opacity: 0.3;
            }
            .hero-slider-caption p{
                color: #333;
            }
        }
        @media (max-width: 576px){
            .hero-text{
                margin-top: -5px;
            }

        }
    </style>
    <!-- hero-area start -->
    <section class="hero-area">
        <div class="hero-slider">
            <div class="slider-active">
                <div class="single-slider slider-height d-flex align-items-center"
                    data-background="{{ asset('frontend/assets/img/slider/01.jpg') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-6">
                                <div class="hero-text mt-90">
                                    <div class="hero-slider-caption ">
                                        <span data-animation="fadeInUp" data-delay=".2s"><i class="fas fa-badge-check mr-1"></i>Certified </span>
                                        <h2 data-animation="fadeInUp" data-delay=".4s">ISO CERTIFIED</h2>
                                        <p data-animation="fadeInUp" data-delay=".6s">Medical Equipment's Importer <br>& Supplier</p>
                                    </div>
                                    <div class="hero-slider-btn">
                                        <a data-animation="fadeInUp" data-delay=".8s" href="{{ route('home.contact') }}" class="c-btn">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-6">
                                <div class="slider-img d-none d-lg-block" data-animation="fadeInRight" data-delay=".8s">
                                    <img src="{{(companyInfo()->home_banner) ? asset('uploads/system/'.companyInfo()->home_banner) : asset('frontend/assets/img/banner/p83-s1-web-removebg-preview2.png') }}" alt="">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- hero-area end -->

    <!-- category-area-start -->
    <div class="product-area pb-20 pt-50 border-bottom">
        <div class="container">
            <div class="tab-border mb-60">
                <div class="row">
                    <div class="col-xl-7 col-lg-6">
                        <div class="section-title mb-20">
                            <h2>Product Categories</h2>
                            <p>Sed ut perspiciatis unde omnis iste natus error</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-tab-content">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            @forelse ($categories as $category)
                                <div class="col-xl-3 cl-lg-3 col-md-4 col-sm-4 col-6">
                                    <div class="product-wrapper text-center mb-30">
                                        <a href="{{ route('home.products') }}?category={{ $category->id }}">
                                            <div class="product-img pos-rel shadow">
                                                <button>
                                                    <img src="{{ ($category->image != null) ? asset('uploads/category/'.$category->image) : asset('frontend/assets/img/logo/fav.png') }}" alt="{{ $category->slug }}">
                                                    <h4 class="px-3" title="{{ $category->slug }}">{{ $category->category_name }}</h4>
                                                </button>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="col-xl-2 cl-lg-2 col-md-3 col-sm-3 col-4 text-center">
                                    No More Categories..
                                </div>
                            @endforelse
                        </div>
                        <div class="row">
                            <div class="col-12">
                                {!! $categories->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- category-area-end -->

    <!-- product-area-start -->
    <div class="product-area pb-70 pt-60">
        <div class="container">
            <div class="row mb-30 border-bottom">
                <div class="col-xl-7 col-lg-7 col-md-7">
                    <div class="section-title mb-30">
                        <h2>Latest Products</h2>
                        <p>Sed ut perspiciatis unde omnis iste natus error</p>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-5">
                    <div class="b-button shop-btn s-btn text-md-right mb-30">
                        <a href="{{ route('home.products') }}">view all product <i class="fal fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($latestProducts as $latestProduct)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="product-02-wrapper pos-rel text-center mb-30">
                            <div class="product-02-img pos-rel">
                                <a href="{{ route('home.product.view', ['id' => $latestProduct->id, 'slug' => $latestProduct->slug]) }}">
                                    <img src="{{ ($latestProduct->thumbnail != null) ? asset('uploads/product/'.$latestProduct->thumbnail) : asset('frontend/assets/img/logo/fav.png') }}" alt="{{ $latestProduct->slug }}">
                                </a>
                                <div class="product-action">
                                    <a class="action-btn" href="{{ route('home.product.view', ['id' => $latestProduct->id, 'slug' => $latestProduct->slug]) }}"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-text">
                                {{-- <h5 title="{{ $latestProduct->slug }}">{{ $latestProduct->category->category_name }}</h5> --}}
                                <h4><a href="{{ route('home.product.view', ['id' => $latestProduct->id, 'slug' => $latestProduct->slug]) }}"  title="{{ $latestProduct->slug }}">{{ substr($latestProduct->title, 0, 30) }}</a></h4>

                                <h5 title="{{ $latestProduct->slug }}" style="font-size: 18px;">{{ substr($latestProduct->sub_title, 0, 30) }}</h5>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-xl-3 col-lg-4 col-md-6 text-center">
                        No More Products..
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- product-area-end -->

    <!-- features-area-start -->
    <div class="features-area pt-60 pb-30 grey-2-bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="features-wrapper mb-30">
                        <div class="features-icon fe-1 f-left">
                            <i class="fal fa-ship"></i>
                        </div>
                        <div class="features-text">
                            <h3>100% Trusted</h3>
                            <p class="text-capitalize">honest, reliable, or dependable</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="features-wrapper mb-30">
                        <div class="features-icon fe-2 f-left">
                            <i class="fal fa-usd-circle"></i>
                        </div>
                        <div class="features-text">
                            <h3>Safe Partnership</h3>
                            <p class="text-capitalize">Long-term relationship, Communicate effectively, Helpful</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="features-wrapper mb-30">
                        <div class="features-icon fe-3 f-left">
                            <i class="fal fa-unlock-alt"></i>
                        </div>
                        <div class="features-text">
                            <h3>100% Secure</h3>
                            <p class="text-capitalize">Free from danger or harm and dependable</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- features-area-end -->

    <!-- brand-area-start -->
    <div class="brand-area pt-10 pb-0 grey-2-bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-3 col-6" style="vertical-align: middle; margin: auto;">
                    <div class="single-brand mb-60">
                        <img src="{{ asset('frontend/assets/img/brand/4023875-removebg-preview.png') }}" alt="">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-6" style="vertical-align: middle; margin: auto;">
                    <div class="single-brand mb-60">
                        <img src="{{ asset('frontend/assets/img/brand/aczojmx4g8fydlfqgklj-removebg-preview.png') }}" alt="">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-6" style="vertical-align: middle; margin: auto;">
                    <div class="single-brand mb-60">
                        <img src="{{ asset('frontend/assets/img/brand/bionet-logo-h-removebg-preview.png') }}" alt="">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-6" style="vertical-align: middle; margin: auto;">
                    <div class="single-brand mb-60">
                        <img src="{{ asset('frontend/assets/img/brand/cormay-logo-png-transparent-removebg-preview.png') }}" alt="">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-6" style="vertical-align: middle; margin: auto;">
                    <div class="single-brand mb-60">
                        <img src="{{ asset('frontend/assets/img/brand/download__2_-removebg-preview.png') }}" alt="">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-6" style="vertical-align: middle; margin: auto;">
                    <div class="single-brand mb-60">
                        <img src="{{ asset('frontend/assets/img/brand/download-removebg-preview (1).png') }}" alt="">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-6" style="vertical-align: middle; margin: auto;">
                    <div class="single-brand mb-60">
                        <img src="{{ asset('frontend/assets/img/brand/logo_rodape-removebg-preview.png') }}" alt="">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-6" style="vertical-align: middle; margin: auto;">
                    <div class="single-brand mb-60">
                        <img src="{{ asset('frontend/assets/img/brand/logo202108240902112879871-removebg-preview.png') }}" alt="">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-6" style="vertical-align: middle; margin: auto;">
                    <div class="single-brand mb-60">
                        <img src="{{ asset('frontend/assets/img/brand/mindray-removebg-preview.png') }}" alt="">
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-6" style="vertical-align: middle; margin: auto;">
                    <div class="single-brand mb-60">
                        <img src="{{ asset('frontend/assets/img/brand/sonoscape-1-removebg-preview.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand-area-end -->
@endsection
