<?php

class Book extends Product
{
    protected $specificAttributes = ['weight']; // Specific attribute for Books
    private $specificUnit = 'KG';

    public function getproductAttribute()
    {
        return $this->weight  . "KG";
    }

    public function getAttributeLabel()
    {
        return "Weight";
    }

    public function getFormValues()
    {
        return '<label for="weight">Weight:</label>
            <input type="text" id="weight" name="weight" required><br><br>';
    }
}