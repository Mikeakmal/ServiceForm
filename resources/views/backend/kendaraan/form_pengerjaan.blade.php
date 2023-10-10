@extends('frontend.layout.main')
@section('content')
            {{--  <!-- Navbar Start -->  --}}
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                {{--  <a href="index.html" class="navbar-brand mx-15 mb-15">
                    <h3 class="text-primary">Service Form</h3>
                </a>  --}}
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-3">
                    <h2 class="text-primary mb-15"><i class="fa fa-user-edit"></i></h2>
                </a>
                
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                 
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{ asset('') }}assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">Mike Akmal</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            {{--  <!-- Navbar End -->  --}}


      <form action="{{url('s')}}"></form> 
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Form Pengerjaan</h6>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect"
                        aria-label="Floating label select example">
                        <option selected></option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <label for="floatingSelect">Nomor Polisi</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="tglmasuk"
                        placeholder="">
                    <label for="tglmasuk">Tanggal Masuk Bengkel</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="mekanik"
                        placeholder="">
                    <label for="mekanik">Nama Mekanik</label>
                </div>  
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="tglkerja"
                        placeholder="">
                    <label for="tglkerja">Tanggal Dikerjakan</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="sparepart"
                        placeholder="">
                    <label for="sparepart">Sparepart</label>
                </div>  
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Keterangan Pengerjaan"
                        id="pengerjaan" style="height: 150px;"></textarea>
                    <label for="pengerjaan">Keterangan Pengerjaan</label>
                </div>
                <div class=" form-floating ">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>        
        </div>
    </div>
</div>


@endsection