<?php
include 'koneksi.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Validasi dari Midtrans
$signature_key = $data['signature_key'];
$order_id      = $data['order_id'];
$status_code   = $data['status_code'];
$gross_amount  = $data['gross_amount'];

$server_key = 'YOUR_SERVER_KEY';
$input = $order_id . $status_code . $gross_amount . $server_key;
$expected_signature = hash('sha512', $input);

if ($signature_key !== $expected_signature) {
    http_response_code(403);
    exit("Invalid signature");
}

// Dapatkan status pembayaran
$transaction_status = $data['transaction_status'];
$fraud_status = $data['fraud_status'];

// Ambil ID pemesanan
$order_parts = explode("-", $order_id);
$id_pemesanan = $order_parts[1];

// Ubah status pembayaran di database
if ($transaction_status == 'settlement' || $transaction_status == 'capture') {
    $status = 'success';
} elseif ($transaction_status == 'pending') {
    $status = 'pending';
} else {
    $status = 'failed';
}

mysqli_query($koneksi, "UPDATE pembayaran SET status_pembayaran = '$status' WHERE id_pemesanan = '$id_pemesanan'");

// Jika sukses, kirim email konfirmasi ke pelanggan
if ($status == 'success') {
    $q = mysqli_query($koneksi, "SELECT p.*, l.nama_layanan, b.status_pembayaran 
                                 FROM pemesanan p
                                 JOIN layanan l ON p.id_layanan = l.id_layanan
                                 JOIN pembayaran b ON p.id_pemesanan = b.id_pemesanan
                                 WHERE p.id_pemesanan = '$id_pemesanan'");
    $d = mysqli_fetch_assoc($q);

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'thesoulpictureofu@gmail.com';
        $mail->Password   = 'siybbccvixskptln';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('thesoulpictureofu@gmail.com', 'Soulpict.u');
        $mail->addAddress($d['email'], $d['nama_pelanggan']);
        $mail->isHTML(true);
        $mail->Subject = "Pembayaran Berhasil - Soulpict.u";

        $mail->Body = "
            <p>Halo <b>{$d['nama_pelanggan']}</b>,</p>
            <p>Kami telah menerima pembayaran Anda untuk pesanan fotografi berikut:</p>
            <ul>
                <li><b>Paket:</b> {$d['nama_layanan']}</li>
                <li><b>Tanggal Pemotretan:</b> {$d['tanggal_pemotretan']}</li>
                <li><b>Status Pembayaran:</b> {$d['status_pembayaran']}</li>
            </ul>
            <p>Terima kasih telah membayar. Kami siap mengabadikan momen Anda!</p>
        ";

        $mail->send();
    } catch (Exception $e) {
        // Gagal kirim email
    }
}

http_response_code(200);
echo "OK";
?>
