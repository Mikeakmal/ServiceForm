@extends('frontend.layout.main')
@section('content')  
{{--  <!-- Navbar Start -->  --}}
<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="{{ asset('') }}assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex">{{ auth()->user()->name}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <form method="POST" action="{{ url('/logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Log Out</button>
                </form>                
            </div>
        </div>
    </div>
</nav>
{{--  <!-- Navbar End -->  --}}

        {{--  <!-- Sale & Revenue Start -->  --}}
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-line fa-3x text-warning"></i>
                        <div class="ms-3">
                            <p class="mb-2">Today</p>
                            <h6 class="mb-0">1234</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-bar fa-3x text-warning"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total</p>
                            <h6 class="mb-0">1234</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-area fa-3x text-warning"></i>
                        <div class="ms-3">
                            <p class="mb-2">Today </p>
                            <h6 class="mb-0">1234</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-pie fa-3x text-warning"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total </p>
                            <h6 class="mb-0">1234</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--  <!-- Sale & Revenue End -->  --}}
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-6 col-xl-3">

                </div>
            </div>
        </div>

   
        {{--  <!-- Footer Start -->  --}}
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary rounded-top p-4">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-start">
                        &copy; <a href="">the Company</a>, All Right Reserved. 
                    </div>
                    <div class="col-12 col-sm-6 text-center text-sm-end">
                        Designed By: Akmal</a>
                        <br>Distributed By: Mike</a>
                    </div>
                </div>
            </div>
        </div>
    {{--  </div>  --}}

@endsection
{{--  <!-- Content End -->  --}}