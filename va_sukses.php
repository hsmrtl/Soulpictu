<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($koneksi, "UPDATE pemesanan SET status_pembayaran = 'Lunas' WHERE id_pemesanan = '$id'");
echo "<script>alert('Pembayaran berhasil!'); window.location='index.php';</script>";
