<!-- Modal -->
<div class="modal fade" id="addOriginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary py-3">
                <h5 class="modal-title text-white" id="exampleModalLabel1">Add Brand</h5>
                <button type="button" class="btn-close origin_close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="origin_id">
                <div class="row">
                    <div class="col mb-3">
                        <label for="origin_name" class="form-label">Origin Name <span class="text-danger">*</span></label>
                        <input type="text" id="origin_name" name="origin_name" class="form-control" placeholder="Enter Origin Name"/>

                        <span class="text-danger origin_name_Error"></span>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="OriginFormSubmit" class="btn btn-warning" onclick="OriginResetForm();">Reset</button>
                        <button type="button" id="addOrigin" class="btn btn-primary" onclick="addOrigin();">Add</button>
                        <button type="button" id="UpdateOrigin" class="btn btn-primary d-none" onclick="UpdateOrigin();">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#addOriginModalBtn').click(function() {
            OriginResetForm();
            $('#addOrigin').removeClass('d-none');
            $('#UpdateOrigin').addClass('d-none');
            $('#addOriginModal').modal('show');
        });

        // Reset Data
        function OriginResetForm(){
            $('#origin_name').val('');

            $('.origin_name_Error').text('');
            $('#origin_name').removeClass('border-danger is-invalid');
        }

        // Brands Added
        function addOrigin(){
            var origin_name = $('#origin_name').val();

            var formData = new FormData();
            formData.append('name', origin_name);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: "{{ route('origin.store') }}",
                success: function(res) {
                    OriginResetForm();
                    success_msg('Origin Added Successfully');
                    $('.origin_close').click();
                    $('.DataTable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    if (errors.name) {
                        $('.origin_name_Error').text(errors.name);
                        $('#origin_name').addClass('border-danger is-invalid');
                        $('#origin_name').focus();
                        error_msg(''+errors.name);
                    }
                }
            });

        }
    </script>
@endpush
