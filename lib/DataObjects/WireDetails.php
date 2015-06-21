<?php
namespace PromisePay\DataObjects;
class WireDetails
{
    private $_beneficiary;
    private $_addressLine1;
    private $_city;
    private $_state;
    private $_zip;
    private $_routingNumber;
    private $_accountNumber;
    private $_bankName;
    private $_swift;
    private $_reference;
    private $_amount;
    private $_currency;

    public function __construct($jsonData = array())
    {
        if(count($jsonData)>0)
        {
            $this->_beneficiary           = $jsonData['beneficiary'];
            $this->_addressLine1          = $jsonData['address_line1'];
            $this->_city                  = $jsonData['city'];
            $this->_state                 = $jsonData['state'];
            $this->_zip                   = $jsonData['zip'];
            $this->_routingNumber         = $jsonData['routing_number'];
            $this->_accountNumber         = $jsonData['account_number'];
            $this->_bankName              = $jsonData['bank_name'];
            $this->_swift                 = $jsonData['swift'];
            $this->_reference             = $jsonData['reference'];
            $this->_amount                = $jsonData['amount'];
            $this->_currency              = $jsonData['currency'];
        }
    }
    /**
     * @return mixed
     */
    public function getBeneficiary()
    {
        return $this->_beneficiary;
    }

    /**
     * @param mixed $beneficiary
     */
    public function setBeneficiary($beneficiary)
    {
        $this->_beneficiary = $beneficiary;
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

    /**
     * @return mixed
     */
    public function getRoutingNumber()
    {
        return $this->_routingNumber;
    }

    /**
     * @param mixed $routingNumber
     */
    public function setRoutingNumber($routingNumber)
    {
        $this->_routingNumber = $routingNumber;
    }

    /**
     * @return mixed
     */
    public function getAccountNumber()
    {
        return $this->_accountNumber;
    }

    /**
     * @param mixed $accountNumber
     */
    public function setAccountNumber($accountNumber)
    {
        $this->_accountNumber = $accountNumber;
    }

    /**
     * @return mixed
     */
    public function getBankName()
    {
        return $this->_bankName;
    }

    /**
     * @param mixed $bankName
     */
    public function setBankName($bankName)
    {
        $this->_bankName = $bankName;
    }

    /**
     * @return mixed
     */
    public function getSwift()
    {
        return $this->_swift;
    }

    /**
     * @param mixed $swift
     */
    public function setSwift($swift)
    {
        $this->_swift = $swift;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->_reference;
    }

    /**
     * @param mixed $reference
     */
    public function setReference($reference)
    {
        $this->_reference = $reference;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->_amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->_currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->_currency = $currency;
    }
}