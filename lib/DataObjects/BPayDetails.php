<?php
namespace PromisePay\DataObjects;
/**
 * Class BPayDetails
 * @package PromisePay\DataObjects
 */
class BPayDetails
{

    /**
     * @var
     */
    private $_billerCode;
    /**
     * @var
     */
    private $_reference;
    /**
     * @var
     */
    private $_amount;
    /**
     * @var
     */
    private $_currency;

    public function __construct($jsonData = array())
    {
        if(count($jsonData)>0)
        {
            $this->_billerCode        = array_key_exists('biller_code', $jsonData)?$jsonData['biller_code']:'';
            $this->_reference         = array_key_exists('reference', $jsonData)?$jsonData['reference']:'';
            $this->_amount            = array_key_exists('amount', $jsonData)?$jsonData['amount']:'';
            $this->_currency          = array_key_exists('currency',$jsonData)?$jsonData['currency']:'';
        }
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->_amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getBillerCode()
    {
        return $this->_billerCode;
    }

    /**
     * @param mixed $billerCode
     */
    public function setBillerCode($billerCode)
    {
        $this->_billerCode = $billerCode;
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
    public function getReference()
    {
        return $this->_reference;
    }

    /**
     * @param mixed $reference
     */
    public function setReference($reference)
    {
        $this->_reference = $reference;
    }

}