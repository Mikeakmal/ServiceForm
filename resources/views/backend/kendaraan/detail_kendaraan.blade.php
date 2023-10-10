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
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Detail Kendaraan</h6>

                <div style="text-align: right;">
                    <button type="submit" class="btn btn-primary mb-3">Cetak</button>
                </div>
                <div class="row mb-3">
                    <label for="nopol" class="col-sm-2 col-form-label">Nomor Polisi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nopol">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tglmasuk" class="col-sm-2 col-form-label">Tanggal Masuk Bengkel</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tglmasuk">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tglselesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tglselesai">
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Mekanik</th>
                                <th scope="col">Tanggal Dikerjakan</th>
                                <th scope="col">Sparepart</th>
                                <th scope="col">Keterangan Pengerjaan</th>
                                <th scope="col">Perbarui</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tbl_pengerjaan as $j)
                                <tr data-id="{{$j->id_pengerjaan}}">
                                    <th>{{ $loop->iteration }}</th>
                                    <td class="nama-mekanik">{{$j->nama_mekanik}}</td>
                                    <td>{{$j->tanggal_dikerjakan}}</td>
                                    <td>{{$j->sparepart}}</td>
                                    <td>{{$j->keterangan_pengerjaan}}</td>
                                    <td>
                                        <a href="/pengerjaan/{{$j->id_pengerjaan}}" id="edit-button" class="edit-button"><i class="fa fa-edit"> edit |</i></a>
                                        <a href="/listpengerjaan/{{$j->id_pengerjaan}}"><i class="fa fa-trash"> delete </i></a>
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
             
            </div>
        </div>        
    </div>

</div>
@endsection
