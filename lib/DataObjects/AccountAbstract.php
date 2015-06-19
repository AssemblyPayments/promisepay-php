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
    public  $_currency;
    /**
     * @var
     */
    public  $_userId;
    /**
     * @var
     */
    public  $_isActive;

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