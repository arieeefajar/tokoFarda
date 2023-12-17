<?php
require '../koneksi.php';
require '../controller/historiController.php';

$histori = new histori();
$result = $histori->showTransaksiBeli();

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Histori Transaksi Beli</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Bayar</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Bayar</th>
                        <th>User</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($result as $key => $data) : ?>
                        <tr>
                            <td><?= $data['Kode_TransaksiBeli'] ?></td>
                            <td><?= $data['Tanggal']; ?></td>
                            <td>Rp. <?= number_format($data['Total']); ?></td>
                            <td>Rp. <?= number_format($data['Bayar']); ?></td>
                            <td><?= $data['Nama_User']; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>