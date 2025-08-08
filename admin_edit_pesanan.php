<?php
include 'koneksi.php';
include 'admin_head.php';
include 'admin_navbar.php';

if (!isset($_GET['id'])) {
  echo "<script>alert('ID tidak ditemukan'); window.location='admin_data_pesanan.php';</script>";
  exit;
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "
  SELECT p.*, bayar.status_pembayaran 
  FROM pemesanan p 
  LEFT JOIN pembayaran bayar ON bayar.id_pemesanan = p.id_pemesanan 
  WHERE p.id_pemesanan = '$id'
");
$data = mysqli_fetch_assoc($query);

if (!$data) {
  echo "<script>alert('Data tidak ditemukan'); window.location='admin_data_pesanan.php';</script>";
  exit;
}
?>

<div class="container my-5">
  <div class="card shadow border-0 rounded-4 mx-auto" style="max-width: 800px;">
    <div class="card-body px-4 py-5">
      <h3 class="text-center mb-4">Edit Data Pemesanan</h3>

      <form action="proses_edit_pesanan.php" method="POST">
        <input type="hidden" name="id_pemesanan" value="<?= $data['id_pemesanan'] ?>">

        <div class="mb-3">
          <label class="form-label fw-semibold">Nama Pelanggan</label>
          <input type="text" name="nama_pelanggan" class="form-control" value="<?= $data['nama_pelanggan'] ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Paket Layanan</label>
          <select name="id_layanan" class="form-select" required>
            <?php
            $layanan = mysqli_query($koneksi, "SELECT * FROM layanan");
            while ($row = mysqli_fetch_assoc($layanan)) {
              $selected = ($row['id_layanan'] == $data['id_layanan']) ? 'selected' : '';
              echo "<option value='{$row['id_layanan']}' $selected>{$row['nama_layanan']}</option>";
            }
            ?>
          </select>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Tanggal Pemotretan</label>
            <input type="date" name="tanggal_pemotretan" class="form-control" value="<?= $data['tanggal_pemotretan'] ?>" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Waktu Pemotretan</label>
            <input type="time" name="waktu_pemotretan" class="form-control" value="<?= $data['waktu_pemotretan'] ?>" required>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Tempat Pemotretan</label>
          <input type="text" name="tempat_pemotretan" class="form-control" value="<?= $data['tempat_pemotretan'] ?>" required>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">No HP / WhatsApp</label>
            <input type="text" name="no_hp" class="form-control" value="<?= $data['no_hp'] ?>" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>" required>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save"></i> Simpan</button>
          <a href="admin_data_pesanan.php" class="btn btn-secondary px-4"><i class="bi bi-arrow-left"></i> Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
