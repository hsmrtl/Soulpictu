<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-XXXXX"></script>

<button id="pay-button" class="btn btn-success">Bayar Sekarang</button>

<script>
document.getElementById('pay-button').addEventListener('click', function () {
  fetch('snap_token.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({
      nama: '<?= $nama ?>',
      email: '<?= $email ?>',
      telepon: '<?= $telepon ?>',
      harga: <?= $harga ?> // Harga harus diambil dari server
    })
  })
  .then(response => response.text())
  .then(snapToken => {
    window.snap.pay(snapToken, {
      onSuccess: function(result){
        window.location.href = 'berhasil.php';
      },
      onPending: function(result){
        window.location.href = 'menunggu.php';
      },
      onError: function(result){
        alert("Pembayaran gagal.");
      }
    });
  });
});
</script>
