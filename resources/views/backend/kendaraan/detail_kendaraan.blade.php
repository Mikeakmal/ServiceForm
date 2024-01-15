@extends('frontend.layout.main')
{{--  <!-- @section('title', 'List Kendaraan') -->  --}}
@section('content')
{{--  <!-- Navbar Start -->  --}}
    <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
        <a href="{{url('barang')}}" class="navbar-brand d-flex d-lg-none me-4">
            <h2 class="text-primary mb-0"><i class="fa fa-cogs me-2"></i> </h2>
        </a>
        <a href="#" class="sidebar-toggler flex-shrink-0">
            <i class="fa fa-bars"></i>
        </a>
        <form class="d-none d-md-flex ms-4" action="{{ url('list-pengerjaan-detail-search') }}" method="GET">
            @csrf
            @if (count($pengerjaan) > 0)
                <div class="input-group">
                    <input type="text" name="search2" class="form-control" 
                    placeholder="Search Mekanik or Sparepart" value="{{ Request::get('search2') }}">
                </div>
            @endif
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

{{--  LIST PENGERJAAN BERDASARKAN KENDARAAN  --}}
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="mb-0">Daftar Pengerjaan Kendaraan </h6> 
                        <div id="download-pdf" style="display: block;">
                            <form action="{{ url('list-detail-print', ['id' => $kendaraan->id_kendaraan]) }}" method="GET" id="pdf-form">
                                @csrf
                                <button type="submit" id="button-download-pdf" class="btn btn-outline-warning m-2" ><i class="fa fa-download me-2"></i>Unduh PDF</button>
                            </form>
                        </div>
                </div>
                {{--  table Kendaraan  --}}
                <input type="hidden" id="show-id" name="id_kendaraan" value="{{ $kendaraan->id_kendaraan }}">
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <table class="table table-borderless" style="width: 70%">
                            <thead>                                
                                <tr style="background-color: rgb(25, 28, 36)">
                                    <td>Nomor Polisi</td>
                                    <td>: {{ $kendaraan->no_polisi }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tanggal Masuk Bengkel</td>
                                    <td>: {{ $kendaraan->tanggal_masuk_bengkel }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Selesai</td>
                                    <td>: {{ $kendaraan->tanggal_selesai }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>   
                {{-- List Pengerjaan   --}}
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-header">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Mekanik</th>
                                <th scope="col">Tanggal Dikerjakan</th>
                                <th scope="col">Sparepart</th>
                                <th scope="col">Keterangan Pengerjaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengerjaan as $j)
                                <tr data-id="{{$j->id_pengerjaan}}">
                                    <th>{{ $loop->iteration }}</th>
                                    <td class="nama-mekanik">{{$j->nama_mekanik}}</td>
                                    <td>{{$j->tanggal_dikerjakan}}</td>
                                    <td>{{$j->sparepart}}</td>
                                    <td>{{$j->keterangan_pengerjaan}}</td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>   
    </div>
</div>


<script>
    {{--  search  --}}
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) { 

            searchInput.addEventListener("keydown", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault(); 
                    
                    const searchValue = searchInput.value;
                    
                    window.location.href = "{{ url('list-pengerjaan-search') }}?search2=" + searchValue;
                }
            });
        }
    });
</script>
        
@endsection
