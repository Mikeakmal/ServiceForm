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


            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">List Peralatan</h6>
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
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>YAMAHA</td>
                                            <td>HJ124548</td>
                                            <td>YAMATO</td>
                                            <td>AKI</td>
                                            <td>12 DESEMBER 2023</td>
                                            <td>Yukimato</td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                <button type="submit" class="btn btn-primary">Hapus</button>
                                            </td>                          
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>HONDA</td>
                                            <td>KI15648</td>
                                            <td>YAMATO</td>
                                            <td>AKI</td>
                                            <td>12 MEI 2023</td>
                                            <td>Yukimato</td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                <button type="submit" class="btn btn-primary">Hapus</button>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>YAMAHA</td>
                                            <td>GG4565</td>
                                            <td>YAMATO</td>
                                            <td>AKI</td>
                                            <td>12 JULI 2023</td>
                                            <td>Yukimato</td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                <button type="submit" class="btn btn-primary">Hapus</button>
                                            </td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Form Peralatan</h6>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="merek"
                                    placeholder="">
                                <label for="merek">Merek</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="inventaris"
                                    aria-label="Floating label select example">
                                    <option selected>No. Inventarsi Peralatan</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="inventaris">Works with selects</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="karyawan"
                                    placeholder="">
                                <label for="karyawan">Nama Karyawan</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="alat"
                                    placeholder="">
                                <label for="alat">Alat Rusak</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="tgldigunakan"
                                    placeholder="">
                                <label for="tgldigunakan">Tanggal Digunakan</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="teknisi"
                                    placeholder="">
                                <label for="teknisi">Teknisi</label>
                            </div>
                            <div class=" form-floating ">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>        
                    </div>
                </div>
            </div>

@endsection