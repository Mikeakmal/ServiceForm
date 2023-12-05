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
        <form class="d-none d-md-flex ms-4">
            @if (count($barang) > 0)
            <form action="{{ url('list-barang-search') }}" method="GET">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control" 
                    placeholder="Search Nama Barang" value="{{ Request::get('search') }}">
                </div>
            </form>
            @endif
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
                        <button type="submit" class="dropdown-item text-white">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
{{--  <!-- Navbar End -->  --}}

<style>
    /* CSS untuk mengatur tata letak menggunakan flexbox */
    .button-container {
        display: flex;
        align-items: center;
    }

</style>

{{-- Form Tambah Barang/inventaris --}}
<form action="{{url('/addbarang')}}" method="POST" id="form-new-barang" style="display: none;">
    @csrf
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Formulir Peralatan Inventaris</h6>
                    <div class="form-floating mb-3">
                        <input name="barang" type="text" class="form-control" id="barang" placeholder="" required>
                        <label for="barang">Nama Barang</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="inventaris" type="text" class="form-control @error('inventaris') is-invalid @enderror" id="inventaris" placeholder="" required>
                        @error('inventaris')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <label for "inventaris">No. Inventaris Peralatan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="lokasi" type="text" class="form-control" id="lokasi" placeholder="" required>
                        <label for="lokasi">Lokasi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="kondisi" class="form-select" id="kondisi" required
                            aria-label="Floating label select example">
                            <option value="">Kondisi</option>
                            <option value="BAGUS">Bagus</option>
                            <option value="RUSAK">Rusak</option>
                        </select>
                        <label for="kondisi">Works with selects</label>
                    </div>
                    <div class="form-floating">
                        <button type="submit" id="close-form-new-barang" class="btn btn-warning btn-custom">Simpan</button>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</form>


{{-- Form Edit Barang --}}
<form action="{{url('/form-barang-update')}}" method="POST" id="form-edit-barang" style="display: none;">
    @csrf
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Formulir Edit Peralatan Inventaris</h6>
                    <input type="hidden" id="edit-id" name="id_barang">

                    <div class="row mb-3">
                        <label for="barang" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" name="val_barang" class="form-control" id="edit-barang" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inventaris" class="col-sm-2 col-form-label">No. Inventaris Peralatan</label>
                        <div class="col-sm-10">
                            <input type="text" name="val_inventaris" class="form-control" id="edit-inventaris" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="lokasi" class="col-sm-2 col-form-label">Lokasi</label>
                        <div class="col-sm-10">
                            <input type="text" name="val_lokasi" class="form-control" id="edit-lokasi" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kondisi" class="col-sm-2 col-form-label">Kondisi</label>
                        <div class="col-sm-10">
                            <select name="val_kondisi" class="form-select" id="edit-kondisi"
                                aria-label="Floating label select example">
                                <option value="BAGUS">Bagus</option>
                                <option value="RUSAK">Rusak</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="edit-tgl-pengambilan" class="col-sm-2 col-form-label">Tanggal Pengambilan</label>
                        <div class="col-sm-10">
                            <input type="date" name="val_tglpengambilan" class="form-control" id="edit-tgl-pengambilan">
                        </div>
                    </div>
                    <div class="row mb-3 mt-3"> 
                        <div class="col-sm-10 offset-sm-2"> 
                            <button id="close-form-edit-barang" type="submit" class="btn btn-warning btn-custom">Perbarui</button>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</form>

