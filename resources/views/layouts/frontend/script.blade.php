<!-- JS here -->
{{-- <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}
<script src="{{ asset('frontend/assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/slick.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.meanmenu.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/ajax-form.js') }}"></script>
<script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.appear.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.knob.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins.js') }}"></script>
<script src="{{ asset('frontend/assets/js/main.js') }}"></script>

<script src="https://cdn.ckeditor.com/4.23.0-lts/standard/ckeditor.js"></script>

<script>
    $(document).ready(function() {
    $('.submenu-toggle').click(function(e) {
        e.preventDefault();
        var $parentLi = $(this).parent('li');
        $parentLi.toggleClass('submenu-active');
    });
});
</script>


