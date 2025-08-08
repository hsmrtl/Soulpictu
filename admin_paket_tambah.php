<?php
include 'koneksi.php';
include 'admin_navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_layanan = $_POST['nama_layanan'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    $foto = '';
    if ($_FILES['foto']['name']) {
        $foto = time() . '_' . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], 'foto/' . $foto);
    }

    $query = "INSERT INTO layanan (nama_layanan, harga, deskripsi, foto)
              VALUES ('$nama_layanan', '$harga', '$deskripsi', '$foto')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Paket berhasil ditambahkan'); window.location='admin_paket.php';</script>";
    } else {
        echo "Gagal menambah data: " . mysqli_error($koneksi);
    }
}
?>

<!-- TAMPILAN FORM -->
<div class="container mt-5">
  <div class="card shadow-sm border-0 rounded-4 mx-auto" style="max-width: 700px;">
    <div class="card-body p-4">
      <h3 class="text-center mb-4">Tambah Paket Foto</h3>
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label fw-semibold">Nama Paket</label>
          <input type="text" name="nama_layanan" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Harga</label>
          <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Foto</label>
          <input type="file" name="foto" class="form-control">
        </div>
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-success px-4"><i class="bi bi-save"></i> Simpan</button>
          <a href="admin_paket.php" class="btn btn-secondary px-4"><i class="bi bi-arrow-left"></i> Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
