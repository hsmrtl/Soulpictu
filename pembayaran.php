<?php
include 'koneksi.php';

if (!isset($_GET['id_pemesanan'])) {
    echo "ID pemesanan tidak ditemukan.";
    exit;
}

$id_pemesanan = $_GET['id_pemesanan'];

// Ambil data pesanan
$query = mysqli_query($koneksi, "SELECT p.*, l.nama_layanan, l.harga, b.kode_va
                                 FROM pemesanan p
                                 JOIN layanan l ON p.id_layanan = l.id_layanan
                                 JOIN pembayaran b ON p.id_pemesanan = b.id_pemesanan
                                 WHERE p.id_pemesanan = '$id_pemesanan'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data pemesanan tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Soulpict.u</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>
</head>
<body>
    <h2>Halo, <?= $data['nama_pelanggan'] ?></h2>
    <p>Anda akan membayar pesanan berikut:</p>
    <ul>
        <li><b>Paket:</b> <?= $data['nama_layanan'] ?></li>
        <li><b>Tanggal Pemotretan:</b> <?= $data['tanggal_pemotretan'] ?></li>
        <li><b>Harga:</b> Rp <?= number_format($data['harga'], 0, ',', '.') ?></li>
    </ul>

    <button id="pay-button" style="padding: 10px 20px; background: green; color: white; border: none; border-radius: 5px;">
        Bayar Sekarang
    </button>

    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function () {
            snap.pay("<?= $data['kode_va'] ?>", {
                onSuccess: function(result){
                    alert("Pembayaran sukses!");
                    window.location.href = "pembayaran_sukses.php?id=<?= $id_pemesanan ?>";
                },
                onPending: function(result){
                    alert("Menunggu pembayaran selesai.");
                },
                onError: function(result){
                    alert("Pembayaran gagal!");
                }
            });
        });
    </script>
</body>
</html>
