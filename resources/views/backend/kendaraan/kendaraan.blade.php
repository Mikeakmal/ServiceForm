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
        <form class="d-none d-md-flex ms-4">
            @if (count($kendaraan) > 0)
            <form action="{{ url('list-kendaraan-search') }}" method="GET">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control" 
                    placeholder="Search..." value="{{ Request::get('search') }}">
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
    /* CSS untuk mengatur tata letak menggunakan flexbox */
    .button-container {
        display: flex;
        align-items: center;
    }

    #new-kendaraan {
        margin-right: 1mm; /* Atur jarak ke kanan sekitar 1mm */
    }

    .on-progress-text {
        color: red; /* Warna teks merah untuk status "ON PROGRESS" */
    }
    
    .finish-text {
        color: #008000; /* Warna teks hijau untuk status "Finish" */
    }
    .
</style>


    {{--  form edit kendaraan  --}}
    <form action="{{url('/form-kendaraan-update')}}" method="POST" id="form-edit-kendaraan" style="display: none;">
        @csrf
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Formulir Edit Kendaraan</h6>
                        <input type="hidden" id="edit-id" name="id_kendaraan">

                        <div class="row mb-3">
                            <label for="val_nopol" class="col-sm-2 col-form-label">Nomor Polisi</label>
                            <div class="col-sm-10">
                                <input type="text" name="val_nopol" class="form-control" id="edit-nopol"  required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="val_tglmasuk" class="col-sm-2 col-form-label">Tanggal Masuk Bengkel</label>
                            <div class="col-sm-10">
                                <input type="date" name="val_tglmasuk" class="form-control" id="edit-tglmasuk"  required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="val_tglselesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                            <div class="col-sm-10">
                                <input type="date" name="val_tglselesai" class="form-control" id="edit-tglselesai">
                            </div>
                        </div>
                        <div class="row mb-3 mt-3"> 
                            <div class="col-sm-10 offset-sm-2"> 
                                <button id="close-form-edit-kendaraan" type="submit" class="btn btn-warning btn-custom">Perbarui</button>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </form>


    {{--  form tambah kendaraan  --}}
    <form action="{{url('/addkendaraan')}}" method="POST" id="form-new-kendaraan" style="display: none;">
        @csrf
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Formulir Kendaraan</h6>
                        <div class="form-floating mb-3">
                            <input name="nopol" type="text" class="form-control" id="nopol" placeholder="" required>
                            <label for="nopol">Nomor Polisi</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="tglmasuk" type="date" class="form-control" id="tglmasuk" placeholder required>
                            <label for="tglmasuk">Tanggal Masuk Bengkel</label>
                        </div>
                        <div class=" form-floating ">
                            <button type="submit" id="close-form-new-kendaraan" class="btn btn-warning btn-warning m-2 submit-button">Simpan</button>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </form>   

        
    {{--  LIST KENDARAAN  --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="mb-0">Daftar Kendaraan </h6> 
                        <div class="button-container">
                            <div class="nav-item btnPrint">
                                <a href="#" class="nav-link" >
                                    <button type="submit" class="btn btn-outline-warning " data-bs-toggle="modal" data-bs-target="#Kendaraan"><i class="fa fa-download me-2"></i>PDF</button>
                                </a>
                            </div> 
                            <button type="submit" class="btn btn-custom"  id="new-kendaraan" ><i class="bi bi-plus"></i>  Kendaraan</button>
                        </div>
                    </div>
                {{--  <!-- Modal Kendaraan  -->  --}}
                    <div class="modal fade" id="Kendaraan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 80%;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div style="width: 95%; margin: 0 auto;">
                                        <div style="text-align: center;">
                                            <h4 style="color: black;">Daftar Kendaraan</h4>
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
                                                            <th scope="col">No.</th>
                                                            <th scope="col">No. Polisi</th>
                                                            <th scope="col">Tanggal Masuk Bengkel</th>
                                                            <th scope="col">Tanggal Selesai</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-black">
                                                        @foreach($kendaraan as $j)
                                                            <tr data-id="{{$j->id_kendaraan}}">
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{$j->no_polisi}}</td>
                                                                <td>{{$j->tanggal_masuk_bengkel}}</td>
                                                                <td>{{$j->tanggal_selesai}}</td>
                                                                <td class="status-selected @if ($j->tanggal_selesai === null) on-progress-text @else finish-text @endif">
                                                                    {{ $j->tanggal_selesai === null ? 'ON PROGRESS' : 'FINISH' }}
                                                                </td>
                                                            </tr>
                                                        @endforeach 
                                                    </tbody>
                                                </table>
                                                <div class="modal-footer">
                                                    <form method="POST" action="{{ url('list-kendaraan-print') }}" id="pdf-form-bagus">
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
                    {{--  LIST KENDARAAN  --}}
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">No. Polisi</th>
                                    <th scope="col">Tanggal Masuk Bengkel</th>
                                    <th scope="col">Tanggal Selesai</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kendaraan as $j)
                                    <tr data-id="{{$j->id_kendaraan}}">
                                        <th>{{ $loop->iteration }}</th>
                                        <td class="nopol-selected">{{$j->no_polisi}}</td>
                                        <td class="tgl-kerja-selected">{{$j->tanggal_masuk_bengkel}}</td>
                                        <td class="tgl-selesai-selected">{{$j->tanggal_selesai}}</td>
                                        <td class="status-selected @if ($j->tanggal_selesai === null) on-progress-text @else finish-text @endif">
                                            {{ $j->tanggal_selesai === null ? 'ON PROGRESS' : 'FINISH' }}
                                        </td>                                        
                                        <td>
                                            <a href="{{ url('movekendaraan', ['id_kendaraan' => Crypt::encrypt($j->id_kendaraan)]) }}" 
                                                class="detail-button" id="detail-button" title="Lihat Detail"><i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a href="/editkendaraan/{{$j->id_kendaraan}}" id="edit-button" class="edit-button" title="Perbarui"><i class="fa fa-edit"></i></a>
                                            </a>
                                            <a href="{{ url('/kendaraan/' . $j->id_kendaraan) }}" class="delete-button" 
                                                onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="bi bi-trash"></i>
                                            </a>
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
    {{--  search  --}}
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.querySelector('input[name="search"]');

            searchInput.addEventListener("keydown", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault(); // Mencegah submit form default
                    // Ambil nilai input
                    const searchValue = searchInput.value;
                    // Redirect ke URL pencarian dengan kata kunci
                    window.location.href = "{{ url('list-kendaraan-search') }}?search=" + searchValue;
                }
            });
        });

    {{--  capslock  --}}
        var nopolInput = document.getElementById('nopol');
        nopolInput.addEventListener('input', function() {
            this.value = this.value.toUpperCase(); 
        });

        var noPolInput = document.getElementById('edit-nopol');
        if (noPolInput) {
            noPolInput.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });
        }

    // script to show/hide form add new company
    const toggleFormButton = document.getElementById('new-kendaraan'); 
    const toggleCloseFormButton = document.getElementById('close-form-new-kendaraan'); 
    const myForm = document.getElementById('form-new-kendaraan'); 

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
    const toggleCloseFormEditButton = document.getElementById('close-form-edit-kendaraan');
    const myEditForm = document.getElementById('form-edit-kendaraan');

    // show edit form
    var editButtons = document.querySelectorAll(".edit-button");
    editButtons.forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            // Mengambil data dari baris yang dipilih
            var row = this.closest("tr");
            var id = row.getAttribute("data-id");
            var noPolis = row.querySelector(".nopol-selected").textContent;
            var tglMasuk = row.querySelector(".tgl-kerja-selected").textContent;
            var tglSelesai = row.querySelector(".tgl-selesai-selected").textContent;

            // Mengisi data ke dalam formulir
            document.getElementById("edit-id").value = id;
            document.getElementById("edit-nopol").value = noPolis;
            document.getElementById("edit-tglmasuk").value = tglMasuk;
            document.getElementById("edit-tglselesai").value = tglSelesai;

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
