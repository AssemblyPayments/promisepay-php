<?php
namespace PromisePay\DataObjects;

/**
 * Class PayPal
 * @package PromisePay\DataObjects
 */
class PayPal
{
    /**
     * @var
     */
    public $_PayPalAccountEmail;

    /**
     * @return mixed
     */
    public function getPayPalAccountEmail()
    {
        return $this->_PayPalAccountEmail;
    }

    /**
     * @param mixed $PayPalAccountEmail
     */
    public function setPayPalAccountEmail($PayPalAccountEmail)
    {
        $this->_PayPalAccountEmail = $PayPalAccountEmail;
    }

}