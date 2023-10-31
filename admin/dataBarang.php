<?php
require '../koneksi.php';
require '../controller/barangController.php';

$crud = new crudBarang();
$result = $crud->index();
$jenisBarang = $crud->jenisBarang();
$supplier = $crud->supplier();

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $action = $_POST['action'];

    if ($action === 'add') {
        $kodeBarang = htmlspecialchars($_POST['Kode_Barang']);
        $namaBarang = htmlspecialchars($_POST['Nama_Barang']);
        $tanggal = htmlspecialchars($_POST['Tgl_Expired']);
        $hargaBeli = htmlspecialchars($_POST['Harga_Beli']);
        $hargaBeli1 = str_replace(',', '', $hargaBeli);
        $hargaJual = htmlspecialchars($_POST['Harga_Jual']);
        $hargaJual1 = str_replace(',', '', $hargaJual);
        $stok = htmlspecialchars($_POST['Stok']);
        $jenisBarang = htmlspecialchars($_POST['id_JenisBarang']);
        $supplier = htmlspecialchars($_POST['id_Supplier']);
        // var_dump($kodeBarang, $namaBarang, $tanggal, $hargaBeli1, $hargaJual1, $stok, $jenisBarang, $supplier);
        $crud->tambah($kodeBarang, $namaBarang, $tanggal, $hargaBeli1, $hargaJual1, $stok, $jenisBarang, $supplier);
    } elseif ($action === 'edit') {
        $kodeBarang = $_POST['Kode_Barang'];
        $namaBarang = htmlspecialchars($_POST['Nama_Barang']);
        $tanggal = htmlspecialchars($_POST['Tgl_Expired']);
        $hargaBeli = htmlspecialchars($_POST['Harga_Beli']);
        $hargaBeli1 = str_replace(',', '', $hargaBeli);
        $hargaJual = htmlspecialchars($_POST['Harga_Jual']);
        $hargaJual1 = str_replace(',', '', $hargaJual);
        $stok = htmlspecialchars($_POST['Stok']);
        $jenisBarang = htmlspecialchars($_POST['id_JenisBarang']);
        $supplier = htmlspecialchars($_POST['id_Supplier']);
        $crud->edit($kodeBarang, $namaBarang, $tanggal, $hargaBeli1, $hargaJual1, $stok, $jenisBarang, $supplier);
    } elseif ($action === 'delete') {
        if (isset($_POST['Kode_Barang'])) {
            $kodeBarang = htmlspecialchars($_POST['Kode_Barang']);
            $crud->hapus($kodeBarang);
        }
    }
