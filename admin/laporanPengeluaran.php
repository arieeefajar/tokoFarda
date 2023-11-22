<?php
require '../koneksi.php';
require '../controller/laporanController.php';

$laporan = new laporan();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggalMulai = $_POST['tanggalMulai'];
    $tanggalSampai = $_POST['tanggalSampai'];

    // var_dump($tanggalMulai, $tanggalSampai);
    $result = $laporan->laporanPengeluaran($tanggalMulai, $tanggalSampai);
    $result1 = $laporan->totalPengeluaran($tanggalMulai, $tanggalSampai);
}
?>

<div class="card">
    <div class="card-body">
        <form action="" id="formTanggal">
            <div class="row">
                <div class="col-md-6">
                    <label for="">Mulai dari :</label>
                    <input type="date" name="tanggalMulai" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="">Sampai dari :</label>
                    <input type="date" name="tanggalSampai" class="form-control" onchange="submitFrom()">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="alert alert-warning alert-dismissible fade show mt-4" role="alert" id="alertWarning">
    <strong>Harap Pilih!</strong> tanggal mulai dan tanggal sampai terlebih dahulu.
</div>

<div class="alert alert-success alert-dismissible fade show mt-4" role="alert" id="alertSuccess">
    <?php if (isset($tanggalMulai) && isset($tanggalSampai)) : ?>
        Berikut adalah laporan pengeluaran dari tanggal <strong><?= $tanggalMulai; ?></strong> sampai tanggal <strong><?= $tanggalSampai; ?></strong>
    <?php endif; ?>
</div>

<div class="card mt-4" id="tablePemasukan" style="display: none;">
    <div class="card-header">
        Laporan Penjualan
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $key => $data) : ?>
                    <tr>
                        <td><?= $data['Kode_TransaksiBeli']; ?></td>
                        <td><?= $data['Tanggal']; ?></td>
                        <td>Rp. <?= number_format($data['Total']); ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer text-end">
        <label for=""><strong>Total Pengeluaran :</strong></label>
        <?php foreach ($result1 as $key => $data) : ?>
            <label for=""><strong>Rp. <?= number_format($data['totalPengeluaran']); ?></strong></label>
        <?php endforeach ?>
    </div>
</div>

<script>
    function submitFrom() {
        const formTanggal = document.getElementById('formTanggal');

        formTanggal.action = "<?= $_SERVER['PHP_SELF']; ?>?page=laporanPengeluaran";
        formTanggal.method = "POST";
        formTanggal.submit();

        localStorage.setItem('isSubmitFormExecuted', 'true');
    }

    function hiddenTable() {
        const alertSuccess = document.getElementById('alertSuccess');
        const alertWarning = document.getElementById('alertWarning');
        const table = document.getElementById('tablePemasukan');

        alertWarning.style.display = 'block';
        alertSuccess.style.display = 'none';
        table.style.display = 'none';
    }

    function showTable() {
        const alertSuccess = document.getElementById('alertSuccess');
        const alertWarning = document.getElementById('alertWarning');
        const table = document.getElementById('tablePemasukan');

        alertWarning.style.display = 'none';
        alertSuccess.style.display = 'block';
        table.style.display = 'block';
    }

    document.addEventListener("DOMContentLoaded", function() {
        const isSubmitFormExecuted = localStorage.getItem('isSubmitFormExecuted');
        // console.log(isSubmitFormExecuted);
        if (isSubmitFormExecuted == 'true') {
            showTable();
            localStorage.clear();
        } else {
            hiddenTable();
        }
    })
</script>