<?php

session_start();
if (!isset($_SESSION['login'])){
  echo "<script>
  alert('Anda harus login terlebih dahulu!')
  document.location.href = 'login.php';
  </script>";
  exit;
}

$title = "Detail Films";
require 'layout/header-datatable.php';

$id_film = (int) $_GET['id'];
$film = query("SELECT f.*, c.title AS category_title FROM films f JOIN categories c ON f.category_id = c.id_category WHERE f.id_film = $id_film")[0];

if (!$film) {
    echo "<script>
    alert('Film tidak ditemukan')
    document.location.href = 'films.php';
    </script>";
}

// $films = query("SELECT f.*, c.title AS category_title FROM films f JOIN categories c ON f.category_id = c.id_category WHERE f.id_film = $id_film");
?>

<!-- main -->
<main class="p-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-film"></i>
                        <?= $title ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-responsive" style="width:100%">
                                <tr>
                                    <th>Video</th>
                                    <td>
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $film['url'] ?>?si=moRLofo7q7Xjs3UP" title="<?= $film['title'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td><?= $film['category_title'] ?></td>
                                </tr>
                                <tr>
                                    <th>Title</th>
                                    <td><?= $film['title'] ?></td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td><?= $film['slug'] ?></td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td><?= $film['description'] ?></td>
                                </tr>
                                <tr>
                                    <th>Release Date</th>
                                    <td><?= $film['release_date'] ?></td>
                                </tr>
                                <tr>
                                    <th>Studio</th>
                                    <td><?= $film['studio'] ?></td>
                                </tr>
                                <tr>
                                    <th>Private</th>
                                    <td><?= $film['is_private'] ? 'Private' : 'Public' ?></td>
                                </tr>
                            </table>
                            <div class="float-end">
                                <a href="films.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                            </div>
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