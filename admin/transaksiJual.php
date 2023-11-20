<?php
require '../koneksi.php';
require '../controller/transaksiJual.php';

$transaksiJual = new transaksiJual();
$result = $transaksiJual->showBarang();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bayar = $_POST['bayar1'];
    $total = $_POST['total'];
    $idUser = $_SESSION['idUser'];
    $kodeBarang = $_POST['kodeBarang'];
    $jumlah = $_POST['jumlah'];
    $subtotal = $_POST['subtotal'];
    $totalBarang = $_POST['jumlahBarang'];
    $status = $_POST['status'];
    $namaPelanggan = $_POST['Nama_Pelanggan'];
    $noTelp = $_POST['No_Telp'];
    $alamat = $_POST['Alamat'];
    $jumlahHutang = $_POST['Jumlah_Hutang'];


    // var_dump($namaPelanggan, $noTelp, $alamat, $jumlahHutang);
    // var_dump($bayar, $total, $idUser, $kodeBarang, $jumlah, $subtotal, $totalBarang, $status);
    $transaksiJual->tambah($bayar, $total, $idUser, $kodeBarang, $jumlah, $subtotal, $totalBarang, $status, $namaPelanggan, $noTelp, $alamat, $jumlahHutang);
}

?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Data Barang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button type="button" id="buttonKeranjang" class="btn btn-warning btn-icon-split mb-3" data-bs-toggle="modal" data-bs-target="#kranjangModal" onclick="funcBayar()">
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
                <h1 class="modal-title fs-5" id="judul">Detail Belanja</h1>
                <button type="button" class="btn-close" id="close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card" id="dataBarang">
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
                <div class="row mt-3">
                    <form id="myForm" method="POST">
                        <div id="dataTransaksi">
                            <div id="formBelanja" style="display: none;">

                            </div>
                            <div class="col-md-12">
                                <label for="">Bayar</label>
                                <input type="text" class="form-control" id="bayar" oninput="if (this.value !== '') funcBayar(); validateInput(this)">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">Kembalian</label>
                                <input type="text" id="kembalian" class="form-control" readonly>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <label for="">Status</label>
                                <input type="text" id="status" name="status" class="form-control" readonly>
                            </div>

                            <input type="hidden" id="idUser" name="idUser" value="<?= $_SESSION['idUser']; ?>">
                            <input type="hidden" id="bayar1" name="bayar1">
                            <input type="hidden" id="jumlahBarang" name="jumlahBarang">
                            <input type="hidden" id="total2" name="total">
                        </div>

                        <div class="" id="dataHutang" style="display: none;">
                            <div class="mb-3">
                                <label for="">Nama Pelanggan</label>
                                <input type="text" name="Nama_Pelanggan" id="namaPelanggan" class="form-control" required>
                            </div>
                            <div class=" mb-3">
                                <label for="">No Telp</label>
                                <input type="text" name="No_Telp" id="noTelp" class="form-control" pattern="(\+62|62|0)8[1-9][0-9]{8,9}$" oninput="this.value = this.value.replace(/[^0-9]/g, ''); validateTelp(this);" oninvalid="validateTelp(this);" required>
                            </div>
                            <div class=" mb-3">
                                <label for="">Alamat</label>
                                <textarea name="Alamat" id="alamat" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="" id="">
                                <label for="">Jumlah Hutang</label>
                                <input type="text" id="jumlahHutang" class="form-control" required readonly>
                                <input type="hidden" name="Jumlah_Hutang" id="jumlahHutang1">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitForm()" id="simpan">Simpan</button>
                <button type="button" id="buttonHutang" class="btn btn-warning" onclick="simpanHutang()" style="display: none;">Simpan
                </button>
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
                <form action="">
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
                        <button type="button" id="tambah" disabled="true" class="btn btn-primary" onclick="tambahBarang()">Tambah Keranjang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- hutang modal -->
