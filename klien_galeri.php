<?php 
include 'klien_navbar.php';
include 'klien_head.php';
?>
<!DOCTYPE html>
<html lang="en">

<body>
<main >
<div class="container mt-5">
    <h2 class="text-center mt-5">Galeri Soulpict.u</h2>
    <div class="row g-4">
      <div class="col-sm-6 col-md-4">
        <div class="galeri-img-wrapper">
          <img src="foto/217.jpg" alt="Foto 1" class="img-fluid shadow">
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="galeri-img-wrapper">
          <img src="foto/zzz.jpg" alt="Foto 1" class="img-fluid shadow">
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="galeri-img-wrapper">
          <img src="foto/2117.jpg" alt="Foto 2" class="img-fluid shadow">
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="galeri-img-wrapper">
          <img src="foto/az.jpg" alt="Foto 3" class="img-fluid shadow">
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="galeri-img-wrapper">
          <img src="Foto/b.jpg" alt="Foto 1" class="img-fluid shadow">
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="galeri-img-wrapper">
          <img src="foto/2122.jpg" alt="Foto 1" class="img-fluid shadow">
        </div>
      </div>
      <!-- Modal Zoom Gambar -->
  <div class="modal fade" id="modalImage" tabgaleri="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-body p-0">
          <img id="modalImagePreview" class="w-100 rounded">
        </div>
      </div>
    </div>
  </div>
        <a href="https://www.instagram.com/soulpict.u/" class="btn btn-outline-dark">
      Lihat Selengkapnya</a>
    </div>
  </div>
</main>

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
    

<?php 
include 'iconpb.php';
include 'klien_footer.php';?>
</body>
</html>