<!-- Modal -->
<div class="modal fade" id="addBrandModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary py-3">
                <h5 class="modal-title text-white" id="exampleModalLabel1">Add Brand</h5>
                <button type="button" class="btn-close brand_close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="brand_id">
                <div class="row">
                    <div class="col mb-3">
                        <label for="brand_name" class="form-label">Brand Name <span class="text-danger">*</span></label>
                        <input type="text" id="brand_name" name="brand_name" class="form-control" placeholder="Enter Brand Name"/>

                        <span class="text-danger brand_name_Error"></span>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="BrandFormSubmit" class="btn btn-warning" onclick="BrandResetForm();">Reset</button>
                        <button type="button" id="addBrand" class="btn btn-primary" onclick="addBrand();">Add</button>
                        <button type="button" id="UpdateBrand" class="btn btn-primary d-none" onclick="UpdateBrand();">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#addBrandModalBtn').click(function() {
            BrandResetForm();
            $('#addBrand').removeClass('d-none');
            $('#UpdateBrand').addClass('d-none');
            $('#addBrandModal').modal('show');
        });

        // Reset Data
        function BrandResetForm(){
            $('#brand_name').val('');

            $('.brand__Error').text('');
            $('#brand_name').removeClass('border-danger is-invalid');
        }

        // Brands Added
        function addBrand(){
            var brand_name = $('#brand_name').val();

            var formData = new FormData();
            formData.append('name', brand_name);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: "{{ route('brand.store') }}",
                success: function(res) {
                    BrandResetForm();
                    success_msg('Brand Added Successfully');
                    $('.brand_close').click();
                    $('.DataTable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    if (errors.name) {
                        $('.brand_name_Error').text(errors.name);
                        $('#brand_name').addClass('border-danger is-invalid');
                        $('#brand_name').focus();
                        error_msg(''+errors.name);
                    }
                }
            });

        }
    </script>
@endpush
