<?php
//form_change.php

include './model/Product.php';
include_once './model/Book.php';
include_once './model/DVD.php';
include_once './model/Furniture.php';

// Retrieve the selected product type sent via POST
if (isset($_POST['productType'])) {
    $selectedType = $_POST['productType'];
    $className = ucfirst($selectedType);

    if (class_exists($className)) {
        $product = new $className();

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