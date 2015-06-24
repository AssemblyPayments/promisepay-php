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
            $this->_beneficiary           = array_key_exists('beneficiary', $jsonData)?$jsonData['beneficiary']:'';
            $this->_addressLine1          = array_key_exists('address_line1', $jsonData)?$jsonData['address_line1']:'';
            $this->_city                  = array_key_exists('city', $jsonData)?$jsonData['city']:'';
            $this->_state                 = array_key_exists('state', $jsonData)? $jsonData['state']:'';
            $this->_zip                   = array_key_exists('zip', $jsonData)?$jsonData['zip']:'';
            $this->_routingNumber         = array_key_exists('routing_number', $jsonData)?$jsonData['routing_number']:'';
            $this->_accountNumber         = array_key_exists('account_number', $jsonData)?$jsonData['account_number']:'';
            $this->_bankName              = array_key_exists('bank_name', $jsonData)?$jsonData['bank_name']:'';
            $this->_swift                 = array_key_exists('swift', $jsonData)?$jsonData['swift']:'';
            $this->_reference             = array_key_exists('reference', $jsonData)?$jsonData['reference']:'';
            $this->_amount                = array_key_exists('amount', $jsonData)?$jsonData['amount']:'';
            $this->_currency              = array_key_exists('currency', $jsonData)?$jsonData['currency']:'';
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