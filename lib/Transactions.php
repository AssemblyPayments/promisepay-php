<?php
namespace PromisePay;

class Transactions {
    public function get() {
        PromisePay::RestClient('get', 'transactions/');
        
        return PromisePay::getDecodedResponse('transactions');
    }
    
    public function getById($id) {
        PromisePay::RestClient('get', 'transactions/' . $id);
        
        return PromisePay::getDecodedResponse('transactions');
    }
    
    public function getUsers($id) {
        PromisePay::RestClient('get', 'transactions/' . $id . '/users');
        
        return PromisePay::getDecodedResponse('users');
    }
    
    public function getFees($id) {
        PromisePay::RestClient('get', 'transactions/' . $id . '/fees');
        
        return PromisePay::getDecodedResponse('fees');
    }
    
    public function getWalletAccounts($id) {
        PromisePay::RestClient('get', 'transactions/' . $id . '/wallet_accounts');
        
        return PromisePay::getDecodedResponse('wallet_accounts');
    }
    
    public function getBankAccounts($id) {
        PromisePay::RestClient('get', 'transactions/' . $id . '/bank_accounts');
        
        return PromisePay::getDecodedResponse('bank_accounts');
    }
    
    public function getCardAccounts($id) {
        PromisePay::RestClient('get', 'transactions/' . $id . '/card_accounts');
        
        return PromisePay::getDecodedResponse('card_accounts');
    }
    
    public function getPayPalAccounts($id) {
        PromisePay::RestClient('get', 'transactions/' . $id . '/paypal_accounts');
        
        return PromisePay::getDecodedResponse('paypal_accounts');
    }
}