<?php

class Sale
{
    protected $id;
    protected $date;
    protected $total;
    protected string $obs;
    protected array $saleItems = [];

    protected Customer $customer;

    /**
     * @param $date
     * @param $total
     * @param string $obs
     * @param array $saleItems
     * @param Customer $customer
     */
    public function __construct($date, $total, string $obs, array $saleItems, Customer $customer)
    {
        $this->date = $date;
        $this->total = $total;
        $this->obs = $obs;
        $this->saleItems = $saleItems;
        $this->customer = $customer;
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
     */
    public function setDate($date): void
    {
        $this->date = $date;
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
     */
    public function setTotal($total): void
    {
        $this->total = $total;
    }

    /**
     * @return string
     */
    public function getObs(): string
    {
        return $this->obs;
    }

    /**
     * @param string $obs
     */
    public function setObs(string $obs): void
    {
        $this->obs = $obs;
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
     */
    public function setSaleItems(array $saleItems): void
    {
        $this->saleItems = $saleItems;
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
     */
    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
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