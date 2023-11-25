<?php
class dashboard extends koneksi
{
    public function totalPemasukan()
    {
        $query = "SELECT SUM(Total) as totalPemasukan FROM transaksi_jual";
        return $this->execute($query);
    }

    public function totalPengeluaran()
    {
        $query = "SELECT SUM(Total) as totalPengeluaran FROM transaksi_beli";
        return $this->execute($query);
    }

    public function hitungLaba()
    {
        $query = "
        SELECT
            (SELECT COALESCE(SUM(Total), 0) FROM transaksi_jual) AS totalPemasukan,
            (SELECT COALESCE(SUM(Total), 0) FROM transaksi_beli) AS totalPengeluaran,
            (SELECT COALESCE(SUM(Total), 0) FROM transaksi_jual) - (SELECT COALESCE(SUM(Total), 0) FROM transaksi_beli) AS laba;
    ";

        return $this->execute($query);
    }

    public function jumlahUser()
    {
        $query = "SELECT COUNT(Id_User) as totalUser FROM user";
        return $this->execute($query);
    }

    public function jumlahTransaksiJualSekarang()
    {
        $query = "SELECT COUNT(Tanggal) as tanggalTransaksiJualSekarang FROM transaksi_jual WHERE Tanggal = CURDATE()";
        return $this->execute($query);
    }

    public function jumlahTransaksiBeliSekarang()
    {
        $query = "SELECT COUNT(Tanggal) as tanggalTransaksiBeliSekarang FROM transaksi_beli WHERE Tanggal = CURDATE()";
        return $this->execute($query);
    }

    public function dataBarangExpired()
    {
        $query = "SELECT Kode_Barang, Nama_Barang FROM barang WHERE Tgl_Expired <= CURDATE()";
        return $this->execute($query);
    }

    public function jumlahBarangExpired()
    {
        $query = "SELECT COUNT(Tgl_Expired) as barangExpired FROM barang WHERE Tgl_Expired <= CURDATE()";
        return $this->execute($query);
    }

    public function dataStokBarang()
    {
        $query = "SELECT Kode_Barang, Nama_Barang, Stok FROM barang WHERE Stok < 10";
        return $this->execute($query);
    }

    public function jumlahBarangStok()
    {
        $query =  "SELECT COUNT(Stok) as stokBarang FROM barang WHERE Stok < 10";
        return $this->execute($query);
    }
}
