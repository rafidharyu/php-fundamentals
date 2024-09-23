<?php

session_start();
if (!isset($_SESSION['login'])){
  echo "<script>
  alert('Anda harus login terlebih dahulu!')
  document.location.href = 'login.php';
  </script>";
  exit;
}

$title = 'Edit Category';
require 'layout/header.php';

$id_category = (int) $_GET['id'];

$getDataById = query("SELECT * FROM categories WHERE id_category = $id_category")[0];

if (!$getDataById) {
    echo "<script>alert('Data tidak ditemukan!')
    document.location.href = 'categories.php'
    </script>";
}

if (isset($_POST['submit'])) {
    $_POST['id_category'] = $id_category;

    if (ubah_category($_POST) > 0) {
        echo "<script>
        alert('Data berhasil diubah!')
        document.location.href = 'categories.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal diubah!')
        document.location.href = 'categories.php';
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
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $getDataById["id_category"]; ?>">
                            <div class="mb-3">
                                <label for="title">title :</label>
                                <input type="text" class="form-control" name="title" id="title" required value="<?= $getDataById["title"]; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="slug">slug :</label>
                                <input type="text" class="form-control" name="slug" id="slug" readonly value="<?= $getDataById["slug"]; ?>">
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


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="assets/js/helper.js"></script>

<script>
    $(document).ready(function() {
        $('#title').on('input', function() {
            $('#slug').val(slugify($(this).val()));
        })
    });
</script>

<?php require 'layout/footer.php'; ?>