<?php
namespace PromisePay\DataObjects;
/**
 * Class Fee
 * @package PromisePay\DataObjects
 */
class Fee extends Object
{
    /**
     * @var
     */
    private $_name;
    /**
     * @var
     */
    private $_feeType;
    /**
     * @var
     */
    private $_amount;
    /**
     * @var
     */
    private $_cap;
    /**
     * @var
     */
    private $_min;
    /**
     * @var
     */
    private $_max;
    /**
     * @var
     */
    private $_to;

    public function __construct($jsonData = array())
    {
        if(count($jsonData)>0)
        {
            $this->_name         = array_key_exists('name',$jsonData)?$jsonData['name']:'';
            $this->_feeType      = array_key_exists('fee_type', $jsonData)?$jsonData['fee_type']:'';
            $this->_amount       = array_key_exists('amount', $jsonData)?$jsonData['amount']:'';
            $this->_cap          = array_key_exists('cap', $jsonData)?$jsonData['cap']:'';
            $this->_min          = array_key_exists('min',$jsonData)?$jsonData['min']:'';
            $this->_max          = array_key_exists('max', $jsonData)?$jsonData['max']:'';
            $this->_to           = array_key_exists('to', $jsonData)?$jsonData['to']:'';
        }
        parent::__construct($jsonData);
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
    public function getCap()
    {
        return $this->_cap;
    }

    /**
     * @param mixed $cap
     */
    public function setCap($cap)
    {
        $this->_cap = $cap;
    }

    /**
     * @return mixed
     */
    public function getFeeType()
    {
        return $this->_feeType;
    }

    /**
     * @param mixed $feeType
     */
    public function setFeeType($feeType)
    {
        $this->_feeType = $feeType;
    }

    /**
     * @return mixed
     */
    public function getMax()
    {
        return $this->_max;
    }

    /**
     * @param mixed $max
     */
    public function setMax($max)
    {
        $this->_max = $max;
    }

    /**
     * @return mixed
     */
    public function getMin()
    {
        return $this->_min;
    }

    /**
     * @param mixed $min
     */
    public function setMin($min)
    {
        $this->_min = $min;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->_to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->_to = $to;
    }

}