<?php

class City
{
    protected $id;
    protected $name;

    /**
     * @param $name
     */
    public function __construct()
    {
    }

    public static function create()
    {
        return new self();
    }

    public static function createWithParams($name)
    {
        return self::create()->setName($name);
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
     * @return City
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}
