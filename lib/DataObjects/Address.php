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

    public function __construct($jsonData = array())
    {
        if (count($jsonData))
        {
            $this->_addressLine1 = array_key_exists('address_line1', $jsonData) ? $jsonData['address_line1'] : '';
            $this->_addressLine2 = array_key_exists('address_line2', $jsonData) ? $jsonData['address_line2'] : '';
            $this->_postalCode = array_key_exists('postal_code', $jsonData) ? $jsonData['postal_code'] : '';
            $this->_city = array_key_exists('city', $jsonData) ? $jsonData['city'] : '';
            $this->_state = array_key_exists('stats', $jsonData) ? $jsonData['state'] : '';
            $this->_country = array_key_exists('country', $jsonData) ? $jsonData['country'] : '';
        }
        parent::__construct($jsonData);

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