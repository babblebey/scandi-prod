<?php
namespace Src\Interfaces;

interface ProductHandlerInterface {
    /**
     * Gets an Instance of the Product Class/Model with the Product Type
     *
     * @param string $productType
     * @return object
     */
    public function getInstance($productType);

    /**
     * Gets A Single Product from DB with its sku
     *
     * @param string $sku
     * @return object
     */
    public function find($sku);

    /**
     * Gets All Product from DB
     *
     * @return object
     */
    public function findAll();
    
    /**
     * Adds a New Product to DB
     *
     * @param array $productDetails
     * @param string $productType
     * @return void
     */
    public function insert(array $productDetails, $productType);

    /**
     * Deletes a Product from DB
     *
     * @param array $skus
     * @return void
     */
    public function delete($skus);
    
}