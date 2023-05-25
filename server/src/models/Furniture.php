<?php
namespace Src\Models;

use Src\Models\Product;

class Furniture extends Product {
    const TABLE = 'furniture';

    private $dimensions;
    
    public function setSpecialAttribute($attr) {
        $this->dimensions = $attr;
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

    public function getDeleteQuery($table = 'product') {
        return '
            DELETE 
                Product, ThisProductType 
            FROM '. self::TABLE .'
            INNER JOIN '. $table .' 
            ON 
                ThisProductType.product_sku = Product.sku 
            WHERE 
                Product.sku = :sku
        ';
    }
}