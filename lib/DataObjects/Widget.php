<?php
namespace PromisePay\DataObjects;

/**
 * Class Widget
 * @package PromisePay\DataObjects
 */
class Widget
{
    /**
     * @var
     */
    public $_itemName;
    /**
     * @var
     */
    public $_fullAmount;
    /**
     * @var
     */
    public $_amount;
    /**
     * @var
     */
    public $_fees;
    /**
     * @var
     */
    public $_feename;
    /**
     * @var
     */
    public $_remainingAmount;
    /**
     * @var
     */
    public $_releaseRequestAccount;
    /**
     * @var
     */
    public $_currency;
    /**
     * @var
     */
    public $_description;
    /**
     * @var
     */
    public $_actionNAme;
    /**
     * @var
     */
    public $_status;
    /**
     * @var
     */
    public $_hasPendingRelease;
    /**
     * @var
     */
    public $_verificationState;
    /**
     * @var
     */
    public $_verificationInformation;
    /**
     * @var
     */
    public $_disbursementAccount;
    /**
     * @var
     */
    public $_paymentMethod;
    /**
     * @var
     */
    public $_disputeUser;
    /**
     * @var
     */
    public $_role;
    /**
     * @var
     */
    public $_otherUsername;
    /**
     * @var
     */
    public $_primaryColor;
    /**
     * @var
     */
    public $_secondaryColor;
    /**
     * @var
     */
    public $_thirdColor;
    /**
     * @var
     */
    public $_fourthColor;
    /**
     * @var
     */
    public $_bankAccount;
    /**
     * @var
     */
    public $_taxInvoice;
    /**
     * @var
     */
    public $_buyerUrl;
    /**
     * @var
     */
    public $_sellerUrl;

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
    public function getActionNAme()
    {
        return $this->_actionNAme;
    }

    /**
     * @param mixed $actionNAme
     */
    public function setActionNAme($actionNAme)
    {
        $this->_actionNAme = $actionNAme;
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