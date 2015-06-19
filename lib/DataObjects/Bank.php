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
    public $_bankName;
    /**
     * @var
     */
    public $_country;
    /**
     * @var
     */
    public $_accountName;
    /**
     * @var
     */
    public $_routingNumber;
    /**
     * @var
     */
    public $_accountNumber;
    /**
     * @var
     */
    public $_holderType;
    /**
     * @var
     */
    public $_accountType;

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