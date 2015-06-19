<?php

namespace PromisePay\DataObjects;

/**
 * Class BankAccount
 * @package PromisePay\DataObjects
 */
class BankAccount extends AccountAbstract
{
    /**
     * @var
     */
    public $_bank;

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