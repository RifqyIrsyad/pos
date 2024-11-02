<?php
require 'config.php';

$customers = $pdo->query("SELECT * FROM customers")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nusantara Resto</title>
    <link rel="icon" href="../logo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h2 class="text-3xl font-bold mb-5">Customer List</h2>
        <a href="../dashboard.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Kembali</a>
        <a href="create.php" class="mb-5 inline-block text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded">Add New Customer</a>
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border">Nama</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Phone</th>
                    <th class="py-2 px-4 border">Alamat</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border"><?= htmlspecialchars($customer['name']) ?></td>
                        <td class="py-2 px-4 border"><?= htmlspecialchars($customer['email']) ?></td>
                        <td class="py-2 px-4 border"><?= htmlspecialchars($customer['phone']) ?></td>
                        <td class="py-2 px-4 border"><?= htmlspecialchars($customer['alamat']) ?></td>
                        <td class="py-2 px-4 border">
                            <a href="update.php?id=<?= $customer['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <a href="delete.php?id=<?= $customer['id'] ?>" class="text-red-600 hover:text-red-900 ml-2" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
