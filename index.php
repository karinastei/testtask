<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>.product-grid {
            display: grid;
            padding: 10%;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Adjust as needed */
            gap: 10%; /* Adjust the gap between products */
        }

        .product-box {
            border: 1px solid #ccc;
            padding: 5%;
            /* Additional styling */
            /* You can add more styles to customize the appearance of each product box */
        }
    </style>

</head>
<?php
include_once './config/database.php';
include_once './model/Product.php';
include_once './model/Book.php';
include_once './model/DVD.php';
include_once './model/Furniture.php';

class ProductFactory
{
    public static function createProduct($type, $SKU, $name, $price, $amount)
    {
        $className = ucfirst(strtolower($type));

        if (class_exists($className) && is_subclass_of($className, 'Product')) {
            return new $className($SKU, $name, $price, $amount, $type);
        } else {
            throw new Exception("Invalid product type");
        }
    }
}

// Create an instance of the Database class
$database = new Database();
$database->connect(); // Connect to the database

try {
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

        //uses the amount to add every instance of a product
        for ($i = 0; $i < $product->getValue('amount'); $i++) {
            $products[] = $product;

        }

    }
    echo "<form method='post' action='delete.php'>";

    echo "<div class='product-grid'>";
    foreach ($products as $product) {
        echo "<div class='product-box'>";
        echo "<input type='checkbox' class='delete-checkbox' name='selected_products[]' value='" . $product->getValue('SKU') . "'>";
        echo "<p>SKU: " . $product->getValue('SKU') . "</p>";
        echo "<p>Name: " . $product->getValue('name') . "</p>";
        echo "<p>Price: $" . $product->getValue('price') . "</p>";
        echo "<p>Type: " . $product->getValue('type') . "</p>";
        echo "<p>Amount: " . $product->getValue('amount') . "</p>";
        echo "<p>" . $product->getAttributeLabel() . ": " . $product->getproductAttribute() . "</p>";
        echo "</div>";
    }
    echo "</div>";
    // echo "<pre>";
    // print_r($products);
    // echo "</pre>";

} catch (Exception $e) {
    echo $e->getMessage();

}
$database->disconnect(); // Disconnect from the database