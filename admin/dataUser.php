<?php
require '../koneksi.php';
require '../controller/userController.php';

$crud = new crud();
$result = $crud->index();

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $action = $_POST['action'];

    if ($action === 'add') {
        $username = $_POST['Username'];
        $namaUser = $_POST['Nama_User'];
        $email = $_POST['Email'];
        $pass = $_POST['Password'];
        $hash = md5($pass);
        $level = $_POST['Level'];
        $crud->tambah($username, $namaUser, $email, $hash, $level);
    } elseif ($action === 'edit') {
        $id = $_POST['Id_User'];
        $username = htmlspecialchars($_POST['Username']);
        $namaUser = htmlspecialchars($_POST['Nama_User']);
        $email = htmlspecialchars($_POST['Email']);
        $level = htmlspecialchars($_POST['Level']);
        $crud->edit($username, $namaUser, $email, $level, $id);
    } elseif ($action === 'delete') {
        if (isset($_POST['id'])) {
            $id = htmlspecialchars($_POST['id']);
            $crud->hapus($id);
        }
    }
endif;
?>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Data User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button type="button" class="btn btn-primary btn-icon-split mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah User</span>
                </button>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($result as $key => $data) : ?>
                        <tr>
                            <td><?= $key + 1; ?></td>
                            <td><?= $data['Username']; ?></td>
                            <td><?= $data['Nama_User']; ?></td>
                            <td><?= $data['Email']; ?></td>
                            <td><?= $data['Level']; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-icon-split" data-bs-toggle="modal" data-bs-target="#editModal" onclick='edit(<?= json_encode($data); ?>)'>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-pen"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </button>
                                <button type="button" class="btn btn-danger btn-icon-split" onclick="confirmDelete(<?= $data['Id_User']; ?>)">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                    <span class="text">Hapus</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- TambahModal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataUser" method="POST">
                    <div class="mb-3">
                        <label for="">Username</label>
                        <input type="text" name="Username" class="form-control" placeholder="Masukan Username" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Nama</label>
                        <input type="text" name="Nama_User" class="form-control" placeholder="Masukan Nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="Email" class="form-control" placeholder="Masukan Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" name="Password" class="form-control" placeholder="Masukan Password" required>
                    </div>
                    <div class="">
                        <label for="">Level</label>
                        <select name="Level" class="form-select">
                            <option selected disabled>Pilih Level</option>
                            <option value="Admin">Admin</option>
                            <option value="Kasir">Kasir</option>
                            <option value="Owner">Owner</option>
                        </select>
                    </div>

                    <input type="hidden" name="action" value="add">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- EditModal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataUser" method="post" id="formEdit">
                    <div class="mb-3">
                        <label for="">Username</label>
                        <input type="text" name="Username" id="usernameEdit" class="form-control" placeholder="Masukan Username" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Nama</label>
                        <input type="text" name="Nama_User" id="nameEdit" class="form-control" placeholder="Masukan Nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="Email" id="emailEdit" class="form-control" placeholder="Masukan Email" required>
                    </div>
                    <div class="">
                        <label for="">Level</label>
                        <select name="Level" class="form-select" id="levelEdit">
                            <option selected disabled>Pilih Level</option>
                            <option value="Admin">Admin</option>
                            <option value="Kasir">Kasir</option>
                            <option value="Owner">Owner</option>
                        </select>
                    </div>

                    <input type="hidden" name="Id_User" id="idEdit">
                    <input type="hidden" name="action" value="edit">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataUser" id="formDelete" method="POST">
    <input type="hidden" name="id" id="idDelete">
    <input type="hidden" name="action" value="delete">
</form>

<script>
    function edit(data) {
        // console.log(data);
        document.getElementById('usernameEdit').value = data.Username
        document.getElementById('nameEdit').value = data.Nama_User
        document.getElementById('emailEdit').value = data.Email
        document.getElementById('levelEdit').value = data.Level
        document.getElementById('idEdit').value = data.Id_User
    };

    function confirmDelete(userId) {
        console.log(userId);
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Anda yakin ingin menghapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('idDelete').value = userId;
                document.getElementById('formDelete').submit();
            }
        });
    }
</script>