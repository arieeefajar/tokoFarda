<?php
class transaksiBeli extends koneksi
{
    public function showBarang()
    {
        $query = "SELECT * FROM barang WHERE stok < 10 OR Tgl_Expired <= CURDATE();";
        return $this->execute($query);
    }

    public function kodeTransaksi()
    {
        // Ambil data terakhir dari tabel
        $query = "SELECT Kode_TransaksiBeli FROM transaksi_beli ORDER BY Kode_TransaksiBeli DESC LIMIT 1";
        $result = $this->execute($query);

        if ($result && $result->num_rows > 0) {
            // Jika sudah ada data, ambil kode terakhir
            $row = $result->fetch_assoc();
            $lastCode = $row['Kode_TransaksiBeli'];

            // Ambil nomor dari kode terakhir
            $lastNumber = intval(substr($lastCode, 2));

            // Generate kode berikutnya
            $nextNumber = $lastNumber + 1;
            $nextCode = 'TB' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada data, mulai dari TB0001
            $nextCode = 'TB0001';
        }
        // Kembalikan hasilnya
        return $nextCode;
    }

    public function tambah($bayar, $total, $idUser, $kodeBarang, $jumlah, $subtotal, $totalBarang)
    {
        $kodeTransaksi = $this->kodeTransaksi();

        try {
            $query = "INSERT INTO transaksi_beli (Kode_TransaksiBeli, Tanggal, Total, Bayar, id_User) value ('$kodeTransaksi', CURDATE(), $total, $bayar, $idUser)";
            $result = $this->execute($query);

            for ($i = 0; $i < $totalBarang; $i++) {
                $query1 = "INSERT INTO detail_transaksi_beli set Kode_TransaksiBeli = '$kodeTransaksi', Kode_Barang = '$kodeBarang[$i]', Jumlah = '$jumlah[$i]', Subtotal_Barang = '$subtotal[$i]'";
                $result1 = $this->execute($query1);
            }

            if ($result == true && $result1 == true) :
                $_SESSION['success'] = "Transaksi Berhasil!";
            else :
                $_SESSION['error'] = "Transaksi Gagal.";
            endif;
            echo '<script>window.location.href="?page=transaksiBeli";</script>';
            exit();

            // var_dump($result);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
