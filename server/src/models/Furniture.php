<?php
namespace Src\Models;

use Src\Models\Product;

class Furniture extends Product {
    const TABLE = 'furniture';

    private $dimensions;
    
    public function __construct($name, $sku, $price, $dimensions) {
        $this->name = $name;
        $this->sku = $sku;
        $this->price = $price;
        $this->dimensions = $dimensions;
    }

    public function getSpecialAttribute() {
        return ['dimensions' => $this->dimensions];
    }

    public function getInsertQuery() {
        return '
            INSERT INTO '. self::TABLE .' 
                (product_sku, dimensions)
            VALUES
                (:sku, :dimensions)
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