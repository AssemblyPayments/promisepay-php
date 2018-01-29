<?php
namespace PromisePay;

class User {
    public function create($params) {
        PromisePay::RestClient('post', 'users/', $params);

        return PromisePay::getDecodedResponse('users');
    }

    public function get($id) {
        PromisePay::RestClient('get', 'users/' . $id);

        return PromisePay::getDecodedResponse('users');
    }
    
    public function show($id) {
        return $this->get($id);
    }

    public function getList($params = null) {
        PromisePay::RestClient('get', 'users/', $params);

        return PromisePay::getDecodedResponse('users');
    }

    public function update($id, $params) {
        PromisePay::RestClient('patch', 'users/' . $id . "/", $params);

        return PromisePay::getDecodedResponse('users');
    }

    public function sendMobilePin($id) {
        PromisePay::RestClient('post', '/users/' . $id . '/mobile_pin');
        
        return PromisePay::getDecodedResponse();
    }

    public function getListOfItems($id) {
        PromisePay::RestClient('get', 'users/' . $id . '/items');

        return PromisePay::getDecodedResponse('items');
    }

    public function getListOfBankAccounts($id) {
        PromisePay::RestClient('get', 'users/' . $id . '/bank_accounts');

        return PromisePay::getDecodedResponse('bank_accounts');
    }
    
    public function getBankAccount($id) {
        return $this->getListOfBankAccounts($id);
    }

    public function getListOfCardAccounts($id) {
        PromisePay::RestClient('get', 'users/' . $id . '/card_accounts');

        return PromisePay::getDecodedResponse('card_accounts');
    }

    public function getListOfPayPalAccounts($id) {
        PromisePay::RestClient('get', 'users/' . $id . '/paypal_accounts');

        return PromisePay::getDecodedResponse('paypal_accounts');
    }
    
    public function getListOfWalletAccounts($id) {
        PromisePay::RestClient('get', 'users/' . $id . '/wallet_accounts');
        
        return PromisePay::getDecodedResponse('wallet_accounts');
    }

    public function setDisbursementAccount($id, $params) {
        PromisePay::RestClient('patch', 'users/' . $id . '/disbursement_account', $params);
        
        return PromisePay::getDecodedResponse();
    }
    
    public function setDisbursementAccountV2($id, $params) {
        $result = $this->setDisbursementAccount($id, $params);
        
        return $result['users'];
    }
    
    public function verifyUser($id) {
        PromisePay::RestClient('patch', 'users/' . $id . "?type=identity_verified");

        return PromisePay::getDecodedResponse('users');
    }
}