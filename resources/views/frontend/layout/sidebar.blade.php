

{{--  <!-- Sidebar Start -->  --}}
    <div class="sidebar pe-6 pb-3">
        <nav class="navbar bg-secondary navbar-dark">
            <a href="index.html" class="navbar-brand mx-4 mb-3">
                <h3 class="" style="color: rgb(255, 160, 0);" >Service Form</h3>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="{{ asset('') }}assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0">{{ auth()->user()->name}}</h6>
                    <span>Admin</span>
                </div>
            </div>
            <div class="navbar-nav w-100">
                <a href="{{url('dashboard')}}" class="nav-item nav-link {{ Request::is('dashboard') ? 'active' : '' }}"><i <i class="fa fa-home me-2"></i>Home</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-car me-2"></i>Kendaraan</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ url('kendaraan') }}" class="dropdown-item {{ Route::currentRouteName() === 'kendaraan' ? 'active' : '' }}">
                            Kendaraan
                        </a>
                        <a href="{{ url('pengerjaan') }}" class="dropdown-item {{ Route::currentRouteName() === 'pengerjaan' ? 'active' : '' }}">
                            Form Service
                        </a>
                    </div>
                </div>                
                <a href="{{url('barang')}}" class="nav-item nav-link {{ Request::is('barang') ? 'active' : '' }}"><i class="bi bi-gear me-2"></i>Peralatan Inventaris</a>
                <a href="{{url('peralatan')}}" class="nav-item nav-link {{ Request::is('peralatan') ? 'active' : '' }}" id="close-list-history"><i class="bi bi-tools me-2"></i>Peralatan Rusak</a>
                {{--  <a href="{{url('register')}}" class="nav-item nav-link"><i class="bi bi-pen me-2"></i>Register</a>                --}}
            </div>
        </nav>
    </div>
{{--  <!-- Sidebar End -->  --}}