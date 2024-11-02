<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('SELECT * FROM admins WHERE id = ?');
    $stmt->execute([$id]);
    $data = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? md5($_POST['password']) : $data['password'];

    $stmt = $pdo->prepare('UPDATE admins SET email = ?, password = ? WHERE id = ?');
    $stmt->execute([$email, $password, $id]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Nusantara Resto</title>
    <link rel="icon" href="../../logo.jpg" type="image/x-icon">
</head>
<body>
    <div class="max-w-md mx-auto mt-10">
        <form action="update" method="post" class="bg-white p-6 rounded shadow">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-2 px-4 py-2 w-full border rounded" value="<?= $data['email'] ?>" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password (leave blank to keep current)</label>
                <input type="password" name="password" id="password" class="mt-2 px-4 py-2 w-full border rounded">
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
            <a href="index.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
        </form>
    </div>
</body>
</html>
