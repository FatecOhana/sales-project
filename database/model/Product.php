<?php

class Product
{
    protected $description;
    protected $stock;
    protected $salePrice;
    protected $unit;

    /**
     * @param $description
     * @param $stock
     * @param $salePrice
     * @param $unit
     */
    public function __construct($description, $stock, $salePrice, $unit)
    {
        $this->description = $description;
        $this->stock = $stock;
        $this->salePrice = $salePrice;
        $this->unit = $unit;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return mixed
     */
    public function getSalePrice()
    {
        return $this->salePrice;
    }

    /**
     * @param mixed $salePrice
     */
    public function setSalePrice($salePrice)
    {
        $this->salePrice = $salePrice;
    }

    /**
     * @return mixed
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param mixed $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

}
