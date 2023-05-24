<?php
namespace Src\Interfaces;

interface ProductHandlerInterface {
    /**
     * Gets an Instance of the Product Class/Model with the Product Type
     *
     * @param string $productType
     * @param array $params
     * @return object
     */
    public function getInstance($productType, array $params);

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
     * @return void
     */
    public function delete();
    
}