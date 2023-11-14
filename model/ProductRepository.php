<?php
// ProductRepository.php
include_once './config/database.php';
include_once('product.php');

class ProductRepository {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function fetchProductsFromDatabase() {
        $this->db->connect();

        $sql = "SELECT SKU, name, price, amount FROM products";
        $result = $this->db->query($sql);

        $products = [];

        if ($result->num_rows > 0) {
            while ($row = $this->db->fetchAssoc($result)) {

                $SKU = $row['SKU'];
                $name = $row['name'];
                $price = $row['price'];
                $amount = $row['amount'];

                for ($i = 0; $i < $amount; $i++) {
                    $product = new Product($SKU, $name, $price, $amount);
                    $products[] = $product;
                }
            }
        }

        $this->db->disconnect();
        var_dump($products);
//just for debug
        echo "<pre>";
        print_r($products);
        echo "</pre>";
        return $products;
    }
}
