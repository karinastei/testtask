<?php

abstract class Product
{
    private $sku;
    private $name;
    private $price;
    private $amount;
    private $type;
    protected $specificAttributes = [];
    protected $specificUnit;

    public function __construct($sku = '', $name = '', $price = 0, $amount = 0, $type = '')
    {
        $this->sku = $sku;
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

    //gets the specific attribute value and unit
    public function getSpecificAttribute()
    {
        $attributes = [];

        foreach ($this->specificAttributes as $attribute) {
            $attributes[] = $this->{$attribute};
        }

        return implode('x', $attributes) . ' ' . $this->specificUnit;
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

    public function saveToDB($database)
    {

        $queryProducts = "INSERT INTO products (sku, name, price, amount, type) 
                  VALUES ('{$this->getValue('sku')}', '{$this->getValue('name')}', '{$this->getValue('price')}', '{$this->getValue('amount')}', '{$this->getValue('type')}')";

        if ($database->query($queryProducts)) {
            // Get the ID of the inserted product
            $productId = $database->connection->insert_id;

            $attributes = get_object_vars($this);
            $tableName = $this->getValue('type');
            // Exclude common fields for the query
            $removedFields = ['sku', 'name', 'price', 'amount', 'type', 'specificAttributes', 'specificUnit'];
            $specificFields = array_diff_key($attributes, array_flip($removedFields));

            $typeColumnsString = implode(', ', array_keys($specificFields));
            $typeValuesString = "'" . implode("', '", array_values($specificFields)) . "'";

            $querySpecificProduct = "INSERT INTO $tableName (product_id, $typeColumnsString) 
                             VALUES ('$productId', $typeValuesString)";

            // Execute the SQL query for the specific product type table
            $database->query($querySpecificProduct);
        }
    }
}
