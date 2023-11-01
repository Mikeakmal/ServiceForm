<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Service Form</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    {{--  <!-- Favicon -->  --}}
    <link href="img/favicon.ico" rel="icon">

    {{--  <!-- Google Web Fonts -->  --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    {{--  <!-- Icon Font Stylesheet -->  --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    {{--  <!-- Libraries Stylesheet -->  --}}
    <link href="{{ asset('') }}assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    {{--  <!-- Customized Bootstrap Stylesheet -->  --}}
    <link href="{{ asset('') }}assets/css/bootstrap.min.css" rel="stylesheet">

    {{--  <!-- Template Stylesheet -->  --}}
    <link href="{{ asset('') }}assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
       {{--  // <!-- Spinner End -->  --}}

{{--  REGISTER FORM  --}}
            <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h3>Register</h3>
                            </div>
                            <form method="POST" action="{{url('/addregister')}}"  id="form-register" >
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" class="form-control @error('name') 
                                    is-invalid @enderror" id="name" placeholder="username" value="{{ old('name')}}" required>
                                    <label for="name">Username</label>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email')
                                    is-invalid @enderror" name="email" id="email" placeholder="example@gmail.com" value="{{ old('email')}}" required>
                                    <label for="email">Alamat Email</label>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="password" required>
                                    <label for="password">Password</label>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-warning btn-custom py-3 w-100 mb-4">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>

  //  {{--  <!-- JavaScript Libraries -->  --}}
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('') }}assets/lib/chart/chart.min.js"></script>
  <script src="{{ asset('') }}assets/lib/easing/easing.min.js"></script>
  <script src="{{ asset('') }}assets/lib/waypoints/waypoints.min.js"></script>
  <script src="{{ asset('') }}assets/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="{{ asset('') }}assets/lib/tempusdominus/js/moment.min.js"></script>
  <script src="{{ asset('') }}assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
  <script src="{{ asset('') }}assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

  //  <!-- Template Javascript -->
  <script src="{{ asset('') }}assets/js/main.js"></script>
</body>

</html>