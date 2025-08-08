<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Escape input untuk mencegah SQL injection
    $nama_pelanggan      = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
    $id_layanan          = mysqli_real_escape_string($koneksi, $_POST['id_layanan']);
    $tanggal_pemotretan  = mysqli_real_escape_string($koneksi, $_POST['tanggal_pemotretan']);
    $tempat_pemotretan   = mysqli_real_escape_string($koneksi, $_POST['tempat_pemotretan']);
    $waktu_pemotretan    = mysqli_real_escape_string($koneksi, $_POST['waktu_pemotretan']);
    $no_hp               = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email               = mysqli_real_escape_string($koneksi, $_POST['email']);

    $query = "INSERT INTO pemesanan 
                (nama_pelanggan, id_layanan, tanggal_pemotretan, tempat_pemotretan, waktu_pemotretan, no_hp, email)
              VALUES 
                ('$nama_pelanggan', '$id_layanan', '$tanggal_pemotretan', '$tempat_pemotretan', '$waktu_pemotretan', '$no_hp', '$email')";

    if (mysqli_query($koneksi, $query)) {
        $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

        if ($isAdmin) {
            echo "<script>alert('Pemesanan berhasil ditambahkan oleh admin!'); window.location='admin_form.php';</script>";
        } else {
            echo "<script>alert('Pemesanan berhasil dikirim!'); window.location='klien_form.php';</script>";
        }
    } else {
        echo "Gagal menyimpan: " . mysqli_error($koneksi);
    }
}
?>
