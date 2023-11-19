<?php
class transaksiJual extends koneksi
{
    public function showBarang()
    {
        $query = "SELECT * FROM barang WHERE stok >= 10 AND Tgl_Expired > CURDATE()";
        return $this->execute($query);
    }

    public function kodeTransaksi()
    {
        // Ambil data terakhir dari tabel
        $query = "SELECT Kode_TransaksiJual FROM transaksi_jual ORDER BY Kode_TransaksiJual DESC LIMIT 1";
        $result = $this->execute($query);

        if ($result && $result->num_rows > 0) {
            // Jika sudah ada data, ambil kode terakhir
            $row = $result->fetch_assoc();
            $lastCode = $row['Kode_TransaksiJual'];

            // Ambil nomor dari kode terakhir
            $lastNumber = intval(substr($lastCode, 2));

            // Generate kode berikutnya
            $nextNumber = $lastNumber + 1;
            $nextCode = 'TR' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada data, mulai dari TB0001
            $nextCode = 'TR0001';
        }
        // Kembalikan hasilnya
        return $nextCode;
    }

    public function tambah($bayar, $total, $idUser, $kodeBarang, $jumlah, $subtotal, $totalBarang, $status)
    {
        $kodeTransaksi = $this->kodeTransaksi();

        try {
            $query = "INSERT INTO transaksi_jual (Kode_TransaksiJual, Status_Pembayaran, Tanggal, Total, Bayar, id_User) value ('$kodeTransaksi', '$status', CURDATE(), $total, $bayar, $idUser)";
            $result = $this->execute($query);

            for ($i = 0; $i < $totalBarang; $i++) {
                $query1 = "INSERT INTO detail_transaksi_jual set Kode_TransaksiJual = '$kodeTransaksi', Kode_Barang = '$kodeBarang[$i]', Jumlah_Barang = '$jumlah[$i]', Subtotal_Barang = '$subtotal[$i]' ";
                $result1 = $this->execute($query1);
            }

            if ($result == true && $result1 == true) :
                $_SESSION['success'] = "Transaksi Berhasil!";
            else :
                $_SESSION['error'] = "Transaksi Gagal.";
            endif;
            echo '<script>window.location.href="?page=transaksiJual";</script>';
            exit();

            // var_dump($result);
        } catch (\Throwable $th) {
            throw $th;
        }
        // var_dump($kodeTransaksi);
    }
}
