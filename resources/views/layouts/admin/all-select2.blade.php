<script>
    function category(){
        $.ajax({
            url: "{{ route('get.category') }}",
            dataType: 'json',
            success: function(data) {
                var html = '';
                $.each(data, function(index, value) {
                    html += '<option value="">Select</option>';
                    html += '<option value="' + value.id + '">' + value.category_name + '</option>';
                });
                $('#category_id').html(html);
            }
        });

        $("#category_id").select2({
            placeholder: "Select Category",
        });
    }
    function sub_category(cat_id){
        var url = "{{ route('get.subcategory', ':id') }}";
        url = url.replace(':id', cat_id);
        $.ajax({
            url: url,
            dataType: 'json',
            success: function(data) {
                var html = '';
                $.each(data, function(index, value) {
                    html += '<option value="">Select</option>';
                    html += '<option value="' + value.id + '">' + value.subcategory + '</option>';
                });
                $('#subcategory_id').html(html);
            }
        });

        $("#subcategory_id").select2({
            placeholder: "Select Sub Category",
        });
    }
    function brand(){
        $.ajax({
            url: "{{ route('get.brand') }}",
            dataType: 'json',
            success: function(data) {
                var html = '';
                $.each(data, function(index, value) {
                    html += '<option value="">Select</option>';
                    html += '<option value="' + value.id + '">' + value.name + '</option>';
                });
                $('#brand_id').html(html);
            }
        });

        $("#brand_id").select2({
            placeholder: "Select Brand",
        });
    }
    function origin(){
        $.ajax({
            url: "{{ route('get.origin') }}",
            dataType: 'json',
            success: function(data) {
                var html = '';
                $.each(data, function(index, value) {
                    html += '<option value="">Select</option>';
                    html += '<option value="' + value.id + '">' + value.name + '</option>';
                });
                $('#origin_id').html(html);
            }
        });

        $("#origin_id").select2({
            placeholder: "Select Origin",
        });
    }
    function country(){
        $.ajax({
            url: "{{ route('get.country') }}",
            dataType: 'json',
            success: function(data) {
                var html = '';
                $.each(data, function(code, name) {
                    html += '<option value="">Select</option>';
                    html += '<option value="' + name + '">' + name + '</option>';
                });
                $('#country').html(html);
            }
        });

        $("#country").select2({
            placeholder: "Select Country",
        });
    }
</script>
