    <!-- JS Files-->
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ url('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!--plugins-->
    <script src="{{ url('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('assets/plugins/chartjs/chart.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ url('assets/plugins/notifications/js/notifications.min.js') }}"></script>
    @if (auth()->user())
        {{-- <script src="assets/js/index3.js"></script> --}}
        <!-- Main JS-->
        <script src="{{ url('assets/js/main.js') }}"></script>
    @endif
