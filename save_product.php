<?php
require_once './config/database.php'; // Include the Database class
require_once './model/Product.php';
require_once './model/ProductFactory.php';
require_once './model/Dvd.php';
require_once './model/Book.php';
require_once './model/Furniture.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $database = new Database();
        $database->connect();

        $sku = $_POST['sku'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $amount = $_POST['amount'];
        $type = $_POST['productType'];

        $product = ProductFactory::createProduct($type, $sku, $name, $price, $amount);
        $product->getSpecificAttributeFromDB($_POST);

        $product->saveToDB($database);

        $database->disconnect();

        echo 'success';
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
