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

$id_user = (int) $_GET['id'];

$getDataById = query("SELECT * FROM users WHERE id_user = $id_user")[0];

if (!$getDataById) {
    echo "<script>alert('Data tidak ditemukan!')
    document.location.href = 'users.php'
    </script>";
}

if ($_SESSION['role'] == 'admin') {
    // Admin bisa hapus data user manapun
    if (delete_user($id_user) > 0) {
        echo "<script>
        alert('Data berhasil dihapus!')
        document.location.href = 'users.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal dihapus!')
        document.location.href = 'users.php';
        </script>";
    }
} else {
    echo "<script>
    alert('Hanya admin yang bisa menghapus user!')
    document.location.href = 'users.php';
    </script>";
}
