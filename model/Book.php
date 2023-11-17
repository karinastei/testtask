<?php


class Book extends Product
{
    private $weight;

    public function fetchSpecificAttribute($row)
    {
        $this->weight = $row['weight'];
    }

    public function getproductAttribute()
    {
        return $this->weight;
    }

    public function getAttributeLabel()
    {
        return "Weight";
    }
}