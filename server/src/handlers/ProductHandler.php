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
        } catch (\PDOException $error) {
            exit("Product Retrieval Error: " . $error->getMessage());
        }
    }

    public function findAll() {
        try {
            $stmt = $this->db->prepare('SELECT * FROM '.self::TABLE.'');
            $stmt->execute();
            $products = [];

            while ($row = $stmt->fetch()) {
                $product = $this->getInstance($row->type);

                $findQuery = $product->getFindQuery();

                $findStmt = $this->db->prepare($findQuery);
                $findStmt->execute([
                    'sku' => $row->sku
                ]);
                $foundProduct = $findStmt->fetch();

                $product->setAttribute($foundProduct->attribute);

                array_push($products, [
                    'type' => $row->type,
                    'sku' => $foundProduct->sku,
                    'name' => $foundProduct->name,
                    'price' => $foundProduct->price,
                    'attribute' => $product->getAttribute()
                ]);
            }
            
            return $products;
        } catch (\PDOException $error) {
            exit("Products Retrieval Error: " . $error->getMessage());
        }
        
    }

    public function insert(array $productDetails) {
        extract($productDetails);

        $product = $this->getInstance($type);
        $product->setSKU($sku);
        $product->setName($name);
        $product->setPrice($price);
        $product->setAttribute($attribute);

        $productAttribute = $product->getAttribute();
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
                'sku' => strtoupper($product->getSKU()),
                'name' => $product->getName(),
                'price' =>  $product->getPrice(),
                'type' =>  $type
            ]);
            
            $productInsertStmt = $this->db->prepare($productInsertQuery);
            $productInsertStmt->execute([
                'sku' => strtoupper($product->getSKU()),
                $productAttributeKey => $productAttribute[$productAttributeKey]
            ]);
            return $localInsertStmt->rowCount();

            // Debug - Remove Later
            // echo $localInsertStmt->rowCount() . ' rows inserted! <br/>';
            // echo "Product Inserted Successfully!";PDOException
        } catch (\PDOException $error) {
            exit("Product Insertion Error: " . $error->getMessage());
        }
    }

    public function delete(array $skus) {
        try {
            $count = 0;

            foreach($skus as $sku) {
                if (!$this->find($sku)) {
                    return $count;
                }
            }

            foreach ($skus as $sku) {
                $product = $this->find($sku);
                $productInstance = $this->getInstance($product->type);
                
                $query = $productInstance->getDeleteQuery();

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
        } catch (\PDOException $error) {
            exit("Product Deletion Error: " . $error->getMessage());
        }
    }
}