endif;
?>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Data Barang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button type="button" class="btn btn-primary btn-icon-split mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Barang</span>
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
                            <td><?= $data['Harga_Jual']; ?></td>
                            <td><?= $data['Stok']; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-circle" data-bs-toggle="modal" data-bs-target="#editModal" onclick='edit(<?= json_encode($data); ?>)'>
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-circle" onclick="confirmDelete(<?= $data['Kode_Barang']; ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button type="button" class="btn btn-info btn-circle" data-bs-toggle="modal" data-bs-target="#detailModal" onclick='detail(<?= json_encode($data); ?>)'>
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- TambahModal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataBarang" method="POST">
                    <div class="mb-3">
                        <label for="">Kode Barang</label>
                        <input type="text" name="Kode_Barang" class="form-control" placeholder="Masukan kode barang" required oninput="this.value = this.value.replace(/[^0-9]/g, ''); validateInput(this);">
                    </div>
                    <div class="mb-3">
                        <label for="">Nama Barang</label>
                        <input type="text" name="Nama_Barang" class="form-control" placeholder="Masukan nama barang" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Tanggal Expired</label>
                        <input type="date" name="Tgl_Expired" class="form-control" placeholder="Masukan tanggal expired" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Harga Beli</label>
                        <input type="text" name="Harga_Beli" class="form-control" placeholder="Masukan harga beli" required oninput="formatRibu(this)">
                    </div>
                    <div class="mb-3">
                        <label for="">Harga Jual</label>
                        <input type="text" name="Harga_Jual" class="form-control" placeholder="Masukan harga jual" required oninput="formatRibu(this)">
                    </div>
                    <div class="mb-3">
                        <label for="">Stok</label>
                        <input type="number" name="Stok" class="form-control" placeholder="Masukan stok" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Jenis Barang</label>
                        <select name="id_JenisBarang" class="form-select">
                            <option selected disabled>Pilih Jenis Barang</option>
                            <?php foreach ($jenisBarang as $key => $value) {
                            ?>
                                <option value="<?= $value['id_JenisBarang']; ?>"><?= $value['Jenis_Barang']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="">
                        <label for="">Supplier</label>
                        <select name="id_Supplier" class="form-select">
                            <option selected disabled>Pilih Supplier</option>
                            <?php foreach ($supplier as $key => $value) {
                            ?>
                                <option value="<?= $value['id_Supplier']; ?>"><?= $value['Nama_Supplier']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <input type="hidden" name="action" value="add">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- EditModal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataBarang" method="post" id="formEdit">
                    <div class="mb-3">
                        <label for="">Nama Barang</label>
                        <input type="text" name="Nama_Barang" id="barangEdit" class="form-control" placeholder="Masukan nama barang" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Tanggal Expired</label>
                        <input type="date" name="Tgl_Expired" id="tglEdit" class="form-control" placeholder="Masukan tanggal expired" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Harga Beli</label>
                        <input type="text" name="Harga_Beli" id="beliEdit" class="form-control" placeholder="Masukan harga beli" required oninput="formatRibu(this)">
                    </div>
                    <div class="mb-3">
                        <label for="">Harga Jual</label>
                        <input type="text" name="Harga_Jual" id="jualEdit" class="form-control" placeholder="Masukan harga jual" required oninput="formatRibu(this)">
                    </div>
                    <div class="mb-3">
                        <label for="">Stok</label>
                        <input type="number" name="Stok" id="stokEdit" class="form-control" placeholder="Masukan stok" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Jenis Barang</label>
                        <select name="id_JenisBarang" class="form-select" id="jenisBarangEdit">
                            <option selected disabled>Pilih Jenis Barang</option>
                            <?php foreach ($jenisBarang as $key => $value) {
                            ?>
                                <option value="<?= $value['id_JenisBarang']; ?>"><?= $value['Jenis_Barang']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="">
                        <label for="">Supplier</label>
                        <select name="id_Supplier" class="form-select" id="supplierEdit">
                            <option selected disabled>Pilih Supplier</option>
                            <?php foreach ($supplier as $key => $value) {
                            ?>
                                <option value="<?= $value['id_Supplier']; ?>"><?= $value['Nama_Supplier']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <input type="hidden" name="Kode_Barang" id="kodeEdit">
                    <input type="hidden" name="action" value="edit">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DetailModal -->
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
                        <label for="">Harga Beli</label>
                        <input type="text" name="Harga_Beli" id="hargaBeli" class="form-control" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="">Jenis Barang</label>
                        <select name="Jenis_Barang" class="form-select" id="jenisBarang" disabled>
                            <option selected disabled>Pilih Jenis Barang</option>
                            <?php foreach ($jenisBarang as $key => $value) {
                            ?>
                                <option value="<?= $value['id_JenisBarang']; ?>"><?= $value['Jenis_Barang']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Supplier</label>
                        <select name="Nama_Supplier" class="form-select" id="namaSupplier" disabled>
                            <option selected disabled>Pilih Supplier</option>
                            <?php foreach ($supplier as $key => $value) {
                            ?>
                                <option value="<?= $value['id_Supplier']; ?>"><?= $value['Nama_Supplier']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- form delete -->
<form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataBarang" id="formDelete" method="POST">
    <input type="hidden" name="Kode_Barang" id="idDelete">
    <input type="hidden" name="action" value="delete">
</form>

<script>
    function formatAngka(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function edit(data) {
        // console.log(data);
        var hargaBeli = data.Harga_Beli;
        var hargaJual = data.Harga_Jual;

        document.getElementById('barangEdit').value = data.Nama_Barang
        document.getElementById('tglEdit').value = data.Tgl_Expired
        document.getElementById('stokEdit').value = data.Stok
        document.getElementById('beliEdit').value = formatAngka(hargaBeli);
        document.getElementById('jualEdit').value = formatAngka(hargaJual);
        document.getElementById('jenisBarangEdit').value = data.id_JenisBarang
        document.getElementById('supplierEdit').value = data.id_Supplier
        document.getElementById('kodeEdit').value = data.Kode_Barang
    };

    function detail(data) {
        // console.log(data);
        var hargaBeli = data.Harga_Beli

        document.getElementById('hargaBeli').value = formatAngka(hargaBeli)
        document.getElementById('jenisBarang').value = data.id_jenisBarang
        document.getElementById('namaSupplier').value = data.id_Supplier
        document.getElementById('jenisBarang').value = data.id_JenisBarang
    };

    function confirmDelete(Kode_Barang) {
        console.log(Kode_Barang);
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Anda yakin ingin menghapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('idDelete').value = Kode_Barang;
                document.getElementById('formDelete').submit();
            }
        });
    }

    function formatRibu(input) {

        var value = input.value.replace(/[^0-9]/g, '');

        if (value) {
            value = parseInt(value, 10).toLocaleString('en-US');
        }

        input.value = value;
    }
</script>