<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare('DELETE FROM admins WHERE id = ?');
    $stmt->execute([$id]);

    header('Location: index.php');
}
?>
