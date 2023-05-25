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
     * Sets Product Special Attribute (weight || size || dimension)
     *
     * @param int||string $attr
     * @return void
     */
    public function setSpecialAttribute($attr);

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
     * @param string $table
     * @return string
     */
    public function getDeleteQuery($table);
}