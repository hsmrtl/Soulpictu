<?php
include 'koneksi.php'; 
include 'klien_head.php';
include 'klien_navbar.php';
?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Daftar Paket Foto</h2>
  <div class="row g-4">

    <?php
    $query = "SELECT * FROM layanan ORDER BY id_layanan DESC";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id_layanan'];
        $nama = htmlspecialchars($row['nama_layanan']);
        $harga = number_format($row['harga'], 0, ',', '.');
        $deskripsi = nl2br(htmlspecialchars($row['deskripsi']));
        $gambar = !empty($row['foto']) ? $row['foto'] : 'default.jpg';
    ?>

        <div class="col-12 col-sm-6 col-lg-4">
          <div class="card shadow-sm border-0 w-100">
            <img src="foto/<?php echo $gambar; ?>" class="card-img-top" alt="<?php echo $nama; ?>" style="height: 220px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?php echo $nama; ?></h5>
              <h6 class="fw-bold text-success mb-3">Rp <?php echo $harga; ?></h6>

              <!-- Tombol Detail -->
              <button class="btn btn-outline-info w-100 detail-btn" data-target="collapse<?= $id ?>">
                Lihat Detail
              </button>

              <!-- Deskripsi (sembunyi default) -->
              <div id="collapse<?= $id ?>" class="collapse mt-3">
                <div class="card card-body border-0 p-0">
                  <p class="card-text"><?php echo $deskripsi; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>

    <?php
      }
    } else {
      echo '<p class="text-center">Belum ada data layanan yang tersedia.</p>';
    }
    ?>

  </div>
</div>

<!-- Script agar deskripsi bisa toggle dan hanya satu yang aktif -->
<script>
  document.querySelectorAll('.detail-btn').forEach(button => {
    button.addEventListener('click', function () {
      const targetId = this.getAttribute('data-target');
      const targetEl = document.getElementById(targetId);

      // Tutup semua deskripsi lain
      document.querySelectorAll('.collapse').forEach(collapse => {
        if (collapse.id !== targetId) {
          collapse.classList.remove('show');
        }
      });

      // Toggle deskripsi dari tombol yang diklik
      targetEl.classList.toggle('show');
    });
  });
</script>

<?php 
include 'iconpb.php';
include 'klien_footer.php'; 
?>
