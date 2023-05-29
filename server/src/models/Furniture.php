<?php
namespace Src\Models;

use Src\Models\Product;

class Furniture extends Product {
    const TABLE = 'furniture';

    private $attribute = ['dimensions' => null];
    
    public function setAttribute($attr) {
        $this->attribute['dimensions'] = $attr;
    }

    public function getAttribute() {
        return $this->attribute;
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
                '.$table.', '.self::TABLE.'
            FROM '.self::TABLE.'
            INNER JOIN '.$table.' 
            ON 
                '.self::TABLE.'.product_sku = '.$table.'.sku 
            WHERE 
                '.$table.'.sku = :sku
        ';
    }
}