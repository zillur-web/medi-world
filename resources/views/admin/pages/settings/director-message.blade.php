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
                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-header border-bottom bg-primary d-flex py-3">
                            <h5 class="card-title mb-0 text-white">Content</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.pages.director_message.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mt-3">
                                    <label for="image">Director Image</label>
                                    <input type="file" name="image" class="form-control" id="image">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="content">Content</label>
                                    <textarea name="content" id="content" class="form-control" rows="30" placeholder="Enter Director Content">{{ ($data->content) ? $data->content : '' }}</textarea>

                                    @error('content')
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
                $('#content').summernote({height: 500});
            });
        });
    </script>
@endpush
