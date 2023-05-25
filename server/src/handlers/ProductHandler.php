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
                '. self::TABLE .'
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

    public function insert(array $productDetails, $productType) {
        $product = $this->getInstance($productType, $productDetails);
        $productAttributeKey = key($product->getSpecialAttribute());

        $productInsertQuery = $product->getInsertQuery();
        $localInsertQuery = '
            INSERT INTO '. self::TABLE .' 
                (sku, name, price, type)
            VALUES
                (:sku, :name, :price, :type)
        ';

        // LATER IMPROVEMENTS? Use extract()
        
        try {
            $localInsertStmt = $this->db->prepare($localInsertQuery);
            $localInsertStmt->execute([
                'sku' => $productDetails['sku'],
                'name' => $productDetails['name'],
                'price' =>  $productDetails['price'],
                'type' =>  $productType
            ]);
            
            $productInsertStmt = $this->db->prepare($productInsertQuery);
            $productInsertStmt->execute([
                'sku' => $productDetails['sku'],
                $productAttributeKey => $productDetails['attribute']
            ]);

            // Debug - Remove Later
            echo "Product Inserted Successfully!";
        } catch (\PDOExcerption $error) {
            exit("Product Insertion Error: " . $error->getMessage());
        }
    }

    public function delete() {

    }
}