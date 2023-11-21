<?php
//form_change.php
// Include your abstract class and concrete subclasses
include './model/Product.php'; // Include the file where Product class and its subclasses are defined
include_once './model/Book.php';
include_once './model/DVD.php';
include_once './model/Furniture.php';

// Retrieve the selected product type sent via POST
if (isset($_POST['productType'])) {
    $selectedType = $_POST['productType'];
    // Check if the class exists based on the selected type
    $className = ucfirst($selectedType); // Assuming the class names start with a capital letter

    if (class_exists($className)) {
        // Create an instance based on the selected type
        $product = new $className(/* provide necessary arguments */);

        // Check if the method exists in the class and call it
        if (method_exists($product, 'getFormValues')) {
            // Call the getFormValues method dynamically
            $formValues = $product->getFormValues();
            echo $formValues;
        } else {
            echo 'Method not found for the selected type.';
        }
    } else {
        echo 'Class not found for the selected type.';
    }
}