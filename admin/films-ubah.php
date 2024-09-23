<?php

session_start();
if (!isset($_SESSION['login'])){
  echo "<script>
  alert('Anda harus login terlebih dahulu!')
  document.location.href = 'login.php';
  </script>";
  exit;
}

$title = 'Edit Film';
require 'layout/header.php';

$categories = query("SELECT * FROM categories ORDER BY created_at DESC");

$id_film = (int) $_GET['id'];
$film = query("SELECT f.*, c.title AS category_title FROM films f JOIN categories c ON f.category_id = c.id_category WHERE f.id_film = $id_film")[0];

if (!$film) {
    echo "<script>
    alert('Film tidak ditemukan')
    document.location.href = 'films.php';
    </script>";
}

if (isset($_POST['submit'])) {
    $_POST['id_film'] = $id_film;

    if (ubah_film($_POST) > 0) {
        echo "<script>
        alert('Data berhasil diubah!')
        document.location.href = 'films.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal diubah!')
        document.location.href = 'films.php';
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
                        <input type="hidden" name="id" value="<?= $film["id_film"]; ?>">
                            <div class="mb-3">
                                <label for="url">url <small>(copy from youtube)</small> :</label>
                                <input type="text" class="form-control" name="url" id="url" required value="<?= $film["url"]; ?>">
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="title">title :</label>
                                    <input type="text" class="form-control" name="title" id="title" required value="<?= $film["title"]; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="slug">slug :</label>
                                    <input type="text" class="form-control" name="slug" id="slug" required value="<?= $film["slug"]; ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description">description :</label>
                                <textarea name="description" id="description" class="form-control" rows="3" required><?= $film["description"]; ?></textarea>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="release_date">release date :</label>
                                    <input type="date" class="form-control" name="release_date" id="release_date" required value="<?= $film["release_date"]; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="studio">studio :</label>
                                    <input type="text" class="form-control" name="studio" id="studio" required value="<?= $film["studio"]; ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="is_private">private :</label>
                                    <select name="is_private" id="is_private" class="form-select" required>
                                        <option value="" hidden>-- Select --</option>
                                        <option value="0" <?= $film['is_private'] == 0 ? 'selected' : '' ?>>Public</option>
                                        <option value="1" <?= $film['is_private'] == 1 ? 'selected' : ($film['is_private'] == '1' ? 'selected' : '') ?>>Private</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="category_id">category :</label>
                                    <select name="category_id" id="category_id" class="form-select" required>
                                        <option value="" hidden>-- Select --</option>
                                        <?php foreach ($categories as $category) : ?>
                                            <option value="<?= $category['id_category'] ?>" <?= $film['category_id'] == $category['id_category'] ? 'selected' : '' ?>><?= $category['title'] ?></option>
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