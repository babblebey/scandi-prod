<?php
namespace Src\Interfaces;

interface ProductInterface {
    /**
     * Gets Product Name
     *
     * @return string
     */
    public function getName();

    /**
     * Gets Product SKU
     *
     * @return string
     */
    public function getSKU();

    /**
     * Gets Product Price
     *
     * @return int
     */
    public function getPrice();

    /**
     * Gets Product Special Attribute (weight || size || dimension)
     *
     * @return string
     */
    public function getSpecialAttribute();

    /**
     * Gets Product SQL Query for Inserting Product to DB
     *
     * @return string
     */
    public function getInsertQuery();

    /**
     * Gets Product SQL Query for Deleting Product from DB
     *
     * @return string
     */
    public function getDeleteQuery();
}