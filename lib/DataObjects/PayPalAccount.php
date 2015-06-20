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

    public function __construct()
    {
        parent::__construct();
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