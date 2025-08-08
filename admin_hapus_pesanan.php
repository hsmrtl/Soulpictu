<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "DELETE FROM pemesanan WHERE id_pemesanan = '$id'");

    if ($query) {
        echo "<script>alert('Pesanan berhasil dihapus'); window.location='admin_data_pesanan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data'); window.location='admin_data_pesanan.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan'); window.location='admin_data_pesanan.php';</script>";
}
?>
