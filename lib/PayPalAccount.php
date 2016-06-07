<?php
namespace PromisePay;

/**
 * Class PayPalAccountRepository
 *
 * @package PromisePay
 */
class PayPalAccount {
    /**
     * List a PayPal account on a marketplace.
     *
     * Quries API for PayPal account data.
     * Input ID is not numeric, but in format of "ec9bf096-c505-4bef-87f6-18822b9dbf2c".
     * 
     * @param string $id
     * @return array
     */
    public function get($id) {
        PromisePay::RestClient('get', 'paypal_accounts/' . $id);
        
        return PromisePay::getDecodedResponse();
    }
    
    /**
     * Original get() method doesn't follow the established nomenclature
     * of returning array offset at master key. This one does, and the
     * original one has been left for backward compatibility reasons.
     */
    public function getV2($id) {
        return $this->get($id)['paypal_accounts'];
    }
    
    /**
     * Creates a PayPal account for a user on a marketplace.
     *
     * Input accepts PayPalAccount object. 
     *
     * @param PayPalAccount $paypal
     * @return array 
     */
    public function create($params) {
        PromisePay::RestClient('post', 'paypal_accounts/', $params);
        
        return PromisePay::getDecodedResponse('paypal_accounts');
    }
    
    /**
     * Deletes a PayPal account for a user on a marketplace. 
     * Sets the account to in-active.
     *
     * Input ID is not numeric, but in format of "ec9bf096-c505-4bef-87f6-18822b9dbf2c".
     *
     * @param string $id
     * @return array
     */
    public function delete($id) {
        PromisePay::RestClient('delete', 'paypal_accounts/' . $id);
        
        return PromisePay::getDecodedResponse('paypal_account');
    }
    
    /**
     * Shows the user the PayPal account is associated with.
     *
     * Input ID is not numeric, but in format of "ec9bf096-c505-4bef-87f6-18822b9dbf2c".
     *
     * @param string $id
     * @return array
     */
    public function getUser($id) {
        PromisePay::RestClient('get','/paypal_accounts/' . $id . '/users');
        
        return PromisePay::getDecodedResponse('users');
    }
}