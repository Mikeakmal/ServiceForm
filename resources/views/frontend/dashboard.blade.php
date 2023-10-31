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
<style>

    .label {
        color: rgb(255, 111, 0); /* Warna asli */
        transition: color 0.3s; /* Animasi perubahan warna */
    
    }
    
    .label:hover {
        color: rgb(255, 193, 7); /* Warna saat hover */
    }
    
</style>

<div class="container-fluid pt-4 px-4" id="list-peralatan">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="display-6 mb-0">PT. SATRIA UTAMA</h1>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-md-2 col-xl-6">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0 ">Kendaraan ON PROGRESS</h6>
                    <a href="{{url('kendaraan')}}" class="label">Show All</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">No. Polisi</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($kendaraanOnprogress as $j)
                                <tr data-id="{{$j->id_kendaraan}}">
                                    <th>{{ $loop->iteration }}</th>
                                    <td class="nopol-selected">{{$j->no_polisi}}</td>
                                    <td class="status-selected @if ($j->tanggal_selesai === null) on-progress-text @else finish-text @endif">
                                        {{ $j->tanggal_selesai === null ? 'ON PROGRESS' : 'FINISH' }}
                                    </td>
                                </tr>
                            @endforeach 
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-12 col-md-2 col-xl-6">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Peralatan RUSAK</h6>
                    <a href="{{url('peralatan')}}" class="label">Show All</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Inventaris</th>
                            <th scope="col">Karyawan</th>
                            <th scope="col">Kondisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($dataRusak as $j) 
                                <tr data-id="{{$j->id_peralatan}}" data-id_barang="{{$j->id_barang}}">
                                    <th>{{ $loop->iteration }}</th>
                                    <td class="inv-selected">{{ $noinventaris[$j->id_barang] }}</td>
                                    <td class="nama-karyawan-selected">{{$j->nama_karyawan}}</td>
                                    <td class="kondisibarang-selected">{{ $kondisibarang[$j->id_barang] }}</td>
                                </tr>
                            @endforeach             
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    {{--  <!-- Footer Start -->  --}}
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded-top p-4">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-start">
                    {{--  &copy; <a href="">PT.SATRIA UTAMA</a>, All Right Reserved.   --}}
                </div>
                <div class="col-12 col-sm-6 text-center text-sm-end">
                    {{--  <br>Distributed By: PT.SATRIA UTAMA</a>  --}}
                </div>
            </div>
        </div>
    </div>

@endsection
{{--  <!-- Content End -->  --}}