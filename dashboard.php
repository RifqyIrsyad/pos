<?php
session_start();
include 'config.php';

// Jika belum login, alihkan ke halaman login
if (!isset($_SESSION['admin_email'])) {
    header('Location: index.php');
    exit();
}

// Ambil jumlah barang
$sql_barang = "SELECT COUNT(*) AS jumlah_barang FROM products";
$result_barang = $conn->query($sql_barang);
$barangTersedia = ($result_barang->num_rows > 0) ? $result_barang->fetch_assoc()['jumlah_barang'] : 0;

// Ambil total stok
$sql_stok = "SELECT SUM(stock) AS total_stok FROM products";
$result_stok = $conn->query($sql_stok);
$stokBarang = ($result_stok->num_rows > 0) ? $result_stok->fetch_assoc()['total_stok'] : 0;

// Ambil jumlah kategori
$sql_kategori = "SELECT COUNT(*) AS jumlah_kategori FROM categories";
$result_kategori = $conn->query($sql_kategori);
$kategoriBarang = ($result_kategori->num_rows > 0) ? $result_kategori->fetch_assoc()['jumlah_kategori'] : 0;

// Ambil jumlah transaksi hari ini
$sql_transaksi = "SELECT COUNT(*) AS jumlah_transaksi FROM orders WHERE DATE(order_date) = CURDATE()";
$result_transaksi = $conn->query($sql_transaksi);
$transaksiHariIni = ($result_transaksi->num_rows > 0) ? $result_transaksi->fetch_assoc()['jumlah_transaksi'] : 0;

$conn->close();
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Nusantara Resto</title>
    <link rel="icon" href="logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .title {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        hr {
            margin-bottom: 40px;
            border-color: #e0e0e0;
        }

        .card-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .card {
            width: 22%;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            padding: 20px;
            font-size: 1.3rem;
            font-weight: bold;
            color: #fff;
            text-align: center;
        }

        .card-body {
            padding: 30px;
            font-size: 3rem;
            text-align: center;
            color: #333;
        }

        .card-footer {
            padding: 15px;
            background-color: #f7f7f7;
            text-align: center;
            font-weight: bold;
            color: #555;
        }

        .card.blue .card-header {
            background-color: #3498db;
        }

        .card.green .card-header {
            background-color: #2ecc71;
        }

        .card.orange .card-header {
            background-color: #e67e22;
        }

        .card.red .card-header {
            background-color: #e74c3c;
        }

        .welcome-message {
            font-size: 1.4rem;
            color: #2ecc71;
            margin-bottom: 30px;
            text-align: center;
            font-weight: bold;
        }

        .icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome-message">
            <p>Selamat datang, <?php echo $_SESSION['admin_email']; ?>!</p>
        </div>
        <h1 class="title">Dashboard Admin</h1>
        <hr>

        <div class="card-container">
            <div class="card blue">
                <div class="card-header">
                    <div class="icon"><i class="fas fa-desktop"></i></div>
                    Nama Barang
                </div>
                <div class="card-body">
                    <h2><?php echo $barangTersedia; ?></h2>
                </div>
                <div class="card-footer">
                    Jumlah Barang
                </div>
            </div>

            <div class="card green">
                <div class="card-header">
                    <div class="icon"><i class="fas fa-box"></i></div>
                    Stok Barang
                </div>
                <div class="card-body">
                    <h2><?php echo $stokBarang; ?></h2>
                </div>
                <div class="card-footer">
                    Jumlah Stok
                </div>
            </div>

            <div class="card orange">
                <div class="card-header">
                    <div class="icon"><i class="fas fa-tags"></i></div>
                    Kategori Barang
                </div>
                <div class="card-body">
                    <h2><?php echo $kategoriBarang; ?></h2>
                </div>
                <div class="card-footer">
                    Jumlah Kategori
                </div>
            </div>

            <div class="card red">
                <div class="card-header">
                    <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                    Transaksi Hari Ini
                </div>
                <div class="card-body">
                    <h2><?php echo $transaksiHariIni; ?></h2>
                </div>
                <div class="card-footer">
                    Jumlah Transaksi
                </div>
            </div>
        </div>
    </div>
</body>
</html>
