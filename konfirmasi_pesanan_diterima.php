<?php
include 'koneksi.php';
require 'vendor/autoload.php';
require_once 'midtrans_config.php'; // Konfigurasi server key, dll

use PHPMailer\PHPMailer\PHPMailer;

if (!isset($_GET['id'])) {
    header("Location: admin_data_pesanan.php");
    exit;
}

$id = $_GET['id'];

// Ambil data pemesanan dan layanan
$query = mysqli_query($koneksi, "SELECT p.*, l.nama_layanan, l.harga 
                                 FROM pemesanan p 
                                 JOIN layanan l ON p.id_layanan = l.id_layanan 
                                 WHERE p.id_pemesanan = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan'); window.location='admin_data_pesanan.php';</script>";
    exit;
}

// Update status pemesanan
mysqli_query($koneksi, "UPDATE pemesanan SET status_pesanan = 'Diterima' WHERE id_pemesanan = '$id'");

// Buat order_id unik
$order_id = 'SOUL-' . time();
$gross_amount = $data['harga'];

// Kirim permintaan ke Midtrans menggunakan Core API
$params = [
    'payment_type' => 'bank_transfer',
    'transaction_details' => [
        'order_id' => $order_id,
        'gross_amount' => $gross_amount
    ],
    'customer_details' => [
        'first_name' => $data['nama_pelanggan'],
        'email' => $data['email']
    ],
    'bank_transfer' => [
        'bank' => 'bri' // ganti ke bni/bri jika ingin bank lain
    ]
];

try {
    $response = \Midtrans\CoreApi::charge($params);

    // Ambil data VA
    $va_number = $response->va_numbers[0]->va_number;
    $bank = strtoupper($response->va_numbers[0]->bank);
    $kode_va = $va_number;
    $id_tagihan = $order_id;


    // Simpan ke tabel pembayaran
    mysqli_query($koneksi, "INSERT INTO pembayaran 
        (id_pemesanan, kode_va, id_tagihan, status_pembayaran) 
        VALUES ('$id', '$va_number', '$order_id', 'pending')");

    // Kirim email ke pelanggan
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'thesoulpictureofu@gmail.com';
    $mail->Password   = 'siybbccvixskptln'; // App password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('thesoulpictureofu@gmail.com', 'Soulpict.u');
    $mail->addAddress($data['email'], $data['nama_pelanggan']);
    $mail->Subject = "Pesanan Diterima & Kode Pembayaran - Soulpict.u";
    $mail->isHTML(true);

    $mail->Body = "
        <p>Halo <b>{$data['nama_pelanggan']}</b>,</p>
        <p>Pesanan Anda telah <b>DITERIMA</b>. Berikut detail dan instruksi pembayaran:</p>

        <h4>📸 Detail Pemesanan:</h4>
        <ul>
            <li><b>Paket:</b> {$data['nama_layanan']}</li>
            <li><b>Tanggal:</b> {$data['tanggal_pemotretan']}</li>
            <li><b>Jam:</b> {$data['waktu_pemotretan']}</li>
            <li><b>Tempat:</b> {$data['tempat_pemotretan']}</li>
            <li><b>Total Tagihan:</b> Rp " . number_format($data['harga'], 0, ',', '.') . "</li>
        </ul>

        <h4>💳 Pembayaran melalui Virtual Account:</h4>
        <ul>
            <li><b>Bank:</b> $bank</li>
            <li><b>Nomor VA:</b> $kode_va</li>
            <li><b>ID Pesanan:</b> $id_tagihan</li>
        </ul>

        <p>Silakan lakukan pembayaran ke nomor VA di atas dalam waktu <b>24 jam</b>.</p>
        <p>Setelah berhasil, sistem akan mengirim notifikasi otomatis bahwa pembayaran Anda berhasil.</p>

        <p>Terima kasih telah memilih layanan Soulpict.u 💛</p>
    ";

    $mail->send();

    echo "<script>alert('Pesanan diterima & email tagihan berhasil dikirim.'); window.location='admin_data_pesanan.php';</script>";

} catch (Exception $e) {
    echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "'); window.location='admin_data_pesanan.php';</script>";
}
?>
