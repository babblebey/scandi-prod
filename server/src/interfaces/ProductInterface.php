<?php
namespace Src\Interfaces;

interface ProductInterface {
    /**
     * Sets Product Name
     *
     * @param string $name
     * @return void
     */
    public function setName($name);

    /**
     * Sets Product SKU
     *
     * @param string $sku
     * @return void
     */
    public function setSKU($sku);

    /**
     * Sets Product Price
     *
     * @param int $price
     * @return void
     */
    public function setPrice($price);

    /**
     * Sets Product Attribute (weight || size || dimensions)
     *
     * @param mixed $attr
     * @return void
     */
    public function setAttribute($attr);

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
     * Gets Product Attribute (weight || size || dimensions)
     *
     * @return string
     */
    public function getAttribute();

    /**
     * Gets Product SQL Query for Finding Product in DB
     *
     * @return string
     */
    public function getFindQuery($table);

    /**
     * Gets Product SQL Query for Inserting Product to DB
     *
     * @return string
     */
    public function getInsertQuery();

    /**
     * Gets Product SQL Query for Deleting Product from DB
     * 
     * @param string $table
     * @return string
     */
    public function getDeleteQuery($table);
}