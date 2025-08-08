<?php
include 'klien_head.php';
include 'klien_navbar.php';
?>

<!DOCTYPE html>
<html lang="en" style="height:100%;">
<head>
    
</head>

<body>
  <style>
.carousel-item img {
  max-height: 650px; /* ubah sesuai keinginan, misal 300px */
  object-fit: cover;
}
</style>


<!--slide foto-->
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="foto/aaaa.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="foto/zakiah.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="foto/ber.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

 <!-- Kalender dan Galeri -->
 <div class="container mt-5">
    <div class="row">
      <?php include 'kalender.php'; ?>
      

      <!-- Galeri -->
      <div class="col-lg-6 col-md-6 offset-lg-1 galeri-wrapper">
        <div class="row g-2">
         
          <div class="col-6 col-sm-6">
            <img src="foto/lia5.jpg" class="gallery-img img-fluid shadow-sm" data-bs-toggle="modal" data-bs-target="#modalImage">
            <img src="foto/lia.jpg" class="gallery-img img-fluid shadow-sm" data-bs-toggle="modal" data-bs-target="#modalImage">
          </div>
          <div class="col-6 col-sm-6">
            <img src="foto/berr.jpg" class="gallery-img img-fluid shadow-sm" data-bs-toggle="modal" data-bs-target="#modalImage">
          </div>
          <div class="col-6 col-sm-6">
            <img src="foto/1.jpg" class="gallery-img img-fluid shadow-sm" data-bs-toggle="modal" data-bs-target="#modalImage">
          </div>
          <div class="col-6 col-sm-6">
            <img src="foto/awa2.jpg" class="gallery-img img-fluid shadow-sm" data-bs-toggle="modal" data-bs-target="#modalImage">
          </div>
        </div>
        <a href="https://www.instagram.com/soulpict.u/profilecard/?igsh=ZXJ5ZnZuejd5cm9r" type="button" class="btn btn-dark mt-3 d-block mx-auto">
          Lihat Selengkapnya
        </a>
      </div>
      
    </div>
  </div>
  


<?php
include 'iconpb.php';
include 'klien_footer.php';
?>

</body>
</html>