<?php
namespace PromisePay;

class Transaction {
    public function getList($params = null) {
        PromisePay::RestClient('get', 'transactions/', $params);
        
        return PromisePay::getDecodedResponse('transactions');
    }
    
    public function get($id) {
        PromisePay::RestClient('get', 'transactions/' . $id);
        
        return PromisePay::getDecodedResponse('transactions');
    }

    public function getUser($id) {
        PromisePay::RestClient('get', 'transactions/' . $id . '/users');
        
        return PromisePay::getDecodedResponse('users');
    }

    public function getFee($id) {
        PromisePay::RestClient('get', 'transactions/' . $id . '/fees');
        
        return PromisePay::getDecodedResponse('fees');
    }
    
    public function getWalletAccount($id) {
        PromisePay::RestClient('get', 'transactions/' . $id . '/wallet_accounts');
        
        return PromisePay::getDecodedResponse('wallet_accounts');
    }
    
    public function getBankAccount($id) {
        PromisePay::RestClient('get', 'transactions/' . $id . '/bank_accounts');
        
        return PromisePay::getDecodedResponse();
    }
    
    public function getCardAccount($id) {
        PromisePay::RestClient('get', 'transactions/' . $id . '/card_accounts');
        
        return PromisePay::getDecodedResponse('card_accounts');
    }
    
    public function getPayPalAccount($id) {
        PromisePay::RestClient('get', 'transactions/' . $id . '/paypal_accounts');
        
        return PromisePay::getDecodedResponse();
    }
}