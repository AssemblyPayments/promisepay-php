<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class WalletAccounts {
    public static function get($id) {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id);
        
        return PromisePay::getDecodedResponse('wallet_accounts');
    }
    
    public static function show($id) {
        return self::get($id);
    }
    
    public static function withdraw($id) {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id . '/disbursements');
        
        return PromisePay::getDecodedResponse('disbursements');
    }
    
    public static function deposit($id, $params) {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id . '/transactions');
        
        return PromisePay::getDecodedResponse('transactions');
    }
    
    public static function getUser($id) {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id . '/users');
        
        return PromisePay::getDecodedResponse('users');
    }
}
