<?php
namespace Src\Models;

use Src\Models\Product;

class Book extends Product {
    const TABLE = 'book';

    private $weight;

    public function setSpecialAttribute($attr) {
        $this->weight = $attr;
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