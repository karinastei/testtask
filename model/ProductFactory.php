<?php

class ProductFactory
{
    /**
     * @throws Exception
     */
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