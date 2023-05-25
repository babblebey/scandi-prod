<?php
namespace Src\Models;

use Src\Models\Product;

class DVD extends Product {
    const TABLE = 'dvd';

    private $size;

    // IMPROVEMENT OPTION??: Transform __construst into setters
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