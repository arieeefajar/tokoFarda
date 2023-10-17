<?php
require('../koneksi.php');
session_start();
$kon = new koneksi();

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    // Lakukan query penghapusan sesuai dengan id yang diterima
    $query = "DELETE FROM user WHERE Id_User='$id'";
    $result = $kon->execute($query);

    if ($result == true) {
        $_SESSION['success'] = "Data berhasil dihapus!";
    } else {
        $_SESSION['error'] = "Gagal menghapus data.";
    }
    header('Location: ../layout/main.php?page=dataUser');
    // header('location:..main.php?page=dataUser');
}