{{-- List Barang --}}
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="mb-0">Daftar Peralatan Inventaris </h6> 
                    <div class="button-container">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-download"></i>
                                <span class="d-none d-lg-inline-flex"> PDF</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                                    <button type="submit" id="popup-all" class="dropdown-item text-white" 
                                    data-bs-toggle="modal" data-bs-target="#PeralatanSemua">Semua</button>

                                    <button type="submit" id="popup-good" class="dropdown-item text-white" 
                                    data-bs-toggle="modal" data-bs-target="#PeralatanBagus">Bagus</button>
                 
                                    <button type="submit" id="popup-damage" class="dropdown-item text-white" 
                                    data-bs-toggle="modal" data-bs-target="#PeralatanRusak">Rusak</button>
                            </div>  
                        </div>
                        <button type="submit" class="btn btn-warning btn-custom" id="new-barang"><i class="bi bi-plus"></i>Inventaris</button>
                    </div>                                        
                </div>
                {{--  <!-- Modal All of Peralatan  -->  --}}
                <div class="modal fade" id="PeralatanSemua" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 80%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div style="width: 95%; margin: 0 auto;">
                                    <div style="text-align: center;">
                                        <h4 style="color: black;">Daftar Peralatan Inventaris</h4>
                                    </div>
                                </div>  
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                              
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Nomor</th>
                                                        <th>Nama Barang</th>
                                                        <th>No. Inventaris Peralatan</th>
                                                        <th>Lokasi Barang</th>
                                                        <th>Kondisi</th>
                                                        <th>Tanggal Pengambilan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($barang as $j)
                                                        <tr data-id="{{$j->id_barang}}">
                                                            <td class="text-black">{{ $loop->iteration }}</td>
                                                            <td class="text-black">{{$j->nama_barang}}</td>
                                                            <td class="text-black">{{$j->No_inventaris_peralatan}}</td>
                                                            <td class="text-black">{{$j->lokasi_barang}}</td>
                                                            <td class="text-black">{{$j->kondisi}}</td>
                                                            <td class="text-black">{{$j->tanggal_pengambilan}}</td>
                                                        </tr>
                                                    @endforeach 
                                                </tbody>
                                            </table>
                                            <div class="modal-footer">
                                               <form method="POST" action="{{ url('list-barang-print') }}" id="pdf-form">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-custom">Download</button>
                                               </form>
                                            </div>        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{--  <!-- Modal Peralatan BAGUS  -->  --}}
                <div class="modal fade" id="PeralatanBagus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 80%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div style="width: 95%; margin: 0 auto;">
                                    <div style="text-align: center;">
                                        <h4 style="color: black;">Daftar Peralatan BAGUS</h4>
                                    </div>
                                </div>  
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                              
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Nomor</th>
                                                        <th>Nama Barang</th>
                                                        <th>No. Inventaris Peralatan</th>
                                                        <th>Lokasi Barang</th>
                                                        <th>Kondisi</th>
                                                        <th>Tanggal Pengambilan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($barangbagus as $j)
                                                        <tr data-id="{{$j->id_barang}}">
                                                            <td class="text-black">{{ $loop->iteration }}</td>
                                                            <td class="text-black">{{$j->nama_barang}}</td>
                                                            <td class="text-black">{{$j->No_inventaris_peralatan}}</td>
                                                            <td class="text-black">{{$j->lokasi_barang}}</td>
                                                            <td class="text-black">{{$j->kondisi}}</td>
                                                            <td class="text-black">{{$j->tanggal_pengambilan}}</td>
                                                        </tr>
                                                    @endforeach 
                                                </tbody>
                                            </table>
                                            <div class="modal-footer">
                                               <form method="POST" action="{{ url('list-barang-bagus-print') }}" id="pdf-form-bagus">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-custom">Download</button>
                                               </form>
                                            </div>        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{--  <!-- Modal Peralatan RUSAK  -->  --}}
                <div class="modal fade" id="PeralatanRusak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 80%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div style="width: 95%; margin: 0 auto;">
                                    <div style="text-align: center;">
                                        <h4 style="color: black;">Daftar Peralatan RUSAK</h4>
                                    </div>
                                </div>  
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                              
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Nomor</th>
                                                        <th>Nama Barang</th>
                                                        <th>No. Inventaris Peralatan</th>
                                                        <th>Lokasi Barang</th>
                                                        <th>Kondisi</th>
                                                        <th>Tanggal Pengambilan</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-black">
                                                    @foreach($barangrusak as $j)
                                                        <tr data-id="{{$j->id_barang}}">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{$j->nama_barang}}</td>
                                                            <td>{{$j->No_inventaris_peralatan}}</td>
                                                            <td>{{$j->lokasi_barang}}</td>
                                                            <td>{{$j->kondisi}}</td>
                                                            <td>{{$j->tanggal_pengambilan}}</td>
                                                        </tr>
                                                    @endforeach 
                                                </tbody>
                                            </table>
                                            <div class="modal-footer">
                                               <form method="POST" action="{{ url('list-barang-rusak-print') }}" id="pdf-form-bagus">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-custom">Download</button>
                                               </form>
                                            </div>        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                {{--  TABLE PERALATAN INVENTARIS  --}}
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nomor</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">No. Inventaris Peralatan</th>
                                <th scope="col">Lokasi Barang</th>
                                <th scope="col">Kondisi</th>
                                <th scope="col">Tanggal Pengambilan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barang as $j)
                            <tr data-id="{{$j->id_barang}}">
                                <th>{{ $loop->iteration }}</th>
                                <td class="barang-selected">{{$j->nama_barang}}</td>
                                <td class="inventaris-selected">{{$j->No_inventaris_peralatan}}</td>
                                <td class="lokasi-selected">{{$j->lokasi_barang}}</td>
                                <td class="kondisi-selected">{{$j->kondisi}}</td>
                                <td class="tglpengambilan-selected">{{$j->tanggal_pengambilan}}</td>
                                <td>
                                    <a href="/editbarang/{{$j->id_barang}}" id="edit-button" class="edit-button" title="Perbarui"><i class="fa fa-edit"></i></a>
                                    <a href="{{ url('/deletebarang/' . $j->id_barang) }}" class="delete-button" title="Hapus"
                                        onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="bi bi-trash"> </i></a>
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

