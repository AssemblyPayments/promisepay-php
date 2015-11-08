<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

/**
 * Class PayPalAccountRepository
 *
 * @package PromisePay
 */
class PayPalAccountRepository {
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
    public static function get($id) {
        PromisePay::checkIdNotNull($id);
        
        $response = PromisePay::RestClient('get', 'paypal_accounts/' . $id);
        
        return json_decode($response->raw_body, true);
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
    public static function create($params) {
        $response = PromisePay::RestClient('post', 'paypal_accounts/', $params);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['paypal_accounts'];
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
    public static function delete($id) {
        PromisePay::checkIdNotNull($id);
        
        $response = PromisePay::RestClient('delete', 'paypal_accounts/' . $id);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['paypal_account'];
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
    public static function getUser($id) {
        PromisePay::checkIdNotNull($id);
        
        $response = PromisePay::RestClient('get','/paypal_accounts/' . $id . '/users');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['users'];
    }

}