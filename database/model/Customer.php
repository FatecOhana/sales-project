<?php

class Customer
{
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

    /**
     * @param string $name
     * @param string $address
     * @param string $phone
     * @param $birthday
     * @param string $status
     * @param string $email
     * @param string $gender
     * @param City $city
     * @param array $skill
     */
    public function __construct(string $name, string $address, string $phone, $birthday, string $status, string $email, string $gender, City $city, array $skill)
    {
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->birthday = $birthday;
        $this->status = $status;
        $this->email = $email;
        $this->gender = $gender;
        $this->city = $city;
        $this->skill = $skill;
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
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
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
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
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
     */
    public function setBirthday($birthday): void
    {
        $this->birthday = $birthday;
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
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
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
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
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
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
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
     */
    public function setCity(City $city): void
    {
        $this->city = $city;
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
     */
    public function setSkill(array $skill): void
    {
        $this->skill = $skill;
    }

}