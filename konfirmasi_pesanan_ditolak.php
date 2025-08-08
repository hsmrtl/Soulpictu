<?php
include 'koneksi.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

if (!isset($_GET['id'])) {
    header("Location: admin_data_pesanan.php");
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alasan = mysqli_real_escape_string($koneksi, $_POST['alasan']);

    // Ambil data pemesanan
    $query = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_pemesanan = '$id'");
    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan'); window.location='admin_data_pesanan.php';</script>";
        exit;
    }

    // Update status menjadi 'Ditolak'
    mysqli_query($koneksi, "UPDATE pemesanan SET status_pesanan = 'Ditolak' WHERE id_pemesanan = '$id'");

    // Kirim email penolakan
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'thesoulpictureofu@gmail.com';     
        $mail->Password   = 'siybbccvixskptln';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('your_email@gmail.com', 'Soulpict.u');
        $mail->addAddress($data['email'], $data['nama_pelanggan']);

        $mail->Subject = "Pesanan Anda Ditolak - Soulpict.u";
        $mail->isHTML(true);
        $mail->Body = "
            <p>Halo <b>{$data['nama_pelanggan']}</b>,</p>
            <p>Mohon maaf, pesanan Anda pada tanggal <b>{$data['tanggal_pemotretan']}</b> <b>DITOLAK</b>.</p>
            <p>Alasan penolakan: <i>$alasan</i></p>
            <p>Silakan hubungi admin jika ingin memilih tanggal atau paket lain.</p>
        ";

        $mail->send();
        echo "<script>alert('Pesanan ditolak dan email telah dikirim.'); window.location='admin_data_pesanan.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Pesanan ditolak, tetapi email gagal dikirim.'); window.location='admin_data_pesanan.php';</script>";
    }
} else {
    // Tampilkan form input alasan penolakan
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Konfirmasi Penolakan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
    <div class="container my-5">
        <h4 class="mb-4">Alasan Penolakan Pemesanan</h4>
        <form method="POST">
            <div class="mb-3">
                <label for="alasan" class="form-label">Tulis alasan penolakan</label>
                <textarea name="alasan" id="alasan" rows="4" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
            <a href="admin_data_pesanan.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    </body>
    </html>
    <?php
}
?>
