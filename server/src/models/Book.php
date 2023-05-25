<?php
namespace Src\Models;

use Src\Models\Product;

class Book extends Product {
    const TABLE = 'book';

    private $weight;

    // IMPROVEMENT OPTION??: Transform __construst into setters
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