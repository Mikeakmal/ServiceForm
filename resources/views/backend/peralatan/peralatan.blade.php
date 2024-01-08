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
    /* CSS untuk mengatur tata letak menggunakan flexbox */
    .button-container {
        display: flex;
        align-items: center;
    }

    #new-peralatan {
        margin-right: 1mm; 
    }

    .select2-selection {
        background-color: #000000 !important;
        text-decoration-color: rgb(241, 248, 255)!important;
        border: none !important;
    }

    #inventaris.select2-container {
        height: 200px !important;
    }

    .select2-selection {
        background-color: #000000 !important;
        border: none !important;
    }

    .select2-results__option:hover {
        background-color: #000000 !important;
        color: #ffffff !important;
    }

    .select2-results__option:not(:hover) {
        background-color: #ffffff !important; 
        color: #000000 !important;
    }

    .form-container {
        margin-bottom: 15px; //jarak antar textbox
    }

    .select2-label {
        font-size: 15px;
        color: #e6e0e0;
        position: absolute;
        top: 0%;
        transform: translateY(-20%);
        z-index: 1;
    }

    .select2-container {
        position: relative;
        height: 60px !important; 
    }
 
    .select2-container .select2-selection--single {
        height: 60px; 
    }
    
    .select2-container .select2-selection--single .select2-selection__rendered {
        position: absolute;
        bottom: 5%;
        margin-left: 5px;
    } 
       
</style>

{{--  FORM PERALATAN  --}}
    <form action="{{ url('/addperalatan') }}" method="POST" id="form-new-peralatan" style="display: none;">
        @csrf
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Formulir Peralatan Rusak</h6>
                        <div class="form-floating mb-3">
                            <input name="merek" type="text" class="form-control" id="merek" placeholder="" required>
                            <label for="merek">Merek</label>
                        </div>
                        <div class="form-container">
                            <div class="form-floating mb-3 position-relative">
                                <label for="nopol" class="form-label select2-label">Nomor Inventaris</label>
                                <select class="form-select select2"  style="width: 100%; " id="inventaris" name="inventaris" required>
                                    <option value="" disabled selected>Pilih Nomor Inventaris</option>
                                    @foreach ($inventarisNo as $c)
                                        <option value="{{ $c->id_barang }}" {{ old('id_barang') == $c->id_barang ? 'selected' : '' }}>{{ $c->No_inventaris_peralatan }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                            <label for="teknisi">Nama Teknisi</label>
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
                        <h6 class="mb-4">Formulir Edit Peralatan</h6>
                        <input type="hidden" id="edit-id" name="id_peralatan">
                        <input type="hidden" id="edit-id_barang" name="id_barang">
                        <div class="row mb-3">
                            <label for="merek" class="col-sm-2 col-form-label">Merek</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('merek') is-invalid @enderror" name="val_merek" id="edit-merek" required>
                            </div>
                            @error('merek')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="inventaris" class="col-sm-2 col-form-label">No. Inventaris Peralatan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('inventaris') is-invalid @enderror" name="barang" id="edit-inventaris" required>
                            </div>
                            @error('inventaris')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="karyawan" class="col-sm-2 col-form-label">Nama Karyawan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('karyawan') is-invalid @enderror" name="val_karyawan" id="edit-karyawan" required>
                            </div>
                            @error('karyawan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="alat" class="col-sm-2 col-form-label">Alat Rusak</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('alat') is-invalid @enderror" name="val_alatrusak" id="edit-alatrusak" required>
                            </div>
                        </div>
                        @error('alat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="row mb-3">
                            <label for="tgldiperbaiki" class="col-sm-2 col-form-label">Tanggal Diperbaiki</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control @error('tgldiperbaiki') is-invalid @enderror" name="val_tgldiperbaiki" id="edit-tgldiperbaiki" required>
                            </div>
                            @error('tgldiperbaiki')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="teknisi" class="col-sm-2 col-form-label">Nama Teknisi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('teknisi') is-invalid @enderror" name="val_teknisi" id="edit-teknisi" required>
                            </div>
                            @error('teknisi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="kondisi" class="col-sm-2 col-form-label">Kondisi</label>
                            <div class="col-sm-10">
                                <select name="val_kondisi" class="form-select @error('kondisi') is-invalid @enderror" id="edit-kondisi"
                                    aria-label="Floating label select example">
                                    <option value="BAGUS">Bagus</option>
                                    <option value="RUSAK">Rusak</option>
                                </select>
                            </div>
                            @error('kondisi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                        <thead>
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


{{--  LIST PERALATAN  --}}
    <div class="container-fluid pt-4 px-4" id="list-peralatan">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="mb-0">Daftar Peralatan Rusak </h6>                       
                        <div class="button-container">
                            <button type="submit" class="btn btn-warning btn-custom"  id="new-peralatan" ><i class="bi bi-plus"></i>  Peralatan</button>
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
                                    <th scope="col">Nama Teknisi</th>
                                    <th scope="col">Kondisi</th>
                                    <th scope="col">  Aksi  </th>
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

    <script>
        //search $ select ComboBox
        $('.select2').select2({
            width: '100%'
        });

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
        
            
    
        // Mengambil referensi elemen-elemen
        const historyListButton = document.getElementById('history-list-button');
        const historyList = document.getElementById('history-list');

        // Menambahkan event listener untuk tombol "History"
        historyListButton.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah tindakan default dari tautan

            // Memeriksa apakah history-list sedang ditampilkan atau disembunyikan
            if (historyList.style.display === 'none') {
                historyList.style.display = 'block'; // Menampilkan history-list
            } else {
                historyList.style.display = 'none'; // Menyembunyikan history-list
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

        // script to show/hide form
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

        // show edit form edit
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
    </script>
@endsection