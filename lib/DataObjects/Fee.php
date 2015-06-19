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
    public $_name;
    /**
     * @var
     */
    public $_feeType;
    /**
     * @var
     */
    public $_amount;
    /**
     * @var
     */
    public $_cap;
    /**
     * @var
     */
    public $_min;
    /**
     * @var
     */
    public $_max;
    /**
     * @var
     */
    public $_to;

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