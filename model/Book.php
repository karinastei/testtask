<?php

class Book extends Product
{
    protected $specificAttributes = ['weight']; // Specific attribute for Books
    protected $specificUnit = 'KG';
}