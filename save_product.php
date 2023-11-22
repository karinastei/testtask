<?php
require_once './config/database.php'; // Include the Database class
require_once './model/Product.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $database = new Database(); // Create an instance of the Database class
        $database->connect(); // Connect to the database

        // Retrieve form data
        // ???this could be a function?
        $SKU = $_POST['sku'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $amount = $_POST['amount'];
        $productType = $_POST['productType'];

        echo "<pre>";
        print_r($_POST);
        echo "<pre>";
        // Sanitize inputs (prevent SQL injection)
        // ???this could be a function?
        $SKU = $database->connection->real_escape_string($SKU);
        $name = $database->connection->real_escape_string($name);
        $price = $database->connection->real_escape_string($price);
        $amount = $database->connection->real_escape_string($amount);
        $productType = $database->connection->real_escape_string($productType);

        // Initialize variables for SQL query construction
        $typeColumns = [];
        $typeValues = [];

        // Process the received fields dynamically for the specific product type
        foreach ($_POST as $fieldName => $fieldValue) {
            if ($fieldName !== 'productType') {
                $columnName = $database->connection->real_escape_string($fieldName);
                $fieldValue = $database->connection->real_escape_string($fieldValue);

                // Constructing columns and values for the specific product type
                $typeColumns[] = $columnName;
                $typeValues[] = "'$fieldValue'";
            }
        }

        // Construct and execute the SQL query for products table
        $queryProducts = "INSERT INTO products (SKU, name, price, amount, type) 
                          VALUES ('$SKU', '$name', '$price', '$amount', '$productType')";
        echo "<pre>";
        print_r($queryProducts);
        echo "</pre>";
        if ($database->query($queryProducts)) {
            // Get the ID of the inserted product
            $productId = $database->connection->insert_id;

            // Construct and execute the SQL query for the specific product type table
            // Construct and execute the SQL query for the specific product type table
            $typeTableName = strtolower($productType); // Assuming table names are plural

// Exclude common fields and only include DVD-specific fields for the query
            $dvdSpecificColumns = array_diff($typeColumns, ['sku', 'name', 'price', 'amount']);
            $dvdSpecificValues = array_diff($typeValues, ["'$SKU'", "'$name'", "'$price'", "'$amount'"]);

            $typeColumnsString = implode(', ', $dvdSpecificColumns);
            $typeValuesString = implode(', ', $dvdSpecificValues);

            $querySpecificProduct = "INSERT INTO $typeTableName (product_id, $typeColumnsString) 
                         VALUES ('$productId', $typeValuesString)";

            echo "<pre>";
            print_r($querySpecificProduct);
            echo "</pre>";

            if ($database->query($querySpecificProduct)) {
                echo "Product added successfully!";
            } else {
                echo "Error adding product to $typeTableName table: " . $database->connection->error;
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
