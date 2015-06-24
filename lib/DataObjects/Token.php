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
    private $_currentUserID;
    /**
     * @var
     */
    private $_itemName;
    /**
     * @var
     */
    private $_amount;
    /**
     * @var
     */
    private $_sellerLastName;
    /**
     * @var
     */
    private $_sellerFirstName;
    /**
     * @var
     */
    private $_sellerCountry;
    /**
     * @var
     */
    private $_buyerLastName;
    /**
     * @var
     */
    private $_buyerFirstName;
    /**
     * @var
     */
    private $_buyerCountry;
    /**
     * @var
     */
    private $_sellerEmail;
    /**
     * @var
     */
    private $_buyerEmail;
    /**
     * @var
     */
    private $_externalItemId;
    /**
     * @var
     */
    private $_externalSellerId;
    /**
     * @var
     */
    private $_externalBuyerId;
    /**
     * @var
     */
    private $_feeIds;
    /**
     * @var
     */
    private $_paymentType;

    public function __construct($jsonData)
    {
       if (count($jsonData))
       {
           $this->_currentUserID    = array_key_exists('current_user_id', $jsonData) ? $jsonData['current_user_id'] : '';
           $this->_itemName         = array_key_exists('item_name', $jsonData) ? $jsonData['item_name'] : '';
           $this->_amount           = array_key_exists('amount', $jsonData) ? $jsonData['amount'] : '';
           $this->_externalItemId   = array_key_exists('external_item_id', $jsonData) ? $jsonData['external_item_id'] : '';
           $this->_paymentType      = array_key_exists('payment_type_id', $jsonData) ? $jsonData['payment_type_id'] : '';
           $this->_feeIds           = array_key_exists('fee_ids', $jsonData) ? $jsonData['fee_ids'] : '';
           $this->_sellerEmail      = array_key_exists('seller_email', $jsonData) ? $jsonData['seller_email'] : '';
           $this->_sellerFirstName  = array_key_exists('seller_firstname', $jsonData) ? $jsonData['seller_firstname'] : '';
           $this->_sellerLastName   = array_key_exists('seller_lastname', $jsonData) ? $jsonData['seller_lastname'] : '';
           $this->_sellerCountry    = array_key_exists('seller_country', $jsonData) ? $jsonData['seller_country'] : '';
           $this->_externalSellerId = array_key_exists('external_seller_id', $jsonData) ? $jsonData['external_seller_id'] : '';
           $this->_buyerEmail       = array_key_exists('buyer_email', $jsonData) ? $jsonData['buyer_email'] : '';
           $this->_buyerFirstName   = array_key_exists('buyer_firstname', $jsonData) ? $jsonData['buyer_firstname'] : '';
           $this->_buyerLastName    = array_key_exists('buyer_lastname', $jsonData) ? $jsonData['buyer_lastname'] : '';
           $this->_buyerCountry     = array_key_exists('buyer_country', $jsonData) ? $jsonData['buyer_country'] : '';
           $this->_externalBuyerId  = array_key_exists('external_buyer_id', $jsonData) ? $jsonData['external_buyer_id'] : '';
       }

    }
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