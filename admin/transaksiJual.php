<?php
require '../koneksi.php';
require '../controller/transaksiJual.php';

$transaksiJual = new transaksiJual();
$result = $transaksiJual->showBarang();

?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Data Barang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button type="button" class="btn btn-warning btn-icon-split mb-3" data-bs-toggle="modal" data-bs-target="#kranjangModal">
                    <span class="icon text-white-50">
                        <i class="fas fa-cart-arrow-down"></i>
                    </span>
                    <span class="text">Keranjang <sup id="count"></sup></span>
                </button>
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Tanggal Expired</th>
                        <th>Harga Jual</th>
                        <th>Stock</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Tanggal Expired</th>
                        <th>Harga Jual</th>
                        <th>Stock</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($result as $key => $data) : ?>
                        <tr>
                            <td><?= $data['Kode_Barang'] ?></td>
                            <td><?= $data['Nama_Barang']; ?></td>
                            <td><?= $data['Tgl_Expired']; ?></td>
                            <td>Rp. <?= number_format($data['Harga_Jual']); ?></td>
                            <td><?= $data['Stok']; ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary btn-circle" data-bs-toggle="modal" data-bs-target="#detailModal" onclick='detail(<?= json_encode($data); ?>)'>
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Table Kranjang -->
<div class="modal fade" id="kranjangModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Belanja</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Nama Barang</label>
                            </div>
                            <div class="col-sm-2 text-center">
                                <label for="">Jumlah</label>
                            </div>
                            <div class="col-sm-4 text-right">
                                <label for="">Subtotal</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="detailBelanja">
                        <div class="row">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col">
                                <label for="">Total</label>
                            </div>
                            <div class="col text-right">
                                <label for="" id="total"></label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="">Bayar</label>
                        <input type="text" class="form-control" oninput="validateInput(this)">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="">Kembalian</label>
                        <input type="text" class="form-control" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Kranjang -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Nama Barang</label>
                        <input type="text" name="Nama_Barang" id="namaBarang" class="form-control" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="">Harga</label>
                        <input type="text" name="Harga_Jual" id="harga" class="form-control" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="">Jumlah</label>
                        <input type="text" name="Jumlah" id="jumlah" class="form-control" required oninput="if (this.value !== '') hitungSubtotal(); validateInput(this)">
                    </div>
                    <div class="">
                        <label for="">Subtotal</label>
                        <input type="text" name="Subtotal" id="subtotal" class="form-control" required readonly>
                    </div>

                    <input type="hidden" name="Kode_Barang" id="kodeBarang">
                    <input type="hidden" name="Stok" id="stok">
                    <input type="hidden" id="hargaJual">

                    <div class="modal-footer">
                        <button type="button" id="tutup" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" id="tambah" class="btn btn-primary" onclick="tambahBarang()">Tambah Keranjang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function detail(data) {
        // console.log(data);
        var hargaJual = parseInt(data.Harga_Jual)
        var format = hargaJual.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
        document.getElementById('harga').value = format

        document.getElementById('namaBarang').value = data.Nama_Barang
        document.getElementById('kodeBarang').value = data.Kode_Barang
        document.getElementById('stok').value = data.Stok
        document.getElementById('hargaJual').value = data.Harga_Jual
    };

    function hitungSubtotal() {
        var stok = parseInt(document.getElementById('stok').value);
        var jumlah = document.getElementById('jumlah');
        var harga = document.getElementById('hargaJual');

        var harga1 = parseInt(harga.value);
        var jumlah1 = parseInt(jumlah.value);

        var hasil = harga1 * jumlah1

        var format = hasil.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
        // console.log(format);

        if (jumlah1 > stok) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Stok tidak mencukupi',
                showConfirmButton: false,
                timer: 1500
            });
            document.getElementById('subtotal').value = "";
            var button = document.getElementById('tambah');
            button.disabled = true;
        } else {
            document.getElementById('subtotal').value = format;
            var button = document.getElementById('tambah');
            button.disabled = false;
        }

    }

    var barang = [];

    function tambahBarang() {
        var namaBarang = document.getElementById('namaBarang').value;
        var harga = document.getElementById('harga').value;
        var jumlah = document.getElementById('jumlah').value;
        var subtotal = document.getElementById('subtotal').value;
        var kodeBarang = document.getElementById('kodeBarang').value;

        var dataBarang = {
            namaBarang: namaBarang,
            harga: harga,
            jumlah: jumlah,
            subtotal: subtotal,
            kodeBarang: kodeBarang
        }

        var total = barang.push(dataBarang)
        var subtotal = dataBarang.subtotal
        // console.log(subtotal);

        var cardBody = document.getElementById('detailBelanja');
        var cardFooter = document.getElementById('cardFooter');

        var row = document.createElement('div');
        row.classList.add('row');

        var col1 = document.createElement('div');
        col1.classList.add('col-sm-6');
        col1.innerHTML = '<label for="">' + dataBarang.namaBarang + '</label>';

        var col2 = document.createElement('div');
        col2.classList.add('col-sm-2', 'text-center');
        col2.innerHTML = '<label for="">' + dataBarang.jumlah + '<sup>x</sup></label>';

        var col3 = document.createElement('div');
        col3.classList.add('col-sm-4', 'text-right');
        col3.innerHTML = '<label for="">' + dataBarang.subtotal + '</label>';

        row.appendChild(col1);
        row.appendChild(col2);
        row.appendChild(col3);
        cardBody.appendChild(row);

        document.getElementById('jumlah').value = "";
        document.getElementById('subtotal').value = "";

        var count = document.getElementById('count');
        count.textContent = total;

        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Data berhasil ditambahkan',
            showConfirmButton: false,
            timer: 1500
        });

        document.getElementById('tutup').click();

        // console.log(barang);

        let totalBelanja = 0;
        barang.forEach(data => {
            totalBelanja += data.subtotal
            console.log(data.subtotal);
        });
        document.getElementById('total').textContent = totalBelanja;
    }

    function validateInput(input) {
        input.value = input.value.replace(/\D/g, "");
    }

    function rupiah($angka) {
        $hasil_rupiah = "Rp. ".number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
</script>