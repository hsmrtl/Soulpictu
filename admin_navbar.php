<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$role = $_SESSION['role'] ?? null;
?>

<!-- Google Fonts & Bootstrap Icons (taruh di <head> jika belum) -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

<style>
body {
  margin: 0;
  font-family: "Poppins", sans-serif;
  font-size: 0.9rem;
  display: flex;
}

/* Sidebar Style */
.sidebar {
  width: 220px;
  background: linear-gradient(135deg, #f8f9fa, #e2e6ea);
  padding: 20px 20px;
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  overflow-y: auto;
  box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
  z-index: 100;
  border-right: 1px solid #ddd;
  transition: all 0.3s ease;
}

/* Brand */
.navbar-brand {
  font-family: 'Playfair Display', serif;
  font-weight: bold;
  font-size: 1.8rem;
  color: #343a40;
  text-align: center;
  margin-bottom: 30px;
  display: block;
}

/* Nav Links */
.nav-link {
  font-weight: 400;
  color: #333;
  padding: 12px 20px;
  margin: 6px 0;
  border-radius: 30px;
  transition: all 0.25s ease;
  display: flex;
  align-items: center;
}

.nav-link i {
  margin-right: 12px;
  font-size: 1.2rem;
  color: #6c757d;
  transition: transform 0.3s;
}

.nav-link:hover {
  color: #fff;
  background-color: #6c63ff;
}

.nav-link:hover i {
  color: white;
  transform: scale(1.2);
}

/* Aktif */
.nav-link.active {
  background-color: #6c63ff;
  color: white;
  font-weight: 600;
}

/* Logout Style */
.nav-link.text-danger {
  color: #dc3545 !important;
}
.nav-link.text-danger:hover {
  background-color:rgba(255, 184, 190, 0.69);
  color: #dc3545 !important;
}

/* Responsive (Optional) */
@media (max-width: 768px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
    border-radius: 0;
  }
}
</style>

<div class="sidebar">
  <a class="navbar-brand" href="<?= ($role === 'admin' || $role === 'fotografer') ? 'admin_index.php' : 'index.php' ?>">Soulpict.u</a>

  <ul class="nav flex-column">
    <?php if ($role === 'admin'): ?>
      <li class="nav-item">
        <a class="nav-link" href="admin_index.php">
          <i class="bi bi-house-door-fill"></i> Beranda
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_galeri.php">
          <i class="bi bi-images"></i> Galeri
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_paket.php">
          <i class="bi bi-collection"></i> Layanan
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_form.php">
          <i class="bi bi-calendar-plus"></i> Pesan Sekarang
        </a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="admin_data_pesanan.php">
        <i class="bi bi-table"></i> Data Pesanan
      </a>
    </li>
    <?php endif; ?>

    
    <?php if ($role === 'fotografer'): ?>
      <li class="nav-item">
        <a class="nav-link" href="admin_index.php">
          <i class="bi bi-house-door-fill"></i> Beranda
        </a>
      </li>
    <li class="nav-item">
      <a class="nav-link" href="admin_data_pesanan.php">
        <i class="bi bi-table"></i> Data Pesanan
      </a>
    </li>
    <?php endif; ?>

    <li class="nav-item mt-4">
      <a class="nav-link text-danger" href="admin_logout.php">
        <i class="bi bi-box-arrow-right"></i> Logout
      </a>
    </li>
  </ul>
</div>
