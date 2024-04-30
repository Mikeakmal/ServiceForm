@extends('frontend.layout.main')
@section('content')
    {{--  <!-- Navbar Start -->  --}}
    <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
        <a href="{{url('barang')}}" class="navbar-brand d-flex d-lg-none me-4">
            <h2 class="text-primary mb-0"><i class="fa fa-cogs me-2"></i> </h2>
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
                <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0 ">
                    <form method="POST" action="{{ url('/logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-black">Log Out
                            <i class="fas fa-sign-out-alt" style="margin-left: 10px;"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    {{--  <!-- Navbar End -->  --}}


    <style>
        .table-header th {
            background-color: rgb(25, 28, 36); 
            color: rgb(108, 114, 147);
        }
    </style>

    {{--  LIST KENDARAAN  --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="mb-0">Daftar Kendaraan On Progress </h6> 
                    </div>
                    {{--  LIST KENDARAAN  --}}
                    <form action="{{ route('kendaraan.update') }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table id="example" class="table display" cellspacing="0" width="100%">
                                <thead class="table-header">
                                    <tr>
                                        <th></th>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nomor Polisi</th>
                                        <th scope="col">Tanggal Masuk Bengkel</th>
                                        <th scope="col">Tanggal Selesai</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kendaraan as $j)
                                        <tr data-id="{{$j->id_kendaraan}}">
                                            <th></th>
                                            <th>{{ $loop->iteration }}</th>
                                            <td class="no_polisi" >{{$j->no_polisi}}</td>
                                            <td class="tanggal_masuk_bengkel" width="18%" >{{$j->tanggal_masuk_bengkel}}</td>
                                            <td class="tanggal_selesai" width="18%" >{{$j->tanggal_selesai}}</td>
                                            <td>
                                                <a href="#"data-id="{{$j->id_kendaraan}}" title="Perbarui">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ url('/kendaraan/' . $j->id_kendaraan) }}" class="delete-button" 
                                                    onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                            <nav aria-label="...">
                                <ul class="pagination pagination-sm justify-content-end">
                                  @for ($i = 1; $i <= $kendaraan->lastPage(); $i++)
                                      <li class="page-item {{ ($kendaraan->currentPage() == $i) ? 'active' : '' }}">
                                          <a class="page-link" href="{{ $kendaraan->url($i) }}">{{ $i }}</a>
                                      </li>
                                  @endfor
                                </ul>
                            </nav>
                        </div>                  
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#example .no_polisi, #example .tanggal_masuk_bengkel, #example .tanggal_selesai').editable();
        });
    </script>
@endsection