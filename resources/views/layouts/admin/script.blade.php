<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('admin/assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('admin/assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('admin/assets/js/dashboards-analytics.js') }}"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Datatable js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs4/3.2.2/dataTables.bootstrap4.min.js" integrity="sha512-zjnVNy8zmH0JujmJgrADeEjpVIrafOQm2iQSbKk5dAiUBa18xYI2035PpojcvHKLKgDHPUdA3FoxneTC/RooGw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-buttons-bs4/2.4.2/buttons.bootstrap4.min.js" integrity="sha512-3EwIu+jBDO50pkMj6k/pqHekyr/iGJZ54pq5zCMNfVKd7bA/63igQWUqQItKVUMGrAfQz9yVjWj+HQFV8TRlNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ asset('admin/assets/js/summernote.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Choose one',
            searchInputPlaceholder: 'Search'
        });
        $('.select2-no-search').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Choose one'
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        $(document).on('select2:open', () => {
            console.log('Select2 opened');
            const searchField = document.querySelector('.select2-search__field');
            if (searchField) {
                console.log('Search field found');
                searchField.focus();
            } else {
                console.log('Search field not found');
            }
        });

    });
</script>
