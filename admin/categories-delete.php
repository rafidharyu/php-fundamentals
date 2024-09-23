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

$id_category = (int) $_GET['id'];

$getDataById = query("SELECT * FROM categories WHERE id_category = $id_category")[0];

if (!$getDataById) {
    echo "<script>alert('Data tidak ditemukan!')
    document.location.href = 'categories.php'
    </script>";
}

if (delete_category($id_category) > 0) {
    echo "<script>
    alert('Data berhasil dihapus!')
    document.location.href = 'categories.php';
    </script>";
} else {
    echo "<script>
    alert('Data gagal dihapus!')
    document.location.href = 'categories.php';
    </script>";
}
