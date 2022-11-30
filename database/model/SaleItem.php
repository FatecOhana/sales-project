<?php
require_once __DIR__ . "/../../database/model/Product.php";

class SaleItem extends Product
{

    protected $id;
    protected $amount;
    protected $discount;
    protected $totalValue;

    public function __construct()
    {
        parent::__construct();
    }

    public static function create(): SaleItem
    {
        return new self();
    }

    public static function createWithParams2($name, $description, $stock, $salePrice, $unit, $amount, $discount): SaleItem
    {
        return self::create()->setAmount($amount)->setDiscount($discount)->setTotalValue($amount * $salePrice)
            // Inhertance
            ->setName($name)->setDescription($description)->setStock($stock)->setSalePrice($salePrice)->setUnit($unit);
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
     * @return SaleItem
     */
    public function setId($id = null): SaleItem
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     * @return SaleItem
     */
    public function setAmount($amount = null): SaleItem
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param mixed $discount
     * @return SaleItem
     */
    public function setDiscount($discount = null): SaleItem
    {
        $this->discount = $discount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalValue()
    {
        return $this->totalValue;
    }

    /**
     * @param mixed $totalValue
     * @return SaleItem
     */
    public function setTotalValue($totalValue = null): SaleItem
    {
        $this->totalValue = $totalValue;
        return $this;
    }


}