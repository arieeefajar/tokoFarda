<?php
require '../koneksi.php';
require '../controller/dashboardController.php';

$dashboard = new dashboard();
$result = $dashboard->totalPemasukan();
$result1 = $dashboard->totalPengeluaran();
$result2 = $dashboard->jumlahUser();
$result3 = $dashboard->hitungLaba();
$result4 = $dashboard->dataBarangExpired();
$result5 = $dashboard->dataStokBarang();

?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pemasukan</div>
                        <?php foreach ($result as $key => $data) : ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($data['totalPemasukan']); ?></div>
                        <?php endforeach ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Pengeluaran</div>
                        <?php foreach ($result1 as $key => $data) : ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($data['totalPengeluaran']); ?></div>
                        <?php endforeach ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Laba
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <?php foreach ($result3 as $key => $data) : ?>
                                    <?php
                                    $labaFormatted = ($data['laba'] < 0) ? 0 : $data['laba'];
                                    ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($labaFormatted); ?></div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Rugi</div>
                        <?php foreach ($result3 as $key => $data) : ?>
                            <?php $rugiFormatted = ($data['laba'] < 0) ? abs($data['laba']) : 0 ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($rugiFormatted); ?></div>
                        <?php endforeach ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Pembelian</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe title="Report Section" src="https://app.powerbi.com/view?r=eyJrIjoiODRlODdmMWMtZWViNS00MmZlLWFmMjgtOWNmYzQwNDgxNjE0IiwidCI6IjUyNjNjYzgxLTU5MTItNDJjNC1hYmMxLWQwZjFiNjY4YjUzMCIsImMiOjEwfQ%3D%3D&focusMode=true" frameborder="0" allowFullScreen="true"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Pembelian</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Barang Expired</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result4 as $key => $data) : ?>
                                <tr>
                                    <th><?= $data['Kode_Barang']; ?></th>
                                    <th><?= $data['Nama_Barang']; ?></th>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">

        <!-- Illustrations -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Stok Barang</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result5 as $key => $data) : ?>
                                <tr>
                                    <td><?= $data['Kode_Barang']; ?></td>
                                    <td><?= $data['Nama_Barang']; ?></td>
                                    <td><?= $data['Stok']; ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>