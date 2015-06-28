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
    private $_PayPalAccountEmail;
    /**
     * @var array
     */

    public function __construct($jsonData = array())
    {
        $jsonData = $jsonData['paypal'];
        $this->_PayPalAccountEmail = array_key_exists('email', $jsonData)?$jsonData['email']:'';
    }

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