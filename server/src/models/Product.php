<?php 
namespace Src\Models;

use Src\Interfaces\ProductInterface;

abstract class Product implements ProductInterface {
    protected $name;
    protected $sku;
    protected $price;

    public function setName($name) {
        $this->name = $name;
    }

    public function setSKU($sku) {
        $this->sku = $sku;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    abstract public function setSpecialAttribute($attr);

    public function getName() {
        return $this->name;
    }

    public function getSKU() {
        return $this->sku;
    }

    public function getPrice() {
        return $this->price;
    }

    abstract public function getSpecialAttribute();

    abstract public function getInsertQuery();

    abstract public function getDeleteQuery($table);
}
