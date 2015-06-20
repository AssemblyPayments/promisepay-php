<?php
namespace PromisePay\DataObjects;
/**
 * Class Company
 * @package PromisePay\DataObjects
 */
class Company extends Object
{
    /**
     * @var
     */
    private $_legalName;
    /**
     * @var
     */
    private $_name;
    /**
     * @var
     */
    private $_taxNumber;
    /**
     * @var
     */
    private $_chargeTax;
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
    private $_city;
    /**
     * @var
     */
    private $_state;
    /**
     * @var
     */
    private $_zip;
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
    public function getChargeTax()
    {
        return $this->_chargeTax;
    }

    /**
     * @param mixed $chargeTax
     */
    public function setChargeTax($chargeTax)
    {
        $this->_chargeTax = $chargeTax;
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
    public function getLegalName()
    {
        return $this->_legalName;
    }

    /**
     * @param mixed $legalName
     */
    public function setLegalName($legalName)
    {
        $this->_legalName = $legalName;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
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

    /**
     * @return mixed
     */
    public function getTaxNumber()
    {
        return $this->_taxNumber;
    }

    /**
     * @param mixed $taxNumber
     */
    public function setTaxNumber($taxNumber)
    {
        $this->_taxNumber = $taxNumber;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->_zip;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->_zip = $zip;
    }



}