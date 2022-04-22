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
            <li class="nav-item nav-category">MASTER DATA</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#order" aria-expanded="false"
                    aria-controls="order">
                    <i class="menu-icon mdi mdi-human-greeting"></i>
                    <span class="menu-title">Pembelian</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/barang') }}">
                    <i class="menu-icon mdi mdi-package-variant-closed"></i>
                    <span class="menu-title">Stok Barang</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/logistik') }}">
                    <i class="menu-icon mdi mdi-car-connected"></i>
                    <span class="menu-title">Supplier</span>
                </a>
            </li>
            {{-- Keuangan --}}
            <li class="nav-item nav-category">KEUANGAN</li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#transaksi" aria-expanded="false"
                    aria-controls="transaksi">
                    <i class="menu-icon mdi mdi-autorenew"></i>
                    <span class="menu-title">Transaksi</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="transaksi">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="#">Masuk</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Keluar</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
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
            </li>
            {{-- Settings --}}
            <li class="nav-item nav-category">pengaturan</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="menu-icon mdi mdi-account-key"></i>
                    <span class="menu-title">Kelola User</span>
                </a>
            </li>

            {{-- Bantuan --}}
            <li class="nav-item nav-category">Bantuan</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="menu-icon mdi mdi-help-circle-outline"></i>
                    <span class="menu-title">Petunjuk Penggunaan</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
