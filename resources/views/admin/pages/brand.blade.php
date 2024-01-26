@extends('layouts.admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header border-bottom bg-primary d-flex py-3">
            <div class="w-50 my-auto">
                <h5 class="card-title mb-0 text-white">Brand List</h5>
            </div>
            <div class="w-50 my-auto text-end">
                <button type="button" id="addBrandModalBtn" class=" btn btn-light px-2" style=""><i style="margin-top: -2px; margin-right: 4px;" class='bx bxs-plus-circle'></i> Add New</button>
            </div>
        </div>
        <div class="card-body pt-2">
            <div class="table-responsive">
                <table class="table table-bordered DataTable pt-3">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">SL</th>
                            <th class="text-left">Brand Name</th>
                            <th class="text-center" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Responsive Table -->
</div>
@include('admin.modals.add-brand')
@endsection

@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="carf-token"]').attr('content')
            }
        });

        $(function() {
            var dataTable;

            dataTable = $('.DataTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 100,
                dom: 'Bfrtip',
                buttons: [
                    // 'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print',
                    'reset'
                ],
                ajax: {
                    url: "{{ url()->current() }}",
                    data: function(d) {
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // Handle the error, e.g., display a message or take appropriate action
                        console.error("Error: " + textStatus, errorThrown);
                    },
                },

                columns: [
                    {
                        data: 'sl',
                        name: 'sl',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'brand',
                        name: 'brand',
                        className: 'text-left',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false
                    }

                ]

            });

        });

        $.fn.dataTable.ext.buttons.reset = {
            text: '<i class="fas fa-undo d-inline"></i> Reset' , action: function ( e, dt, node, config ) {
                dt.clear().draw();
                dt.ajax.reload();
            }
        };


        // Get Data For Edit
        function edit(id){
            var url = "{{ route('brand.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#brand_id').val(data.id);
                    $('#brand_name').val(data.name);
                    $('#addBrand').addClass('d-none');
                    $('#UpdateBrand').removeClass('d-none');
                    $('#addBrandModal').modal('show');
                }
            });
        }

        //  Update
        function UpdateBrand(){
            var data_id = $('#brand_id').val();
            var name = $('#brand_name').val();
            var formData2 = new FormData();
            formData2.append('id', data_id);
            formData2.append('name', name);
            formData2.append('_token', $('meta[name="csrf-token"]').attr('content'));

            var url = '{{ route('brand.update', ':id') }}';
            url = url.replace(':id', data_id);
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData2, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: url,
                success: function(res) {
                    BrandResetForm();
                    $('#brand_id').val('');
                    success_msg('Brand Update Successfully');
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

        // Delete
        function destroy(id){
            var url = "{{ route('brand.destroy', ':id') }}";
            url = url.replace(':id', id);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: url,
                            success: function(data) {
                                if(data === 'data_have'){
                                    warning_msg('There is some data here so it cannot be deleted.');
                                }
                                else{
                                    success_msg('Brand Deleted Successfully.');
                                    $('.DataTable').DataTable().ajax.reload();
                                }
                            },
                            error: function(){
                                warning_msg('Brand Not Found!');
                            }
                        });
                    }
             });
        }
    </script>
@endpush
