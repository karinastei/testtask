<?php
//form_change.php

include './model/Product.php';
include_once './model/Book.php';
include_once './model/DVD.php';
include_once './model/Furniture.php';

// Retrieve the selected product type sent via POST
if (isset($_POST['productType'])) {
    $selectedType = $_POST['productType'];
    // Check if the class exists based on the selected type
    $className = ucfirst($selectedType);

    if (class_exists($className)) {
        // Create an instance based on the selected type
        $product = new $className();

        // Check if the method exists in the class and call it
        if (method_exists($product, 'getFormValues')) {
            // Call the getFormValues method to create the remaining form based on type
            $formValues = $product->getFormValues();
            echo $formValues;
        } else {
            echo 'Method not found for the selected type.';
        }
    } else {
        echo 'Class not found for the selected type.';
    }
}