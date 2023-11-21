<?php

class Furniture extends Product
{
    protected $specificAttributes = ['height', 'width', 'length']; // Specific attributes for Furniture
    private $specificUnit = 'CM';


    public function getproductAttribute()
    {
        return $this->height . "x" . $this->width . "x" . $this->length;
    }

    public function getAttributeLabel()
    {
        //or Dimension? like on the image
        return "Dimensions";
    }
    public function getFormValues() {
        return '<label for="height">Height (CM)</label>
            <input type="text" id="size" name="size" required><br><br>
            <label for="width">width (CM)</label>
            <input type="text" id="width" name="width" required><br><br>
            <label for="length">length (CM)</label>
            <input type="text" id="length" name="length" required><br><br>';
    }
}