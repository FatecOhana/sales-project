<?php

class SaleItem extends Product
{

    protected $id;
    protected $amount;
    protected $discount;
    protected $totalValue;

    /**
     * @param $amount
     * @param $discount
     * @param $description
     * @param $stock
     * @param $salePrice
     * @param $unit
     */
    public function __construct($amount, $discount, $name, $description, $stock, $salePrice, $unit)
    {
        parent::__construct($name, $description, $stock, $salePrice, $unit);

        $this->amount = $amount;
        $this->discount = $discount;
        $this->totalValue = $amount * $salePrice;
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
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
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
     */
    public function setDiscount($discount): void
    {
        $this->discount = $discount;
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
     */
    public function setTotalValue($totalValue): void
    {
        $this->totalValue = $totalValue;
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
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

}