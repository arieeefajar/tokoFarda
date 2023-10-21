<?php
session_start();

if (!isset($_SESSION["idUser"])) {
    echo '<script>alert("Harap login terlebih dahulu");
    window.location.href=("../index.php")</script>';
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

    <title>
        <?php if (empty($_GET['page'])) : ?>
            Dashboard
        <?php elseif ($_GET['page'] == 'dataUser') : ?>
            Data User
        <?php elseif ($_GET['page'] == 'dataBarang') : ?>
            Data Barang
        <?php endif; ?>
    </title>

    <!-- Custom fonts for this template-->
    <link href="<?= 'http://localhost/SI/tokoFarda/'; ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Custom styles for this template-->
    <link href="<?= 'http://localhost/SI/tokoFarda/'; ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= 'http://localhost/SI/tokoFarda/'; ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- sweetalert -->
    <link rel="stylesheet" href="<?= 'http://localhost/SI/tokoFarda/'; ?>sweetalert2/sweetalert2.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'navbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?php
                    if (empty($_GET['page'])) {
                        if ($_SESSION['Level'] == 'Admin') {
                            include '../admin/dashboard.php';
                        } elseif ($_SESSION['Level'] == 'Kasir') {
                            include '../admin/kDashboard.php';
                        } else {
                            include '../admin/oDashboard.php';
                        }
                    } elseif ($_GET['page'] == 'dataUser') {
                        include '../admin/dataUser.php';
                    } elseif ($_GET['page'] == 'dataBarang') {
                        include '../admin/dataBarang.php';
                    }
                    ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'footer.php' ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="<?= 'http://localhost/SI/tokoFarda/'; ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= 'http://localhost/SI/tokoFarda/'; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= 'http://localhost/SI/tokoFarda/'; ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= 'http://localhost/SI/tokoFarda/'; ?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= 'http://localhost/SI/tokoFarda/'; ?>vendor/chart.js/Chart.min.js"></script>
    <script src="<?= 'http://localhost/SI/tokoFarda/'; ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= 'http://localhost/SI/tokoFarda/'; ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> -->

    <!-- data tables -->
    <script src="<?= 'http://localhost/SI/tokoFarda/'; ?>js/demo/datatables-demo.js"></script>

    <!-- sweetalert2 -->
    <script src="<?= 'http://localhost/SI/tokoFarda/'; ?>sweetalert2/sweetalert2.min.js"></script>

    <script>
        <?php if (isset($_SESSION['statusLogin'])) : ?>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '<?= $_SESSION['statusLogin']; ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php unset($_SESSION['statusLogin']);
        endif; ?>
        <?php if (isset($_SESSION['success'])) : ?>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '<?= $_SESSION['success']; ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php unset($_SESSION['success']);
        endif; ?>

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