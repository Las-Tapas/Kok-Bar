<?php

$servername = "localhost";  // Change if your MySQL server is hosted elsewhere
$username = "root";  // Replace with your MySQL username
$password = "";  // Replace with your MySQL password
$dbname = "old_orders_db";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch orders from the old_orders table
$sql = "SELECT id, table_number, items, completed, order_time, deleted_at FROM old_orders";
$result = $conn->query($sql);

// Check if there are results and fetch them
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Table Number: " . $row["table_number"] . " - Items: " . $row["items"] . " - Completed: " . $row["completed"] . " - Order Time: " . $row["order_time"] . " - Deleted At: " . $row["deleted_at"] . "<br>";
    }
} else {
    echo "No old orders found.";
}

// Close the connection
$conn->close();
?>

