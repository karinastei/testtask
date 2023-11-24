<?php
require_once './config/database.php';
require_once './controller/ProductController.php';

$productController = new ProductController();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $selectedSKUs = isset($_POST['selected_products']) ? $_POST['selected_products'] : [];
    $productController->updateProductAmounts($selectedSKUs);
}

// Retrieve products from the controller
$products = $productController->displayProducts();

// Load the view (view/index.php) passing necessary data
include './view/index.php';