<div class="modal fade" id="hutangModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hutang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="formHutang">
                    <div class="modal-footer">
                        <button type="submit" id="buttonHutang" class=" btn btn-primary" onclick="simpanHutang()">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var keranjangBelanja = {}
    const buttonKeranjang = document.getElementById('buttonKeranjang');
    const keranjangKeys = Object.keys(keranjangBelanja);

    if (keranjangKeys.length === 0) {
        buttonKeranjang.disabled = true;
    }

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
            // console.log(jumlah, subtotal1);
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
    }

    function perbaruiTampilanKeranjang() {
        // console.log('oke');
        const keranjangElement = document.getElementById('detailBelanja');
        const formBelanja = document.getElementById('formBelanja');
        const count = document.getElementById('count');
        const jumlahBarang = document.getElementById('jumlahBarang');
        const totalBarang = Object.values(keranjangBelanja).length;

        keranjangElement.innerHTML = "";
        formBelanja.innerHTML = "";
        count.textContent = totalBarang;
        jumlahBarang.value = totalBarang

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
            col2.innerHTML = `${jumlah}<sup>x</sup>`;

            var col3 = document.createElement('div');
            col3.classList.add('col-sm-4', 'text-right');
            col3.innerHTML = format;

            var col4 = document.createElement('div');
            col4.style.display = 'none';
            col4.innerHTML = `${kodeBarang}`;

            var inputKodeBarang = document.createElement('input');
            inputKodeBarang.type = 'hidden';
            inputKodeBarang.name = 'kodeBarang[]';
            inputKodeBarang.value = `${kodeBarang}`;

            var inputJumlah = document.createElement('input');
            inputJumlah.type = 'hidden';
            inputJumlah.name = 'jumlah[]';
            inputJumlah.value = `${jumlah}`;

            var inputSubtotal = document.createElement('input');
            inputSubtotal.type = 'hidden';
            inputSubtotal.name = 'subtotal[]';
            inputSubtotal.value = `${subtotal}`;

            row.appendChild(col1);
            row.appendChild(col2);
            row.appendChild(col3);
            row.appendChild(col4);
            keranjangElement.appendChild(row);
            formBelanja.appendChild(inputKodeBarang);
            formBelanja.appendChild(inputJumlah);
            formBelanja.appendChild(inputSubtotal);

            const totalBelanja = document.getElementById('total')
            const totalBelanja1 = document.getElementById('total1')
            const totalBelanja2 = document.getElementById('total2')
            const total = Object.values(keranjangBelanja).reduce(function(accumulator, barang) {
                return accumulator + barang.subtotal;
            }, 0);
            var format1 = total.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });


            totalBelanja.textContent = format1
            totalBelanja1.value = total
            totalBelanja2.value = total
        }
        // console.log(format1);
    }

    function funcBayar() {
        const totalBelanja = parseInt(document.getElementById('total1').value)
        const bayar = document.getElementById('bayar').value
        const bayar1 = document.getElementById('bayar1')
        const uang = parseInt(bayar.replace(/,/g, ''), 10);
        const kembalian = document.getElementById('kembalian')
        const status = document.getElementById('status')
        const jumlahHutang = document.getElementById('jumlahHutang')
        const jumlahHutang1 = document.getElementById('jumlahHutang1')

        const sisa = uang - totalBelanja;
        const sisa1 = totalBelanja - uang;

        var format = sisa.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });

        var format1 = sisa1.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });

        if (uang < totalBelanja) {
            kembalian.value = "Rp." + 0;
            status.value = 'hutang';
            jumlahHutang.value = format1;
            jumlahHutang1.value = sisa1;
            bayar1.value = bayar;
        } else {
            // if (isNaN(sisa) || isNaN(format)) {
            //     kembalian.value = "Rp. 0";
            // } else {
            //     console.log(format);
            //     kembalian.value = format;
            // }
            kembalian.value = format;
            status.value = 'lunas';
        }
        // console.log(bayar1.value = bayar);
    }

    function submitForm() {
        const form = document.getElementById("myForm");
        const status = document.getElementById('status').value
        const dataHutang = document.getElementById('dataHutang');
        const dataTransaksi = document.getElementById('dataTransaksi');
        const dataBarang = document.getElementById('dataBarang');
        const judul = document.getElementById('judul');
        const buttonSimpan = document.getElementById('simpan');
        const buttonHutang = document.getElementById('buttonHutang');

        if (status == 'hutang') {
            judul.innerHTML = '';
            dataHutang.style.display = 'block';
            dataTransaksi.style.display = 'none';
            dataBarang.style.display = 'none';
            judul.innerHTML = 'Form Hutang';
            buttonSimpan.style.display = 'none';
            buttonHutang.style.display = 'block';
        } else {
            form.action = "<?= $_SERVER['PHP_SELF']; ?>?page=transaksiJual";
            form.method = "POST"
            form.submit();
        }
    }

    function simpanHutang() {
        // console.log('Oke');
        const formTransaksi = document.getElementById('myForm');

        formTransaksi.action = "<?= $_SERVER['PHP_SELF']; ?>?page=transaksiJual";
        formTransaksi.method = "POST";
        formTransaksi.submit();

    }

    function validateInput(input) {
        // input.value = input.value.replace(/\D/g, "");
        var value = input.value.replace(/[^0-9]/g, '');

        if (value) {
            value = parseInt(value, 10).toLocaleString('en-US');
        }

        input.value = value;
    }

    function validateTelp(input) {
        console.log("oke");
    }

    function rupiah($angka) {
        $hasil_rupiah = "Rp. ".number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
</script>