<?php
namespace PromisePay\DataObjects;

/**
 * Class Item
 * @package PromisePay\DataObjects
 */
class Item extends Object
{
    /**
     * @var
     */
    private $_name;
    /**
     * @var
     */
    private $_description;
    /**
     * @var
     */
    private $_state;
    /**
     * @var
     */
    private $_depositReference;
    /**
     * @var
     */
    private $_paymentType;
    /**
     * @var
     */
    private $_status;
    /**
     * @var
     */
    private $_amount;
    /**
     * @var
     */
    private $_buyerId;
    /**
     * @var
     */
    private $_buyerName;
    /**
     * @var
     */
    private $_buyerCountry;
    /**
     * @var
     */
    private $_buyerEmail;
    /**
     * @var
     */
    private $_sellerId;
    /**
     * @var
     */
    private $_SellerName;
    /**
     * @var
     */
    private $_sellerCountry;
    /**
     * @var
     */
    private $_sellerEmail;
    /**
     * @var
     */
    private $_currency;
    /**
     * @var
     */
    private $_fees;
    /**
     * @var
     */
    private $_feeIds;

    public function __construct()
    {

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
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return mixed
     */
    public function getDepositReference()
    {
        return $this->_depositReference;
    }

    /**
     * @param mixed $depositReference
     */
    public function setDepositReference($depositReference)
    {
        $this->_depositReference = $depositReference;
    }

    /**
     * @return mixed
     */
    public function getPaymentType()
    {
        return $this->_paymentType;
    }

    /**
     * @param mixed $paymentType
     */
    public function setPaymentType($paymentType)
    {
        $this->_paymentType = $paymentType;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->_status = $status;
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
    public function getBuyerId()
    {
        return $this->_buyerId;
    }

    /**
     * @param mixed $buyerId
     */
    public function setBuyerId($buyerId)
    {
        $this->_buyerId = $buyerId;
    }

    /**
     * @return mixed
     */
    public function getBuyerName()
    {
        return $this->_buyerName;
    }

    /**
     * @param mixed $buyerName
     */
    public function setBuyerName($buyerName)
    {
        $this->_buyerName = $buyerName;
    }

    /**
     * @return mixed
     */
    public function getBuyerCountry()
    {
        return $this->_buyerCountry;
    }

    /**
     * @param mixed $buyerCountry
     */
    public function setBuyerCountry($buyerCountry)
    {
        $this->_buyerCountry = $buyerCountry;
    }

    /**
     * @return mixed
     */
    public function getSellerId()
    {
        return $this->_sellerId;
    }

    /**
     * @param mixed $sellerId
     */
    public function setSellerId($sellerId)
    {
        $this->_sellerId = $sellerId;
    }

    /**
     * @return mixed
     */
    public function getSellerName()
    {
        return $this->_SellerName;
    }

    /**
     * @param mixed $SellerName
     */
    public function setSellerName($SellerName)
    {
        $this->_SellerName = $SellerName;
    }

    /**
     * @return mixed
     */
    public function getSellerEmail()
    {
        return $this->_sellerEmail;
    }

    /**
     * @param mixed $sellerEmail
     */
    public function setSellerEmail($sellerEmail)
    {
        $this->_sellerEmail = $sellerEmail;
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
    public function getFees()
    {
        return $this->_fees;
    }

    /**
     * @param mixed $fees
     */
    public function setFees($fees)
    {
        $this->_fees = $fees;
    }

    /**
     * @return mixed
     */
    public function getFeeIds()
    {
        return $this->_feeIds;
    }

    /**
     * @param mixed $feeIds
     */
    public function setFeeIds($feeIds)
    {
        $this->_feeIds = $feeIds;
    }

    /**
     * @return mixed
     */
    public function getBuyerEmail()
    {
        return $this->_buyerEmail;
    }

    /**
     * @param mixed $buyerEmail
     */
    public function setBuyerEmail($buyerEmail)
    {
        $this->_buyerEmail = $buyerEmail;
    }

    /**
     * @return mixed
     */
    public function getSellerCountry()
    {
        return $this->_sellerCountry;
    }

    /**
     * @param mixed $sellerCountry
     */
    public function setSellerCountry($sellerCountry)
    {
        $this->_sellerCountry = $sellerCountry;
    }
}