<?php
include_once './config/database.php';

abstract class Product
{
    private $SKU;
    private $name;
    private $price;
    private $amount;
    private $type;

    public function __construct($SKU, $name, $price, $amount, $type)
    {
        $this->SKU = $SKU;
        $this->name = $name;
        $this->price = $price;
        $this->amount = $amount;
        $this->type = $type;
    }

// Getters for SKU, name, and price
    public function getSKU()
    {
        return $this->SKU;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getType()
    {
        return $this->type;
    }
}

class Book extends Product
{
    private $weight;
}

class Furniture extends Product
{
    private $height;
}

class DVD extends Product
{
    private $size;
}

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
    $productData = $database->query("SELECT products.*, dvds.*, furniture.* FROM products LEFT JOIN dvds ON products.id = dvds.product_id LEFT JOIN furniture ON products.id = furniture.product_id; ");


    while ($row = $productData->fetch_assoc()) {

        $productType = $row['type'];
        $productSKU = $row['SKU'];
        $productName = $row['name'];
        $productPrice = $row['price'];
        $productAmount = $row['amount'];
        // Create product object using the factory
        $product = ProductFactory::createProduct($productType, $productSKU, $productName, $productPrice, $productAmount);
        //uses the amount to show every product with that id
        for ($i = 0; $i < $product->getAmount(); $i++) {

            // Use the $product object as needed
            echo "SKU: " . $product->getSKU() . "<br>";
            echo "Name: " . $product->getName() . "<br>";
            echo "Price: $" . $product->getPrice() . "<br>";
            echo "Type: $" . $product->getType() . "<br>";
            echo "Amount: $" . $product->getAmount() . "<br>";
            echo "Amount: $" . $product->getAmount() . "<br>";

            $products[] = $product;

        }

    }
    echo "<pre>";
    print_r($products);
    echo "</pre>";
} catch (Exception $e) {
    echo $e->getMessage();

}
$database->disconnect(); // Disconnect from the database