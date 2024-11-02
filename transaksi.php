<?php
session_start();
include 'config.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_email'])) {
    header('Location: index.php');
    exit();
}

// Mengambil data dari database
$customers = mysqli_query($conn, "SELECT * FROM customers");
$categories = mysqli_query($conn, "SELECT * FROM categories");

// Filter produk berdasarkan kategori jika ada
$category_filter = "";
if (isset($_GET['category']) && $_GET['category'] != 'all') {
    $category_id = $_GET['category'];
    $category_filter = "AND category_id = '$category_id'";
}

$products = mysqli_query($conn, "SELECT * FROM products WHERE stock > 0 $category_filter"); // Menampilkan produk dengan stok lebih dari 0 dan sesuai kategori jika ada

// Proses transaksi
if (isset($_POST['submit_transaction'])) {
    $customer_id = $_POST['customer_id'];
    $total_price = $_POST['total_price'];
    $payment_amount = $_POST['payment_amount']; // Nominal pembayaran
    $change = $payment_amount - $total_price; // Uang kembalian

    if ($change < 0) {
        echo "<script>alert('Jumlah pembayaran tidak mencukupi.'); window.location='transaksi';</script>";
        exit();
    }

    // Simpan order di tabel orders
    $insert_order = mysqli_query($conn, "INSERT INTO orders (customer_id, total_price, payment_amount, change_amount, order_date) VALUES ('$customer_id', '$total_price', '$payment_amount', '$change', NOW())");
    $order_id = mysqli_insert_id($conn); // Mendapatkan order_id dari transaksi

    foreach ($_POST['product_id'] as $index => $product_id) {
        $quantity = $_POST['quantity'][$index];
        $price = $_POST['price'][$index];
        $total_item_price = $quantity * $price;

        // Ambil stok produk
        $product_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT stock FROM products WHERE id='$product_id'"));
        $stock = $product_data['stock'];

        // Cek apakah stok mencukupi
        if ($quantity > $stock) {
            echo "<script>alert('Stok produk tidak mencukupi. Transaksi dibatalkan.'); window.location='transaksi';</script>";
            exit();
        }

        // Simpan produk ke dalam tabel order_products
        $insert_order_product = mysqli_query($conn, "INSERT INTO order_products (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$total_item_price')");

        // Update stok produk
        $new_stock = $stock - $quantity;
        $update_stock = mysqli_query($conn, "UPDATE products SET stock='$new_stock' WHERE id='$product_id'");

        // Tambahkan total harga item ke total harga transaksi
        $total_price += $total_item_price;
    }

    echo "<script>alert('Transaksi berhasil! Kembalian: Rp " . number_format($change, 0, ',', '.') . "'); window.location='transaksi';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Nusantara Resto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Menghias kartu produk dengan tinggi setara */
        .product-card {
            cursor: pointer;
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
        .product-card img {
            height: 150px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }
        .product-card .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        /* Menghias nama produk dengan font bold */
        .product-card .card-title {
            font-weight: bold;
        }
        /* Menghias stok produk dengan warna merah, bold, dan underline */
        .product-card .stock {
            color: red;
            font-weight: bold;
            text-decoration: underline;
        }
        /* Menghias item dalam keranjang */
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .cart-list {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 10px;
            background-color: #f8f9fa;
        }
        /* Menghias tombol kategori agar oval dan di tengah */
        .category-buttons {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .category-button {
            border-radius: 50px;
            padding: 8px 20px;
            margin-right: 10px;
            margin-bottom: 10px;
            transition: background-color 0.3s, color 0.3s;
        }
        .category-button:hover {
            background-color: #0056b3;
            color: white;
        }
        .active-category {
            background-color: #007bff;
            color: white;
        }
        /* Sidebar transaksi tetap di atas */
        .transaction-sidebar {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 20px;
        }
        /* Hiasan untuk subtotal dan pembayaran */
        .form-group label {
            font-weight: bold;
        }
        #subtotal {
            font-size: 1.2em;
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>
<?php include "header.php"; ?>
    <div class="container-fluid mt-4">
        
        <!-- Tombol Kategori -->
        <div class="category-buttons">
            <a href="transaksi.php" class="btn btn-outline-primary category-button<?php echo !isset($_GET['category']) ? ' active-category' : ''; ?>">Tampilkan Semua</a>
            <?php mysqli_data_seek($categories, 0); // Reset pointer categories ?>
            <?php while ($category = mysqli_fetch_assoc($categories)) { ?>
                <a href="transaksi.php?category=<?php echo $category['id']; ?>" class="btn btn-outline-primary category-button<?php echo (isset($_GET['category']) && $_GET['category'] == $category['id']) ? ' active-category' : ''; ?>"><?php echo $category['name']; ?></a>
            <?php } ?>
        </div>

        <div class="row">
            <!-- Daftar Produk -->
            <div class="col-md-8">
                <div class="row" id="product-list">
                    <?php while ($product = mysqli_fetch_assoc($products)) { ?>
                        <div class="col-md-3 mb-3">
                            <div class="card product-card" onclick="addToCart(<?= $product['id']; ?>, '<?= $product['name']; ?>', <?= $product['price']; ?>, <?= $product['stock']; ?>)">
                                <img src="<?= $product['image']; ?>" class="card-img-top" alt="<?= $product['name']; ?>" onerror="this.onerror=null; this.src='images/default.jpg';">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $product['name']; ?></h5>
                                    <p class="card-text">Rp <?= number_format($product['price'], 0, ',', '.'); ?></p>
                                    <p class="stock">Stok: <?= $product['stock']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Sidebar Keranjang dan Checkout -->
            <div class="col-md-4">
                <div class="transaction-sidebar">
                    <h4>Keranjang</h4>
                    <form method="POST" action="transaksi">
                        <div class="form-group">
                            <label for="customer_id">Pilih Pelanggan</label>
                            <select name="customer_id" id="customer_id" class="form-control" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                <?php mysqli_data_seek($customers, 0); // Reset pointer customers ?>
                                <?php while ($customer = mysqli_fetch_assoc($customers)) { ?>
                                    <option value="<?= $customer['id']; ?>"><?= $customer['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Daftar Produk di Keranjang -->
                        <div class="cart-list" id="cart-list">
                            <!-- Produk yang ditambahkan akan muncul di sini -->
                        </div>

                        <div class="form-group">
                            <label>Subtotal: Rp <span id="subtotal">0</span></label>
                            <input type="hidden" name="total_price" id="total_price" value="0">
                        </div>

                        <!-- Input Pembayaran -->
                        <div class="form-group">
                            <label for="payment_amount">Jumlah Pembayaran</label>
                            <input type="number" name="payment_amount" id="payment_amount" class="form-control" required>
                        </div>

                        <button type="submit" name="submit_transaction" class="btn btn-success btn-block">Proses Transaksi</button>
                        <button type="button" class="btn btn-danger btn-block mt-2" onclick="clearCart()">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let cart = [];
        let subtotal = 0;

        function addToCart(id, name, price, stock) {
            let quantity = prompt(`Masukkan jumlah untuk ${name} (Stok: ${stock}):`);
            quantity = parseInt(quantity);

            if (isNaN(quantity) || quantity <= 0 || quantity > stock) {
                alert('Jumlah tidak valid atau stok tidak mencukupi.');
                return;
            }

            const existingProduct = cart.find(item => item.id === id);

            if (existingProduct) {
                existingProduct.quantity += quantity;
            } else {
                cart.push({ id, name, price, quantity, stock });
            }

            subtotal += quantity * price;
            document.getElementById('subtotal').textContent = subtotal.toLocaleString('id-ID');
            document.getElementById('total_price').value = subtotal;

            renderCart();
        }

        function renderCart() {
            const cartList = document.getElementById('cart-list');
            cartList.innerHTML = '';

            cart.forEach((item, index) => {
                cartList.innerHTML += `
                    <div class="cart-item">
                        <span>${item.name} (x${item.quantity})</span>
                        <span>Rp ${(item.quantity * item.price).toLocaleString('id-ID')}</span>
                        <input type="hidden" name="product_id[]" value="${item.id}">
                        <input type="hidden" name="quantity[]" value="${item.quantity}">
                        <input type="hidden" name="price[]" value="${item.price}">
                        <button class="btn btn-danger btn-sm" onclick="removeFromCart(${index})">X</button>
                    </div>
                `;
            });
        }

        function removeFromCart(index) {
            const item = cart[index];
            subtotal -= item.quantity * item.price;
            cart.splice(index, 1);
            document.getElementById('subtotal').textContent = subtotal.toLocaleString('id-ID');
            document.getElementById('total_price').value = subtotal;

            renderCart();
        }

        function clearCart() {
            cart = [];
            subtotal = 0;
            document.getElementById('subtotal').textContent = subtotal.toLocaleString('id-ID');
            document.getElementById('total_price').value = subtotal;
            renderCart();
        }
    </script>
</body>
</html>
