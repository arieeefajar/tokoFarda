<?php
require('../koneksi.php');
session_start();
$kon = new koneksi();

if (isset($_POST['simpan'])) {
    $username = $_POST['Username'];
    $namaUser = $_POST['Nama_User'];
    $email = $_POST['Email'];
    $pass = $_POST['Password'];
    $hash = md5($pass);
    $level = $_POST['Level'];

    $query = "INSERT INTO user (Username,Nama_User,Email,Password,Level) value ('$username','$namaUser','$email','$hash','$level')";
    $result = $kon->execute($query);

    if ($result == true) {
        $_SESSION['success'] = "Data berhasil ditambahkan!";
    } else {
        $_SESSION['error'] = "Gagal menambahkan data.";
    }
    header('Location: ../layout/main.php?page=dataUser');
}
