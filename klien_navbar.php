<?php
include 'klien_head.php';
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Soulpict.u</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="klien_galeri.php">Galeri</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="klien_paket.php">Paket Foto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="klien_form.php">Pesan Sekarang</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active text-info" aria-current="page" href="admin_login.php"><i class="bi bi-box-arrow-in-right"></i>Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>