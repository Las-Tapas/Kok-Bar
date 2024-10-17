<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kitchen_display";
$oldOrdersDb = "old_orders_db"; 


$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['orderId'];

    // First, fetch the order details before deletion
    $orderQuery = "SELECT * FROM orders WHERE id = ?";
    $stmt = $conn->prepare($orderQuery);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch order details
        $order = $result->fetch_assoc();

        // Create a connection to the old orders database
        $oldOrdersConn = new mysqli($servername, $username, $password, $oldOrdersDb);

        // Check connection to old orders database
        if ($oldOrdersConn->connect_error) {
            die("Connection to old orders database failed: " . $oldOrdersConn->connect_error);
        }

        // Insert the deleted order into the old orders table
        $insertOldOrderSql = "INSERT INTO old_orders (id, table_number, items, completed, order_time) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $oldOrdersConn->prepare($insertOldOrderSql);
        $insertStmt->bind_param("iisss", $order['id'], $order['table_number'], $order['items'], $order['completed'], $order['order_time']);
        $insertStmt->execute();

        if ($insertStmt->affected_rows > 0) {
            // Now, delete the order from the original table
            $deleteSql = "DELETE FROM orders WHERE id = ?";
            $deleteStmt = $conn->prepare($deleteSql);
            $deleteStmt->bind_param("i", $orderId);
            $deleteStmt->execute();

            if ($deleteStmt->affected_rows > 0) {
                echo "Order removed successfully.";
            } else {
                echo "Error removing order or order not found.";
            }
            $deleteStmt->close();
        } else {
            echo "Error moving order to old orders database.";
        }

        // Close the connection to old orders database
        $insertStmt->close();
        $oldOrdersConn->close();
    } else {
        echo "Order not found.";
    }

    $stmt->close();
}

$conn->close();
?>
