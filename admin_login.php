<?php
session_start();
include 'koneksi.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];
        header("Location: admin_data_pesanan.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Soulpict.u</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    body {
      background: linear-gradient(to right, #dceeff, #f3f8ff);
      font-family: 'Poppins', serif;
    }

    .card {
      border-radius: 16px;
      border: none;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    h4 {
      font-weight: 600;
      color: #333;
    }

    label {
      font-weight: 200;
    }

    .form-control {
      border-radius: 10px;
      font-size: 0.9rem;
    }

    .btn-primary {
      border-radius: 10px;
      font-weight: 500;
      background-color: #0d6efd;
      border: none;
    }

    .btn-primary:hover {
      background-color: #084fc7;
    }

    .alert {
      border-radius: 10px;
      font-size: 0.9rem;
    }
  </style>
</head>

<body class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="card p-4" style="width: 300px;">
    <h4 class="text-center mb-3">Login Admin Soulpict.u</h4>
    <?php if ($error): ?>
      <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
      <div class="mb-3">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</body>
</html>
