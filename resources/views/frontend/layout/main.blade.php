<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Service Form</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="{{ asset('assets/img/car1.ico') }}" rel="icon">

    {{--  <!-- Google Web Fonts -->  --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    {{--  <!-- Icon Font Stylesheet -->  --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    {{--  <!-- Libraries Stylesheet -->  --}}
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    {{--  <!-- Customized Bootstrap Stylesheet -->  --}}
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    {{--  <!-- Template Stylesheet -->  --}}
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    {{--  <!-- jQuery -->  --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    {{--  <!-- Select2 Stylesheet -->  --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    {{--  <!-- Select2 JavaScript -->  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
    
    <style>
            /* Mengubah warna ikon tanggal */
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1); 
            color: white; 
        }
    </style>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
		@include('frontend.layout.sidebar')
        <div class="content">
            @yield('content')
        </div>


        {{--  <!-- Back to Top -->  --}}
        <a href="#" class="btn btn-lg btn-warning btn-custom btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    {{--  <!-- JavaScript Libraries -->  --}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('') }}assets/lib/chart/chart.min.js"></script>
    <script src="{{ asset('') }}assets/lib/easing/easing.min.js"></script>
    <script src="{{ asset('') }}assets/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('') }}assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{ asset('') }}assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="{{ asset('') }}assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="{{ asset('') }}assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    {{--  <!-- Template Javascript -->  --}}
    <script src="{{ asset('') }}assets/js/main.js"></script>
</body>

</html>