<?php
namespace Src\Models;

use Src\Models\Product;

class Book extends Product {
    const TABLE = 'book';

    private $weight;

    public function __construct($name, $sku, $price, $weight) {
        $this->name = $name;
        $this->sku = $sku;
        $this->price = $price;
        $this->weight = $weight;
    }

    public function getSpecialAttribute() {
        return ['weight' => $this->weight];
    }

    public function getInsertQuery() {
        return '
            INSERT INTO '. self::TABLE .' 
                (product_sku, weight)
            VALUES
                (:sku, :weight)
        ';
    }

    public function getDeleteQuery() {
        return '
            DELETE FROM '. self::TABLE .' 
            WHERE 
                product_sku = :sku
        ';
    }
}