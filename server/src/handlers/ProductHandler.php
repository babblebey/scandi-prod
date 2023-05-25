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

        $productInsertQuery = $product->getInsertQuery();
        $localInsertQuery = '
            INSERT INTO '. self::TABLE .' 
                (sku, name, price, type)
            VALUES
                (:sku, :name, :price,type)
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