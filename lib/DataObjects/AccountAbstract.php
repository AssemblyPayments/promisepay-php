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

    public function __construct()
    {
        parent::__construct();
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