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
            @if (count($peralatan) > 0)
                <form action="{{ url('list-peralatan-search') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" 
                        placeholder="Search" value="{{ Request::get('search') }}">
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
                    <a href="#" class="dropdown-item">History</a>
                    <a href="#" class="dropdown-item">Settings</a>
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
    /* CSS untuk mengatur tata letak menggunakan flexbox */
    .button-container {
        display: flex;
        align-items: center;
    }

    #new-peralatan {
        margin-right: 1mm; /* Atur jarak ke kanan sekitar 1mm */
    }
</style>


{{--  LIST PERALATAN  --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="mb-0">Daftar Peralatan Rusak </h6>                       
                        <div class="button-container">
                            <button type="submit" class="btn btn-custom"  id="new-peralatan" ><i class="bi bi-plus"></i>  Peralatan</button>
                            {{--  <div id="download-pdf" style="display: block;">
                                <form action="{{ url('list-peralatan-print') }}" method="POST" id="pdf-form">
                                    @csrf
                                    <button type="submit" id="button-download-pdf" class="btn btn-custom">
                                        <span class="btn-icon-left text-primary">
                                            <i class="fa fa-download color-primary"></i>
                                        </span>Download PDF
                                    </button>
                                </form>
                            </div>  --}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Merek</th>
                                    <th scope="col">No. Inventaris Peralatan</th>
                                    <th scope="col">Nama Karyawan</th>
                                    <th scope="col">Alat Rusak</th>
                                    <th scope="col">Tanggal Diperbaiki</th>
                                    <th scope="col">Teknisi</th>
                                    <th scope="col">Kondisi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataRusak as $j) 
                                    <tr data-id="{{$j->id_peralatan}}" data-id_barang="{{$j->id_barang}}">
                                        <th>{{ $loop->iteration }}</th>
                                        <td class="merek-selected">{{$j->merek}}</td>
                                        <td class="inventaris-selected">{{ $noinventaris[$j->id_barang] }}</td>
                                        <td class="karyawan-selected">{{$j->nama_karyawan}}</td>
                                        <td class="alat-rusak-selected">{{$j->alat_rusak}}</td>
                                        <td class="tgl-diperbaiki-selected">{{$j->tanggal_diperbaiki}}</td>
                                        <td class="teknisi-selected">{{$j->nama_teknisi}}</td>
                                        <td class="kondisi-selected">{{ $kondisibarang[$j->id_barang] }}</td>
                                        <td>
                                            <a href="{{ url('/editperalatan/' . $j->id_peralatan) }}" id="edit-button" class="edit-button" title="Perbarui"><i class="fa fa-edit"></i></a>
                                            <a href="{{ url('/deleteperalatan/' . $j->id_peralatan) }}" class="delete-button" title="Hapus" 
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


{{--  FORM PERALATAN  --}}
    <form action="/addperalatan" method="POST" id="form-new-peralatan" style="display: none;">
        @csrf
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Form Peralatan Rusak</h6>
                        <div class="form-floating mb-3">
                            <input name="merek" type="text" class="form-control" id="merek"
                                placeholder="" required>
                            <label for="merek">Merek</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="inventaris" name="inventaris" required>
                                <option selected>No. Inventarsi Peralatan</option>
                                @foreach ($inventarisNo as $c)
                                    <option value="{{ $c->id_barang }}" {{ old('id_barang') == $c->id_barang ? 'selected' : '' }}>{{ $c->No_inventaris_peralatan }}</option>
                                @endforeach
                            </select>
                            <label for="inventaris">Works with selects</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="karyawan" type="text" class="form-control" id="karyawan" placeholder="" required>
                            <label for="karyawan">Nama Karyawan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="alat" type="text" class="form-control" id="alat" placeholder="" required>
                            <label for="alat">Alat Rusak</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="tgldiperbaiki" type="date" class="form-control" id="tgldiperbaiki" placeholder="" required>
                            <label for="tgldiperbaiki">Tanggal Diperbaiki</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="teknisi" type="text" class="form-control" id="teknisi" placeholder="" required>
                            <label for="teknisi">Teknisi</label>
                        </div>
                        <div class=" form-floating ">
                            <button type="submit" id="close-form-new-peralatan" class="btn btn-warning btn-custom">Simpan</button>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </form>  

{{--  FORM EDIT PERALATAN  --}}
    <form action="{{ url('/form-peralatan-update') }}" method="POST" id="form-edit-peralatan" style="display: none;">
        @csrf
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Form Edit Peralatan</h6>
                        <input type="hidden" id="edit-id" name="id_peralatan">
                        <input type="hidden" id="edit-id_barang" name="id_barang">
                        <div class="row mb-3">
                            <label for="merek" class="col-sm-2 col-form-label">Merek</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="val_merek" id="edit-merek" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inventaris" class="col-sm-2 col-form-label">No. Inventaris Peralatan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="barang" id="edit-inventaris" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="karyawan" class="col-sm-2 col-form-label">Nama Karyawan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="val_karyawan" id="edit-karyawan" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="alat" class="col-sm-2 col-form-label">Alat Rusak</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="val_alatrusak" id="edit-alatrusak" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tgldiperbaiki" class="col-sm-2 col-form-label">Tanggal Diperbaiki</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="val_tgldiperbaiki" id="edit-tgldiperbaiki" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="teknisi" class="col-sm-2 col-form-label">Nama Teknisi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="val_teknisi" id="edit-teknisi" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kondisi" class="col-sm-2 col-form-label">Kondisi</label>
                            <div class="col-sm-10">
                                <select name="val_kondisi" class="form-select" id="edit-kondisi"
                                    aria-label="Floating label select example">
                                    <option selected>Kondisi</option>
                                    <option value="BAGUS">Bagus</option>
                                    <option value="RUSAK">Rusak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 mt-3"> 
                            <div class="col-sm-10 offset-sm-2"> 
                                <button id="close-form-edit-peralatan" type="submit" class="btn btn-warning btn-custom">Perbarui</button>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </form>   

    <script>
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

        // script to show/hide form add new company
        const toggleFormButton = document.getElementById('new-peralatan'); 
        const toggleCloseFormButton = document.getElementById('close-form-new-peralatan');
        const myForm = document.getElementById('form-new-peralatan'); 

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
        const toggleCloseFormEditButton = document.getElementById('close-form-edit-peralatan');
        const myEditForm = document.getElementById('form-edit-peralatan');

        // show edit form
        var editButtons = document.querySelectorAll(".edit-button");
        editButtons.forEach(function (button) {
            button.addEventListener("click", function (event) {
                event.preventDefault();

                // Mengambil data dari baris yang dipilih
                var row = this.closest("tr");
                var id = row.getAttribute("data-id");
                var id_barang = row.getAttribute("data-id_barang");
                var merek = row.querySelector(".merek-selected").textContent;
                var NoInventaris = row.querySelector(".inventaris-selected").textContent;
                var namaKaryawan = row.querySelector(".karyawan-selected").textContent;
                var alatRusak = row.querySelector(".alat-rusak-selected").textContent;
                var tglDiperbaiki = row.querySelector(".tgl-diperbaiki-selected").textContent;
                var teknisi = row.querySelector(".teknisi-selected").textContent;
                var kondisiBarang = row.querySelector(".kondisi-selected").textContent;

                // Mengisi data ke dalam formulir
                document.getElementById("edit-id").value = id;
                document.getElementById("edit-id_barang").value = id_barang;
                document.getElementById("edit-merek").value = merek;
                document.getElementById("edit-inventaris").value = NoInventaris;
                document.getElementById("edit-karyawan").value = namaKaryawan;
                document.getElementById("edit-alatrusak").value = alatRusak;
                document.getElementById("edit-tgldiperbaiki").value = tglDiperbaiki;
                document.getElementById("edit-teknisi").value = teknisi;
                document.getElementById("edit-kondisi").value = kondisiBarang;


                if (myEditForm.style.display === 'none') {
                    myEditForm.style.display = 'block';
                }

                // close form add
                if (myForm.style.display === 'block') {
                    myForm.style.display = 'none';
                }
            });
        });

        // close edit form
        toggleCloseFormEditButton.addEventListener('click', function() {
            if (myEditForm.style.display === 'block') {
                myEditForm.style.display = 'none';
            }
        });
    </script>
@endsection