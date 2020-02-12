<?php


namespace delocal\Contacts\model;


class ContactGatewayDTO
{
    protected $name;
    protected $email;
    protected $phoneNumber;
    protected $address;

    /**
     * ContactGatewayDTO constructor.
     * @param $name
     * @param $email
     * @param $phoneNumber
     * @param $address
     */
    public function __construct(string $name, string  $email, string $phoneNumber, string $address)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber() : string
    {
        return $this->phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getAddress() : string
    {
        return $this->address;
    }


}