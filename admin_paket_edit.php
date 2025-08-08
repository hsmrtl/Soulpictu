<?php
include 'koneksi.php';
include 'admin_navbar.php';

// Ambil ID dari GET atau POST
$id = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['id'] : $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_layanan = $_POST['nama_layanan'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // Ambil data lama untuk mendapatkan nama foto
    $data_lama = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM layanan WHERE id_layanan = '$id'"));
    $foto = $data_lama['foto'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $namaFile = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = 'foto/' . $namaFile;

        if (move_uploaded_file($tmp, $folder)) {
            $foto = $namaFile;
        }
    }

    $query = "UPDATE layanan SET 
                nama_layanan = '$nama_layanan',
                harga = '$harga',
                deskripsi = '$deskripsi',
                foto = '$foto'
              WHERE id_layanan = '$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Paket berhasil diupdate'); window.location='admin_paket.php';</script>";
        exit;
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($koneksi);
    }
}

// Ambil data terbaru untuk ditampilkan di form
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM layanan WHERE id_layanan = '$id'"));
?>

<!-- TAMPILAN FORM -->
<div class="container mt-5">
  <div class="card shadow-sm border-0 rounded-4 mx-auto" style="max-width: 700px;">
    <div class="card-body p-4">
      <h3 class="text-center mb-4">Edit Paket Foto</h3>
      <form action="admin_paket_edit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id ?>">

        <div class="mb-3">
          <label class="form-label fw-semibold">Nama Paket</label>
          <input type="text" name="nama_layanan" class="form-control" value="<?= htmlspecialchars($data['nama_layanan']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Harga</label>
          <input type="number" name="harga" class="form-control" value="<?= $data['harga'] ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="4" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Foto Saat Ini:</label><br>
          <img src="foto/<?= $data['foto'] ?>" class="img-thumbnail mb-2" width="200"><br>
          <input type="file" name="foto" class="form-control">
        </div>

        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save"></i> Update</button>
          <a href="admin_paket.php" class="btn btn-secondary px-4"><i class="bi bi-arrow-left"></i> Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
