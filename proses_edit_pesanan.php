<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_pemesanan'];
    $nama = $_POST['nama_pelanggan'];
    $id_layanan = $_POST['id_layanan'];
    $tanggal = $_POST['tanggal_pemotretan'];
    $tempat = $_POST['tempat_pemotretan'];
    $waktu = $_POST['waktu_pemotretan'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];

    $query = "UPDATE pemesanan SET 
        nama_pelanggan = '$nama',
        id_layanan = '$id_layanan',
        tanggal_pemotretan = '$tanggal',
        tempat_pemotretan = '$tempat',
        waktu_pemotretan = '$waktu',
        no_hp = '$no_hp',
        email = '$email'
        WHERE id_pemesanan = '$id'
    ";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil diperbarui'); window.location='admin_data_pesanan.php';</script>";
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
} else {
    echo "Metode tidak diizinkan.";
}
?>
