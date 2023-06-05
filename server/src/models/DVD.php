<?php
namespace Src\Models;

use Src\Models\Product;

class DVD extends Product {
    const TABLE = 'dvd';

    private $attribute = ['size' => null];

    public function setAttribute($attr) {
        $this->attribute['size'] = $attr;
    }

    public function getAttribute() {
        return $this->attribute;
    }

    public function getFindQuery($table = 'product') {
        $attributeKey = key($this->getAttribute());
        
        return '
            SELECT 
                Product.sku, Product.name, Product.price, ProductType.'.$attributeKey.' AS attribute 
            FROM '.$table.' Product
            LEFT JOIN '.self::TABLE.' ProductType 
            ON 
                Product.sku = ProductType.product_sku
            WHERE 
                Product.sku = :sku
        ';
    }

    public function getInsertQuery() {
        return '
            INSERT INTO '.self::TABLE.' 
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