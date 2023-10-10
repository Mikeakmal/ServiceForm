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
            
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

    <div class="col-12">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">List Barang</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nomor</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">No. Inventaris Peralatan</th>
                            <th scope="col">Lokasi Barang</th>
                            <th scope="col">Perbarui</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tbl_barang as $j)
                        <tr data-id="{{$j->id_barang}}">
                            <th>{{ $loop->iteration }}</th>
                            <td class="barang-selected">{{$j->nama_barang}}</td>
                            <td>{{$j->No_inventaris_peralatan}}</td>
                            <td>{{$j->lokasi_barang}}</td>
                            <td>
                                <a href="/tblbarang" id="edit-button" class="edit-button"><i class="fa fa-edit"> edit |</i></a>
                                <a href="/barang/{{$j->id_barang}}"><i class="fa fa-trash"> delete </i></a>
                            </td>
                          
                        </tr>

                        @endforeach 
                    </tbody>
                </table>
            </div>
            <div class=" form-floating ">
                 <button type="submit" class="btn btn-primary">Cetak</button>
            </div>  
        </div>
    </div>
    </div>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Form Barang</h6>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="barang"
                        placeholder="">
                    <label for="barang">Nama Barang</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inventaris"
                        placeholder="">
                    <label for="inventaris">No. Inventaris Peralatan</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="lokasi"
                        placeholder="">
                    <label for="lokasi">Lokasi</label>
                </div>
                <div class=" form-floating ">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>        
        </div>
    </div>
</div>

@endsection