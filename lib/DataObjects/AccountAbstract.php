<?php

namespace PromisePay\DataObjects;

/**
 * Class AccountAbstract
 * @package PromisePay\DataObjects
 */
class AccountAbstract extends Object
{
    /**
     * @var
     */
    private   $_currency;
    /**
     * @var
     */
    private  $_userId;
    /**
     * @var
     */
    private  $_isActive;

    public function __construct($jsonData = array())
    {
        if (count($jsonData))
        {
            $this->_currency = array_key_exists('currency', $jsonData) ? $jsonData['currency'] : '';
            $this->_userId = array_key_exists('userId', $jsonData) ? $jsonData['userId'] : '';
            $this->_isActive = array_key_exists('is_active', $jsonData) ? $jsonData['is_active'] : '';
        }
        parent::__construct($jsonData);
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

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->_isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->_isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->_userId = $userId;
    }

}