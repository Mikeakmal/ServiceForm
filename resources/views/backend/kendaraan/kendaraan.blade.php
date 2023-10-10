@extends('frontend.layout.main')
{{--  <!-- @section('title', 'List Kendaraan') -->  --}}
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



<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">List Kendaraan</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">No. Polisi</th>
                                <th scope="col">Tanggal Masuk Bengkel</th>
                                <th scope="col">Tanggal Selesai</th>
                                <th scope="col">Perbarui</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tbl_kendaraan as $j)
                            <tr data-id="{{$j->id_kendaraan}}">
                                <th>{{ $loop->iteration }}</th>
                                <td class="nopol-selected">{{$j->no_polisi}}</td>
                                <td>{{$j->tanggal_masuk_bengkel}}</td>
                                <td>{{$j->tanggal_selesai}}</td>
                                <td>
                                    <a href="/formkendaraan/{{$j->id_kendaraan}}" id="edit-button" class="edit-button"><i class="fa fa-edit"> edit |</i></a>
                                    <a href="/kendaraan/{{$j->id_kendaraan}}"><i class="fa fa-trash"> delete </i></a>
                                </td>
                              
                            </tr>

                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
{{--  //form edit kendaraan  --}}
        <form action="{{url('/addkendaraan')}}" method="POST">
            @csrf
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Form Edit Kendaraan</h6>
                    <div class="form-floating mb-3">
                        <input name="nopol" type="text" class="form-control" id="no-pol"
                            placeholder="">
                        <label for="no-pol">Nomor Polisi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="tglmasuk" type="date" class="form-control" id="tgl-masuk"
                            placeholder="">
                        <label for="tgl-masuk">Tanggal Masuk Bengkel</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="tglselesai" type="date" class="form-control" id="tgl-selesai"
                            placeholder="">
                        <label for="tgl-selesai">Tanggal Selesai</label>
                    </div>
                    <div class=" form-floating ">
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </div>        
            </div>
        </form>

{{--  // form tambah kendaraan  --}}
        <form action="{{url('/addkendaraan')}}" method="POST">
            @csrf
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Form Kendaraan</h6>
                    <div class="form-floating mb-3">
                        <input name="nopol" type="text" class="form-control" id="nopol"
                            placeholder="">
                        <label for="nopol">Nomor Polisi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="tglmasuk" type="date" class="form-control" id="tglmasuk"
                            placeholder="">
                        <label for="tglmasuk">Tanggal Masuk Bengkel</label>
                    </div>
                    {{--  <div class="form-floating mb-3">
                        <input name="tglselesai" type="date" class="form-control" id="tglselesai"
                            placeholder="">
                        <label for="tglselesai">Tanggal Selesai</label>
                    </div>  --}}
                    
                    <div class=" form-floating ">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>        
            </div>
        </form>
        
    </div>
</div>
@endsection
