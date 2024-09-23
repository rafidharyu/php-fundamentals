<?php

session_start();
if (!isset($_SESSION['login'])){
  echo "<script>
  alert('Anda harus login terlebih dahulu!')
  document.location.href = 'login.php';
  </script>";
  exit;
}

if (!isset($_SESSION['login'])){
    echo "<script>
    alert('Anda harus login terlebih dahulu!')
    document.location.href = 'login.php';
    </script>";
    exit;
}

$title = "Films";
require 'layout/header-datatable.php';

$films = query("SELECT f.id_film, f.title, f.studio, f.is_private, f.created_at, c.title AS category_title FROM films f JOIN categories c ON f.category_id = c.id_category ORDER BY f.created_at DESC");
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
                            <a href="films-create.php" class="btn btn-success mb-1"><i class="bi bi-plus-circle"></i> Create</a>
                            <a href="films-download.php" class="btn btn-primary mb-1 ms-1"><i class="bi bi-download"></i> Download</a>

                            <table id="datatable" class="table table-bordered table-striped table-responsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Nama</th>
                                        <th>Studio</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th>Created At</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($films as $film) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $film['title'] ?></td>
                                            <td><?= $film['studio'] ?></td>
                                            <td><?= $film['category_title'] ?></td>
                                            <!-- jika is_private = 0 maka film public jika is_private = 1 maka film private -->
                                            <td>
                                                <?= $film['is_private'] ? 'Private' : 'Public' ?>
                                            </td>
                                            <td><?= $film['created_at'] ?></td>
                                            <td class="text-center">
                                                <a href="films-detail.php?id=<?= $film['id_film'] ?>" class="btn btn-sm btn-secondary mb-1" title="Detail"><i class="bi bi-eye"></i></a>

                                                <a href="films-ubah.php?id=<?= $film['id_film'] ?>" class="btn btn-sm btn-primary mb-1" title="Edit"><i class="bi bi-pencil-square"></i></a>

                                                <a href="films-delete.php?id=<?= $film['id_film'] ?>" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-sm btn-danger mb-1" title="Delete"><i class="bi bi-trash"></i></a>
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