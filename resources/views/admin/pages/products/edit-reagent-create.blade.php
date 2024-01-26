@extends('layouts.admin.app')

@section('content')
<style>
    table#product-extra-info tbody tr td {
        background: #f5f5f9;
        border: 1px solid #ddd;
        padding: 6px;
    }
    .note-dropdown-menu {
        z-index: 2222;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header border-bottom bg-primary d-flex py-3">
            <div class="w-50 my-auto">
                <h5 class="card-title mb-0 text-white">{{ $pageTitle ?? 'N/A' }}</h5>
            </div>
            <div class="w-50 my-auto text-end">
                <a href="{{ route('product.index') }}" type="button" class=" btn btn-light px-2" style=""><i style="margin-top: -2px; margin-right: 4px;" class='bx bx-list-ul'></i> Product List</a>
            </div>
        </div>
        <div class="card-body pt-2">
            <form action="{{ route('product.reagent.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mt-3">
                            <label for="title">Product Title <span class="text-danger"> *</span></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Product Title" value="{{ (old('title')) ? old('title') : $product->title }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group mt-3">
                            <label for="sub_title">Product Sub Title <span class="text-danger"> *</span></label>
                            <input type="text" name="sub_title" id="sub_title" class="form-control @error('sub_title') is-invalid @enderror" placeholder="Enter Product Sub Title" value="{{ (old('sub_title')) ? old('sub_title') : $product->sub_title }}">
                            @error('sub_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mt-3">
                            <label for="category_id">Product Categoy <span class="text-danger"> *</span></label>
                            <select name="category_id" id="category_id" class="form-control select2"></select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="subcategory_id">Product Sub Categoy <span class="text-dark">( Optional )</span></label>
                            <select name="subcategory_id" id="subcategory_id" class="form-control select2"></select>
                            @error('subcategory_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="thumbnail">Product Thumbnail <span class="text-danger">*</span></label>
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control" placeholder="Product Thumbnail">
                            @error('thumbnail')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            @if ($product->thumbnail != null)
                                <div class="thumbnail">
                                    <div class="uploaded-img"  style="min-height: 50px; vertical-align: middle;">
                                        <img style="min-height: 50px" src="https://png.pngtree.com/png-clipart/20220612/original/pngtree-pdf-file-icon-png-png-image_7965915.png" alt="">
                                        <span class="img-remove" onclick="removeFile('{{ $product->id }}', 'thumbnail', 'thumbnail');">x</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <textarea name="description" id="description">{{ (old('description')) ? old('description') : $product->description }}</textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/ Responsive Table -->
</div>
@endsection

@push('scripts')
    @include('layouts.admin.all-select2')
    <script>
        jQuery(function(e) {
            'use strict';
            $(document).ready(function() {
                $('#description').summernote({height: 200});
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            category();
            setTimeout(() => {
                $("#category_id").val('{{ $product->category_id }}').trigger('change');
                sub_category('{{ $product->category_id }}');
            }, 2000);

            setTimeout(() => {
                $("#subcategory_id").val('{{ $product->subcategory_id }}').trigger('change');
            }, 3500);
        });

        $('#category_id').change(function(){
            var cat_id =$('#category_id').val();
            sub_category(cat_id);
        });


        function removeFile(id, field_name, class_name){
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you remove this Image / Catalog?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = '{{ route('product.reagent.thumbnail.remove', ['id' => ':id', 'field_name' => ':field_name']) }}';
                    url = url.replace(':id', id);
                    url = url.replace(':field_name', field_name);

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            if(data != 'error'){
                                $('.'+data).html('');
                            }
                            else{
                                error_msg(+'Image Not Found.');
                            }
                        }
                    });

                }
            });
        }

    </script>
@endpush
