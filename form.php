<div class="container my-4 mt-5 p-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h4 class="text-center mb-3">Form Pemesanan</h4>
      <form action="proses_pesanan.php" method="POST" enctype="multipart/form-data" class="shadow-sm p-3 rounded bg-light" style="max-height: 90vh; overflow-y: auto;">
        
        <div class="mb-2">
          <label for="nama" class="form-label small">Nama</label>
          <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control form-control-sm" required>
        </div>

        <div class="mb-2">
          <label for="layanan" class="form-label small">Pilih Paket Foto</label>
          <select name="id_layanan" id="layanan" class="form-select form-select-sm" required>
            <option value="">-- Pilih Paket --</option>
            <?php
              $result = mysqli_query($koneksi, "SELECT * FROM layanan ORDER BY nama_layanan ASC");
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$row['id_layanan'].'">'.$row['nama_layanan'].'</option>';
              }
            ?>
          </select>
        </div>
        
        <div class="mb-2">
          <label for="tanggal_pemesanan" class="form-label small">Tanggal Pemotretan</label>
          <input type="date" name="tanggal_pemotretan" id="tanggal_pemesanan" class="form-control form-control-sm" required>
        </div>
        
        <div class="mb-2">
          <label class="form-label small">Tempat Pemotretan</label>
          <input type="text" class="form-control form-control-sm" name="tempat_pemotretan" required>
        </div>

        <div class="mb-2">
          <label class="form-label small">Waktu Pemotretan</label>
          <input type="time" class="form-control form-control-sm" name="waktu_pemotretan" required>
        </div>
        
        <div class="mb-2">
          <label for="telepon" class="form-label small">No. Telepon / WhatsApp</label>
          <input type="text" name="no_hp" id="telepon" class="form-control form-control-sm" required>
        </div>
            
        <div class="mb-3">
          <label for="email" class="form-label small">Email</label>
          <input type="email" name="email" id="email" class="form-control form-control-sm" required>
        </div>

        <button type="submit" class="btn btn-primary btn-sm w-100">Kirim Pemesanan</button>
      </form>
    </div>
  </div>
</div>
