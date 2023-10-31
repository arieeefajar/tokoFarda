<?php
class crudBarang extends koneksi
{
    public function index()
    {
        $query = "SELECT * FROM barang";
        return $this->showData($query);
    }

    public function jenisBarang()
    {
        $query = "SELECT * FROM jenis_barang";
        return $this->showData($query);
    }

    public function supplier()
    {
        $query = "SELECT * FROM supplier";
        return $this->showData($query);
    }

    public function tambah($kodeBarang, $namaBarang, $tanggal, $hargaBeli1, $hargaJual1, $stok, $jenisBarang, $supplier)
    {
        try {
            $query = "INSERT INTO barang (Kode_Barang, Nama_Barang, Tgl_Expired, Harga_Beli, Harga_Jual, Stok, id_JenisBarang, id_Supplier) value ('$kodeBarang', '$namaBarang', '$tanggal', '$hargaBeli1', '$hargaJual1', '$stok', '$jenisBarang', '$supplier')";
            $result = $this->execute($query);

            if ($result == true) :
                $_SESSION['success'] = "Data berhasil ditambahkan!";
            else :
                $_SESSION['error'] = "Gagal menambahkan data.";
            endif;
            echo '<script>window.location.href="?page=dataBarang";</script>';
            exit();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function edit($kodeBarang, $namaBarang, $tanggal, $hargaBeli1, $hargaJual1, $stok, $jenisBarang, $supplier)
    {
        try {
            $query = "UPDATE barang SET Nama_Barang='$namaBarang', Tgl_Expired='$tanggal', Harga_Beli='$hargaBeli1', Harga_Jual='$hargaJual1', Stok='$stok', id_JenisBarang='$jenisBarang', id_Supplier='$supplier' WHERE Kode_Barang='$kodeBarang'";
            $result = $this->execute($query);

            if ($result == true) {
                $_SESSION['success'] = "Data berhasil diubah!";
            } else {
                $_SESSION['error'] = "Gagal mengubah data.";
            }
            echo '<script>window.location.href="?page=dataBarang";</script>';
            exit();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function hapus($kodeBarang)
    {
        $query = "DELETE FROM barang WHERE Kode_Barang='$kodeBarang'";
        $result = $this->execute($query);

        if ($result == true) {
            $_SESSION['success'] = "Data berhasil dihapus!";
        } else {
            $_SESSION['error'] = "Gagal menghapus data.";
        }
        echo '<script>window.location.href="?page=dataBarang";</script>';
        exit();
    }
}
