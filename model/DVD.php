<?php

class DVD extends Product
{
    private $size;

    public function fetchSpecificAttribute($row)
    {
        $this->size = $row['size'];
    }

    public function getproductAttribute()
    {
        return $this->size  . "MB";
    }

    public function getAttributeLabel()
    {
        return "Size";
    }
}