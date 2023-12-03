<?php
require '../koneksi.php';
require '../controller/lupaPasswordController.php';

$lupaPassword = new lupaPassword();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPassword = md5($_POST['newPassword']);
    $confirmPass = md5($_POST['confirmPassword']);
    $idUser = $_SESSION['id'];
    // var_dump($newPassword, $confirmPass);
    $lupaPassword->updatePassword($newPassword, $confirmPass, $idUser);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lupa Password | Toko Farda</title>

    <!-- Custom fonts for this template-->
    <link href="<?= 'http://localhost/SI/tokoFarda/' ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= 'http://localhost/SI/tokoFarda/' ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- sweetalert -->
    <link rel="stylesheet" href="<?= 'http://localhost/SI/tokoFarda/'; ?>sweetalert2/sweetalert2.min.css">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-12 col-md-9 mt-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-5">Form Ubah Password</h1>
                                    </div>
                                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" class="user">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <input type="password" name="newPassword" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukan password baru..." required>
                                            </div>

                                            <div class="mb-3">
                                                <input type="password" name="confirmPassword" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Konfirmasi password baru..." required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= 'http://localhost/SI/tokoFarda/' ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= 'http://localhost/SI/tokoFarda/' ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= 'http://localhost/SI/tokoFarda/' ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= 'http://localhost/SI/tokoFarda/' ?>js/sb-admin-2.min.js"></script>

    <!-- sweetalert2 -->
    <script src="<?= 'http://localhost/SI/tokoFarda/'; ?>sweetalert2/sweetalert2.min.js"></script>

    <script>
        <?php if (isset($_SESSION['error'])) : ?>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: '<?= $_SESSION['error']; ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php unset($_SESSION['error']);
        endif; ?>
    </script>

</body>

</html>