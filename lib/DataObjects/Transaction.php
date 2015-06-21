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

    public function __construct()
    {
        if(count($jsonData = array()))
        {
            $this->_description         = $jsonData['description'];
            $this->_amount              = $jsonData['amount'];
            $this->_currency            = $jsonData['currency'];
            $this->_type                = $jsonData['type'];
            $this->_from                = $jsonData['from'];
            $this->_to                  = $jsonData['to'];
            $this->_related             = $jsonData['related'];
        }
        parent::__construct();
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