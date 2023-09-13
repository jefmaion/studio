<!-- General JS Scripts -->
<script src="{{ asset('template/assets/js/app.min.js') }}"></script>
<!-- JS Libraies -->
@yield('scripts')
<!-- Page Specific JS File -->
{{-- <script src="{{ asset('template/assets/js/page/index.js') }}"></script> --}}
<!-- Template JS File -->
<script src="{{ asset('template/assets/js/scripts.js') }}"></script>
<!-- Custom JS File -->
<script src="{{ asset('template/assets/js/custom.js') }}"></script>

<script>
    // $("body").niceScroll();
    if($('.alert-message').length > 0) {
            $('.alert-message').delay(5000).fadeOut(500)
        }
</script>