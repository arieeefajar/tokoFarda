<?php
class transaksiBeli extends koneksi
{
    public function showBarang()
    {
        $query = "SELECT * FROM barang WHERE stok < 10 AND Tgl_Expired <= CURDATE();";
        return $this->execute($query);
    }
}
