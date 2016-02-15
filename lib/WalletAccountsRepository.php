<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class WalletAccountsRepository {
    
    public static function get($id) {
        $response = PromisePay::RestClient('get', 'wallet_accounts/' . $id);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['wallet_accounts'];
    }
    
    public static function getUsers($id) {
        $response = PromisePay::RestClient('get', 'wallet_accounts/' . $id . '/users');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['users'];
    }
    
    public static function getDisbursements($id) {
        $response = PromisePay::RestClient('get', 'wallet_accounts/' . $id . '/disbursements');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['disbursements'];
    }
    
    public static function getTransactions($id) {
        $response = PromisePay::RestClient('get', 'wallet_accounts/' . $id . '/transactions');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['transactions'];
    }
    
}