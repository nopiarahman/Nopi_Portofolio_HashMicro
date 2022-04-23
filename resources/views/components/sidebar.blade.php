<div>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="mdi mdi-grid-large menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            {{-- Master Data --}}
            <li class="nav-item @yield('menuInput')">
                <a class="nav-link" href="{{ url('/inputTest') }}">
                    <i class="menu-icon mdi mdi-car-connected"></i>
                    <span class="menu-title">Input Test</span>
                </a>
            </li>
            {{-- Master Data --}}
            <li class="nav-item nav-category">MASTER DATA</li>
            <li class="nav-item @yield('menuBarang')">
                <a class="nav-link" data-bs-toggle="collapse" href="#barang" aria-expanded="false"
                    aria-controls="barang">
                    <i class="menu-icon mdi mdi-package-variant-closed"></i>
                    <span class="menu-title">Barang</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="barang">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item @yield('menuPembelian')"><a class="nav-link"
                                href="{{ url('/pembelian') }}">Pembelian
                                dari Supplier</a></li>
                        <li class="nav-item @yield('menuStok')"><a class="nav-link"
                                href="{{ url('/barang') }}">Stok</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item @yield('menuSupplier')">
                <a class="nav-link" href="{{ url('/supplier') }}">
                    <i class="menu-icon mdi mdi-car-connected"></i>
                    <span class="menu-title">Supplier</span>
                </a>
            </li>
            {{-- Keuangan --}}
            <li class="nav-item nav-category">KEUANGAN</li>
            <li class="nav-item @yield('menuPenjualan')">
                <a class="nav-link" href="{{ url('/penjualan') }}">
                    <i class="menu-icon mdi mdi-car-connected"></i>
                    <span class="menu-title">Penjualan</span>
                </a>
            </li>
            <li class="nav-item @yield('menuTransaksi')">
                <a class="nav-link" href="{{ url('/transaksi') }}">
                    <i class="menu-icon mdi mdi-autorenew"></i>
                    <span class="menu-title">Transaksi</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#kas" aria-expanded="false"
                    aria-controls="kas">
                    <i class="menu-icon mdi mdi-wallet"></i>
                    <span class="menu-title">Kas</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="kas">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="#">Kas Besar</a></li>
                        <li class="nav-item"> <a class="nav-link" href="#">Kas Kecil</a></li>
                    </ul>
                </div>
            </li> --}}
            {{-- Settings --}}
            {{-- <li class="nav-item nav-category">pengaturan</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="menu-icon mdi mdi-account-key"></i>
                    <span class="menu-title">Kelola User</span>
                </a>
            </li> --}}

            {{-- Bantuan --}}
            <li class="nav-item nav-category">Bantuan</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="menu-icon mdi mdi-help-circle-outline"></i>
                    <span class="menu-title">Petunjuk Penggunaan</span>
                </a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        <i class="menu-icon mdi mdi-power" style="color:brown"></i>
                        <span class="menu-title" style="color:brown">Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </nav>
</div>
