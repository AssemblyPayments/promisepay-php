<?php
namespace PromisePay\DataObjects;

/**
 * Class Transaction
 * @package PromisePay\DataObjects
 */
class Transaction extends Object
{
    /**
     * @var
     */
    private $_description;
    /**
     * @var
     */
    private $_amount;
    /**
     * @var
     */
    private $_currency;
    /**
     * @var
     */
    private $_type;
    /**
     * @var
     */
    private $_from;
    /**
     * @var
     */
    private $_to;
    /**
     * @var
     */
    private $_related;

    public function __construct($jsonData)
    {
        if(count($jsonData))
        {
            $this->_description         = array_key_exists('description',$jsonData)?$jsonData['description']:'';
            $this->_amount              = array_key_exists('amount',$jsonData)?$jsonData['amount']:'';
            $this->_currency            = array_key_exists('currency', $jsonData)?$jsonData['currency']:'';
            $this->_type                = array_key_exists('type', $jsonData)?$jsonData['type']:'';
            $this->_from                = array_key_exists('from', $jsonData)?$jsonData['from']:'';
            $this->_to                  = array_key_exists('to',$jsonData)?$jsonData['to']:'';
            $this->_related             = array_key_exists('related',$jsonData)?$jsonData['related']:'';
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
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->_from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->_from = $from;
    }

    /**
     * @return mixed
     */
    public function getRelated()
    {
        return $this->_related;
    }

    /**
     * @param mixed $related
     */
    public function setRelated($related)
    {
        $this->_related = $related;
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

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->_type = $type;
    }

}