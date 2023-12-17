<?php
require '../koneksi.php';
require '../controller/laporanController.php';

$laporan = new laporan();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggalMulai = $_POST['tanggalMulai'];
    $tanggalSampai = $_POST['tanggalSampai'];

    // var_dump($tanggalMulai, $tanggalSampai);
    $result = $laporan->laporanPendapatan($tanggalMulai, $tanggalSampai);
    $result1 = $laporan->totalPendapatan($tanggalMulai, $tanggalSampai);

    $timestamp = strtotime($tanggalMulai);
    $formattedDate = date("d F Y", $timestamp);

    $timestamp1 = strtotime($tanggalSampai);
    $formattedDate1 = date("d F Y", $timestamp1);
}
?>

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary" data-bs-toggle="modal" data-bs-target="#tambahModal"> Laporan Pemasukan</h6>
    </div>
    <div class="card-body">
        <form action="" id="formTanggal">
            <div class="row">
                <div class="col-md-6">
                    <label for="">Mulai dari :</label>
                    <input type="date" name="tanggalMulai" id="tanggalMulai" class="form-control" value="<?= $tanggalMulai; ?>">
                </div>
                <div class="col-md-6">
                    <label for="">Sampai dari :</label>
                    <input type="date" name="tanggalSampai" id="tanggalSampai" class="form-control" onchange="submitFrom();" value="<?= $tanggalSampai; ?>">
                </div>
            </div>
        </form>

        <!-- <form action="" id="formTanggal1">
            <div class="row">
                <div class="col-md-6">
                    <label for="">Mulai dari :</label>
                    <input type="date" name="tanggalMulai1" id="tanggalMulai1" class="form-control" value="<?= $tanggalMulai; ?>">
                </div>
                <div class="col-md-6">
                    <label for="">Sampai dari :</label>
                    <input type="date" name="tanggalSampai1" id="tanggalSampai1" class="form-control" value="<?= $tanggalSampai; ?>">
                </div>
            </div>
        </form> -->
    </div>
</div>

<div class="alert alert-warning alert-dismissible fade show mt-4" role="alert" id="alertWarning">
    <strong>Harap Pilih!</strong> tanggal mulai dan tanggal sampai terlebih dahulu.
</div>

<div class="alert alert-success alert-dismissible fade show mt-4" role="alert" id="alertSuccess">
    <?php if (isset($tanggalMulai) && isset($tanggalSampai)) : ?>
        Berikut adalah laporan pemasukan dari tanggal <strong><?= $formattedDate; ?></strong> sampai tanggal <strong><?= $formattedDate1; ?></strong>
    <?php endif; ?>
</div>

<div class="card mt-4" id="tablePemasukan" style="display: none;">
    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
        Data Laporan Pemasukan
        <form action="../cetak/laporanPemasukan.php" method="POST">
            <input type="hidden" name="tanggalMulai1" value="<?= $tanggalMulai; ?>">
            <input type="hidden" name="tanggalSampai1" value="<?= $tanggalSampai; ?>">
            <button type="submit" name="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak</button>
            <button type="submit" name="submit" class="d-sm-none btn btn-sm btn-primary shadow-sm mt-3">
                <i class="fas fa-download fa-sm text-white-50"></i> Cetak
            </button>
        </form>
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
                        <td><?= $data['Kode_TransaksiJual']; ?></td>
                        <td><?= $data['Tanggal']; ?></td>
                        <td>Rp. <?= number_format($data['Total']); ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer text-end">
        <label for=""><strong>Total Pendapatan :</strong></label>
        <?php foreach ($result1 as $key => $data) : ?>
            <label for=""><strong>Rp. <?= number_format($data['totalPendapatan']); ?></strong></label>
        <?php endforeach ?>
    </div>
</div>

<script>
    function submitFrom() {
        const formTanggal = document.getElementById('formTanggal');

        formTanggal.action = "<?= $_SERVER['PHP_SELF']; ?>?page=laporanPemasukan";
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