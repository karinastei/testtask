<?php
//controller.php
include_once './config/database.php';
include_once './model/product.php';
include_once './model/ProductRepository.php';

$db = new Database();
$productRepository = new ProductRepository($db);

$products = $productRepository->fetchProductsFromDatabase();


include_once './index.php';

