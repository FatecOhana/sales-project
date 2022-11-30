<?php

class Product
{
    protected $id;
    protected string $name;
    protected string $description;
    protected $stock;
    protected $salePrice;
    protected $unit;

    public function __construct()
    {
    }

    public static function create(): Product
    {
        return new self();
    }

    public static function createWithParams($name, $description, $stock, $salePrice, $unit): Product
    {
        return self::create()->setName($name)->setDescription($description)->setStock($stock)
            ->setSalePrice($salePrice)->setUnit($unit);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Product
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Product
     */
    public function setDescription(string $description): Product
    {
        $this->description = $description;
        return $this;
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
     * @return Product
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
        return $this;
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
     * @return Product
     */
    public function setSalePrice($salePrice)
    {
        $this->salePrice = $salePrice;
        return $this;
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
     * @return Product
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

}
