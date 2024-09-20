<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kitchen_display";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['orderId'];

    // Delete order
    $sql = "DELETE FROM orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Order removed successfully.";
    } else {
        echo "Error removing order.";
    }

    $stmt->close();
}

$conn->close();
?>