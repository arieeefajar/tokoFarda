<?php
require('../koneksi.php');
session_start();
$kon = new koneksi();

if (isset($_POST['ubah'])) {
    $id = $_POST['Id_User'];
    $Username = htmlspecialchars($_POST['Username']);
    $Nama_User = htmlspecialchars($_POST['Nama_User']);
    $Email = htmlspecialchars($_POST['Email']);
    $Level = htmlspecialchars($_POST['Level']);

    $query = "UPDATE user SET Username='$Username', Nama_User='$Nama_User', Email='$Email', Level='$Level' WHERE Id_User='$id'";
    $result = $kon->execute($query);

    if ($result == true) {
        $_SESSION['success'] = "Data berhasil diubah!";
    } else {
        $_SESSION['error'] = "Gagal mengubah data.";
    }

    header('location:../layout/main.php?page=dataUser');

    // var_dump($result);
}
