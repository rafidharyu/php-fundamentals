<?php

session_start();
if (!isset($_SESSION['login'])){
  echo "<script>
  alert('Anda harus login terlebih dahulu!')
  document.location.href = 'login.php';
  </script>";
  exit;
}

$title = 'Create Users';
require 'layout/header.php';

if (isset($_POST['submit'])) {
    if (store_user($_POST) > 0) {
        echo "<script>
        alert('Data berhasil ditambahkan!')
        document.location.href = 'users.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal ditambahkan!')
        document.location.href = 'users-create.php';
        </script>";
    }
}
?>

<!-- main -->
<main class="p-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-plus-circle"></i>
                        <?= $title ?>
                    </div>
                    <div class="card-body shadow-sm">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username">username :</label>
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>

                            <div class="mb-3">
                                <label for="email">email :</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password">password :</label>
                                <input type="text" class="form-control" name="password" id="password" required>
                            </div>

                            <div class="float-end">
                                <button type="submit" class="btn btn-success" name="submit"><i class="bi bi-upload"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- main -->

<?php require 'layout/footer.php'; ?>