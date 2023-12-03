<?php
require '../koneksi.php';
session_start();
$kon = new koneksi();

$user = $_POST['Username'];
$pass = $_POST['Password'];
$hash = md5($pass);
$query = "SELECT * FROM user WHERE Username = '$user' and Password = '$hash'";
$result = $kon->execute($query);
$num = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
    $idUser = $row['Id_User'];
    $Username = $row['Username'];
    $namaUser = $row['Nama_User'];
    $email = $row['Email'];
    $level = $row['Level'];
}

if ($num != 0) {
    $_SESSION["statusLogin"] = "Berhasil Login";
    $_SESSION["username"] = $Username;
    $_SESSION["namaUser"] = $namaUser;
    $_SESSION['level'] = $level;
    $_SESSION['email'] = $email;
    $_SESSION["idUser"] = $idUser;
    $_SESSION["Level"] = $level;

    header('location: ../layout/home.php');
} else {
    $_SESSION['error'] = 'Username atau Password tidak ditemukan';
    echo '<script>window.location.href="../index.php";</script>';
}
