<?php

class Dvd extends Product
{
    protected $specificAttributes = ['size'];
    private $specificUnit = 'MB';

    public function getproductAttribute()
    {
        return $this->size  . "MB";
    }

    public function getAttributeLabel()
    {
        return "Size";
    }
    public function getFormValues() {
        return '<label for="size">Size (MB)</label>
            <input type="text" id="size" name="size" required><br><br>';
    }
}