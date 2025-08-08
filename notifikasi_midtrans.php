<?php
require_once 'koneksi.php';
require 'vendor/autoload.php';

use Midtrans\Notification;
use Midtrans\Config;

// Konfigurasi Midtrans
Config::$serverKey = 'SB-Mid-server-QSnOTzaRAbrFEdlFEJDT8Plu'; // ganti dengan server key-mu
Config::$isProduction = false;

$notif = new Notification();

// Ambil informasi dari notifikasi
$order_id       = $notif->order_id ?? '';
$transaction    = $notif->transaction_status ?? '';
$payment_type   = $notif->payment_type ?? '';
$fraud_status   = $notif->fraud_status ?? '';

// Cek validitas order ID
if ($order_id == '') {
    http_response_code(400);
    echo "Order ID tidak valid.";
    exit;
}

// Tentukan status pembayaran berdasarkan status transaksi Midtrans
$status_pembayaran = '';

if ($transaction == 'capture') {
    if ($payment_type == 'credit_card') {
        $status_pembayaran = ($fraud_status == 'challenge') ? 'challenge' : 'settlement';
    }
} elseif ($transaction == 'settlement') {
    $status_pembayaran = 'settlement';
} elseif ($transaction == 'pending') {
    $status_pembayaran = 'pending';
} elseif ($transaction == 'deny') {
    $status_pembayaran = 'deny';
} elseif ($transaction == 'expire') {
    $status_pembayaran = 'expire';
} elseif ($transaction == 'cancel') {
    $status_pembayaran = 'cancel';
}

// Update status di tabel `pembayaran` berdasarkan id_tagihan (order_id)
$query = "UPDATE pembayaran 
          SET status_pembayaran = '$status_pembayaran'
          WHERE id_tagihan = '$order_id'";

if (mysqli_query($koneksi, $query)) {
    http_response_code(200);
    echo "Notifikasi berhasil diproses.";
} else {
    http_response_code(500);
    echo "Gagal update status pembayaran: " . mysqli_error($koneksi);
}
