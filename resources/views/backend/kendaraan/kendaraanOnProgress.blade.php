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
        <form action="{{ url('list-onprogress-search') }}" method="GET" class="d-md-flex ms-4">
            @csrf
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search Nomor Polisi" value="{{ Request::get('search') }}">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </form>        
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

    {{--  LIST KENDARAAN  --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="mb-0">Daftar Kendaraan On Progress </h6> 
                    </div>
                    {{--  LIST KENDARAAN  --}}
                    <div class="table-responsive">
                        @if ($kendaraan !== null && count($kendaraan) > 0)
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">No. Polisi</th>
                                        <th scope="col">Tanggal Masuk Bengkel</th>
                                        <th scope="col">Tanggal Selesai</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kendaraan as $j)
                                        <tr data-id="{{$j->id_kendaraan}}">
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{$j->no_polisi}}</td>
                                            <td>{{$j->tanggal_masuk_bengkel}}</td>
                                            <td>{{$j->tanggal_selesai}}</td>
                                            <td class="{{ $j->tanggal_selesai === null ? 'on-progress-text' : 'finish-text' }}">
                                                {{ $j->tanggal_selesai === null ? 'ON PROGRESS' : 'FINISH' }}
                                            </td>
                                        </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        @else
                            <p>No data available.</p>
                        @endif
                    </div>                    
                </div>
            </div>
        </div>
    </div>
@endsection