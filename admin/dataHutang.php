<?php
require '../koneksi.php';
require '../controller/hutangController.php';

$dataHutang = new dataHutang();
$result = $dataHutang->index();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['Status'];

    if ($status == 'Lunas') {
        $kodeTransaksi = $_POST['Kode_TransaksiJual'];
        $status = $_POST['Status'];
        $idHutang = $_POST['id_Hutang'];
        $dataHutang->delete($status, $kodeTransaksi, $idHutang);
    } elseif ($status == 'Hutang') {
        $sisa = $_POST['Sisa1'];
        $idHutang = $_POST['id_Hutang'];
        // var_dump($sisa);
        $dataHutang->edit($sisa, $idHutang);
    }
}

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Data Hutang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>Jumlah Hutang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>Jumlah Hutang</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($result as $key => $data) : ?>
                        <tr>
                            <td><?= $data['Kode_TransaksiJual']; ?></td>
                            <td><?= $data['Nama_Pelanggan']; ?></td>
                            <td><?= $data['No_Telp']; ?></td>
                            <td><?= $data['Alamat']; ?></td>
                            <td>Rp. <?= number_format($data['Jumlah_Hutang']); ?></td>
                            <td>
                                <button type="button" class="btn btn-primary btn-circle" data-bs-toggle="modal" data-bs-target="#editModal" onclick='edit(<?= json_encode($data); ?>)'>
                                    <i class="fas fa-pen"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bayar Hutang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataHutang" method="POST" id="formEdit">
                    <div class="mb-3">
                        <label for="">Jumlah Hutang</label>
                        <input type="text" name="Jumlah_Hutang" id="jumlahHutang" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="">Bayar</label>
                        <input type="text" name="Bayar" id="Bayar" class="form-control" oninput="if (this.value !== '') funcBayar(); validateInput(this)" required>
                    </div>

                    <div class="mb-3">
                        <label for="">Sisa</label>
                        <input type="text" name="Sisa" id="Sisa" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="">Status</label>
                        <input type="text" name="Status" id="Status" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="">Kembalian</label>
                        <input type="text" name="Kembalian" id="Kembalian" class="form-control" readonly>
                    </div>

                    <input type="hidden" name="Jumlah_Hutang1" id="jumlahHutang1">
                    <input type="hidden" name="Sisa1" id="Sisa1">
                    <input type="hidden" name="id_Hutang" id="idHutang">
                    <input type="hidden" name="Kode_TransaksiJual" id="kodeTransaksi">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function formatAngka(data) {
        var angka = parseInt(data);
        var format = angka.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
        return format;
    }

    function validateInput(input) {
        // input.value = input.value.replace(/\D/g, "");
        var value = input.value.replace(/[^0-9]/g, '');

        if (value) {
            value = parseInt(value, 10).toLocaleString('en-US');
        }

        input.value = value;
    }

    function edit(data) {
        // console.log(data);
        const jumlahHutang = document.getElementById('jumlahHutang');
        const jumlahHutang1 = document.getElementById('jumlahHutang1');
        const idHutang = document.getElementById('idHutang');
        const kodeTransaksi = document.getElementById('kodeTransaksi');

        jumlahHutang.value = formatAngka(data.Jumlah_Hutang);
        jumlahHutang1.value = data.Jumlah_Hutang;
        idHutang.value = data.id_Hutang;
        kodeTransaksi.value = data.Kode_TransaksiJual;
        // console.log(kodeTransaksi);
    }

    function funcBayar() {
        const jumlahHutang = parseInt(document.getElementById('jumlahHutang1').value);
        const bayar = document.getElementById('Bayar').value;
        const uang = parseInt(bayar.replace(/,/g, ''), 10);
        const sisa = document.getElementById('Sisa');
        const sisa1 = document.getElementById('Sisa1');
        const kembalian = document.getElementById('Kembalian');
        const status = document.getElementById('Status');
        const hasil = jumlahHutang - uang;

        if (hasil > 0) {
            sisa.value = formatAngka(hasil);
            sisa1.value = hasil;
            status.value = 'Hutang';
            kembalian.value = 0;
            // console.log(sisa);
        } else {
            sisa.value = 0;
            sisa1.value = 0;
            status.value = 'Lunas';
            kembalian.value = formatAngka(uang - jumlahHutang);
        }
    }
</script>