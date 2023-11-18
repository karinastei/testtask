<?php
// Import necessary model classes and database connection
require_once './model/Product.php';
require_once './model/Book.php';
require_once './model/DVD.php';
require_once './model/Furniture.php';
require_once './model/ProductFactory.php';
require_once './config/database.php';

class ProductController {
    public function displayProducts() {
        $products = [];

        try {
            // Create an instance of the Database class
            $database = new Database();
            $database->connect(); // Connect to the database

            // Fetch products from the database
            $productData = $database->query("SELECT products.*, dvds.size, furniture.height, furniture.width, furniture.length, books.weight
                FROM products 
                LEFT JOIN dvds ON products.id = dvds.product_id 
                LEFT JOIN furniture ON products.id = furniture.product_id
                LEFT JOIN books ON products.id = books.product_id;");

            while ($row = $productData->fetch_assoc()) {
                $productType = $row['type'];
                $productSKU = $row['SKU'];
                $productName = $row['name'];
                $productPrice = $row['price'];
                $productAmount = $row['amount'];

                // Create product object using the factory
                $product = ProductFactory::createProduct($productType, $productSKU, $productName, $productPrice, $productAmount);

                $product->fetchSpecificAttribute($row); // Fetches the specific property based on the product type

                // Add the product to the products array
                for ($i = 0; $i < $product->getValue('amount'); $i++) {
                    $products[] = $product;
                }
            }

            $database->disconnect(); // Disconnect from the database

            // Return the products array
            return $products;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Other methods for handling actions like deleting products could be added here
}
