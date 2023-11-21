<?php

abstract class Product
{
    private $SKU;
    private $name;
    private $price;
    private $amount;
    private $type;
    protected $specificAttributes = [];
    protected $specificUnit;

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

    public function getSpecificAttribute()
    {
        $specificAttribute = $this->specificAttributes[0];
        return $this->{$specificAttribute} . " " . $this->specificUnit;
    }

    public function getSpecificAttributeFromDB($row)
    {
        foreach ($this->specificAttributes as $attribute) {
            if (isset($row[$attribute])) {
                $this->{$attribute} = $row[$attribute];
            }
        }
    }

    public function getAttributeLabel()
    {
        return ucfirst($this->specificAttributes[0]);
    }

    public function getFormValues()
    {
        $form = '';
        foreach ($this->specificAttributes as $attribute) {
            $form .= '<label for="' . $attribute . '">' . ucfirst($attribute) . ' (' . $this->specificUnit . ')</label>';
            $form .= '<input type="text" id="' . $attribute . '" name="' . $attribute . '" required><br><br>';
        }
        return $form;
    }
}
