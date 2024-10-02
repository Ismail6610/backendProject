<?php
include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>header</header>
    <main>main
        <?php 
        $sql = "SELECT id, product, description, price, image FROM products";
        $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<p>ID: " . $row['id'] . "</p>";
                echo "<p>Product: " . $row['product'] . "</p>";
                echo "<p>Description: " . $row['description'] . "</p>";
                echo "<p>Price: $" . $row['price'] . "</p>";
                echo "<p><img src='" . $row['image'] . "' alt='" . $row['product'] . "'></p>";
                echo "</div>";
            }
        }else{
            echo "<p>No products found.</p>";
        }
        $conn->close();
        ?>
    </main>
    <footer>footer</footer>
</body>
</html>