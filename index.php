<?php
// Include or require the Database class file
require_once './config/database.php'; // Adjust the path accordingly
//require_once './view/product.php';
//see fail võiks ainult vaade olla, võtab juba valmis toodete vaate, database connection

// Create an instance of the Database class
$database = new Database();

// Connect to the database
$database->connect();

$product_id = 1; // Assuming you want the product with ID 1
$query = "SELECT * FROM products WHERE id = $product_id";

// Execute the query using the Database class
$result = $database->query($query);

// Check if the query was successful
if ($result) {
    $row = $database->fetchAssoc($result);
    $name = $row['name'];
} else {
    $name = "Product not found"; // Handle the case where the query fails
}

// Close the database connection using the Database class
$database->disconnect();
?>
<html lang="en">
<head>
    <title>My store</title>
</head>
<body>
<h1>Tere</h1>
<h2><?php echo $name; ?></h2>
</body>
</html>
