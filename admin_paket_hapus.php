<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan'); window.location='admin_paket.php';</script>";
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT foto FROM layanan WHERE id_layanan = '$id'");
$data = mysqli_fetch_assoc($query);

// Hapus file foto jika ada
if ($data['foto'] && file_exists('foto_layanan/' . $data['foto'])) {
    unlink('foto/' . $data['foto']);
}

// Hapus dari database
mysqli_query($koneksi, "DELETE FROM layanan WHERE id_layanan = '$id'");
echo "<script>alert('Paket berhasil dihapus'); window.location='admin_paket.php';</script>";
