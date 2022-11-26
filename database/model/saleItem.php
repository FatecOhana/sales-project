<?php

class SaleItem extends Product
{

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
    public function __construct($amount, $discount, $description, $stock, $salePrice, $unit)
    {
        parent::__construct($description, $stock, $salePrice, $unit);

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

}