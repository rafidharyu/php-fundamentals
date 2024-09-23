<?php

session_start();
if (!isset($_SESSION['login'])) {
    echo "<script>
  alert('Anda harus login terlebih dahulu!')
  document.location.href = 'login.php';
  </script>";
    exit;
}

$title = "Users";
require 'layout/header-datatable.php';

$stmt = $pdo->prepare("SELECT * FROM users WHERE is_user = :id_user");
$stmt->bindParam(':id_user', $_SESSION['id_user']);
$stmt->execute();
$users = $stmt->fetchAll();

// if ($_SESSION['role'] == 'operator') {
//     $users = query("SELECT * FROM users WHERE is_user {$_SESSION['id_user']}");
// }else{
//     $users = query("SELECT * FROM users ORDER BY created_at DESC");
// }

// $users = query("SELECT * FROM users ORDER BY created_at DESC");

?>

<!-- main -->
<main class="p-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-list-task"></i>
                        <?= $title ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <a href="users-create.php" class="btn btn-success mb-1 ms-2"><i class="bi bi-plus-circle"></i> Create</a>

                            <table id="datatable" class="table table-bordered table-striped table-responsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($users as $user) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $user['username'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td><?= $user['role'] ?></td>
                                            <td><?= $user['created_at'] ?></td>
                                            <td class="text-center">
                                                <a href="users-ubah.php?id=<?= $user['id_user'] ?>" class="btn btn-sm btn-primary mb-1" title="Edit"><i class="bi bi-pencil-square"></i></a>

                                                <a href="users-delete.php?id=<?= $user['id_user'] ?>" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-sm btn-danger mb-1" title="Delete"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- main -->

<?php

require 'layout/footer-datatable.php';

?>