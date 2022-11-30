<?php

class Skill
{

    protected $id;
    protected $name;

    public function __construct()
    {
    }

    public static function create(): Skill
    {
        return new self();
    }

    public static function createWithParam($name): Skill
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
     * @return Skill
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
     * @return Skill
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}
