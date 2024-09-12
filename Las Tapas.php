<?php
include 'BestellingOverview.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management - Las Tapas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welkom bij Las Tapas - Order Management Systeem</h1>
    </header>

    <nav>
        <ul>
            <li><a href="#">Bestellingen Overzicht</a></li>
            <li><a href="#">Nieuwe Bestelling</a></li>
            <li><a href="#">Menu Beheren</a></li>
            <li><a href="#">Uitloggen</a></li>
        </ul>
    </nav>

    <main>
        <section class="orders-section">
            <h2>Bestellingen</h2>
            <table>
                <thead>
                    <tr>
                        <th>Bestelnummer</th>
                        <th>Tafelnummer</th>
                        <th>Gerechten</th>
                        <th>Status</th>
                        <th>Aangemaakt op</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $status = htmlspecialchars($row['status']);
                            $buttonText = ($status === 'Gereed') ? 'Verwijder Bestelling' : 'Markeer als Gereed';
                            $buttonAction = ($status === 'Gereed') ? 'verwijderBestelling(this)' : 'markeerAlsGereed(this)';
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['bestelnummer']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['tafelnummer']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['gerechten']) . "</td>";
                            echo "<td class='status'>" . $status . "</td>";
                            echo "<td>" . htmlspecialchars($row['aangemaakt_op']) . "</td>";
                            echo "<td><button onclick='$buttonAction'>$buttonText</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Geen bestellingen gevonden</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Las Tapas Restaurant</p>
    </footer>

    <script>
        // Markeer bestelling als gereed
        function markeerAlsGereed(button) {
            const row = button.closest('tr');
            row.querySelector('.status').textContent = 'Gereed';
            button.textContent = 'Verwijder Bestelling';
            button.setAttribute('onclick', 'verwijderBestelling(this)');
        }

        // Verwijder bestelling
        function verwijderBestelling(button) {
            const row = button.closest('tr');
            row.remove();
        }
    </script>
</body>
</html>
