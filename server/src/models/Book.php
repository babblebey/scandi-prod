<?php
namespace Src\Models;

use Src\Models\Product;

class Book extends Product {
    const TABLE = 'book';

    private $attribute = ['weight' => null];

    public function setAttribute($attr) {
        $this->attribute['weight'] = $attr;
    }

    public function getAttribute() {
        return $this->attribute;
    }

    public function getInsertQuery() {
        return '
            INSERT INTO '. self::TABLE .' 
                (product_sku, weight)
            VALUES
                (:sku, :weight)
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