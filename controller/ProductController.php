<?php
// Import necessary model classes and database connection
require_once './model/Product.php';
require_once './model/Book.php';
require_once './model/DVD.php';
require_once './model/Furniture.php';
require_once './model/ProductFactory.php';
require_once './config/database.php';

class ProductController
{
    public function displayProducts()
    {
        $products = [];

        try {
            // Create an instance of the Database class
            $database = new Database();
            $database->connect(); // Connect to the database

            // Fetch products from the database
            $productData = $database->query("SELECT products.*, dvd.size, furniture.height, furniture.width, furniture.length, book.weight FROM products LEFT JOIN dvd ON products.id = dvd.product_id LEFT JOIN furniture ON products.id = furniture.product_id LEFT JOIN book ON products.id = book.product_id;");

            while ($row = $productData->fetch_assoc()) {
                $type = $row['type'];
                $sku = $row['sku'];
                $name = $row['name'];
                $price = $row['price'];
                $amount = $row['amount'];

                // Create product object using the factory
                //use these two to create an object with the attributes
                //then but the object to database !!!!!!
                $product = ProductFactory::createProduct($type, $sku, $name, $price, $amount);

                $product->getSpecificAttributeFromDB($row); // Fetches the specific property based on the product type

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
    public function updateProductAmounts($selectedSKUs) {
        try {
            $database = new Database();
            $database->connect();

            foreach ($selectedSKUs as $selectedSKU) {
                // Update the product's amount in the database
                $query = "UPDATE products SET amount = amount - 1 WHERE sku = '$selectedSKU'";
                $database->query($query);
            }

            $database->disconnect();
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

}
