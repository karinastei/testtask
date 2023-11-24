<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>Add Product</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="public/js/product_form.js"></script>
</head>
<body>
<div class="container">
    <form id="product_form" method="post" action="save_product.php" onsubmit="return validateForm()">
        <div class="row">
            <h1>Product List</h1>
            <div class="buttons">
                <button type="submit">Save</button>
                <button type="button" onclick="cancel()">Cancel</button>
            </div>
        </div>
        <div id="notification"></div>
        <div class="form-body">
            <label for="sku">SKU</label>
            <input type="text" id="sku" class="input-field" name="sku" required><br><br>

            <label for="name">Name</label>
            <input type="text" id="name" class="input-field" name="name" required><br><br>

            <label for="price">Price ($)</label>
            <input type="number" step="0.001" id="price" class="input-field" name="price" required><br><br>

            <label for="amount">Amount</label>
            <input type="number" id="amount" class="input-field" name="amount" required><br><br>

            <label for="productType">Type Switcher</label>
            <select id="productType" name="productType" class="input-field" onchange="toggleFields()" required>
                <option value="">Type Switcher</option>
                <option value="DVD">DVD</option>
                <option value="Book">Book</option>
                <option value="Furniture">Furniture</option>
            </select><br><br>

            <div id="dynamicFields"></div>
    </form>

</div>
</body>
</html>
