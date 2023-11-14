<?php
//gets data from model, handles user input
include_once './config/database.php';
include_once './model/product.php';
include_once './model/ProductRepository.php';

// Assuming you're in a controller or another part of your application
$db = new Database();
$productRepository = new ProductRepository($db);

$products = $productRepository->fetchProductsFromDatabase();

// Now you have an array of Product objects that you can work with
