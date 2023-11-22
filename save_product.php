<?php
require_once './config/database.php'; // Include the Database class
require_once './model/Product.php';
require_once './model/ProductFactory.php';
require_once './model/DVD.php';
require_once './model/Book.php';
require_once './model/Furniture.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $database = new Database(); // Create an instance of the Database class
        $database->connect(); // Connect to the database

        // Retrieve form data
        $sku = $_POST['SKU'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $amount = $_POST['amount'];
        $type = $_POST['productType'];

        //product object is created depending on type
        $product = ProductFactory::createProduct($type, $sku, $name, $price, $amount);
        $product->getSpecificAttributeFromDB($_POST);

        $product->saveToDB($database);

        $database->disconnect();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo "Invalid request!";
}

