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
    public function __construct($name, $email, $phoneNumber, $address)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }


}