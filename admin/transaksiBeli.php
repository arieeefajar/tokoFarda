<?php
require '../koneksi.php';
require '../controller/transaksiBeli.php';

$transaksiBeli = new transaksiBeli();
$result = $transaksiBeli->showBarang();

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Data Barang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button type="button" id="buttonKeranjang" class="btn btn-warning btn-icon-split mb-3" data-bs-toggle="modal" data-bs-target="#kranjangModal" onclick="bayar()">
                    <span class="icon text-white-50">
                        <i class="fas fa-cart-arrow-down"></i>
                    </span>
                    <span class="text">Keranjang <sup id="count">x</sup></span>
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
                            <td>Rp. <?= number_format($data['Harga_Beli']); ?></td>
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
                                <input type="hidden" id="total1">
                            </div>
                        </div>

                    </div>
                </div>
                <!-- <div class="card">
                    <div class="card-body">
                        <ul id="keranjang"></ul>
                    </div>
                </div> -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="">Bayar</label>
                        <input type="text" class="form-control" id="bayar" oninput="bayar(); validateInput(this)">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="">Kembalian</label>
                        <input type="text" id="kembalian" class="form-control" readonly>
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
                        <input type="text" name="Jumlah" id="jumlah" class="form-control" required oninput="hitungSubtotal();">
                    </div>
                    <div class="">
                        <label for="">Subtotal</label>
                        <input type="text" name="Subtotal" id="subtotal" class="form-control" required readonly>
                    </div>

                    <input type="hidden" name="Kode_Barang" id="kodeBarang">
                    <input type="hidden" name="Stok" id="stok">
                    <input type="hidden" id="hargaBeli">
                    <input type="hidden" id="subtotal1">

                    <div class="modal-footer">
                        <button type="button" id="tutup" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" id="tambah" onclick="tambahKeranjang()" class="btn btn-primary">Tambah Keranjang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var keranjangBelanja = {};
    const buttonKeranjang = document.getElementById('buttonKeranjang');
    const keranjangKeys = Object.keys(keranjangBelanja);

    if (keranjangKeys.length === 0) {
        buttonKeranjang.disabled = true;
    }

    function detail(data) {
        const hargaBeli = parseInt(document.getElementById('hargaBeli').value = data.Harga_Beli)
        var format = hargaBeli.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });

        const harga = document.getElementById('harga').value = format
        const namaBarang = document.getElementById('namaBarang').value = data.Nama_Barang
        const kodeBarang = document.getElementById('kodeBarang').value = data.Kode_Barang

        const button = document.getElementById('tambah');
        button.disabled = true;
    }

    function hitungSubtotal() {
        const hargaBeli = document.getElementById('hargaBeli').value
        const jumlah = document.getElementById('jumlah').value
        // console.log(hargaBeli, jumlah);

        const hasil = jumlah * hargaBeli
        var format = hasil.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
        const subtotal = document.getElementById('subtotal').value = format;
        const subtotal1 = document.getElementById('subtotal1').value = hasil;
        const button = document.getElementById('tambah')

        if (isNaN(hasil) && isNaN(jumlah)) {
            button.disabled = true;
        } else {
            button.disabled = false;
        }

    }

    function tambahKeranjang() {
        // console.log("oke");
        const kodeBarang = document.getElementById('kodeBarang').value
        const namaBarang = document.getElementById('namaBarang').value
        const jumlah = parseInt(document.getElementById('jumlah').value)
        const subtotal1 = parseInt(document.getElementById('subtotal1').value)

        if (keranjangBelanja[kodeBarang]) {
            keranjangBelanja[kodeBarang].jumlah += jumlah;
            keranjangBelanja[kodeBarang].subtotal += subtotal1;
        } else {
            keranjangBelanja[kodeBarang] = {
                namaBarang: namaBarang,
                jumlah: jumlah,
                subtotal: subtotal1,
            }
        }

        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Data berhasil ditambahkan',
            showConfirmButton: false,
            timer: 1500
        });

        document.getElementById('jumlah').value = "";
        document.getElementById('subtotal').value = "";
        document.getElementById('tutup').click();
        buttonKeranjang.disabled = false;

        perbaruiTampilanKeranjang();
    }

    function perbaruiTampilanKeranjang() {
        const keranjangElement = document.getElementById("detailBelanja");
        const count = document.getElementById('count');
        const totalBarang = Object.values(keranjangBelanja).length;

        keranjangElement.innerHTML = "";
        count.textContent = totalBarang;

        // Loop melalui item di keranjang dan tampilkan
        for (const kodeBarang in keranjangBelanja) {
            const {
                namaBarang,
                jumlah,
                subtotal,
            } = keranjangBelanja[kodeBarang];

            var format = subtotal.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });

            var row = document.createElement('div');
            row.classList.add('row');

            var col1 = document.createElement('div');
            col1.classList.add('col-sm-6');
            col1.innerHTML = `${namaBarang}`;

            var col2 = document.createElement('div');
            col2.classList.add('col-sm-2', 'text-center');
            col2.innerHTML = `${jumlah}`;

            var col3 = document.createElement('div');
            col3.classList.add('col-sm-4', 'text-right');
            col3.innerHTML = format;

            row.appendChild(col1);
            row.appendChild(col2);
            row.appendChild(col3);
            keranjangElement.appendChild(row);

            const totalBelanja = document.getElementById('total')
            const totalBelanja1 = document.getElementById('total1')
            const total = Object.values(keranjangBelanja).reduce(function(accumulator, barang) {
                return accumulator + barang.subtotal;
            }, 0);
            var format1 = total.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });

            totalBelanja.textContent = format1
            totalBelanja1.value = total
            console.log(totalBelanja1);
        }
    }

    function bayar() {
        const totalBelanja = parseInt(document.getElementById('total1').value)
        const bayar = document.getElementById('bayar').value
        const uang = parseInt(bayar.replace(/,/g, ''), 10);
        const kembalian = document.getElementById('kembalian')

        const sisa = uang - totalBelanja;
        var format = sisa.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });

        if (uang < totalBelanja) {
            kembalian.value = "Rp." + 0;
        } else {
            // if (isNaN(sisa) || isNaN(format)) {
            //     kembalian.value = "Rp. 0";
            // } else {
            //     console.log(format);
            //     kembalian.value = format;
            // }
            kembalian.value = format;
        }
        // console.log(totalBelanja, uang, format);
    }

    function validateInput(input) {
        // input.value = input.value.replace(/\D/g, "");
        var value = input.value.replace(/[^0-9]/g, '');

        if (value) {
            value = parseInt(value, 10).toLocaleString('en-US');
        }

        input.value = value;
    }
