<!-- Modernizer JS -->
<script src="{{ $web_assets }}/js/vendor/modernizr-3.11.7.min.js"></script>
<!-- jQuery JS -->
<script src="{{ $web_assets }}/js/vendor/jquery-v3.6.0.min.js"></script>
<!-- jquery migrate JS -->
<script src="{{ $web_assets }}/js/vendor/jquery-migrate-v3.3.2.min.js"></script>
<!-- Popper JS -->
<script src="{{ $web_assets }}/js/vendor/popper.js"></script>
<!-- Bootstrap JS -->
<script src="{{ $web_assets }}/js/vendor/bootstrap.min.js"></script>

<!-- Slick Slider JS -->
<script src="{{ $web_assets }}/js/plugins/countdown.js"></script>
<script src="{{ $web_assets }}/js/plugins/counterup.js"></script>
<script src="{{ $web_assets }}/js/plugins/instafeed.js"></script>
<script src="{{ $web_assets }}/js/plugins/jquery-ui.js"></script>
<script src="{{ $web_assets }}/js/plugins/jquery-ui-touch-punch.js"></script>
<script src="{{ $web_assets }}/js/plugins/magnific-popup.js"></script>
<script src="{{ $web_assets }}/js/plugins/owl-carousel.js"></script>
<script src="{{ $web_assets }}/js/plugins/scrollup.js"></script>
<script src="{{ $web_assets }}/js/plugins/waypoints.js"></script>
<script src="{{ $web_assets }}/js/plugins/wow.js"></script>
<script src="{{ $web_assets }}/js/plugins/slick.js"></script>
<script src="{{ $web_assets }}/js/plugins/elevatezoom.js"></script>
<script src="{{ $web_assets }}/js/plugins/sticky-sidebar.js"></script>
<script src="{{ $web_assets }}/js/plugins/ajax-mail.js"></script>
<!-- Main JS -->
<script src="{{ $web_assets }}/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
@livewireScripts
@yield("script")
@stack('scripts')
