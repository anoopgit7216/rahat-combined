</div>
<!-- END wrapper -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
<!-- Vendor -->
<script src="{{ asset('assets/libs/jquery/jquery.min.js')}}"></script>

<script src="{{ asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js')}}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

<!-- Apexcharts JS -->

<!-- Widgets Init Js -->
<!-- App js-->
<script src="{{ asset('assets/js/app.js')}}"></script>'
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>'
<script>
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if (session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif

    @if (session('info'))
        toastr.info("{{ session('info') }}");
    @endif

    @if ($errors->any())        
            toastr.error("{{ $errors->first() }}");     
    @endif
</script>
</body>

</html>