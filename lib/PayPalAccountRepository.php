<?php
namespace PromisePay;

use PromisePay\DataObjects\PayPal;
use PromisePay\DataObjects\PayPalAccount;
use PromisePay\DataObjects\User;
use PromisePay\Exception;
use PromisePay\Log;

/**
 * Class PayPalAccountRepository
 *
 * @package PromisePay
 */
class PayPalAccountRepository extends BaseRepository {
    /**
     * List a PayPal account on a marketplace.
     *
     * Quries API for PayPal account data.
     * Input ID is not numeric, but in format of "ec9bf096-c505-4bef-87f6-18822b9dbf2c".
     * Returns PayPalAccount object containing account data from request response. 
     * 
     * @param string $id
     * @return PayPalAccount object
     */
    public function getPayPalAccountById($id) {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'paypal_accounts/'.$id);
        $jsonData = json_decode($response->raw_body, true)['paypal_accounts'];
        $accounts = new PayPalAccount($jsonData);
        return $accounts;
    }
    
    /**
     * Creates a PayPal account for a user on a marketplace.
     *
     * Input accepts PayPalAccount object. 
     * Returns new PayPalAccount object containing data from request response.
     *
     * @param PayPalAccount $paypal
     * @return PayPalAccount 
     */
    public function createPayPalAccount(PayPalAccount $paypal) {
        $payload = '';

        $preparePayload = array(
            "user_id"      => $paypal->getUserId(),
            "paypal_email" => $paypal->getPayPal()->getPayPalAccountEmail()
        );
        
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $response = $this->RestClient('post', 'paypal_accounts/', $payload);

        $jsonData = json_decode($response->raw_body, true)['paypal_accounts'];
        return new PayPalAccount($jsonData);
    }
    
    /**
     * Deletes a PayPal account for a user on a marketplace. 
     * Sets the account to in-active.
     *
     * Input ID is not numeric, but in format of "ec9bf096-c505-4bef-87f6-18822b9dbf2c".
     * Returns REST request response object.
     *
     * @param string $id
     * @return object
     */
    public function deletePayPalAccount($id) {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('delete', 'paypal_accounts/'.$id);
        return $response;
    }
    
    /**
     * Shows the user the PayPal account is associated with.
     *
     * Input ID is not numeric, but in format of "ec9bf096-c505-4bef-87f6-18822b9dbf2c".
     * Returns User object containing user data.
     *
     * @param string $id
     * @return User|null
     */
    public function getUserForPayPalAccount($id) {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get','/paypal_accounts/'.$id.'/users');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("users", $jsonRaw))
        {
            $jsonData = $jsonRaw["users"];
            $users = new User($jsonData);
            return $users;
        }
        return null;
    }

}