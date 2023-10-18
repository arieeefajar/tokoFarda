<?php
// session_start();
// require '../koneksi.php';
class crud extends koneksi
{
    public function index()
    {
        $query = "SELECT * FROM user";
        return $this->showData($query);
    }

    public function tambah($username, $namaUser, $email, $hash, $level)
    {
        try {
            $query = "INSERT INTO user (Username,Nama_User,Email,Password,Level) value ('$username','$namaUser','$email','$hash','$level')";
            $result = $this->execute($query);

            if ($result == true) :
                $_SESSION['success'] = "Data berhasil ditambahkan!";
            else :
                $_SESSION['error'] = "Gagal menambahkan data.";
            endif;
            echo '<script>window.location.href="?page=dataUser";</script>';
            exit();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function edit($username, $namaUser, $email, $level, $id)
    {
        try {
            $query = "UPDATE user SET Username='$username', Nama_User='$namaUser', Email='$email', Level='$level' WHERE Id_User='$id'";
            $result = $this->execute($query);

            if ($result == true) {
                $_SESSION['success'] = "Data berhasil diubah!";
            } else {
                $_SESSION['error'] = "Gagal mengubah data.";
            }
            echo '<script>window.location.href="?page=dataUser";</script>';
            exit();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function hapus($id)
    {
        $query = "DELETE FROM user WHERE Id_User='$id'";
        $result = $this->execute($query);

        if ($result == true) {
            $_SESSION['success'] = "Data berhasil dihapus!";
        } else {
            $_SESSION['error'] = "Gagal menghapus data.";
        }
        echo '<script>window.location.href="?page=dataUser";</script>';
        exit();
    }
}
