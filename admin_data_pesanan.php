<?php
session_start();
include 'koneksi.php';
?>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-2 bg-light min-vh-100">
      <?php include 'admin_navbar.php'; ?>
    </div>

    <?php
    // ambil keyword pencarian dari input
    $keyword = $_GET['keyword'] ?? '';
    $filter_sql = "";

    // kalau ada pencarian, tambahkan ke query
    if ($keyword) {
        $safe_keyword = mysqli_real_escape_string($koneksi, $keyword);
        $filter_sql = "AND (
            p.nama_pelanggan LIKE '%$safe_keyword%' OR
            l.nama_layanan LIKE '%$safe_keyword%' OR
            p.tanggal_pemotretan LIKE '%$safe_keyword%' OR
            p.email LIKE '%$safe_keyword%'
        )";
    }
    ?>

    <!-- Konten utama -->
    <div class="col-md-10 p-4">
      <h2 class="mb-4 text-center">Data Pemesanan</h2>
      <div class="table-responsive">
      <form method="GET" class="d-flex mb-3" style="max-width: 400px;">
        <input type="text" name="keyword" class="form-control me-2" placeholder="Cari nama, tanggal, paket, email..." value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit" class="btn btn-outline-primary">Cari</button>
      </form>
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Nama Pelanggan</th>
              <th>Paket</th>
              <th>Tanggal</th>
              <th>Tempat</th>
              <th>Waktu</th>
              <th>Telepon</th>
              <th>Email</th>
              <th>Status Pesanan</th>
              <th>Status Pembayaran</th>
              <th>Id Order</th>
              <th>VA</th>
              <th>Jumlah Tagihan</th>
              <?php
              $role = $_SESSION['role'] ?? '';
              $isAdmin = ($role === 'admin');
              if ($isAdmin): ?>
                <th>Aksi</th>
              <?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $query = "SELECT p.*, l.nama_layanan, l.harga, bayar.status_pembayaran,  bayar.kode_va, bayar.id_tagihan, bayar.bukti_pembayaran
                FROM pemesanan p
                JOIN layanan l ON p.id_layanan = l.id_layanan
                LEFT JOIN pembayaran bayar ON bayar.id_pemesanan = p.id_pemesanan
                WHERE 1=1 $filter_sql
                ORDER BY p.id_pemesanan DESC";

            $result = mysqli_query($koneksi, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama_pelanggan']); ?></td>
                <td><?= htmlspecialchars($row['nama_layanan']); ?></td>
                <td><?= $row['tanggal_pemotretan']; ?></td>
                <td><?= $row['tempat_pemotretan']; ?></td>
                <td><?= $row['waktu_pemotretan']; ?></td>
                <td><?= $row['no_hp']; ?></td>
                <td><?= $row['email']; ?></td>
                <td>
                  <?php if ($row['status_pesanan'] === 'Menunggu'): ?>
                    <form method="POST" class="d-flex gap-1">
                      <a href="konfirmasi_pesanan_diterima.php?id=<?= $row['id_pemesanan']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Terima pesanan ini?')">
                        <i class="bi bi-bookmark-check"></i>
                      </a>
                      <a href="konfirmasi_pesanan_ditolak.php?id=<?= $row['id_pemesanan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tolak pesanan ini?')">
                        <i class="bi bi-bookmark-x"></i>
                      </a>
                    </form>
                  <?php elseif ($row['status_pesanan'] === 'Diterima'): ?>
                    <span class="text-success fw-bold">Pesanan diterima</span>
                  <?php elseif ($row['status_pesanan'] === 'Ditolak'): ?>
                    <span class="text-danger fw-bold">Pesanan ditolak</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php
                  
                  if ($row['status_pesanan'] === 'Ditolak') {
                    echo "<span class='badge text-dark'>-</span>";
                  } else {
                  $bayar = $row['status_pembayaran'] ?? 'belum_ada';
                    switch ($bayar) {
                      case 'settlement':
                        $badge_bayar = 'success';
                        $label = 'Lunas';
                        break;
                      case 'pending':
                        $badge_bayar = 'warning';
                        $label = 'Menunggu';
                        break;
                      case 'expire':
                        $badge_bayar = 'secondary';
                        $label = 'Kedaluwarsa';
                        break;
                      default:
                        $badge_bayar = 'danger';
                        $label = 'Belum Bayar';
                        break;
                    }
                    echo "<span class='badge bg-$badge_bayar'>$label</span>";
                  }

                  ?>
                </td>           

                <?php if ($row['status_pesanan'] === 'Diterima'): ?>
                <td><?= $row['id_tagihan'] ?: '-'; ?></td>
                <td><?= $row['kode_va'] ?: '-'; ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
              <?php else: ?>
                <td>-</td>
                <td>-</td>
                <td>-</td>
              <?php endif; ?>

                <?php if ($isAdmin): ?>
                  <td>
                    <a href="admin_edit_pesanan.php?id=<?= $row['id_pemesanan']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>
                    <a href="admin_hapus_pesanan.php?id=<?= $row['id_pemesanan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus pesanan ini?')"><i class="bi bi-trash3-fill"></i></a>
                  </td>
                <?php endif; ?>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
