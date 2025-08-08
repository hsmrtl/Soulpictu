<?php
$token = $_GET['token'];
?>
<html>
  <head>
    <title>Pembayaran</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-XXXXX"></script>
  </head>
  <body>
    <button id="pay-button">Bayar Sekarang</button>

    <script>
      document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('<?= $token ?>', {
          onSuccess: function(result){
            alert("Pembayaran berhasil!");
            window.location = "sukses.php";
          },
          onPending: function(result){
            alert("Menunggu pembayaran.");
          },
          onError: function(result){
            alert("Pembayaran gagal.");
          }
        });
      });
    </script>
  </body>
</html>
