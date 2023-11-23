<?php

class Furniture extends Product
{
    protected $specificAttributes = ['height', 'width', 'length']; // Specific attributes for Furniture
    protected $specificUnit = 'CM';

    public function getAttributeLabel()
    {
        return "Dimensions";
    }
}