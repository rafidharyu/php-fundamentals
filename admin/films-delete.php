<?php

session_start();
if (!isset($_SESSION['login'])){
  echo "<script>
  alert('Anda harus login terlebih dahulu!')
  document.location.href = 'login.php';
  </script>";
  exit;
}

require 'config/app.php';

$id_film = (int) $_GET['id'];
$film = query("SELECT f.*, c.title AS category_title FROM films f JOIN categories c ON f.category_id = c.id_category WHERE f.id_film = $id_film")[0];

if (!$film) {
    echo "<script>
    alert('Film tidak ditemukan')
    document.location.href = 'films.php';
    </script>";
}

if (delete_film($id_film) > 0) {
    echo "<script>
        alert('Data berhasil dihapus!')
        document.location.href = 'films.php';
        </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus!')
        document.location.href = 'films.php';
        </script>";
}
