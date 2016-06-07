<?php
namespace PromisePay;

class Disbursement {
    
    public function get() {
        PromisePay::RestClient('get', 'disbursements/');
        
        return PromisePay::getDecodedResponse('disbursements');
    }
    
    public function getById($id) {
        PromisePay::RestClient('get', 'disbursements/' . $id);
        
        return PromisePay::getDecodedResponse('disbursements');
    }
    
    public function getTransactions($id) {
        PromisePay::RestClient('get', 'disbursements/' . $id . '/transactions');
        
        return PromisePay::getDecodedResponse('transactions');
    }
    
    public function getWalletAccounts($id) {
        PromisePay::RestClient('get', 'disbursements/' . $id . '/wallet_accounts');
        
        return PromisePay::getDecodedResponse('wallet_accounts');
    }
    
    public function getBankAccounts($id) {
        PromisePay::RestClient('get', 'disbursements/' . $id . '/bank_accounts');
        
        return PromisePay::getDecodedResponse('bank_accounts');
    }
    
    public function getPayPalAccounts($id) {
        PromisePay::RestClient('get', 'disbursements/' . $id . '/paypal_accounts');
        
        return PromisePay::getDecodedResponse('paypal_accounts');
    }
    
}
