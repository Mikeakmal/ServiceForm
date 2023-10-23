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
            @if (count($pengerjaan) > 0)
            <form action="{{ url('list-pengerjaan-search') }}" method="GET">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control" 
                    placeholder="Search Nama Mekanik" value="{{ Request::get('search') }}">
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
                    <a href="#" class="dropdown-item">Log Out</a>
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

    #new-pengerjaan {
        margin-right: 1mm; /* Atur jarak ke kanan sekitar 1mm */
    }
</style>

{{--  LIST PENGERJAAN  --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="mb-0">Daftar Pengerjaan</h6>                       
                        <div class="button-container">
                            <button type="submit" class="btn btn-custom"  id="new-pengerjaan" ><i class="bi bi-plus"></i>  Pengerjaan</button>
                            <div id="download-pdf" style="display: block;">
                                <form action="{{ url('list-pengerjaan-print') }}" method="POST" id="pdf-form">
                                    @csrf
                                    <button type="submit" id="button-download-pdf" class="btn btn-custom">
                                        <span class="btn-icon-left text-primary">
                                            <i class="fa fa-download color-primary"></i>
                                        </span>Download PDF
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nomor Polisi</th>
                                        <th scope="col">Nama Mekanik</th>
                                        <th scope="col">Tanggal Dikerjakan</th>
                                        <th scope="col">Sparepart</th>
                                        <th scope="col">Keterangan Pengerjaan</th>
                                        <th scope="col">Perbarui</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengerjaan as $j)
                                        <tr data-id="{{$j->id_pengerjaan}}">
                                            <th>{{ $loop->iteration }}</th>
                                            <td class="nopol-selected">{{ $nopolis[$j->id_kendaraan] }}</td>
                                            <td class="mekanik-name-selected">{{$j->nama_mekanik}}</td>
                                            <td class="tgl-kerja-selected">{{$j->tanggal_dikerjakan}}</td>
                                            <td class="sparepart-selected">{{$j->sparepart}}</td>
                                            <td class="keterangan-selected">{{$j->keterangan_pengerjaan}}</td>
                                            <td>
                                                <a href="{{ url('/editpengerjaan/' . $j->id_pengerjaan) }}" id="edit-button" class="edit-button" title="Perbarui"><i class="fa fa-edit"></i></a>
                                                <a href="{{ url('/deletepengerjaan/' . $j->id_pengerjaan) }}" title="Hapus" class="delete-button"
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
    </div>
    
{{--  FORM PENGERJAAN  --}}
    <form action="{{url('/addpengerjaan')}}" method="POST" id="form-new-pengerjaan" style="display: none;" >
        @csrf
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-20" >
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Formulir Pengerjaan</h6>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="nopol" name="kendaraan" required>
                                <option selected>Nomor Polisi</option>
                                @foreach ($nomorpolis as $c)
                                    <option value="{{ $c->id_kendaraan }}" {{ old('id_kendaraan') == $c->id_kendaraan ? 'selected' : '' }}>{{ $c->no_polisi }}</option>
                                @endforeach
                            </select>
                            <label for="inventaris">Works with selects</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="mekanik" type="text" class="form-control" id="mekanik" placeholder="" required>
                            <label for="mekanik">Nama Mekanik</label>
                        </div>  
                        <div class="form-floating mb-3">
                            <input name="tglkerja" type="date" class="form-control" id="tglkerja" placeholder="" required>
                            <label for="tglkerja">Tanggal Dikerjakan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="sparepart" type="text" class="form-control" id="sparepart" placeholder="" required>
                            <label for="sparepart">Sparepart</label>
                        </div>  
                        <div class="form-floating mb-3">
                            <textarea name="keterangan" class="form-control" placeholder="Keterangan Pengerjaan"
                            id="pengerjaan" style="height: 150px;" required></textarea>
                            <label for="pengerjaan">Keterangan Pengerjaan</label>
                        </div>
                        <div class=" form-floating ">
                            <button type="submit" class="btn btn-warning btn-custom" id="close-form-new-pengerjaan">Simpan</button>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </form>
    
{{--  FORM EDIT PENGERJAAN  --}}
        <form action="{{ url('/form-pengerjaan-update') }}" method="POST" id="form-edit-pengerjaan" style="display: none;">
            @csrf
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-20" >
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Form Edit Pengerjaan</h6>
                            <input type="hidden" id="edit-id" name="id_pengerjaan">
                                <div class="row mb-3">
                                    <label for="nopol" class="col-sm-2 col-form-label">Nomor Polisi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="kendaraan" class="form-control" id="edit-nopol" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="mekanik" class="col-sm-2 col-form-label">Nama Mekanik</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="val_mekanik" id="edit-mekanik" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tglkerja" class="col-sm-2 col-form-label">Tanggal Dikerjakan</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="val_dikerjakan" id="edit-tglkerja" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="sparepart" class="col-sm-2 col-form-label">Sparepart</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="val_sparepart" id="edit-sparepart" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan Pengerjaan</label>
                                    <div class="col-sm-10">
                                        <textarea name="val_keterangan" class="form-control" id="edit-keterangan" style="height: 150px;"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-3"> 
                                    <div class="col-sm-10 offset-sm-2"> 
                                        <button id="close-form-edit-pengerjaan" type="submit" class="btn btn-warning btn-custom">Perbarui</button>
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
                    window.location.href = "{{ url('list-pengerjaan-search') }}?search=" + searchValue;
                }
            });
        });

        // script to show/hide form add new company
        const toggleFormButton = document.getElementById('new-pengerjaan'); 
        const toggleCloseFormButton = document.getElementById('close-form-new-pengerjaan');
        const myForm = document.getElementById('form-new-pengerjaan'); 

        toggleFormButton.addEventListener('click', function() {
            if (myForm.style.display === 'none') {
                myForm.style.display = 'block';
            }

            // close form edit
            if (myEditForm.style.display === 'block') {
                myEditForm.style.display = 'none';
            }
        });

        toggleCloseFormButton.addEventListener('click', function() {
            var namekanikInput = document.getElementById("mekanik");
            var namekanikValue = namekanikInput.value;
            if (namekanikValue){
                if (myForm.style.display === 'block') {
                    myForm.style.display = 'none';
                }
            }
        });

        // script to show/hide edit form
        const toggleFormEditButton = document.getElementById('edit-button');
        const toggleCloseFormEditButton = document.getElementById('close-form-edit-pengerjaan');
        const myEditForm = document.getElementById('form-edit-pengerjaan');

        // show edit form
        var editButtons = document.querySelectorAll(".edit-button");
        editButtons.forEach(function (button) {
            button.addEventListener("click", function (event) {
                event.preventDefault();

                // Mengambil data dari baris yang dipilih
                var row = this.closest("tr");
                var id = row.getAttribute("data-id");
                var noPolis = row.querySelector(".nopol-selected").textContent;
                var mekanikName = row.querySelector(".mekanik-name-selected").textContent;
                var tglKerja = row.querySelector(".tgl-kerja-selected").textContent;
                var sparepart = row.querySelector(".sparepart-selected").textContent;
                var keteranganKerja = row.querySelector(".keterangan-selected").textContent;

                // Mengisi data ke dalam formulir
                document.getElementById("edit-id").value = id;
                document.getElementById("edit-nopol").value = noPolis;
                document.getElementById("edit-mekanik").value = mekanikName;
                document.getElementById("edit-tglkerja").value = tglKerja;
                document.getElementById("edit-sparepart").value = sparepart;
                document.getElementById("edit-keterangan").value = keteranganKerja;

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