<?php
namespace PromisePay;

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
        $response = $this->RestClient('get', 'paypal_accounts/'.$id);
        return $this->generate_response($response);
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
    public function createPayPalAccount($params) {
        $response = $this->RestClient('post', 'paypal_accounts/', $this->generate_payload($params));
        return $this->generate_response($response);
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
        $response = $this->RestClient('delete', 'paypal_accounts/'.$id);
        return $this->generate_response($response);
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
    public function getUserForPayPalAccount($id)
    {
        $response = $this->RestClient('get','/paypal_accounts/'.$id.'/users');
        return $this->generate_response($response);
    }

}