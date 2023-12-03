<?php
session_start();
class lupaPassword extends koneksi
{
    public function findEmail($email)
    {
        try {
            $query = "SELECT Id_User, Email FROM user WHERE Email='" . $email . "'";
            $result = $this->execute($query);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $id = $row['Id_User'];
                $oldEmail = $row['Email'];

                if ($oldEmail == $email) {
                    // $_SESSION['success'] = "Email ditemukan";
                    // var_dump($id);
                    $_SESSION['id'] = $id;
                    echo '<script>window.location.href="lupaPassword.php";</script>';
                }
            } else {
                $_SESSION['error'] = "Email tidak terdaftar";
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updatePassword($newPassword, $confirmPass, $idUser)
    {
        if ($newPassword == $confirmPass) {
            try {
                $query = "UPDATE user SET Password='" . $confirmPass . "' WHERE Id_User='" . $idUser . "'";
                $result = $this->execute($query);

                if ($result) {
                    $_SESSION['success'] = "Password berhasil diubah";
                    echo '<script>window.location.href="../index.php";</script>';
                } else {
                    $_SESSION['error'] = "Password gagal diubah";
                }
                exit();
            } catch (\Throwable $th) {
                throw $th;
            }
        } else {
            $_SESSION['error'] = "Konfirmasi password tidak sama!";
        }
    }
}
