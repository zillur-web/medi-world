@extends('layouts.admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header border-bottom bg-primary d-flex py-3">
            <h5 class="card-title mb-0 text-white">{{ $pageTitle }}</h5>
        </div>
        <div class="card-body pt-2">
           <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="card">
                        <div class="card-header border-bottom bg-primary d-flex py-3">
                            <h5 class="card-title mb-0 text-white">Website Logo</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.logoUpdate') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mt-3">
                                    <label for="general_logo">General Logo (242*51px)</label>
                                    <input type="file" name="general_logo" id="general_logo" class="form-control @error('general_logo') is-invalid @enderror">

                                    @error('general_logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    @if ($company_info->general_logo != null)
                                        <div style="margin-right: 10px;" class="d-flex mt-2 general_logo">
                                            <div class="uploaded-img">
                                                <img src="{{ asset('uploads/system').'/'.$company_info->general_logo }}" alt="">
                                                <span class="img-remove" onclick="remove('general_logo', 'general_logo');">x</span>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <div class="form-group mt-3">
                                    <label for="white_logo">White Logo (242*51px)</label>
                                    <input type="file" name="white_logo" id="white_logo" class="form-control @error('white_logo') is-invalid @enderror">

                                    @error('white_logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    @if ($company_info->white_logo != null)
                                        <div style="margin-right: 10px;" class="d-flex mt-2 white_logo">
                                            <div class="uploaded-img" style="background: #333;">
                                                <img src="{{ asset('uploads/system').'/'.$company_info->white_logo }}" alt="">
                                                <span class="img-remove" onclick="remove('white_logo', 'white_logo');">x</span>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <div class="form-group mt-3">
                                    <label for="favicon">Fav Icon </label>
                                    <input type="file" name="favicon" id="favicon" class="form-control @error('favicon') is-invalid @enderror">

                                    @error('favicon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    @if ($company_info->favicon != null)
                                        <div style="margin-right: 10px;" class="d-flex mt-2 favicon">
                                            <div class="uploaded-img">
                                                <img src="{{ asset('uploads/system').'/'.$company_info->favicon }}" alt="">
                                                <span class="img-remove" onclick="remove('favicon', 'favicon');">x</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group mt-3">
                                    <label for="home_banner">Home Banner Logo (550*450px)</label>
                                    <input type="file" name="home_banner" id="home_banner" class="form-control @error('home_banner') is-invalid @enderror">

                                    @error('home_banner')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    @if ($company_info->home_banner != null)
                                        <div style="margin-right: 10px;" class="d-flex mt-2 home_banner">
                                            <div class="uploaded-img">
                                                <img src="{{ asset('uploads/system').'/'.$company_info->home_banner }}" alt="">
                                                <span class="img-remove" onclick="remove('home_banner', 'home_banner');">x</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mt-3 text-end">
                                    <button type="submit" class="text-right btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="card">
                        <div class="card-header border-bottom bg-primary d-flex py-3">
                            <h5 class="card-title mb-0 text-white">Website Meta Info</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.metaInfoSetting') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mt-3">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" name="meta_title" id="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ $company_info->meta_title }}">
                                    @error('meta_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-3">
                                    <label for="meta_des">Meta Description</label>
                                    <input type="text" name="meta_des" id="meta_des" class="form-control @error('meta_des') is-invalid @enderror" value="{{ $company_info->meta_des }}">
                                    @error('meta_des')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-3">
                                    <label for="meta_keywords">Meta Tags</label>
                                    <input type="text" name="meta_keywords" id="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" value="{{ $company_info->meta_keywords }}">
                                    @error('meta_keywords')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-3">
                                    <label for="meta_image">Meta Image</label>
                                    <input type="file" name="meta_image" id="meta_image" class="form-control @error('meta_image') is-invalid @enderror">

                                    @error('meta_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    @if ($company_info->meta_image != null)
                                        <div style="margin-right: 10px;" class="d-flex mt-2 meta_image">
                                            <div class="uploaded-img">
                                                <img src="{{ asset('uploads/system').'/'.$company_info->meta_image }}" alt="">
                                                <span class="img-remove" onclick="remove('meta_image', 'meta_image');">x</span>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <div class="form-group mt-3 text-end">
                                    <button type="submit" class="text-right btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="card">
                        <div class="card-header border-bottom bg-primary d-flex py-3">
                            <h5 class="card-title mb-0 text-white">General Information</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.genarelSetting') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mt-3">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" name="company_name" id="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ companyInfo()->company_name }}">

                                    @error('company_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mt-3">
                                    <label for="site_mettro">Site Metro</label>
                                    <input type="text" name="site_mettro" id="site_mettro" class="form-control @error('site_mettro') is-invalid @enderror" value="{{ companyInfo()->site_mettro }}">

                                    @error('site_mettro')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mt-3">
                                    <label for="address1">Address Line One</label>
                                    <input type="text" name="address1" id="address1" class="form-control @error('address') is-invalid @enderror" value="{{ explode('<br>', companyInfo()->address)[0] ?? '' }}">

                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mt-3">
                                    <label for="address2">Address Line Two</label>
                                    <input type="text" name="address2" id="address2" class="form-control @error('address') is-invalid @enderror" value="{{ explode('<br>', companyInfo()->address)[1] ?? '' }}">

                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="phone">Phone Number (Use ' , ' If you want to use multipe phone number )</label>
                                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ companyInfo()->phone }}">

                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="email">Email Address (Use ' , ' If you want to use multipe email address )</label>
                                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ companyInfo()->email }}">

                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="map">Google Map Embaded (Only URL)</label>
                                    <input type="text" name="map" id="map" class="form-control @error('map') is-invalid @enderror" value="{{ companyInfo()->map }}">

                                    @error('map')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="about_company">About Company</label>
                                    <textarea name="about_company" id="about_company" row="6" class="form-control @error('about_company') is-invalid @enderror">{{ companyInfo()->about_company }}</textarea>

                                    @error('about_company')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group mt-3 text-end">
                                    <button type="submit" class="text-right btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="card">
                        <div class="card-header border-bottom bg-primary d-flex py-3">
                            <h5 class="card-title mb-0 text-white">Socials Icon Settings</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.social.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group mt-3">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" name="facebook" id="facebook" class="form-control @error('facebook') is-invalid @enderror" placeholder="Enter Facebook Link" value="{{ socials()->facebook }}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" name="instagram" id="instagram" class="form-control @error('instagram') is-invalid @enderror" placeholder="Enter Instagram Link" value="{{ socials()->instagram }}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="linkedin">Linkedin</label>
                                    <input type="text" name="linkedin" id="linkedin" class="form-control @error('linkedin') is-invalid @enderror" placeholder="Enter Linkedin Link" value="{{ socials()->linkedin }}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="x">X (Twitter)</label>
                                    <input type="text" name="x" id="x" class="form-control @error('x') is-invalid @enderror" placeholder="Enter X Link" value="{{ socials()->x }}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address" value="{{ socials()->email }}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="phone">Phone</label>
                                    <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Phone Number" value="{{ socials()->phone }}">
                                </div>
                                <div class="form-group mt-3 text-end">
                                    <button type="submit" class="text-right btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-header border-bottom bg-primary d-flex py-3">
                            <h5 class="card-title mb-0 text-white">Privecy Policy</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.policySetting') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mt-3">
                                    <label for="policy">Privecy Policy</label>
                                    <textarea name="policy" id="policy" rows="10">{{ $company_info->policy }}</textarea>
                                </div>
                                <div class="form-group mt-3 text-end">
                                    <button type="submit" class="text-right btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
    <!--/ Responsive Table -->
</div>
@endsection

@push('scripts')
    <script>
        jQuery(function(e) {
            'use strict';
            $(document).ready(function() {
                $('#policy').summernote({height: 200});
            });
        });
    </script>
    <script>
        function remove(field_name, class_name){
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you remove this logo?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = '{{ route('settings.logo.remove', ':field_name') }}';
                    url = url.replace(':field_name', field_name);
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            $('.'+data).html('');
                        }
                    });

                }
            });
        }
    </script>
@endpush
