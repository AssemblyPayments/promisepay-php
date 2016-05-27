<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class WalletAccountsRepository {
    public static function get($id) {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id);
        
        return PromisePay::getDecodedResponse('wallet_accounts');
    }
    
    public static function getUsers($id) {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id . '/users');
        
        return PromisePay::getDecodedResponse('users');
    }
    
    public static function getDisbursements($id) {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id . '/disbursements');
        
        return PromisePay::getDecodedResponse('disbursements');
    }
    
    public static function getTransactions($id) {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id . '/transactions');
        
        return PromisePay::getDecodedResponse('transactions');
    }
}