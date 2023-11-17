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

    abstract public function getproductAttribute();

    abstract protected function fetchSpecificAttribute($row);

    abstract public function getAttributeLabel();
}

class Book extends Product
{
    private $weight;

    public function fetchSpecificAttribute($row)
    {
        $this->weight = $row['weight'];
    }

    public function getproductAttribute()
    {
        return $this->weight;
    }

    public function getAttributeLabel()
    {
        return "Weight";
    }
}

class Furniture extends Product
{
    private $height;
    private $width;
    private $length;

    public function fetchSpecificAttribute($row)
    {
        $this->height = $row['height'];
        $this->width = $row['width'];
        $this->length = $row['length'];
    }

    public function getproductAttribute()
    {
        return $this->height . "x" . $this->width . "x" . $this->length;
    }

    public function getAttributeLabel()
    {
        //or Dimension? like on the image
        return "Dimensions";
    }
}

class DVD extends Product
{
    private $size;

    public function fetchSpecificAttribute($row)
    {
        $this->size = $row['size'];
    }

    public function getproductAttribute()
    {
        return $this->size;
    }

    public function getAttributeLabel()
    {
        return "Size";
    }
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
    $productData = $database->query("SELECT 
    products.*, 
    dvds.size, 
    furniture.height, 
    furniture.width, 
    furniture.length,
    books.weight
FROM 
    products 
LEFT JOIN 
    dvds ON products.id = dvds.product_id 
LEFT JOIN 
    furniture ON products.id = furniture.product_id
LEFT JOIN
    books ON products.id = books.product_id; 
");


    while ($row = $productData->fetch_assoc()) {

        $productType = $row['type'];
        $productSKU = $row['SKU'];
        $productName = $row['name'];
        $productPrice = $row['price'];
        $productAmount = $row['amount'];
        // Create product object using the factory
        $product = ProductFactory::createProduct($productType, $productSKU, $productName, $productPrice, $productAmount);

        $product->fetchSpecificAttribute($row); // Fetches the specific property based on the product type
        //uses the amount to show every product
        for ($i = 0; $i < $product->getAmount(); $i++) {

            // Use the $product object as needed
            echo "SKU: " . $product->getSKU() . "<br>";
            echo "Name: " . $product->getName() . "<br>";
            echo "Price: $" . $product->getPrice() . "<br>";
            echo "Type: " . $product->getType() . "<br>";
            echo "Amount: " . $product->getAmount() . "<br>";

            echo $product->getAttributeLabel() . ": " . $product->getproductAttribute() . "<br>";
            echo "<br>";

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