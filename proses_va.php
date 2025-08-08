<?php
require_once 'vendor/autoload.php';
include 'koneksi.php';

\Midtrans\Config::$serverKey = 'SERVER_KEY_ANDA';
\Midtrans\Config::$isProduction = false; // ubah ke true saat live
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

$id_pemesanan = $_GET['id']; // atau dari POST
$query = mysqli_query($koneksi, "SELECT p.*, l.nama_layanan, l.harga FROM pemesanan p JOIN layanan l ON p.id_layanan = l.id_layanan WHERE p.id_pemesanan = '$id_pemesanan'");
$data = mysqli_fetch_assoc($query);

// Data untuk Midtrans
$transaction_details = [
    'order_id' => 'SOULPICT-' . time(),
    'gross_amount' => $data['harga'],
];

$item_details = [
    [
        'id' => $data['id_layanan'],
        'price' => $data['harga'],
        'quantity' => 1,
        'name' => $data['nama_layanan'],
    ]
];

$customer_details = [
    'first_name' => $data['nama_pelanggan'],
    'email' => $data['email'],
    'phone' => $data['no_hp'],
];

$params = [
    'transaction_details' => $transaction_details,
    'item_details' => $item_details,
    'customer_details' => $customer_details,
];

// Buat transaksi VA
$snapToken = \Midtrans\Snap::getSnapToken($params);

// Kirim Snap Token ke halaman pembayaran
echo "<script>window.location.href = 'pembayaran_va.php?token=$snapToken&id=$id_pemesanan';</script>";