</script>

<!-- localstorage -->
<!-- <script>
    if (localStorage.getItem('data') == null) {
        localStorage.setItem('data', '[]');
    }

    function simpan() {
        const jumlah = document.getElementById('jumlah')
        let penyimpanan = JSON.parse(localStorage.getItem('data'));

        penyimpanan.push(` ${jumlah.value}`);
        localStorage.setItem('data', JSON.stringify(penyimpanan));

        document.getElementById('subtotal').value = JSON.parse(localStorage.getItem('data'))
    }
</script> -->

<!-- <h1>Keranjang Belanja</h1>

<div>
    <label for="item">Pilih Item:</label>
    <select id="item">
        <option value="kopi">Kopi</option>
        <option value="tehManis">Teh Manis</option>
    </select>

    <label for="jumlah">Jumlah:</label>
    <input type="number" id="jumlah1" min="1" value="1">

    <button onclick="tambahKeKeranjang()">Tambah ke Keranjang</button>
</div>

<div>
    <h2>Keranjang Belanja</h2>
    <ul id="keranjang"></ul>
</div>

<script>
    // Objek untuk menyimpan keranjang belanja
    var keranjangBelanja = {};

    function tambahKeKeranjang() {
        var item = document.getElementById("item").value;
        var jumlah = parseInt(document.getElementById("jumlah1").value);

        // Periksa apakah item sudah ada di keranjang
        if (keranjangBelanja[item]) {
            // Jika sudah ada, tambahkan jumlahnya
            keranjangBelanja[item] += jumlah;
        } else {
            // Jika belum, tambahkan item baru
            keranjangBelanja[item] = jumlah;
        }

        // Perbarui tampilan keranjang belanja
        perbaruiTampilanKeranjang();
        console.log(jumlah);
    }

    function perbaruiTampilanKeranjang() {
        var keranjangElement = document.getElementById("keranjang");
        keranjangElement.innerHTML = "";

        // Loop melalui item di keranjang dan tampilkan
        for (var item in keranjangBelanja) {
            var jumlah = keranjangBelanja[item];
            var li = document.createElement("li");
            li.textContent = item + ": " + jumlah;
            keranjangElement.appendChild(li);
        }
    }
</script> -->