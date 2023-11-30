<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../layout/home.php">
        <div class="sidebar-brand-icon">
            <i class="fa fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Toko Farda</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="?page">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <?php if ($_SESSION['level'] == "Admin") { ?>

        <!-- Master menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Master</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Master Menu:</h6>
                    <a class="collapse-item" href="?page=dataUser">Data User</a>
                    <a class="collapse-item" href="?page=dataBarang">Data Barang</a>
                    <a class="collapse-item" href="?page=dataHutang">Data Hutang</a>
                </div>
            </div>
        </li>

        <!-- Transaksi menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksiMenu" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-money-bill-wave"></i>
                <span>Transaksi</span>
            </a>
            <div id="transaksiMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Transaksi Menu:</h6>
                    <a class="collapse-item" href="?page=transaksiJual">Jual</a>
                    <a class="collapse-item" href="?page=transaksiBeli">Beli</a>
                </div>
            </div>
        </li>

        <!-- Laporan menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporanMenu" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-book"></i>
                <span>Laporan</span>
            </a>
            <div id="laporanMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Laporan Menu:</h6>
                    <a class="collapse-item" href="?page=laporanPemasukan">Pemasukan</a>
                    <a class="collapse-item" href="?page=laporanPengeluaran">Pengeluaran</a>
                </div>
            </div>
        </li>

    <?php } elseif ($_SESSION['level'] == "Kasir") { ?>

        <!-- Transaksi menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksiMenu" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-money-bill-wave"></i>
                <span>Transaksi</span>
            </a>
            <div id="transaksiMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Transaksi Menu:</h6>
                    <a class="collapse-item" href="?page=transaksiJual">Jual</a>
                    <a class="collapse-item" href="?page=transaksiBeli">Beli</a>
                </div>
            </div>
        </li>

    <?php } else { ?>

        <!-- Master menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Master</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Master Menu:</h6>
                    <a class="collapse-item" href="?page=dataUser">Data User</a>
                    <a class="collapse-item" href="?page=dataBarang">Data Barang</a>
                    <a class="collapse-item" href="?page=dataHutang">Data Hutang</a>
                </div>
            </div>
        </li>

        <!-- Laporan menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporanMenu" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-book"></i>
                <span>Laporan</span>
            </a>
            <div id="laporanMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Laporan Menu:</h6>
                    <a class="collapse-item" href="?page=laporanPemasukan">Pemasukan</a>
                    <a class="collapse-item" href="?page=laporanPengeluaran">Pengeluaran</a>
                </div>
            </div>
        </li>

    <?php } ?>

    <!-- Nav Item - Tables -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>