<?php 
namespace Src\Models;

use Src\Interfaces\ProductInterface;

abstract class Product implements ProductInterface {
    protected $name;
    protected $sku;
    protected $price;

    public function __construct($name, $sku, $price) {
        $this->name = $name;
        $this->sku = $sku;
        $this->price = $price;
    }

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

    abstract public function getDeleteQuery();
}
