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
$sql = "SELECT id, table_number, items, order_time, deleted_at FROM old_orders";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Old Orders - Las Tapas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="LT.php">Bestellingen</a></li>
            <li><a href="Oude Bestellingen.php">Oude Bestelling</a></li>
            <li><a href="#">Menu Beheren</a></li>
            <li><a href="#">Uitloggen</a></li>
        </ul>
    </nav>

    <main>
        <section class="orders-section">
            <h2>Oude Bestellingen</h2>
            <table>
                <thead>
                    <tr>
                        
                        <th>ID</th>
                        <th>Tafelnummer</th>
                        <th>Gerechten</th>
                        <th>Voltooid</th>
                        <th>Besteld op</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are results and fetch them
                    if ($result && $result->num_rows > 0) {
                        // Output data for each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['table_number']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['items']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['order_time']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['deleted_at']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Geen oude bestellingen gevonden.</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
