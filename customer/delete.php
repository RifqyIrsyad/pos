<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM customers WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute(['id' => $id])) {
        echo "Customer deleted successfully!";
    } else {
        echo "Failed to delete customer.";
    }
}
?>
