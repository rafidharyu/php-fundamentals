<?php

session_start();
if (!isset($_SESSION['login'])){
  echo "<script>
  alert('Anda harus login terlebih dahulu!')
  document.location.href = 'login.php';
  </script>";
  exit;
}

$title = 'Create Film';
require 'layout/header.php';

$categories = query("SELECT * FROM categories ORDER BY created_at DESC");

if (isset($_POST['submit'])) {
    if (store_film($_POST) > 0) {
        echo "<script>
        alert('Film berhasil ditambahkan!')
        document.location.href = 'films.php';
        </script>";
    } else {
        echo "<script>
        alert('Film gagal ditambahkan!')
        document.location.href = 'films-create.php';
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
                                <label for="url">url <small>(copy from youtube)</small> :</label>
                                <input type="text" class="form-control" name="url" id="url" required>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="title">title :</label>
                                    <input type="text" class="form-control" name="title" id="title" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="slug">slug :</label>
                                    <input type="text" class="form-control" name="slug" id="slug" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description">description :</label>
                                <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="release_date">release date :</label>
                                    <input type="date" class="form-control" name="release_date" id="release_date" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="studio">studio :</label>
                                    <input type="text" class="form-control" name="studio" id="studio" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="is_private">private :</label>
                                    <select name="is_private" id="is_private" class="form-select" required>
                                        <option value="" hidden>-- Select --</option>
                                        <option value="0">Public</option>
                                        <option value="1">Private</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="category_id">category :</label>
                                    <select name="category_id" id="category_id" class="form-select" required>
                                        <option value="" hidden>-- Select --</option>
                                        <?php foreach ($categories as $category) : ?>
                                            <option value="<?= $category['id_category'] ?>"><?= $category['title'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
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