<?php
class profile extends koneksi
{
    public function showUser()
    {
        $currentUser = $_SESSION['idUser'];
        $query = "SELECT * FROM user WHERE Id_User='" . $currentUser . "'";
        return $this->showData($query);
    }

    public function update($username, $namaUser, $email, $idUser)
    {
        try {
            $query = "UPDATE user SET Username='" . $username . "', Nama_User='" . $namaUser . "', Email='" . $email . "' WHERE Id_User='" . $idUser . "'";
            $result = $this->execute($query);

            if ($result == true) :
                $_SESSION['success'] = "Data berhasil diubah!";
                $_SESSION['namaUser'] = $namaUser;
            else :
                $_SESSION['error'] = "Gagal mengubah data.";
            endif;
            echo '<script>window.location.href="?page=profile";</script>';
            exit();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updatePassword($oldPassword, $newPassword, $confirmPass)
    {
        try {
            $idUser = $_SESSION['idUser'];
            $query = "SELECT Password FROM user WHERE Id_User='" . $idUser . "'";
            $result = $this->execute($query);
            // return $this->execute($query);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $password = $row['Password'];

                if ($oldPassword == $password) {
                    if ($newPassword == $confirmPass) {
                        $query1 = "UPDATE user SET Password='" . $confirmPass . "' WHERE Id_User='" . $idUser . "'";
                        $result1 = $this->execute($query1);

                        if ($result1) {
                            $_SESSION['success'] = "Password berhasil diubah!";
                            echo '<script>window.location.href="?page=profile";</script>';
                            exit();
                        } else {
                            $_SESSION['error'] = "Gagal mengubah password";
                            echo '<script>window.location.href="?page=profile";</script>';
                            exit();
                        }
                    } else {
                        $_SESSION['error'] = "Konfirmasi password tidak sama";
                        echo '<script>window.location.href="?page=profile";</script>';
                        exit();
                    }
                } else {
                    $_SESSION['error'] = "Password lama tidak cocok";
                    echo '<script>window.location.href="?page=profile";</script>';
                    exit();
                }
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
