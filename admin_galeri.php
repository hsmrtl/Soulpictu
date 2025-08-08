<?php
include 'koneksi.php';
include 'admin_navbar.php';
?>

<main class="ms-5 pt-2 mt-1">
  <div class="container ">
    <h2 class="text-center mb-1">Galeri Soulpict.u</h2>

    <!-- Baris 1 -->
    <div class="row justify-content-center mb-3">
      <div class="col-sm-2 text-center">
        <div class="galeri-img-wrapper">
          <img src="foto/217.jpg" alt="Foto 1" class="img-thumbnail">
        </div>
      </div>
      <div class="col-sm-2 text-center">
        <div class="galeri-img-wrapper">
          <img src="foto/zzz.jpg" alt="Foto 2" class="img-thumbnail">
        </div>
      </div>
      <div class="col-sm-2 text-center">
        <div class="galeri-img-wrapper">
          <img src="foto/2117.jpg" alt="Foto 3" class="img-thumbnail">
        </div>
      </div>
    </div>

    <!-- Baris 2 -->
    <div class="row justify-content-center mb-3">
      <div class="col-sm-2 text-center">
        <div class="galeri-img-wrapper">
          <img src="foto/az.jpg" alt="Foto 4" class="img-thumbnail">
        </div>
      </div>
      <div class="col-sm-2 text-center">
        <div class="galeri-img-wrapper">
          <img src="foto/b.jpg" alt="Foto 5" class="img-thumbnail">
        </div>
                <!-- Tombol -->
        <div class="text-start mt-1">
          <a href="https://www.instagram.com/soulpict.u/profilecard/?igsh=ZXJ5ZnZuejd5cm9r" class="btn btn-outline-dark btn-sm">
            Lihat Selengkapnya
          </a>
        </div>
      </div>
      <div class="col-sm-2 text-center">
        <div class="galeri-img-wrapper">
          <img src="foto/2122.jpg" alt="Foto 6" class="img-thumbnail">
        </div>
      </div>
    </div>
    
  </div>
</main>


<!-- Modal Zoom Gambar -->
<div class="modal fade" id="modalImage" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-body p-0">
        <img id="modalImagePreview" class="w-100 rounded">
      </div>
    </div>
  </div>
</div>

<script>
  // Tangani klik gambar dan tampilkan di dalam modal
  document.querySelectorAll('.galeri-img-wrapper img').forEach(function(img) {
    img.addEventListener('click', function() {
      const modalImg = document.getElementById('modalImagePreview');
      modalImg.src = this.src;
      const modal = new bootstrap.Modal(document.getElementById('modalImage'));
      modal.show();
    });
  });
</script>
