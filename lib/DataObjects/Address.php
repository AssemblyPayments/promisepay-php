<?php
namespace PromisePay\DataObjects;
/**
 * Class Address
 * @package PromisePay\DataObjects
 */
class Address extends Object
{
    /**
     * @var
     */
    private $_addressLine1;
    /**
     * @var
     */
    private $_addressLine2;
    /**
     * @var
     */
    private $_postalCode;
    /**
     * @var
     */
    private $_city;
    /**
     * @var
     */
    private $_state;
    /**
     * @var
     */
    private $_country;

    public function __construct()
    {

    }
    /**
     * @return mixed
     */
    public function getAddressLine1()
    {
        return $this->_addressLine1;
    }

    /**
     * @param mixed $addressLine1
     */
    public function setAddressLine1($addressLine1)
    {
        $this->_addressLine1 = $addressLine1;
    }

    /**
     * @return mixed
     */
    public function getAddressLine2()
    {
        return $this->_addressLine2;
    }

    /**
     * @param mixed $addressLine2
     */
    public function setAddressLine2($addressLine2)
    {
        $this->_addressLine2 = $addressLine2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->_city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->_city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->_country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->_country = $country;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->_postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->_postalCode = $postalCode;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

}