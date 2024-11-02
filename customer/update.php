<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM customers WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $customer = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $alamat = $_POST['alamat'];

        $sql = "UPDATE customers SET name = :name, email = :email, phone = :phone, alamat = :alamat WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'alamat' => $alamat, 'id' => $id])) {
            echo "<div class='container mx-auto mt-10 text-green-600'>Customer updated successfully!</div>";
        } else {
            echo "<div class='container mx-auto mt-10 text-red-600'>Failed to update customer.</div>";
        }
    }
} else {
    echo "<div class='container mx-auto mt-10 text-red-600'>No customer ID provided.</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nusantara Resto</title>
    <link rel="icon" href="../../logo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h2 class="text-3xl font-bold mb-5">Update Customer</h2>
        <form action="update?id=<?= $customer['id'] ?>" method="POST" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name" value="<?= $customer['name'] ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="<?= $customer['email'] ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" id="phone" value="<?= $customer['phone'] ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700">Address</label>
                <textarea name="alamat" id="alamat" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?= $customer['alamat'] ?></textarea>
            </div>
            <div>
                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Update</button>
                <a href="index.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
