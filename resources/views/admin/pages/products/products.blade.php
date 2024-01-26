@extends('layouts.admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header border-bottom bg-primary d-flex py-3">
            <div class="w-50 my-auto">
                <h5 class="card-title mb-0 text-white">{{ $pageTitle ?? 'N/A' }}</h5>
            </div>
            <div class="w-50 my-auto text-end">
                <a href="{{ route('product.create') }}" type="button" id="addBrandModalBtn" class=" btn btn-light px-2" style=""><i style="margin-top: -2px; margin-right: 4px;" class='bx bxs-plus-circle'></i> Add New</a>
            </div>
        </div>
        <div class="card-body pt-2">
            <div class="table-responsive">
                <table class="table table-bordered DataTable pt-3">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">SL</th>
                            <th class="text-left">Product Details</th>
                            <th class="text-center" style="width: 150px;">Image</th>
                            <th class="text-center" style="width: 50px;">Latest Product</th>
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
                        data: 'product',
                        name: 'product',
                        className: 'text-left',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'image',
                        name: 'image',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'latest_product',
                        name: 'latest_product',
                        className: 'text-center',
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

        // Delete
        function destroy(id){
            var url = "{{ route('product.destroy', ':id') }}";
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
                                    success_msg('Product Deleted Successfully.');
                                    $('.DataTable').DataTable().ajax.reload();
                                }
                            },
                            error: function(){
                                warning_msg('Product Not Found!');
                            }
                        });
                    }
             });
        }

        function product_index(id){
            var url = "{{ route('product.indexing', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    // if(data === 'data_have'){
                    //     warning_msg('There is some data here so it cannot be deleted.');
                    // }
                    // else{
                    //     success_msg('Product Deleted Successfully.');
                    //     $('.DataTable').DataTable().ajax.reload();
                    // }
                },
                error: function(){
                    warning_msg('Product Not Found!');
                }
            });
        }
    </script>
@endpush
