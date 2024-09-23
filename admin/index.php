<?php 

session_start();
if (!isset($_SESSION['login'])){
  echo "<script>
  alert('Anda harus login terlebih dahulu!')
  document.location.href = 'login.php';
  </script>";
  exit;
}

$title = "Dashboard";
// include digunakan untuk memanggil file php lain dan jika file yang diinclude tidak ada maka akan menampilkan peringatan dan tetap menjalankan program
// require digunakan untuk memanggil file php lain dan jika file yang diinclude tidak ada maka akan menampilkan error dan program akan berhenti
require 'layout/header.php';



?>

<!-- main -->
<main class="p-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <W class="card-header">
          <i class="bi bi-pie-chart-fill"></i>
            <?= $title ?>
          </W>
          <div class="card-body">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae quaerat laborum reprehenderit sed
            deleniti recusandae!
          </div>
          <div class="card-footer">
            Footer
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- main -->

 <?php 
 
 require 'layout/footer.php';
 
 ?>