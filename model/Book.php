<?php

class Book extends Product
{
    private $weight;
    //selle asemel "specificAttribute, millel Book objectis weight väärtus"
    //unit of measurement (replaces kg)

    public function fetchSpecificAttribute($row)
    {
        $this->weight = $row['weight'];
    }

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