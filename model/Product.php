<?php

abstract class Product
{
    private $SKU;
    private $name;
    private $price;
    private $amount;
    private $type;
    protected $specificAttributes = [];

    public function __construct($SKU = '', $name = '', $price = 0, $amount = 0, $type = '')
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

    public function fetchSpecificAttribute($row)
    {
        foreach ($this->specificAttributes as $attribute) {
            if (isset($row[$attribute])) {
                $this->{$attribute} = $row[$attribute];
            }
        }
    }

    abstract public function getAttributeLabel();

    abstract public function getFormValues();
}
