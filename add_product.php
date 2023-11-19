<!-- add_product.php file -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <title>Add Product</title>
</head>
<body>
<div class="container">

    <form id="product_form" method="post" action="save_product.php">
        <div class="row">
            <h1>Product List</h1>
            <div class="buttons">
                <button type="submit">Save</button>
                <button type="button" onclick="cancel()">Cancel</button>
            </div>
        </div>
        <div class="form-body">
            <label for="sku">SKU:</label>
            <input type="text" id="sku" name="sku" required><br><br>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required><br><br>

            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" required><br><br>

            <label for="productType">Product Type:</label>
            <select id="productType" name="productType" onchange="toggleFields()" required>
                <option value="">Select Type</option>
                <option value="DVD">DVD</option>
                <option value="Book">Book</option>
                <option value="Furniture">Furniture</option>
            </select><br><br>

            <!-- this could be as text in function in product and the keyword is in brackets -->
            <!--  -->
            <label for="weight">Weight:</label>
            <input type="text" id="weight" name="weight" required><br><br>

    </form>

    <div id="notification"></div>

    <script src="product_form.js"></script>
</div>
</div>
</body>
</html>
