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
                                <input type="hidden" id="totalBelanja">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="">Bayar</label>
                        <input type="text" class="form-control" id="bayar" oninput="if (this.value !== '') hitungTotal(); validateInput(this)">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="">Kembalian</label>
                        <input type="text" id="kembalian" class="form-control" readonly>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="">Status</label>
                        <input type="text" id="status" class="form-control" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

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
                <form action="" method="post" onsubmit="return validateForm()">
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

                    <input type="hidden" name="Kode_Barang" id="kodeBarang" required>
                    <input type="hidden" name="Stok" id="stok" required>
                    <input type="hidden" id="hargaJual" required>
                    <input type="hidden" id="subtotal1" required>

                    <div class="modal-footer">
                        <button type="button" id="tutup" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" id="tambah" disabled="true" class="btn btn-primary" onclick="tambahBarang()">Tambah Keranjang</button>
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

        var button = document.getElementById('tambah');
        button.disabled = true;

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

        if (isNaN(hasil) && isNaN(jumlah1)) {
            var button = document.getElementById('tambah');
            button.disabled = true;
        } else {
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
                document.getElementById('subtotal1').value = hasil;
                var button = document.getElementById('tambah');
                button.disabled = false;
            }
        }
    }

    function hitungTotal() {
        var total = document.getElementById('totalBelanja').value;
        var kembalian = document.getElementById('kembalian');
        var status = document.getElementById('status');
        var bayar = document.getElementById('bayar').value;
        var uang = parseInt(bayar.replace(/,/g, ''), 10);

        var sisa = uang - total;

        var format = sisa.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });

        if (uang < total) {
            // console.log("Kurang");
            kembalian.value = 0;
            status.value = "hutang";
        } else {
            // console.log(sisa);
            kembalian.value = format;
            status.value = "lunas";
        }

    }

    var barang = [];
    console.log(barang);
    var namaBarangSet = new Set();

    function cekNamaBarang(arr) {
        for (var i = 0; i < arr.length; i++) {
            if (namaBarangSet.has(arr[i].namaBarang)) {
                return true;
            }
            namaBarangSet.add(arr[i].namaBarang);
        }
        // console.log(namaBarangSet);
        return false;
    }

    function jumlahBarangAda(barang, kodeBarang) {
        var totalJumlah = 0;
        var subtotal = 0;
        for (let i = 0; i < barang.length; i++) {
            if (barang[i].kodeBarang === kodeBarang) {
                totalJumlah += barang[i].jumlah;
                subtotal += barang[i].subtotal;
            }
        }
        return {
            totalJumlah,
            subtotal
        };
    }

    function tambahBarang() {
        var namaBarang = document.getElementById('namaBarang').value;
        var harga = document.getElementById('harga').value;
        var jumlah = parseInt(document.getElementById('jumlah').value);
        var subtotal = document.getElementById('subtotal').value;
        var subtotal1 = parseInt(document.getElementById('subtotal1').value);
        var kodeBarang = document.getElementById('kodeBarang').value;

        if (isNaN(jumlah)) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Harap isi jumlah dengan benar',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            var dataBarang = {
                namaBarang: namaBarang,
                harga: harga,
                jumlah: jumlah,
                subtotal: subtotal1,
                kodeBarang: kodeBarang
            }
            console.log(dataBarang);
            var format = subtotal.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });

            var total = barang.push(dataBarang)

            var cardBody = document.getElementById('detailBelanja');

            var row = document.createElement('div');
            row.classList.add('row');

            var col1 = document.createElement('div');
            col1.classList.add('col-sm-6');

            var col2 = document.createElement('div');
            col2.classList.add('col-sm-2', 'text-center');

            var col3 = document.createElement('div');
            col3.classList.add('col-sm-4', 'text-right');

            col1.innerHTML = '<label for="" class="namaBarang">' + dataBarang.namaBarang + '</label>';
            col2.innerHTML = '<label for="">' + dataBarang.jumlah + '<sup>x</sup></label>';
            col3.innerHTML = '<label for="">' + format + '</label>';

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

            let totalBelanja = 0;
            barang.forEach(data => {
                totalBelanja += (data.subtotal)
            });

            var total = totalBelanja.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });

            document.getElementById('total').textContent = total;
            document.getElementById('totalBelanja').value = totalBelanja;
        }
    }

    function validateInput(input) {
        // input.value = input.value.replace(/\D/g, "");
        var value = input.value.replace(/[^0-9]/g, '');

        if (value) {
            value = parseInt(value, 10).toLocaleString('en-US');
        }

        input.value = value;
    }

    function rupiah($angka) {
        $hasil_rupiah = "Rp. ".number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
</script>