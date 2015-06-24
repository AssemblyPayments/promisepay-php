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

    public function __construct($jsonData)
    {
        if (count($jsonData))
        {
            $this->_legalName    = array_key_exists('legal_name',    $jsonData)?$jsonData['legal_name']:'';
            $this->_name         = array_key_exists('name',          $jsonData)?$jsonData['name']:'';
            $this->_taxNumber    = array_key_exists('tax_number',    $jsonData)?$jsonData['tax_number']:'';
            $this->_chargeTax    = array_key_exists('charge_tax',    $jsonData)?$jsonData['charge_tax']:'';
            $this->_addressLine1 = array_key_exists('address_line1', $jsonData)?$jsonData['address_line1']:'';
            $this->_addressLine2 = array_key_exists('address_line2', $jsonData)?$jsonData['address_line2']:'';
            $this->_city         = array_key_exists('city',          $jsonData)?$jsonData['city']:'';
            $this->_state        = array_key_exists('state',         $jsonData)?$jsonData['state']:'';
            $this->_zip          = array_key_exists('zip',           $jsonData)?$jsonData['zip']:'';
            $this->_country      = array_key_exists('country',       $jsonData)?$jsonData['country']:'';
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