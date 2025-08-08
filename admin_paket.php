<?php
include 'koneksi.php';
include 'admin_navbar.php';
?>

<div class="container mt-5 pt-4">
  <h2 class="text-center mb-4">Daftar Paket Foto</h2>
    <div class="d-flex justify-content-end mb-5">
    <a href="admin_paket_tambah.php" class="btn btn-outline-success btn-sm">
      <i class="bi bi-plus-circle"></i> Tambah Paket
    </a>
  </div>
  <div class="row justify-content-center ms-5 g-3">
    
    
    <?php
    $query = "SELECT * FROM layanan ORDER BY id_layanan DESC";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id_layanan'];
        $nama_layanan = htmlspecialchars($row['nama_layanan']);
        $harga = number_format($row['harga'], 0, ',', '.');
        $deskripsi = nl2br(htmlspecialchars($row['deskripsi']));
        $gambar = !empty($row['foto']) ? $row['foto'] : 'default.jpg';
        ?>


      
      <div class="col-6 col-sm-4 col-md-3 col-lg-3">
        <div class="card shadow-sm border-0" style="font-size: 0.75rem;">
          <img src="foto/<?php echo $gambar; ?>" class="card-img-top" alt="<?php echo $nama; ?>" style="height: 130px; object-fit: cover;">
          <div class="card-body p-2 d-flex flex-column">
            <h6 class="card-title mb-1 text-truncate"><?php echo $nama_layanan; ?></h6>
            <p class="fw-bold text-success mb-2" style="font-size: 0.8rem;">Rp <?php echo $harga; ?></p>

            <!-- Tombol Detail -->
            <button class="btn btn-outline-info w-100 mb-2 btn-sm detail-btn" data-target="collapse<?= $id ?>">Detail</button>

            <!-- Tombol Aksi Edit Tambah & Hapus -->
            <div class="d-flex flex-column gap-3">
              <div class="btn btn-md">
              <a href="admin_paket_edit.php?id=<?= $id ?>"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .4rem; --bs-btn-font-size: .75rem;"><i class="btn btn-sm btn-warning bi bi-pencil"></i></a>
              <a href="admin_paket_hapus.php?id=<?= $id ?>" 
                onclick="return confirm('Yakin ingin menghapus layanan ini?')"><i class="btn btn-sm btn-danger bi bi-trash3"></i></a>
              </div>
            </div>

            <!-- Deskripsi (sembunyi default) -->
            <div id="collapse<?= $id ?>" class="collapse mt-2">
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
