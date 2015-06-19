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
    public $_PayPal;

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