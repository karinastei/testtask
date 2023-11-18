<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <title>Product List</title>
</head>
<body>
<h1>Product List</h1>
<form method='post' action=''>
    <input type='submit' id='delete-product-btn' name='delete' value='Mass delete'>
    <div class='product-grid'>
        <?php
        // Import the ProductController
        require_once './controller/ProductController.php';

        // Create an instance of the ProductController
        $controller = new ProductController();

        // Call the displayProducts method to retrieve products
        $products = $controller->displayProducts();

        // Display the products using the retrieved data
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
        ?>
    </div>
</form>
</body>
</html>
