<?php
require_once 'pembayaran_midtrans.php'; // sesuaikan path ke vendor Midtrans
include 'koneksi.php';

\Midtrans\Config::$serverKey = 'YOUR_SERVER_KEY';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

if (isset($_GET['id_pemesanan'])) {
    $id_pemesanan = $_GET['id_pemesanan'];

    // Ambil data pemesanan dan layanan
    $query = mysqli_query($koneksi, "SELECT p.*, l.nama_layanan, l.harga 
                                     FROM pemesanan p 
                                     JOIN layanan l ON p.id_layanan = l.id_layanan 
                                     WHERE p.id_pemesanan = '$id_pemesanan'");
    $data = mysqli_fetch_assoc($query);

    $order_id = "SOULPICTU-" . $id_pemesanan . "-" . time();

    $params = array(
        'transaction_details' => array(
            'order_id' => $order_id,
            'gross_amount' => (int) $data['harga']
        ),
        'customer_details' => array(
            'first_name' => $data['nama'],
            'email' => $data['email'],
            'phone' => $data['telepon'],
        )
    );

    $snapToken = \Midtrans\Snap::getSnapToken($params);

    // Simpan data pembayaran ke database
    mysqli_query($koneksi, "INSERT INTO pembayaran 
        (id_pemesanan, kode_va, id_tagihan, status_pembayaran) 
        VALUES ('$id_pemesanan', '$snapToken', '$order_id', 'pending')");

    echo $snapToken;
} else {
    echo "ID pemesanan tidak ditemukan.";
}
?>
