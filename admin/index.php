<?php
session_start();

require 'config.php';

$stmt = $pdo->query('SELECT * FROM admins');
$data = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Nusantara Resto</title>
    <link rel="icon" href="../logo.jpg" type="image/x-icon">
</head>
<body>
    <div class="max-w-2xl mx-auto mt-10">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl">Admin List</h1>
            <a href="../dashboard.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Kembali</a>
            <a href="create.php" class="bg-blue-500 text-white px-4 py-2 rounded">Add New</a>
        </div>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-gray-200">ID</th>
                    <th class="py-2 px-4 bg-gray-200">Email</th>
                    <th class="py-2 px-4 bg-gray-200">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?= $row['id'] ?></td>
                        <td class="py-2 px-4 border-b"><?= $row['email'] ?></td>
                        <td class="py-2 px-4 border-b">
                            <a href="update.php?id=<?= $row['id'] ?>" class="text-green-500">Edit</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" class="text-red-500 ml-2" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
