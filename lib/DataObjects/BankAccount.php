<?php
namespace PromisePay\DataObjects;

/**
 * Class BankAccount
 * @package PromisePay\DataObjects
 */
class BankAccount extends AccountAbstract
{
    private $_bank;
    
    public function __construct($jsonData) {
        $this->_bank = new Bank($jsonData);
        parent::__construct($jsonData);
    }
    
    /**
     * @return mixed
     */
    public function getBank() {
        return $this->_bank;
    }
    
    /**
     * @param mixed $bank
     */
    public function setBank($bank) {
        $this->_bank = $bank;
    }
}
