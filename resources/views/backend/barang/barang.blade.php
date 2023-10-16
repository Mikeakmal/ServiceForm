@extends('frontend.layout.main')
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

{{-- List Barang --}}
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="mb-0">Daftar Barang </h6> 
                    @if (count($tbl_barang) > 0)
                        <button type="submit" class="btn btn-primary" id="new-barang"> + Barang</button>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nomor</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">No. Inventaris Peralatan</th>
                                <th scope="col">Lokasi Barang</th>
                                <th scope="col">Perbarui</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tbl_barang as $j)
                            <tr data-id="{{$j->id_barang}}">
                                <th>{{ $loop->iteration }}</th>
                                <td class="barang-selected">{{$j->nama_barang}}</td>
                                <td class="inventaris-selected">{{$j->No_inventaris_peralatan}}</td>
                                <td class="lokasi-selected">{{$j->lokasi_barang}}</td>
                                <td>
                                    <a href="/editbarang/{{$j->id_barang}}" id="edit-button" class="edit-button"><i class="fa fa-edit"> edit |</i></a>
                                    <a href="/deletebarang/{{$j->id_barang}}"><i class="fa fa-trash"> delete </i></a>
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

{{-- Form Edit Barang --}}
<form action="{{url('/editbarang/{id_barang}')}}" method="POST" id="form-edit-barang" style="display: none;">
    @csrf
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Formulir Edit Barang</h6>
                    <input type="hidden" id="edit-id" name="id_barang">
                    <div class="form-floating mb-3">
                        <input name="val_barang" type="text" class="form-control" id="edit-barang" placeholder="" required>
                        <label for="barang">Nama Barang</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="val_inventaris" type="text" class="form-control" id="edit-inventaris" placeholder="" required>
                        <label for "inventaris">No. Inventaris Peralatan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="val_lokasi" type="text" class="form-control" id="edit-lokasi" placeholder="" required>
                        <label for="lokasi">Lokasi</label>
                    </div>
                    <div class="form-floating">
                        <button type="submit" id="close-form-edit-barang" class="btn btn-primary">Perbarui</button>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</form>

{{-- Form Tambah Barang --}}
<form action="{{url('/addbarang')}}" method="POST" id="form-new-barang" style="display: none;">
    @csrf
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Formulir Barang</h6>
                    <div class="form-floating mb-3">
                        <input name="barang" type="text" class="form-control" id="barang" placeholder="" required>
                        <label for="barang">Nama Barang</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="inventaris" type="text" class="form-control" id="inventaris" placeholder="" required>
                        <label for "inventaris">No. Inventaris Peralatan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="lokasi" type="text" class="form-control" id="lokasi" placeholder="" required>
                        <label for="lokasi">Lokasi</label>
                    </div>
                    <div class="form-floating">
                        <button type="submit" id="close-form-new-barang" class="btn btn-primary">Simpan</button>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</form>

<script>
     
    // script to show/hide form add new company
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

    toggleCloseFormButton.addEventListener('click', function() {
        var barangInput = document.getElementById("barang");
        var barangValue = barangInput.value;
        if (barangValue){
            if (myForm.style.display === 'block') {
                myForm.style.display = 'none';
            }
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
            var namaBarang = row.querySelector(".nama-barang-selected").textContent;
            var noInventaris = row.querySelector(".inventaris-selected").textContent;
            var lokasiBarang = row.querySelector(".lokasi-selected").textContent;


            // Mengisi data ke dalam formulir
            document.getElementById("edit-id").value = id;
            document.getElementById("edit-barang").value = namaBarang;
            document.getElementById("edit-inventaris").value = noInventaris;
            document.getElementById("edit-lokasi").value = lokasiBarang;

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