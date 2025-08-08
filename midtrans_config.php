<?php
require_once 'vendor/autoload.php'; // pastikan path benar

\Midtrans\Config::$serverKey = 'SB-Mid-server-QSnOTzaRAbrFEdlFEJDT8Plu'; // ganti dengan server key dari dashboard sandbox
\Midtrans\Config::$isProduction = false; // false untuk sandbox
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;
?>
