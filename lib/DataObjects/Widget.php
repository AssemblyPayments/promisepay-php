<?php
namespace PromisePay\DataObjects;

/**
 * Class Widget
 * @package PromisePay\DataObjects
 */
class Widget
{

    private $_itemName;

    private $_fullAmount;

    private $_amount;

    private $_fees;

    private $_feename;

    private $_remainingAmount;

    private $_releaseRequestAccount;

    private $_currency;

    private $_description;

    private $_actionName;

    private $_status;

    private $_hasPendingRelease;

    private $_verificationState;

    private $_verificationInformation;

    private $_disbursementAccount;

    private $_paymentMethod;

    private $_disputeUser;

    private $_role;

    private $_otherUsername;

    private $_primaryColor;

    private $_secondaryColor;

    private $_thirdColor;

    private $_fourthColor;

    private $_bankAccount;

    private $_taxInvoice;

    private $_buyerUrl;

    private $_sellerUrl;

    public function __construct($jsonData)
    {
        if (count($jsonData)) {
            $this->_itemName                = array_key_exists('item_name', $jsonData)?$jsonData['item_name']:'';
            $this->_fullAmount              = array_key_exists('full_amount', $jsonData)?$jsonData['full_amount']:'';
            $this->_amount                  = array_key_exists('amount', $jsonData)?$jsonData['amount']:'';
            $this->_fees                    = array_key_exists('fees', $jsonData)?$jsonData['fees']:'';
            $this->_feename                 = array_key_exists('fee_name', $jsonData)?$jsonData['fee_name']:'';
            $this->_remainingAmount         = array_key_exists('remaining_amount', $jsonData)?$jsonData['remaining_amount']:'';
            $this->_releaseRequestAccount   = array_key_exists('release_request_amount', $jsonData)?$jsonData['release_request_amount']:'';
            $this->_currency                = array_key_exists('currency', $jsonData)?$jsonData['currency']:'';
            $this->_description             = array_key_exists('description', $jsonData)?$jsonData['description']:'';
            $this->_actionName              = array_key_exists('action_name', $jsonData)?$jsonData['action_name']:'';
            $this->_status                  = array_key_exists('status', $jsonData)?$jsonData['status']:'';
            $this->_hasPendingRelease       = array_key_exists('has_pending_release', $jsonData)?$jsonData['has_pending_release']:'';
            $this->_verificationState       = array_key_exists('verification_state', $jsonData)?$jsonData['verification_state']:'';
            $this->_verificationInformation = array_key_exists('verification_information', $jsonData)?$jsonData['verification_information']:'';
            $this->_disbursementAccount     = array_key_exists('disbursement_account', $jsonData)?$jsonData['disbursement_account']:'';
            $this->_paymentMethod           = array_key_exists('payment_method', $jsonData)?$jsonData['payment_method']:'';
            $this->_disputeUser             = array_key_exists('dispute_user', $jsonData)?$jsonData['dispute_user']:'';
            $this->_role                    = array_key_exists('role', $jsonData)?$jsonData['role']:'';
            $this->_otherUsername           = array_key_exists('other_user_name', $jsonData)?$jsonData['other_user_name']:'';
            $this->_primaryColor            = array_key_exists('primary_color', $jsonData)?$jsonData['primary_color']:'';
            $this->_secondaryColor          = array_key_exists('secondary_color', $jsonData)?$jsonData['secondary_color']:'';
            $this->_thirdColor              = array_key_exists('third_color', $jsonData)?$jsonData['third_color']:'';
            $this->_fourthColor             = array_key_exists('fourth_color', $jsonData)?$jsonData['fourth_color']:'';
            $this->_bankAccount             = array_key_exists('bank_account', $jsonData)?$jsonData['bank_account']:'';
            $this->_taxInvoice              = array_key_exists('tax_invoice', $jsonData)?$jsonData['tax_invoice']:'';
            $this->_buyerUrl                = array_key_exists('buyer_url', $jsonData)?$jsonData['buyer_url']:'';
            $this->_sellerUrl               = array_key_exists('seller_url', $jsonData)?$jsonData['seller_url']:'';
        }
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
    public function getFullAmount()
    {
        return $this->_fullAmount;
    }

    /**
     * @param mixed $fullAmount
     */
    public function setFullAmount($fullAmount)
    {
        $this->_fullAmount = $fullAmount;
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
    public function getFeename()
    {
        return $this->_feename;
    }

    /**
     * @param mixed $feename
     */
    public function setFeename($feename)
    {
        $this->_feename = $feename;
    }

    /**
     * @return mixed
     */
    public function getRemainingAmount()
    {
        return $this->_remainingAmount;
    }

    /**
     * @param mixed $remainingAmount
     */
    public function setRemainingAmount($remainingAmount)
    {
        $this->_remainingAmount = $remainingAmount;
    }

    /**
     * @return mixed
     */
    public function getReleaseRequestAccount()
    {
        return $this->_releaseRequestAccount;
    }

    /**
     * @param mixed $releaseRequestAccount
     */
    public function setReleaseRequestAccount($releaseRequestAccount)
    {
        $this->_releaseRequestAccount = $releaseRequestAccount;
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
    public function getActionName()
    {
        return $this->_actionName;
    }

    /**
     * @param mixed $actionName
     */
    public function setActionName($actionName)
    {
        $this->_actionName = $actionName;
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
    public function getHasPendingRelease()
    {
        return $this->_hasPendingRelease;
    }

    /**
     * @param mixed $hasPendingRelease
     */
    public function setHasPendingRelease($hasPendingRelease)
    {
        $this->_hasPendingRelease = $hasPendingRelease;
    }

    /**
     * @return mixed
     */
    public function getVerificationState()
    {
        return $this->_verificationState;
    }

    /**
     * @param mixed $verificationState
     */
    public function setVerificationState($verificationState)
    {
        $this->_verificationState = $verificationState;
    }

    /**
     * @return mixed
     */
    public function getVerificationInformation()
    {
        return $this->_verificationInformation;
    }

    /**
     * @param mixed $verificationInformation
     */
    public function setVerificationInformation($verificationInformation)
    {
        $this->_verificationInformation = $verificationInformation;
    }

    /**
     * @return mixed
     */
    public function getDisbursementAccount()
    {
        return $this->_disbursementAccount;
    }

    /**
     * @param mixed $disbursementAccount
     */
    public function setDisbursementAccount($disbursementAccount)
    {
        $this->_disbursementAccount = $disbursementAccount;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethod()
    {
        return $this->_paymentMethod;
    }

    /**
     * @param mixed $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->_paymentMethod = $paymentMethod;
    }

    /**
     * @return mixed
     */
    public function getDisputeUser()
    {
        return $this->_disputeUser;
    }

    /**
     * @param mixed $disputeUser
     */
    public function setDisputeUser($disputeUser)
    {
        $this->_disputeUser = $disputeUser;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->_role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->_role = $role;
    }

    /**
     * @return mixed
     */
    public function getOtherUsername()
    {
        return $this->_otherUsername;
    }

    /**
     * @param mixed $otherUsername
     */
    public function setOtherUsername($otherUsername)
    {
        $this->_otherUsername = $otherUsername;
    }

    /**
     * @return mixed
     */
    public function getPrimaryColor()
    {
        return $this->_primaryColor;
    }

    /**
     * @param mixed $primaryColor
     */
    public function setPrimaryColor($primaryColor)
    {
        $this->_primaryColor = $primaryColor;
    }

    /**
     * @return mixed
     */
    public function getSecondaryColor()
    {
        return $this->_secondaryColor;
    }

    /**
     * @param mixed $secondaryColor
     */
    public function setSecondaryColor($secondaryColor)
    {
        $this->_secondaryColor = $secondaryColor;
    }

    /**
     * @return mixed
     */
    public function getThirdColor()
    {
        return $this->_thirdColor;
    }

    /**
     * @param mixed $thirdColor
     */
    public function setThirdColor($thirdColor)
    {
        $this->_thirdColor = $thirdColor;
    }

    /**
     * @return mixed
     */
    public function getFourthColor()
    {
        return $this->_fourthColor;
    }

    /**
     * @param mixed $fourthColor
     */
    public function setFourthColor($fourthColor)
    {
        $this->_fourthColor = $fourthColor;
    }

    /**
     * @return mixed
     */
    public function getBankAccount()
    {
        return $this->_bankAccount;
    }

    /**
     * @param mixed $bankAccount
     */
    public function setBankAccount($bankAccount)
    {
        $this->_bankAccount = $bankAccount;
    }

    /**
     * @return mixed
     */
    public function getTaxInvoice()
    {
        return $this->_taxInvoice;
    }

    /**
     * @param mixed $taxInvoice
     */
    public function setTaxInvoice($taxInvoice)
    {
        $this->_taxInvoice = $taxInvoice;
    }

    /**
     * @return mixed
     */
    public function getBuyerUrl()
    {
        return $this->_buyerUrl;
    }

    /**
     * @param mixed $buyerUrl
     */
    public function setBuyerUrl($buyerUrl)
    {
        $this->_buyerUrl = $buyerUrl;
    }

    /**
     * @return mixed
     */
    public function getSellerUrl()
    {
        return $this->_sellerUrl;
    }

    /**
     * @param mixed $sellerUrl
     */
    public function setSellerUrl($sellerUrl)
    {
        $this->_sellerUrl = $sellerUrl;
    }
}