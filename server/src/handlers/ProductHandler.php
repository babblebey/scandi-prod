<?php 
namespace Src\Handlers;

use Src\Interfaces\ProductHandlerInterface;

class ProductHandler implements ProductHandlerInterface {
    const TABLE = 'product';

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getInstance($productType) {
        $Class = 'Src\\Models\\' . $productType;
        return new $Class;
    }

    public function find($sku) {
        $query = '
            SELECT 
                * 
            FROM 
                '. self::TABLE .'
            WHERE
                sku = :sku
        ';
        
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                'sku' => $sku
            ]);
            $product = $stmt->fetch();
            return $product;
        } catch (\PDOExcerption $error) {
            exit("Product Retrieval Error: " . $error->getMessage());
        }
    }

    public function findAll() {
        $query = '
            SELECT 
                * 
            FROM 
                '.self::TABLE.'
        ';

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $products = $stmt->fetchAll();
            return $products;
        } catch (\PDOExcerption $error) {
            exit("Products Retrieval Error: " . $error->getMessage());
        }
        
    }

    public function insert(array $productDetails) {
        extract($productDetails);

        $product = $this->getInstance($type);
        $product->setSKU($sku);
        $product->setName($name);
        $product->setPrice($price);
        $product->setSpecialAttribute($attribute);

        $productAttribute = $product->getSpecialAttribute();
        $productAttributeKey = key($productAttribute);

        $productInsertQuery = $product->getInsertQuery();
        $localInsertQuery = '
            INSERT INTO '.self::TABLE.' 
                (sku, name, price, type)
            VALUES
                (:sku, :name, :price, :type)
        ';

        try {
            $localInsertStmt = $this->db->prepare($localInsertQuery);
            $localInsertStmt->execute([
                'sku' => $product->getSKU(),
                'name' => $product->getName(),
                'price' =>  $product->getPrice(),
                'type' =>  $type
            ]);
            
            $productInsertStmt = $this->db->prepare($productInsertQuery);
            $productInsertStmt->execute([
                'sku' => $product->getSKU(),
                $productAttributeKey => $productAttribute[$productAttributeKey]
            ]);
            return $localInsertStmt->rowCount();

            // Debug - Remove Later
            // echo $localInsertStmt->rowCount() . ' rows inserted! <br/>';
            // echo "Product Inserted Successfully!";
        } catch (\PDOExcerption $error) {
            exit("Product Insertion Error: " . $error->getMessage());
        }
    }

    public function delete(array $skus) {
        $count = 0;
        try {
            foreach ($skus as $sku) {
                $p = $this->find($sku);
                $productType = $p->type;

                $product = $this->getInstance($productType);

                $query = $product->getDeleteQuery();

                $stmt = $this->db->prepare($query);
                $stmt->execute([
                    'sku' => $sku
                ]);

                $count += $stmt->rowCount();
            }
            return $count;

            // Debug - Remove Later
            // echo $count . ' rows deleted! <br/>';
            // echo "Product Deleted Successfully!";
        } catch (\PDOExcerption $error) {
            exit("Product Deletion Error: " . $error->getMessage());
        }
    }
}