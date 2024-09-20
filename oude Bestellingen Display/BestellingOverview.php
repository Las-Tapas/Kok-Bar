<?php
// Database connection details
$servername = "localhost";  // Change if your MySQL server is hosted elsewhere
$username = "root";  // Replace with your MySQL username
$password = "";  // Replace with your MySQL password
$dbname = "las_tapas";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch orders from the database
$sql = "SELECT bestelnummer, tafelnummer, gerechten, status, aangemaakt_op FROM bestellingen";
$result = $conn->query($sql);
?>