<script>
    {{--  capslock  --}}
    var nopolInput = document.getElementById('edit-kondisi');
    nopolInput.addEventListener('input', function() {
        this.value = this.value.toUpperCase(); 
    });

     {{--  search  --}}
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.querySelector('input[name="search"]');

        searchInput.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Mencegah submit form default
                // Ambil nilai input
                const searchValue = searchInput.value;
                // Redirect ke URL pencarian dengan kata kunci
                window.location.href = "{{ url('list-barang-search') }}?search=" + searchValue;
            }
        });
    });

    // script to show/hide form add new Peralatan Inventaris
    const toggleFormButton = document.getElementById('new-barang'); 
    const toggleCloseFormButton = document.getElementById('close-form-new-barang');
    const myForm = document.getElementById('form-new-barang'); 

    toggleFormButton.addEventListener('click', function() {
        if (myForm.style.display === 'none') {
            myForm.style.display = 'block';
        }

        // close form edit
        if (myEditForm.style.display === 'block') {
            myEditForm.style.display = 'none';
        }
    });



    // script to show/hide edit form
    const toggleFormEditButton = document.getElementById('edit-button');
    const toggleCloseFormEditButton = document.getElementById('close-form-edit-barang');
    const myEditForm = document.getElementById('form-edit-barang');

    // show edit form
    var editButtons = document.querySelectorAll(".edit-button");
    editButtons.forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            // Mengambil data dari baris yang dipilih
            var row = this.closest("tr");
            var id = row.getAttribute("data-id");
            var namaBarang = row.querySelector(".barang-selected").textContent;
            var noInventaris = row.querySelector(".inventaris-selected").textContent;
            var lokasiBarang = row.querySelector(".lokasi-selected").textContent;
            var kondisiBarang = row.querySelector(".kondisi-selected").textContent;
            var tglAmbil = row.querySelector(".tglpengambilan-selected").textContent;


            // Mengisi data ke dalam formulir
            document.getElementById("edit-id").value = id;
            document.getElementById("edit-barang").value = namaBarang;
            document.getElementById("edit-inventaris").value = noInventaris;
            document.getElementById("edit-lokasi").value = lokasiBarang;
            document.getElementById("edit-kondisi").value = kondisiBarang;
            document.getElementById("edit-tgl-pengambilan").value = tglAmbil;

            if (myEditForm.style.display === 'none') {
                myEditForm.style.display = 'block';
            }

            // close form add
            if (myForm.style.display === 'block') {
                myForm.style.display = 'none';
            }
        });
    });

</script>
@endsection