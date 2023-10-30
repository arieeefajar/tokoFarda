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
}
