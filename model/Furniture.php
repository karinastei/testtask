<?php

class Furniture extends Product
{
    protected $specificAttributes = ['height', 'width', 'length']; // Specific attributes for Furniture
    protected $specificUnit = 'CM';

//this could be changed to get the data from $specificAttributes?
    public function getSpecificAttribute()
    {
        return $this->height . "x" . $this->width . "x" . $this->length . " " . $this->specificUnit;
    }

    public function getAttributeLabel()
    {
        //or Dimension? like on the image
        return "Dimensions";
    }
}