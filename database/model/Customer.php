<?php

class Customer
{
    protected $id;
    protected string $name;
    protected string $address;
    protected string $phone;
    protected $birthday;
    protected string $status;
    protected string $email;
    protected string $gender;

    // one item
    protected City $city;

    // none or many items
    protected array $skill = [];

    public function __construct()
    {
    }

    public static function create(): Customer
    {
        return new self();
    }

    public static function createWithParam(string $name, string $address, string $phone, $birthday, string $status,
                                           string $email, string $gender): Customer
    {
        return self::create()->setName($name)->setAddress($address)->setPhone($phone)->setBirthday($birthday)->
        setStatus($status)->setEmail($email)->setGender($gender);
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
     * @return Customer
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
     * @return Customer
     */
    public function setName(string $name): Customer
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Customer
     */
    public function setAddress(string $address): Customer
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Customer
     */
    public function setPhone(string $phone): Customer
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     * @return Customer
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Customer
     */
    public function setStatus(string $status): Customer
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Customer
     */
    public function setEmail(string $email): Customer
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return Customer
     */
    public function setGender(string $gender): Customer
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return City
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * @param City $city
     * @return Customer
     */
    public function setCity(City $city): Customer
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return array
     */
    public function getSkill(): array
    {
        return $this->skill;
    }

    /**
     * @param array $skill
     * @return Customer
     */
    public function setSkill(array $skill): Customer
    {
        $this->skill = $skill;
        return $this;
    }


}