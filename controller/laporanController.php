<?php
class laporan extends koneksi
{
    public function laporanPendapatan($tanggalMulai, $tanggalSampai)
    {
        // $tanggalAwal = '2023-11-19';
        // $tanggalAkhir = '2023-11-19';

        $query = "SELECT Kode_TransaksiJual, Tanggal, Total FROM transaksi_jual WHERE Tanggal BETWEEN '$tanggalMulai' AND '$tanggalSampai'";
        return $this->execute($query);
    }

    public function totalPendapatan($tanggalMulai, $tanggalSampai)
    {
        // $tanggalAwal = '2023-11-19';
        // $tanggalAkhir = '2023-11-19';

        $query = "SELECT SUM(Total) as totalPendapatan FROM transaksi_jual WHERE Tanggal BETWEEN '$tanggalMulai' AND '$tanggalSampai'";
        return $this->execute($query);
    }

    public function laporanPengeluaran($tanggalMulai, $tanggalSampai)
    {
        $query = "SELECT Kode_TransaksiBeli, Tanggal, Total FROM transaksi_beli WHERE Tanggal BETWEEN '$tanggalMulai' AND '$tanggalSampai'";
        return $this->execute($query);
    }

    public function totalPengeluaran($tanggalMulai, $tanggalSampai)
    {
        $query = "SELECT SUM(Total) as totalPengeluaran FROM transaksi_beli WHERE Tanggal BETWEEN '$tanggalMulai' AND '$tanggalSampai'";
        return $this->execute($query);
    }
}
