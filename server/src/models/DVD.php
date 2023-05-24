<?php
namespace Src\Models;

use Src\Models\Product;

class DVD extends Product {
    const TABLE = 'dvd';

    private $size;

    public function __construct($name, $sku, $price, $size) {
        $this->name = $name;
        $this->sku = $sku;
        $this->price = $price;
        $this->size = $size;
    }

    public function getSpecialAttribute() {
        return ['size' => $this->size];
    }

    public function getInsertQuery() {
        return '
            INSERT INTO '. self::TABLE .' 
                (product_sku, size)
            VALUES
                (:sku, :size)
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