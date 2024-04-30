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
        <div class="d-none d-md-flex ms-4">
            @if (count($peralatan) > 0)
                <form action="{{ url('list-peralatan-search') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" 
                        placeholder="Search..." value="{{ Request::get('search') }}">
                    </div>
                </form>
            @endif
        </div>
        <div class="navbar-nav align-items-center ms-auto">
            <a href="#" class="nav-link" id="history-list-button">
                <i class="fa fa-history me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">History</span>
            </a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img class="rounded-circle me-lg-2" src="{{ asset('') }}assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <span class="d-none d-lg-inline-flex">{{ auth()->user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
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



{{--  LIST HISTORY PERALATAN  --}}
<div class="container-fluid pt-4 px-4" id="history-list" style="display: none; position: relative;" >
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div id="download-pdf" style="display: block;">
                        <form action="{{ url('/peralatan/cetakPertanggal') }}" method="POST" id="pdf-form">
                            @csrf
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">History Peralatan Rusak </h6>
                                    <br> 
                                    <div class="row dateselect">
                                        <div class="col-sm-6">
                                            <div class="row mb-3">
                                                <label for="label">Dari Tanggal :</label>
                                                <div class="col-sm-12">
                                                    <input id="dari_tanggal" name="dari_tanggal" type="date" class="form-control" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row mb-3">
                                                <label for="label">Sampai Tanggal : </label>
                                                <div class="col-sm-12">
                                                    <input id="sampai_tanggal" name="sampai_tanggal" type="date" class="form-control" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-50 text-end" style="margin-left: 20cm; margin-top: 1.5cm;">
                                    <button type="submit" id="button-download-pdf" class="btn btn-outline-warning">
                                      <i class="fa fa-download"></i> Unduh PDF
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table tblHistory" id="tbl-History">
                        <thead class="table-header">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Merek</th>
                                <th scope="col">No. Inventaris Peralatan</th>
                                <th scope="col">Nama Karyawan</th>
                                <th scope="col">Alat Rusak</th>
                                <th scope="col">Tanggal Diperbaiki</th>
                                <th scope="col">Nama Teknisi</th>
                                <th scope="col">Kondisi</th>
                                <th scope="col">Diperbarui </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peralatan as $j) 
                                <tr data-id="{{$j->id_peralatan}}" data-id_barang="{{$j->id_barang}}">
                                    <th>{{ $loop->iteration }}</th>
                                    <td >{{$j->merek}}</td>
                                    <td >{{ $noinventaris[$j->id_barang] }}</td>
                                    <td >{{$j->nama_karyawan}}</td>
                                    <td >{{$j->alat_rusak}}</td>
                                    <td >{{$j->tanggal_diperbaiki}}</td>
                                    <td >{{$j->nama_teknisi}}</td>
                                    <td >{{ $kondisibarang[$j->id_barang] }}</td>
                                    <td >{{$j->updated_at}}</td>
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

        //TAMPILAN PERTANGGAL
        document.addEventListener("DOMContentLoaded", function() {
            // Pilih input tanggal
            const dariTanggalInput = document.getElementById("dari_tanggal");
            const sampaiTanggalInput = document.getElementById("sampai_tanggal");
        
            // Pilih tabel
            const historyTable = document.getElementById("tbl-History");
            const tableRows = historyTable.querySelectorAll("tbody tr");
        
            // Tambahkan event listener ke input tanggal
            dariTanggalInput.addEventListener("change", filterTable);
            sampaiTanggalInput.addEventListener("change", filterTable);
        
            function filterTable() {
                const dariTanggal = dariTanggalInput.value;
                const sampaiTanggal = sampaiTanggalInput.value;
        
                tableRows.forEach(function(row) {
                    const tanggalDiperbaiki = row.querySelector("td:nth-child(6)").textContent;
        
                    // Tambahkan pernyataan console.log untuk debugging
                    console.log("Dari Tanggal:", dariTanggal);
                    console.log("Sampai Tanggal:", sampaiTanggal);
                    console.log("Tanggal Diperbaiki:", tanggalDiperbaiki);
        
                    // Asumsikan format tanggal adalah "YYYY-MM-DD"
                    if (tanggalDiperbaiki >= dariTanggal && tanggalDiperbaiki <= sampaiTanggal) {
                        row.style.display = ""; // Tampilkan baris
                    } else {
                        row.style.display = "none"; // Sembunyikan baris
                    }
                });
            }
        });
        

        // search
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.querySelector('input[name="search"]');
    
            searchInput.addEventListener("keydown", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault(); // Mencegah submit form default
                    // Ambil nilai input
                    const searchValue = searchInput.value;
                    window.location.href = "{{ url('list-peralatan-search') }}?search=" + searchValue;
                }
            });
        });
    </script>
@endsection