<?php 
session_start();
include 'koneksi.php';
include 'klien_navbar.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pusat Bantuan - Soulpict.u</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to bottom right, #f9fafb, #f0f4f8);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
      background-color: #fff;
      padding: 2rem;
      border-radius: 16px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    }
    h2 {
      color: #1d3557;
    }
    .accordion-button {
      background-color: #e9ecef;
      font-weight: 500;
      color: #333;
    }
    .accordion-button::after {
      filter: brightness(0.5);
    }
    .accordion-button:focus {
      box-shadow: none;
    }
    .accordion-body ul, .accordion-body ol {
      margin-left: 1rem;
    }
    .accordion-body ul li, .accordion-body ol li {
      margin-bottom: 0.5rem;
    }
    .accordion-item {
      border: 1px solid #dee2e6;
      border-radius: 12px;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <h2 class="text-center mb-4"><i class="fa-solid fa-circle-question text-primary me-2"></i>Pusat Bantuan</h2>
  <p class="text-center text-muted mb-4">Berikut adalah panduan untuk membantu Anda menggunakan website <strong>Soulpict.u</strong>.</p>

  <div class="accordion" id="bantuanAccordion">

    <!-- Pemesanan -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true">
          <i class="fa-solid fa-camera me-2 text-primary"></i> Cara Melakukan Pemesanan Jasa Foto
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#bantuanAccordion">
        <div class="accordion-body">
          <ol>
            <li>Buka website <strong>Soulpict.u</strong>.</li>
            <li>Klik menu <strong>Pesan Sekarang</strong> di navigasi atas.</li>
            <li>Isi formulir pemesanan dengan lengkap dan benar.</li>
            <li>Klik tombol <strong>Kirim Pemesanan</strong>.</li>
            <li>Tunggu email konfirmasi bahwa pesanan Anda telah diterima.</li>
          </ol>
        </div>
      </div>
    </div>

    <!-- Pembayaran -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingFour">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
          <i class="fa-solid fa-money-check-dollar me-2 text-info"></i> Email Konfirmasi dan Pembayaran
        </button>
      </h2>
      <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#bantuanAccordion">
        <div class="accordion-body">
          <ol>
            <li>Setelah pesanan disetujui oleh admin, Anda akan menerima email berisi:
              <ul>
                <li>Konfirmasi bahwa pesanan diterima.</li>
                <li>Rincian layanan yang Anda pilih.</li>
                <li>Kode pembayaran <strong>Virtual Account (VA)</strong> dan nominal yang harus dibayar.</li>
              </ul>
            </li>
            <li>Lakukan pembayaran melalui ATM, mobile banking, atau internet banking ke nomor VA tersebut.</li>
          </ol>
        </div>
      </div>
    </div>
    <!-- Galeri -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
          <i class="fa-solid fa-image me-2 text-success"></i> Cara Melihat Galeri Foto
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#bantuanAccordion">
        <div class="accordion-body">
          <ul>
            <li>Klik menu <strong>Galeri</strong> di navigasi.</li>
            <li>Anda akan melihat kumpulan foto hasil dokumentasi dari klien sebelumnya.</li>
            <li>Gunakan scroll atau klik untuk melihat lebih detail (jika lightbox diaktifkan).</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Layanan -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
          <i class="fa-solid fa-list me-2 text-warning"></i> Melihat Detail Layanan dan Harga
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#bantuanAccordion">
        <div class="accordion-body">
          <ul>
            <li>Klik menu <strong>Layanan</strong> di bagian atas website.</li>
            <li>Pilih salah satu layanan dan klik tombol <strong>Detail</strong>.</li>
            <li>Informasi lengkap seperti nama paket, harga, dan deskripsi akan ditampilkan.</li>
          </ul>
        </div>
      </div>
    </div>


    <!-- Kontak -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingFive">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
          <i class="fa-solid fa-phone-volume me-2 text-danger"></i> Menghubungi Admin Jika Ada Kendala
        </button>
      </h2>
      <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#bantuanAccordion">
        <div class="accordion-body">
          <p>Silakan hubungi admin jika Anda memiliki pertanyaan atau mengalami kendala:</p>
          <ul>
            <li><strong>WhatsApp:</strong> <a href="https://wa.me/6285846281670" target="_blank">0858-4628-1670</a></li>
            <li><strong>Email:</strong> <a href="mailto:thesoulpictureofu@gmail.com">thesoulpictureofu@gmail.com</a></li>
            <li><strong>Instagram:</strong> <a href="https://www.instagram.com/soulpict.u/" target="_blank">@soulpict.u</a></li>
          </ul>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
