<?php
require_once './config/database.php'; // Include the Database class

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $database = new Database(); // Create an instance of the Database class
        $database->connect(); // Connect to the database

        // Retrieve form data
        $sku = $_POST['sku'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $amount = $_POST['amount'];
        $productType = $_POST['productType'];
        $weight = $_POST['weight'];

        // Sanitize inputs (prevent SQL injection)
        $sku = $database->connection->real_escape_string($sku);
        $name = $database->connection->real_escape_string($name);
        $price = $database->connection->real_escape_string($price);
        $amount = $database->connection->real_escape_string($amount);
        $productType = $database->connection->real_escape_string($productType);
        $weight = $database->connection->real_escape_string($weight);

        // Construct and execute the SQL query for products table
        $queryProducts = "INSERT INTO products (SKU, name, price, amount, type) 
                          VALUES ('$sku', '$name', '$price', '$amount', '$productType')";

        if ($database->query($queryProducts)) {
            // Get the ID of the inserted product
            $productId = $database->connection->insert_id;

            // Construct and execute the SQL query for books table
            $queryBooks = "INSERT INTO books (product_id, weight) 
                           VALUES ('$productId', '$weight')";

            if ($database->query($queryBooks)) {
                echo "Product added successfully!";
            } else {
                echo "Error adding product to books table: " . $database->connection->error;
            }
        } else {
            echo "Error adding product: " . $database->connection->error;
        }

        $database->disconnect(); // Disconnect from the database
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo "Invalid request!";
}

?>
