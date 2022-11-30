<?php

class Customer
{
    protected $id;
    protected ?string $name = null;
    protected ?string $address= null;
    protected ?string $phone= null;
    protected $birthday;
    protected ?string $status= null;
    protected ?string $email= null;
    protected ?string $gender= null;

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

    public static function createWithKeys($object): Customer
    {
        return self::create()->setId($object['id'])->setName($object['name'])->setAddress($object['address'])
            ->setPhone($object['phone'])->setBirthday($object['birthday'])->setStatus($object['status'])
            ->setEmail($object['email'])->setGender($object['gender']);
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
    public function setId($id = null): Customer
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Customer
     */
    public function setName(?string $name = null): Customer
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     * @return Customer
     */
    public function setAddress(?string $address = null): Customer
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return Customer
     */
    public function setPhone(?string $phone = null): Customer
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
    public function setBirthday($birthday = null)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return Customer
     */
    public function setStatus(?string $status = null): Customer
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Customer
     */
    public function setEmail(?string $email = null): Customer
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     * @return Customer
     */
    public function setGender(?string $gender = null): Customer
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
    public function setCity(?City $city): Customer
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
    public function setSkill(array $skill = []): Customer
    {
        $this->skill = $skill;
        return $this;
    }


}