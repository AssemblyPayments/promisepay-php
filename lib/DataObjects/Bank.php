<?php
namespace PromisePay\DataObjects;
/**
 * Class Bank
 * @package PromisePay\DataObjects
 */
class Bank
{
    /**
     * @var
     */
    private $_bankName;
    /**
     * @var
     */
    private $_country;
    /**
     * @var
     */
    private $_accountName;
    /**
     * @var
     */
    private $_routingNumber;
    /**
     * @var
     */
    private $_accountNumber;
    /**
     * @var
     */
    private $_holderType;
    /**
     * @var
     */
    private $_accountType;

    public function __construct($jsonData = array())
    {
        $jsonData = $jsonData['bank'];
        if (count($jsonData))
        {
            $this->_bankName      = array_key_exists('bank_name',      $jsonData)?$jsonData['bank_name']:'';
            $this->_country       = array_key_exists('bank_country',   $jsonData)?$jsonData['bank_country']:'';
            $this->_accountName   = array_key_exists('account_name',   $jsonData)?$jsonData['account_name']:'' ;
            $this->_accountNumber = array_key_exists('account_number', $jsonData)?$jsonData['account_number']:'';
            $this->_accountType   = array_key_exists('account_type',   $jsonData)?$jsonData['account_type']:'';
            $this->_holderType    = array_key_exists('holder_type',    $jsonData)?$jsonData['holder_type']:'';
            $this->_routingNumber = array_key_exists('routing_number', $jsonData)?$jsonData['routing_number']:'';
        }
    }

    /**
     * @return mixed
     */
    public function getAccountName()
    {
        return $this->_accountName;
    }

    /**
     * @param mixed $accountName
     */
    public function setAccountName($accountName)
    {
        $this->_accountName = $accountName;
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
    public function getAccountType()
    {
        return $this->_accountType;
    }

    /**
     * @param mixed $accountType
     */
    public function setAccountType($accountType)
    {
        $this->_accountType = $accountType;
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
    public function getHolderType()
    {
        return $this->_holderType;
    }

    /**
     * @param mixed $holderType
     */
    public function setHolderType($holderType)
    {
        $this->_holderType = $holderType;
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



}