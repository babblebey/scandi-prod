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
     * @uses getInstance()
     *
     * @param array $productDetails
     * @return int number of inserted rows
     */
    public function insert(array $productDetails);

    /**
     * Deletes a Product from DB
     *
     * @uses find()
     * @uses getInstance()
     *
     * @param array $skus
     * @return int number of deleted rows
     */
    public function delete(array $skus);
    
}