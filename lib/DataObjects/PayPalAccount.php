<?php
namespace PromisePay\DataObjects;
/**
 * Class PayPalAccount
 * @package PromisePay\DataObjects
 */
class PayPalAccount extends AccountAbstract
{
    /**
     * @var
     */
    private $_PayPal;

    public function __construct($jsonData)
    {
        $this->_PayPal = new PayPal($jsonData);
        parent::__construct($jsonData);
    }
    /**
     * @return mixed
     */
    public function getPayPal()
    {
        return $this->_PayPal;
    }

    /**
     * @param mixed $PayPal
     */
    public function setPayPal($PayPal)
    {
        $this->_PayPal = $PayPal;
    }

}