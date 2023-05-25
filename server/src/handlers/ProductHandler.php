<?php 
namespace Src\Handlers;

use Src\Interfaces\ProductHandlerInterface;

class ProductHandler implements ProductHandlerInterface {
    const TABLE = 'product';

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getInstance($productType, array $params) {
        $class = 'Src\\Models\\' . $productType;
        return new $class($params['sku'], $params['name'], $params['price'], $params['attribute']);
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
            $result = $stmt->fetchAll();
            return $result;
        } catch (\PDOExcerption $error) {
            exit("Product Retrieval Error: " . $error->getMessage());
        }
        
    }

    public function insert(array $productDetails, $productType) {
        $product = $this->getInstance($productType, $productDetails);
        $productAttributeKey = key($product->getSpecialAttribute());

        $productQuery = $product->getInsertQuery();
        $localQuery = '
            INSERT INTO '. self::TABLE .' 
                (sku, name, price)
            VALUES
                (:sku, :name, :price)
        ';

        // LATER IMPROVEMENTS? Use extract()
        
        try {
            $localStmt = $this->db->prepare($localQuery);
            $localStmt->execute([
                'sku' => $productDetails['sku'],
                'name' => $productDetails['name'],
                'price' =>  $productDetails['price']
            ]);
            
            $productStmt = $this->db->prepare($productQuery);
            $productStmt->execute([
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