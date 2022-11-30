<?php

class Sale
{
    protected $id;
    protected $date;
    protected $total;
    protected ?string $obs = null;
    protected array $saleItems = [];

    protected Customer $customer;

    /**
     * Static constructor / factory
     */
    public static function create()
    {
        return new self();
    }


    public function __construct()
    {
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
     * @return Sale
     */
    public function setId($id = null): Sale
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return Sale
     */
    public function setDate($date = null): Sale
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     * @return Sale
     */
    public function setTotal($total = null): Sale
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return string
     */
    public function getObs(): ?string
    {
        return $this->obs;
    }

    /**
     * @param string|null $obs
     * @return Sale
     */
    public function setObs(string $obs = null): Sale
    {
        $this->obs = $obs;
        return $this;
    }

    /**
     * @return array
     */
    public function getSaleItems(): array
    {
        return $this->saleItems;
    }

    /**
     * @param array $saleItems
     * @return Sale
     */
    public function setSaleItems(array $saleItems = []): Sale
    {
        $this->saleItems = $saleItems;
        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     * @return Sale
     */
    public function setCustomer(Customer $customer = null): Sale
    {
        $this->customer = $customer;
        return $this;
    }

    public function calculateTotalSale(): float
    {
        if (!is_array($this->getSaleItems())) {
            return 0.0;
        }

        $value = 0.0;
        foreach ($this->getSaleItems() as &$item) {
            if(!is_null($item) && !is_null($item->getTotalValue())){
                $value += $item->getTotalValue();
            }
        }

        return $value;
    }

}