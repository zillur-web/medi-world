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
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
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
                    <div class="col-lg-6 col-sm-6 col-12">
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
                                    <label for="brand_id">Product Brand <span class="text-dark">( Optional )</span></label>
                                    <select name="brand_id" id="brand_id" class="form-control select2"></select>
                                    @error('brand_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="origin_id">Product Origin <span class="text-dark">( Optional )</span></label>
                                    <select name="origin_id" id="origin_id" class="form-control select2"></select>
                                    @error('origin_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="country">Made In <span class="text-dark">( Optional )</span></label>
                                    <select name="country" id="country" class="form-control select2"></select>
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mt-3">
                                    <label for="thumbnail">Product Thumbnail <span class="text-danger">*</span></label>
                                    <input type="file" name="thumbnail" id="thumbnail" class="form-control" placeholder="Product Thumbnail">
                                    @error('thumbnail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    @if ($product->thumbnail != null)
                                        <div class="thumbnail">
                                            <div class="uploaded-img"  style="min-height: 50px; vertical-align: middle;">
                                                <img style="min-height: 50px" src="{{ asset('uploads/product').'/'.$product->thumbnail }}" alt="">
                                                <span class="img-remove" onclick="removeFile('{{ $product->id }}', 'thumbnail', 'thumbnail');">x</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mt-3">
                                    <label for="featured_image">Product Featured Images<span class="text-dark">( Optional )</span></label>
                                    <input type="file" name="featured_image[]" id="featured_image" class="form-control" placeholder="Product Thumbnail" multiple>
                                    @error('featured_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    @if ($product->featuredImages)
                                        <div class="d-flex">
                                            @foreach ($product->featuredImages as $image)
                                                <div class="featuredImages_{{ $image->id }} mr-3">
                                                    <div class="uploaded-img"  style="min-height: 50px; vertical-align: middle;">
                                                        <img style="min-height: 50px" src="{{ asset('uploads/product').'/'.$image->image }}" alt="">
                                                        <span class="img-remove" onclick="featuredImageRemove({{ $image->id }},'featuredImages_{{ $image->id }}');">x</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mt-3">
                                    <label for="catalog">Uplad Product Catalog <span class="text-dark">( Optional )</span></label>
                                    <input type="file" name="catalog" id="catalog" class="form-control" placeholder="Upload Product Catalog">
                                    @error('catalog')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    @if ($product->catalog != null)
                                        <div class="catalog">
                                            <div class="uploaded-img"  style="min-height: 50px; vertical-align: middle;">
                                                <img style="min-height: 50px" src="{{ asset('uploads/catalog').'/'.$product->catalog }}" alt="">
                                                <span class="img-remove" onclick="removeFile('{{ $product->id }}', 'catalog', 'catalog');">x</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mt-3 mb-0 pb-2 border-bottom">
                                    <label for="">Product Extra Information <span class="text-dark">( Optional )</span></label>
                                </div>
                            </div>
                            <div class="col-12">
                                {{-- <div class="form-group w-100" style="border: 1px solid #a3afbb; border-radius: 4px; padding: 4px;">
                                    <div style="width: 40px;" class="text-center">1</div>
                                    <div class="text-center">1</div>
                                    <div style="width: 40px;" class="text-center">1</div>
                                </div> --}}
                                <table class="table table-borderd" id="product-extra-info">
                                    <tbody>
                                        @foreach ($product->product_info as $key => $info)
                                            <tr>
                                                <td class="text-center" style="width: 50%;"><input required type="text" class="form-control info_title" placeholder="Info Title" name="info_title[]" value="{{ $info->info_title }}"></td>

                                                <td class="text-center" style="width: 50%;"><input required type="text" class="form-control info_details" placeholder="Info Details" name="info_details[]"  value="{{ $info->info_details }}"></td>

                                                <td class="text-center" style="width: 40px;"><input type="hidden" name="info_id[]" value="{{ $info->id }}"> <input type="hidden" name="row_id[]" value="{{ ++$key }}"> <button type="button" class="btn btn-sm btn-danger p-1 px-2 delete-row" onclick="infoRemove({{ $info->id }});">X</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="button" class="btn btn-sm btn-primary" onclick="addInfo();">Add New</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-3">
                        <textarea name="description" id="description">{{ (old('description')) ? old('description') : $product->description }}</textarea>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" name="policy" type="checkbox" id="privacy_policy" @if ($product->policy == App\Helpers\Constant::POLICY_STATUS['active']) checked @endif />
                            <label class="form-check-label" for="privacy_policy">Privacy Policy</label>
                        </div>
                    </div>
                    <div class="col-12 mt-1 d-none">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" name="terms" type="checkbox" id="terms" @if ($product->terms == App\Helpers\Constant::TERMS_STATUS['active']) checked @endif />
                            <label class="form-check-label" for="terms">Terms Of Service</label>
                        </div>
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
        $(document).ready(function () {
            category();
            brand();
            origin();
            country();
            setTimeout(() => {
                $("#category_id").val('{{ $product->category_id }}').trigger('change');
                $("#brand_id").val('{{ $product->brand_id }}').trigger('change');
                $("#origin_id").val('{{ $product->origin_id }}').trigger('change');
                $("#country").val('{{ $product->country }}').trigger('change');
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

        jQuery(function(e) {
            'use strict';
            $(document).ready(function() {
                $('#description').summernote({height: 200});
            });
        });

        $(document).on("click", ".delete-row", function() {
            var row = $(this).closest("tr");
            var rowId = row.find("input[name='row_id']").val();
            row.remove();
            success_msg('Product Extra Information Item Removed.');
        });

        function infoRemove(id){
            var url = "{{ route('product.info.item', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    // success_msg('Product Extra Information Item Removed.');

                },
                error: function(){
                    warning_msg('Product Not Found!');
                }
            });
        }

        function addInfo(){
            var rowCount = $("#product-extra-info tbody tr").length + 1; // initial row index number
            var newRow = $(
                '<tr>' +

                '<td class="text-center" style="width: 50%;"><input required type="text" class="form-control info_title" placeholder="Info Title" name="info_title[]"></td>' +

                '<td class="text-center" style="width: 50%;"><input required type="text" class="form-control info_details" placeholder="Info Details" name="info_details[]"></td>' +

                '<td class="text-center" style="width: 40px;"><input type="hidden" name="row_id[]" value="'+ rowCount +'"><button type="button" class="btn btn-sm btn-danger p-1 px-2 delete-row">X</button></td>' +

                '</tr>'
            );
            $("#product-extra-info tbody").append(newRow);
        }

        function featuredImageRemove(id, class_name){
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you remove this featured Image?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = '{{ route('product.feature.image.remove', ':id') }}';
                    url = url.replace(':id', id);
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            $('.'+class_name).html('');
                        }
                    });

                }
            });
        }

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
                    var url = '{{ route('product.thumbnail.image.remove', ['id' => ':id', 'field_name' => ':field_name']) }}';
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
