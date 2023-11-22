<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <title>Product List</title>
    <script>
        function redirectToForm() {
            window.location.href = "add_product.php";
        }
    </script>
</head>
<body>
<div class="container">
    <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
        <div class="row">
            <h1>Product List</h1>
            <div class="buttons">
                <button type="button" onclick="redirectToForm()">ADD</button>
                <input type='submit' id='delete-product-btn' name='delete' value='MASS DELETE'>
            </div>
        </div>
        <div class='product-grid'>
            <?php
            require_once './controller/ProductController.php';

            $controller = new ProductController();

            // Form submission handling
            if (isset($_POST['delete'])) {
                $selectedSKUs = isset($_POST['selected_products']) ? $_POST['selected_products'] : [];
                $controller->updateProductAmounts($selectedSKUs);
            }

            // Call the displayProducts method to retrieve products
            $products = $controller->displayProducts();

            // Display the products using the retrieved data
            foreach ($products as $product) {
                echo "<div class='product-box'>";
                echo "<input type='checkbox' class='delete-checkbox' name='selected_products[]' value='" . $product->getValue('sku') . "'>";
                echo "<div class='text'>";
                echo "<p>SKU: " . $product->getValue('sku') . "</p>";
                echo "<p>Name: " . $product->getValue('name') . "</p>";
                echo $product->getValue('price') . " $" . "</p>";
                echo "<p>Type: " . $product->getValue('type') . "</p>";
                echo "<p>Amount: " . $product->getValue('amount') . "</p>";
                echo "<p>" . $product->getAttributeLabel() . ": " . $product->getSpecificAttribute() . "</p>";
                echo "</div>";
                echo "</div>";
            }

            ?>
        </div>
    </form>
</div>
</body>
</html>
