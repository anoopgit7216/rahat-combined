<!-- END wrapper -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
<!-- Vendor -->
<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>

<!-- Apexcharts JS -->

<!-- Widgets Init Js -->
<!-- App js-->
<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
    // Bar Chart
    const ctxBar = document.getElementById('barChart');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                    label: 'Road',
                    data: [5, 12, 10, 19, 25, 22],
                    backgroundColor: '#22c55e'
                },
                {
                    label: 'Water',
                    data: [8, 9, 15, 10, 18, 20],
                    backgroundColor: '#f97316'
                },
                {
                    label: 'Alerts',
                    data: [4, 6, 7, 8, 9, 10],
                    backgroundColor: '#ef4444'
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 7
                    }
                }
            }
        }
    });

    // Doughnut Chart
    const ctxDoughnut = document.getElementById('doughnutChart');
    new Chart(ctxDoughnut, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'In Progress', 'Delayed'],
            datasets: [{
                label: 'Status',
                data: [45, 35, 20],
                backgroundColor: ['#22c55e', '#f97316', '#ef4444'],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

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
