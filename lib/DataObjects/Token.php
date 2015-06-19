<?php
namespace PromisePay\DataObjects;

/**
 * Class Token
 * @package PromisePay\DataObjects
 */
class Token
{
    /**
     * @var
     */
    public $_currentUserID;
    /**
     * @var
     */
    public $_itemName;
    /**
     * @var
     */
    public $_amount;
    /**
     * @var
     */
    public $_sellerLastName;
    /**
     * @var
     */
    public $_sellerFirstName;
    /**
     * @var
     */
    public $_sellerCountry;
    /**
     * @var
     */
    public $_buyerLastName;
    /**
     * @var
     */
    public $_buyerFirstName;
    /**
     * @var
     */
    public $_buyerCountry;
    /**
     * @var
     */
    public $_sellerEmail;
    /**
     * @var
     */
    public $_buyerEmail;
    /**
     * @var
     */
    public $_externalItemId;
    /**
     * @var
     */
    public $_externalSellerId;
    /**
     * @var
     */
    public $_externalBuyerId;
    /**
     * @var
     */
    public $_feeIds;
    /**
     * @var
     */
    public $_paymentType;

    /**
     * @return mixed
     */
    public function getCurrentUserID()
    {
        return $this->_currentUserID;
    }

    /**
     * @param mixed $currentUserID
     */
    public function setCurrentUserID($currentUserID)
    {
        $this->_currentUserID = $currentUserID;
    }

    /**
     * @return mixed
     */
    public function getItemName()
    {
        return $this->_itemName;
    }

    /**
     * @param mixed $itemName
     */
    public function setItemName($itemName)
    {
        $this->_itemName = $itemName;
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
    public function getSellerLastName()
    {
        return $this->_sellerLastName;
    }

    /**
     * @param mixed $sellerLastName
     */
    public function setSellerLastName($sellerLastName)
    {
        $this->_sellerLastName = $sellerLastName;
    }

    /**
     * @return mixed
     */
    public function getSellerFirstName()
    {
        return $this->_sellerFirstName;
    }

    /**
     * @param mixed $sellerFirstName
     */
    public function setSellerFirstName($sellerFirstName)
    {
        $this->_sellerFirstName = $sellerFirstName;
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

    /**
     * @return mixed
     */
    public function getBuyerLastName()
    {
        return $this->_buyerLastName;
    }

    /**
     * @param mixed $buyerLastName
     */
    public function setBuyerLastName($buyerLastName)
    {
        $this->_buyerLastName = $buyerLastName;
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
    public function getBuyerFirstName()
    {
        return $this->_buyerFirstName;
    }

    /**
     * @param mixed $buyerFirstName
     */
    public function setBuyerFirstName($buyerFirstName)
    {
        $this->_buyerFirstName = $buyerFirstName;
    }

    /**
     * @return mixed
     */
    public function getExternalItemId()
    {
        return $this->_externalItemId;
    }

    /**
     * @param mixed $externalItemId
     */
    public function setExternalItemId($externalItemId)
    {
        $this->_externalItemId = $externalItemId;
    }

    /**
     * @return mixed
     */
    public function getExternalSellerId()
    {
        return $this->_externalSellerId;
    }

    /**
     * @param mixed $externalSellerId
     */
    public function setExternalSellerId($externalSellerId)
    {
        $this->_externalSellerId = $externalSellerId;
    }

    /**
     * @return mixed
     */
    public function getExternalBuyerId()
    {
        return $this->_externalBuyerId;
    }

    /**
     * @param mixed $externalBuyerId
     */
    public function setExternalBuyerId($externalBuyerId)
    {
        $this->_externalBuyerId = $externalBuyerId;
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
}