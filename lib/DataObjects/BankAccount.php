<?php

namespace PromisePay\DataObjects;

/**
 * Class BankAccount
 * @package PromisePay\DataObjects
 */
class BankAccount extends AccountAbstract
{
    public function __construct()
    {

    }
    /**
     * @var
     */
    private $_bank;

    /**
     * @return mixed
     */
    public function getBank()
    {
        return $this->_bank;
    }

    /**
     * @param mixed $bank
     */
    public function setBank($bank)
    {
        $this->_bank = $bank;
    }
}