<?php
// Mengubah warna teks menjadi hitam
echo '<style>body { color: black; }</style>';
session_start();
include 'config.php';

// Proses login ketika form disubmit
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

    // Query untuk mencari user dengan email dan password yang cocok
    $query = "SELECT * FROM admins WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Simpan email admin ke sesi
        $_SESSION['admin_email'] = $email;
        header('Location: dashboard.php'); // Alihkan ke dashboard jika login berhasil
        exit();
    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Nusantara Resto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 50px;
        }
        h2 {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .form-control {
            border-radius: 20px;
        }
        .btn-primary {
            border-radius: 20px;
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 150px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="logo.jpg" alt="Nusantara Resto Logo">
        </div>
        <h2 class="text-center">Login Admin Nusantara Resto</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger">
                        <?= $error; ?>
                    </div>
                <?php } ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="Masukkan email Anda">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-lock"></i> Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Masukkan password Anda">
                    </div>
                    <button type="submit" name="login" class="btn btn-primary btn-block">Masuk</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
