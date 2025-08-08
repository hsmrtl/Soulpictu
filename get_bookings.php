<?php
include 'koneksi.php';

header('Content-Type: application/json');

$data = [];

$query = mysqli_query($koneksi, "SELECT tanggal_pemotretan, COUNT(*) as total FROM pemesanan WHERE status_pesanan = 'Diterima' GROUP BY tanggal_pemotretan");

while ($row = mysqli_fetch_assoc($query)) {
    $data[$row['tanggal_pemotretan']] = (int)$row['total'];
}

echo json_encode($data);
?>
