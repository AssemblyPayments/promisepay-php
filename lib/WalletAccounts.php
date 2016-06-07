<?php
namespace PromisePay;

class WalletAccounts {
    public function get($id) {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id);
        
        return PromisePay::getDecodedResponse('wallet_accounts');
    }
    
    public function show($id) {
        return $this->get($id);
    }
    
    public function withdraw($id) {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id . '/disbursements');
        
        return PromisePay::getDecodedResponse('disbursements');
    }
    
    public function deposit($id, $params) {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id . '/transactions');
        
        return PromisePay::getDecodedResponse('transactions');
    }
    
    public function getUser($id) {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id . '/users');
        
        return PromisePay::getDecodedResponse('users');
    }
}