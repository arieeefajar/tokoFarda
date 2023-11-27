<?php
require '../koneksi.php';
require '../controller/dashboardController.php';

$dashboard = new dashboard();
$result = $dashboard->jumlahTransaksiJualSekarang();
$result1 = $dashboard->jumlahTransaksiBeliSekarang();
$result2 = $dashboard->jumlahBarangExpired();
$result3 = $dashboard->jumlahBarangStok();
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
                            Jumlah Transaksi Jual</div>
                        <?php foreach ($result as $key => $data) : ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['tanggalTransaksiJualSekarang']; ?></div>
                        <?php endforeach ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                            Jumlah Transaksi Beli</div>
                        <?php foreach ($result1 as $key => $data) : ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['tanggalTransaksiBeliSekarang']; ?></div>
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
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Barang Expired
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <?php foreach ($result2 as $key => $data) : ?>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $data['barangExpired']; ?></div>
                                <?php endforeach; ?>
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
                            Stok Barang Sedikit</div>
                        <?php foreach ($result3 as $key => $data) : ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['stokBarang']; ?></div>
                        <?php endforeach ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
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