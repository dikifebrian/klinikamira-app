<aside class="main-sidebar sidebar-light-olive elevation-4">
    <a href="/dashboard" class="brand-link">
        <img src="{{ asset('style/dist/img/logoamira.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Amira Aesthetic Clinic</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="{{ asset('style/dist/img/user7-128x128.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
                </li>
                @if (auth()->user()->level=="manajer" || auth()->user()->level=="dokter" || auth()->user()->level=="kasir")
                <li class="nav-item">
                    <a href="/pasien" class="nav-link {{ request()->is('pasien') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Data Pasien</p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->level=="manajer" || auth()->user()->level=="dokter" || auth()->user()->level=="kasir")
                <li class="nav-item {{ request()->is('tindakan', 'facial', 'produk') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('tindakan', 'facial', 'produk') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                        Jenis Perawatan
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/tindakan" class="nav-link {{ request()->is('tindakan',) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Tindakan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/facial" class="nav-link {{ request()->is('facial') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Facial</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/produk" class="nav-link {{ request()->is('produk') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Produk</p>
                        </a>
                    </li>
                    </ul>
                </li>
                @endif
                @if (auth()->user()->level=="manajer" || auth()->user()->level=="dokter" || auth()->user()->level=="kasir" || auth()->user()->level=="terapis")
                <li class="nav-item">
                    <a href="/rekammedis" class="nav-link {{ request()->is('rekammedis') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>Data Rekam Medis</p>
                    </a>
                </li>
                @endif
                <li class="nav-header">SETTING</li>
                @if (auth()->user()->level=="manajer")
                <li class="nav-item">
                    <a href="/pengguna" class="nav-link {{ request()->is('pengguna') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Pengguna</p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>