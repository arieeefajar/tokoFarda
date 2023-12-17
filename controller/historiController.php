<?php
class histori extends koneksi
{
    public function showTransaksiJual()
    {
        $query = "SELECT Kode_TransaksiJual, Status_Pembayaran, Tanggal, Total, Bayar, Nama_User FROM transaksi_jual JOIN user ON transaksi_jual.id_user = user.Id_User";
        return $this->showData($query);
    }

    public function showTransaksiBeli()
    {
        $query = "SELECT Kode_TransaksiBeli, Tanggal, Total, Bayar, Nama_User FROM transaksi_beli JOIN user ON transaksi_beli.id_user = user.Id_user";
        return $this->showData($query);
    }
}
