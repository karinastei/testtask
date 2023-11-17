<?php

class Furniture extends Product
{
    private $height;
    private $width;
    private $length;

    public function fetchSpecificAttribute($row)
    {
        $this->height = $row['height'];
        $this->width = $row['width'];
        $this->length = $row['length'];
    }

    public function getproductAttribute()
    {
        return $this->height . "x" . $this->width . "x" . $this->length;
    }

    public function getAttributeLabel()
    {
        //or Dimension? like on the image
        return "Dimensions";
    }
}