<?php
class dataHutang extends koneksi
{
    public function index()
    {
        $query = "SELECT * FROM hutang";
        return $this->showData($query);
    }

    public function edit($sisa, $idHutang)
    {
        try {
            $query = "UPDATE hutang SET Jumlah_Hutang='$sisa' WHERE id_Hutang = '$idHutang'";
            $result = $this->execute($query);

            if ($result == true) {
                $_SESSION['success'] = "Data berhasil disimpan!";
            } else {
                $_SESSION['error'] = "Gagal menyimpan data.";
            }
            echo '<script>window.location.href="?page=dataHutang";</script>';
            exit();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function delete($status, $kodeTransaksi, $idHutang)
    {
        try {
            $query = "UPDATE transaksi_jual SET Status_Pembayaran = '$status' WHERE Kode_TransaksiJual = '$kodeTransaksi'";
            $result = $this->execute($query);

            $query1 = "DELETE FROM hutang WHERE id_Hutang = '$idHutang'";
            $result1 = $this->execute($query1);

            if ($result == true && $result1 == true) {
                $_SESSION['success'] = "Data berhasil disimpan!";
            } else {
                $_SESSION['error'] = "Gagal menyimpan data.";
            }
            echo '<script>window.location.href="?page=dataHutang";</script>';
            exit();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
