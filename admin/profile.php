<?php
require '../koneksi.php';
require '../controller/profile.php';

$profile = new profile();
$result = $profile->showUser();
// var_dump($profile->updatePassword($oldPassword, $newPassword, $confirmPass));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'update') {
        $username = $_POST['Username'];
        $namaUser = $_POST['Nama_User'];
        $email = $_POST['Email'];
        $idUser = $_POST['Id_User'];
        $profile->update($username, $namaUser, $email, $idUser);
    } else {
        $oldPassword = md5($_POST['oldPassword']);
        $newPassword = md5($_POST['newPassword']);
        $confirmPass = md5($_POST['confirmPass']);
        $profile->updatePassword($oldPassword, $newPassword, $confirmPass);
    }
}
?>
<h4 class="mb-4 text-gray-800">Profile</h4>
<div class="card shadow-lg">
    <div class="card-header">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Data diri</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Ubah password</button>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <!-- form data diri -->
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form action="<?= $_SERVER['PHP_SELF']; ?>?page=profile" method="POST">
                    <?php foreach ($result as $key => $value) : ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="Username" value="<?= $value["Username"] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="Email" value="<?= $value["Email"] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Nama User <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="Nama_User" value="<?= $value["Nama_User"] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="">Level</label>
                                    <input type="text" class="form-control" name="Level" value="<?= $value["Level"] ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="Id_User" value="<?= $_SESSION['idUser']; ?>">
                        <input type="hidden" name="action" value="update">
                        <div class="row mt-3">
                            <div class="col-lg-12 text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </form>
            </div>

            <!-- form ubah password -->
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form action="<?= $_SERVER['PHP_SELF']; ?>?page=profile" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Password Lama <span class="text-danger">*</span></label>
                            <input type="password" name="oldPassword" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Password Baru <span class="text-danger">*</span></label>
                            <input type="password" name="newPassword" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" name="confirmPass" class="form-control" required>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="updatePassword">
                    <div class="row mt-3">
                        <div class="col-lg-12 text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>