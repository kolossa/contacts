<?php


namespace delocal\Contacts\model;


class ContactGatewayDTO
{
    protected $id;
    protected $name;
    protected $email;
    protected $phoneNumber;
    protected $address;

    /**
     * ContactGatewayDTO constructor.
     * @param $id
     * @param string $name
     * @param string $email
     * @param string $phoneNumber
     * @param string $address
     */
    public function __construct(?int $id, string $name, string $email, string $phoneNumber, string $address)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getAddress(): string
    {
        return $this->address;
    }


}