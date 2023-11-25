<?php

require_once './model/Product.php';
require_once './model/Book.php';
require_once './model/Dvd.php';
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
            $database->connect();

            $productData = $database->query("SELECT products.*, dvd.size, furniture.height, furniture.width, furniture.length, book.weight FROM products LEFT JOIN dvd ON products.id = dvd.product_id LEFT JOIN furniture ON products.id = furniture.product_id LEFT JOIN book ON products.id = book.product_id ORDER BY products.id DESC;");

            while ($row = $productData->fetch_assoc()) {
                $type = $row['type'];
                $sku = $row['sku'];
                $name = $row['name'];
                $price = $row['price'];
                $amount = $row['amount'];

                $product = ProductFactory::createProduct($type, $sku, $name, $price, $amount);

                $product->getSpecificAttributeFromDB($row); // Fetches the specific property based on the product type

                // Add the product to the products array
                for ($i = 0; $i < $product->getValue('amount'); $i++) {
                    $products[] = $product;
                }
            }

            $database->disconnect();

            return $products;
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $products;
    }

    public function handleFormSubmission()
    {
        if (isset($_POST['delete'])) {
            $selectedSKUs = isset($_POST['selected_products']) ? $_POST['selected_products'] : [];
            $this->updateProductAmounts($selectedSKUs);
        }
    }

    public function updateProductAmounts($selectedSKUs)
    {
        try {
            $database = new Database();
            $database->connect();

            foreach ($selectedSKUs as $selectedSKU) {
                $query = "UPDATE products SET amount = amount - 1 WHERE sku = '$selectedSKU'";
                $database->query($query);
            }

            $database->disconnect();
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}