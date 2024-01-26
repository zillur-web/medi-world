<script defer src="https://cdn.jsdelivr.net/npm/@flasher/flasher@1.2.4/dist/flasher.min.js"></script>
@if (session()->has('success'))
    {{ session()->get('success') }}
@endif
@if (session()->has('error'))
    {{ session()->get('error') }}
@endif


<script>
    function error_msg(mes) {
        flasher.error(mes);
    }
    function warning_msg(mes) {
        flasher.warning(mes);
    }
    function success_msg(mes) {
        flasher.success(mes);
    }
    function info_msg(mes) {
        flasher.info(mes);
    }
</script>
