<?php

class Product
{
    private $SKU;
    private $name;
    private $price;

    private $amount;

    public function __construct($SKU, $name, $price, $amount)
    {
        $this->SKU = $SKU;
        $this->name = $name;
        $this->price = $price;
        $this->amount = $amount;
    }

// Getters for SKU, name, and price
    public function getSKU()
    {
        return $this->SKU;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getAmount()
    {
        return $this->amount;
    }
}

