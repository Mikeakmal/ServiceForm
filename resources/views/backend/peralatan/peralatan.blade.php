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

{{--  LIST PERALATAN  --}}
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h6 class="mb-0">Daftar Peralatan </h6> 
                                @if (count($tbl_peralatan) > 0)
                                    <button type="submit" class="btn btn-primary" id="new-peralatan"> + Peralatan</button>
                                @endif
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
                                            <th scope="col">Tanggal Digunakan</th>
                                            <th scope="col">Teknisi</th>
                                            <th scope="col">Perbarui</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tbl_peralatan as $j) 
                                            <tr data-id="{{$j->id_peralatan}}">
                                                <th>{{ $loop->iteration }}</th>
                                                <td class="nopol-selected">{{$j->merek}}</td>
                                                <td>{{ $noinventaris[$j->id_barang] }}</td>
                                                <td>{{$j->nama_karyawan}}</td>
                                                <td>{{$j->alat_rusak}}</td>
                                                <td>{{$j->tanggal_digunakan}}</td>
                                                <td>{{$j->nama_teknisi}}</td>
                                                <td>
                                                    <a href="{{ url('/editperalatan/' . $j->id_peralatan) }}" id="edit-button" class="edit-button"><i class="fa fa-edit"> edit |</i></a>
                                                    <a href="{{ url('/deleteperalatan/' . $j->id_peralatan) }}"><i class="fa fa-trash"> delete </i></a>
                                                </td>
                                            </tr>
                                        @endforeach             
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

{{--  FORM EDIT PERALATAN  --}}
                    <form action="/addperalatan" method="POST" id="form-edit-peralatan" style="display: none;">
                        @csrf
                        <div class="col-sm-12 col-xl-12">
                            <div class="bg-secondary rounded h-100 p-4">
                                <h6 class="mb-4">Form Edit Peralatan</h6>
                                <div class="form-floating mb-3">
                                    <input name="merek" type="text" class="form-control" id="merek"
                                        placeholder="">
                                    <label for="merek">Merek</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="inventaris" name="inventaris" required>
                                        <option selected>No. Inventarsi Peralatan</option>
                                        @foreach ($inventaris as $c)
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
                                    <input name="tgldigunakan" type="date" class="form-control" id="tgldigunakan" placeholder="" required>
                                    <label for="tgldigunakan">Tanggal Digunakan</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input name="teknisi" type="text" class="form-control" id="teknisi" placeholder="" required>
                                    <label for="teknisi">Teknisi</label>
                                </div>
                                <div class=" form-floating ">
                                    <button type="submit" class="btn btn-primary">Perbarui</button>
                                </div>
                            </div>        
                        </div>
                    </form>   


{{--  FORM PERALATAN  --}}
                    <form action="/addperalatan" method="POST" id="form-edit-peralatan" style="display: none;">
                        @csrf
                        <div class="col-sm-12 col-xl-12">
                            <div class="bg-secondary rounded h-100 p-4">
                                <h6 class="mb-4">Form Peralatan</h6>
                                <div class="form-floating mb-3">
                                    <input name="merek" type="text" class="form-control" id="merek"
                                        placeholder="">
                                    <label for="merek">Merek</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="inventaris" name="inventaris" required>
                                        <option selected>No. Inventarsi Peralatan</option>
                                        @foreach ($inventaris as $c)
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
                                    <input name="tgldigunakan" type="date" class="form-control" id="tgldigunakan" placeholder="" required>
                                    <label for="tgldigunakan">Tanggal Digunakan</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input name="teknisi" type="text" class="form-control" id="teknisi" placeholder="" required>
                                    <label for="teknisi">Teknisi</label>
                                </div>
                                <div class=" form-floating ">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>        
                        </div>
                    </form>   
          
@endsection