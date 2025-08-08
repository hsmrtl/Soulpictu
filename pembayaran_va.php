<?php
$token = $_GET['token'];
$id = $_GET['id'];
?>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="CLIENT_KEY_ANDA"></script>
<script>
window.snap.pay("<?= $token ?>", {
    onSuccess: function(result){
        window.location.href = "va_sukses.php?id=<?= $id ?>";
    },
    onPending: function(result){
        alert("Transaksi sedang diproses.");
    },
    onError: function(result){
        alert("Terjadi kesalahan!");
    }
});
</script>
