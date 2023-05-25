<?php
namespace Src\Models;

use Src\Models\Product;

class Furniture extends Product {
    const TABLE = 'furniture';

    private $dimensions;
    
    // IMPROVEMENT OPTION??: Transform __construst into setters
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