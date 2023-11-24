<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>Product List</title>
    <script src=".//public/js/product_form.js"></script>
</head>
<body>
<div class="container">
    <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
        <div class="row">
            <h1>Product List</h1>
            <div class="buttons">
                <button type="button" onclick="redirectToForm()">Add</button>
                <input type='submit' id='delete-product-btn' name='delete' value='Mass delete'>
            </div>
        </div>
        <div class='product-grid'>
            <?php foreach ($products as $product) : ?>
                <div class='product-box'>
                    <input type='checkbox' class='delete-checkbox' name='selected_products[]'
                           value='<?php echo $product->getValue('sku'); ?>'>
                    <div class='text'>
                        <p><?php echo $product->getValue('sku'); ?></p>
                        <p><?php echo $product->getValue('name'); ?></p>
                        <p><?php echo $product->getValue('price'); ?> $</p>
                        <p><?php echo $product->getAttributeLabel(); ?>: <?php echo $product->getSpecificAttribute(); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </form>
</div>
</body>
</html>