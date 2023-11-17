<?php

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
    public function getValue($value)
    {
        return $this->{$value};
    }

    abstract public function getproductAttribute();

    abstract protected function fetchSpecificAttribute($row);

    abstract public function getAttributeLabel();
}
