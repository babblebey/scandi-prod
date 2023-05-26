<?php
namespace Src\Models;

use Src\Models\Product;

class DVD extends Product {
    const TABLE = 'dvd';

    private $size;

    public function setSpecialAttribute($attr) {
        $this->size = $attr;
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